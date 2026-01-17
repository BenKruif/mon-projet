<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl text-gray-800 leading-tight flex items-center gap-3">
                <div class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                </div>
                Ajouter une Note
            </h2>
            <a href="{{ route('professeur.notes') }}" class="text-gray-600 hover:text-gray-800 flex items-center gap-2">
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
                <div class="bg-gradient-to-r from-emerald-600 to-teal-600 px-6 py-5">
                    <h3 class="text-xl font-bold text-white">Nouvelle note</h3>
                    <p class="text-emerald-100 text-sm mt-1">Remplissez les informations ci-dessous</p>
                </div>

                <form action="{{ route('professeur.notes.store') }}" method="POST" class="p-6 space-y-6">
                    @csrf

                    <div>
                        <label for="etudiant_id" class="block text-sm font-semibold text-gray-700 mb-2">Étudiant</label>
                        <select name="etudiant_id" id="etudiant_id" required class="w-full rounded-xl border-gray-300 focus:border-emerald-500 focus:ring-emerald-500">
                            <option value="">Sélectionnez un étudiant</option>
                            @foreach($etudiants as $etudiant)
                                <option value="{{ $etudiant->id }}">{{ $etudiant->name }}</option>
                            @endforeach
                        </select>
                        @error('etudiant_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="matiere_id" class="block text-sm font-semibold text-gray-700 mb-2">Matière</label>
                        <select name="matiere_id" id="matiere_id" required class="w-full rounded-xl border-gray-300 focus:border-emerald-500 focus:ring-emerald-500">
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

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="note" class="block text-sm font-semibold text-gray-700 mb-2">Note (/20)</label>
                            <input type="number" name="note" id="note" min="0" max="20" step="0.25" required 
                                class="w-full rounded-xl border-gray-300 focus:border-emerald-500 focus:ring-emerald-500" placeholder="15.5">
                            @error('note') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="type" class="block text-sm font-semibold text-gray-700 mb-2">Type d'évaluation</label>
                            <select name="type" id="type" required class="w-full rounded-xl border-gray-300 focus:border-emerald-500 focus:ring-emerald-500">
                                <option value="examen">Examen</option>
                                <option value="devoir">Devoir</option>
                                <option value="tp">TP</option>
                                <option value="projet">Projet</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label for="date_evaluation" class="block text-sm font-semibold text-gray-700 mb-2">Date d'évaluation</label>
                        <input type="date" name="date_evaluation" id="date_evaluation" required 
                            class="w-full rounded-xl border-gray-300 focus:border-emerald-500 focus:ring-emerald-500" value="{{ date('Y-m-d') }}">
                    </div>

                    <div>
                        <label for="commentaire" class="block text-sm font-semibold text-gray-700 mb-2">Commentaire (optionnel)</label>
                        <textarea name="commentaire" id="commentaire" rows="3" 
                            class="w-full rounded-xl border-gray-300 focus:border-emerald-500 focus:ring-emerald-500" placeholder="Observations..."></textarea>
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="w-full bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-bold py-4 px-6 rounded-xl shadow-lg transition-all transform hover:scale-[1.02]">
                            Enregistrer la note
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
