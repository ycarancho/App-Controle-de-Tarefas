<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <style>
        .page-break {
            page-break-after: always;
        }

        .titulo {
            border: 1px;
            background-color: #c2c2c2;
            text-align: center;
            width: 100%;
            text-transform: uppercase;
            font-weight: bold;
            margin-bottom: 25px
        }

        .tabela {
            width: 100%
        }

        table th {
            text-align: left
        }
    </style>
</head>

<body>
    <h2 class="titulo">Listagem de tarefas em PDF</h2>

    <table class="tabela">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tarefa</th>
                <th>Data limite Conclusão</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tarefas as $key => $value)
                <tr>
                    <td>{{ $value->id }}</td>
                    <td>{{ $value->tarefa }}</td>
                    <td>{{ date('d/m/Y', strtotime($value->data_conclusao)) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="page-break">
    </div>
    <h2>Pagina 2</h2>
    <div class="page-break">
    </div>
    <h2>Pagina 3</h2>
    <div class="page-break">
    </div>
    <h2>Pagina 4</h2>

</body>

</html>
