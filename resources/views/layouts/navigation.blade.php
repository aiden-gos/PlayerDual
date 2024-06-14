<nav x-data="{ open: false }" class="bg-white shadow-md shadow-gray-950/10 backdrop-blur-3xl z-[100]">
    <!-- Primary Navigation Menu -->
    <div class=" ">
        <div class="flex justify-between h-16">
            <div class="flex p-2 w-full">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>
            </div>

            <div class="flex flex-row w-full justify-center w-full">
                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-5 sm:flex">
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                        <div class="bg-neutral-300 rounded-full w-12 h-12 flex justify-center items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="25" height="25"
                                viewBox="0 0 50 50">
                                <path
                                    d="M 24.962891 1.0546875 A 1.0001 1.0001 0 0 0 24.384766 1.2636719 L 1.3847656 19.210938 A 1.0005659 1.0005659 0 1 0 2.6152344 20.789062 L 4 19.708984 L 4 46 A 1.0001 1.0001 0 0 0 5 47 L 18.832031 47 A 1.0001 1.0001 0 0 0 19.158203 47 L 30.832031 47 A 1.0001 1.0001 0 0 0 31.158203 47 L 45 47 A 1.0001 1.0001 0 0 0 46 46 L 46 19.708984 L 47.384766 20.789062 A 1.0005657 1.0005657 0 1 0 48.615234 19.210938 L 41 13.269531 L 41 6 L 35 6 L 35 8.5859375 L 25.615234 1.2636719 A 1.0001 1.0001 0 0 0 24.962891 1.0546875 z M 25 3.3222656 L 44 18.148438 L 44 45 L 32 45 L 32 26 L 18 26 L 18 45 L 6 45 L 6 18.148438 L 25 3.3222656 z M 37 8 L 39 8 L 39 11.708984 L 37 10.146484 L 37 8 z M 20 28 L 30 28 L 30 45 L 20 45 L 20 28 z">
                                </path>
                            </svg>
                        </div>
                    </x-nav-link>
                </div>

                <div class="hidden sm:-my-px sm:ml-5 sm:flex">
                    <x-nav-link :href="route('stories')">
                        <div class="bg-neutral-300 rounded-full w-12 h-12 flex justify-center items-center">
                            <svg fill="#000000" height="25" width="25" version="1.1" id="Capa_1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                viewBox="0 0 355.333 355.333" xml:space="preserve">
                                <g id="Camara_cine">
                                    <path d="M353.143,167.919c-1.388-1.139-3.21-1.599-4.973-1.25l-40.504,8c-2.811,0.555-4.837,3.021-4.837,5.886v4.626h-20.503
                                    v-3.419c0-10.613-8.972-19.248-20-19.248H243.41c23.777-10.602,40.401-34.448,40.401-62.119c0-37.49-30.5-67.99-67.99-67.99
                                    c-27.681,0-51.534,16.637-62.131,40.428c-10.596-23.792-34.45-40.428-62.131-40.428c-37.49,0-67.99,30.5-67.99,67.99
                                    c0,27.67,16.624,51.516,40.401,62.119H45.333c-10.646,0-19.351,8.053-19.943,18.159l-18.455-2.914
                                    c-1.733-0.271-3.5,0.226-4.833,1.365C0.768,180.264,0,181.93,0,183.685v39.492c0,1.755,0.768,3.421,2.102,4.562
                                    c1.094,0.935,2.479,1.438,3.898,1.438c0.311,0,0.624-0.024,0.936-0.073l18.398-2.905v17.222v27.005v0.752
                                    c0,10.613,8.972,19.248,20,19.248h41.249v26.503c0,3.313,2.687,6,6,6h122.497c3.313,0,6-2.687,6-6v-26.503h41.248
                                    c11.028,0,20-8.634,20-19.248v-0.752v-9.252h20.503v4.626c0,2.866,2.026,5.331,4.837,5.886l40.504,8
                                    c0.387,0.076,0.776,0.114,1.163,0.114c1.378,0,2.727-0.475,3.81-1.365c1.387-1.14,2.19-2.84,2.19-4.635V172.555
                                    C355.333,170.76,354.53,169.059,353.143,167.919z M215.821,44.405c30.873,0,55.99,25.117,55.99,55.99
                                    c0,30.874-25.117,55.991-55.99,55.991s-55.991-25.117-55.991-55.991C159.83,69.522,184.948,44.405,215.821,44.405z M35.569,100.395
                                    c0-30.873,25.117-55.99,55.99-55.99c30.874,0,55.991,25.117,55.991,55.99c0,25.257-16.813,46.652-39.833,53.604v-52.612
                                    c0.02-0.33,0.05-0.657,0.05-0.992c0-8.938-7.271-16.208-16.208-16.208s-16.208,7.271-16.208,16.208h-0.05v53.575
                                    C52.333,146.987,35.569,125.615,35.569,100.395z M87.301,116.017c1.359,0.371,2.783,0.587,4.258,0.587
                                    c1.44,0,2.829-0.207,4.158-0.561v40.172c-1.375,0.102-2.758,0.171-4.158,0.171c-1.434,0-2.851-0.072-4.258-0.178V116.017z
                                    M95.717,100.395v0.498c-0.25,2.084-2.008,3.711-4.158,3.711c-2.321,0-4.208-1.888-4.208-4.208s1.888-4.208,4.208-4.208
                                    s4.208,1.888,4.208,4.208H95.717z M153.69,127.957c6.837,15.351,19.193,27.712,34.541,34.556h-69.083
                                    C134.497,155.67,146.853,143.309,153.69,127.957z M45.333,174.514h216.993c4.411,0,8,3.251,8,7.248v9.419v46.24H37.333v-55.659
                                    C37.333,177.765,40.922,174.514,45.333,174.514z M12,216.155v-25.449l13.333,2.106v21.238L12,216.155z M209.079,310.929H98.582
                                    v-20.503h110.497V310.929z M215.079,278.425H92.582H45.333c-4.411,0-8-3.589-8-8V249.42h232.993v5.753v15.252c0,4.411-3.589,8-8,8
                                    H215.079z M282.327,249.173v-5.753v-46.24h20.503v51.993H282.327z M343.333,266.499l-28.504-5.63v-5.695v-63.993v-5.695
                                    l28.504-5.63V266.499z" />
                                    <path
                                        d="M208.355,216.507h42.979c3.313,0,6-2.687,6-6v-20.661c0-3.313-2.687-6-6-6h-42.979c-3.313,0-6,2.687-6,6v20.661
                                    C202.355,213.82,205.042,216.507,208.355,216.507z M214.355,195.846h30.979v8.661h-30.979V195.846z" />
                                    <path d="M215.821,116.604c8.938,0,16.208-7.271,16.208-16.208s-7.271-16.208-16.208-16.208s-16.209,7.271-16.209,16.208
                                    S206.883,116.604,215.821,116.604z M215.821,96.187c2.32,0,4.208,1.888,4.208,4.208s-1.888,4.208-4.208,4.208
                                    c-2.321,0-4.209-1.888-4.209-4.208S213.5,96.187,215.821,96.187z" />
                                </g>
                            </svg>
                        </div>
                    </x-nav-link>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ml-5 sm:flex">
                    <x-nav-link href="#" x-data=""
                        x-on:click.prevent="$dispatch('open-modal', 'rank-modal')">
                        <div class="bg-neutral-300 rounded-full w-12 h-12 flex justify-center items-center">
                            <svg fill="#000000" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" width="25" height="25"
                                viewBox="0 0 39.75 39.75" xml:space="preserve">
                                <g>
                                    <g>
                                        <path
                                            d="M17.673,21.639v10.663h-6.361c-0.275,0-0.5,0.226-0.5,0.5v5.75c0,0.273,0.225,0.5,0.5,0.5h17.125
                                            c0.274,0,0.5-0.227,0.5-0.5v-5.75c0-0.274-0.226-0.5-0.5-0.5h-6.359V21.639c9.924-0.938,17.672-8.104,17.672-16.784
                                            c0-0.276-0.236-0.5-0.516-0.5h-4.313c0.127-1.08,0.201-2.125,0.201-3.158c0-0.276-0.231-0.5-0.511-0.5H5.125
                                            c-0.276,0-0.5,0.224-0.5,0.5c0,1.029,0.076,2.074,0.203,3.158H0.5c-0.276,0-0.5,0.224-0.5,0.5
                                            C0,13.537,7.748,20.703,17.673,21.639z M27.938,38.05H11.813V33.3h6.361h3.403h6.358L27.938,38.05L27.938,38.05z M21.076,32.3
                                            h-2.402V21.694c0.4,0.021,0.796,0.054,1.201,0.054c0.404,0,0.802-0.031,1.201-0.054V32.3z M26.418,19.764
                                            c0.332-0.213,0.654-0.446,0.975-0.69c0.084-0.063,0.166-0.131,0.25-0.196c0.293-0.233,0.58-0.479,0.859-0.738
                                            c0.043-0.038,0.086-0.073,0.127-0.113c0.312-0.295,0.613-0.607,0.908-0.936c0.07-0.08,0.145-0.162,0.215-0.246
                                            c0.26-0.297,0.514-0.604,0.756-0.924c0.037-0.048,0.076-0.093,0.111-0.142c0.271-0.362,0.529-0.742,0.779-1.132
                                            c0.062-0.094,0.119-0.189,0.18-0.284c0.219-0.356,0.434-0.72,0.635-1.096c0.029-0.055,0.061-0.107,0.09-0.162
                                            c0.225-0.425,0.434-0.864,0.635-1.313c0.045-0.103,0.09-0.207,0.133-0.311c0.177-0.407,0.341-0.823,0.494-1.248
                                            c0.021-0.062,0.047-0.121,0.068-0.183c0.17-0.479,0.324-0.97,0.467-1.47c0.029-0.109,0.06-0.22,0.09-0.33
                                            c0.121-0.454,0.234-0.914,0.334-1.384c0.015-0.067,0.031-0.131,0.043-0.198c0.088-0.431,0.168-0.868,0.234-1.311h3.939
                                            C38.496,11.964,33.436,17.572,26.418,19.764z M34.121,1.697c-0.021,1.005-0.104,2.021-0.246,3.09
                                            c-1.178,8.66-6.414,15.096-12.705,15.879h-2.589c-6.29-0.784-11.527-7.219-12.704-15.879C5.731,3.714,5.649,2.699,5.63,1.697
                                            H34.121z M4.949,5.354c0.067,0.444,0.147,0.88,0.234,1.312c0.014,0.066,0.03,0.13,0.044,0.196C5.328,7.333,5.439,7.794,5.562,8.25
                                            C5.591,8.358,5.621,8.467,5.65,8.576c0.144,0.502,0.298,0.995,0.467,1.476c0.02,0.058,0.043,0.114,0.063,0.171
                                            c0.156,0.431,0.324,0.852,0.501,1.264c0.043,0.1,0.085,0.201,0.129,0.3c0.201,0.452,0.412,0.894,0.639,1.321
                                            c0.026,0.051,0.056,0.099,0.083,0.149c0.205,0.382,0.421,0.752,0.645,1.113c0.057,0.092,0.113,0.184,0.171,0.274
                                            c0.252,0.393,0.513,0.774,0.786,1.14c0.034,0.045,0.069,0.086,0.104,0.131c0.246,0.324,0.503,0.635,0.765,0.938
                                            c0.07,0.078,0.14,0.16,0.211,0.238c0.295,0.326,0.598,0.643,0.911,0.938c0.04,0.038,0.083,0.073,0.123,0.108
                                            c0.28,0.262,0.568,0.508,0.862,0.74c0.084,0.067,0.167,0.135,0.253,0.199c0.317,0.243,0.641,0.477,0.972,0.689
                                            C6.318,17.575,1.256,11.967,1.012,5.356H4.95L4.949,5.354L4.949,5.354z" />
                                        <path d="M12.25,34.55c0,0.275,0.224,0.5,0.5,0.5H26.5c0.273,0,0.5-0.225,0.5-0.5c0-0.274-0.227-0.5-0.5-0.5H12.75
                                                                C12.474,34.05,12.25,34.274,12.25,34.55z" />
                                        <path d="M25,3.364h7.438c0.275,0,0.5-0.224,0.5-0.5c0-0.276-0.225-0.5-0.5-0.5H25c-0.275,0-0.5,0.224-0.5,0.5
                                                                C24.5,3.14,24.725,3.364,25,3.364z" />
                                        <path d="M21.576,3.364H23c0.275,0,0.5-0.224,0.5-0.5c0-0.276-0.225-0.5-0.5-0.5h-1.424c-0.275,0-0.5,0.224-0.5,0.5
                                                                C21.076,3.14,21.299,3.364,21.576,3.364z" />
                                    </g>
                                </g>
                            </svg>
                        </div>
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6 w-full justify-end mr-5">

                @if (Route::has('login'))
                    @auth

                        @include('layouts.notification')

                        {{-- Add $ --}}
                        <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'checkout')"
                            class="inline-flex items-center px-3 py-2 text-sm font-mdium text-gray-500 hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div class="ml-1">
                                <div class="flex flex-row items-center justify-center rounded-xl p-2 text-black">
                                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="30" height="30"
                                        viewBox="0 0 30 30">
                                        <path
                                            d="M15,3C8.373,3,3,8.373,3,15c0,6.627,5.373,12,12,12s12-5.373,12-12C27,8.373,21.627,3,15,3z M21,16h-5v5 c0,0.553-0.448,1-1,1s-1-0.447-1-1v-5H9c-0.552,0-1-0.447-1-1s0.448-1,1-1h5V9c0-0.553,0.448-1,1-1s1,0.447,1,1v5h5 c0.552,0,1,0.447,1,1S21.552,16,21,16z">
                                        </path>
                                    </svg>
                                    ${{ Auth::user()->balance }}
                                </div>
                            </div>
                        </button>
                        {{-- Add $ --}}

                        <x-dropdown align="right" width="72">
                            <x-slot name="trigger">
                                <button
                                    class="inline-flex items-center px-3 py-2 text-sm font-mdium text-gray-500 hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                    {{-- <div>{{ Auth::user()->name }}</div> --}}
                                    <div class="ml-1">
                                        <img class="rounded-[50%] object-cover w-10 h-10"
                                            src="{{ Auth::user()->avatar }}" />
                                    </div>
                                    <div class="ml-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                @if (Auth::user()->role_id == 1)
                                    <x-dropdown-link :href="route('dashboard')">
                                        {{ __('Manager Dashboard') }}
                                    </x-dropdown-link>
                                @endif

                                <x-dropdown-link class="flex flex-row items-center gap-2 border-b"
                                    href="/user/{{ Auth::user()->id }}">
                                    <img src="{{ Auth::user()->avatar }}" width="50" height="50">
                                    <div>
                                        <div>{{ Auth::user()->name }}</div>
                                        <div>{{ Auth::user()->email }}</div>
                                    </div>
                                </x-dropdown-link>

                                <x-dropdown-link class="flex flex-row items-center gap-2 border-b" :href="route('profile.edit')">
                                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="28" height="28"
                                        viewBox="0 0 50 50">
                                        <path
                                            d="M 22.205078 2 A 1.0001 1.0001 0 0 0 21.21875 2.8378906 L 20.246094 8.7929688 C 19.076509 9.1331971 17.961243 9.5922728 16.910156 10.164062 L 11.996094 6.6542969 A 1.0001 1.0001 0 0 0 10.708984 6.7597656 L 6.8183594 10.646484 A 1.0001 1.0001 0 0 0 6.7070312 11.927734 L 10.164062 16.873047 C 9.583454 17.930271 9.1142098 19.051824 8.765625 20.232422 L 2.8359375 21.21875 A 1.0001 1.0001 0 0 0 2.0019531 22.205078 L 2.0019531 27.705078 A 1.0001 1.0001 0 0 0 2.8261719 28.691406 L 8.7597656 29.742188 C 9.1064607 30.920739 9.5727226 32.043065 10.154297 33.101562 L 6.6542969 37.998047 A 1.0001 1.0001 0 0 0 6.7597656 39.285156 L 10.648438 43.175781 A 1.0001 1.0001 0 0 0 11.927734 43.289062 L 16.882812 39.820312 C 17.936999 40.39548 19.054994 40.857928 20.228516 41.201172 L 21.21875 47.164062 A 1.0001 1.0001 0 0 0 22.205078 48 L 27.705078 48 A 1.0001 1.0001 0 0 0 28.691406 47.173828 L 29.751953 41.1875 C 30.920633 40.838997 32.033372 40.369697 33.082031 39.791016 L 38.070312 43.291016 A 1.0001 1.0001 0 0 0 39.351562 43.179688 L 43.240234 39.287109 A 1.0001 1.0001 0 0 0 43.34375 37.996094 L 39.787109 33.058594 C 40.355783 32.014958 40.813915 30.908875 41.154297 29.748047 L 47.171875 28.693359 A 1.0001 1.0001 0 0 0 47.998047 27.707031 L 47.998047 22.207031 A 1.0001 1.0001 0 0 0 47.160156 21.220703 L 41.152344 20.238281 C 40.80968 19.078827 40.350281 17.974723 39.78125 16.931641 L 43.289062 11.933594 A 1.0001 1.0001 0 0 0 43.177734 10.652344 L 39.287109 6.7636719 A 1.0001 1.0001 0 0 0 37.996094 6.6601562 L 33.072266 10.201172 C 32.023186 9.6248101 30.909713 9.1579916 29.738281 8.8125 L 28.691406 2.828125 A 1.0001 1.0001 0 0 0 27.705078 2 L 22.205078 2 z M 23.056641 4 L 26.865234 4 L 27.861328 9.6855469 A 1.0001 1.0001 0 0 0 28.603516 10.484375 C 30.066026 10.848832 31.439607 11.426549 32.693359 12.185547 A 1.0001 1.0001 0 0 0 33.794922 12.142578 L 38.474609 8.7792969 L 41.167969 11.472656 L 37.835938 16.220703 A 1.0001 1.0001 0 0 0 37.796875 17.310547 C 38.548366 18.561471 39.118333 19.926379 39.482422 21.380859 A 1.0001 1.0001 0 0 0 40.291016 22.125 L 45.998047 23.058594 L 45.998047 26.867188 L 40.279297 27.871094 A 1.0001 1.0001 0 0 0 39.482422 28.617188 C 39.122545 30.069817 38.552234 31.434687 37.800781 32.685547 A 1.0001 1.0001 0 0 0 37.845703 33.785156 L 41.224609 38.474609 L 38.53125 41.169922 L 33.791016 37.84375 A 1.0001 1.0001 0 0 0 32.697266 37.808594 C 31.44975 38.567585 30.074755 39.148028 28.617188 39.517578 A 1.0001 1.0001 0 0 0 27.876953 40.3125 L 26.867188 46 L 23.052734 46 L 22.111328 40.337891 A 1.0001 1.0001 0 0 0 21.365234 39.53125 C 19.90185 39.170557 18.522094 38.59371 17.259766 37.835938 A 1.0001 1.0001 0 0 0 16.171875 37.875 L 11.46875 41.169922 L 8.7734375 38.470703 L 12.097656 33.824219 A 1.0001 1.0001 0 0 0 12.138672 32.724609 C 11.372652 31.458855 10.793319 30.079213 10.427734 28.609375 A 1.0001 1.0001 0 0 0 9.6328125 27.867188 L 4.0019531 26.867188 L 4.0019531 23.052734 L 9.6289062 22.117188 A 1.0001 1.0001 0 0 0 10.435547 21.373047 C 10.804273 19.898143 11.383325 18.518729 12.146484 17.255859 A 1.0001 1.0001 0 0 0 12.111328 16.164062 L 8.8261719 11.46875 L 11.523438 8.7734375 L 16.185547 12.105469 A 1.0001 1.0001 0 0 0 17.28125 12.148438 C 18.536908 11.394293 19.919867 10.822081 21.384766 10.462891 A 1.0001 1.0001 0 0 0 22.132812 9.6523438 L 23.056641 4 z M 25 17 C 20.593567 17 17 20.593567 17 25 C 17 29.406433 20.593567 33 25 33 C 29.406433 33 33 29.406433 33 25 C 33 20.593567 29.406433 17 25 17 z M 25 19 C 28.325553 19 31 21.674447 31 25 C 31 28.325553 28.325553 31 25 31 C 21.674447 31 19 28.325553 19 25 C 19 21.674447 21.674447 19 25 19 z">
                                        </path>
                                    </svg>
                                    {{ __('Profile Setting') }}
                                </x-dropdown-link>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-dropdown-link class="flex flex-row items-center gap-2" :href="route('logout')"
                                        onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                        <svg width="28" height="28" viewBox="0 0 1024 1024"
                                            xmlns="http://www.w3.org/2000/svg" class="icon">
                                            <path
                                                d="M868 732h-70.3c-4.8 0-9.3 2.1-12.3 5.8-7 8.5-14.5 16.7-22.4 24.5a353.84 353.84 0 0 1-112.7 75.9A352.8 352.8 0 0 1 512.4 866c-47.9 0-94.3-9.4-137.9-27.8a353.84 353.84 0 0 1-112.7-75.9 353.28 353.28 0 0 1-76-112.5C167.3 606.2 158 559.9 158 512s9.4-94.2 27.8-137.8c17.8-42.1 43.4-80 76-112.5s70.5-58.1 112.7-75.9c43.6-18.4 90-27.8 137.9-27.8 47.9 0 94.3 9.3 137.9 27.8 42.2 17.8 80.1 43.4 112.7 75.9 7.9 7.9 15.3 16.1 22.4 24.5 3 3.7 7.6 5.8 12.3 5.8H868c6.3 0 10.2-7 6.7-12.3C798 160.5 663.8 81.6 511.3 82 271.7 82.6 79.6 277.1 82 516.4 84.4 751.9 276.2 942 512.4 942c152.1 0 285.7-78.8 362.3-197.7 3.4-5.3-.4-12.3-6.7-12.3zm88.9-226.3L815 393.7c-5.3-4.2-13-.4-13 6.3v76H488c-4.4 0-8 3.6-8 8v56c0 4.4 3.6 8 8 8h314v76c0 6.7 7.8 10.5 13 6.3l141.9-112a8 8 0 0 0 0-12.6z" />
                                        </svg>
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log
                            in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                        @endif
                    @endauth
                @endif
            </div>

            <div class="flex items-center sm:hidden">
                @if (Route::has('login'))
                    @auth
                        @include('layouts.notification')
                        {{-- Add $ --}}
                        <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'checkout')"
                            class="inline-flex items-center px-3 py-2 text-sm font-mdium text-gray-500 hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div class="ml-1">
                                <div class="flex flex-row items-center justify-center rounded-xl p-2 text-black">
                                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="30" height="30"
                                        viewBox="0 0 30 30">
                                        <path
                                            d="M15,3C8.373,3,3,8.373,3,15c0,6.627,5.373,12,12,12s12-5.373,12-12C27,8.373,21.627,3,15,3z M21,16h-5v5 c0,0.553-0.448,1-1,1s-1-0.447-1-1v-5H9c-0.552,0-1-0.447-1-1s0.448-1,1-1h5V9c0-0.553,0.448-1,1-1s1,0.447,1,1v5h5 c0.552,0,1,0.447,1,1S21.552,16,21,16z">
                                        </path>
                                    </svg>
                                    ${{ Auth::user()->balance }}
                                </div>
                            </div>
                        </button>
                        {{-- Add $ --}}
                    @endauth
                @endif

                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                {{ __('Home') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link>
                {{ __('Stories') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link>
                {{ __('Rank') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            @if (Route::has('login'))
                @auth
                    <div class="px-4">
                        <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                    </div>

                    <div class="mt-3 space-y-1">
                        <x-responsive-nav-link :href="route('profile.edit')">
                            {{ __('Profile Setting') }}
                        </x-responsive-nav-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-responsive-nav-link>
                        </form>
                    </div>
                @else
                    <x-responsive-nav-link :href="route('login')">
                        {{ __('Login') }}
                    </x-responsive-nav-link>
                    @if (Route::has('register'))
                        <x-responsive-nav-link :href="route('register')">
                            {{ __('Register') }}
                        </x-responsive-nav-link>
                    @endif
                @endauth
            @endif
        </div>
    </div>
</nav>

{{-- Form checkout  --}}
<style>
    label.error {
        color: red
    }
</style>
<x-modal name="checkout" focusable>
    <form id="recharge" method="post" action="{{ route('payment.checkout') }}" class="p-6">
        @csrf

        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Deposit money into account') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Deposit money into your account. Please enter the amount you want to deposit.') }}
        </p>

        <div class="mt-6">
            <x-input-label for="am" value="{{ __('Money') }}" class="sr-only" />

            <x-text-input id="am" name="money" type="number" class="mt-1 block w-3/4"
                placeholder="{{ __('Type number') }}" />
        </div>

        <div class="mt-6 flex justify-end">
            <x-secondary-button x-on:click="$dispatch('close')">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-primary-button class="ml-3">
                {{ __('Recharge') }}
            </x-primary-button>
        </div>
    </form>
</x-modal>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js" type="text/javascript"></script>
<script>
    $("#recharge").validate({
        onfocusout: false,
        onkeyup: false,
        onclick: false,
        rules: {
            "money": {
                required: true,
                min: 5,
            }
        }
    });
</script>

{{-- Noti JS --}}
@if (Route::has('login'))
    @auth
        <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
        <script type="module">
            // Pusher.logToConsole = true;
            const key = "{{ env('VITE_PUSHER_APP_KEY') }}";
            const cluster = "{{ env('VITE_PUSHER_APP_CLUSTER') }}";

            var pusher = new Pusher(key, {
                cluster: cluster
            });

            var channel = pusher.subscribe('{{ Auth::user()->id }}');
            channel.bind("App\\Events\\EventActionNotify", function(data) {
                console.log(data.message);
                $('.notification-content').prepend(`
        <a class="block w-full px-4 py-2 text-left text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out h-12 flex items-center border-b notify">
            <div>
                ${data.message}
            </div>
        </a>`)

                $('.active-noti').show()
                $('.no-noc').hide()
            });

            $('#btn-noti').click(function() {
                $('.active-noti').hide()
            })
        </script>
    @endauth
@endif

<script>
    var id = $('#noti-id').val();
    $('#read-all').click(function() {
        $.ajax({
            url: "{{ route('notification.readAll') }}",
            type: 'GET',
            success: function(result) {
                $(".notify").addClass('bg-gray-100')
            }
        });
    })

    $('.notify').click(function name(e) {
        e.preventDefault();
        this.classList.add('bg-gray-100')
        $.ajax({
            url: this.href,
            type: 'GET',
            success: function(result) {}
        });
    })
</script>
{{--  --}}
@include('rank')

@include('order.order-request')
@include('pre-order.pre-order-request')

<div class="fixed bottom-10 right-10 flex flex-col gap-4">
    @include('order.current-order')
    @include('order.pending-order')

    @include('pre-order.pending-pre-order')
    @include('pre-order.current-pre-order')
</div>
