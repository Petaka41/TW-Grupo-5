<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Mi perfil
        </h2>
    </x-slot>

    <div class="profile-page">
        <div class="profile-hero">
            <div>
                <p class="eyebrow">Área privada</p>
                <h1>Tu cuenta</h1>
                <p class="profile-hero-text">Actualiza tus datos, contraseña y preferencias de acceso desde aquí.</p>
            </div>

            <div class="profile-badges">
                <span class="mini-badge">{{ $user->isAdmin() ? 'Administrador' : 'Socio' }}</span>
                <span class="mini-badge muted">{{ $user->email }}</span>
            </div>
        </div>

        <div class="profile-grid">
            <section class="profile-card">
                @include('profile.partials.update-profile-information-form')
            </section>

            <section class="profile-card">
                @include('profile.partials.update-password-form')
            </section>

            <section class="profile-card profile-card-danger">
                @include('profile.partials.delete-user-form')
            </section>
        </div>
    </div>
</x-app-layout>