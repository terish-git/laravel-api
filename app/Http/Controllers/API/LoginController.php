<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Exception;

class LoginController extends BaseController
{
    /**
     * User login API method
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) return  $this->sendError('Validation Error.', $validator->errors(), 422);

        $credentials = $request->only('email', 'password');
        try {
            if (Auth::attempt($credentials)) {
                $user             = Auth::user();
                $success['user']  = $user;
                $success['name']  = $user->name;
                $success['token'] = $user->createToken('accessToken')->accessToken;

                return $this->sendResponse($success, 'You are successfully logged in.');
            } else {
                $success['token'] = [];
                
            }
        } catch (Exception $e) {
            $success['token'] = [];
        }

        return $this->sendError('Unauthorized', ['error' => 'Unauthorized'], 401);
    }
}