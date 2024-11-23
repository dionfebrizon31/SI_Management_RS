<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>

<body>

    <!-- header -->
    <header class="bg-transparent absolute top-0 left-0 w-full flex items-center z-10">
        <div class="container">
            <div class="flex items-center justify-between relative">
                <div class="px-4">
                    <a href="#home" class="font-bold text-lg text-sky-400 block py-6">Home</a>

                </div>
                <div class="flex items-center px-4">
                    <button id="hamburger" name=" hamburger" type="button" class="block absolute right-4 lg:hidden">
                        <span class="hamburger-line transition duration-300 ease-in-out origin-top-left"></span>
                        <span class="hamburger-line transition duration-300 ease-in-out "></span>
                        <span class="hamburger-line  transition duration-300 ease-in-out origin-top-left"></span>
                    </button>
                    {{-- // area mobbile --}}
                    <nav id="nav-menu"
                        class="hidden absolute py-5 bg-white shadow-lg rounded-lg max-w-[250px] w-full right-4 top-full lg:block lg:static lg:bg-transparent lg:max-w-full lg:shadow-none lg:rounded-none">
                        <ul class="block lg:flex">
                            <li class="group">
                                <a href="#"
                                    class="text-base text-dark py-2 mx-8 group-hover:text-primary">Home</a>
                            </li>
                            <li class="group">
                                <a href="#"
                                    class="text-base text-dark py-2 mx-8 group-hover:text-primary">Home</a>
                            </li>
                        </ul>
                    </nav>
                    {{-- end area mobile --}}


                </div>
            </div>
        </div>
    </header>

    <!-- header end -->
    {{-- herro section --}}

    <section id="home" class="pt-32">
        <div class="bg-gray-200">
            <div class="container">
                <div class="flex flex-wrap">
                    <div class="w-full self-center px-4 lg:w-1/2">
                        <h1 class="text-base font-semibold text-primary md:text-xl "> halo semua 👌, selamat
                            datang
                            <span class="block font-bold text-dark text-4xl mt-1 lg:text-5xl"> Rs Suka Mandiri </span>
                        </h1>
                        <h2 class="font-medium text-slate-500 text-lg mb-5 lg:text-lg">Sistem informasi Terpadu
                        </h2>
                        <p class="font-medium text-slate-400 mb-10 leading-relaxed">
                            <span class="text-dark font-bold">kan</span>
                        </p>
                        <a href="#"
                            class="text-base font-semibold text-white bg-primary py-3 px-8 rounded-full hover:shadow-lg hover:opacity-90 transition duration-300 ease-in-out">
                            registrasi now
                        </a>
                    </div>
                    <div class="w-full self-end px-4 lg:w-1/2">
                        <div class="relative mt-10 lg:mt-9 lg:right-0">
                            <img src="{{ asset('images/Hero.png') }}" alt="Hero Image" width="250" height="250"
                                class="max-w-full mx-auto">

                            <span class="absolute -bottom-0 -z-10 left-1/2 -translate-x-1/2 md:scale-125">
                                <svg width="400" height="400" viewBox="0 0 200 200"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill="#14b8a6"
                                        d="M26.6,-36.5C36,-23.7,46.4,-16.9,55.3,-4.2C64.1,8.4,71.3,26.9,66.3,40.7C61.2,54.6,43.9,63.8,28.2,63.5C12.5,63.2,-1.7,53.3,-20.2,49.3C-38.6,45.2,-61.5,46.9,-70.2,37.7C-78.8,28.5,-73.4,8.2,-65.8,-7.6C-58.2,-23.4,-48.4,-34.7,-37.1,-47.2C-25.8,-59.7,-12.9,-73.3,-2.2,-70.7C8.5,-68.1,17.1,-49.3,26.6,-36.5Z"
                                        transform="translate(100 100) scale(1.1)" />
                                </svg>
                            </span>
                            <p class="text-center font-bold text-lg relative hover:text-primary">
                                Direktur Rs Suka Mandiri</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- hero section end --}}

    {{-- section pengumuman --}}
    <section id="blog" class="pt-14 pb-12 bg-slate-100">
        <div class="container">
            <div class="w-full px-4">
                <div class="max-w-xl mx-auto text-center mb-16">
                    <h4 class="font-semibold text-xl text-primary mb-2">News Pengumuman </h4>
                    <h2 class="font-bold text-dark text-3xl mb-4 sm:text-4xl lg:text-5xl"> Hari ini</h2>
                    <p class="font-medium text-md text-secondary md:text-lg">Lorem ipsum dolor sit amet, consectetur
                        adipisicing
                        elit. Adipisci,
                        maiores.</p>
                </div>
            </div>
            <div class="flex flext-warp">
                <div class="w-full px-4 lg:w-1/2 xl:h-1/3">
                    <div class="bg-white rounded-r-xl shadow-lg overflow-hidden mb-10">
                        <img src="https://source.unsplash.com/360x200?programming" alt="Pengumuman">

                        <div class="py-8 px-6">
                            <h3><a href="#"
                                    class="block mb-3 font-semibold text-xl text-dark hover:text-primary truncate">
                                    Tittle</a></h3>
                            <h2>Admin Posting</h2>
                            <p class="font-medium text-base text-secondary m-4">Lorem, ipsum dolor sit amet consectetur
                                adipisicing elit. Ut, a!</p>
                            <a href="#"
                                class="font-medium text-sm text-white bg-primary py-2 px-4 rounded-lg hover:opacity-80">Baca
                                Selengkapnya</a>

                        </div>

                    </div>

                </div>
                <div class="w-full px-4 lg:w-1/2 xl:h-1/3">
                    <div class="bg-white rounded-r-xl shadow-lg overflow-hidden mb-10">
                        <img src="https://source.unsplash.com/360x200?programming" alt="Pengumuman">
                        <div class="py-8 px-6">
                            <h3><a href="#"
                                    class="block mb-3 font-semibold text-xl text-dark hover:text-primary truncate">
                                    Tittle</a></h3>
                            <h2>Admin Posting</h2>
                            <p class="font-medium text-base text-secondary m-4">Lorem, ipsum dolor sit amet consectetur
                                adipisicing elit. Ut, a!</p>
                            <a href="#"
                                class="font-medium text-sm text-white bg-primary py-2 px-4 rounded-lg hover:opacity-80">Baca
                                Selengkapnya</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section>
    {{-- section pengumuman end --}}
    {{-- contacts start --}}

    <section class="contact pt-14 pb-12">
        <div class="container">
            <div class="w-full px-4">
                <div class="max-w-xl mx-auto text-center mb-16">
                    <h4 class="font-semibold text-xl text-primary mb-2">Cotact</h4>
                    <h2 class="font-semibold text-dark text-3xl mb-4 sm:text-4xl lg:text-5xl">Hubungi Kami</h2>
                    <p class="font-medium text-md text-secondary md:text-lg">Lorem ipsum dolor sit amet, consectetur
                        adipisicing
                        elit. Adipisci,
                        maiores.</p>
                </div>
                <form action="">
                    <div class="w-full px-4 mb-4">
                        <label for="name" class="text-base font-bold text-primary">Nama</label>
                        <input type="text" id="name"
                            class="w-full bg-slate-200 text-dark p-3 rounded-md focus:outline-none focus:ring-primary focus:border-primary">
                    </div>
                    <div class="w-full px-4 mb-4">
                        <label for="email" class="text-base font-bold text-primary">Email</label>
                        <input type="text" id="email" name="email"
                            class="w-full bg-slate-200 text-dark p-3 rounded-md focus:outline-none focus:ring-primary focus:border-primary">
                    </div>
                    <div class="w-full px-4 mb-4">
                        <label for="message" class="text-base font-bold text-primary">Message</label>
                        <textarea id="message" name="message"
                            class="w-full bg-slate-200 text-dark p-3 rounded-md focus:outline-none focus:ring-primary focus:border-primary h-32">
                        </textarea>
                    </div>
                    <div class="w-full">
                        <button class="text-base font-semibold text-white bg-primary py-3 px-8 rounded-full w-full">
                            kirim

                        </button>

                    </div>

                </form>
            </div>
        </div>
    </section>
    {{-- contact end --}}

</body>

</html>
