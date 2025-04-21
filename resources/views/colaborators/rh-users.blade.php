<x-layout-app page-title='Recursos Humanos'>
    <div class="w-100 p-4">
        <h3>Recursos Humanos Colaboradores</h3>
        <hr>
        @if ($colaboradores->count() === 0)
            <div class="text-center my-5">
                <p>Nenhum colaborador cadastrado.</p>
                <a href="{{ route('colaborators.new-colaborator') }}" class="btn btn-primary">Cadastrar um novo
                    colaborador</a>
            </div>
        @else
            <div class="mb-3">
                <a href="{{ route('colaborators.new-colaborator') }}" class="btn btn-primary">Cadastrar um novo
                    colaborador</a>
            </div>
            <table class="table w-50" id="table">
                <thead class="table-dark">
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Permissões</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($colaboradores as $colaborador)
                        <tr>
                            <td>{{ $colaborador->name }}</td>
                            <td>{{ $colaborador->email }}</td>
                            @php
                                $permissions = json_decode($colaborador->permissions);
                            @endphp
                            <td>{{ implode(',', $permissions) }}</td>
                            <td>
                                <div class="d-flex gap-3 justify-content-end">
                                    <a href="#" class="btn btn-sm btn-outline-dark">
                                        <i class="fa-regular fa-pen-to-square me-2"></i>Editar
                                    </a>
                                    <a href="#" class="btn btn-sm btn-outline-dark">
                                        <i class="fa-regular fa-trash-can me-2"></i>Deletar
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</x-layout-app>
