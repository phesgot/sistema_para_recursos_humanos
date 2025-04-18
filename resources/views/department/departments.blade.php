<x-layout-app page-title='Departamentos'>

    <div class="w-100 p-4">

        <h3>Departamentos</h3>

        <hr>

        @if ($departments->count() === 0)
            <div class="text-center my-5">
                <p>Nenhum departamento cadastrado.</p>
                <a href="{{ route('department.new-department') }}" class="btn btn-primary">Criar um novo departamento</a>
            </div>
        @else
            <div class="mb-3">
                <a href="{{ route('department.new-department') }}" class="btn btn-primary">Criar um novo departamento</a>
            </div>

            <table class="table w-50" id="table">
                <thead class="table-dark">
                    <th>Departamento</th>
                    <th></th>
                </thead>
                <tbody>

                    @foreach ($departments as $department)
                        <tr>
                            <td>{{ $department->name }}</td>
                            <td>
                                <div class="d-flex gap-3 justify-content-end">
                                    <a href="#" class="btn btn-sm btn-outline-dark"><i
                                            class="fa-regular fa-pen-to-square me-2"></i>Editar</a>
                                    <a href="#" class="btn btn-sm btn-outline-dark"><i
                                            class="fa-regular fa-trash-can me-2"></i>Deletar</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        @endif

    </div>


</x-layout-app>
