@extends('layout')

@section('title', 'Usuários')

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

            <div class="card">
                <div class="card-header">
                    <div class="col">
                    <h3 class="card-title mt-2"><b>Usuários</b></h3>
                  
                    <a href="{{ route('users.create') }}" class="btn btn-primary float-right"><i class="fas fa-plus"></i>  Adicionar Usuário</a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  @forelse($users as $user)
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th style="width: 10px">#</th>
                          <th>Nome</th>
                          <th>Email</th>
                          <th style="width: 93px">Ações</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>{{ $user->id }}</td>
                          <td>{{ $user->name }}</td>
                          <td>{{ $user->email }}</td>
                          <td class="text-center">
                              <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja deletar este usuário?');">
                                @csrf
                                @method('DELETE')
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                <button class="btn btn-sm btn-danger" type="submit"><i class="fas fa-trash"></i></button>
                            </form>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  @empty
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th class="text-center">Não há usuários cadastrados.</th>
                      </tr>
                    </thead>
                  </table>
                  @endforelse
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                  {{ $users->links() }}
                </div>
              </div>

        </div>
    </div>
</div>


@endsection