<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;


class UserController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            // examples with aliases, pipe-separated names, guards, etc:
            new Middleware('permission:view users', only: ['index']),
            new Middleware('permission:create user', only: ['index']),
            new Middleware('permission:edit user', only: ['index']),
            new Middleware('permission:delete user', only: ['index']),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data['users']=User::latest()->paginate(10);
        $data['count']=1;
        return view('users.list',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['roles']=Role::latest()->get();
        return view('users.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        $user=User::find($id);
        $data['user']=$user;
        $data['roles']=Role::latest()->get();
        $data['hasRoles']=$user->roles->pluck('id');

        return view('users.edit',$data);


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $user=User::findOrFail($id);
        $validator=Validator::make($request->all(),[
            'name'=>'required|min:3',
            'email'=>'required|email|unique:users,email,'.$id.',id',
        ]);


        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        else
        {
            $user->name=$request->name;
            $user->email=$request->email;
            $user->save();

            $user->syncRoles($request->role);

            return redirect()->route('users.index')->with('success','User updated successfully');

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
