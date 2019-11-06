@extends('layouts.login')

@section('content')

<style>
.login-container{
    margin-top: 5%;
    margin-bottom: 5%;
}
.login-form-1{
    padding: 5%;
    box-shadow: 0 5px 8px 0 rgba(0, 0, 0, 0.2), 0 9px 26px 0 rgba(0, 0, 0, 0.19);
	background-color: white;
}
.login-form-2{
    padding: 5%;
    background: #1abc9c;
    box-shadow: 0 5px 8px 0 rgba(0, 0, 0, 0.2), 0 9px 26px 0 rgba(0, 0, 0, 0.19);
}
.login-form-2 h3{
    text-align: center;
    color: #fff;
}
.login-container form{
    padding: 10%;
}
.btnSubmit
{
    width: 50%;
    border-radius: 1rem;
    padding: 1.5%;
    border: none;
    cursor: pointer;
}
.login-form-2 .btnSubmit{
    font-weight: 600;
    color: #0062cc;
    background-color: #fff;
}
.login-form-2 .ForgetPwd{
    color: #fff;
    font-weight: 600;
    text-decoration: none;
}

</style>
<div class="container login-container">
	<div class="row">
		<div class="col-md-6 login-form-1 d-none d-md-table-cell" style="text-align:center;">
			<img src="{{ url('/img/linkn.png') }}"></img>
		</div>
		<div class="col-md-6 login-form-2">
			<h3>Bem vindo ao Sistema de Solicitações LinKn</h3>
			<form method="POST" action="{{ route('login') }}">
				@csrf
				<div class="form-group">
					<input type="email" class="form-control" placeholder="E-mail *" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus />
				</div>
				<div class="form-group">
					<input type="password" class="form-control" placeholder="Senha *" class="@error('password') is-invalid @enderror" name="password" required autocomplete="current-password" />
				</div>
				@error('email')
                    <div class="error"><strong>{{ $message }}</strong></div><br>
                @enderror
                @error('password')
                    <div class="error"><strong>{{ $message }}</strong></div><br>
                @enderror
				<div class="form-group">
					<input type="submit" class="btnSubmit" value="Login" />
				</div>
				<div class="form-group">
					<a href="{{ route('password.request') }}" class="ForgetPwd">Esqueceu sua senha?</a>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
