<div class="space-y-1">
    <!-- Medidas de tendencia central -->
    <div class="sidebar-item">
        <button onclick="toggleSection(this)" class="w-full flex items-center justify-between px-4 py-3 rounded-xl text-left font-medium text-gray-700 hover:bg-red-50 hover:text-red-600 transition-all duration-200 group">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-red-100 text-red-600 flex items-center justify-center group-hover:bg-red-600 group-hover:text-white transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                </div>
                <span>Tendencia central</span>
            </div>
            <svg class="w-4 h-4 text-gray-400 transition-transform duration-300 accordion-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
        </button>
        <div class="accordion-body">
            <div class="pl-14 pr-4 pb-2 space-y-1">
                <a href="{{ url('/medididas-de-tendencia-central/media') }}" class="block py-2 px-3 text-sm text-gray-600 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors">Media</a>
                <a href="{{ url('/medididas-de-tendencia-central/mediana') }}" class="block py-2 px-3 text-sm text-gray-600 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors">Mediana</a>
                <a href="{{ url('/medididas-de-tendencia-central/moda') }}" class="block py-2 px-3 text-sm text-gray-600 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors">Moda</a>
                <a href="{{ url('/medididas-de-tendencia-central/muestra') }}" class="block py-2 px-3 text-sm text-gray-600 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors">Calculadora de muestra</a>
            </div>
        </div>
    </div>

    <!-- Tabla de frecuencias -->
    <div class="sidebar-item">
        <button onclick="toggleSection(this)" class="w-full flex items-center justify-between px-4 py-3 rounded-xl text-left font-medium text-gray-700 hover:bg-red-50 hover:text-red-600 transition-all duration-200 group">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-violet-100 text-violet-600 flex items-center justify-center group-hover:bg-violet-600 group-hover:text-white transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                </div>
                <span>Frecuencias</span>
            </div>
            <svg class="w-4 h-4 text-gray-400 transition-transform duration-300 accordion-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
        </button>
        <div class="accordion-body">
            <div class="pl-14 pr-4 pb-2 space-y-1">
                <a href="{{ url('/tablas-de-distribucion-de-frecuencias/datos/agrupados') }}" class="block py-2 px-3 text-sm text-gray-600 hover:text-violet-600 hover:bg-violet-50 rounded-lg transition-colors">Datos no agrupados</a>
                <a href="{{ url('/tablas-de-distribucion-de-frecuencias/datos/no-agrupados') }}" class="block py-2 px-3 text-sm text-gray-600 hover:text-violet-600 hover:bg-violet-50 rounded-lg transition-colors">Datos agrupados</a>
            </div>
        </div>
    </div>

    <!-- Medidas de Posicion -->
    <div class="sidebar-item">
        <button onclick="toggleSection(this)" class="w-full flex items-center justify-between px-4 py-3 rounded-xl text-left font-medium text-gray-700 hover:bg-red-50 hover:text-red-600 transition-all duration-200 group">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-600 flex items-center justify-center group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                </div>
                <span>Posicion</span>
            </div>
            <svg class="w-4 h-4 text-gray-400 transition-transform duration-300 accordion-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
        </button>
        <div class="accordion-body">
            <div class="pl-14 pr-4 pb-2 space-y-1">
                <a href="{{ url('/Medidas-de-posicion/cuartiles') }}" class="block py-2 px-3 text-sm text-gray-600 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition-colors">Cuartiles</a>
                <a href="{{ url('/Medidas-de-posicion/deciles') }}" class="block py-2 px-3 text-sm text-gray-600 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition-colors">Deciles</a>
                <a href="{{ url('/Medidas-de-posicion/percentiles') }}" class="block py-2 px-3 text-sm text-gray-600 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition-colors">Percentiles</a>
            </div>
        </div>
    </div>

    <!-- Calculadoras extras -->
    <div class="sidebar-item">
        <button onclick="toggleSection(this)" class="w-full flex items-center justify-between px-4 py-3 rounded-xl text-left font-medium text-gray-700 hover:bg-red-50 hover:text-red-600 transition-all duration-200 group">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-amber-100 text-amber-600 flex items-center justify-center group-hover:bg-amber-600 group-hover:text-white transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/></svg>
                </div>
                <span>Extras</span>
            </div>
            <svg class="w-4 h-4 text-gray-400 transition-transform duration-300 accordion-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
        </button>
        <div class="accordion-body">
            <div class="pl-14 pr-4 pb-2 space-y-1">
                <a href="{{ url('/Calculadoras-extras/Coeficiente-de-Fisher') }}" class="block py-2 px-3 text-sm text-gray-600 hover:text-amber-600 hover:bg-amber-50 rounded-lg transition-colors">Asimetria de Fisher</a>
                <a href="{{ url('/Calculadoras-extras/Coeficiente-de-Bowley') }}" class="block py-2 px-3 text-sm text-gray-600 hover:text-amber-600 hover:bg-amber-50 rounded-lg transition-colors">Coeficiente de Bowley</a>
                <a href="{{ url('/Calculadoras-extras/Coeficiente-de-Pearson') }}" class="block py-2 px-3 text-sm text-gray-600 hover:text-amber-600 hover:bg-amber-50 rounded-lg transition-colors">Correlacion de Pearson</a>
                <a href="{{ url('/Calculadoras-extras/Coeficiente-de-curtosis') }}" class="block py-2 px-3 text-sm text-gray-600 hover:text-amber-600 hover:bg-amber-50 rounded-lg transition-colors">Curtosis</a>
                <a href="{{ url('/Calculadoras-extras/Grafica-de-pareto') }}" class="block py-2 px-3 text-sm text-gray-600 hover:text-amber-600 hover:bg-amber-50 rounded-lg transition-colors">Grafica de pareto</a>
            </div>
        </div>
    </div>
</div>
