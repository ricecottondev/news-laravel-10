<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DeepSeek - Laravel</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <h1 class="text-2xl font-bold mb-6 text-center">DeepSeek - Laravel</h1>
        <form action="{{ route('deepseekchat.send') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="system_message" class="block text-sm font-medium text-gray-700">Model:</label>
                <textarea id="system_message" name="system_message" rows="2" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm"></textarea>
            </div>
            <div class="mb-4">
                <label for="prompt" class="block text-sm font-medium text-gray-700">Masukkan Prompt:</label>
                <textarea id="prompt" name="prompt" rows="4" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm" required></textarea>
            </div>
            <div class="text-center">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Kirim</button>
            </div>
        </form>
    </div>

    {{-- <div class="mb-4">
        <p class="text-sm text-gray-600"><strong>Riwayat Percakapan:</strong></p>
        @foreach ($chatHistory as $chat)
            <div class="mt-1 p-2 bg-gray-50 border border-gray-200 rounded-md">
                <strong>{{ $chat['role'] === 'user' ? 'Anda' : 'DeepSeek' }}:</strong>
                {{ $chat['content'] }}
            </div>
        @endforeach
    </div> --}}
</body>
</html>
