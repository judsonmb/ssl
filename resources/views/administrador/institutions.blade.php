@extends('layouts.app')

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
                <div class="card-header" style="text-align: center;">
                    <a href="/institutions/create" class="float-left">
						<button class="btn btn-xs btn-success">Criar</button>
					</a> 
					<span >
						Mostrando {{ $institutions->count() }} registro(s). Total: {{ $institutions->total() }}.
					</span>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
								<th scope="col">Abreviação</th>
                                <th class="d-none d-md-table-cell" scope="col">Nome</th>
                                <th scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
							@foreach($institutions as $i)
								<tr>
									<td>{{ $i->initials }}</td>
									<td class="d-none d-md-table-cell">{{ $i->name }}</td>
									<td>
										<form action="{{ route('institutions.destroy', $i->id) }}" method="POST">
											@csrf
											@method('DELETE')
											<a href="/institutions/{{$i->id}}/edit/"><button type="button" class="btn btn-xs btn-primary"><i class="fas fa-pen"></i></button></a>
											<button type="submit" class="btn btn-xs btn-danger" onclick="return confirm('Você tem certeza que deseja excluir esta instituição?')"><i class="fas fa-trash"></i></button>
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