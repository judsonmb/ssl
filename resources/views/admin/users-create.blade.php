@extends('layouts.app-admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item"><a href="/users">Usuários</a></li>   
                    <li class="breadcrumb-item active" aria-current="page">Criar</li>    
                </ol>
            </nav>  
            <div class="card">
                <div class="card-header">
                    Preencha o formulário para criar um usuário.
                </div>
                <div class="card-body">
                    <form method="POST" action="/users">
						@csrf
						<div class="form-group">
							<label for="name">Nome</label>
							<input type="text" class="form-control" name="name" value="{{ old('name') }}">
							
							@error('name')
							<div class="error">{{ $message }}</div>
							@enderror						
						</div>
						<div class="form-group">
							<label for="email">E-mail</label>
							<input type="email" class="form-control" name="email" value="{{ old('email') }}">
							
							@error('email')
							<div class="error">{{ $message }}</div>
							@enderror		
						</div>
						<div class="form-group">
							<label for="type">Tipo</label>
							<select class="form-control" name="type">
								<option value="">selecione...</option>
								<option value="admin" 
									{{ (old('type') != null && old('type') == 'admin') ? 'selected' : '' }}>admin
								</option>
								<option value="main requester" 
									{{ (old('type') != null && old('type') == 'main requester') ? 'selected' : '' }}>
									main requester
								</option>
								<option value="requester" 
									{{ (old('type') != null && old('type') == 'requester') ? 'selected' : '' }}>
									requester
								</option>
							</select>
							
							@error('type')
							<div class="error">{{ $message }}</div>
							@enderror
						</div>
						<div class="form-group">
							<label for="institution">Instituição</label>
							<select class="form-control" name="institution_id">
								<option value="">selecione...</option>
								@foreach($institutions as $i)
									<option value="{{ $i->id }}" 
									{{ (old('institution_id') != null && old('institution_id') == $i->id) ? 'selected' : '' }}>
									{{ $i->initials }}
									</option>
								@endforeach
							</select>
							
							@error('institution_id')
							<div class="error">{{ $message }}</div>
							@enderror
						</div>
						<button type="submit" class="btn btn-success">Criar</button>
						<a href="/users"><button type="button" class="btn btn-secondary">Cancelar</button></a>
					</form>
                </div>
			</div>
    </div>
</div>

@endsection