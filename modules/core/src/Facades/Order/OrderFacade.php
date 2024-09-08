<?php
namespace Modules\Core\Facades\Order;

use Modules\Core\Facades\BaseFacade;

/**
 * @class \Modules\Core\Facades\Order\OrderFacade
 *
 * @method static object getUserOrders($user_id)
 * @method static object createUserOrder($request)
 * @method static object getOtherUsersOrders($request)
 * @method static object getUserOrder($request)
 * @method static object getFollowedOrder($request)
 * @method static object getEnableOrder($request)
 * @method static object createTransaction($request)
 * @method static object createFollow($request, $transaction_id, $username)
 * @method static object addCoinToUserWallet($request)
 * @method static object updateOrderRemainFollowAmount($order)
 *
 * @see \Modules\Core\Repositories\Order\OrderRepository
 */

class OrderFacade extends BaseFacade
{

}
