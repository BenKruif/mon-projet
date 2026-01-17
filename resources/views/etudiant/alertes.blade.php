<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl text-gray-800 leading-tight flex items-center gap-3">
                <div class="w-10 h-10 bg-gradient-to-br from-amber-500 to-orange-600 rounded-xl flex items-center justify-center relative">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                    @if($nonLues > 0)
                        <span class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 rounded-full text-white text-xs flex items-center justify-center font-bold">{{ $nonLues }}</span>
                    @endif
                </div>
                Alertes & Notifications
            </h2>
            <a href="{{ route('dashboard.etudiant') }}" class="text-gray-600 hover:text-gray-800 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Retour
            </a>
        </div>
    </x-slot>

    <div class="py-8 bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Liste des alertes -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
                <div class="bg-gradient-to-r from-amber-500 to-orange-600 px-6 py-5">
                    <h3 class="text-xl font-bold text-white">Vos notifications</h3>
                    <p class="text-amber-100 text-sm mt-1">{{ $nonLues }} notification(s) non lue(s)</p>
                </div>

                @if($alertes->count() > 0)
                    <div class="divide-y divide-gray-100">
                        @foreach($alertes as $alerte)
                            <div class="p-6 hover:bg-gray-50 transition-colors {{ !$alerte->lu ? 'bg-amber-50/50' : '' }}">
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
                                    <div class="flex-1">
                                        <div class="flex items-center justify-between mb-2">
                                            <h4 class="font-bold text-gray-800">{{ $alerte->titre }}</h4>
                                            <div class="flex items-center gap-2">
                                                <span class="px-2 py-1 text-xs font-semibold rounded-full
                                                    @if($alerte->priorite == 'urgente') bg-red-100 text-red-600
                                                    @elseif($alerte->priorite == 'haute') bg-orange-100 text-orange-600
                                                    @elseif($alerte->priorite == 'moyenne') bg-blue-100 text-blue-600
                                                    @else bg-gray-100 text-gray-600
                                                    @endif">
                                                    {{ ucfirst($alerte->priorite) }}
                                                </span>
                                                @if(!$alerte->lu)
                                                    <span class="w-3 h-3 bg-amber-500 rounded-full animate-pulse"></span>
                                                @endif
                                            </div>
                                        </div>
                                        <p class="text-gray-600 text-sm mb-3">{{ $alerte->message }}</p>
                                        <div class="flex items-center justify-between">
                                            <span class="text-xs text-gray-400">
                                                Par {{ $alerte->auteur->name ?? 'Système' }} • {{ $alerte->created_at->diffForHumans() }}
                                            </span>
                                            @if(!$alerte->lu)
                                                <form action="{{ route('etudiant.alertes.lu', $alerte) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="text-xs text-amber-600 hover:text-amber-700 font-semibold">
                                                        Marquer comme lu
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="p-12 text-center">
                        <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                            </svg>
                        </div>
                        <h4 class="text-lg font-bold text-gray-800 mb-2">Aucune notification</h4>
                        <p class="text-gray-500">Vous n'avez aucune alerte pour le moment</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
