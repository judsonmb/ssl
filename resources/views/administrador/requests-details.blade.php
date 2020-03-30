@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
			<nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
					<li class="breadcrumb-item"><a href="/requests">Solicitações</a> - {{ $request->title }}</li>
                    <li class="breadcrumb-item active" aria-current="page">Detalhes</li>    
                </ol>
            </nav> 
		</div>
		<div class="col-md-2">
			<a href="/requests/{{$request->id}}/edit/">
				<button type="button" class="btn btn-xs btn-primary">
					<i class="fas fa-pen"></i><
				</button>
			</a>
		</div>
		<div class="col-md-10">
			<form method="POST" action="/requests/{{ $request->id }}/message">
				@csrf
				<div class="row">
					<div class="col-md-8">
						<input placeholder="escreva uma mensagem..." type="text" class="form-control" name="message" value="{{ old('message') }}">
					</div>
					<div class="col-md-2">
						<button type="submit" class="btn btn-primary mb-2">Enviar</button>
					</div>
					@error('message')
						<div class="error">{{ $message }}</div>
					@enderror
				</div>
			</form>
		</div>
		<div class="col-md-6">    
            <div class="card">
                <div class="card-header">
					<h5>Informações</h5>
                </div>
                <div class="card-body">
                    <strong>Título</strong>: {{ $request->title }}<br><br>
                    <strong>Descrição</strong>: {{ $request->description }}<br><br>
                    <strong>Enviada por</strong>: {{ $request->user->name }}<br>
                    <strong>Em</strong>: {{ date('d/m/Y H:i:s', strtotime($request->created_at)) }}<br><br>
                    
					
					<strong>Prazo</strong>: {{ ($request->deadline != null) 
								? date('d/m/Y', strtotime($request->deadline)) 
								: 'Ainda não definido' }}<br><br>
					
					<strong>Técnico responsável</strong>: {{ (isset($request->technician->name)) ? $request->technician->name : "Ainda não definido"}}<br>
					<strong>Tipo</strong>: {{ $request->type }}<br>
					<strong>Prioridade</strong>: {{ $request->priority }}<br>
					<strong>Pontos de função</strong>: {{ $request->function_points }}<br>
					<strong>Status</strong>: {{ $request->status }}<br>
					<strong>Entrega</strong>: {{ $request->delivered }}<br><br>
					
					<strong>Arquivos</strong>:<br>
					
					@foreach($files as $f)
						- <a href="/download/{{$f->name}}">{{$f->name}}</a><br>
					@endforeach
                </div>
			</div>
		</div>
		<div class="col-md-6">    
            <div class="card">
                <div class="card-header">
					<h5>Histórico</h5>
                </div>
                <div class="card-body">
                    @if($historics->count())
							<div class="list-group">
								@foreach($historics as $r)
									<a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
										<div class="d-flex w-100 justify-content-between">
										{{$r->user->name}}
											<small>{{date('d/m/Y H:i:s', strtotime($r->created_at))}}</small>
										</div>
										<h4><p class="mb-1">{{$r->message}}</p></h4>
									</a>
									<hr>
								@endforeach
							</div> 
						@else
							<p style="text-align: center;">Nenhum registro encontrado.</p>
						@endif
                </div>
			</div>
		</div>
	</div>
</div>

@endsection