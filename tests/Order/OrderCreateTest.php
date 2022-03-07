<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Order;

class OrderCreateTest extends TestCase
{
    protected $order;

    public function testOrderCreate()
    {

        $this->order = new Order();
        $order_create = $this->order->createOrder($this->data());

        $this->assertCount(2, $order_create->articles);
    }

    public function data(){
        return 
        [
            [
                "ArticleCode" => "1",
                "ArticleName" => "Mouse",
                "UnitPrice" => 100,
                "Quantity" => 3
            ],
            [
                "ArticleCode" => "1",
                "ArticleName" => "Mouse",
                "UnitPrice" => 100,
                "Quantity" => 4
            ],
            [
                "ArticleCode" => "2",
                "ArticleName" => "Teclado",
                "UnitPrice" => 200,
                "Quantity" => 3
            ]
        ];
    }

}
