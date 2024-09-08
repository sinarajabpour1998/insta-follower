<?php
namespace Modules\Core\Repositories\Order;

use Modules\Core\Models\Order;

class OrderRepository
{
    public function getUserOrders($user)
    {
        //$orders = Order::query()->where('user_id', $user_id)->paginate();
        $orders = $user->orders()->paginate();
        $pages = $orders->lastPage();
        return (object) [
            'orders' => $orders,
            'pages' => $pages
        ];
    }

    public function createUserOrder($request)
    {
        return Order::query()->create([
            'user_id' => $request->user->id,
            'follow_total_count' => $request->follow_count,
            'follow_remain_count' => $request->follow_count,
            'username' => $request->username,
            'status' => 'enable'
        ]);
    }
}
