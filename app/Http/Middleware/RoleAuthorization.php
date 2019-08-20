<?php

namespace App\Http\Middleware;

use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

use Closure;

class RoleAuthorization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //dd("MIDDLEWARE");
        try {
            //Access token from the request        
            $token = JWTAuth::parseToken();
            //Try authenticating user       
            $user = $token->authenticate();
        } catch (TokenExpiredException $e) {
            //Thrown if token has expired; message = Your token has expired. Please, login again.
            return $this->unauthorized('You are unauthorized to access this resource');
        } catch (TokenInvalidException $e) {
            //Thrown if token invalid; message = Your token is invalid. Please, login again.
            return $this->unauthorized('You are unauthorized to access this resource');
        }catch (JWTException $e) {
            //Thrown if token was not found in the request; message = Please, attach a Bearer Token to your request
            return $this->unauthorized('You are unauthorized to access this resource');
        }
        //If user was authenticated successfully and user is in one of the acceptable roles, send to next request.
        if ($user && $user->role == 'admin') {
            return $next($request);
        }
    
        return $this->unauthorized();
    }

    private function unauthorized($message = null){
        // return response()->json([
        //     'message' => $message ? $message : 'You are unauthorized to access this resource',
        //     'success' => false
        // ], 401);
        return redirect('/forbidden')->with('message', $message ? $message : 'You are unauthorized to access this resource');
    }
}
