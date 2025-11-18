<div class="form-group">
  @if($errors->any())
    <div class="errors">
      @foreach($errors->all() as $err) <div>{{ $err }}</div> @endforeach
    </div>
  @endif

  <div class="form-row">
    <div class="form-group">
      <label for="nome_completo">Nome completo</label>
      <input id="nome_completo" name="nome_completo" type="text"
        value="{{ old('nome_completo', $agente->nome_completo ?? '') }}"
        placeholder="Fulano da Silva" required autofocus>
    </div>

    <div class="form-group">
      <label for="nome_artistico">Nome artístico</label>
      <input id="nome_artistico" name="nome_artistico" type="text"
        value="{{ old('nome_artistico', $agente->nome_artistico ?? '') }}"
        placeholder="Nome artístico (opcional)">
    </div>

    <div class="form-group">
      <label for="cpf_cnpj">CPF / CNPJ</label>
      <input id="cpf_cnpj" name="cpf_cnpj" type="text"
        value="{{ old('cpf_cnpj', $agente->cpf_cnpj ?? '') }}"
        placeholder="000.000.000-00">
    </div>
  </div>

  <div class="form-row" style="margin-top:6px;">
    <div class="form-group" style="grid-column:1 / -1">
      <label for="area_atuacao">Área de atuação</label>
      <input id="area_atuacao" name="area_atuacao" type="text"
        value="{{ old('area_atuacao', $agente->area_atuacao ?? '') }}"
        placeholder="Ex: Música, Teatro, Artes Visuais">
    </div>
  </div>

  <div class="form-group" style="margin-top:6px;">
    <label for="curriculo">Currículo / Notas</label>
    <textarea id="curriculo" name="curriculo" placeholder="Pequeno resumo do histórico">{{ old('curriculo', $agente->curriculo ?? '') }}</textarea>
  </div>