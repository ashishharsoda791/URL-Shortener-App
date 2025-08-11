<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>URL Shortener</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto">
            <!-- Header -->
            <div class="text-center mb-8">
                <h1 class="text-4xl font-bold text-gray-800 mb-2">URL Shortener</h1>
                <p class="text-gray-600">Shorten your long URLs into compact, shareable links</p>
            </div>

            <!-- Main Card -->
            <div class="bg-white rounded-lg shadow-lg p-8">
                <!-- Form -->
                <form action="{{ route('shorten') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label for="url" class="block text-sm font-medium text-gray-700 mb-2">
                            Enter your long URL
                        </label>
                        <input 
                            type="url" 
                            name="url" 
                            id="url" 
                            value="{{ old('url') }}"
                            placeholder="https://www.example.com/very/long/url/that/needs/shortening"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('url') border-red-500 @enderror"
                            required
                        >
                        @error('url')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <button 
                        type="submit" 
                        class="w-full bg-blue-600 text-white py-3 px-6 rounded-lg hover:bg-blue-700 transition duration-200 font-medium"
                    >
                        Shorten URL
                    </button>
                </form>

                <!-- Result -->
                @if(session('shortUrl'))
                    <div class="mt-8 p-6 bg-green-50 border border-green-200 rounded-lg">
                        <h3 class="text-lg font-semibold text-green-800 mb-2">Your shortened URL:</h3>
                        <div class="flex items-center space-x-2">
                            <input 
                                type="text" 
                                value="{{ session('shortUrl') }}" 
                                id="shortUrl" 
                                readonly 
                                class="flex-1 px-4 py-2 border border-green-300 rounded-lg bg-white text-green-800 font-mono text-sm"
                            >
                            <button 
                                onclick="copyToClipboard()" 
                                class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition duration-200"
                            >
                                Copy
                            </button>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Features -->
            <div class="mt-8 grid md:grid-cols-3 gap-6">
                <div class="bg-white rounded-lg shadow p-6 text-center">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-800 mb-2">Fast & Reliable</h3>
                    <p class="text-gray-600 text-sm">Instant URL shortening with 99.9% uptime</p>
                </div>
                
                <div class="bg-white rounded-lg shadow p-6 text-center">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-800 mb-2">Secure</h3>
                    <p class="text-gray-600 text-sm">Your URLs are safe and secure with us</p>
                </div>
                
                <div class="bg-white rounded-lg shadow p-6 text-center">
                    <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"></path>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-800 mb-2">Shareable</h3>
                    <p class="text-gray-600 text-sm">Easy to share on social media and messaging</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        function copyToClipboard() {
            const shortUrl = document.getElementById('shortUrl');
            shortUrl.select();
            shortUrl.setSelectionRange(0, 99999);
            document.execCommand('copy');
            
            // Show feedback
            const button = event.target;
            const originalText = button.textContent;
            button.textContent = 'Copied!';
            button.classList.add('bg-green-700');
            
            setTimeout(() => {
                button.textContent = originalText;
                button.classList.remove('bg-green-700');
            }, 2000);
        }
    </script>
</body>
</html>

