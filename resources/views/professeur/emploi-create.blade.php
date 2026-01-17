<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl text-gray-800 leading-tight flex items-center gap-3">
                <div class="w-10 h-10 bg-gradient-to-br from-teal-500 to-cyan-600 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                </div>
                Ajouter un Cours
            </h2>
            <a href="{{ route('professeur.emploi') }}" class="text-gray-600 hover:text-gray-800 flex items-center gap-2">
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
                <div class="bg-gradient-to-r from-teal-600 to-cyan-600 px-6 py-5">
                    <h3 class="text-xl font-bold text-white">Nouveau cours</h3>
                    <p class="text-teal-100 text-sm mt-1">Ajoutez un cours à l'emploi du temps</p>
                </div>

                <form action="{{ route('professeur.emploi.store') }}" method="POST" class="p-6 space-y-6">
                    @csrf

                    <div>
                        <label for="matiere_id" class="block text-sm font-semibold text-gray-700 mb-2">Matière</label>
                        <select name="matiere_id" id="matiere_id" required class="w-full rounded-xl border-gray-300 focus:border-teal-500 focus:ring-teal-500">
                            <option value="">Sélectionnez une matière</option>
                            @foreach($matieres as $matiere)
                                <option value="{{ $matiere->id }}">{{ $matiere->nom }} ({{ $matiere->code }})</option>
                            @endforeach
                        </select>
                        @error('matiere_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        @if($matieres->count() == 0)
                            <p class="text-amber-600 text-sm mt-2">
                                <a href="{{ route('professeur.matieres.create') }}" class="underline">Créez d'abord une matière</a>
                            </p>
                        @endif
                    </div>

                    <div>
                        <label for="jour" class="block text-sm font-semibold text-gray-700 mb-2">Jour</label>
                        <select name="jour" id="jour" required class="w-full rounded-xl border-gray-300 focus:border-teal-500 focus:ring-teal-500">
                            @foreach($jours as $jour)
                                <option value="{{ $jour }}">{{ ucfirst($jour) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="heure_debut" class="block text-sm font-semibold text-gray-700 mb-2">Heure de début</label>
                            <input type="time" name="heure_debut" id="heure_debut" required 
                                class="w-full rounded-xl border-gray-300 focus:border-teal-500 focus:ring-teal-500" value="08:00">
                        </div>

                        <div>
                            <label for="heure_fin" class="block text-sm font-semibold text-gray-700 mb-2">Heure de fin</label>
                            <input type="time" name="heure_fin" id="heure_fin" required 
                                class="w-full rounded-xl border-gray-300 focus:border-teal-500 focus:ring-teal-500" value="10:00">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="salle" class="block text-sm font-semibold text-gray-700 mb-2">Salle</label>
                            <input type="text" name="salle" id="salle" required 
                                class="w-full rounded-xl border-gray-300 focus:border-teal-500 focus:ring-teal-500" placeholder="A101">
                            @error('salle') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="classe" class="block text-sm font-semibold text-gray-700 mb-2">Classe (optionnel)</label>
                            <input type="text" name="classe" id="classe" 
                                class="w-full rounded-xl border-gray-300 focus:border-teal-500 focus:ring-teal-500" placeholder="L1 Info">
                        </div>
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="w-full bg-gradient-to-r from-teal-600 to-cyan-600 hover:from-teal-700 hover:to-cyan-700 text-white font-bold py-4 px-6 rounded-xl shadow-lg transition-all transform hover:scale-[1.02]">
                            Ajouter le cours
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
