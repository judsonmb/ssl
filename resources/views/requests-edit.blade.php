@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item"><a href="/requests">Solicitações</a></li>   
                    <li class="breadcrumb-item"><a href="#">{{ $request->title }}</a></li>   
                    <li class="breadcrumb-item active" aria-current="page">Editar</li>    
                </ol>
            </nav>  
            <div class="card">
                <div class="card-header">
                    Atualizar as informações da solicitação {{$request->title}} de {{ $request->user->name }}.    
                </div>
                <div class="card-body">
                    <form method="POST" action="/requests/{{ $request->id }}" enctype="multipart/form-data">
						@csrf
						@method('PUT')
						<div class="form-group">
							<label for="type">Tipo</label>
							<select class="form-control" name="type">
								<option value="{{ old('type') ?? $request->type }}">
									{{ old('type') ?? $request->type }}
								</option>
								<option value="bug">bug</option>
								<option value="new feature">new feature</option>
								<option value="improvement">improvement</option>
								<option value="request">request</option>
							</select>
							
							@error('type')
							<div class="error">{{ $message }}</div>
							@enderror
						</div>
						<div class="form-group">
							<label for="priority">Prioridade</label>
							<select class="form-control" name="priority">
								<option value="{{ old('priority') ?? $request->priority }}">
									{{ old('priority') ?? $request->priority }}
								</option>
								<option value="critical">critical</option>
								<option value="bigger">bigger</option>
								<option value="smaller">smaller</option>
								<option value="mild">mild</option>
							</select>
							
							@error('priority')
							<div class="error">{{ $message }}</div>
							@enderror
						</div>
						<div class="form-group">
							<label for="technician_id">Técnico Responsável</label>
							<select class="form-control" name="technician_id">
								<option value="{{ $request->technician_id ?? '' }}">
									{{ $request->technician->name ?? 'selecione...' }}
								</option>
								@foreach($technicians as $t)
									<option value="{{ $t->id }}">{{ $t->name }}</option>
								@endforeach
							</select>
							
							@error('technician_id')
							<div class="error">{{ $message }}</div>
							@enderror
						</div>
						<div class="form-group">
							<label for="deadline">Prazo</label>
							<input type="date" class="form-control" name="deadline" value="{{ $request->deadline ?? '' }}">
							
							@error('deadline')
							<div class="error">{{ $message }}</div>
							@enderror
						</div>
						<div class="form-group">
							<label for="status">Status</label>
							<select class="form-control" name="status">
								<option value="{{ old('status') ?? $request->status }}">
									{{ old('status') ?? $request->status }}
								</option>
								<option value="to do">to do</option>
								<option value="doing">doing</option>
								<option value="blocked">blocked</option>
								<option value="done">done</option>
							</select>
							
							@error('status')
							<div class="error">{{ $message }}</div>
							@enderror
						</div>
						<div class="form-group">
							<label for="function_points">Pontos de função</label>
							<input type="number" class="form-control" name="function_points" value="{{ old('function_points') ?? $request->function_points }}">
							
							@error('function_points')
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
						<button type="submit" class="btn btn-success" onclick="this.innerText ='Atualizando…';this.disabled=true;this.form.submit()">Atualizar</button>
						<a href="/requests"><button type="button" class="btn btn-secondary">Cancelar</button></a>
					</form>
                </div>
			</div>
    </div>
</div>

@endsection