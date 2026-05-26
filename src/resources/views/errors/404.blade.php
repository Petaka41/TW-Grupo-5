<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Página no encontrada - G5 Sport</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .error-page {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            text-align: center;
            padding: 2rem;
        }

        .error-logo {
            width: 150px;
            height: auto;
            margin-bottom: 2rem;
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
        }

        .error-code {
            font-size: 8rem;
            font-weight: 800;
            color: #e94560;
            margin: 0;
            line-height: 1;
            text-shadow: 4px 4px 0px rgba(233, 69, 96, 0.3);
        }

        .error-title {
            font-size: 2rem;
            color: #ffffff;
            margin: 1rem 0;
            font-weight: 600;
        }

        .error-message {
            font-size: 1.1rem;
            color: #a0a0a0;
            max-width: 500px;
            margin: 0 auto 2rem;
            line-height: 1.6;
        }

        .error-actions {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            justify-content: center;
        }

        .error-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.875rem 1.75rem;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .error-btn-primary {
            background: #e94560;
            color: #ffffff;
        }

        .error-btn-primary:hover {
            background: #d63d56;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(233, 69, 96, 0.3);
        }

        .error-btn-secondary {
            background: transparent;
            color: #ffffff;
            border: 2px solid #ffffff;
        }

        .error-btn-secondary:hover {
            background: #ffffff;
            color: #1a1a2e;
            transform: translateY(-2px);
        }

        .error-decoration {
            position: absolute;
            opacity: 0.1;
            font-size: 20rem;
            font-weight: 900;
            color: #e94560;
            z-index: 0;
            user-select: none;
        }

        .error-decoration-left {
            left: -5%;
            top: 20%;
        }

        .error-decoration-right {
            right: -5%;
            bottom: 20%;
        }

        .error-content {
            position: relative;
            z-index: 1;
        }

        .brand-name {
            color: #e94560;
            font-weight: 700;
        }
    </style>
</head>
<body>
    <div class="error-page">
        <span class="error-decoration error-decoration-left">4</span>
        <span class="error-decoration error-decoration-right">4</span>

        <div class="error-content">
            <img src="{{ asset('images/logo-con-nombre.png') }}" alt="Logo G5 Sport" class="error-logo">

            <h1 class="error-code">404</h1>

            <h2 class="error-title">¡Ups! Página no encontrada</h2>

            <p class="error-message">
                Lo sentimos, la página que buscas no existe o ha sido movida.
                Pero no te preocupes, puedes volver al inicio o explorar nuestras actividades.
            </p>

            <div class="error-actions">
                <a href="{{ url('/') }}" class="error-btn error-btn-primary">
                    Volver al inicio
                </a>
            </div>
        </div>
    </div>
</body>
</html>
