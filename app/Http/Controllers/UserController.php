<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Password;
use DataTables;
use DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, User $model)
    {
        // $data = User::with('role:name')
        //     ->whereHas('role', function ($query) {
        //         $query->where('name', '!=', 'admin');
        //     })
        //     ->get();

        $data = User::get();
        return view('users.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::get()->where('name', '!=', 'Admin');
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();

        // validate request data
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required',
            'role_id' => 'required',
        ]);

        // create a new instance of the model
        $model = new User;

        // assign request data to the model properties
        $model->role_id = $validatedData['role_id'];
        $model->name = $validatedData['name'];
        $model->email = $validatedData['email'];
        $model->phone = $validatedData['phone'];

        // save the model to the database
        $model->save();

        //assign role 
        $user = User::find($model->id);
        $role = Role::find($model->role_id);
        $user->assignRole($role->name);

        Password::sendResetLink($request->only('email'));

        // return a response to the user
        return redirect()->route('user.index')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = User::where('id', '=', $id)->get();
        $roles = Role::get()->where('name', '!=', 'Admin');

        // dd($data);
        // die();
        return view('users.edit', compact('data', 'roles'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // validate request data
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'role_id' => 'required',
        ]);


        $user = User::findOrFail($id);
        $user->role_id = $validatedData['role_id'];
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->phone = $validatedData['phone'];
        $user->save();

        // return a response to the user
        return redirect()->route('user.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        // Get the user with the given id
        $delete = User::destroy($id);

        // Redirect back with success message
        return redirect()->route('user.index')->with('success', 'User deleted successfully.');
    }
}