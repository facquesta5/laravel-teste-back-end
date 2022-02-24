@extends('template.initial')

@section('content')

<div class="container-fluid">
    <div class="container bg-light p-3 border rounded-3 mt-3" style="max-width:600px;">

        <table id="myTable" class="table table-hover">
            <thead>
                <tr class="text-left">
                    <th><h5>Detalhes do usuário</h5></th>
                </tr>
            </thead>
            <tbody>
                <tr class="text-left">
                    <td>Nome: {{ $usuario->nome }}</td>
                </tr>
                <tr class="text-left">
                    <td>Email: {{$usuario->email}}</td>
                </tr>
                <tr class="text-left">
                    <td>endereco_id: {{$usuario->endereco->id}}</td>
                </tr>
                <tr class="text-left">
                    <td>Endereço: {{$usuario->rua}}</td>
                </tr>
                <tr class="text-left">
                    <td>Número: {{$usuario->numero}}</td>
                </tr>
                <tr class="text-left">
                    <td>Complemento: {{$usuario->complemento}}</td>
                </tr>

                <tr class="text-left">
                    <td>Bairro: {{$usuario->bairro}}</td>
                </tr>

                <tr class="text-left">
                    <td>CEP: {{$usuario->cep}}</td>
                </tr>
                <tr class="text-left">
                    <td>estado_id: {{$usuario->estado_id}}</td>
                </tr>
                <tr class="text-left">
                    <td>Estado: {{$usuario->estado}}</td>
                </tr>
                <tr class="text-left">
                    <td>cidade_id: {{$usuario->cidade_id}}</td>
                </tr>
                <tr class="text-left">
                    <td>Cidade: {{$usuario->cidade}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection
