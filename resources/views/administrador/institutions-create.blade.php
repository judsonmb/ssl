@extends('layouts.app-administrador')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item"><a href="/institutions">Instituições</a></li>   
                    <li class="breadcrumb-item active" aria-current="page">Criar</li>    
                </ol>
            </nav>  
            <div class="card">
                <div class="card-header">
                    Preencha o formulário para criar uma instituição.
                </div>
                <div class="card-body">
                    <form method="POST" action="/institutions">
						@csrf
						<div class="form-group">
							<label for="initials">Abreviação</label>
							<input type="text" class="form-control" name="initials" value="{{ old('initials') }}">
							
							@error('initials')
							<div class="error">{{ $message }}</div>
							@enderror						
						</div>
						<div class="form-group">
							<label for="name">Nome</label>
							<input type="text" class="form-control" name="name" value="{{ old('name') }}">
							
							@error('name')
							<div class="error">{{ $message }}</div>
							@enderror						
						</div>
						<button type="submit" class="btn btn-success">Criar</button>
						<a href="/institutions"><button type="button" class="btn btn-secondary">Cancelar</button></a>
					</form>
                </div>
			</div>
    </div>
</div>

@endsection