@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item"><a href="/requests">Solicitações</a></li>   
                    <li class="breadcrumb-item active" aria-current="page">Criar</li>    
                </ol>
            </nav>  
            <div class="card">
                <div class="card-header">
                    Preencha o formulário para criar uma solicitação.
                </div>
                <div class="card-body">
                    <form method="POST" action="/requests" enctype="multipart/form-data">
						@csrf
						<div class="form-group">
							<label for="user">Solicitante (não preencha se for você)</label>
							<select class="form-control" name="user_id">
								<option value="">selecione...</option>
								@foreach($users as $u)
									<option value="{{ $u->id }}" 
									{{ (old('user_id') != null && old('user_id') == $u->id) ? 'selected' : '' }}>
									{{ $u->name }}
									</option>
								@endforeach
							</select>
							
							@error('user_id')
							<div class="error">{{ $message }}</div>
							@enderror
						</div>
						<div class="form-group">
							<label for="project">Projeto</label>
							<select class="form-control" name="project_id">
								<option value="">selecione...</option>
								@foreach($projects as $p)
									<option value="{{ $p->id }}" 
									{{ (old('project_id') != null && old('project_id') == $p->id) ? 'selected' : '' }}>
									{{ $p->name }}
									</option>
								@endforeach
							</select>
							
							@error('project_id')
							<div class="error">{{ $message }}</div>
							@enderror
						</div>
						<div class="form-group">
							<label for="title">Título</label>
							<input type="text" class="form-control" name="title" value="{{ old('title') }}">
							
							@error('title')
							<div class="error">{{ $message }}</div>
							@enderror						
						</div>
						<div class="form-group">
							<label for="requestDescription">Descrição</label>
							<textarea class="form-control" name="description" rows="3">{{ old('description') }}</textarea>
							
							@error('description')
							<div class="error">{{ $message }}</div>
							@enderror
						</div>
						<div class="form-group">
							<label for="requestFile">Anexar arquivo (não obrigatório)</label>
							<input type="file" class="form-control-file" id="requestFile" name="file">
						
							@error('file')
							<div class="error">{{ $message }}</div>
							@enderror
						</div>
						<button type="submit" class="btn btn-success" onclick="this.innerText ='Criando…';this.disabled=true;this.form.submit()">Criar</button>
						<a href="/requests"><button type="button" class="btn btn-secondary" >Cancelar</button></a>
					</form>
                </div>
			</div>
    </div>
</div>

@endsection