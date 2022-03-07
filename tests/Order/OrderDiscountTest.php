<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Order;

class OrderDiscountTest extends TestCase
{
    protected $order;

    public function testOrderDiscount()
    {

        $this->order = new Order();
        $order_discount = $this->order->all()->last();

        $this->assertEquals(105.0, $order_discount->totalDiscount());
    }

}
