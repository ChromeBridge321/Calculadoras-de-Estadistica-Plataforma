@extends('layouts.app')

@section('Content')

<div class="max-w-6xl mx-auto">

    {{-- Operacion 2: Datos Agrupados --}}
    @if ($operacion == 2)

    <div class="space-y-6">

        <form action="{{ route('showFrequencyDistribution') }}" method="post">
            @csrf

            <div class="bg-white rounded-2xl border border-gray-200 p-5 sm:p-6">
                <p class="text-sm text-gray-500 mb-4">Separe los datos por una coma ","</p>

                <div class="flex flex-col sm:flex-row gap-3">
                    <div class="flex-1">
                        <label for="datos" class="block text-sm font-medium text-gray-700 mb-1.5">Datos</label>
                        <input type="text" name="datos" id="datos"
                            class="w-full px-4 py-2.5 rounded-xl border border-gray-300 bg-white text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition"
                            placeholder="Ej: 12, 15, 18, 22, 25"
                            oninput="validarInput(event)">
                    </div>
                    <div class="sm:w-36 flex items-end">
                        <button type="submit"
                            class="w-full px-6 py-2.5 bg-red-600 hover:bg-red-700 active:bg-red-800 text-white font-semibold rounded-xl transition-colors cursor-pointer">
                            Calcular
                        </button>
                    </div>
                </div>

                {{-- Resultados --}}
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3 mt-6">
                    <div class="bg-gray-100 rounded-xl p-3">
                        <span class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">Media</span>
                        <span class="block text-lg font-semibold text-gray-900 truncate" title="{{ $media }}">{{ $media }}</span>
                    </div>
                    <div class="bg-gray-100 rounded-xl p-3">
                        <span class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">Mediana</span>
                        <span class="block text-lg font-semibold text-gray-900 truncate" title="{{ $mediana }}">{{ $mediana }}</span>
                    </div>
                    <div class="bg-gray-100 rounded-xl p-3">
                        <span class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">Moda</span>
                        <span class="block text-lg font-semibold text-gray-900 truncate" title="{{ $moda }}">{{ $moda }}</span>
                    </div>
                    <div class="bg-gray-100 rounded-xl p-3">
                        <span class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">Varianza</span>
                        <span class="block text-lg font-semibold text-gray-900 truncate" title="{{ $varianza }}">{{ $varianza }}</span>
                    </div>
                    <div class="bg-gray-100 rounded-xl p-3">
                        <span class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">Desv. Media</span>
                        <span class="block text-lg font-semibold text-gray-900 truncate" title="{{ $desviacionM }}">{{ $desviacionM }}</span>
                    </div>
                    <div class="bg-gray-100 rounded-xl p-3">
                        <span class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">Desv. Estándar</span>
                        <span class="block text-lg font-semibold text-gray-900 truncate" title="{{ $estandarD }}">{{ $estandarD }}</span>
                    </div>
                </div>
            </div>
        </form>

        {{-- Tabla --}}
        <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden">
            <div class="px-5 sm:px-6 py-4 border-b border-gray-100">
                <h2 class="text-lg font-semibold text-gray-900 font-outfit">Tabla de distribución de frecuencias agrupados</h2>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200">
                            <th class="px-4 py-3 text-left font-semibold text-gray-600 whitespace-nowrap">Intervalo</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600 whitespace-nowrap">Marca de Clase</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600 whitespace-nowrap">Frec. Absoluta</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600 whitespace-nowrap">Frec. Acumulada</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600 whitespace-nowrap">Frec. Relativa</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600 whitespace-nowrap">Frec. Rel. Acum.</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($frequencyDistribution as $distribution)
                            @php
                                try {
                            @endphp
                            <tr class="hover:bg-gray-100 transition-colors">
                                <td class="px-4 py-3 text-gray-900">{{ $distribution['interval'] }}</td>
                                <td class="px-4 py-3 text-gray-700">{{ $distribution['classMark'] }}</td>
                                <td class="px-4 py-3 text-gray-700">{{ $distribution['absoluteFrequency'] }}</td>
                                <td class="px-4 py-3 text-gray-700">{{ $distribution['cumulativeFrequency'] }}</td>
                                <td class="px-4 py-3 text-gray-700">{{ number_format($distribution['relativeFrequency'], 3) }}</td>
                                <td class="px-4 py-3 text-gray-700">{{ number_format($distribution['cumulativeRelativeFrequency'], 3) }}</td>
                            </tr>
                            @php
                                } catch (\Throwable $th) {}
                            @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    @endif


    {{-- Operacion 1: Datos No Agrupados --}}
    @if ($operacion == 1)
    @php
        try {
    @endphp

    <div class="space-y-6">

        <form action="{{ route('tabla1') }}" method="post">
            @csrf

            <div class="bg-white rounded-2xl border border-gray-200 p-5 sm:p-6">
                <p class="text-sm text-gray-500 mb-4">Separe los datos por una coma ","</p>

                <div class="flex flex-col sm:flex-row gap-3">
                    <div class="flex-1">
                        <label for="datos" class="block text-sm font-medium text-gray-700 mb-1.5">Datos</label>
                        <input type="text" name="datos" id="datos"
                            class="w-full px-4 py-2.5 rounded-xl border border-gray-300 bg-white text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition"
                            placeholder="Ej: 12, 15, 18, 22, 25"
                            oninput="validarInput(event)">
                    </div>
                    <div class="sm:w-36 flex items-end">
                        <button type="submit"
                            class="w-full px-6 py-2.5 bg-red-600 hover:bg-red-700 active:bg-red-800 text-white font-semibold rounded-xl transition-colors cursor-pointer">
                            Calcular
                        </button>
                    </div>
                </div>

                {{-- Resultados --}}
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3 mt-6">
                    <div class="bg-gray-100 rounded-xl p-3">
                        <span class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">Media</span>
                        <span class="block text-lg font-semibold text-gray-900 truncate" title="{{ $media }}">{{ $media }}</span>
                    </div>
                    <div class="bg-gray-100 rounded-xl p-3">
                        <span class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">Mediana</span>
                        <span class="block text-lg font-semibold text-gray-900 truncate" title="{{ $mediana }}">{{ $mediana }}</span>
                    </div>
                    <div class="bg-gray-100 rounded-xl p-3">
                        <span class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">Moda</span>
                        <span class="block text-lg font-semibold text-gray-900 truncate" title="{{ $moda }}">{{ $moda }}</span>
                    </div>
                    <div class="bg-gray-100 rounded-xl p-3">
                        <span class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">Varianza</span>
                        <span class="block text-lg font-semibold text-gray-900 truncate" title="{{ $varianza }}">{{ $varianza }}</span>
                    </div>
                    <div class="bg-gray-100 rounded-xl p-3">
                        <span class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">Desv. Media</span>
                        <span class="block text-lg font-semibold text-gray-900 truncate" title="{{ $desviacionM }}">{{ $desviacionM }}</span>
                    </div>
                    <div class="bg-gray-100 rounded-xl p-3">
                        <span class="block text-xs font-medium text-gray-500 uppercase tracking-wide mb-1">Desv. Estándar</span>
                        <span class="block text-lg font-semibold text-gray-900 truncate" title="{{ $estandarD }}">{{ $estandarD }}</span>
                    </div>
                </div>
            </div>
        </form>

        {{-- Tabla --}}
        <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden">
            <div class="px-5 sm:px-6 py-4 border-b border-gray-100">
                <h2 class="text-lg font-semibold text-gray-900 font-outfit">Tabla de distribución de frecuencias de datos no agrupados</h2>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-red-50 border-b border-red-100">
                            <th class="px-4 py-3 text-left font-semibold text-red-700 whitespace-nowrap">Datos</th>
                            <th class="px-4 py-3 text-left font-semibold text-red-700 whitespace-nowrap">f</th>
                            <th class="px-4 py-3 text-left font-semibold text-red-700 whitespace-nowrap">F</th>
                            <th class="px-4 py-3 text-left font-semibold text-red-700 whitespace-nowrap">fi</th>
                            <th class="px-4 py-3 text-left font-semibold text-red-700 whitespace-nowrap">Fi</th>
                            <th class="px-4 py-3 text-left font-semibold text-red-700 whitespace-nowrap">fr</th>
                            <th class="px-4 py-3 text-left font-semibold text-red-700 whitespace-nowrap">Fr</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @php
                            $F = 0;
                            $Fi = 0;
                            $fi = 0;
                            $fr = 0;
                            $Fr = 0;
                        @endphp
                        @foreach ($frequency as $key => $item)
                            @php
                                $F = $F + $item;
                                $fi = $item / $n;
                                $Fi = $F / $n;
                                $fr = $fi * 100;
                                $Fr = $Fr + $fr;
                                $Fr = round(floatval($Fr), 3);
                                $fr = round(floatval($fr), 3);
                                $fi = round(floatval($fi), 3);
                                $Fi = round(floatval($Fi), 3);
                            @endphp
                            <tr class="hover:bg-gray-100 transition-colors">
                                <td class="px-4 py-3 font-medium text-gray-900">{{ $key }}</td>
                                <td class="px-4 py-3 text-gray-700">{{ $item }}</td>
                                <td class="px-4 py-3 text-gray-700">{{ $F }}</td>
                                <td class="px-4 py-3 text-gray-700">{{ $fi }}</td>
                                <td class="px-4 py-3 text-gray-700">{{ $Fi }}</td>
                                <td class="px-4 py-3 text-gray-700">{{ $fr }}%</td>
                                <td class="px-4 py-3 text-gray-700">{{ $Fr }}%</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    @php
        } catch (\Throwable $th) {}
    @endphp
    @endif

</div>

@endsection
