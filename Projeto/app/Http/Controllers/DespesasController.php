<?php

namespace App\Http\Controllers;

use App\Models\Despesas;
use Illuminate\Http\Request;

class DespesasController extends Controller
{
    public function index()
    {
        return Despesas::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'descricao' => 'required|string|max:255',
            'value' => 'required|numeric',
            'data' => 'required|date',
            'imagem' => 'nullable|string|max:255', 
            'documento' => 'nullable|string|max:255', 
        ]);

        $despesa = new Despesas();
        $despesa->user_id = $request->input('user_id');
        $despesa->descricao = $request->input('descricao');
        $despesa->value = $request->input('value');
        $despesa->data = $request->input('data');
        $despesa->imagem = $request->input('imagem');
        $despesa->documento = $request->input('documento');
        $despesa->save();

        return response()->json([
            'location' => route('despesas.show', $despesa->id)
        ], 201);
    }

    public function show($id)
    {
        $despesa = Despesas::find($id);

        if (!$despesa) {
            return response()->json(['message' => 'Despesa não encontrada'], 404);
        }

        return response()->json($despesa);
    }

    public function update(Request $request, $id)
    {
        $despesa = Despesas::findOrFail($id);

        $descricao = $request->input('descricao');
        if ($descricao) {
            $despesa->descricao = $descricao;
        }
        
        $value = $request->input('value');
        if ($value) {
            $despesa->value = $value;
        }

        $data = $request->input('data');
        if ($data) {
            $despesa->data = $data;
        }

        $imagem = $request->input('imagem');
        if ($imagem) {
            $despesa->imagem = $imagem;
        }

        $documento = $request->input('documento');
        if ($documento) {
            $despesa->documento = $documento;
        }

        $despesa->save();

        return response()->json($despesa);
    }

    public function destroy($id)
    {
        $despesa = Despesas::findOrFail($id);
        $despesa->delete();
        return response()->noContent();
    }
}