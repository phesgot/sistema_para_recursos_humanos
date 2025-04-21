<x-layout-app page-title='Deletar colaborador'>
    <div class="w-25 p-4">

        <h3>Deletar colaborador</h3>

        <hr>

        <p>Você tem certeza que deseja deletar este colaborador do RH ?</p>

        <div class="text-center">
            <h3 class="my-5">{{ $colaborador->name }}</h3>
            <a href="{{ route('colaborators.rh-users') }}" class="btn btn-secondary px-5">Não</a>
            <a href="{{ route('colaborators.rh.delete-confirm', ['id' => $colaborador->id]) }}"
                class="btn btn-danger px-5">Sim</a>
        </div>

    </div>

</x-layout-app>
