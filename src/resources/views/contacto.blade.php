@extends('layouts.public')

@section('title', 'Contacto — '.config('app.name'))

@section('content')

<section class="contact-page">
    <div class="contact-header contact-hero">
        <div>
            <p class="eyebrow">Atención al cliente</p>
            <h1>Contacto</h1>
            <p class="contact-hero-text">Escríbenos cualquier duda sobre instalaciones, actividades o reservas.</p>
        </div>
    </div>

    <div class="contact-grid">
        <section class="contact-card">
            <h2>Envíanos un mensaje</h2>

            <form method="POST" action="{{ route('contact.store') }}" class="contact-form">
                @csrf

                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Tu nombre" required>
                    @error('name')<p class="field-error">{{ $message }}</p>@enderror
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="tu@email.com" required>
                    @error('email')<p class="field-error">{{ $message }}</p>@enderror
                </div>

                <div class="form-group">
                    <label for="subject">Asunto</label>
                    <input type="text" id="subject" name="subject" value="{{ old('subject') }}" placeholder="¿En qué podemos ayudarte?" required>
                    @error('subject')<p class="field-error">{{ $message }}</p>@enderror
                </div>

                <div class="form-group">
                    <label for="message">Mensaje</label>
                    <textarea id="message" name="message" rows="6" placeholder="Escribe tu mensaje aquí..." required>{{ old('message') }}</textarea>
                    @error('message')<p class="field-error">{{ $message }}</p>@enderror
                </div>

                <button type="submit" class="contact-submit">Enviar mensaje</button>
            </form>
        </section>

        <div class="contact-right">
            <section class="contact-card">
                <h2>Información de contacto</h2>

                <div class="contact-info-list">
                    <div class="contact-info-item">
                        <div class="contact-icon" aria-hidden="true">📍</div>
                        <div>
                            <h3>Dirección</h3>
                            <p>Av. Deportiva 123, Madrid</p>
                        </div>
                    </div>

                    <div class="contact-info-item">
                        <div class="contact-icon" aria-hidden="true">📞</div>
                        <div>
                            <h3>Teléfono</h3>
                            <p>+34 91 234 56 78</p>
                        </div>
                    </div>

                    <div class="contact-info-item">
                        <div class="contact-icon" aria-hidden="true">✉️</div>
                        <div>
                            <h3>Email</h3>
                            <p>info@g5sport.com</p>
                        </div>
                    </div>

                    <div class="contact-info-item">
                        <div class="contact-icon" aria-hidden="true">🕒</div>
                        <div>
                            <h3>Horario</h3>
                            <p>Lunes a Viernes: 6:00 - 23:00</p>
                            <p>Sábados: 8:00 - 22:00</p>
                            <p>Domingos: 9:00 - 20:00</p>
                        </div>
                    </div>
                </div>
            </section>

            <section class="contact-card location-card">
                <h2>Ubicación</h2>
                <div class="map-placeholder">Mapa de ubicación</div>
            </section>
        </div>
    </div>
</section>

@endsection