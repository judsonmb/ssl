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
                <div class="card-header">
                    <a href="/requests/create">
						<button class="btn btn-xs btn-success">Criar</button>
					</a>  
                </div>
				<div style="text-align: center">
					Mostrando {{ $requests->count() }} registro(s). Total: {{ $requests->total() }}.
				</div>
                <div class="card-body">
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
								<th scope="col">Título</th>
                                <th scope="col">Solicitante</th>
                                <th scope="col">Projeto</th>
                                <th scope="col">Prazo</th>
                                <th scope="col">Status</th>
                                <th scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
							@foreach($requests as $r)
								<tr>
									<td>{{ $r->title }}</td>
									<td>{{ $r->user->name }}</td>
									<td>{{ $r->project->name }}</td>
									<td>{{ ($r->deadline != null) 
											? date('d/m/Y', strtotime($r->deadline)) 
											: 'Não definido' }}
									</td>
									<td>{{ $r->status }}</td>
									<td>
										<a href="/requests/{{$r->id}}/"><button type="button" class="btn btn-xs btn-secondary">Ver Detalhes</button></a>		
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