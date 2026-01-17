<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl text-gray-800 leading-tight flex items-center gap-3">
                <div class="w-10 h-10 bg-gradient-to-br from-orange-500 to-red-600 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                </div>
                Créer une Alerte
            </h2>
            <a href="{{ route('professeur.alertes') }}" class="text-gray-600 hover:text-gray-800 flex items-center gap-2">
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
                <div class="bg-gradient-to-r from-orange-500 to-red-600 px-6 py-5">
                    <h3 class="text-xl font-bold text-white">Nouvelle alerte</h3>
                    <p class="text-orange-100 text-sm mt-1">Informez les étudiants d'un changement important</p>
                </div>

                <form action="{{ route('professeur.alertes.store') }}" method="POST" class="p-6 space-y-6">
                    @csrf

                    <div>
                        <label for="titre" class="block text-sm font-semibold text-gray-700 mb-2">Titre de l'alerte</label>
                        <input type="text" name="titre" id="titre" required 
                            class="w-full rounded-xl border-gray-300 focus:border-orange-500 focus:ring-orange-500" 
                            placeholder="Ex: Changement de salle pour le cours de...">
                        @error('titre') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="type" class="block text-sm font-semibold text-gray-700 mb-2">Type d'alerte</label>
                            <select name="type" id="type" required class="w-full rounded-xl border-gray-300 focus:border-orange-500 focus:ring-orange-500">
                                <option value="general">Information générale</option>
                                <option value="changement_salle">Changement de salle</option>
                                <option value="disponibilite">Disponibilité enseignant</option>
                                <option value="paiement">Paiement scolarité</option>
                            </select>
                        </div>

                        <div>
                            <label for="priorite" class="block text-sm font-semibold text-gray-700 mb-2">Priorité</label>
                            <select name="priorite" id="priorite" required class="w-full rounded-xl border-gray-300 focus:border-orange-500 focus:ring-orange-500">
                                <option value="basse">Basse</option>
                                <option value="moyenne" selected>Moyenne</option>
                                <option value="haute">Haute</option>
                                <option value="urgente">Urgente</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label for="message" class="block text-sm font-semibold text-gray-700 mb-2">Message</label>
                        <textarea name="message" id="message" rows="4" required 
                            class="w-full rounded-xl border-gray-300 focus:border-orange-500 focus:ring-orange-500" 
                            placeholder="Détaillez l'information à communiquer..."></textarea>
                        @error('message') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="p-4 bg-gray-50 rounded-xl">
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" name="pour_tous" value="1" checked 
                                class="w-5 h-5 rounded text-orange-600 focus:ring-orange-500" id="pour_tous">
                            <span class="ml-3 text-sm font-semibold text-gray-700">Envoyer à tous les étudiants</span>
                        </label>
                    </div>

                    <div id="etudiant_select" class="hidden">
                        <label for="destinataire_id" class="block text-sm font-semibold text-gray-700 mb-2">Étudiant spécifique</label>
                        <select name="destinataire_id" id="destinataire_id" class="w-full rounded-xl border-gray-300 focus:border-orange-500 focus:ring-orange-500">
                            <option value="">Sélectionnez un étudiant</option>
                            @foreach($etudiants as $etudiant)
                                <option value="{{ $etudiant->id }}">{{ $etudiant->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="w-full bg-gradient-to-r from-orange-600 to-red-600 hover:from-orange-700 hover:to-red-700 text-white font-bold py-4 px-6 rounded-xl shadow-lg transition-all transform hover:scale-[1.02]">
                            Envoyer l'alerte
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('pour_tous').addEventListener('change', function() {
            document.getElementById('etudiant_select').classList.toggle('hidden', this.checked);
        });
    </script>
</x-app-layout>
