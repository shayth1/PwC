<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'department_id' => 'required|integer|max:11',
            'password' => 'required|string|confirmed'

        ]);
        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'user_level' => 'employee',
            'department_id' => $fields['department_id'],
            'password' => bcrypt($fields['password'])
        ]);
        $response = [
            'mesasage' => 'user created successfully',
            'user' => $user,

        ];

        return response($response, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $updateUser = User::find($id);
        $updateUser->update($request->all());

        return $updateUser;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = User::destroy($id);

        if ($delete) {
            return ['message' => 'User has been deleted successfully.'];
        } else {
            return ['message' => 'Oops something went wrong'];
        }
    }

    public function search($key)
    {

        return User::where('name', 'like', '%' . $key . '%')->orWhere('email', 'like', '%' . $key . '%')->get();
    }

    // public function getProjects($user_id)
    // {

    //     return User::where('name', 'like', '%' . $key . '%')->orWhere('email', 'like', '%' . $key . '%')->get();
    // }
}