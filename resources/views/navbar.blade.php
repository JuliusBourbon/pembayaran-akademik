<nav class="bg-white border-b border-slate-200 shadow-sm fixed w-full z-30 top-0">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            
            <div class="flex">
                <div class="flex items-center">
                    <span class="text-xl font-bold cursor-default">Unikom</span>
                </div>

                <div class="hidden sm:ml-8 sm:flex sm:space-x-8">                    
                    <a href="{{ url('/dashboard') }}" class="{{ request()->is('dashboard') ? 'border-blue-500 text-slate-900' : 'border-transparent text-slate-500 hover:border-slate-300 hover:text-slate-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition duration-150 ease-in-out">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                        </svg>
                        <h1>Dashboard</h1>
                    </a>

                    <a href="{{ url('/cari-mahasiswa') }}" class="{{ request()->is('cari-mahasiswa*') ? 'border-blue-500 text-slate-900' : 'border-transparent text-slate-500 hover:border-slate-300 hover:text-slate-700' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition duration-150 ease-in-out">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <h1>Cari Mahasiswa</h1>
                    </a>

                </div>
            </div>

            <div class="hidden sm:ml-6 sm:flex sm:items-center">
                <div class="ml-3 relative flex items-center gap-4">
                    <div class="text-sm text-slate-600 font-medium">
                        Halo, <span class="text-slate-900 font-bold">{{ Session::get('username') }}</span>
                    </div>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="p-1 rounded-full cursor-pointer text-slate-400 hover:text-red-500 focus:outline-none transition duration-150" title="Keluar">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
            
            <div class="-mr-2 flex items-center sm:hidden">
                <button type="button" class="inline-flex items-center justify-center p-2 rounded-md text-slate-400 hover:text-slate-500 hover:bg-slate-100 focus:outline-none">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</nav>