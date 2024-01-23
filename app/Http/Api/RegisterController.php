<?php

namespace App\Http\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    
    public function register(Request $request)
    {
        $data = $request->validate([
            'name'     => ['required', 'string'],
            'email'    => ['required', 'email'],
            'password' => ['required', 'confirmed'],
            'avatar'   => ['image'],
        ]);

        $file = $request->file('avatar');
        $name = '/avatars/' . uniqid() . '.' . $file->extension();
        $file->storePubliclyAs('public', $name);
        $data['avatar'] = $name;
        
        $user = User::create($data);
        
        return new UserResource($user);
    }
}