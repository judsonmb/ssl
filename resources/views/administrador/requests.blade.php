@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Solicitações</li>    
                </ol>
            </nav>  
            <div class="card">
                <div class="card-header" style="text-align: center;">
                    <a href="/requests/create" class="float-left">
						<button class="btn btn-xs btn-success">Criar</button>
					</a> 
					<span >
						Mostrando {{ $requests->count() }} registro(s). Total: {{ $requests->total() }}.
					</span>
                </div>
				
                <div class="card-body">
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
								<th scope="col">Título</th>
                                <th class="d-none d-md-table-cell" scope="col">Solicitante</th>
                                <th class="d-none d-md-table-cell" scope="col">Projeto</th>
                                <th class="d-none d-md-table-cell" scope="col">Prazo</th>
                                <th class="d-none d-md-table-cell" scope="col">Status</th>
                                <th scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
							@foreach($requests as $r)
								<tr>
									<td>{{ $r->title }}</td>
									<td class="d-none d-md-table-cell">{{ $r->user->name }}</td>
									<td class="d-none d-md-table-cell">{{ $r->project->name }}</td>
									<td class="d-none d-md-table-cell">{{ ($r->deadline != null) 
											? date('d/m/Y', strtotime($r->deadline)) 
											: 'Não definido' }}
									</td>
									<td class="d-none d-md-table-cell">{{ $r->status }}</td>
									<td>
										<form action="{{ route('requests.destroy', $r->id) }}" method="POST">
											@csrf
											@method('DELETE')
											<a href="/requests/{{$r->id}}/"><button type="button" class="btn btn-xs btn-secondary"><i class="fas fa-eye"></i></button></a>
											<a href="/requests/{{$r->id}}/edit/"><button type="button" class="btn btn-xs btn-primary"><i class="fas fa-pen"></i></button></a>
											<button type="submit" class="btn btn-xs btn-danger" onclick="return confirm('Você tem certeza que deseja excluir esta solicitação?')"><i class="fas fa-trash"></i></button>
										</form>	
									</td>							
								</tr>
							@endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
					{{ $requests->links() }}
                </div>
        </div>
    </div>
</div>

@endsection