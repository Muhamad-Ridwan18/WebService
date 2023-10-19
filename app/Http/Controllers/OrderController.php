<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return Order::all();
    }

    public function show($id)
    {
        return Order::find($id);
    }

    public function store(Request $request)
    {
        return Order::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $order = Order::find($id);
        $order->update($request->all());
        return $order;
    }

    public function destroy($id)
    {
        Order::find($id)->delete();
        return ['message' => 'Order deleted'];
    }
}
