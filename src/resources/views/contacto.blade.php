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
                <div class="map-container">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3037.5892618729586!2d-3.6882109!3d40.4168!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNDDCsDI1JzAwLjUiTiAzwrA0MScxNy42Ilc!5e0!3m2!1ses!2ses!4v1234567890"
                        width="100%" 
                        height="300" 
                        style="border:0; border-radius: 8px;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade"
                        title="Ubicación del centro deportivo G5Sport">
                    </iframe>
                </div>
            </section>
        </div>
    </div>
</section>

@endsection