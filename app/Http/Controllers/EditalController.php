<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Edital;
use App\Models\Formulario;
use App\Models\Pergunta;
use App\Models\Alternativa;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class EditalController extends Controller
{
    /**
     * Exibe a listagem de editais
     */
    public function index()
    {
       $editais = \App\Models\Edital::with(['formularios'])
        ->orderBy('created_at', 'desc')
        ->paginate(15);

        return view('editais.index', compact('editais'));
    }

    /**
     * Exibe o formulário de criação de edital
     */
    public function create()
    {
        return view('editais.create');
    }

    /**
     * Armazena um novo edital
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'titulo' => 'required|string|max:255',
            'descricao' => 'required|string',
            'processo' => 'required|string|max:100',
            'situacao' => 'required|in:ABERTO,ENCERRADO,ARQUIVADO',
            'formularios' => 'required|array|min:1',
            'formularios.*.perguntas' => 'required|array|min:1',
            'formularios.*.perguntas.*.texto' => 'required|string',
            'formularios.*.perguntas.*.tipo' => 'required|string',
            'formularios.*.perguntas.*.obrigatoria' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            DB::beginTransaction();

            // Criar edital
            $edital = Edital::create([
                'titulo' => $request->titulo,
                'descricao' => $request->descricao,
                'processo' => $request->processo,
                'situacao' => $request->situacao,
            ]);

            // Criar formulários e suas perguntas
            foreach ($request->formularios as $formularioData) {
                $formulario = $edital->formularios()->create([]);

                foreach ($formularioData['perguntas'] as $perguntaData) {
                    $pergunta = $formulario->perguntas()->create([
                        'texto' => $perguntaData['texto'],
                        'tipo' => $perguntaData['tipo'],
                        'obrigatoria' => $perguntaData['obrigatoria'],
                    ]);

                    // Criar alternativas se existirem
                    if (isset($perguntaData['alternativas']) && is_array($perguntaData['alternativas'])) {
                        foreach ($perguntaData['alternativas'] as $alternativaData) {
                            if (!empty($alternativaData['texto'])) {
                                $pergunta->alternativas()->create([
                                    'texto' => $alternativaData['texto'],
                                    'correta' => $alternativaData['correta'] ?? false,
                                ]);
                            }
                        }
                    }
                }
            }

            DB::commit();
            return redirect()->route('editais.index')->with('success', 'Edital criado com sucesso!');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->with('error', 'Erro ao criar edital: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Exibe um edital específico
     */
    public function show(string $id)
    {
        $edital = Edital::with(['formularios.perguntas.alternativas'])->findOrFail($id);
        return view('editais.show', compact('edital'));
    }

    /**
     * Exibe o formulário de edição de edital
     */
    public function edit(string $id)
    {
        $edital = Edital::with(['formularios.perguntas.alternativas'])->findOrFail($id);
        return view('editais.edit', compact('edital'));
    }

    /**
     * Atualiza um edital
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'titulo' => 'required|string|max:255',
            'descricao' => 'required|string',
            'processo' => 'required|string|max:100',
            'situacao' => 'required|in:ABERTO,ENCERRADO,ARQUIVADO',
            'formularios' => 'required|array|min:1',
            'formularios.*.perguntas' => 'required|array|min:1',
            'formularios.*.perguntas.*.texto' => 'required|string',
            'formularios.*.perguntas.*.tipo' => 'required|string',
            'formularios.*.perguntas.*.obrigatoria' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            DB::beginTransaction();

            $edital = Edital::findOrFail($id);
            
            // Atualizar dados do edital
            $edital->update([
                'titulo' => $request->titulo,
                'descricao' => $request->descricao,
                'processo' => $request->processo,
                'situacao' => $request->situacao,
            ]);

            // Remover formulários existentes (cascade irá remover perguntas e alternativas)
            $edital->formularios()->delete();

            // Recriar formulários
            foreach ($request->formularios as $formularioData) {
                $formulario = $edital->formularios()->create([]);

                foreach ($formularioData['perguntas'] as $perguntaData) {
                    $pergunta = $formulario->perguntas()->create([
                        'texto' => $perguntaData['texto'],
                        'tipo' => $perguntaData['tipo'],
                        'obrigatoria' => $perguntaData['obrigatoria'],
                    ]);

                    // Criar alternativas se existirem
                    if (isset($perguntaData['alternativas']) && is_array($perguntaData['alternativas'])) {
                        foreach ($perguntaData['alternativas'] as $alternativaData) {
                            if (!empty($alternativaData['texto'])) {
                                $pergunta->alternativas()->create([
                                    'texto' => $alternativaData['texto'],
                                    'correta' => $alternativaData['correta'] ?? false,
                                ]);
                            }
                        }
                    }
                }
            }

            DB::commit();
            return redirect()->route('editais.index')->with('success', 'Edital atualizado com sucesso!');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->with('error', 'Erro ao atualizar edital: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove um edital
     */
    public function destroy(string $id)
    {
        try {
            $edital = Edital::findOrFail($id);
            $edital->delete();
            
            return redirect()->route('editais.index')->with('success', 'Edital removido com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao remover edital: ' . $e->getMessage());
        }
    }
}
