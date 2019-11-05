@extends('layouts.app-administrador')

@section('content')
<div class="container">
        <h5>Mês/Ano corrente: {{date('m/Y')}}</h5>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Dashboard</div>
                    <ul class="list-group">
                        <li class="list-group-item">
							<strong>
								Pontos de função usados (apenas requisições feitas): {{ $functionPoints }}
							</strong>
						</li>
							@if($functionPointsByProject->count())
								<li class="list-group-item">Por projeto:<br>
									@foreach($functionPointsByProject as $f)
										- {{ $f->project->name }}: {{ $f->sum }}<br>
									@endforeach
								</li>
							@endif
                        <li class="list-group-item">
                            <strong>
                                Requisições criadas: {{ $totalRequests }}
                            </strong>
							@if($totalRequestsByUser->count())
								<li class="list-group-item">Por usuário:<br>                           
								@foreach($totalRequestsByUser as $u)
									- {{ $u->user->name }}: {{ $u->sum }}<br>
								@endforeach
							@endif
                        </li>
                        <li class="list-group-item"><strong>Requisições por tipo:</strong>
							@if($requestsByType->count())	
								<br>
								@foreach($requestsByType as $t)
									@if($t->type == null)
									   - Não definido: {{ $t->sum }}<br>
									@else
									   - {{ $t->type }}: {{ $t->sum }}<br>
									@endif
								@endforeach
							@else
								<strong>0</strong>
							@endif
                        </li>
                        <li class="list-group-item"><strong>Requisições por prioridade:</strong>
                            @if($requestsByPriority->count())
								<br>
								@foreach($requestsByPriority as $p)
									@if($p->priority == null)
										- Não definido: {{ $t->sum }}<br>
									 @else
										- {{ $p->priority }}: {{ $t->sum }}<br>
									@endif 
								@endforeach
							@else
								<strong>0</strong>
							@endif
                        </li>
                        <li class="list-group-item"><strong>Requisições por entrega:</strong>
							@if($requestsByPriority->count())
								<br>
								@foreach($requestsByDelivery as $d)
										- {{ $d->delivered }}: {{ $t->sum }}<br>
								@endforeach
							@else
								<strong>0</strong>
							@endif
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Feed de notícias</div>
                    <div class="card-body">
						@if($requestHistorics->count())
							<div class="list-group">
								@foreach($requestHistorics as $r)
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
</div>
@endsection
