<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl text-gray-800 leading-tight flex items-center gap-3">
                <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-indigo-600 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                </div>
                Modifier la Publication
            </h2>
            <a href="{{ route('professeur.publications') }}" class="text-gray-600 hover:text-gray-800 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Retour
            </a>
        </div>
    </x-slot>

    <div class="py-8 bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
                <div class="bg-gradient-to-r from-purple-600 to-indigo-600 px-6 py-5">
                    <h3 class="text-xl font-bold text-white">Modifier la publication</h3>
                    <p class="text-purple-100 text-sm mt-1">Mettez à jour les informations</p>
                </div>

                <form action="{{ route('professeur.publications.update', $publication) }}" method="POST" class="p-6 space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="titre" class="block text-sm font-semibold text-gray-700 mb-2">Titre</label>
                        <input type="text" name="titre" id="titre" required value="{{ old('titre', $publication->titre) }}"
                            class="w-full rounded-xl border-gray-300 focus:border-purple-500 focus:ring-purple-500">
                        @error('titre') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="categorie" class="block text-sm font-semibold text-gray-700 mb-2">Catégorie</label>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                            <label class="relative cursor-pointer">
                                <input type="radio" name="categorie" value="information" class="peer sr-only" {{ old('categorie', $publication->categorie) === 'information' ? 'checked' : '' }}>
                                <div class="p-3 rounded-xl border-2 border-gray-200 peer-checked:border-green-500 peer-checked:bg-green-50 transition-all text-center">
                                    <svg class="w-6 h-6 mx-auto text-green-600 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <span class="text-xs font-semibold text-gray-700">Information</span>
                                </div>
                            </label>
                            <label class="relative cursor-pointer">
                                <input type="radio" name="categorie" value="annonce" class="peer sr-only" {{ old('categorie', $publication->categorie) === 'annonce' ? 'checked' : '' }}>
                                <div class="p-3 rounded-xl border-2 border-gray-200 peer-checked:border-blue-500 peer-checked:bg-blue-50 transition-all text-center">
                                    <svg class="w-6 h-6 mx-auto text-blue-600 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                                    </svg>
                                    <span class="text-xs font-semibold text-gray-700">Annonce</span>
                                </div>
                            </label>
                            <label class="relative cursor-pointer">
                                <input type="radio" name="categorie" value="evenement" class="peer sr-only" {{ old('categorie', $publication->categorie) === 'evenement' ? 'checked' : '' }}>
                                <div class="p-3 rounded-xl border-2 border-gray-200 peer-checked:border-purple-500 peer-checked:bg-purple-50 transition-all text-center">
                                    <svg class="w-6 h-6 mx-auto text-purple-600 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <span class="text-xs font-semibold text-gray-700">Événement</span>
                                </div>
                            </label>
                            <label class="relative cursor-pointer">
                                <input type="radio" name="categorie" value="urgent" class="peer sr-only" {{ old('categorie', $publication->categorie) === 'urgent' ? 'checked' : '' }}>
                                <div class="p-3 rounded-xl border-2 border-gray-200 peer-checked:border-red-500 peer-checked:bg-red-50 transition-all text-center">
                                    <svg class="w-6 h-6 mx-auto text-red-600 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                    </svg>
                                    <span class="text-xs font-semibold text-gray-700">Urgent</span>
                                </div>
                            </label>
                        </div>
                    </div>

                    <div>
                        <label for="contenu" class="block text-sm font-semibold text-gray-700 mb-2">Contenu</label>
                        <textarea name="contenu" id="contenu" rows="6" required 
                            class="w-full rounded-xl border-gray-300 focus:border-purple-500 focus:ring-purple-500">{{ old('contenu', $publication->contenu) }}</textarea>
                        @error('contenu') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="p-4 bg-gray-50 rounded-xl">
                            <label class="flex items-center cursor-pointer">
                                <input type="checkbox" name="est_public" value="1" {{ $publication->est_public ? 'checked' : '' }}
                                    class="w-5 h-5 rounded text-purple-600 focus:ring-purple-500">
                                <span class="ml-3">
                                    <span class="block text-sm font-semibold text-gray-700">Publique</span>
                                    <span class="block text-xs text-gray-500">Visible sur la page d'accueil</span>
                                </span>
                            </label>
                        </div>

                        <div class="p-4 bg-gray-50 rounded-xl">
                            <label class="flex items-center cursor-pointer">
                                <input type="checkbox" name="est_epingle" value="1" {{ $publication->est_epingle ? 'checked' : '' }}
                                    class="w-5 h-5 rounded text-yellow-600 focus:ring-yellow-500">
                                <span class="ml-3">
                                    <span class="block text-sm font-semibold text-gray-700">Épingler</span>
                                    <span class="block text-xs text-gray-500">Afficher en priorité</span>
                                </span>
                            </label>
                        </div>
                    </div>

                    <div>
                        <label for="date_expiration" class="block text-sm font-semibold text-gray-700 mb-2">Date d'expiration (optionnel)</label>
                        <input type="datetime-local" name="date_expiration" id="date_expiration" 
                            value="{{ $publication->date_expiration ? $publication->date_expiration->format('Y-m-d\TH:i') : '' }}"
                            class="w-full rounded-xl border-gray-300 focus:border-purple-500 focus:ring-purple-500">
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="w-full bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 text-white font-bold py-4 px-6 rounded-xl shadow-lg transition-all transform hover:scale-[1.02]">
                            Mettre à jour
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
