<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Models\Profesor;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:usuarios');
    }

    public function index()
    {
        $user = User::all();
        return view('users.index', compact('user'));
    }

    protected function create()
    {        
        $role = Role::all();
        return view('users.create', compact('role'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name'              =>      'required|string|max:20',
                'email'             =>      'required|email|unique:users,email',
                'password'          =>      'required|alpha_num|min:6',
                'confirm_password'  =>      'required|same:password',
            ]
        );

        $dataArray = array(
            "name"          =>          $request->name,
            "email"         =>          $request->email,
            "password"      =>          bcrypt($request->password)
        );

        $user = User::create($dataArray);
        $user->roles()->sync($request->role);
        
        if(!is_null($user)) {
            return back()->with("success", "Success! Registration completed");
        }

        else {
            return back()->with("failed", "Alert! Failed to register");
        }
    }

    public function show($id)
    {
        //
    }

    public function edit(User $usuario)
    {   
        $roles = Role::all();
        return view('users.edit', compact('usuario','roles'));
    }

    public function update(Request $request, User $usuario)
    {
        $usuario->roles()->sync($request->roles);  
        return redirect()->route('usuarios.edit', $usuario)->with('Info','Succes! Roles assigned correctly');
    }

    public function destroy(User $usuario)
    {
        if($usuario->roles->pluck('name')->first() == 'Estudiante')
        {
        $estudiante = Estudiante::where('user_id',$usuario->id)->first();
        $usuario->delete();
        $estudiante->delete();
        }elseif($usuario->roles->pluck('name')->first() == 'Tutor'){
        $profesor = Profesor::where('user_id',$usuario->id)->first();
        $usuario->delete();
        $profesor->delete();
        }else{
        $usuario->delete();   
        }
        return redirect()->route('usuarios.index');
    }

}
