@extends('layouts.app')

@section('content')
<div class="container">
		<form class="form-inline" method="POST" action="home">
			@csrf
			<div class="form-group mx-sm-3 mb-2">
				<input type="month" class="form-control" name="month" value='{{ $year }}-{{$month}}'>
			</div>
			<button type="submit" class="btn btn-primary mb-2">Alterar mês</button>
		</form>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Dashboard</div>
					<div class="card-body">
						@if(!(!$functionPoints and !$functionPointsByProject->count() and 
						!$totalRequests and !$totalRequestsByProject->count() and 
						!$totalRequestsByUser->count() and !$requestsByType->count() and 
						!$requestsByPriority->count() and !$requestsByDelivery->count()))
						<ul class="list-group">
							
							<li class="list-group-item">
								<strong>
									Requisições criadas: {{ $totalRequests }}
								</strong>
							</li>

							<li class="list-group-item">
								<strong>
									Pontos de função usados (apenas requisições feitas): {{ $functionPoints }}
								</strong>
								<br>
									por projeto:
								<br>
								@foreach($functionPointsByProject as $f)
									- {{ $f->project->name }}: {{ $f->sum }}<br>
								@endforeach
							</li>	

							<li class="list-group-item">
								<strong>
									Requisições por projeto:
								</strong>
								<br>                     
								@foreach($totalRequestsByProject as $p)
									- {{ $p->project->name }}: {{ $p->sum }}<br>
								@endforeach
							</li>						
							
							<li class="list-group-item">
								<strong>
									Requisições por usuário:
								</strong>
								<br>                     
								@foreach($totalRequestsByUser as $u)
									- {{ $u->user->name }}: {{ $u->sum }}<br>
								@endforeach
							</li>

						
							<li class="list-group-item">
								<strong>
									Requisições por tipo:
								</strong>
								<br>
								@foreach($requestsByType as $t)
									@if($t->type == null)
										- Não definido: {{ $t->sum }}<br>
									@else
										- {{ $t->type }}: {{ $t->sum }}<br>
									@endif
								@endforeach
							</li>

							<li class="list-group-item">
								<strong>
									Requisições por prioridade:
								</strong>
								<br>
								@foreach($requestsByPriority as $p)
									@if($p->priority == null)
										- Não definido: {{ $p->sum }}<br>
									@else
										- {{ $p->priority }}: {{ $p->sum }}<br>
									@endif
								@endforeach
							</li>

							<li class="list-group-item">
								<strong>
									Requisições por entrega:
								</strong>
								<br>
								@foreach($requestsByDelivery as $d)
									@if($d->delivered == null)
										- Não definido: {{ $d->sum }}<br>
									@else
										- {{ $d->delivered }}: {{ $d->sum }}<br>
									@endif
								@endforeach
							</li>
						</ul>
						@else
							<p style="text-align: center;">Nenhum registro encontrado.</p>
						@endif
					</div>
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
										{{$r->user->name}}
											<small>{{date('d/m/Y H:i:s', strtotime($r->created_at))}}</small>
										</div>
										<h4><p class="mb-1">{{$r->message}}</p></h4>
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

