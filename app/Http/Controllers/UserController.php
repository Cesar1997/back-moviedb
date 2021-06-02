<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use JwtAuth;
class UserController extends Controller
{
    public function login(Request $request)
    {
        $credentials = request(['email', 'password']);
        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->respondWithToken($token);
    }

    public function store(UserStoreRequest $request)
    {
        \DB::beginTransaction();
        try {
            $fields  = $request->all();
            unset($fields['password_confirmation']);
            $fields['password'] = Hash::make($fields['password']);
            $user =  User::create($fields);
            \DB::commit();
            return $this->respondSuccess('Se creo el usuario exitosamente',$user);
        } catch(\Exception $e) {
            \DB::rollback();
            return $this->respondWithError($e->getMessage());
        }
    }

    protected function respondWithToken($token)
    {
        return $this->respondSuccess(
            'Autenticado exitosamente',
            [
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL() * 60
            ]

        );
    }
}
