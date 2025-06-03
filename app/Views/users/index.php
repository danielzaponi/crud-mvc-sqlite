<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Gerenciamento de Usuários</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top shadow-lg mb-4">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">CRUD Usuários</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Alternar navegação">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Início</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Sobre</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contato</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Fim da Navbar -->
    <div class="container mt-4">
        <h2>Lista de Usuários</h2>
        <button class="btn btn-success md-1 mb-2" onclick="abrirModal()">
            <i class='fas fa-plus'></i>
        </button>
        <button class="btn btn-success md-1 mb-2" onclick="carregarUsuarios()">
            <i class='fas fa-refresh'></i>
        </button>
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
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="js/users.js"></script>
</body>

</html>