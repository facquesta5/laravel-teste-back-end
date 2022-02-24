<?php

namespace App\Http\Controllers;

use App\Models\Cidade;
use App\Models\Endereco;
use App\Models\Estado;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsuarioController extends Controller
{

    public function index()
    {
        $usuarios = Usuario::all();
        $porEstado = $this->porEstado();
        $porCidade = $this->porCidade();
        return view('pages.usuarios.index', compact('usuarios', 'porEstado', 'porCidade'));
    }


    public function create()
    {
        $estados = Estado::all();
        $cidades = Cidade::all();

        return view('pages.usuarios.novo', compact('estados', 'cidades'));
    }


    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $id = Endereco::create([
                "rua" => $request->rua,
                "numero" => $request->numero,
                "complemento" => $request->complemento,
                "bairro" => $request->bairro,
                "cep" => $request->cep,
                "estado_id" => $request->estado_id,
                "cidade_id" => $request->cidade_id,
            ])->id;
            Usuario::create([
                "nome"=> $request->nome,
                "email"=> $request->email,
                "endereco_id"=> $id
            ]);

        } catch (\Throwable $th) {
            DB::rollBack();
        }
        DB::commit();

    return redirect()->route('usuarios.index');
    }


    public function show($id)
    {
        $usuario = Usuario::select('usuarios.*','enderecos.*',
        'estados.nome as estado', 'cidades.nome as cidade')
        ->join('enderecos', 'enderecos.id', 'usuarios.endereco_id')
        ->join('estados', 'estados.id', 'enderecos.estado_id')
        ->join('cidades', 'cidades.id','enderecos.cidade_id')
        ->find($id);

        return view('pages.usuarios.show', compact('usuario'));
    }


    public function edit($id)
    {
        $usuario = Usuario::select('usuarios.*','enderecos.*',
        'estados.nome as estado', 'cidades.nome as cidade', 'usuarios.id as id',
        'enderecos.id as endereco_id')
        ->join('enderecos', 'enderecos.id', 'usuarios.endereco_id')
        ->join('estados', 'estados.id', 'enderecos.estado_id')
        ->join('cidades', 'cidades.id','enderecos.cidade_id')
        ->find($id);

        $estados = Estado::all();
        $cidades = Cidade::listCidades($usuario->estado_id);

        return view('pages.usuarios.edit', compact('usuario','estados', 'cidades'));
    }


    public function update(Request $request, $id)
    {

        DB::beginTransaction();
        try {
            Endereco::findOrFail($request->endereco_id)->update([
                "rua" => $request->rua,
                "numero" => $request->numero,
                "complemento" => $request->complemento,
                "bairro" => $request->bairro,
                "cep" => $request->cep,
                "estado_id" => $request->estado_id,
                "cidade_id" => $request->cidade_id,
            ]);

            Usuario::findOrFail($id)->update([
                "nome"=> $request->nome,
                "email"=> $request->email,
                "endereco_id"=> $request->endereco_id
            ]);

        } catch (\Throwable $th) {
            DB::rollBack();
        }
        DB::commit();

    return redirect()->route('usuarios.index');

    }


    public function destroy(Request $request, $id)
    {
        Usuario::find($id)->delete();
        Endereco::find($request->endereco_id)->delete();

        return redirect()->route('usuarios.index');
    }

    private function porEstado(){
        return Endereco::selectRaw('estados.nome as nome, count(estados.nome) as usuarios')
        ->leftJoin('usuarios', 'enderecos.id', 'usuarios.endereco_id')
        ->leftJoin('estados', 'estados.id', 'enderecos.estado_id')
        ->groupBy('estados.nome')
        ->havingRaw('count(estados.nome)')->get();
    }

    private function porCidade(){
        return Endereco::selectRaw('cidades.nome as nome, count(cidades.nome) as usuarios')
        ->leftJoin('usuarios', 'enderecos.id', 'usuarios.endereco_id')
        ->leftJoin('cidades', 'cidades.id', 'enderecos.cidade_id')
        ->groupBy('cidades.nome')
        ->havingRaw('count(cidades.nome)')->get();
    }

}
