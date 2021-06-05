<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Response;
use App\Http\Requests\UserCreateRequest;
class UserController extends Controller
{
    public function index(){
        return User::paginate();
    }

    public function show($id)
    {
        return User::find($id);
    }

    public function store(UserCreateRequest $request) 
    {
        $user = User::create($request->only('first_name', 'last_name', 'email') + [
            'password' => Hash::make($request->input('password'))

        ]);
        return response($user, 201);

    }

    public function update(Request $request, $id){
        $user = User::find($id);
        
        $user->update($request->only('first_name', 'last_name', 'email'));
       
        
        return response($user, 201);


    }

    public function destroy($id)
    {
        User::destroy($id);

        return response(null,  204);

    }
}
