<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderStatus;
use App\Models\PaymentStatus;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class OrderController
{
    public function index(): View|Factory|Application
    {
        return view('admin.orders.index', [
            'orders' => Order::simplePaginate(20),
        ]);
    }

    public function edit(Order $order): View|Factory|Application
    {
        $orderItems = OrderItem::all()->where('order_id', $order->id);
        $total = $orderItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });


        return view('admin.orders.edit', [
            'order' => $order,
            'orderItems' => $orderItems,
            'statuses' => OrderStatus::all(),
            'paymentStatuses' => PaymentStatus::all(),
            'total' => $total,
        ]);
    }

    public function update(Order $order): Application|Redirector|RedirectResponse
    {

        $attributes = request()->validate([
            'name' => 'required',
            'total' => 'required',
            'status_id' => 'required',
            'payment_status_id' => 'required',
        ]);

        $order->update($attributes);
        return redirect(url('admin/orders'));
    }

    public function destroy(Order $order): Application|Redirector|RedirectResponse
    {
        $order->delete();
        return redirect('admin/orders');
    }

    public function editItems(Order $order): View|Factory|Application
    {
        $orderItems = OrderItem::all()->where('order_id', $order->id);
        $total = $orderItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        return view('admin.orders.editItems', [
            'order' => $order,
            'orderItems' => $orderItems,
            'total' => $total,
        ]);
    }

    public function updateItems(OrderItem $orderItem): RedirectResponse
    {
        $orderItem->update(['quantity' => request()->input('quantity')]);
        return redirect()->back();
    }

    public function destroyItems(OrderItem $orderItem): RedirectResponse
    {
        $orderItem->delete();
        return redirect()->back();
    }

}
