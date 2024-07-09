@extends('layout')

@section('title', isset($profile) ? 'Editar Perfil' : 'Criar Perfil')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<link rel="stylesheet" href="{{ url('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
@endsection

@section('scripts')
<script>
    @if(Session::has('message'))
        var type = "{{ Session::get('alert-type', 'info') }}";
        switch(type){
            case 'success':
                toastr.success("{{ Session::get('message') }}");
                break;
            
            case 'error':
                toastr.error("{{ Session::get('message') }}");
                break;
        }
    @endif
</script>
@endsection

@section('content')
<div class="container mx-auto">
    <div class="row align-center justify-content-center">
        <div class="col-md-8">

            <div class="card card-outline card-primary" data-bs-theme="dark">
                <div class="card-header">
                    @if(isset($profile))
                    <form action="{{ route('profiles.update', ['id' => $profile->id]) }}" method="POST">
                        @method('PUT')
                    @else
                    <form action="{{ route('profiles.store') }}" method="POST">
                    @endif
                        @csrf
                        <div>
                            @if(isset($profile))
                            <h4 class="text-center"><b>Editar Perfil</b></h4>
                            @else
                            <h4 class="text-center"><b>Adicionar Perfil</b></h4>
                            @endif
                        </div>
                        <div class="row mt-1 form-group">
                            <div class="col">
                                <label for="name">Nome do Perfil</label>
                                <input type="text" class=" form-control @error('name') is-invalid @enderror" name="name" value="{{ isset($profile) ? $profile->name :  old('name')}}">
                                @error('name')<span class="error invalid-feedback">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        <label for="sites">Selecione os projetos que os usuários desse perfil terão permissão para alterar:</label>
                        @error('sites')
                        <br><span  class="pt-2 mb-1 text-danger">
                            <small>{{ $message }}</small>
                        </span>
                        @enderror
                        <div class="row ml-2" >
                            @foreach($sites as $site)
                            <div class="col-6">
                                <div class="icheck-primary">
                                    @if(isset($profile))
                                    <input type="checkbox" name="sites[]" {{$profile->sites->contains($site->id) ? 'checked' : '' }} id="{{ $site->id }}" value="{{ $site->id }}"/>
                                    @else
                                    <input type="checkbox" name="sites[]" {{ in_array($site->id, (array)old('sites')) ? 'checked' : '' }} id="{{ $site->id }}" value="{{ $site->id }}"/>
                                    @endif
                                    <label for="{{ $site->id }}"><small><b><span class="@error('sites') text-danger @enderror">{{ $site->name }}</span></b></small></label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        
                        <div class="row">
                            <div class="col">
                                @if(isset($profile))
                                <button type="submit" class="float-right btn btn-primary mt-3 ml-1">
                                    Salvar Alteração  <i class="fa fa-edit"></i>
                                </button>
                                @else
                                <button type="submit" class="float-right btn btn-primary mt-3 ml-1">
                                    Salvar   <i class="fa fa-save"></i>
                                </button>
                                @endif
                                <a href="{{ route('profiles.index') }}" type="button" class="float-right btn btn-secondary mt-3 ml-1">
                                    Voltar   <i class="fas fa-arrow-circle-left"></i>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

