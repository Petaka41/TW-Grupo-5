<x-guest-layout>
    <div class="auth-header">
        <p class="eyebrow">Acceso</p>
        <h2>Iniciar sesión</h2>
        <p>Entra con tu cuenta para gestionar reservas o acceder al panel de administración si eres admin.</p>
    </div>

    <x-auth-session-status class="auth-status" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="auth-form">
        @csrf

        <div class="auth-field">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <div class="auth-field">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" />
        </div>

        <div class="auth-row">
            <label for="remember_me" class="auth-remember">
                <input id="remember_me" type="checkbox" class="auth-checkbox" name="remember">
                <span>{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="auth-link" href="{{ route('password.request') }}">{{ __('Forgot your password?') }}</a>
            @endif
        </div>

        <div class="auth-actions">
            <x-primary-button class="w-full justify-center">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>

    <p class="auth-footer-link">
        {{ __('Need an account?') }} <a href="{{ route('register') }}">{{ __('Register') }}</a>
    </p>
    </form>
</x-guest-layout>
