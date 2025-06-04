<div class="container mt-4">
    <h3><?= $title ?></h3>
    <div class="card">
        <div class="card-header">
            <button class="btn btn-success md-1 mb-2" onclick="abrirModal()">
                <i class='fas fa-plus'></i>
            </button>
            <button class="btn btn-success md-1 mb-2" onclick="carregarUsuarios()">
                <i class='fas fa-refresh'></i>
            </button>
        </div>
        <div class="card-body">
            <table id="tabela" class="table table-striped table-hover table-sm">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Telefone</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Os dados serão preenchidos via JavaScript -->
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal" id="modalUsuario" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content shadow-lg">
            <div class="modal-header">
                <h5 class="modal-title">Adicionar Usuário</h5>
                <button type="button" class="btn-close" onclick="fecharModal()"></button>
            </div>
            <div class="modal-body">
                <input type="text" id="nome" class="form-control" placeholder="Nome">
                <input type="email" id="email" class="form-control mt-2" placeholder="Email">
                <input type="text" id="phone" class="form-control mt-2" placeholder="Telefone">
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" onclick="salvarUsuario()">Salvar</button>
                <button class="btn btn-secondary" onclick="fecharModal()">Fechar</button>
            </div>
        </div>
    </div>
</div>