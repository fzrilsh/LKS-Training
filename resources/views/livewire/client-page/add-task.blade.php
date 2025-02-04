<div>
    <div class="max-w-3xl bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-4">Pilih Modul</h2>
        
        <x-select.styled label="Cari dan klik modul untuk melihat detailnya" :options="$categories" select="label:name|value:id|description:summary" wire:model.live="selectedModule" searchable />
    </div>

    @if($selectedModuleInstance)
        <div class="mt-8 p-6 bg-white shadow-lg rounded-xl border border-gray-200 max-w-3xl">
            <h2 class="text-3xl font-bold text-gray-800">{{ $selectedModuleInstance->name }}</h2>
            <p class="text-gray-500 text-sm mt-1">Kategori: 
                <span class="text-gray-700 font-medium">{{ strtoupper($selectedModuleInstance->category) }}</span>
            </p>
            
            <div class="mt-4 p-4 bg-gray-50 rounded-lg border-l-4 border-blue-500">
                <p class="text-gray-700">{{ $selectedModuleInstance->summary }}</p>
            </div>

            <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-4">
                <span class="bg-blue-100 text-blue-800 text-sm font-semibold px-4 py-1.5 rounded-lg shadow-sm flex items-center justify-center sm:justify-start">
                    🎯 Maksimum Poin: {{ $selectedModuleInstance->marking->max_point }}
                </span>
                <span class="bg-green-100 text-green-800 text-sm font-semibold px-4 py-1.5 rounded-lg shadow-sm flex items-center justify-center sm:justify-start">
                    👥 Dikerjakan Kompetitor: {{ $selectedModuleInstance->attempts }}x
                </span>
            </div>

            <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 gap-4">
                <x-button wire:click="checkTask()"
                    class="bg-gradient-to-r from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800 text-white font-semibold py-3 px-6 rounded-lg shadow-lg w-full sm:w-auto">
                    🚀 Kerjakan Modul
                </x-button>

                <x-button x-on:click="$modalOpen('marking-scheme')"
                    class="bg-gradient-to-r from-green-500 to-green-700 hover:from-green-600 hover:to-green-800 text-white font-semibold py-3 px-6 rounded-lg shadow-lg w-full sm:w-auto">
                    📜 Lihat Marking Scheme
                </x-button>
            </div>
        </div>

        {{-- @dd(json_decode($selectedModuleInstance->marking->json)) --}}

        <x-modal id="marking-scheme" title="Marking Scheme" center lg blur>
            <div class="p-4">
                <p class="text-gray-600 text-sm mb-4">
                    Berikut adalah skema penilaian untuk <strong>{{ $selectedModuleInstance->name }}</strong>.
                </p>
        
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-100 text-gray-700 text-sm">
                                <th class="border border-gray-300 px-4 py-2 text-center">Aspect</th>
                                <th class="border border-gray-300 px-4 py-2 text-center w-1/3">Requirement</th>
                                <th class="border border-gray-300 px-4 py-2 text-center">Poin</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(json_decode($selectedModuleInstance->marking->json) as $mark)
                                <tr class="border border-gray-300 text-sm">
                                    <td class="border border-gray-300 px-4 py-2">{{ $mark->description }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{!! $mark->requirement ? nl2br($mark->requirement) : '' !!}</td>
                                    <td class="border border-gray-300 px-4 py-2 text-center font-semibold">{{ number_format($mark->total_point, 1, '.', '') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
        
                <div class="mt-6 flex justify-end">
                    <x-button x-on:click="$modalClose('marking-scheme')" class="bg-red-400 hover:bg-red-500 text-white">
                        ❌ Tutup
                    </x-button>
                </div>
            </div>
        </x-modal>
    @endif
</div>
