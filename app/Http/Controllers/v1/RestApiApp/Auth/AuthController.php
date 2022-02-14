<?php

namespace App\Http\Controllers\v1\RestApiApp\Auth;

use App\Http\Controllers\v1\BaseController;
use App\Http\Requests\v1\Auth\AuthLoginRequest;
use App\Http\Requests\v1\Auth\AuthRegisterRequest;
use App\Models\UserApp;
use App\Models\v1\AppUser;
use Illuminate\Support\Facades\Hash;

class AuthController extends BaseController
{
    public function login(AuthLoginRequest $request)
    {
        $data = $request->validated();

        $user = AppUser::where('email', $data['email'])->first();
        if ($user):
            if (!Hash::check($data['password'], $user->password))
                return $this->error('Unauthorized', 401);

            $user = $this->prepareData($user);
            return $this->success(compact('user'));

        endif;
        return $this->error('Please, verified your credentials', 401);
    }

    public function prepareData(AppUser $user)
    {
        $token = $user->createToken('accessToken')->accessToken;
        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'token' => $token,
        ];
    }

    public function register(AuthRegisterRequest $request)
    {
        $data = $request->validated();

        $data['password'] = bcrypt($data['password']);
        $user = AppUser::create($data);
        $user->setMediaCollection($data, 'avatar');
        $response['token'] = $user->createToken('accessToken')->accessToken;
        $response['user'] = $user;


        return $this->success($response);
    }
}
