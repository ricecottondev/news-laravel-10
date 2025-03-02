<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel - DeepSeek</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <h1 class="text-2xl font-bold mb-6 text-center">Laravel - DeepSeek</h1>
        <div class="mb-4">
            <p class="text-sm text-gray-600"><strong>Model:</strong></p>
            <p class="mt-1 p-2 bg-gray-50 border border-gray-200 rounded-md">{{ $model }}</p>
        </div>
        <div class="mb-4">
            <p class="text-sm text-gray-600"><strong>Prompt Anda:</strong></p>
            <p class="mt-1 p-2 bg-gray-50 border border-gray-200 rounded-md">{{ $prompt }}</p>
        </div>
        <div class="mb-4">
            <p class="text-sm text-gray-600"><strong>Respons DeepSeek:</strong></p>
            <p class="mt-1 p-2 bg-gray-50 border border-gray-200 rounded-md">{{ $response }}</p>
        </div>
        <div class="text-center">
            <a href="{{ route('deepseekchat.form') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Kembali</a>
        </div>
    </div>
</body>
</html>
