<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Article;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
use Exception;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'orders';
    protected $fillable = [
        
    ];

    public function createOrder($data){
        $order = Order::create();

        $aggregate = $this->aggregate($data);

        foreach($aggregate as $value){
            $value['OrderId'] = $order->id;
            $article = new Article();
            $article->createArticle($value);
        }

        $this->updateServers($order);

        return $order;
    }

    private function aggregate($data){

        $aggregate = [];

        foreach($data as $key => $value){
            $find = array_search($value['ArticleCode'], array_column($aggregate, 'ArticleCode'));
            if($find === false){
                $aggregate[] = $value;
            }
            else{
                $aggregate[$find]['Quantity'] += $value['Quantity'];
            }
        }

        return $aggregate;
    }

    public function articles(){
        return $this->hasMany(Article::class, 'OrderId');
    }

    public function totalDiscount(){
        return floatval($this->articles()->sum('Discount'));
    }

    public function totalAmount(){
        return floatval($this->articles()->sum(DB::raw('Quantity * UnitPrice')));
    }

    public function updateServers($order){

        $client = new Client();

        $server1 = [
            'OrderId' => $order->id,
            'OrderCode' => date_format($order->created_at, 'Y-m-') . $order->id,
            'OrderDate' => date_format($order->created_at, 'Y-m-d'),
            'TotalAmountWithoutDiscount' => $order->totalAmount(),
            'TotalAmountWithDiscount' => $order->totalAmount() - $order->totalDiscount()
        ];
        
        $server2 = [
            'id' => $order->id,
            'code' => date_format($order->created_at, 'Y-m-') . $order->id,
            'date' => date_format($order->created_at, 'Y-m-d'),
            'total' => $order->totalAmount(),
            'discount' => $order->totalDiscount()
        ];
        
        $server3 = [
            'id' => $order->id,
            'code' => date_format($order->created_at, 'Y-m-') . $order->id,
            'date' => date_format($order->created_at, 'Y-m-d'),
            'totalAmount' => $order->totalAmount(),
            'totalAmountWithDiscount' => $order->totalAmount() - $order->totalDiscount()
        ];

        try{
            $response_server1 = $client->post(env('SERVER1') . '/order', [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept'=> 'application/json'
                ],
                'body' => json_encode($server1)
            ]);
        }
        catch(Exception $error){
            return true;
        }


        try{
            $response_server2 = $client->post(env('SERVER2') . '/v1/order', [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept'=> 'application/json'
                ],
                'body' => json_encode($server2)
            ]);
        }
        catch(Exception $error){
            return true;
        }


        try{
            $response_server3 = $client->post(env('SERVER3') . '/web_api/order', [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept'=> 'application/json'
                ],
                'body' => json_encode($server3)
            ]);
        }
        catch(Exception $error){
            return true;
        }

        return true;

    }
}
