<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'articles';
    protected $fillable = [
        'OrderId',
        'ArticleCode',
        'ArticleName',
        'UnitPrice',
        'Quantity',
        'Discount'
    ];

    public function createArticle($data){
        $value = $data['Quantity'] * $data['UnitPrice'];
        if($data['Quantity'] >= 5 && $data['Quantity'] <= 9 && $value > 500){
            $data['Discount'] = $value * 0.15;
        }
        return Article::create($data);
    }
}
