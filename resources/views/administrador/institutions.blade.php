@extends('layouts.app-administrador')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Instituições</li>    
                </ol>
            </nav>  
            <div class="card">
                <div class="card-header">
                    <a href="/institutions/create">
						<button class="btn btn-xs btn-success">Criar</button>
					</a>  
                </div>
				<div style="text-align: center">
					Mostrando {{ $institutions->count() }} registro(s). Total: {{ $institutions->total() }}.
				</div>
                <div class="card-body">
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
								<th scope="col">Abreviação</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
							@foreach($institutions as $i)
								<tr>
									<td>{{ $i->initials }}</td>
									<td>{{ $i->name }}</td>
									<td>
										<form action="{{ route('institutions.destroy', $i->id) }}" method="POST">
											@csrf
											@method('DELETE')
											<a href="/institutions/{{$i->id}}/edit/"><button type="button" class="btn btn-xs btn-primary">Editar</button></a>
											<button type="submit" class="btn btn-xs btn-danger" onclick="return confirm('Você tem certeza que deseja excluir esta instituição?')">Excluir</button>
										</form>	
									</td>							
								</tr>
							@endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
					{{ $institutions->links() }}
                </div>
        </div>
    </div>
</div>

@endsection