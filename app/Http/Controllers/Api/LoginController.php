<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function login(Request $request)
    {

        try {
            $this->validate($request, [
                'username' => 'required',
                'password' => 'required'
            ]);

            $user = DB::table('user')
                ->where('username', $request->username)
                ->where('password', $request->password)
                ->first();

            if ($user) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Login Success',
                    'data' => $user
                ], 200);
            } else {
                return response()->json([
                    'status' => 401,
                    'message' => 'Login Failed',
                    'data' => null
                ], 401);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Internal Server Error: ' . $e->getMessage(),
                'data' => null
            ], 402);
        }
    }
}
