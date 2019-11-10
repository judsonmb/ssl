@extends('layouts.email')

@section('content')
<div id="emailBody">

    <div>Oi, {{ $recipient }}!</div>

    <div>
        <h3>A solicitação sobre <span class="green"> {{ $title }} </span> recebeu uma mensagem.</h3>
        <p> {!! $msg !!} </p>
    </div>

    <div>Clique <a href="ssl.linkn.com.br/requests/{{ $id }}">aqui</a> para ver mais detalhes.</div>
    
</div>