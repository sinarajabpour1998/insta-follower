<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Modules\Core\Models\Token;

class TokenValidator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $validator = Validator::make([ 'Authorization' => $request->header('authorization')], [
            'Authorization' => ['required', 'string']
        ]);

        if ($validator->fails()) {
            return response([
                'status' => 421,
                'message' => $validator->messages()->first()
            ], 421);
        }

        $token = Token::query()->where('token', $request->bearerToken())->first();
        if (is_null($token)) {
            return response([
                'status' => 401,
                'message' => 'Unauthorized'
            ], 401);
        }

        $request->merge(['user' => $token->user]);

        return $next($request);
    }
}
