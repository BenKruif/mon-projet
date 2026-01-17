<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'EcoleInfoA') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:400,500,600,700,800&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }

        .animated-bg {
            background: linear-gradient(-45deg, #0a0e27, #1a1f3a, #2d1b69, #1e3a8a);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
        }

        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .input-dark {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: white;
        }

        .input-dark::placeholder {
            color: rgba(255, 255, 255, 0.4);
        }

        .input-dark:focus {
            background: rgba(255, 255, 255, 0.08);
            border-color: rgba(139, 92, 246, 0.5);
            box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.2);
        }

        .btn-glow {
            position: relative;
            overflow: hidden;
        }

        .btn-glow::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: 0.5s;
        }

        .btn-glow:hover::before {
            left: 100%;
        }

        .floating {
            animation: floating 6s ease-in-out infinite;
        }

        @keyframes floating {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        .particle {
            position: absolute;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(139, 92, 246, 0.6), transparent);
            animation: particle-float 10s ease-in-out infinite;
        }

        @keyframes particle-float {
            0%, 100% { transform: translate(0, 0) scale(1); opacity: 0.3; }
            50% { transform: translate(50px, -50px) scale(1.3); opacity: 0.6; }
        }
    </style>
</head>

<body class="antialiased">
    <div class="min-h-screen animated-bg relative overflow-hidden flex flex-col items-center justify-center px-4 py-12">
        <!-- Particules décoratives -->
        <div class="particle" style="width: 15px; height: 15px; top: 20%; left: 10%;"></div>
        <div class="particle" style="width: 20px; height: 20px; top: 60%; right: 15%; animation-delay: 2s;"></div>
        <div class="particle" style="width: 12px; height: 12px; bottom: 30%; left: 25%; animation-delay: 4s;"></div>

        <!-- Logo avec lien vers accueil -->
        <div class="mb-8 floating">
            <a href="{{ route('home') }}" class="inline-block transition-transform hover:scale-110">
                <div class="glass-card rounded-2xl p-5 border border-purple-500/30">
                    <svg class="w-14 h-14 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
            </a>
        </div>

        <div class="w-full sm:max-w-lg glass-card rounded-3xl p-8 md:p-10 shadow-2xl border border-white/10">
            {{ $slot }}
        </div>

        <!-- Footer -->
        <div class="mt-8 text-center">
            <p class="text-gray-500 text-xs">© 2025 EcoleInfoA - Tous droits réservés</p>
        </div>
    </div>
</body>

</html>
