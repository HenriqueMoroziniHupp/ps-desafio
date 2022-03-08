@extends('layouts.app', ['activePage' => 'produto-management', 'titlePage' => __('Produto')])


@section('content')

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Todo List</title>

        <style>
            /* info {

                                                                                                                                                                                                                    } */
            body {
                /* background-color: #18243c; */
                font-family: 'Montserrat', 'Avenir', 'Helvetica', 'Arial', sans-serif;
                font-size: 16px;
            }

            #app {
                padding: 3rem;
                display: grid;
                justify-content: center;
                /* grid-template-columns: minmax(0px, 450px); */
                grid-gap: 1rem;
            }


            .info {
                color: #ececf6;
                background-color: #2b3a4e;
                padding: 0.5rem;
                border-radius: 1rem;

                display: grid;
                grid-template-columns: max-content 1fr;
                gap: 0.5rem
            }




            .list {
                color: #ececf6;
                background-color: #2b3a4e;
                padding: 0.5rem;
                border-radius: 1rem;
                display: grid;
                align-items: center;
                grid-template-columns: minmax(max-content, max-content);
                justify-content: start;
                grid-gap: 0.3rem;
            }

        </style>
    </head>



    <body>
        <div id="app">

            <div class="info">
                <div> {{ __('ID') }} </div>
                <div> {{ __('Nome') }} </div>
            </div>

            @foreach ($produtos as $produto)
                <li class="list">
                    <div class="info">
                        <div>{{ $produto->id }}- </div>
                        <div>{{ $produto->nome }}</div>
                    </div>
                    <div> {{-- Ações --}}

                        <!-- botao editar -->
                        <a href="{{ route('produto.edit', $produto->id) }}">
                            <button type="button" title="{{ __('Edit') }}" class="btn btn-warning">
                                <i class="material-icons" style="color: white">edit</i>
                            </button>
                        </a>
                        <!-- Botao apagar -->
                        <button type="button" title="{{ __('Delete') }}" data-toggle="modal" data-target="#modal-excluir"
                            data-id="{{ $produto->id }}" class="btn btn-danger">
                            <i class="material-icons">close</i>
                        </button>
                        <!-- Botao visualizar -->
                        <button type="button" title="{{ __('Visualizar') }}" data-toggle="modal"
                            data-target="#modal-detalhes" data-id="{{ $produto->id }}" class="btn btn-danger">
                            <i class="material-icons">visibility</i>
                        </button>
                    </div>
                </li>
            @endforeach


        </div>
    </body>
@endsection

@push('js')
    <!-- Scripts Here -->
    <script>
        /* js para abrir Modal de Detalhes de forma dinâmica com as informações desejadas */
        $('#modal-detalhes').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            let modal = $(this)
            const id = button.data('id')
            const url = 'produto/' + id
            $.getJSON(url, (resposta) => {
                console.log(resposta);
                $("#detalhes-nome").val(resposta.nome);
                $("#detalhes-preço").val(resposta.preco);
                $("#detalhes-descricao").val(resposta.descricao);
                $("#detalhes-quantidade").val(resposta.quantidade);
                $("#detalhes-categoria").val(resposta.categoria);
                $("#detalhes-imagem").attr('src', '/storage/' + resposta.imagem);
            });
        })
        /* js para abrir Modal de excluir de forma dinâmica */
        $('#modal-excluir').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            const id = button.data('id')
            const url2 = 'produto/' + id
            $('#form-excluir').attr('action', 'produto/' + id)
        })
    </script>
@endpush
