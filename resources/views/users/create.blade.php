@extends('layout')

@section('title', isset($user) ? 'Editar Usuário' : 'Adicionar Usuário')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
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
                    @if(isset($user))
                    <form action="{{ route('users.update', ['id' => $user->id]) }}" method="POST">
                        @method('PUT')
                    @else
                    <form action="{{ route('users.store') }}" method="POST">
                    @endif
                        @csrf
                        <div>
                            @if(isset($user))
                            <h4 class="text-center"><b>Editar Usuário</b></h4>
                            @else
                            <h4 class="text-center"><b>Adicionar Usuário</b></h4>
                            @endif
                        </div>
                        <div class="row mt-1 form-group">
                            <div class="col">
                                <label for="name">Nome Completo</label>
                                <input type="text" class=" form-control @error('name') is-invalid @enderror" name="name" value="{{ isset($user) ? $user->name :  old('name')}}">
                                @error('name')<span class="error invalid-feedback">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="row mt-1 form-group">
                            <div class="col-md-6">
                                <label for="email">Email</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ isset($user) ? $user->email : old('email') }}">
                                @error('email')<span class="error invalid-feedback">{{ $message }}</span>@enderror
                            </div>
                            <div class="col-md-6">
                                <label for="password">Senha</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password">
                                @error('password')<span class="error invalid-feedback">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="profile_id">Perfil</label>
                            <select class="form-control select @error('profile_id') is-invalid @enderror" style="width: 100%;" name="profile_id">
                                <option disabled selected>Selecione o perfil</option>
                                @foreach($profiles as $profile)
                                    <option value="{{ $profile->id }}" {{ old('profile_id', isset($user) ? $user->profile_id : '') == $profile->id ? 'selected' : '' }}>
                                        {{ $profile->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('profile_id')<span class="error invalid-feedback">{{ $message }}</span>@enderror
                        </div>
                        
                        <div class="row">
                            <div class="col">
                                @if(isset($user))
                                <button type="submit" class="float-right btn btn-primary mt-3 ml-1">
                                    Salvar Alteração  <i class="fa fa-edit"></i>
                                </button>
                                @else
                                <button type="submit" class="float-right btn btn-primary mt-3 ml-1">
                                    Salvar   <i class="fa fa-save"></i>
                                </button>
                                @endif
                                <a href="{{ route('users.index') }}" type="button" class="float-right btn btn-secondary mt-3 ml-1">
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

