@extends('template.initial')

@section('content')

<div class="container-fluid">
    <div class="container bg-light p-3 border rounded-3 mt-3" style="max-width:600px;">
        <h5>Cadastro de usuário</h5>
        {{ $usuario->id}}
        <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST" >
            <input type="hidden" name="_method" value="put">
            <input type="hidden" name="endereco_id" value="{{$usuario->endereco_id}}">
            @csrf
            <input type="hidden" name="cadastrar_usuario" value="cadastrar_usuario" >
            <div class="mb-1">
                <label class="form-label">Nome</label>
                <input type="text" class="form-control" name="nome" value="{{$usuario->nome}}">
            </div>
            <div class="mb-1">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{$usuario->email}}">
            </div>
            <div class="mb-1">
                <label class="form-label">Endereço</label>
                <input type="text" class="form-control" name="rua" value="{{$usuario->rua}}">
            </div>

            <div class="mb-1">
                <label class="form-label">Número</label>
                <input type="text" class="form-control" name="numero" value="{{$usuario->numero}}">
            </div>
            <div class="mb-1">
                <label class="form-label">Complemento</label>
                <input type="text" class="form-control" name="complemento" value="{{$usuario->complemento}}">
            </div>
            <div class="mb-1">
                <label class="form-label">Bairro</label>
                <input type="text" class="form-control" name="bairro" value="{{$usuario->bairro}}">
            </div>
            <div class="mb-1">
                <label class="form-label">cep</label>
                <input type="text" class="form-control" name="cep" value="{{$usuario->cep}}">
            </div>
            <div class="mb-1">
                <label class="form-label">Estado</label>
                <select class="form-select" name="estado_id" id="select-estado">
                    <option selected> * * * Estado * * * </option>
                    @foreach ($estados as $estado )
                    <option
                    <?php echo $estado->id == $usuario->estado_id ? 'selected' : null ; ?>
                    value="{{$estado->id}}">{{$estado->uf}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-1">
            <div class="mb-1">
                <label class="form-label">Cidade</label>
                 <select class="form-select" name="cidade_id" id="select-cidade">
                    <option selected> * * * Cidades * * * </option>
                    @foreach ($cidades as $cidade )
                    <option
                    <?php echo $cidade->id == $usuario->cidade_id ? 'selected' : null ; ?>
                    value="{{$cidade->id}}">{{$cidade->nome}}</option>
                    @endforeach
                </select>
            </div>
            </div>

            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </form>
    </div>
</div>
@endsection

@push('js')

<script>

$('document').ready(function(){



 $("#select-estado").on("change", function(){ getCidades(); });

    function getCidades(){
        if($('#select-estado').val() != ''){
            $.ajax({
                url: '{{ route("api.cidades.index") }}',
                type: 'GET',
                data: {
                    estado_id: $('#select-estado option:selected').val()
                },
                success: function(result){
                    $('#select-cidade').prop("disabled", true);
                    $('#select-cidade').removeAttr("disabled");

                    var options = $('#select-cidade');
                    options.find('option').remove();

                    jQuery.each( result, function( key, value ) {
                        $( "#select-cidade").append("<option value='"+ value.id +"'>"+ value.nome +"</option>");
                    });
                },
                error: function(result){
                    console.log(result);
                    $('meta[name="csrf-token"]').attr('content', result.token);
                    btn_enable(btn, btn_text);
                }
            });
        }
    }
});

</script>
@endpush
