@extends('layouts.app')
@section('Content')
    <div class="max-w-2xl mx-auto">
        <div class="mb-8">
            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-red-50 text-red-600 text-xs font-semibold tracking-wide uppercase mb-4">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                Medidas de Posicion
            </div>
            <h2 class="font-outfit text-3xl sm:text-4xl font-bold text-gray-900">Calculadora de Percentiles</h2>
            <p class="text-gray-500 mt-2 text-sm">Divide tu conjunto de datos en cien partes iguales.</p>
        </div>

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="p-6 sm:p-8">
                <form action="{{ route('Percentile') }}" method="post" class="space-y-6">
                    @csrf

                    <div>
                        <label for="data" class="block text-sm font-semibold text-gray-700 mb-2">Datos de entrada</label>
                        <textarea
                            name="data"
                            id="data"
                            rows="5"
                            placeholder="Ej: 12, 15, 18, 22, 30, 35, 40, 45, 50, 55"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all text-sm resize-none"
                            oninput="validarInput(event)"
                        ></textarea>
                        <p class="mt-1.5 text-xs text-gray-400">Separa los valores con comas</p>
                        <input type="hidden" name="operation" value="3">
                    </div>

                    <div>
                        <label for="number" class="block text-sm font-semibold text-gray-700 mb-2">Numero de percentil</label>
                        <select
                            name="number"
                            id="number"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-900 focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all text-sm appearance-none cursor-pointer"
                        >
                            @for ($i = 1; $i < 100; $i++)
                                <option value="{{ $i }}">Percentil {{ $i }} (P{{ $i }})</option>
                            @endfor
                        </select>
                    </div>

                    <button
                        type="submit"
                        class="w-full sm:w-auto px-8 py-3 bg-red-600 text-white font-semibold rounded-xl hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500/30 transition-all shadow-sm shadow-red-500/25 active:scale-[0.98]"
                    >
                        Calcular Percentil
                    </button>
                </form>
            </div>

            @if($data !== null && $data !== '')
            <div class="border-t border-gray-100 bg-red-50 p-6 sm:p-8 space-y-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Cadena acomodada</label>
                    <textarea
                        readonly
                        rows="5"
                        class="w-full px-4 py-3 rounded-xl border-0 bg-white/80 text-gray-900 font-mono text-sm shadow-sm focus:outline-none resize-none"
                    >{{ $data }}</textarea>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Posicion</label>
                    <input
                        type="text"
                        value="{{ $position }}"
                        readonly
                        class="w-full px-4 py-3.5 rounded-xl border-0 bg-white/80 text-gray-900 font-outfit text-lg font-bold shadow-sm focus:outline-none"
                    >
                </div>
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

        <div class="mt-4 px-1">
            <div class="flex items-start gap-3 p-4 rounded-xl bg-amber-50 border border-amber-100">
                <svg class="w-5 h-5 text-amber-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <p class="text-sm text-amber-700">Para obtener un mejor resultado es recomendable ingresar al menos 100 datos.</p>
            </div>
        </div>
    </div>
@endsection
