<?php

namespace Modules\Core\Http\ApiControllers\Order;

use Illuminate\Http\Request;
use Modules\Core\Facades\Order\OrderFacade;
use Modules\Core\Http\ApiControllers\ApiController;
use Modules\Core\Http\Resources\OrderResource;

class OrderController extends ApiController
{
    public function index(Request $request)
    {
        $request->validate([
            'page' => ['required', 'integer', 'min:1']
        ]);

        $orders = OrderFacade::getUserOrders($request->user->id);

        return response([
            'message' => 'ok',
            'orders' => OrderResource::collection($orders->orders),
            'pages' => $orders->pages
        ], 200);
    }
}
