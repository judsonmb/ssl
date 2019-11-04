@extends($layout)

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="/home">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Editar senha</li>    
                </ol>
            </nav>  
            <div class="card">
                <div class="card-header">
                    Edite sua senha.
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('update-password') }}">
						@csrf
						@method('PUT')
						<div class="form-group">
							<label for="password">Nova senha</label>
							<input type="password" class="form-control" name="password">					
						</div>
						
						<div class="form-group">
							<label for="password-confirm">Confirme a nova senha</label>
							<input type="password" class="form-control" name="password_confirmation">		
						</div>
						
							
						@error('password')
							<div class="error">{{ $message }}</div>
						@enderror
						<button type="submit" class="btn btn-success">Atualizar</button>
					</form>
                </div>
			</div>
    </div>
</div>

@endsection