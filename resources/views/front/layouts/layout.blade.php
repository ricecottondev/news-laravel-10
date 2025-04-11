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
            background-color: #1e1e1e;
            color: #d6cfbd;
        }

        .news-title {
            font-size: 22px;
            font-weight: 700;
            color: #272727;
            text-decoration: none;
        }

        .news-title-detail {
            font-size: 28px;
            font-weight: 700;
            color: #1a1a1a;
            text-decoration: none;
        }

        .news-sugestion {
            font-size: 16px;
            font-weight: 700;
            color: #696969;
            text-decoration: none;
        }

        .news-title-after-first {
            color: #d6cfbd;
            text-decoration: none;
            font-size: 14px;
            font-weight: 700;
            color: #535353;
        }




        .news-title:hover {
            text-decoration: underline;
        }

        .news-snippet {
            text-align: justify;
            text-justify: inter-word;
            margin-bottom: 0.5rem;
            color: #272727;
            font-size: 16px;
        }

        .custom-box {
            display: flex;
            border: 1px solid #ccc;
            border-radius: var(--box-radius, 10px);
            /* Default 10px */
            overflow: hidden;
            height: var(--box-height, auto);
            /* Default auto */
            width: var(--box-width, 100%);
            /* Default full width */

            background-color: white;
            box-shadow: 0 0.5rem 1rem rgba(10, 0, 65, 0.3);
            /* custom-shadow */
        }

        .custom-shadow {
            border: 1px solid #ccc;
            background-color: white;
            box-shadow: 0 0.5rem 1rem rgba(10, 0, 65, 0.3);
        }

        .news-container {
            border-bottom: 1px solid #444;
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

        .btn-custom {
            background-color: #cba34e;
            color: #0e1118;
            border: none;
        }

        .btn-custom:hover {
            background-color: #b89445;
            color: #0e1118;
        }

        .news-card {
            background-color: #ffffff;
            color: #d6cfbd;
            border-radius: 22px;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.25);
            border: 1px solid #333;
        }

        .news-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.4);
        }

        .news-card a.news-title {
            color: #272727;
            text-decoration: none;
        }

        .news-card a.news-title:hover {
            text-decoration: underline;
            color: #000000;
        }

        .news-card .text-muted {
            color: #999 !important;
        }

        .category-card {
            background-color: #ececec;
            color: #4b4b4b;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            border: 1px solid #333;
            transition: all 0.3s ease;
        }

        .category-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.4);
        }

        .category-card .news-title-after-first {
            font-size: 18px;
            font-weight: bold;
            color: #272727;
            text-decoration: none;
        }

        .category-card .news-title-after-first:hover {
            text-decoration: underline;
            color: #000000;
        }

        .category-card .news-snippet {
            font-size: 14px;
            color: #272727;
            text-align: justify;
        }

        .category-card .text-muted,
        .category-card .text-secondary {
            color: #999 !important;
        }
    </style>
@stack('styles')
</head>

<body>

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
