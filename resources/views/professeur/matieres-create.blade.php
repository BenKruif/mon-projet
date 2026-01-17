<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl text-gray-800 leading-tight flex items-center gap-3">
                <div class="w-10 h-10 bg-gradient-to-br from-violet-500 to-purple-600 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                </div>
                Créer une Matière
            </h2>
            <a href="{{ route('professeur.matieres') }}" class="text-gray-600 hover:text-gray-800 flex items-center gap-2">
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
                <div class="bg-gradient-to-r from-violet-600 to-purple-600 px-6 py-5">
                    <h3 class="text-xl font-bold text-white">Nouvelle matière</h3>
                    <p class="text-violet-100 text-sm mt-1">Créez une nouvelle matière à enseigner</p>
                </div>

                <form action="{{ route('professeur.matieres.store') }}" method="POST" class="p-6 space-y-6">
                    @csrf

                    <div>
                        <label for="nom" class="block text-sm font-semibold text-gray-700 mb-2">Nom de la matière</label>
                        <input type="text" name="nom" id="nom" required 
                            class="w-full rounded-xl border-gray-300 focus:border-violet-500 focus:ring-violet-500" 
                            placeholder="Ex: Programmation Web">
                        @error('nom') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="code" class="block text-sm font-semibold text-gray-700 mb-2">Code</label>
                            <input type="text" name="code" id="code" required 
                                class="w-full rounded-xl border-gray-300 focus:border-violet-500 focus:ring-violet-500" 
                                placeholder="Ex: PROG101">
                            @error('code') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="coefficient" class="block text-sm font-semibold text-gray-700 mb-2">Coefficient</label>
                            <input type="number" name="coefficient" id="coefficient" min="1" max="10" required 
                                class="w-full rounded-xl border-gray-300 focus:border-violet-500 focus:ring-violet-500" value="1">
                        </div>
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">Description (optionnel)</label>
                        <textarea name="description" id="description" rows="3" 
                            class="w-full rounded-xl border-gray-300 focus:border-violet-500 focus:ring-violet-500" 
                            placeholder="Description de la matière..."></textarea>
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="w-full bg-gradient-to-r from-violet-600 to-purple-600 hover:from-violet-700 hover:to-purple-700 text-white font-bold py-4 px-6 rounded-xl shadow-lg transition-all transform hover:scale-[1.02]">
                            Créer la matière
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
