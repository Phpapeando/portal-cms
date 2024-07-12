@extends('layout')

@section('content')
<div class="container">
    <h1>Gerenciar Campos para {{ $site->name }}</h1>
    <a href="{{ route('site_fields.create', $site->id) }}" class="btn btn-primary mb-3">Adicionar Campo</a>

    @if($site->fields->isEmpty())
        <p>Não há campos adicionados a este site.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Campo</th>
                    <th>Tipo</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($site->fields as $field)
                    <tr>
                        <td>{{ $field->field_name }}</td>
                        <td>{{ $field->field_type }}</td>
                        <td>
                            <a href="{{ route('site_fields.edit', [$site->id, $field->id]) }}" class="btn btn-sm btn-warning">Editar</a>
                            <form action="{{ route('site_fields.destroy', [$site->id, $field->id]) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Remover</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
