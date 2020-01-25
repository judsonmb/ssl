@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/home">Home</a></li>
					<li class="breadcrumb-item"><a href="/requests">Solicitações</a> - {{ $request->title }}</li>
                    <li class="breadcrumb-item active" aria-current="page">Calcular pontos de função</li>    
                </ol>
            </nav>  
            <div class="card">
                <div class="card-header">
                    Calcular os pontos de função da solicitação {{$request->title}} de {{ $request->user->name }}.    
                </div>
                <div class="card-body">
                    <form method="POST" action="/requests/{{ $request->id }}/updatefp">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label>Será feita alguma modificação no banco de dados? (0 para não)<br>
                                Se sim, quantos campos de banco de dados serão criados com este requisito?</label>
                                <small class="form-text text-muted">Considere apenas campos que aparecem para o usuário (por exemplo, não considerar chave primária ou secundária).</small>
                                <input type="number" class="form-control" name="ali_data_type_amount" value="{{ $request->ali_data_type_amount }}">
                            </div>
                            <div class="form-group">
                                <label>Será feita alguma modificação no banco de dados? (0 para não)<br>
                                Se sim, quantas tabelas diferentes serão modificadas?</label>
                                <small class="form-text text-muted">Não considerar mais de um quando envolve o mesmo conceito. Tabelas Pessoas e Instituições contam como 2, mas Processos e Histórico de Processos só contam como 1.</small>
                                <input type="number" class="form-control" name="ali_register_type_amount" value="{{ $request->ali_register_type_amount }}">
                            </div>
                            <div class="form-group">
                                <small class="form-text text-muted">Justifique os valores inseridos.</small>
                                <input type="text" class="form-control @error('ali_justify') is-invalid @enderror" name="ali_justify" value="{{ $request->ali_justify }}">
                               
                                @error('ali_justify')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                            
                            </div>
                            <br><hr><br>








                            <div class="form-group">
                                <label>Será feita alguma modificação no banco de dados de outra aplicação? (0 para não)<br>
                                Se sim, quantos campos de banco de dados de outra aplicação serão criados com este requisito?</label>
                                <small class="form-text text-muted">Exemplo: Consumo de API de outra aplicação. Considere apenas campos que aparecem para o usuário (por exemplo, não considerar chave primária ou secundária).</small>
                                <input type="number" class="form-control" name="aie_data_type_amount" value="{{ $request->aie_data_type_amount }}">
                            </div>
                            <div class="form-group">
                                <label>Será feita alguma modificação no banco de dados? (0 para não)<br>
                                Se sim, quantas tabelas diferentes serão modificadas?</label>
                                <small class="form-text text-muted">Exemplo: Consumo de API de outra aplicação. Não considerar mais de um quando envolve o mesmo conceito. Tabelas Pessoas e Instituições contam como 2, mas Processos e Histórico de Processos só contam como 1.</small>
                                <input type="number" class="form-control" name="aie_register_type_amount" value="{{ $request->aie_register_type_amount }}">
                            </div>
                            <div class="form-group">
                                <small class="form-text text-muted">Justifique os valores inseridos.</small>
                                <input type="text" class="form-control @error('aie_justify') is-invalid @enderror" name="aie_justify" value="{{ $request->aie_justify }}">

                                @error('aie_justify')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                            
                            </div>
                            <br><hr><br>








                            <div class="form-group">
                                <label>O usuário final vai modificar (cadastrar/editar/excluir) alguma coisa? (0 para não)<br>
                                Se sim, quantos campos serão afetados por essa modificação?</label>
                                <small class="form-text text-muted">Exemplo: formulário de cadastro. O usuário preenche nome, e-mail e endereço (conta como 3). Quanto a loops, só considerar a quantidade criada na primeira iteração. Dobre o valor se terá de ser implementado um campo para cadastro e outro para edição</small>
                                <input type="number" class="form-control" name="ee_data_type_amount" value="{{ $request->ee_data_type_amount }}"> 
                            </div>
                            <div class="form-group">
                                <label>O usuário final vai modificar (cadastrar/editar/excluir) alguma coisa? (0 para não)<br>
                                Se sim, quantas tabelas diferentes serão afetadas?</label>
                                <small class="form-text text-muted">Não considerar mais de um quando envolve o mesmo conceito. Tabelas Pessoas e Instituições contam como 2, mas Processos e Histórico de Processos só contam como 1. Dobre o valor se terá de ser implementado um campo para cadastro e outro para edição.</small>
                                <input type="number" class="form-control" name="ee_referenced_files_amount" value="{{ $request->ee_referenced_files_amount }}"> 
                            </div>
                            <div class="form-group">
                                <small class="form-text text-muted">Justifique os valores inseridos.</small>
                                <input type="text" class="form-control @error('ee_justify') is-invalid @enderror" name="ee_justify" value="{{ $request->ee_justify }}">
                            
                                @error('ee_justify')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                            </div>
                            <br><hr><br>








                            <div class="form-group">
                                <label>O sistema vai consultar e processar algo do banco de dados e mostrar para o usuário? (0 para não)<br>
                                Se sim, quantos campos serão acessados?</label>
                                <small class="form-text text-muted">Exemplo: consultar dados numéricos no banco de dados e apresentar sob forma de média (a média não está cadastrada no banco, ela foi gerada/processada através de outros dados.</small>
                                <input type="number" class="form-control" name="se_data_type_amount" value="{{ $request->se_data_type_amount }}">
                            </div>
                            <div class="form-group">
                                <label>O sistema vai consultar e processar algo do banco de dados e mostrar para o usuário? (0 para não)<br>
                                Se sim, quantas tabelas diferentes serão consultadas?</label>
                                <small class="form-text text-muted">Não considerar mais de um quando envolve o mesmo conceito. Tabelas Pessoas e Instituições contam como 2, mas Processos e Histórico de Processos só contam como 1.</small>
                                <input type="number" class="form-control" name="se_referenced_files_amount" value="{{ $request->se_referenced_files_amount }}"> 
                            </div>
                            <div class="form-group">
                                <small class="form-text text-muted">Justifique os valores inseridos.</small>
                                <input type="text" class="form-control @error('se_justify') is-invalid @enderror" name="se_justify" value="{{ $request->se_justify }}">

                                @error('se_justify')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <br><hr><br>







                            <div class="form-group">
                                <label>O sistema somente consulta e mostra algo do banco de dados para o usuário? (0 para não)<br>
                                Se sim, quantos campos serão acessados?</label>
                                <small class="form-text text-muted">Exemplo: consulta de todos os usuários cadastrados no sistema mostrados numa tabela. Considera-se também a consulta e preenchimento de dados em páginas de edição.</small>
                                <input type="number" class="form-control" name="ce_data_type_amount" value="{{ $request->ce_data_type_amount }}">
                            </div>
                            <div class="form-group">
                                <label>O sistema somente consulta e mostra algo do banco de dados para o usuário? (0 para não)<br>
                                Se sim, quantas tabelas diferentes serão consultadas?</label>
                                <small class="form-text text-muted">Não considerar mais de um quando envolve o mesmo conceito. Tabelas Pessoas e Instituições contam como 2, mas Processos e Histórico de Processos só contam como 1.</small>
                                <input type="number" class="form-control" name="ce_referenced_files_amount" value="{{ $request->ce_referenced_files_amount }}"> 
                            </div>
                            <div class="form-group">
                                <small class="form-text text-muted">Justifique os valores inseridos.</small>
                                <input type="text" class="form-control @error('ce_justify') is-invalid @enderror" name="ce_justify" value="{{ $request->ce_justify }}">
                            
                            
                                @error('ce_justify')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <hr>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Salvar') }}
                                </button>
                                <a href="{{ route('requests.index') }}">
                                    <button type="button" class="btn btn-secondary">
                                        {{ __('Voltar') }}
                                    </button>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
			</div>
    </div>
</div>

@endsection