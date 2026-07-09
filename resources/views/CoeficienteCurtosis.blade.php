@extends('layouts.app')

@section('Content')
    <div class="max-w-2xl mx-auto">
        <div class="mb-8">
            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-red-50 text-red-600 text-xs font-semibold tracking-wide uppercase mb-4">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                Forma
            </div>
            <h2 class="font-outfit text-3xl sm:text-4xl font-bold text-gray-900">Coeficiente de Curtosis</h2>
            <p class="text-gray-500 mt-2 text-sm">Mide la forma de la distribucion de los datos, indicando si son mas o menos apuntadas que la distribucion normal.</p>
        </div>

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="p-6 sm:p-8">
                <form action="{{ route('Curtosis') }}" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <label for="data" class="block text-sm font-semibold text-gray-700 mb-2">Datos</label>
                        <input
                            type="text"
                            name="data"
                            id="data"
                            placeholder="Ej: 10, 20, 30, 40, 50"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all text-sm"
                            oninput="validarInput(event)"
                        >
                        <p class="mt-1.5 text-xs text-gray-400">Separa los valores con comas.</p>
                    </div>

                    <button
                        type="submit"
                        class="w-full sm:w-auto px-8 py-3 bg-red-600 text-white font-semibold rounded-xl hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500/30 transition-all shadow-sm shadow-red-500/25 active:scale-[0.98]"
                    >
                        Calcular
                    </button>
                </form>
            </div>

            <div class="border-t border-gray-100 bg-red-50 p-6 sm:p-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Tamaño de muestra</label>
                        <input
                            type="text"
                            name="n"
                            id="n"
                            value="{{ $n }}"
                            readonly
                            class="w-full px-4 py-3 rounded-xl border-0 bg-white/80 text-gray-900 font-outfit text-lg font-bold shadow-sm focus:outline-none"
                        >
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Media</label>
                        <input
                            type="text"
                            name="median"
                            id="median"
                            value="{{ $median }}"
                            readonly
                            class="w-full px-4 py-3 rounded-xl border-0 bg-white/80 text-gray-900 font-outfit text-lg font-bold shadow-sm focus:outline-none"
                        >
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Varianza</label>
                        <input
                            type="text"
                            name="variance"
                            id="variance"
                            value="{{ $variance }}"
                            readonly
                            class="w-full px-4 py-3 rounded-xl border-0 bg-white/80 text-gray-900 font-outfit text-lg font-bold shadow-sm focus:outline-none"
                        >
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Desviacion estandar</label>
                        <input
                            type="text"
                            name="desviation"
                            id="desviation"
                            value="{{ $desviation }}"
                            readonly
                            class="w-full px-4 py-3 rounded-xl border-0 bg-white/80 text-gray-900 font-outfit text-lg font-bold shadow-sm focus:outline-none"
                        >
                    </div>
                </div>

                <div class="mt-4">
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Resultado</label>
                    <input
                        type="text"
                        name="curtosis"
                        id="curtosis"
                        value="{{ $curtosis }}"
                        readonly
                        class="w-full px-4 py-3.5 rounded-xl border-0 bg-white/80 text-gray-900 font-outfit text-xl font-bold shadow-sm focus:outline-none"
                    >
                </div>
            </div>

            <div class="border-t border-gray-100 p-6 sm:p-8">
                <h4 class="font-outfit text-lg font-semibold text-gray-900 mb-4">Interpretacion del resultado</h4>
                <div class="space-y-3 text-sm text-gray-700 leading-relaxed">
                    <p>
                        <span class="font-semibold text-gray-900">Curtosis ≈ 3</span> — Distribucion mesocurtica (normal). La forma es similar a la campana de Gauss.
                    </p>
                    <p>
                        <span class="font-semibold text-gray-900">Curtosis > 3</span> — Distribucion leptocurtica. Los datos son mas concentrados en la media, con colas mas pesadas.
                    </p>
                    <p>
                        <span class="font-semibold text-gray-900">Curtosis < 3</span> — Distribucion platicurtica. Los datos son mas dispersos, con colas mas ligeras.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
