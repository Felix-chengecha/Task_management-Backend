<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\detailsResource;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //



    public function register(Request $request)  {
        try {

            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password'))
            ]);

            //use the user to create a token and get it in plain text
            $token = $user->createToken('user_token')->plainTextToken;

            return response()->json([
                'user' => $user,
                'token' => $token
            ], 200);
        } catch (\Exception  $e) {

            return response()->json([
                'error' => $e->getMessage(),
                'message' => 'something went wrong'
            ]);
        }
    }


    public function login(Request $request)  {
        try {

            $user = User::where('email', '=', $request->input('email'))->firstorfail();

            if (Hash::check($request->input('password'), $user->password)) {
                $token = $user->createToken('user_token')->plainTextToken;

                return response()->json(['message' => 'welcome back',  'user' => $user,  'token' => $token], 200);
            }

            return response()->json([
                'error' => 'error check your password again'
            ]);
        } catch (\Exception  $e) {

            return response()->json([
                'error' => $e->getMessage(),
                'message' => 'something went wrong'
            ]);
        }
    }


    public function logout(Request $request) {
        try {
            $user = User::findorfail($request->input('user_id'));
            $user->tokens()->delete();

            return response()->json([
                'message' => 'user logged out',
            ], 200);
        } catch (\Exception  $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'message' => 'something went wrong'
            ]);
        }
    }


    public function user_details($id) {
        return User::find($id) ;
    }
}
