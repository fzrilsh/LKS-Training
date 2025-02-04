<div>
    <section class="flex justify-between items-center mb-6 gap-5 max-w-4xl">
        <div>
            <h1 class="font-extrabold text-2xl">Daftar Modul</h1>
            <p class="text-sm text-gray-500">Kerjakan modul untuk menambah wawasan eksplorasi kamu</p>
        </div>
        <a href="{{ route('clientarea.add-task') }}" class="px-4 py-2 bg-gradient-to-r bg-blue-500 text-white rounded-lg text-sm font-medium">Tambah</a>
    </section>
    
    <section class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 max-4xl">
        @foreach ($tasks as $task)     
            <article class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition-shadow duration-300 h-fit">
                <div class="flex gap-4 items-center mb-4">
                    <div class="w-14 h-14 bg-{{ Arr::random(['blue', 'red', 'purple', 'indigo', 'black']) }}-100 flex items-center justify-center rounded-full">
                        <img src="{{ asset('images/icons/ghost.svg') }}" alt="Task Icon" class="w-8 h-8">
                    </div>
                    <div>
                        <h2 class="font-bold text-lg text-gray-700">{{ $task->module->name }}</h2>
                        <time datetime="2024-08-22" class="text-sm text-gray-500">Awal Pengerjaan: {{ $task->created_at->format('d-m-Y') }}</time>
                    </div>
                </div>
                <div class="flex justify-between items-center">
                    <span class="inline-flex items-center gap-2 px-3 py-1 {{ $task->status === 'completed' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }} rounded-full text-xs font-semibold">
                        @if ($task->status == 'completed')
                            <object class="w-4 h-4" data="{{ asset('images/icons/completed.svg') }}" type="image/svg+xml"></object>
                            Completed
                        @else
                            <object class="w-4 h-4 text-yellow-700" data="{{ asset('images/icons/not-completed.svg') }}" type="image/svg+xml"></object>
                            {{ Illuminate\Support\Str::headline($task->status) }}
                        @endif
                    </span>
                    <a href="{{ route('clientarea.detail-task', $task) }}" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors text-sm font-medium">
                        View Task
                    </a>
                </div>
            </article>
        @endforeach
    </section>
</div>