<?php

namespace Modules\Core\Http\ApiControllers\Follow;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Core\Facades\Order\OrderFacade;
use Modules\Core\Http\ApiControllers\ApiController;
use Modules\Core\Http\Resources\OrderResource;

class FollowController extends ApiController
{
    public function index(Request $request)
    {
        $request->validate([
            'page' => ['required', 'integer', 'min:1']
        ]);

        $orders = OrderFacade::getOtherUsersOrders($request);

        return response([
            'message' => 'ok',
            'orders' => OrderResource::collection($orders->orders),
            'pages' => $orders->pages
        ]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'order_id' => ['required', 'numeric', 'exists:orders,id']
        ]);

        // check if this is the current user order
        if (!is_null(OrderFacade::getUserOrder($request))) {
            return response([
                'status' => false,
                'message' => 'you can not follow your own page !',
            ], 422);
        }

        // check if user already followed the page
        if (!is_null(OrderFacade::getFollowedOrder($request))) {
            return response([
                'status' => false,
                'message' => 'you already followed this page !',
            ], 422);
        }

        // check if order has remain follow and it's enabled
        $order = OrderFacade::getEnableOrder($request);
        if (is_null($order)) {
            return response([
                'status' => false,
                'message' => 'this order is not active !',
            ], 422);
        }

        // make a transaction and follow order
        DB::beginTransaction();
        try {
            $transaction = OrderFacade::createTransaction($request);
            if (is_null($transaction)) {
                DB::rollBack();
                return response([
                    'status' => false,
                    'message' => 'transaction could not be created !',
                ], 500);
            }

            OrderFacade::createFollow($request, $transaction->id, $order->username);

            // update user wallet
            OrderFacade::addCoinToUserWallet($request);

            // update order state
            OrderFacade::updateOrderRemainFollowAmount($order);

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            return response([
                'status' => false,
                'message' => 'transaction could not be created !',
            ], 500);
        }

        return response([
            'status' => true,
            'message' => 'You followed this page successfully and gained 2 coin !',
        ]);
    }
}
