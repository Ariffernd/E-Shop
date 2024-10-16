<!DOCTYPE html>
<html lang="en">

<head>
    <script>
        // On page load or when changing themes, best to add inline in `head` to avoid FOUC
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia(
                '(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>ABFT.Co</title>
</head>

<body class="dark:bg-gray-800 bg-white">

    @include('Shop.template.navbar')

    <h1 class="text-center dark:text-white text-4xl my-4">Daftar Produk</h1>
    <hr class="border-t-4 border-gray-300 my-4 w-full justify-center">

    <div class="mx-80 my-20 dark:text-white">
        <div class="grid grid-cols-2">
            <div>

            </div>
            <div>
                <h1 class="dark:text-white text-4xl">{{$detail_produk->nama_produk}}</h1>
                <h1 class="mt-8 float-end ">Rp{{ number_format($detail_produk->harga, 0, ',', '.') }}</h1>
            </div>
            <div></div>
            <div>4</div>


        </div>
        <div class="text-left float-start my-5 m">
            <p>
                {{$detail_produk->deskripsi}}
            </p>
        </div>
        <div class="my-5 bg-slate-600 float-end">
            <form action="{{ route('bayar') }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $detail_produk->id }}">
                <input type="hidden" name="nama_produk" value="{{ $detail_produk->nama_produk }}">
                <input type="hidden" name="harga" value="{{ $detail_produk->harga }}">

                <button
                    class="focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900"
                    type="submit">Check Out</button>
            </form>
        </div>

    </div>


    @include('Shop.template.footer')
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    <script>
        var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
        var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

        // Change the icons inside the button based on previous settings
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia(
                '(prefers-color-scheme: dark)').matches)) {
            themeToggleLightIcon.classList.remove('hidden');
        } else {
            themeToggleDarkIcon.classList.remove('hidden');
        }

        var themeToggleBtn = document.getElementById('theme-toggle');

        themeToggleBtn.addEventListener('click', function() {

            // toggle icons inside button
            themeToggleDarkIcon.classList.toggle('hidden');
            themeToggleLightIcon.classList.toggle('hidden');

            // if set via local storage previously
            if (localStorage.getItem('color-theme')) {
                if (localStorage.getItem('color-theme') === 'light') {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                } else {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                }

                // if NOT set via local storage previously
            } else {
                if (document.documentElement.classList.contains('dark')) {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                } else {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                }
            }

        });
    </script>
</body>

</html>
