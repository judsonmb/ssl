@extends('layouts.app-administrador')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Usuários</li>    
                </ol>
            </nav>  
            <div class="card">
                <div class="card-header">
                    <a href="/users/create">
						<button class="btn btn-xs btn-success">Criar</button>
					</a>  
                </div>
				<div style="text-align: center">
					Mostrando {{ $users->count() }} registro(s). Total: {{ $users->total() }}.
				</div>
                <div class="card-body">
                    <table class="table">
					
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Nome</th>
                                <th scope="col">E-mail</th>
                                <th scope="col">Instituição</th>
                                <th scope="col">Tipo</th>
                                <th scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
							@foreach($users as $u)
								<tr>
									<td>{{ $u->name }}</td>
									<td>{{ $u->email }}</td>	
									<td>{{ $u->institution->initials }}</td>	
									<td>{{ $u->type }}</td>	
									<td>	
										<form action="{{ route('users.destroy', $u->id) }}" method="POST">
											@csrf
											@method('DELETE')
											<a href="/users/{{$u->id}}/edit/"><button type="button" class="btn btn-xs btn-primary">Editar</button></a>
											<button type="submit" class="btn btn-xs btn-danger" onclick="return confirm('Você tem certeza que deseja desativar este usuário?')">Desativar</button>
										</form>	
									</td>							
								</tr>
							@endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
					{{ $users->links() }}
                </div>
        </div>
    </div>
</div>

@endsection