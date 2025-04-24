<x-layout-app page-title="Home">

    <div class="w-100 p-4">
        <h3>Home</h3>
        <hr>

        <x-info-title-value item-title="Total de colaboradores" :item-value="$data['total_colaborators']" />
        <x-info-title-value item-title="Total de colaboradores deletado" :item-value="$data['total_colaborators_deleted']" />
        <x-info-title-value item-title="Somatório dos salários" :item-value="$data['total_salary']" />
    </div>

</x-layout-app>