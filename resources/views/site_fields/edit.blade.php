@extends('layout')

@section('content')
<div class="container">
    <h1>Editar Campo para {{ $site->name }}</h1>
    
    <form action="{{ route('site_fields.update', [$site->id, $field->id]) }}" method="POST">
        @csrf
        @method('PUT')
        
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

        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        <a href="{{ route('site_fields.manage', $site->id) }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection