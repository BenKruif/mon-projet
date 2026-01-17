<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl text-gray-800 leading-tight flex items-center gap-3">
                <div class="w-10 h-10 bg-gradient-to-br from-orange-500 to-red-600 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                Gestion des Alertes
            </h2>
            <div class="flex items-center gap-4">
                <a href="{{ route('professeur.alertes.create') }}" class="bg-gradient-to-r from-orange-500 to-red-600 hover:from-orange-600 hover:to-red-700 text-white font-bold py-2 px-4 rounded-xl flex items-center gap-2 shadow-lg transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Nouvelle alerte
                </a>
                <a href="{{ route('dashboard.professeur') }}" class="text-gray-600 hover:text-gray-800 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Retour
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8 bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Liste des alertes -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
                <div class="bg-gradient-to-r from-orange-500 to-red-600 px-6 py-5">
                    <h3 class="text-xl font-bold text-white">Alertes envoyées</h3>
                    <p class="text-orange-100 text-sm mt-1">{{ $alertes->count() }} alerte(s) publiée(s)</p>
                </div>

                @if($alertes->count() > 0)
                    <div class="divide-y divide-gray-100">
                        @foreach($alertes as $alerte)
                            <div class="p-6 hover:bg-gray-50 transition-colors">
                                <div class="flex items-start justify-between">
                                    <div class="flex items-start gap-4">
                                        <div class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0
                                            @if($alerte->type == 'changement_salle') bg-blue-100 text-blue-600
                                            @elseif($alerte->type == 'disponibilite') bg-green-100 text-green-600
                                            @elseif($alerte->type == 'paiement') bg-red-100 text-red-600
                                            @else bg-gray-100 text-gray-600
                                            @endif">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $alerte->type_icon }}"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="flex items-center gap-2 mb-1">
                                                <h4 class="font-bold text-gray-800">{{ $alerte->titre }}</h4>
                                                <span class="px-2 py-1 text-xs font-semibold rounded-full
                                                    @if($alerte->priorite == 'urgente') bg-red-100 text-red-600
                                                    @elseif($alerte->priorite == 'haute') bg-orange-100 text-orange-600
                                                    @elseif($alerte->priorite == 'moyenne') bg-blue-100 text-blue-600
                                                    @else bg-gray-100 text-gray-600
                                                    @endif">
                                                    {{ ucfirst($alerte->priorite) }}
                                                </span>
                                            </div>
                                            <p class="text-gray-600 text-sm mb-2">{{ $alerte->message }}</p>
                                            <div class="flex items-center gap-4 text-xs text-gray-400">
                                                <span>{{ $alerte->pour_tous ? 'Tous les étudiants' : 'Étudiant spécifique' }}</span>
                                                <span>{{ $alerte->created_at->format('d/m/Y H:i') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <form action="{{ route('professeur.alertes.destroy', $alerte) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Supprimer cette alerte ?')" class="text-red-600 hover:text-red-800">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="p-12 text-center">
                        <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                        </div>
                        <h4 class="text-lg font-bold text-gray-800 mb-2">Aucune alerte envoyée</h4>
                        <p class="text-gray-500 mb-4">Envoyez des alertes pour informer vos étudiants</p>
                        <a href="{{ route('professeur.alertes.create') }}" class="inline-flex items-center gap-2 bg-orange-600 text-white px-4 py-2 rounded-lg hover:bg-orange-700 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Créer une alerte
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
