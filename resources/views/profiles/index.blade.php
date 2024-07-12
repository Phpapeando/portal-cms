@extends('layout')

@section('title', 'Perfil de Usuário')

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
<script>
  $(document).ready(function() {
      $('#usersModal').on('show.bs.modal', function(event) {
          var button = $(event.relatedTarget);
          var profileId = button.data('profile-id');
          var modal = $(this);
          var usersList = modal.find('#usersList');

          // Limpar a lista de usuários
          usersList.empty();

          // Fazer uma requisição AJAX para obter os usuários do perfil
          $.ajax({
              url: '/profiles/' + profileId + '/users', // Rota para obter os usuários do perfil
              method: 'GET',
              success: function(data) {
                  if (data.length > 0) {
                      data.forEach(function(user) {
                          usersList.append('<li class="list-group-item">' + user.name + ' (' + user.email + ')</li>');
                      });
                  } else {
                      usersList.append('<li class="list-group-item">Nenhum usuário encontrado.</li>');
                  }
              },
              error: function() {
                  usersList.append('<li class="list-group-item">Erro ao carregar os usuários.</li>');
              }
          });
      });
  });
</script>
@endsection

@section('content')
<div class="container mx-auto">
    <div class="row align-center justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header">
                    <div class="col">
                    <h3 class="card-title mt-2"><b>Perfis de Usuário</b></h3>
                  
                    <a href="{{ route('profiles.create') }}" class="btn btn-primary float-right"><i class="fas fa-plus"></i>  Adicionar Perfil de Usuário</a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    @forelse($profiles as $profile)
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Nome</th>
                                <th style="width: 220px">Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{ $profile->id }}</td>
                                <td>{{ $profile->name }}</td>
                                <td class="text-center">
                                <a href="#" class="btn btn-sm btn-info" data-toggle="modal" data-target="#usersModal" data-profile-id="{{ $profile->id }}">Exibir Usuários  <i class="fas fa-user"></i></a>
                                <a href="{{ route('profiles.edit', $profile->id) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('profiles.destroy', $profile->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja deletar este perfil?');" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                </form>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    @empty
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">Não há perfis cadastrados.</th>
                                </tr>
                            </thead>
                        </table>
                    @endforelse
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                  {{ $profiles->links() }}
                </div>
              </div>

        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="usersModal" tabindex="-1" role="dialog" aria-labelledby="usersModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="usersModalLabel">Usuários do Perfil</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              <ul id="usersList" class="list-group">
                  <!-- Os usuários serão carregados aqui -->
              </ul>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          </div>
      </div>
  </div>
</div>


@endsection