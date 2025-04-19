<x-layout-app page-title="Novo colaborador do RH">

    <div class="w-100 p-4">

        <div class="container-fluid">
            <div class="row">
                <div class="col-4">

                    <h3>Novo colaborador do Recursos Humanos</h3>

                    <hr>

                    <form action="#" method="post">

                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="selec_department" class="form-label">Departamento</label>
                            <select name="department" id="department" class="form-select">
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->name   }}</option>
                                @endforeach
                            </select>
                        </div>

                        <p class="mb-3">Perfil: <strong>Recursos Humanos</strong></p>

                        <div class="mb-3">
                            <a href="{{ route('colaborators.rh-users') }}"
                                class="btn btn-outline-danger me-3">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Cadastrat colaborador</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>


    </div>

</x-layout-app>
