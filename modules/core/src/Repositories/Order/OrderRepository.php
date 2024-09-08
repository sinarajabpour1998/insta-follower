<?php
namespace Modules\Core\Repositories\Order;

use Modules\Core\Models\Order;

class OrderRepository
{
    public function getUserOrders($user_id)
    {
        $orders = Order::query()->where('user_id', $user_id)->paginate();
        $pages = $orders->lastPage();
        return (object) [
            'orders' => $orders,
            'pages' => $pages
        ];
    }
}
