@extends('layout')

@section('title', 'Editar Campo: '.$site->name)

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
                    <form action="{{ route('site_fields.update', [$site->id, $field->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <h4 class="text-center"><b>Editar Campo: </b></h4>
                        <div class="form-group">
                            <label for="field_name">Nome do Campo</label>
                            <input type="text" name="field_name" id="field_name" class="form-control" value="{{ old('field_name', $field->field_name) }}" required>
                        </div>
                
                        <div class="form-group">
                            <label for="field_type">Tipo do Campo</label>
                            <select name="field_type" id="field_type" class="form-control" required>
                                <option value="text" {{ $field->field_type == 'text' ? 'selected' : '' }}>Texto</option>
                                <option value="textarea" {{ $field->field_type == 'textarea' ? 'selected' : '' }}>Área de Texto</option>
                                <option value="image" {{ $field->field_type == 'image' ? 'selected' : '' }}>Imagem</option>
                                <!-- Adicione outros tipos de campo conforme necessário -->
                            </select>
                        </div>
                
                        <div class="row">
                            <div class="col">
                                <button type="submit" class="float-right btn btn-primary mt-3 ml-1">
                                    Salvar   <i class="fa fa-save"></i>
                                </button>
                                <a href="{{ route('sites.show', $site->id) }}" type="button" class="float-right btn btn-secondary mt-3 ml-1">
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