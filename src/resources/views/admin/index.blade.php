<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Panel de administración
        </h2>
    </x-slot>

    <div class="admin-page">
        <section class="admin-hero">
            <div>
                <p class="eyebrow">Frontend privado</p>
                <h1>Gestión del centro</h1>
                <p class="admin-hero-text">Aquí centralizas actividades, horarios y acceso al contenido de administración.</p>
            </div>

            <div class="admin-hero-actions">
                <a href="{{ route('admin.activities.index') }}" class="action-button">Ver actividades</a>
                <a href="{{ route('admin.activities.create') }}" class="action-button action-button-secondary">Crear actividad</a>
            </div>
        </section>

        <section class="admin-grid">
            <article class="action-card">
                <h3>Actividades</h3>
                <p>Alta, edición y borrado de actividades con capacidad e imagen.</p>
                <a href="{{ route('admin.activities.index') }}">Abrir listado</a>
            </article>

            <article class="action-card">
                <h3>Turnos</h3>
                <p>Gestión de horarios por actividad con control de solapes.</p>
                <a href="{{ route('admin.activities.index') }}">Ir a horarios</a>
            </article>

            <article class="action-card">
                <h3>Plantillas</h3>
                <p>Accesos rápidos a las vistas genéricas de crear y editar.</p>
                <a href="{{ route('admin.create') }}">Crear</a>
            </article>
        </section>
    </div>
</x-app-layout>