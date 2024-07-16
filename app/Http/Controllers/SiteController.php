<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Site;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index()
    {
        $sites = Site::paginate(15);

        return view('sites.index', compact('sites'));
    }

    public function show($id)
    {
        $site = Site::with(['profiles', 'fields.contents'])->findOrFail($id);
        Gate::authorize('view', $site);
        return view('sites.show', compact('site'));
    }

    public function details($id)
    {
        $site = Site::with('profiles')->findOrFail($id);

        return response()->json($site);
    }

    public function create()
    {
        return view('sites.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'description' => 'sometimes',
        ],[
            'name.required' => 'O campo de Nome é obrigatório.',
            'name.string' => 'O campo de Nome precisa ser um texto.',
            'name.max' => 'O Nome não pode ter mais de 255 caracteres.',
            'url.required' => 'O campo de URL é obrigatório.',
            'url.string' => 'O campo de URL precisa ser um texto.',
            'url.max' => 'A URL não pode ter mais de 255 caracteres.',
            'description.string' => 'O campo de Dercrição precisa ser uma string.',
        ]);

        $site = Site::create($request->all());
        $profile = Profile::find(1);
        if ($profile) {
            $site->profiles()->attach($profile);
        }

        if(isset($site)){
            return redirect()->route('sites.index')->with([
                'message' => 'Site adicionado com sucesso!',
                'alert-type' => 'success'
            ]);
        }

        return redirect()->route('sites.index')->with([
            'message' => 'Erro ao adicionar site.',
            'alert-type' => 'error'
        ]);

        
    }

    public function edit($id)
    {

        $site = Site::findOrFail($id);
        
        if($site){

        return view('sites.create', compact('site'));

        }

        return redirect()->back()->with([
           'message' => 'Site não encontrado',
            'alert-type' => 'error'
        ]);
    }

    public function update(Request $request, $id)
    {
        $site = Site::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'description' => 'sometimes',
        ],[
            'name.required' => 'O campo de Nome é obrigatório.',
            'name.string' => 'O campo de Nome precisa ser um texto.',
            'name.max' => 'O Nome não pode ter mais de 255 caracteres.',
            'url.required' => 'O campo de URL é obrigatório.',
            'url.string' => 'O campo de URL precisa ser um texto.',
            'url.max' => 'A URL não pode ter mais de 255 caracteres.',
            'description.string' => 'O campo de Dercrição precisa ser uma string.',
        ]);

        $site->update($request->all());

        return redirect()->route('sites.index')->with([
            'message' => 'Site atualizado com sucesso!',
            'alert-type' => 'success'
        ]);
    }

    public function destroy($id)
    {
        $site = Site::findOrFail($id);

        $site->delete();

        return redirect()->route('sites.index')->with([
            'message' => 'Site deletado com sucesso!',
            'alert-type' => 'success'
        ]);
    }

}
