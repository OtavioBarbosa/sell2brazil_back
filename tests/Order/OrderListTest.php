<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Http\Controllers\OrderController;

class OrderListTest extends TestCase
{
    protected $order_controller;

    public function testOrderList()
    {

        $this->order_controller = new OrderController();
        $order_list = $this->order_controller->index();

        $this->assertTrue(gettype($order_list) === 'object');
    }

}
