@extends('layouts.email')

@section('content')
<div id="emailBody">

    <div>Oi, {{ $recipient }}!</div>

    <div>
        <h3>Você foi atribuído para executar a solicitação <span class="green"> {{ $title }}. </span></h3>
    </div>

    <div>Clique <a href="ssl.linkn.com.br/requests/{{ $id }}">aqui</a> para ver mais detalhes.</div>

</div>