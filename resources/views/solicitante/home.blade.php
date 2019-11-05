@extends('layouts.app')

@section('content')
<div class="container">
        <form class="form-inline" method="POST" action="home">
			@csrf
			<div class="form-group mx-sm-3 mb-2">
				<input type="month" class="form-control" name="month" value='{{ $year }}-{{$month}}'>
			</div>
			<button type="submit" class="btn btn-primary mb-2">Mudar mês</button>
		</form>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Feed de notícias</div>
                    <div class="card-body">
						@if($requestHistorics != 0)
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

