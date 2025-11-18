<?php

namespace App\Http\Controllers;

use App\Models\AgenteCultural;
use App\Http\Requests\AgenteCulturalRequest;
use Illuminate\Http\Request;

class AgenteController extends Controller
{
    public function index()
    {
        $agentes = AgenteCultural::orderBy('nome_completo')->paginate(15);
        return view('agentes.index', compact('agentes'));
    }

    public function create()
    {
        return view('agentes.create');
    }

    public function store(AgenteCulturalRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        $agente = AgenteCultural::create($data);
        return redirect()->route('agentes.show', $agente)->with('success', 'Agente cultural criado.');
    }

    public function show(AgenteCultural $agente)
    {
        return view('agentes.show', compact('agente'));
    }

    public function edit(AgenteCultural $agente)
    {
        return view('agentes.edit', compact('agente'));
    }

    public function update(AgenteCulturalRequest $request, AgenteCultural $agente)
    {
        $agente->update($request->validated());
        return redirect()->route('agentes.show', $agente)->with('success', 'Agente cultural atualizado.');
    }

    public function destroy(AgenteCultural $agente)
    {
        $agente->delete();
        return redirect()->route('agentes.index')->with('success', 'Agente cultural removido.');
    }
}
