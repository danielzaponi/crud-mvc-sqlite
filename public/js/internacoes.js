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
            url: "/internacoes/list", // Nova rota
            type: "POST",
            dataSrc: "data"
        },
        order: [[0, 'desc']],
        columns: [
            { data: "id" },
            { data: "paciente", title: "Nome" },
            { data: "sexo", title: "Sexo" },
            { data: "apartamento", title: "Apartamento" },
            { data: "leito", title: "Leito" },
            { data: "convenio", title: "Convênio" },
            {
                data: null,
                orderable: false,
                searchable: false,
                render: function (data, type, row) {
                    return `
                        <button class='btn btn-sm btn-primary' onclick='editarInternacao(${row.id})'>
                            <i class='fas fa-pen'></i>
                        </button>
                        <button class='btn btn-sm btn-danger' onclick='deletarInternacao(${row.id})'>
                            <i class='fas fa-trash'></i>
                        </button>
                        <button class='btn btn-sm btn-info' onclick='visualizarInternacao(${row.id})'>
                            <i class='fas fa-eye'></i>
                        </button>
                    `;
                }
            }
        ]
    });
});

function carregarInternacoes() {
    tabela.ajax.reload(null, false);
}

let internacaoEditandoId = null;

function editarInternacao(id) {
    $.get(`/internacoes/${id}`, function (data) {
        $('#paciente').val(data.paciente);
        $('#sexo').val(data.sexo);
        $('#apartamento').val(data.apartamento);
        $('#leito').val(data.leito);
        $('#convenio').val(data.convenio);
        internacaoEditandoId = id;
        $('#modalInternacao').modal('show');
    });
}

function salvarInternacao() {
    let paciente = $('#paciente').val();
    let sexo = $('#sexo').val();
    let apartamento = $('#apartamento').val();
    let leito = $('#leito').val();
    let convenio = $('#convenio').val();

    if (internacaoEditandoId) {
        $.ajax({
            url: `/internacoes/update/${internacaoEditandoId}`,
            type: "POST",
            data: {
                _method: "PUT",
                paciente,
                sexo,
                apartamento,
                leito,
                convenio
            },
            success: function (res) {
                Swal.fire(res.message || "Registro atualizado!", "", "success");
                $('#modalInternacao').modal('hide');
                carregarInternacoes();
                internacaoEditandoId = null;
            },
            error: function (xhr) {
                const res = xhr.responseJSON;
                Swal.fire("Erro!", res?.error || "Erro ao atualizar", "error");
            }
        });
    } else {
        $.post('/internacoes/create', {
            paciente,
            sexo,
            apartamento,
            leito,
            convenio
        }, function (res) {
            Swal.fire(res.message || "Registro criado!", "", "success");
            $('#modalInternacao').modal('hide');
            carregarInternacoes();
        }).fail((xhr) => {
            const res = xhr.responseJSON;
            Swal.fire("Erro!", res?.error || "Erro ao adicionar", "error");
        });
    }
}

function abrirModal() {
    $('#paciente, #sexo, #apartamento, #leito, #convenio').val('');
    internacaoEditandoId = null;
    $('#modalInternacao').modal('show');
}

function fecharModal() {
    $('#modalInternacao').modal('hide');
}

function deletarInternacao(id) {
    Swal.fire({
        title: "Tem certeza?",
        text: "Isso excluirá o registro permanentemente!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        confirmButtonText: "Sim, excluir!"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: `/internacoes/delete/${id}`,
                type: "POST",
                data: { _method: "DELETE" },
                success: function (res) {
                    Swal.fire(res.message || "Registro excluído!", "", "success");
                    carregarInternacoes();
                },
                error: function (xhr) {
                    const res = xhr.responseJSON;
                    Swal.fire("Erro!", res?.error || "Erro ao excluir", "error");
                }
            });
        }
    });
}

function visualizarInternacao(id) {
    $.get(`/internacoes/${id}`, function (data) {
        Swal.fire({
            title: `Paciente: ${data.paciente}`,
            html: `
                <p><strong>Sexo:</strong> ${data.sexo || '—'}</p>
                <p><strong>Apartamento:</strong> ${data.apartamento || '—'}</p>
                <p><strong>Leito:</strong> ${data.leito || '—'}</p>
                <p><strong>Convênio:</strong> ${data.convenio || '—'}</p>
            `,
            icon: "info"
        });
    });
}

function limparCampos() {
    $('#paciente, #sexo, #apartamento, #leito, #convenio').val('');
    internacaoEditandoId = null;
}