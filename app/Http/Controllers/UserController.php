<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

use App\User;
use App\Role;

class UserController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
        // $this->authorizeResource(User::class, 'user');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Gate::allows('admin')){
            $users = User::all();
            return view('user.index', ['users' => $users]);
        }
        return redirect('/post')->with('error', 'You not administrator');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Gate::allows('admin')){

            $roles = Role::all();
            return view('user.create', ['roles' => $roles]);
        }
        return redirect('/post')->with('error', 'You not administrator');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        if(Gate::allows('admin')){
            
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ])->roles()->attach($request->role_id);
    
            return redirect('/user')->with('status','User register succsessfully!');
        }
        return redirect('/post')->with('error', 'You not administrator');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        if(Gate::allows('admin')){
            return view('user.show', ['user' => $user]);
        }
        return redirect('/post')->with('error', 'You not administrator');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if(Gate::any(['admin','self'], $user)){
            $roles = Role::all();
            return view('user.edit',['user' => $user, 'roles' => $roles]);
        }
            return redirect('/post')->with('error', 'You not administrator');
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required'
        ]);
        
        if(Gate::any(['admin','self'], $user)){
            $data = $user;
            
            $data->name = $request->name;
            $data->email = $request->email;
            if ($request->password !== null){
                $data->password = bcrypt($request->password);
            }
            $data->save();
            $data->roles()->sync($request->role_id);
            if (Gate::allows('admin')){
                return redirect('/user')->with('status','User updated succsessfully!');
            }else {
                return redirect('/post')->with('status','Profile updated succsessfully!');
            }
        }
        return redirect('/post')->with('error', 'You not administrator');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if(Gate::allows('admin')){
            $user->delete();
    
            return redirect('/user')->with('status','User deleted succsessfully!');
        }
        return redirect('/post')->with('error', 'You not administrator');
    }
}
