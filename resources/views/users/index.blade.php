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

    $('#deleteUserModal').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget);
      var userId = button.data('user-id');
      var modal = $(this);
      modal.find('#deleteForm').attr('action', '/users/' + userId);
  });
</script>
@endsection

@section('content')
<div class="container mx-auto">
    <div class="row align-center justify-content-center">
        <div class="col-md-8">

          <div class="card card-outline card-info" data-bs-theme="dark">
                <div class="card-header">
                    <div class="col">
                    <h3 class="card-title mt-2"><b>Usuários</b></h3>
                  
                    <a href="{{ route('users.create') }}" class="btn btn-primary float-right"><i class="fas fa-plus"></i>  Adicionar Usuário</a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  @if(isset($users) && !$users->isEmpty())
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
                      @foreach($users as $user)
                      <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td class="text-center">
                          <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                          <button class="btn btn-sm btn-danger {{ Auth::user()->id == $user->id ? 'disabled' : '' }}" data-toggle="modal" data-target="#deleteUserModal" data-user-id="{{ $user->id }}"><i class="fas fa-trash"></i></button>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                  @else
                    <ul id="usersList" class="list-group">
                      <li class="list-group-item">Nenhum usuário cadastrado.</li>
                    </ul>
                  @endif
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                  {{ $users->links() }}
                </div>
              </div>

        </div>
    </div>
</div>

<div class="modal fade" id="deleteUserModal" tabindex="-1" role="dialog" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="deleteUserModalLabel">Excluir Usuário</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <p>Tem certeza de que deseja excluir este usuário?</p>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              <form id="deleteForm" action="" method="POST" style="display:inline;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger">Excluir</button>
              </form>
          </div>
      </div>
  </div>
</div>

@endsection