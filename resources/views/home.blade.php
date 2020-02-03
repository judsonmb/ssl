@extends('layouts.app')

@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">Bloqueadas</div>
					<div class="card-body">
						<ul class="list-group">
							@foreach($blocked as $b)
							<a href="/requests/{{$b->id}}/" class="list-group-item list-group-item-action flex-column align-items-start">
								<h5>
									<p class="mb-1">{{$b->title}}</p>
								</h5>
								<small>Responsável: {{ (isset($b->technician->name)) ? $b->technician->name : "Ainda não definido"}}</small>
							</a>
							<br>
							@endforeach
						</ul>	
					</div>
				</div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">A fazer</div>
					<div class="card-body">
						<ul class="list-group">
							@foreach($todo as $t)
							<a href="/requests/{{$t->id}}/" class="list-group-item list-group-item-action flex-column align-items-start">
								<small>Prazo: {{date('d/m/Y',strtotime($t->deadline))}}</small>
								<h5>
									<p class="mb-1">{{$t->title}}</p>
								</h5>
								<small>Responsável: {{ (isset($t->technician->name)) ? $t->technician->name : "Ainda não definido"}}</small>
							</a>
							<br>
							@endforeach
						</ul>	
					</div>
				</div>
            </div>
			<div class="col-md-3">
                <div class="card">
                    <div class="card-header">Fazendo</div>
					<div class="card-body">
						<ul class="list-group">
							@foreach($doing as $dg)
							<a href="/requests/{{$dg->id}}/" class="list-group-item list-group-item-action flex-column align-items-start">
								<small>Prazo: {{$dg->deadline}}</small>
								<h5>
									<p class="mb-1">{{$dg->title}}</p>
								</h5>
								<small>Responsável: {{ (isset($dg->technician->name)) ? $dg->technician->name : "Ainda não definido"}}</small>
							</a>
							<br>
							@endforeach
						</ul>	
					</div>
				</div>
            </div>
			<div class="col-md-3">
                <div class="card">
                    <div class="card-header">Feitas - {{date('m/Y')}}</div>
					<div class="card-body">
						<ul class="list-group">
							@foreach($done as $d)
							<a href="/requests/{{$d->id}}/" class="list-group-item list-group-item-action flex-column align-items-start">
								<h5>
									<p class="mb-1">{{$d->title}}</p>
								</h5>
								<small>Responsável: {{ (isset($d->technician->name)) ? $d->technician->name : "Ainda não definido"}}</small>
							</a>
							<br>
							@endforeach
						</ul>	
					</div>
				</div>
            </div>
			
        </div>
    </div>
</div>
@endsection

