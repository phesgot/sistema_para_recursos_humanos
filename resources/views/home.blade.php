<x-layout-app page-title="Home">
    <h1 class="text-center my-5">DENTRO DO APP</h1>

    @can('admin')
    <h3 class="text-center">É o usuário Admin que está logado</h3>        
    @endcan

</x-layout-app>