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
                    @if(isset($site))
                    <form action="{{ route('sites.update', ['id' => $site->id]) }}" method="POST">
                        @method('PUT')
                    @else
                    <form action="{{ route('sites.store') }}" method="POST">
                    @endif
                        @csrf
                        <div>
                            @if(isset($site))
                            <h4 class="text-center"><b>Editar Site</b></h4>
                            @else
                            <h4 class="text-center"><b>Adicionar Site</b></h4>
                            @endif
                        </div>
                        
                        <div class="col">
                            <label for="name">Nome:</label>
                            <input type="text" class=" form-control @error('name') is-invalid @enderror" name="name" value="{{ isset($site) ? $site->name :  old('name')}}">
                            @error('name')<span class="error invalid-feedback">{{ $message }}</span>@enderror
                        </div>
                        
                        <div class="col">
                            <label for="url">URL:</label>
                            <input type="text" class="form-control @error('url') is-invalid @enderror" name="url" value="{{ isset($site) ? $site->url : old('url') }}">
                            @error('url')<span class="error invalid-feedback">{{ $message }}</span>@enderror
                        </div>
                        <div class="col">
                            <label for="description">Descrição <small>(Opcional):</small></label>
                            <textarea rows="5" class="form-control @error('description') is-invalid @enderror" name="description">{{ isset($site) ? $site->description : old('description') }}</textarea>
                            @error('description')<span class="error invalid-feedback">{{ $message }}</span>@enderror
                        </div>
                    
                        <div class="row">
                            <div class="col">
                                @if(isset($site))
                                <button type="submit" class="float-right btn btn-primary mt-3 ml-1">
                                    Salvar Alteração  <i class="fa fa-edit"></i>
                                </button>
                                @else
                                <button type="submit" class="float-right btn btn-primary mt-3 ml-1">
                                    Salvar   <i class="fa fa-save"></i>
                                </button>
                                @endif
                                <a href="{{ route('sites.index') }}" type="button" class="float-right btn btn-secondary mt-3 ml-1">
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

