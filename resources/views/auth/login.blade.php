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
		<div class="col-md-6 login-form-1" style="text-align:center;">
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
<!--<div class="login-page">
    <div class="form">
        <small>Seja bem vindo ao sistema de solicitações da LinKn!</small>
		<h3>Por favor, efetue login.</h3>
        <form class="login-form" method="POST" action="{{ route('login') }}">
            @csrf
            <input placeholder="digite seu e-mail" id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            <input placeholder="digite sua senha" id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
            
                @error('email')
                    <div class="error"><strong>{{ $message }}</strong></div><br>
                @enderror
                @error('password')
                    <div class="error"><strong>{{ $message }}</strong></div><br>
                @enderror
            

            <div class="form-group row">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                </div>
                <label id="rememberLabel">Lembrar-me</label>
            </div>  

            @if (Route::has('password.request'))
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    Esqueceu sua senha?
                </a>
            @endif

            <button>login</button>
        </form>
    </div>
</div>

<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="wrapper">
                <form class="form-signin">       
                    <h2 class="form-signin-heading">Please login</h2>
                    <input type="text" class="form-control" name="username" placeholder="Email Address" required="" autofocus="" />
                    <input type="password" class="form-control" name="password" placeholder="Password" required=""/>      
                    <label class="checkbox">
                        <input type="checkbox" value="remember-me" id="rememberMe" name="rememberMe"> Remember me
                    </label>
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>   
                </form>
            </div>
             <div class="card" style="margin-top:150px;">
                <div class="card-header" style="text-align: center;">
                    Seja bem vindo (a) ao Sistema de Requisições da LinKn. Para iniciar, efetue o login.
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Senha</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        Lembrar-me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        Esqueceu sua senha?
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div> 
    </div>
</div> -->
@endsection
