<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Crear contenido admin
        </h2>
    </x-slot>

    <div class="admin-page">
        <section class="panel-surface">
            <h1>Crear desde el panel</h1>
            <p>Las altas reales del proyecto están en los recursos de actividades y turnos. Usa este acceso como hub de trabajo.</p>

            <div class="action-row">
                <a class="action-button" href="{{ route('admin.activities.create') }}">Nueva actividad</a>
                <a class="action-button action-button-secondary" href="{{ route('admin.activities.index') }}">Volver al listado</a>
            </div>
        </section>
    </div>
</x-app-layout>