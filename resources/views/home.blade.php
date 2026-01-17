<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'EcoleInfoA') }} - Portail Étudiant</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:400,500,600,700,800,900&display=swap" rel="stylesheet" />

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
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .glass-card:hover {
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .floating {
            animation: floating 6s ease-in-out infinite;
        }

        @keyframes floating {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
        }

        .publication-card {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .publication-card:hover {
            transform: translateY(-8px) scale(1.02);
        }

        .scroll-indicator {
            animation: bounce 2s infinite;
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(10px); }
        }
    </style>
</head>

<body class="antialiased">
    <!-- Hero Section -->
    <div class="min-h-screen animated-bg relative overflow-hidden">
        <!-- Navigation -->
        <nav class="absolute top-0 left-0 right-0 z-50 px-6 py-4">
            <div class="max-w-7xl mx-auto flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-white/10 backdrop-blur-sm rounded-xl flex items-center justify-center border border-white/20">
                        <svg class="w-7 h-7 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <span class="text-2xl font-black text-white">École<span class="text-purple-400">InfoA</span></span>
                </div>
                <div class="flex items-center gap-4">
                    @auth
                        <a href="{{ Auth::user()->role === 'etudiant' ? route('dashboard.etudiant') : route('dashboard.professeur') }}" 
                           class="px-6 py-2.5 bg-white/10 backdrop-blur-sm text-white font-semibold rounded-xl border border-white/20 hover:bg-white/20 transition-all">
                            Mon Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="px-6 py-2.5 text-white/80 hover:text-white font-semibold transition-colors">
                            Connexion
                        </a>
                        <a href="{{ route('register') }}" class="px-6 py-2.5 bg-gradient-to-r from-purple-600 to-indigo-600 text-white font-semibold rounded-xl hover:from-purple-700 hover:to-indigo-700 transition-all shadow-lg shadow-purple-500/30">
                            S'inscrire
                        </a>
                    @endauth
                </div>
            </div>
        </nav>

        <!-- Hero Content -->
        <div class="relative z-10 flex flex-col items-center justify-center min-h-screen px-4 pt-20">
            <div class="text-center mb-12 floating">
                <div class="inline-block mb-6">
                    <span class="px-4 py-2 bg-purple-500/20 backdrop-blur-sm text-purple-300 text-sm font-semibold rounded-full border border-purple-400/30">
                        🎓 Plateforme Éducative PIGIER
                    </span>
                </div>
                <h1 class="text-5xl md:text-7xl font-black text-white mb-6 leading-tight">
                    Bienvenue sur<br>
                    <span class="bg-gradient-to-r from-purple-400 via-pink-400 to-indigo-400 bg-clip-text text-transparent">
                        EcoleInfoA
                    </span>
                </h1>
                <p class="text-xl text-gray-300 max-w-2xl mx-auto mb-10 leading-relaxed">
                    Votre portail unique pour accéder aux informations, notes, emplois du temps et alertes de l'établissement.
                </p>

                <div class="flex flex-wrap justify-center gap-4">
                    <a href="{{ route('login.etudiant') }}" class="group px-8 py-4 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold rounded-2xl hover:from-indigo-700 hover:to-purple-700 transition-all shadow-xl shadow-purple-500/30 flex items-center gap-3">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                        </svg>
                        Espace Étudiant
                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </a>
                    <a href="{{ route('login.professeur') }}" class="group px-8 py-4 bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-bold rounded-2xl hover:from-emerald-700 hover:to-teal-700 transition-all shadow-xl shadow-emerald-500/30 flex items-center gap-3">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        Espace Professeur
                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </a>
                </div>

                @guest
                <p class="mt-8 text-gray-400">
                    Pas encore de compte ? 
                    <a href="{{ route('register') }}" class="text-purple-400 hover:text-purple-300 font-semibold underline">
                        Inscrivez-vous ici
                    </a>
                </p>
                @endguest
            </div>

            <!-- Scroll Indicator -->
            @if(isset($publications) && $publications->count() > 0 || isset($publicationsEpinglees) && $publicationsEpinglees->count() > 0)
            <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 scroll-indicator">
                <a href="#publications" class="flex flex-col items-center text-white/60 hover:text-white transition-colors">
                    <span class="text-sm mb-2">Voir les actualités</span>
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                    </svg>
                </a>
            </div>
            @endif
        </div>
    </div>

    <!-- Publications Section -->
    @if((isset($publicationsEpinglees) && $publicationsEpinglees->count() > 0) || (isset($publications) && $publications->count() > 0))
    <section id="publications" class="py-20 bg-gradient-to-b from-gray-900 to-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="px-4 py-2 bg-purple-500/20 text-purple-400 text-sm font-semibold rounded-full">
                    📢 Actualités
                </span>
                <h2 class="text-4xl font-black text-white mt-6 mb-4">Dernières Publications</h2>
                <p class="text-gray-400 text-lg max-w-2xl mx-auto">
                    Restez informé des dernières annonces et informations de l'établissement
                </p>
            </div>

            <!-- Publications Épinglées -->
            @if(isset($publicationsEpinglees) && $publicationsEpinglees->count() > 0)
            <div class="mb-12">
                <h3 class="text-xl font-bold text-white mb-6 flex items-center gap-2">
                    <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
                    </svg>
                    À la une
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($publicationsEpinglees as $pub)
                    <div class="publication-card bg-gradient-to-br from-yellow-500/10 to-orange-500/10 backdrop-blur-sm rounded-2xl p-6 border border-yellow-500/20 shadow-xl">
                        <div class="flex items-center gap-2 mb-4">
                            <span class="px-3 py-1 bg-{{ $pub->categorie_color }}-500/20 text-{{ $pub->categorie_color }}-400 text-xs font-bold rounded-full capitalize">
                                {{ $pub->categorie }}
                            </span>
                            <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
                            </svg>
                        </div>
                        <h4 class="text-xl font-bold text-white mb-3">{{ $pub->titre }}</h4>
                        <p class="text-gray-300 text-sm mb-4 line-clamp-3">{{ Str::limit($pub->contenu, 150) }}</p>
                        <div class="flex items-center justify-between text-xs text-gray-500">
                            <span>{{ $pub->auteur->name ?? 'Administration' }}</span>
                            <span>{{ $pub->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Autres Publications -->
            @if(isset($publications) && $publications->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($publications as $pub)
                <div class="publication-card bg-white/5 backdrop-blur-sm rounded-2xl p-6 border border-white/10 hover:border-purple-500/30 shadow-lg">
                    <div class="flex items-center gap-2 mb-4">
                        <div class="w-10 h-10 rounded-xl bg-{{ $pub->categorie_color }}-500/20 flex items-center justify-center">
                            <svg class="w-5 h-5 text-{{ $pub->categorie_color }}-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $pub->categorie_icon }}"/>
                            </svg>
                        </div>
                        <span class="px-3 py-1 bg-{{ $pub->categorie_color }}-500/20 text-{{ $pub->categorie_color }}-400 text-xs font-bold rounded-full capitalize">
                            {{ $pub->categorie }}
                        </span>
                    </div>
                    <h4 class="text-lg font-bold text-white mb-3">{{ $pub->titre }}</h4>
                    <p class="text-gray-400 text-sm mb-4 line-clamp-3">{{ Str::limit($pub->contenu, 120) }}</p>
                    <div class="flex items-center justify-between pt-4 border-t border-white/10">
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-purple-500 to-indigo-600 flex items-center justify-center text-white text-xs font-bold">
                                {{ substr($pub->auteur->name ?? 'A', 0, 1) }}
                            </div>
                            <span class="text-xs text-gray-400">{{ $pub->auteur->name ?? 'Administration' }}</span>
                        </div>
                        <span class="text-xs text-gray-500">{{ $pub->created_at->diffForHumans() }}</span>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </section>
    @endif

    <!-- Features Section -->
    <section class="py-20 bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-black text-white mb-4">Nos Services</h2>
                <p class="text-gray-400 text-lg">Tout ce dont vous avez besoin en un seul endroit</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="text-center p-6">
                    <div class="w-16 h-16 mx-auto mb-6 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl flex items-center justify-center shadow-lg shadow-purple-500/30">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">Notes en ligne</h3>
                    <p class="text-gray-400">Consultez vos notes individuelles à tout moment</p>
                </div>

                <div class="text-center p-6">
                    <div class="w-16 h-16 mx-auto mb-6 bg-gradient-to-br from-blue-500 to-cyan-600 rounded-2xl flex items-center justify-center shadow-lg shadow-blue-500/30">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">Emploi du temps</h3>
                    <p class="text-gray-400">Accédez à votre planning hebdomadaire</p>
                </div>

                <div class="text-center p-6">
                    <div class="w-16 h-16 mx-auto mb-6 bg-gradient-to-br from-amber-500 to-orange-600 rounded-2xl flex items-center justify-center shadow-lg shadow-orange-500/30">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">Alertes instantanées</h3>
                    <p class="text-gray-400">Soyez informé des changements en temps réel</p>
                </div>

                <div class="text-center p-6">
                    <div class="w-16 h-16 mx-auto mb-6 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-2xl flex items-center justify-center shadow-lg shadow-emerald-500/30">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">Annonces</h3>
                    <p class="text-gray-400">Suivez les actualités de l'établissement</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 border-t border-gray-800 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-indigo-600 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <span class="text-xl font-bold text-white">EcoleInfoA</span>
                </div>
                <div class="flex items-center gap-2 text-gray-400 text-sm">
                    <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                    <span>Plateforme sécurisée et fiable</span>
                </div>
                <p class="text-gray-500 text-sm">© 2025 EcoleInfoA - Groupe PIGIER. Tous droits réservés.</p>
            </div>
        </div>
    </footer>
</body>

</html>
