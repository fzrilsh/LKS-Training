<div class="container mx-auto min-h-screen flex items-center justify-center">
    <div class="bg-white rounded-2xl shadow-lg p-8 max-w-md w-full">
        <!-- Logo -->
        <div class="flex justify-center mb-6">
            <img src="{{ asset('images/logo.jpg') }}" alt="Taskia Logo" class="w-20 h-auto rounded-full">
        </div>
        <!-- Heading -->
        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold text-gray-700">Login</h1>
            <p class="text-sm text-gray-500">Belajar materi LKS terbaru disini!</p>
        </div>
        <hr class="border-gray-200 mb-6">
        <!-- Form -->
        <form id="userForm" class="space-y-6" method="GET" action="{{ route('auth.google') }}">
            <!-- Sign In Button -->
            <button type="submit" class="w-full bg-gradient-to-r from-blue-500 to-blue-700 text-white font-semibold py-3 rounded-full hover:blue-purple-600 hover:to-blue-800 transition-all">
                Login With <img src="{{ asset('images/icons/google.png') }}" alt="google-icon" class="inline w-10 ml-2 rounded-full bg-white p-1">
            </button>
        </form>
    </div>
</div>