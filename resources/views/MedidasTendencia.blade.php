@extends('layouts.app')

@section('Content')

@if ($operacion == 0)
    <div class="flex items-center justify-center min-h-[60vh]">
        <div class="text-center">
            <div class="w-20 h-20 mx-auto mb-6 rounded-2xl bg-red-500 flex items-center justify-center shadow-lg shadow-red-500/25">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                </svg>
            </div>
            <h2 class="font-outfit text-2xl font-bold text-gray-800 mb-2">Selecciona una calculadora</h2>
            <p class="text-gray-500 text-sm">Elige una operación del menú lateral para comenzar</p>
        </div>
    </div>
@endif

@if ($operacion == 1)
    <div class="max-w-2xl mx-auto">
        <div class="mb-8">
            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-red-50 text-red-600 text-xs font-semibold tracking-wide uppercase mb-4">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                Tendencia Central
            </div>
            <h2 class="font-outfit text-3xl sm:text-4xl font-bold text-gray-900">Calculadora de Media</h2>
            <p class="text-gray-500 mt-2 text-sm">Calcula el promedio aritmético de un conjunto de datos numéricos.</p>
        </div>

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="p-6 sm:p-8">
                <form action="{{ route('media') }}" method="post" class="space-y-6">
                    @csrf

                    <div>
                        <label for="datos" class="block text-sm font-semibold text-gray-700 mb-2">Datos de entrada</label>
                        <input
                            type="text"
                            name="datos"
                            placeholder="Ej: 12, 15, 18, 22, 30"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all text-sm"
                            oninput="validarInput(event)"
                        >
                        <p class="mt-1.5 text-xs text-gray-400">Separa los valores con comas</p>
                    </div>

                    <button
                        type="submit"
                        class="w-full sm:w-auto px-8 py-3 bg-red-500 text-white font-semibold rounded-xl hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500/30 transition-all shadow-sm shadow-red-500/25 active:scale-[0.98]"
                    >
                        Calcular Media
                    </button>
                </form>
            </div>

            @if($promedio !== null && $promedio !== '')
            <div class="border-t border-gray-100 bg-red-50 p-6 sm:p-8">
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Resultado</label>
                <input
                    type="text"
                    value="{{ $promedio }}"
                    readonly
                    class="w-full px-4 py-3.5 rounded-xl border-0 bg-white/80 text-gray-900 font-outfit text-xl font-bold shadow-sm focus:outline-none"
                >
            </div>
            @endif
        </div>
    </div>
@endif

@if ($operacion == 2)
    <div class="max-w-2xl mx-auto">
        <div class="mb-8">
            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-red-50 text-red-600 text-xs font-semibold tracking-wide uppercase mb-4">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/></svg>
                Tendencia Central
            </div>
            <h2 class="font-outfit text-3xl sm:text-4xl font-bold text-gray-900">Calculadora de Mediana</h2>
            <p class="text-gray-500 mt-2 text-sm">Encuentra el valor que divide al conjunto de datos en dos partes iguales.</p>
        </div>

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="p-6 sm:p-8">
                <form action="{{ route('mediana') }}" method="post" class="space-y-6">
                    @csrf

                    <div>
                        <label for="datos" class="block text-sm font-semibold text-gray-700 mb-2">Datos de entrada</label>
                        <input
                            type="text"
                            name="datos"
                            placeholder="Ej: 5, 10, 15, 20, 25"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all text-sm"
                            oninput="validarInput(event)"
                        >
                        <p class="mt-1.5 text-xs text-gray-400">Separa los valores con comas</p>
                    </div>

                    <button
                        type="submit"
                        class="w-full sm:w-auto px-8 py-3 bg-red-500 text-white font-semibold rounded-xl hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500/30 transition-all shadow-sm shadow-red-500/25 active:scale-[0.98]"
                    >
                        Calcular Mediana
                    </button>
                </form>
            </div>

            @if($mediana !== null && $mediana !== '')
            <div class="border-t border-gray-100 bg-red-50 p-6 sm:p-8">
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Resultado</label>
                <input
                    type="text"
                    value="{{ $mediana }}"
                    readonly
                    class="w-full px-4 py-3.5 rounded-xl border-0 bg-white/80 text-gray-900 font-outfit text-xl font-bold shadow-sm focus:outline-none"
                >
            </div>
            @endif
        </div>
    </div>
@endif

@if ($operacion == 3)
    <div class="max-w-2xl mx-auto">
        <div class="mb-8">
            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-red-50 text-red-600 text-xs font-semibold tracking-wide uppercase mb-4">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                Tendencia Central
            </div>
            <h2 class="font-outfit text-3xl sm:text-4xl font-bold text-gray-900">Calculadora de Moda</h2>
            <p class="text-gray-500 mt-2 text-sm">Identifica el valor que aparece con mayor frecuencia en los datos.</p>
        </div>

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="p-6 sm:p-8">
                <form action="{{ route('moda') }}" method="post" class="space-y-6">
                    @csrf

                    <div>
                        <label for="datos" class="block text-sm font-semibold text-gray-700 mb-2">Datos de entrada</label>
                        <input
                            type="text"
                            name="datos"
                            placeholder="Ej: 3, 7, 7, 2, 7, 5"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all text-sm"
                            oninput="validarInput(event)"
                        >
                        <p class="mt-1.5 text-xs text-gray-400">Separa los valores con comas</p>
                    </div>

                    <button
                        type="submit"
                        class="w-full sm:w-auto px-8 py-3 bg-red-500 text-white font-semibold rounded-xl hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500/30 transition-all shadow-sm shadow-red-500/25 active:scale-[0.98]"
                    >
                        Calcular Moda
                    </button>
                </form>
            </div>

            @if($moda !== null && $moda !== '')
            <div class="border-t border-gray-100 bg-red-50 p-6 sm:p-8">
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Resultado</label>
                <input
                    type="text"
                    value="{{ $moda }}"
                    readonly
                    class="w-full px-4 py-3.5 rounded-xl border-0 bg-white/80 text-gray-900 font-outfit text-xl font-bold shadow-sm focus:outline-none"
                >
            </div>
            @endif
        </div>
    </div>
@endif

@if ($operacion == 4)
    <div class="max-w-4xl mx-auto">
        <div class="mb-8">
            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-red-50 text-red-600 text-xs font-semibold tracking-wide uppercase mb-4">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                Muestreo
            </div>
            <h2 class="font-outfit text-3xl sm:text-4xl font-bold text-gray-900">Calculadora de Tamaño de Muestra</h2>
            <p class="text-gray-500 mt-2 text-sm">Determina el tamaño muestral necesario para tu estudio estadístico.</p>
        </div>

        <form action="{{ route('muestra') }}" method="post">
            @csrf

            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="p-6 sm:p-8">
                    <h3 class="font-outfit text-lg font-semibold text-gray-800 mb-6 flex items-center gap-2">
                        <span class="w-7 h-7 rounded-lg bg-red-100 text-red-600 flex items-center justify-center text-xs font-bold">1</span>
                        Parámetros de la población
                    </h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Tamaño de población</label>
                            <input
                                type="number"
                                name="poblacion"
                                placeholder="N"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all text-sm text-center"
                            >
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Nivel de confianza</label>
                            <select
                                name="confianza_1"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-900 focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all text-sm text-center appearance-none cursor-pointer"
                            >
                                <option value="1.645">90%</option>
                                <option value="1.96">95%</option>
                                <option value="2.576">99%</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Prob. de éxito (p)</label>
                            <input
                                type="text"
                                name="probabilidadP_1"
                                placeholder="0.5"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all text-sm text-center"
                            >
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Prob. de fracaso (q)</label>
                            <input
                                type="text"
                                name="probabilidadN_1"
                                placeholder="0.5"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all text-sm text-center"
                            >
                        </div>
                    </div>
                </div>

                <div class="border-t border-gray-100 bg-gray-50/50 p-6 sm:p-8">
                    <h3 class="font-outfit text-lg font-semibold text-gray-800 mb-6 flex items-center gap-2">
                        <span class="w-7 h-7 rounded-lg bg-red-100 text-red-600 flex items-center justify-center text-xs font-bold">2</span>
                        Corrección de finite
                    </h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Margen de error (e²)</label>
                            <input
                                type="text"
                                name="margenR"
                                placeholder="0.05²"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all text-sm text-center"
                            >
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">N - 1</label>
                            <input
                                type="number"
                                name="poblacion_1"
                                placeholder="N-1"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all text-sm text-center"
                            >
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Nivel de confianza</label>
                            <select
                                name="confianza_2"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all text-sm text-center appearance-none cursor-pointer"
                            >
                                <option value="1.645">90%</option>
                                <option value="1.96">95%</option>
                                <option value="2.576">99%</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Prob. de éxito (p)</label>
                            <input
                                type="text"
                                name="probabilidadP_2"
                                placeholder="0.5"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all text-sm text-center"
                            >
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Prob. de fracaso (q)</label>
                            <input
                                type="text"
                                name="probabilidadN_2"
                                placeholder="0.5"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-white text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all text-sm text-center"
                            >
                        </div>
                    </div>
                </div>

                @if($muestra !== null && $muestra !== '')
                <div class="border-t border-gray-100 bg-red-50 p-6 sm:p-8">
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Tamaño de muestra</label>
                    <input
                        type="text"
                        value="{{ $muestra }}"
                        readonly
                        class="w-full px-4 py-3.5 rounded-xl border-0 bg-white/80 text-gray-900 font-outfit text-xl font-bold shadow-sm focus:outline-none"
                    >
                </div>
                @endif

                <div class="p-6 sm:p-8 flex justify-center">
                    <button
                        type="submit"
                        class="w-full sm:w-auto px-10 py-3.5 bg-red-500 text-white font-semibold rounded-xl hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500/30 transition-all shadow-sm shadow-red-500/25 active:scale-[0.98]"
                    >
                        Calcular Muestra
                    </button>
                </div>
            </div>
        </form>
    </div>
@endif

@endsection
