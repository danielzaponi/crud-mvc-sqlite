<div class="container mt-5 pt-4">
    <h2>Lista de Internações</h2>
    <button class="btn btn-success mb-2" onclick="abrirModal()">
        <i class="fas fa-plus"></i>
    </button>
    <button class="btn btn-secondary mb-2" onclick="carregarInternacoes()">
        <i class="fas fa-sync-alt"></i>
    </button>

    <table id="tabela" class="table table-striped table-hover table-sm">
        <thead>
            <tr>
                <th>ID</th>
                <th>Paciente</th>
                <th>Sexo</th>
                <th>Apartamento</th>
                <th>Leito</th>
                <th>Convênio</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <!-- Dados preenchidos pelo DataTables -->
        </tbody>
    </table>
</div>

<!-- Modal de Internação -->
<div class="modal fade" id="modalInternacao" tabindex="-1" aria-labelledby="modalInternacaoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content shadow-lg">
            <div class="modal-header">
                <h5 class="modal-title" id="modalInternacaoLabel">Adicionar Internação</h5>
                <button type="button" class="btn-close" onclick="fecharModal()" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                <div class="mb-2">
                    <label for="paciente" class="form-label">Paciente</label>
                    <input type="text" id="paciente" class="form-control" placeholder="Nome do paciente" />
                </div>
                <div class="mb-2">
                    <label for="sexo" class="form-label">Sexo</label>
                    <select id="sexo" class="form-select">
                        <option value="">Selecione</option>
                        <option value="Masculino">Masculino</option>
                        <option value="Feminino">Feminino</option>
                        <option value="Outro">Outro</option>
                    </select>
                </div>
                <div class="mb-2">
                    <label for="apartamento" class="form-label">Apartamento</label>
                    <input type="text" id="apartamento" class="form-control" placeholder="Número do apartamento" />
                </div>
                <div class="mb-2">
                    <label for="leito" class="form-label">Leito</label>
                    <input type="text" id="leito" class="form-control" placeholder="Número do leito" />
                </div>
                <div class="mb-2">
                    <label for="convenio" class="form-label">Convênio</label>
                    <input type="text" id="convenio" class="form-control" placeholder="Convênio" />
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" onclick="salvarInternacao()">Salvar</button>
                <button class="btn btn-secondary" onclick="fecharModal()">Fechar</button>
            </div>
        </div>
    </div>
</div>