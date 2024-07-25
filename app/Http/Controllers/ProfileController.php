<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Site;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $profiles = Profile::paginate(15);

        return view('profiles.index', compact('profiles'));
    }

    public function create()
    {
        $sites = Site::all();

        if($sites->isEmpty()){
            return redirect()->route('profiles.index')->with([
                'message' => 'É necessário adicionar um site antes.',
                'alert-type' => 'error']);
        }

        return view('profiles.create', compact('sites'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'sites' => 'required|array', // Certifica-se de que 'sites' é um array
        ],[
            'name.required' => 'O campo de Nome é obrigatório.',
            'name.string' => 'O campo de Nome precisa ser um texto.',
            'name.max' => 'O Nome não pode ter mais de 255 caracteres.',
            'sites.required' => 'Você precisa escolher ao menos um site.',
            'sites.array' => 'O campo de Sites precisa ser um array.',
        ]);

        $profile = Profile::create([
            'name' => $request->name,
        ]);

        $profile->sites()->sync($request->sites);

        return redirect()->route('profiles.index')->with([
            'message' => 'Perfil criado com sucesso!',
            'alert-type' => 'success'
        ]);
    }

    public function edit($id)
    {
        if ($id == 1) {
            return redirect()->route('profiles.index')->with([
                'message' => 'Esse perfil não pode ser editado.',
                'alert-type' => 'error'
            ]);
        }

        $profile = Profile::with('sites')->findOrFail($id);
        $sites = Site::all();

        if($profile){

        return view('profiles.create', compact('profile', 'sites'));

        }

        return redirect()->back()->with([
           'message' => 'Perfil não encontrado',
            'alert-type' => 'error'
        ]);
    }

    public function update(Request $request, $id)
    {
        if ($id == 1) {
            return redirect()->route('profiles.index')->with([
                'message' => 'Esse perfil não pode ser editado.',
                'alert-type' => 'error'
            ]);
        }

        $profile = Profile::findOrFail($id);

        $request->validate([
            'name' => 'sometimes|string|max:255',
            'sites' => 'sometimes|array',
            'sites.*' => 'exists:sites,id',
        ]);

        $profile->update($request->only('name'));

        if ($request->has('sites')) {
            $profile->sites()->sync($request->sites);
        } else {
            $profile->sites()->sync([]);
        }

        return redirect()->route('profiles.index')->with([
            'message' => 'Perfil atualizado com sucesso!',
            'alert-type' => 'success'
        ]);
    }

    public function destroy($id)
    {
        if ($id == 1) {
            return redirect()->route('profiles.index')->with([
                'message' => 'Esse perfil não pode ser excluido.',
                'alert-type' => 'error'
            ]);
        }

        $profile = Profile::findOrFail($id);

        if ($profile->users()->count() > 0) {
            return redirect()->back()->with([
                'message' => 'Este perfil não pode ser deletado porque há usuários associados a ele.',
                'alert-type' => 'error'
            ]);
        }

        $profile->sites()->detach();

        $profile->delete();

        return redirect()->route('profiles.index')->with([
            'message' => 'Perfil deletado com sucesso!',
            'alert-type' => 'success'
        ]);
    }

    public function getUsers($id)
    {
        $profile = Profile::findOrFail($id);
        $users = $profile->users;

        return response()->json($users);
    }
}
