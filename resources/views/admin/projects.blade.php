@extends('layouts.app-admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Projetos</li>    
                </ol>
            </nav>  
            <div class="card">
                <div class="card-header">
                    <a href="/projects/create">
						<button class="btn btn-xs btn-success">Criar</button>
					</a>  
                </div>
				<div style="text-align: center">
					Mostrando {{ $projects->count() }} registro(s). Total: {{ $projects->total() }}.
				</div>
                <div class="card-body">
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Nome</th>
                                <th scope="col">Instituição</th>
                                <th scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
							@foreach($projects as $p)
								<tr>
									<td>{{ $p->name }}</td>
									<td>{{ $p->institution->initials }}</td>
									<td>
										
										<form action="{{ route('projects.destroy', $p->id) }}" method="POST">
											@csrf
											@method('DELETE')
											<a href="/projects/{{$p->id}}/edit/"><button type="button" class="btn btn-xs btn-primary" title="editar"></button></a>
											<button type="submit" class="btn btn-xs btn-danger" onclick="return confirm('Você tem certeza que deseja excluir este projeto?')" title="excluir"></button>
										</form>	
									</td>							
								</tr>
							@endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
					{{ $projects->links() }}
                </div>
        </div>
    </div>
</div>

@endsection