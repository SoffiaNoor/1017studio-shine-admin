<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Shine Barrier</title>

    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>

<body style="background-image: url({{asset('assets/images/auth/background.jpg')}});background-position:center;background-size:cover"
    x-data="{ page: 'signin', 'loaded': true, 'darkMode': true, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }"
    x-init="
          darkMode = JSON.parse(localStorage.getItem('darkMode'));
          $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))"
    :class="{'dark text-bodydark': darkMode === true}">
    @include('partials.preloader')

    <div class="flex h-screen overflow-hidden">
        <div class="relative self-center flex flex-1 flex-col overflow-y-auto overflow-x-hidden"
            style="align-self: center;">
            <main>
                <div class="mx-auto max-w-screen-2xl content-center p-4 md:p-6 2xl:p-10">
                    <div class="rounded-xl content-center bg-boxdark/70 shadow-lg ring-1 ring-black/5">
                        <div class="items-center">
                            <div class="font-bold text-3xl text-center text-white my-5 uppercase">Page Not Found</div>
                            <img class="w-48 mx-auto my-10" src="{{asset('assets/images/error/warning.png')}}"/>
                            <p class="text-xl text-white text-center">Sorry, the page you are looking for could not be found.</p>
                            <div class="w-48 h-24 justify-self-center content-center" style="justify-self:center!important">
                                <a href="{{ url('/') }}"
                                    class="relative w-full inline-flex items-center justify-center p-4 px-6 py-3 overflow-hidden font-medium text-primary transition duration-300 ease-out border-2 border-primary rounded-lg shadow-md group">
                                    <span
                                        class="absolute inset-0 flex items-center justify-center w-full h-full text-white duration-300 -translate-x-full bg-primary group-hover:translate-x-0 ease">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                        </svg>
                                    </span>
                                    <span
                                        class="absolute flex items-center justify-center w-full h-full text-white transition-all duration-700 transform group-hover:translate-x-full ease">Go
                                        back to Home</span>
                                    <span class="relative invisible">Home</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    @vite('resources/js/app.js')

</body>

</html>