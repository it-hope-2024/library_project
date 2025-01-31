<header class="z-40 bg-gray-100">
    <nav>
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">

                <img src="{{ asset('assets/images/library-book.svg') }}" class="h-8" alt="Library Logo" />
                <span class="self-center text-2xl font-semibold whitespace-nowrap text-gray-600">Library Center</span>
            </a>
            <button data-collapse-toggle="navbar-solid-bg" type="button"
                class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm bg-gray-300 text-gray-100 rounded-lg md:hidden hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400  "
                aria-controls="navbar-solid-bg" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>
            <div class="hidden w-full md:block md:w-auto" id="navbar-solid-bg">
                <ul
                    class="flex flex-col font-medium mt-4 rounded-lg  md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 text-gray-600 ">

                    <li>
                        <a href="/" class="block py-2 px-3 rounded ">Home</a>
                    </li>

                    @auth
                    <li>
                      <a href="/" class="block py-2 px-3 rounded ">Add Author</a>
                  </li>
                  <li>
                    <a href="/" class="block py-2 px-3 rounded ">Add Book</a>
                  </li>
                        <li>
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button class="block w-full text-left hover:bg-slate-100 pl-4 pr-8 py-2">Logout</button>
                            </form>
                        </li>
                    @endauth

                    @guest
                        <div class="flex items-center gap-4">
                            <a href="{{ route('login') }}" class="nav-link">Login</a>
                            <a href="{{ route('register') }}" class="nav-link">Register</a>
                        </div>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

</header>
