<div>
    <section class="flex justify-between items-center mb-6 gap-5">
        <div>
            <h1 class="font-extrabold text-2xl">Daftar Modul</h1>
            <p class="text-sm text-gray-500">Kerjakan modul untuk menambah wawasan eksplorasi kamu</p>
        </div>
        <a href="add-task.html" class="px-4 py-2 bg-gradient-to-r bg-blue-500 text-white rounded-lg text-sm font-medium">Tambah</a>
    </section>
    
    <section class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
        <article class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition-shadow duration-300">
            <!-- Header -->
            <div class="flex gap-4 items-center mb-4">
                <div class="w-14 h-14 bg-blue-100 flex items-center justify-center rounded-full">
                    <img src="{{ asset('images/icons/ghost.svg') }}" alt="Task Icon" class="w-8 h-8">
                </div>
                <div>
                    <h2 class="font-bold text-lg text-gray-700">Server Side LKSN 2024</h2>
                    <time datetime="2024-08-22" class="text-sm text-gray-500">Created at 22 August 2024</time>
                </div>
            </div>
            <!-- Body -->
            <div class="flex justify-between items-center text-sm font-medium mb-4">
                <span class="flex items-center gap-2 text-red-500">
                    <img src="{{ asset('images/icons/layer.svg') }}" alt="Difficulty Icon" class="w-5 h-5"> 
                    <span>High</span>
                </span>
                <span class="flex items-center gap-2 text-blue-500">
                    <svg width="20" height="21" fill="none" aria-hidden="true">
                        <path d="M4.3 2.2v16.6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                    <span>Difficult</span>
                </span>
            </div>
            <!-- Status -->
            <div class="flex justify-between items-center">
                <span class="inline-flex items-center gap-2 px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold">
                    <object class="w-4 h-4" data="{{ asset('images/icons/completed.svg') }}" type="image/svg+xml"></object>
                    Completed
                </span>
                <button
                    class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors text-sm font-medium">
                    View Task
                </button>
            </div>
        </article>
    
        <!-- Example of Not Completed -->
        <article class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition-shadow duration-300">
            <!-- Header -->
            <div class="flex gap-4 items-center mb-4">
                <div class="w-14 h-14 bg-blue-100 flex items-center justify-center rounded-full">
                    <img src="{{ asset('images/icons/ghost.svg') }}" alt="Task Icon" class="w-8 h-8">
                </div>
                <div>
                    <h2 class="font-bold text-lg text-gray-700">Set up Linux Environment</h2>
                    <time datetime="2024-08-25" class="text-sm text-gray-500">Created at 25 August 2024</time>
                </div>
            </div>
            <!-- Body -->
            <div class="flex justify-between items-center text-sm font-medium mb-4">
                <span class="flex items-center gap-2 text-yellow-500">
                    <img src="{{ asset('images/icons/layer.svg') }}" alt="Difficulty Icon" class="w-5 h-5"> 
                    <span>Medium</span>
                </span>
                <span class="flex items-center gap-2 text-blue-500">
                    <svg width="20" height="21" fill="none" aria-hidden="true">
                        <path d="M4.3 2.2v16.6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                    <span>Difficult</span>
                </span>
            </div>
            <!-- Status -->
            <div class="flex justify-between items-center">
                <span class="inline-flex items-center gap-2 px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-semibold">
                    <object class="w-4 h-4 text-yellow-700" data="{{ asset('images/icons/not-completed.svg') }}" type="image/svg+xml"></object>
                    Not Completed
                </span>
                <button
                    class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors text-sm font-medium">
                    View Task
                </button>
            </div>
        </article>
    </section>
</div>