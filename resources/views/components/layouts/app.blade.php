<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Sceneza - Movie Discovery App' }}</title>

    {{-- font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=ADLaM+Display&family=Figtree:ital,wght@0,300..900;1,300..900&display=swap"
        rel="stylesheet">

    {{-- font awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .adlam {
            font-family: "ADLaM Display", system-ui;
            font-weight: 400;
            font-style: normal;
        }

        .custom-scroll {
            scrollbar-width: thin;
            scrollbar-color: rgba(255, 255, 255, 0.7) transparent;
        }

        .custom-scroll::-webkit-scrollbar {
            height: 8px;
        }

        .custom-scroll::-webkit-scrollbar-track {
            background: transparent;
        }

        .custom-scroll::-webkit-scrollbar-thumb {
            background-color: rgba(255, 255, 255, 0.7);
            border-radius: 9999px;
            transition: background-color 0.3s ease;
        }

        .custom-scroll::-webkit-scrollbar-thumb:hover {
            background-color: rgba(255, 165, 0, 0.6);
        }

        .custom-scroll::-webkit-scrollbar-thumb:active {
            background-color: #FFA500;
        }

        .bg-dots-pattern {
            background-image: radial-gradient(#3d3d3d20 1px, transparent 1px);
            background-size: 10px 10px;
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-black bg-dots-pattern text-[#E0E0E0] font-[Figtree]">
    {{ $slot }}
</body>

</html>
