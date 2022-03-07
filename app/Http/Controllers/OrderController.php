<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Http\Resources\Order as OrderResource;

class OrderController extends Controller
{

    public function index()
    {
        $orders = Order::orderBy('id', 'desc')->get();
        return OrderResource::collection($orders);
    }


    public function create()
    {
        //
    }


    public function store(StoreOrderRequest $request)
    {
        $order = new Order();
        $created = $order->createOrder($request->getData());
        return new OrderResource($created);
    }

    public function show(Order $order)
    {
        //
    }


    public function edit(Order $order)
    {
        //
    }


    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }


    public function destroy(Order $order)
    {
        //
    }
}
