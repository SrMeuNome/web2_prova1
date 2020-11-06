@extends('template.app')

@section('nome_tela', 'Disciplina')

@section('cadastro')
    <div class="container">
        <form class="row" method="POST" action="/disciplina">
            <div class="form-group col-6">
                <label for="nome" class="form-text">Nome da disciplina:</label>
                <input value="{{$disciplina->nome}}" id="nome" name="nome" class="form-control" type="text">
            </div>
            
            <div class="form-group col-3">
                <label for="total-faltas" class="form-text">Total de faltas:</label>
                <input value="{{$disciplina->total_faltas}}" id="total-faltas" name="total-faltas" class="form-control" type="number">
            </div>
            <div class="form-group col-3">
                <label for="maximo-faltas" class="form-text">Máximo de Faltas:</label>
                <input value="{{$disciplina->maximo_faltas}}" id="maximo-faltas" name="maximo-faltas" class="form-control" type="number">
                <input value="{{$disciplina->id}}" id="id" name="id" type="hidden">
                @csrf
            </div>

            <div class="form-inline col-12 btn-custom-group">
                <button type="submit" class="btn btn-outline-primary icon"><i class="material-icons">add_circle_outline</i></button>
                <button type="reset" class="btn btn-outline-secondary icon"><i class="material-icons">clear</i></button>
            </div>
        </form>
    </div>
@endsection

@section('listagem')
    <div class="custom-table">
        <table class="table table-hover table-light col-12">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Total de faltas</th>
                    <th>Máximo de faltas</th>
                    <th>Faltar?</th>
                    <th>Editar</th>
                    <th>Excluir</th>
                </tr>
            </thead>
            <tbody>
                
                @foreach ($disciplinas as $disciplina)
                    <tr> 
                        <td>{{$disciplina->nome}}</td>
                        <td>{{$disciplina->total_faltas}}</td>
                        <td>{{$disciplina->maximo_faltas}}</td>
                        <td>
                            <form method="POST" action="/disciplina/{{$disciplina->id}}">
                                @csrf
                                <input type="hidden" name="_method" value="PUT" />
                                @if ($disciplina->total_faltas >= $disciplina->maximo_faltas)
                                    <button class="btn btn-outline-dark disabled" disabled type="submit">Vá para aula</button>
                                @else
                                    <button class="btn btn-outline-danger" type="submit" onclick="confirm('Você deseja realmente faltar?')">Faltar</button>
                                @endif
                            </form>
                        </td>
                        <td>
                            <div class="btn-custom-group">
                                <form method="GET" action="/disciplina/{{$disciplina->id}}/edit">
                                    @csrf
                                    <button class="btn btn-outline-success icon btn-circle" type="submit"><i class="material-icons">edit</i></button>
                                </form>
                            </div>
                        </td>
                        
                        <td>
                            <div class="btn-custom-group">
                                <form method="POST" action="/disciplina/{{$disciplina->id}}">
                                    @csrf
                                    <input type="hidden" name="_method" value="delete" />
                                    <button onclick="return confirm('Você deseja realmente deletar essa disciplina?')" class="btn btn-outline-danger icon btn-circle" type="submit"><i class="material-icons">delete</i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach 
            </tbody>
        </table>
    </div>
@endsection

@section('tab-active')
<script>
    $(document).ready(function() {
        $('#disciplina-link').tab('show');
    })
</script>
@endsection

