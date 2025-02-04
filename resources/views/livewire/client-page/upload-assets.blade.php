<div class="max-w-4xl">
    <label for="uploadassets" class="bg-white text-gray-500 font-semibold text-base rounded w-full h-52 flex flex-col items-center justify-center cursor-pointer border-2 border-gray-300 border-dashed mx-auto font-[sans-serif]">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-11 mb-2 fill-gray-500" viewBox="0 0 32 32">
            <path
                d="M23.75 11.044a7.99 7.99 0 0 0-15.5-.009A8 8 0 0 0 9 27h3a1 1 0 0 0 0-2H9a6 6 0 0 1-.035-12 1.038 1.038 0 0 0 1.1-.854 5.991 5.991 0 0 1 11.862 0A1.08 1.08 0 0 0 23 13a6 6 0 0 1 0 12h-3a1 1 0 0 0 0 2h3a8 8 0 0 0 .75-15.956z"
                data-original="#000000" />
            <path
                d="M20.293 19.707a1 1 0 0 0 1.414-1.414l-5-5a1 1 0 0 0-1.414 0l-5 5a1 1 0 0 0 1.414 1.414L15 16.414V29a1 1 0 0 0 2 0V16.414z"
                data-original="#000000" />
        </svg>
        Upload file

        <input type="file" id='uploadassets' wire:model.live="file" class="hidden" accept=".html,.php" />
        <p class="text-xs font-medium text-gray-400 mt-2">Upload file html atau php, maximal size 10mb</p>
    </label>

    <div class="mt-6">
        <h2 class="text-lg font-semibold text-gray-700 mb-4">File yang sudah diupload:</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($files as $item)
                <div class="bg-white shadow-lg rounded-lg p-4 flex items-center justify-between">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-500" viewBox="0 0 32 32">
                            <path
                                d="M4 6a2 2 0 0 1 2-2h12a2 2 0 0 1 1.414.586l6 6A2 2 0 0 1 26 12v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2zm2 0v20h18V12.828L16.172 6z"
                                data-original="#000000" />
                        </svg>
                        <a class="ml-3 text-gray-700 font-medium text-sm hover:underline" href="{{ route('user-assets', ['path' => $item->path]) }}">{{ basename($item->path) }}</a>
                    </div>
                    <button wire:click="delete({{ $item->id }})" class="text-red-500 hover:text-red-700">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </div>
            @endforeach
        </div>
    </div>
</div>
