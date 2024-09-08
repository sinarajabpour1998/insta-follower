<?php
namespace Modules\Core\Repositories\Order;

use App\Models\User;
use Modules\Core\Models\Follow;
use Modules\Core\Models\Order;
use Modules\Core\Models\Transaction;

class OrderRepository
{
    public function getUserOrders($user)
    {
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

    public function getOtherUsersOrders($request)
    {
        $orders = Order::query()
            ->where('user_id', '!=', $request->user->id)
            ->where('follow_remain_count', '!=', 0)
            ->where('status', '=', 'enable')
            ->paginate();
        $pages = $orders->lastPage();
        return (object) [
            'orders' => $orders,
            'pages' => $pages
        ];
    }

    public function getUserOrder($request)
    {
        return $request->user->orders()->where('id', $request->order_id)->first();
    }

    public function getFollowedOrder($request)
    {
        return $request->user->follows()->where('order_id', $request->order_id)->first();
    }

    public function getEnableOrder($request)
    {
        return Order::query()
            ->where('user_id', '!=', $request->user->id)
            ->where('follow_remain_count', '!=', 0)
            ->where('status', '=', 'enable')
            ->first();
    }

    public function createTransaction($request)
    {
        return Transaction::query()->create([
            'user_id' => $request->user->id,
            'order_id' => $request->order_id,
            'amount' => 2,
            'status' => 'done'
        ]);
    }

    public function createFollow($request, $transaction_id, $username)
    {
        return Follow::query()->create([
            'user_id' => $request->user->id,
            'order_id' => $request->order_id,
            'transaction_id' => $transaction_id,
            'username' => $username,
            'status' => 'followed'
        ]);
    }

    public function addCoinToUserWallet($request)
    {
        return User::query()
            ->where('id', $request->user->id)
            ->update([
                'wallet' => $request->user->wallet + 2
            ]);
    }

    public function updateOrderRemainFollowAmount($order)
    {
        $remain_follow = $order->follow_remain_count - 1;
        $status = 'enable';
        if ($remain_follow == 0) {
            $status = 'completed';
        }
        return Order::query()
            ->where('id', '=', $order->id)
            ->update([
            'follow_remain_count' => $remain_follow,
            'status' => $status
        ]);
    }
}
