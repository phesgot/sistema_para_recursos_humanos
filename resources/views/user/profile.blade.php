<x-layout-app page-title='Perfil'>

    <div class="w-100 p-4">

        <h3>Perfil</h3>

        <hr>
        <x-profile-user-data />

        <hr>

        <div class="cintainer-fluid m-0 p-0 mt-5">
            <div class="row">

                <x-profile-user-change-password />

                <x-profile-user-change-data :colaborator="$colaborator" />

                <x-profile-user-change-address :colaborator="$colaborator" />

            </div>
        </div>

    </div>

</x-layout-app>
