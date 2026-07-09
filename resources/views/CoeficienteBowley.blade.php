@extends('layouts.app')

@section('Content')
    <div class="max-w-2xl mx-auto">
        <div class="mb-8">
            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-red-50 text-red-600 text-xs font-semibold tracking-wide uppercase mb-4">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                Medidas de Asimetria
            </div>
            <h2 class="font-outfit text-3xl sm:text-4xl font-bold text-gray-900">Coeficiente de Bowley</h2>
            <p class="text-gray-500 mt-2 text-sm">Mide la asimetria de una distribucion a partir de los cuartiles.</p>
        </div>

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="p-6 sm:p-8">
                <form action="{{ route('Bowley') }}" method="post" class="space-y-6">
                    @csrf

                    <div>
                        <label for="data" class="block text-sm font-semibold text-gray-700 mb-2">Datos de entrada</label>
                        <input
                            type="text"
                            name="data"
                            id="data"
                            placeholder="Ej: 12, 15, 18, 22, 30"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all text-sm"
                            oninput="validarInput(event)"
                        >
                        <p class="mt-1.5 text-xs text-gray-400">Separa los valores con comas</p>
                    </div>

                    <button
                        type="submit"
                        class="w-full sm:w-auto px-8 py-3 bg-red-600 text-white font-semibold rounded-xl hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500/30 transition-all shadow-sm shadow-red-500/25 active:scale-[0.98]"
                    >
                        Calcular Bowley
                    </button>
                </form>
            </div>

            @if($result !== null && $result !== '')
            <div class="border-t border-gray-100 bg-red-50 p-6 sm:p-8">
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Resultado</label>
                    <input
                        type="text"
                        value="{{ $result }}"
                        readonly
                        class="w-full px-4 py-3.5 rounded-xl border-0 bg-white/80 text-gray-900 font-outfit text-xl font-bold shadow-sm focus:outline-none"
                    >
                </div>
            </div>
            @endif
        </div>

        <div class="mt-6 bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="p-6 sm:p-8">
                <h3 class="font-outfit text-lg font-bold text-gray-900 mb-4">Interpretacion del resultado</h3>
                <div class="space-y-4">
                    <div class="flex items-start gap-3 p-4 rounded-xl bg-blue-50 border border-blue-100">
                        <div class="shrink-0 w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center">
                            <span class="text-blue-600 font-bold text-sm">&lt; 0</span>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-blue-900">Asimetria negativa</p>
                            <p class="text-sm text-blue-700 mt-0.5">La distancia de la mediana al primer cuartil es mayor que al tercero.</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3 p-4 rounded-xl bg-green-50 border border-green-100">
                        <div class="shrink-0 w-8 h-8 rounded-lg bg-green-100 flex items-center justify-center">
                            <span class="text-green-600 font-bold text-sm">= 0</span>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-green-900">Distribucion simetrica</p>
                            <p class="text-sm text-green-700 mt-0.5">El primer y tercer cuartil estan a la misma distancia de la mediana.</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-3 p-4 rounded-xl bg-orange-50 border border-orange-100">
                        <div class="shrink-0 w-8 h-8 rounded-lg bg-orange-100 flex items-center justify-center">
                            <span class="text-orange-600 font-bold text-sm">&gt; 0</span>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-orange-900">Asimetria positiva</p>
                            <p class="text-sm text-orange-700 mt-0.5">La distancia de la mediana al tercer cuartil es mayor que al primero.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
