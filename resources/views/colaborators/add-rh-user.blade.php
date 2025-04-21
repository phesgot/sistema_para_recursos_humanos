<x-layout-app page-title="Novo colaborador do RH">

    <div class="w-100 p-4">

        <div class="container-fluid">
            <div class="row">
                <div class="col-4">

                    <h3>Novo colaborador do Recursos Humanos</h3>

                    <hr>

                    <form action="{{ route('colaborators.create-colaborator') }}" method="post">

                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name">
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email">
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <div class="d-flex">
                                <div class="flex-grow-1 pe-3">
                                    <label for="select_department" class="form-label">Departamento</label>
                                    <select name="select_department" id="select_department" class="form-select">
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('select_department')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div>
                                    <a href="{{ route('department.new-department') }}" class="btn btn-outline-primary mt-4">
                                        <i class="fas fa-plus"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <p class="mb-3">Perfil: <strong>Recursos Humanos</strong></p>

                        <div class="mb-3">
                            <a href="{{ route('colaborators.rh-users') }}"
                                class="btn btn-outline-danger me-3">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Cadastrar colaborador</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>


    </div>

</x-layout-app>
