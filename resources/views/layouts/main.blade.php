<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THE | @yield('title')</title>

    {{-- css bootstrap 5 --}}
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    {{-- css font awesome  --}}
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css'
        integrity='sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A=='
        crossorigin='anonymous' />
    <script src='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/js/all.min.js'
        integrity='sha512-8pHNiqTlsrRjVD4A/3va++W1sMbUHwWxxRPWNyVlql3T+Hgfd81Qc6FC5WMXDC+tSauxxzp1tgiAvSKFu1qIlA=='
        crossorigin='anonymous'></script>

</head>

<body>

    {{-- <div class="wrapper"> --}}
    {{-- sidebar --}}
    @include('layouts.sidebar')

    {{-- content --}}
    <section class="home">
        {{-- navbar --}}
        @include('layouts.navbar')

        <div class="container mt-2">

            {{-- page --}}
            @yield('page')
        </div>
    </section>
    {{-- </div> --}}


    {{-- js bootstrap 5 --}}
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
