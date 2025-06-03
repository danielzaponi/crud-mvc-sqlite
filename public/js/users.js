let tabela = null;

$(document).ready(function () {
    // Inicializa o DataTable
    tabela = $('#tabela').DataTable({
        language: {
            url: "/json/pt-BR.json"
        },
        processing: true,
        serverSide: true,
        ajax: {
            url: "/users/list",
            type: "POST",
            dataSrc: "data" // Apenas extrai o array de dados
        },
        order: [[0, 'desc']],
        columns: [
            { data: "id" },
            { data: "name" },
            { data: "email" },
            { data: "phone" },
            {
                data: null,
                orderable: false,
                searchable: false,
                render: function (data, type, row) {
                    return `
                        <button class='btn btn-sm btn-primary' onclick='editarUsuario(${row.id})'>
                            <i class='fas fa-pen'></i>
                        </button>
                        <button class='btn btn-sm btn-danger' onclick='deletarUsuario(${row.id})'>
                            <i class='fas fa-trash'></i>
                        </button>
                        <button class='btn btn-sm btn-info' onclick='visualizarUsuario(${row.id})'>
                            <i class='fas fa-eye'></i>
                        </button>
                    `;
                }
            }
        ]
    });
});

function carregarUsuarios() {
    tabela.ajax.reload(null, false); // Mantém a página atual
}

let usuarioEditandoId = null;

function editarUsuario(id) {
    $.get(`/users/${id}`, function (user) {
        $('#nome').val(user.name);
        $('#email').val(user.email);
        $('#phone').val(user.phone);
        usuarioEditandoId = id;
        $('#modalUsuario').modal('show'); // Usar Bootstrap modal
    });
}

function salvarUsuario() {
    let nome = $('#nome').val();
    let email = $('#email').val();
    let phone = $('#phone').val();

    if (usuarioEditandoId) {
        // Atualizar
        $.ajax({
            url: `/users/update/${usuarioEditandoId}`,
            type: "POST", // PHP normalmente não aceita PUT diretamente sem spoofing
            data: {
                _method: "PUT",
                name: nome,
                email: email,
                phone: phone
            },
            success: function (res) {
                Swal.fire(res.message || "Usuário Atualizado!", "", "success");
                $('#modalUsuario').modal('hide');
                carregarUsuarios();
                usuarioEditandoId = null;
            },
            error: function (xhr) {
                const res = xhr.responseJSON;
                Swal.fire("Erro!", res?.error || "Erro ao atualizar", "error");
            }
        });
    } else {
        // Criar
        $.post('/users/create', { name: nome, email: email, phone: phone }, function (res) {
            Swal.fire(res.message || "Usuário criado!", "", "success");
            $('#modalUsuario').modal('hide');
            carregarUsuarios();
        }).fail((xhr) => {
            const res = xhr.responseJSON;
            Swal.fire("Erro!", res?.error || "Erro ao adicionar", "error");
        });
    }
}

function abrirModal() {
    $('#nome, #email, #phone').val('');
    usuarioEditandoId = null;
    $('#modalUsuario').modal('show');
}

function fecharModal() {
    $('#modalUsuario').modal('hide');
}

function deletarUsuario(id) {
    Swal.fire({
        title: "Tem certeza?",
        text: "Isso excluirá o usuário permanentemente!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        confirmButtonText: "Sim, excluir!"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: `/users/delete/${id}`,
                type: "POST",
                data: { _method: "DELETE" },
                success: function (res) {
                    Swal.fire(res.message || "Usuário excluído!", "", "success");
                    carregarUsuarios();
                },
                error: function (xhr) {
                    const res = xhr.responseJSON;
                    Swal.fire("Erro!", res?.error || "Erro ao excluir", "error");
                }
            });
        }
    });
}

function visualizarUsuario(id) {
    $.get(`/users/${id}`, function (user) {
        Swal.fire({
            title: `Usuário: ${user.name}`,
            html: `
                <p><strong>Email:</strong> ${user.email}</p>
                <p><strong>Telefone:</strong> ${user.phone || '—'}</p>
            `,
            icon: "info"
        });
    });
}

function limparCampos() {
    $('#nome, #email, #phone').val('');
    usuarioEditandoId = null;
}