@extends('template.initial')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
        <table id="myTable" class="table table-hover">
            <thead>
                <tr class="text-center">
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>Quantidade de usuários por Estado: </strong><br>
                        @foreach ($porEstado as $estado )
                        {{$estado->nome}}: {{$estado->usuarios}}
                        <br>
                        @endforeach
                    </td>
                    <td><strong>Quantidade de usuários por Cidade: </strong><br>
                        @foreach ($porCidade as $cidade )
                        {{$cidade->nome}}: {{$cidade->usuarios}}
                        <br>
                        @endforeach
                    </td>
                </tr>

            </tbody>
        </table>
        <h5 class="mt-3 float-start">Lista de usuários</h5>

        <a class="col-md-2 btn btn-success font-weight-bold mt-3 float-end"
        href="{{ route('usuarios.create')}}">
        <i class="fas fa-plus"></i> Novo usuário</a>

        <table id="myTable" class="table table-hover">
            <thead>
                <tr class="text-center">
                    <th>Nome</th>
                    <th>Email</th>
                    <th class="text-center">Detalhes</th>
                    <th class="text-center">Alterar</th>
                    <th class="text-center">Excluir</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($usuarios as $usuario)
                <tr class="text-center">
                    <td>{{ $usuario->nome }}</td>
                    <td>{{ $usuario->email }}</td>
                    <td class="text-center">
                        <a href="usuarios/{{ $usuario->id }}">
                            <i class="fa fa-eye" aria-hidden="true"></i>
                        </a>
                    </td>
                    <td class="text-center">
                        <a href="{{ route('usuarios.edit', $usuario->id) }}">
                            <i class="far fa-edit">
                        </i></a>
                    </td>
                    <td class="text-center">
                        <form action="{{route('usuarios.destroy', $usuario->id)}}" method="POST">
                            @csrf
                            <input type="hidden" name="_method" value="delete">
                            <button style="border:none;background-color:transparent;color:#0d6efd;" onclick="return confirm('Deseja deletar o registro?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>
</div>
@endsection
