@extends('layouts.app', ['activePage' => 'produto-management', 'titlePage' => __('Produto')])


@section('content')
    <table class="table datatable">
        <p>oii</p>
        <thead class=" text-primary">
            <th>
                ID
            </th>
            <th>
                {{ __('Nome') }}
            </th>

            <th>
                {{-- Aqui é para fazer a pesquisa --}}
                {{ __('Actions') }}
            </th>
        </thead>
        {{-- tbody é a parte da exibição dos produtos cadastrados --}}
        <tbody>
            {{-- <p>oiiiiiiii</p> --}}


            @foreach ($produtos as $produto)
                <tr>
                    <td>{{ $produto->id }}</td>
                    <td>{{ $produto->nome }}</td>
                    <td>
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

                    </td>
                </tr>
            @endforeach


        </tbody>
    </table>
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
