@extends('layouts.email')

@section('content')
<div id="emailBody">

    <div>Oi, {{ $recipient }}!</div>

    <div>
        <h3>Sua solicitação sobre <span class="green"> {{ $title }} </span> foi registrada com sucesso!</h3>
    </div>

    <div>Clique <a href="ssl.linkn.com.br/requests/{{ $id }}">aqui</a> para ver mais detalhes.</div>

</div>