<div class="bg-white p-6 rounded-lg shadow-lg mb-6 max-w-4xl">
    <h2 class="text-3xl font-semibold text-gray-800 mb-4">{{ $module->name }} <span class="text-{{ $task->status === 'completed' ? 'green' : 'yellow' }}-700 text-base">{{ Illuminate\Support\Str::headline($task->status) }}</span></h2>
    <p class="text-lg text-gray-600 mb-6 break-words">{{ $module->summary }}</p>

    <div class="flex flex-col md:flex-row gap-6 mb-6">
        <div class="bg-gray-50 p-4 rounded-lg shadow-sm w-full md:w-1/4">
            <h3 class="text-gray-700 font-bold text-xl">Grade</h3>
            <p class="text-lg text-green-600">{{ $task->status === 'completed' ? $task?->grade : 'Belum Dinilai' }}</p>
        </div>

        <div class="bg-gray-50 p-4 rounded-lg shadow-sm w-full md:w-1/3">
            <h3 class="text-gray-700 font-bold text-xl">Lama Pengerjaan</h3>
            <p class="text-lg text-gray-600" wire:poll.1s="updateTime">{{ $timeElapsed }}</p>
        </div>

        <div class="bg-gray-50 p-4 rounded-lg shadow-sm w-full md:flex-1">
            <h3 class="text-gray-700 font-bold text-xl">Berhasil</h3>
            <p class="text-lg text-blue-600">{{ $module->tasks->where('status', 'completed')->count() }} <span class="text-black">Kompetitor</span></p>
        </div>
    </div>

    <div class="grid grid-row-2 gap-0 md:grid-cols-2 md:gap-6">
        <div class="bg-gray-50 p-4 rounded-lg shadow-sm mb-6">
            <h3 class="text-gray-700 font-bold text-xl">Download Soal</h3>
            <x-button wire:click="downloadSoal" class="!p-0 text-blue-500 hover:text-blue-700 flex items-center justify-start">
                <i class="fas fa-download"></i>
                <span class="font-medium">Download</span>
            </x-button>
        </div>
        <div class="bg-gray-50 p-4 rounded-lg shadow-sm mb-6">
            <h3 class="text-gray-700 font-bold text-xl">Download Asset</h3>
            <x-button wire:click="downloadAsset" class="!p-0 text-blue-500 hover:text-blue-700 flex items-center justify-start">
                <i class="fas fa-download"></i>
                <span class="font-medium">Download</span>
            </x-button>
        </div>
    </div>

    <!-- Actions -->
    <div class="flex flex-col md:flex-row items-center gap-6">
        @if($task->status === 'not-completed')
            <x-button wire:click="removeModule" loading class="w-full sm:w-auto bg-red-500 text-white p-3 rounded-lg flex items-center justify-center space-x-2 hover:bg-red-600 transition">
                <i class="fas fa-trash-alt"></i>
                <span>Hapus Pengerjaan</span>
            </x-button>
            <x-button wire:click="setOnMarking" loading class="w-full sm:w-auto bg-blue-500 text-white p-3 rounded-lg flex items-center justify-center space-x-2 hover:bg-blue-600 transition">
                <i class="fas fa-check"></i>
                <span>Tandai Selesai</span>
            </x-button>
        @elseif($task->status === 'on-marking')
            <x-button wire:click="setUncompleted" loading class="w-full sm:w-auto bg-red-500 text-white p-3 rounded-lg flex items-center justify-center space-x-2 hover:bg-red-600 transition">
                <i class="fas fa-times-circle"></i>
                <span>Tandai Belum Selesai</span>
            </x-button>
            <x-button x-on:click="$modalOpen('marking')" class="w-full sm:w-auto bg-green-500 text-white p-3 rounded-lg flex items-center justify-center space-x-2 hover:bg-green-600 transition">
                <i class="fas fa-pencil-alt"></i>
                <span>Mulai Marking</span>
            </x-button>
        @elseif($task->status === 'completed')
            <x-button wire:click="removeModule()" loading class="w-full sm:w-auto bg-red-500 text-white p-3 rounded-lg flex items-center justify-center space-x-2 hover:bg-red-600 transition">
                <i class="fas fa-trash-alt"></i>
                <span>Hapus Pengerjaan</span>
            </x-button>
            <x-button x-on:click="$modalOpen('marking')" class="w-full sm:w-auto bg-green-500 text-white p-3 rounded-lg flex items-center justify-center space-x-2 hover:bg-green-600 transition">
                <i class="fas fa-pencil-alt"></i>
                <span>Marking Ulang</span>
            </x-button>
        @endif
    </div>

    <x-modal id="marking" title="Marking Task {{ $module->name }}" center lg blur>
        <div class="p-4">
            <div class="overflow-x-auto">
                <table class="w-full border border-gray-300 rounded-lg shadow-sm">
                    <thead class="bg-gray-100">
                        <tr class="text-left text-gray-700 font-semibold">
                            <th class="border border-gray-300 px-4 py-2">Aspek</th>
                            <th class="border border-gray-300 px-4 py-2">Persyaratan</th>
                            <th class="border border-gray-300 px-4 py-2 text-center">Dapat Poin</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(json_decode($task->json_marking, true) as $index => $mark)
                            <tr class="border border-gray-300 text-sm">
                                <td class="border border-gray-300 px-4 py-2">{{ $mark['description'] }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $mark['requirement'] }}</td>
                                <td class="border border-gray-300 px-4 py-2 text-center">
                                    <input type="checkbox" wire:model.live="marked.{{ $index }}" class="w-5 h-5 text-blue-600 rounded">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    
        <x-slot name="footer">
            <x-button x-on:click="$modalClose('marking')" class="bg-red-600 hover:bg-red-700 text-white">
                Tutup
            </x-button>
            <x-button wire:click="saveMark" x-on:click="$modalClose('marking')" class="bg-green-600 hover:bg-green-700 text-white">
                Save
            </x-button>
        </x-slot>
    </x-modal>
</div>