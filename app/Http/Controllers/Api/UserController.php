<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Password;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        $user = auth()->user();
        $user->token = $token;

        $respon = [
            'success' => true,
            'message' => 'Login successfully',
            'data' => $user
        ];

        return response()->json($respon, 200);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6|confirmed',
            'phone' => 'required|regex:/^[0-9]{10}$/',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $attributes = request()->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6|confirmed',
            'phone' => 'required|regex:/^[0-9]{10}$/',
        ]);

        $user = User::where('email', $request->email)->first();
        if ($user != null) {
            return response()->json(['success' => false, 'message' => array('The email has already been taken.'), 'data' => $user]);
        }

        $attributes['role_id'] = 3;
        $user = User::create($attributes);
        // $user = User::find($user->id);

        $data['success'] = true;
        $data['message'] = array('Registration has been successfully');
        $data['data'] = $user;

        $token = JWTAuth::fromUser($user);

        return response()->json(compact('data', 'user', 'token'), 201);

    }

    public function emailSend(Request $request)
    {
        $rules = [
            'email' => 'required|email'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->messages()->all()]);
        }

        $user = User::where('email', $request->email)->first();
        if ($user === null) {
            // user doesn't exist
            return response()->json(['success' => false, 'message' => array("This email id doesn't exists")]);
        }

        Password::sendResetLink($request->all());

        $data['success'] = true;
        $data['message'] = array('Reset password link sent on your email id.');
        $data['data'] = array();

        return response()->json($data);
    }

    public function getAuthenticatedUser()
    {
        try {

            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());

        }

        return response()->json(compact('user'));
    }

    public function logout(Request $request)
    {
        $token = $request->token;
        JWTAuth::invalidate($token);
        return response()->json(['message' => 'User successfully signed out']);
    }
}