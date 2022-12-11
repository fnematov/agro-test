<?php

namespace App\Http\Controllers;

use App\Enums\RolesEnum;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);
        $user = User::query()->where('email', $data['email'])
            ->role([RolesEnum::ADMIN->value, RolesEnum::EMPLOYEE->value, RolesEnum::ORGANIZATION->value])
            ->with('roles')
            ->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            return $this->error([
                'email' => 'Неверный Эл. адрес или пароль'
            ], 'Неверный Эл. адрес или пароль', 401);
        }

        $token = Auth::attempt($data);
        return $this->success([
            'user' => $user,
            'authorization' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }

    public function logout(): \Illuminate\Http\JsonResponse
    {
        Auth::logout();
        return $this->success([
            'message' => 'Вы успешно вышли из системы'
        ]);
    }
}
