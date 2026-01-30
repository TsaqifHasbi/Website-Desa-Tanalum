<!-- Tab Navigation -->
<section class="bg-white border-b sticky top-16 z-40">
    <div class="container mx-auto px-4">
        <nav class="flex overflow-x-auto scrollbar-hide">
            <a href="{{ route('infografis.penduduk') }}"
                class="flex flex-col items-center px-6 py-4 border-b-2 {{ request()->routeIs('infografis.penduduk') ? 'border-green-600 text-green-600' : 'border-transparent text-gray-500 hover:text-green-600' }} transition whitespace-nowrap">
                <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <span class="text-sm font-medium">Penduduk</span>
            </a>
            <a href="{{ route('infografis.apbdes') }}"
                class="flex flex-col items-center px-6 py-4 border-b-2 {{ request()->routeIs('infografis.apbdes') ? 'border-green-600 text-green-600' : 'border-transparent text-gray-500 hover:text-green-600' }} transition whitespace-nowrap">
                <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                </svg>
                <span class="text-sm font-medium">APBDes</span>
            </a>
            <a href="{{ route('infografis.stunting') }}"
                class="flex flex-col items-center px-6 py-4 border-b-2 {{ request()->routeIs('infografis.stunting') ? 'border-green-600 text-green-600' : 'border-transparent text-gray-500 hover:text-green-600' }} transition whitespace-nowrap">
                <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
                <span class="text-sm font-medium">Stunting</span>
            </a>
            <a href="{{ route('infografis.bansos') }}"
                class="flex flex-col items-center px-6 py-4 border-b-2 {{ request()->routeIs('infografis.bansos') ? 'border-green-600 text-green-600' : 'border-transparent text-gray-500 hover:text-green-600' }} transition whitespace-nowrap">
                <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-sm font-medium">Bansos</span>
            </a>
            <a href="{{ route('infografis.idm') }}"
                class="flex flex-col items-center px-6 py-4 border-b-2 {{ request()->routeIs('infografis.idm') ? 'border-green-600 text-green-600' : 'border-transparent text-gray-500 hover:text-green-600' }} transition whitespace-nowrap">
                <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                </svg>
                <span class="text-sm font-medium">IDM</span>
            </a>
            <a href="{{ route('infografis.sdgs') }}"
                class="flex flex-col items-center px-6 py-4 border-b-2 {{ request()->routeIs('infografis.sdgs') ? 'border-green-600 text-green-600' : 'border-transparent text-gray-500 hover:text-green-600' }} transition whitespace-nowrap">
                <span class="text-lg font-bold mb-1">1̲2̲3</span>
                <span class="text-sm font-medium">SDGs</span>
            </a>
        </nav>
    </div>
</section>
