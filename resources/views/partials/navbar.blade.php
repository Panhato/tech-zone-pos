<nav class="fixed w-full z-[100] top-0 bg-white/90 backdrop-blur-md shadow-sm transition-all duration-300">
    <div class="container mx-auto px-6 py-4 flex justify-between items-center">
        <a href="{{ route('shop.index') }}" class="text-2xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600 flex items-center gap-2">
            <i class="fas fa-microchip text-blue-600"></i>
            <span class="tracking-tighter font-bold">TECH ZONE</span>
        </a>
        
        <div class="hidden md:flex space-x-8 font-medium">
            @php
                $navLinks = [
                    ['route' => 'shop.index', 'label' => 'Shop'], // ប្តូរពី products.index មក shop.index
                    ['route' => 'about', 'label' => 'About'],
                    ['route' => 'contact', 'label' => 'Contact'],
                ];
            @endphp

            @foreach($navLinks as $link)
                <a href="{{ Route::has($link['route']) ? route($link['route']) : '#' }}" 
                   class="relative py-1 transition-colors duration-200 {{ request()->routeIs($link['route']) ? 'text-blue-600 font-bold' : 'text-gray-600 hover:text-blue-600' }}">
                    {{ $link['label'] }}
                    @if(request()->routeIs($link['route']))
                        <span class="absolute bottom-0 left-0 w-full h-0.5 bg-blue-600 rounded-full"></span>
                    @endif
                </a>
            @endforeach
        </div>

        <div class="flex items-center space-x-3 md:space-x-5">
            <a href="{{ route('cart') }}" class="relative p-2 text-gray-600 hover:text-blue-600 transition-transform active:scale-90" title="កន្ត្រកទំនិញ">
                <i class="fas fa-shopping-bag text-xl"></i>
                @if(session('cart') && count((array) session('cart')) > 0)
                    <span class="absolute top-1 right-0 bg-red-500 text-white text-[10px] w-5 h-5 flex items-center justify-center rounded-full border-2 border-white font-bold animate-pulse">
                        {{ count((array) session('cart')) }}
                    </span>
                @endif
            </a>

            @if (Route::has('login'))
                @auth
                    <div class="relative group">
                        <button class="flex items-center space-x-2 text-gray-700 font-semibold hover:text-blue-600 focus:outline-none py-1 text-sm lg:text-base">
                            <div class="relative">
                                <img src="{{ Auth::user()->avatar ? asset('storage/avatars/'.Auth::user()->avatar) : 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name).'&background=0D8ABC&color=fff' }}" 
                                     alt="Profile" 
                                     class="w-9 h-9 rounded-full border-2 border-gray-100 object-cover shadow-sm group-hover:border-blue-200 transition-all">
                                <span class="absolute bottom-0 right-0 w-2.5 h-2.5 bg-green-500 border-2 border-white rounded-full"></span>
                            </div>
                            <span class="hidden lg:inline text-sm">{{ Auth::user()->name }}</span>
                            <i class="fas fa-chevron-down text-[10px] transition-transform duration-300 group-hover:rotate-180"></i>
                        </button>

                        <div class="absolute right-0 top-full pt-4 w-72 hidden group-hover:block transition-all z-[110]">
                            <div class="bg-white rounded-2xl shadow-2xl border border-gray-100 overflow-hidden ring-1 ring-black ring-opacity-5">
                                
                                <div class="px-5 py-4 border-b border-gray-50 bg-gray-50/50 text-center">
                                    <div class="flex flex-col items-center">
                                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-[0.15em] mb-1">គណនីរបស់អ្នក</p>
                                        <p class="text-sm font-bold text-slate-800 truncate w-full px-2">{{ Auth::user()->email }}</p>
                                        
                                        @if(Auth::user()->role === 'super_admin')
                                            <span class="mt-2 px-3 py-0.5 bg-purple-100 text-purple-600 text-[10px] font-black uppercase rounded-full border border-purple-200 shadow-sm">អ្នកគ្រប់គ្រងធំ</span>
                                        @elseif(Auth::user()->role === 'admin')
                                            <span class="mt-2 px-3 py-0.5 bg-blue-100 text-blue-600 text-[10px] font-black uppercase rounded-full border border-blue-200 shadow-sm">អ្នកគ្រប់គ្រង</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="py-2">
                                    <a href="{{ route('profile.index') }}" class="flex items-center gap-4 px-5 py-2.5 text-sm text-gray-600 hover:bg-blue-50 hover:text-blue-600 transition-colors">
                                        <div class="w-8 h-8 rounded-xl bg-blue-100 flex items-center justify-center text-blue-600 shadow-sm"><i class="far fa-user-circle"></i></div>
                                        <span class="font-medium">ព័ត៌មានផ្ទាល់ខ្លួន</span>
                                    </a>
                                    <a href="{{ route('order.history') }}" class="flex items-center gap-4 px-5 py-2.5 text-sm text-gray-600 hover:bg-green-50 hover:text-green-600 transition-colors">
                                        <div class="w-8 h-8 rounded-xl bg-green-100 flex items-center justify-center text-green-600 shadow-sm"><i class="fas fa-history text-xs"></i></div>
                                        <span class="font-medium">ប្រវត្តិការទិញ</span>
                                    </a>
                                </div>

                                {{-- ប៊ូតុងរហ័សសម្រាប់ Admin --}}
                                @if(Auth::user()->role === 'super_admin' || Auth::user()->role === 'admin')
                                    <div class="mx-5 border-t border-gray-100 my-1"></div>
                                    <div class="px-5 py-2">
                                        <p class="text-[10px] text-purple-400 font-bold uppercase tracking-widest mb-2">ការគ្រប់គ្រង</p>
                                        <div class="space-y-1">
                                            <a href="{{ route('admin.products.index') }}" class="flex items-center gap-3 p-2 text-sm text-gray-700 hover:bg-purple-50 rounded-lg transition-colors group/item">
                                                <i class="fas fa-boxes text-purple-500 group-hover/item:scale-110 transition-transform"></i>
                                                <span>គ្រប់គ្រងទំនិញ</span>
                                            </a>
                                            <a href="{{ route('admin.attendances.index') }}" class="flex items-center gap-3 p-2 text-sm text-gray-700 hover:bg-green-50 rounded-lg transition-colors group/item">
                                                <i class="fas fa-calendar-check text-green-500 group-hover/item:scale-110 transition-transform"></i>
                                                <span>កត់ត្រាវត្តមាន</span>
                                            </a>
                                        </div>
                                    </div>
                                @endif

                                <div class="border-t border-gray-100"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="flex items-center gap-4 w-full text-left px-5 py-4 text-sm text-red-500 hover:bg-red-50 transition-colors font-bold group/logout">
                                        <div class="w-8 h-8 rounded-xl bg-red-100 flex items-center justify-center text-red-500 group-hover/logout:bg-red-500 group-hover/logout:text-white transition-all">
                                            <i class="fas fa-sign-out-alt"></i>
                                        </div>
                                        <span>ចាកចេញពីគណនី</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="bg-slate-900 text-white px-7 py-2.5 rounded-full font-bold hover:bg-blue-600 hover:shadow-lg hover:shadow-blue-200 transition-all active:scale-95 text-sm uppercase tracking-wide">
                        Login
                    </a>
                @endauth
            @endif
        </div>
    </div>
</nav>