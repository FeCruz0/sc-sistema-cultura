<div class="form-group">
  @if($errors->any())
    <div class="errors">
      @foreach($errors->all() as $err) <div>{{ $err }}</div> @endforeach
    </div>
  @endif

  <label for="nome_completo">Nome completo</label>
  <input id="nome_completo" name="nome_completo" value="{{ old('nome_completo', $agente->nome_completo ?? '') }}" required>

  <label for="nome_artistico">Nome artístico</label>
  <input id="nome_artistico" name="nome_artistico" value="{{ old('nome_artistico', $agente->nome_artistico ?? '') }}">

  <label for="cpf_cnpj">CPF / CNPJ</label>
  <input id="cpf_cnpj" name="cpf_cnpj" value="{{ old('cpf_cnpj', $agente->cpf_cnpj ?? '') }}">

  <label for="area_atuacao">Área de atuação</label>
  <input id="area_atuacao" name="area_atuacao" value="{{ old('area_atuacao', $agente->area_atuacao ?? '') }}">

  <label for="curriculo">Currículo / Notas</label>
  <textarea id="curriculo" name="curriculo">{{ old('curriculo', $agente->curriculo ?? '') }}</textarea>

  <div style="margin-top:12px">
    <button type="submit" class="btn">Salvar</button>
    <a href="{{ route('agentes.index') }}" class="btn secondary">Cancelar</a>
  </div>
</div>