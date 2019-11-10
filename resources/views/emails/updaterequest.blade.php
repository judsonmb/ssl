@extends('layouts.email')

@section('content')
<div id="emailBody">

    <div>Oi, {{ $recipient }}!</div>

    <div>
        <h3>O Status da sua solicitação sobre <span class="green"> {{ $title }} </span>
        foi atualizado para <span class="green"> {{ $status }} </span>!</h3>
    </div>

    <div>Clique <a href="ssl.linkn.com.br/requests/{{ $id }}">aqui</a> para ver mais detalhes.</div>
    
</div>




