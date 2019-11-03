@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item"><a href="/projects">Projetos</a></li>   
                    <li class="breadcrumb-item"><a href="#">{{ $project->name }}</a></li>   
                    <li class="breadcrumb-item active" aria-current="page">Editar</li>    
                </ol>
            </nav>  
            <div class="card">
                <div class="card-header">
                    Edite as informações de {{ $project->name }}.
                </div>
                <div class="card-body">
                    <form method="POST" action="/projects/{{ $project->id }}">
						@csrf
						@method('PUT')
						<div class="form-group">
							<label for="name">Nome</label>
							<input type="text" class="form-control" name="name" value="{{ old('name') ?? $project->name }}">
							
							@error('name')
							<div class="error">{{ $message }}</div>
							@enderror						
						</div>
						
						<div class="form-group">
							<label for="institution">Instituição</label>
							<select class="form-control" name="institution_id">
								<option value="{{ old('institution_id') ?? $project->institution_id }}">
									{{ old('institution_id') ?? $project->institution->initials }}
								</option>
								@foreach($institutions as $i)
									<option value="{{ $i->id }}">{{ $i->initials }}</option>
								@endforeach
							</select>
							
							@error('institution_id')
							<div class="error">{{ $message }}</div>
							@enderror
						</div>
						<button type="submit" class="btn btn-success">Atualizar</button>
						<a href="/projects"><button type="button" class="btn btn-secondary">Cancelar</button></a>
					</form>
                </div>
			</div>
    </div>
</div>

@endsection