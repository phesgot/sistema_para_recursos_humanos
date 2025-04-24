<x-layout-app page-title='Recursos Humanos'>
    <div class="w-100 p-4">
        <h3>Recursos Humanos Colaboradores</h3>
        <hr>

        @if ($colaborators->count() === 0)
            <div class="text-center my-5">
                <p>Nenhum colaborador cadastrado.</p>
                <a href="{{ route('colaborators.rh.new-colaborator') }}" class="btn btn-primary">Cadastrar um novo
                    colaborador</a>
            </div>
        @else
            <div class="mb-3">
                <a href="{{ route('colaborators.rh.new-colaborator') }}" class="btn btn-primary">Cadastrar um novo
                    colaborador</a>
            </div>
            <table class="table" id="table">
                <thead class="table-dark">
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Ativo</th>
                    <th>Departamento</th>
                    <th>Papel</th>
                    <th>Data de admissão</th>
                    <th>Salário</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($colaborators as $colaborator)
                        <tr>
                            <td>{{ $colaborator->name }}</td>
                            <td>{{ $colaborator->email }}</td>
                            <td>
                                @empty($colaborator->email_verified_at)
                                    <span class="badge bg-danger">Não</span>
                                @else
                                    <span class="badge bg-success">Sim</span>
                                @endempty
                            </td>
                            <td>{{ $colaborator->department->name  ?? "-" }}</td>
                            <td>{{ $colaborator->role }}</td>
                            <td>{{ $colaborator->detail->admission_date }}</td>
                            <td>R$ {{ $colaborator->detail->salary }}</td>
                            <td>
                                <div class="d-flex gap-3 justify-content-end">

                                    @empty($colaborator->deleted_at)
                                        <a href="{{ route('colaborators.rh.delete', ['id' => $colaborator->id]) }}"
                                            class="btn btn-sm btn-outline-dark ms-3">
                                            <i class="fa-regular fa-trash-can me-2"></i>Deletar
                                        </a>
                                        <a href="{{ route('colaborators.rh.edit-colaborator', ['id' => $colaborator->id]) }}"
                                            class="btn btn-sm btn-outline-dark ms-3">
                                            <i class="fa-regular fa-pen-to-square me-2"></i>Editar
                                        </a>
                                    @else
                                        <a href="{{ route('colaborators.rh.restore', ['id' => $colaborator->id]) }}"
                                            class="btn btn-sm btn-outline-dark ms-3">
                                            <i class="fa-solid fa-trash-arrow-up me-2"></i>Restaurar
                                        </a>
                                    @endempty

                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

    </div>
</x-layout-app>
