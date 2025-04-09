<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-site-verification" content="77JWxQbqV-H-A9qKsDqm75U3ZdugkZOSvHAYtlj2gYA" />
    <title>@yield('title', 'News Website')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">




    <style>
        body {
            font-family: 'Roboto', sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }

        .news-title {
            font-size: 14px;
            font-weight: 700;
            color: #1a1a1a;
            text-decoration: none;
        }

        .news-title-detail {
            font-size: 28px;
            font-weight: 700;
            color: #1a1a1a;
            text-decoration: none;
        }

        .news-sugestion {
            font-size: 14px;
            font-weight: 700;
            color: #696969;
            text-decoration: none;
        }

        .news-title-after-first {
            font-size: 14px;
            font-weight: 700;
            color: #535353;
        }

        .news-title:hover {
            text-decoration: underline;
        }

        .news-snippet {
            /* color: #4a4a4a;
            font-size: 14px;
            line-height: 1.5;*/
            text-align: justify;
            text-justify: inter-word;
            /* opsional untuk kontrol jarak antar kata */
            margin-bottom: 0.5rem;
            /* mb-2 */
            color: #6c757d;
            /* text-muted */
            font-size: 0.875rem;
            /* small */


        }

        .custom-shadow {
            box-shadow: 0 0.5rem 1rem rgba(10, 0, 65, 0.3);
            /* #19b5ee with 30% opacity */
        }

        .news-container {
            border-bottom: 1px solid #ddd;
            padding-bottom: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .news-image {
            width: 120px;
            height: auto;
            object-fit: cover;
            border-radius: 5px;
        }

        .content-wrapper {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        main {
            flex: 1;
        }

        footer {
            margin-top: auto;
        }
    </style>

</head>

<body class="bg-light">

    <!-- Header -->
    @include('front.layouts.header')

    <!-- Main Content -->
    <div class="content-wrapper">
        <main class="container my-2">
            @yield('content')
        </main>
    </div>

    <!-- Footer -->
    @include('front.layouts.footer')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
