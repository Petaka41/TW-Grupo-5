<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar contenido admin
        </h2>
    </x-slot>

    <div class="admin-page">
        <section class="panel-surface">
            <h1>Editar desde el panel</h1>
            <p>La edición real se hace desde cada recurso. Este acceso agrupa los puntos de entrada más usados por administración.</p>

            <div class="action-row">
                <a class="action-button" href="{{ route('admin.activities.index') }}">Editar actividades</a>
                <a class="action-button action-button-secondary" href="{{ route('admin.index') }}">Ir al panel</a>
            </div>
        </section>
    </div>
</x-app-layout>