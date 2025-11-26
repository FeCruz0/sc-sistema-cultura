<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InscricaoController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function store(Request $request, Edital $edital)
    {
        $user = $request->user();

        if (! $user->curriculo_aprovado){
            return redurect()->back()->withErrors(['curriculo' => 'Seu curriculo ainda não foi aprovado.']);
        }

        $data = $request->validate([
            'resposta' => 'nullable|array',
        ]);

        Inscricao::create([
            'edital_id' => $edital->id,
            'user_id' => $user->id,
            'resposta' => $data['resposta'] ?? null,
            'status' => 'pendente',
        ]);

        return redurect()->back()->with('success', 'Inscrição realizada com sucesso!');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Edital $edital)
    {
        $this->authorize('viewAny', Inscricao::class);

        $inscricoes = $edital->inscricoes()->with('user')->get();

        return view('editais.inscricoes.index', compact('edital', 'inscricoes'));
    }
   
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
