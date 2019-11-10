@extends('layouts.email')

@section('content')
<div id="emailBody">

    <div>Oi, <span class="green">LinKn</span>!</div>

    <div>
        <h3>{{ $sender }} enviou uma solicitação.</h3>
        <p>{{ $title }}</p>
        <p>{{ $description }}</p>
    </div>

    <div>Clique <a href="ssl.linkn.com.br/requests/{{ $id }}">aqui</a> para ver mais detalhes.</div>
    
</div>