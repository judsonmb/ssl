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
                    <li class="breadcrumb-item active" aria-current="page">Detalhes</li>    
                </ol>
            </nav>  
            <div class="card">
                <div class="card-header">
					<h5>Enviada por {{ $request->user->name }} em {{ date('d/m/Y H:i:s', strtotime($request->created_at)) }}</h5>
					<h2>{{ $request->title }}</h2><br>
					<h4>{{ $request->description }}</h4>
                </div>
                <div class="card-body">
                    Prazo: {{ ($request->deadline != null) ? date('d/m/Y', strtotime($request->deadline)) : 'Ainda não definido' }}<br><br>
					
					Técnico responsável: {{$request->technician->name}}<br>
					Tipo: {{ $request->type }}<br>
					Prioridade: {{ $request->priority }}<br>
					Pontos de função: {{ $request->function_points }}<br>
					Status: {{ $request->status }}<br>
					Entrega: {{ $request->delivered }}<br>
				
                </div>
			</div>
    </div>
</div>

@endsection