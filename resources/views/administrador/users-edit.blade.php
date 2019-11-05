@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item"><a href="/users">Usuários</a></li>   
                    <li class="breadcrumb-item"><a href="#">{{ $user->name }}</a></li>   
                    <li class="breadcrumb-item active" aria-current="page">Editar</li>    
                </ol>
            </nav>  
            <div class="card">
                <div class="card-header">
                    Edite as informações de {{ $user->name }}.
                </div>
                <div class="card-body">
                    <form method="POST" action="/users/{{ $user->id }}">
						@csrf
						@method('PUT')
						<div class="form-group">
							<label for="name">Nome</label>
							<input type="text" class="form-control" name="name" value="{{ old('name') ?? $user->name }}">
							
							@error('name')
							<div class="error">{{ $message }}</div>
							@enderror						
						</div>
						<div class="form-group">
							<label for="email">E-mail</label>
							<input type="email" class="form-control" name="email" value="{{ old('email') ?? $user->email }}">
							
							@error('email')
							<div class="error">{{ $message }}</div>
							@enderror		
						</div>
						<div class="form-group">
							<label for="type">Tipo</label>
							<select class="form-control" name="type">
								<option value="{{ old('type') ?? $user->type }}">
									{{ old('type') ?? $user->type }}
								</option>
								<option value="administrador">administrador</option>
								<option value="parceiro">parceiro</option>
								<option value="solicitante">solicitante</option>
							</select>
							
							@error('type')
							<div class="error">{{ $message }}</div>
							@enderror
						</div>
						<div class="form-group">
							<label for="institution">Instituição</label>
							<select class="form-control" name="institution_id">
								<option value="{{ old('institution_id') ?? $user->institution_id }}">
									{{ old('institution_id') ?? $user->institution->initials }}
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
						<a href="/users"><button type="button" class="btn btn-secondary">Cancelar</button></a>
					</form>
                </div>
			</div>
    </div>
</div>

@endsection