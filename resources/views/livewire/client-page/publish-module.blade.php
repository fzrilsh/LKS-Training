<div>
    <div class="max-w-4xl p-6 bg-white shadow-lg rounded-lg">
        <h2 class="text-2xl font-bold mb-4">Cara Publish Modul</h2>
        <div class="space-y-4">
            <div class="flex items-start space-x-4">
                <span class="flex items-center justify-center text-sm md:text-base w-6 h-6 md:w-8 md:h-8 bg-blue-500 text-white rounded-full font-bold flex-shrink-0">1</span>
                <p class="text-sm md:text-base">Siapkan modul dalam format ZIP sesuai dengan format yang telah ditentukan.</p>
            </div>
            <div class="flex items-start space-x-4">
                <span class="flex items-center justify-center text-sm md:text-base w-6 h-6 md:w-8 md:h-8 bg-blue-500 text-white rounded-full font-bold flex-shrink-0">2</span>
                <p>Contoh / template format bisa kamu download dengan menekan tombol dibawah. </p>
            </div>
            <div class="flex items-start space-x-4">
                <span class="flex items-center justify-center text-sm md:text-base w-6 h-6 md:w-8 md:h-8 bg-blue-500 text-white rounded-full font-bold flex-shrink-0">3</span>
                <p>Berikan nama file zip yang unik, lalu upload melalui FTP.</p>
            </div>
            <div class="flex items-start space-x-4">
                <span class="flex items-center justify-center text-sm md:text-base w-6 h-6 md:w-8 md:h-8 bg-blue-500 text-white rounded-full font-bold flex-shrink-0">4</span>
                <p>Sistem akan melakukan verifikasi modul secara otomatis.</p>
            </div>
        </div>
    
        <div class="mt-6 flex space-x-4">
            <a wire:click="downloadTemplate()" class="flex items-center px-4 py-2 bg-green-500 text-white rounded-lg shadow hover:bg-green-600 cursor-pointer">
                <i class="fas fa-download mr-2"></i> Download Template ZIP
            </a>
            <a href="https://demo.filestash.app/login?type=ftp&hostname=ftp.fazrilsh.com&username=ilyasa%40fazrilsh.com&password=qunnu6-jyzfyZ-pibram&port=" target="_blank" class="flex items-center px-4 py-2 bg-blue-500 text-white rounded-lg shadow hover:bg-blue-600">
                <i class="fas fa-external-link-alt mr-2"></i> Buka FTP Client
            </a>
        </div>
    
        <div class="mt-6 p-4 bg-gray-100 rounded-lg">
            <h3 class="text-lg font-semibold mb-2">Token FTP Anda</h3>
            <div class="flex items-center space-x-2">
                <span class="px-3 py-1 bg-gray-200 text-gray-700 rounded-lg font-mono select-all break-all max-w-full overflow-x-auto">
                    {{ $token->token }}
                </span>
                <button onclick="navigator.clipboard.writeText(this.parentElement.querySelector('span').textContent.trim())" 
                    class="px-2 py-1 bg-gray-300 rounded-lg text-sm hover:bg-gray-400">
                    Copy
                </button>
            </div>
            <p class="text-sm text-gray-600 mt-2">Tempel token ini di file <span class="font-mono text-blue-600">readme.txt</span> dalam ZIP Anda.</p>
        </div>
    </div>
    
    <!-- Changelog Section -->
    <div class="max-w-4xl mt-10 p-6 bg-white shadow-lg rounded-lg">
        <h2 class="text-2xl font-bold mb-4">Changelog</h2>
        <div class="max-h-16 overflow-y-auto border rounded-lg p-4 space-y-3 bg-gray-50">
            @foreach ($changelogs as $log)
                <p><span class="font-semibold">[{{ $log->created_at->format('d-m-Y H:i') }}]</span> {!! nl2br($log->message) !!}</p>
            @endforeach
        </div>
    </div>
</div>