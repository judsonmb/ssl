@extends($layout)

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
		<div class="col-md-6">    
            <div class="card">
                <div class="card-header">
					<h5>Informações</h5>
                </div>
                <div class="card-body">
                    Título: {{ $request->title }}<br><br>
                    Descrição: {{ $request->description }}<br><br>
                    Enviada por: {{ $request->user->name }}<br>
                    Em: {{ date('d/m/Y H:i:s', strtotime($request->created_at)) }}<br><br>
                    
					
					Prazo: {{ ($request->deadline != null) 
								? date('d/m/Y', strtotime($request->deadline)) 
								: 'Ainda não definido' }}<br><br>
					
					Técnico responsável: {{ (isset($request->technician->name)) ? $request->technician->name : "Ainda não definido"}}<br>
					Tipo: {{ $request->type }}<br>
					Prioridade: {{ $request->priority }}<br>
					Pontos de função: {{ $request->function_points }}<br>
					Status: {{ $request->status }}<br>
					Entrega: {{ $request->delivered }}<br><br>
					
					Arquivos:<br>
					
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
										<h5 class="mb-1">{{$r->user->name}}</h5>
											<small>{{date('d/m/Y H:i:s', strtotime($r->action_datetime))}}</small>
										</div>
										<p class="mb-1">{{$r->message}}</p>
										<small>solicitação: {{$r->request->title}} feita por {{$r->request->user->name}}</small>
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