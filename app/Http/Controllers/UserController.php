<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(15);

        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate( [
            'name' =>'required|max:255',
            'email' =>'required|email|unique:users',
            'password' => 'required|min:8',
            'profile_id' => 'required',
        ],[
            'name.required' => 'O campo de Nome é obrigatório.',
            'name.max' => 'O Nome não pode ter mais de 255 caracteres.',
            'email.required' => 'O campo de Email é obrigatório.',
            'email.email' => 'O campo de Email precisa ter um email válido.',
            'email.unique' => 'Já existe um usuário cadastrado com esse email.',
            'password.required' =>'O campo de Senha é obrigatório.',
            'password.min' =>'O senha precisa ter pelomenos 8 caracteres.',
            'profile_id.required' => 'O campo de Perfil é obrigatório.',
            'profile_id.exists' => 'Esse Perfil não existe.',
        ]);

        $user =  User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'profile_id' => $request->profile_id,
        ]);

        if($user){
            return redirect()->route('users.index')->with([
                'message' => 'Usuário criado com sucesso!',
                'alert-type' => 'success'
            ]);
        }
        
        return redirect()->back()->with([
            'message' => 'Erro ao cadastrar usuário',
            'alert-type' => 'error'
        ]);

    }

    public function edit($id)
    {

        $user = User::find($id);

        if($user){

        return view('users.create', compact('user'));

        }

        return redirect()->back()->with([
           'message' => 'Usuário não encontrado',
            'alert-type' => 'error'
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate( [
            'name' => 'string|max:255',
            'email' => 'string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'sometimes|nullable|string|min:8',
            'profile_id' => 'required',
        ],[
            'name.required' => 'O campo de Nome é obrigatório.',
            'name.max' => 'O Nome não pode ter mais de 255 caracteres.',
            'email.required' => 'O campo de Email é obrigatório.',
            'email.email' => 'O campo de Email precisa ter um email válido.',
            'email.unique' => 'Já existe um usuário cadastrado com esse email.',
            'password.required' =>'O campo de Senha é obrigatório.',
            'password.min' =>'O senha precisa ter pelomenos 8 caracteres.',
            'profile_id.required' => 'O campo de Perfil é obrigatório.',
            'profile_id.exists' => 'Esse Perfil não existe.',
        ]);

        if (!$request->has('password')) {
            $request->request->remove('password');
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'profile_id' => $request->profile_id,
        ]);

        if($user){
            return redirect()->route('users.index')->with([
                'message' => 'Usuário editado com sucesso!',
                'alert-type' => 'success'
            ]);
        }
        
        return redirect()->back()->with([
            'message' => 'Erro ao editar usuário',
            'alert-type' => 'error'
        ]);

    }

    public function destroy($id){

        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with([
           'message' => 'Usuário excluído com sucesso!',
            'alert-type' =>'success'
        ]);

    }
}
