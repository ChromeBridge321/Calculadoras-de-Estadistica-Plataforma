@extends('layouts.app')

@section('Content')
    <div class="max-w-4xl mx-auto">
        <div class="mb-8">
            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-red-50 text-red-600 text-xs font-semibold tracking-wide uppercase mb-4">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                Diagrama de Pareto
            </div>
            <h2 class="font-outfit text-3xl sm:text-4xl font-bold text-gray-900">Diagrama de Pareto</h2>
            <p class="text-gray-500 mt-2 text-sm">Visualiza la relacion causa-efecto con barras y linea de acumulado.</p>
        </div>

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="p-6 sm:p-8">
                <form action="{{ route('Pareto') }}" method="POST" class="space-y-6">
                    @csrf

                    <div class="flex flex-col sm:flex-row gap-6">
                        <div class="flex-1">
                            <label for="labels" class="block text-sm font-semibold text-gray-700 mb-2">Situacion</label>
                            <input
                                type="text"
                                name="labels"
                                id="inputField"
                                placeholder="Problema A, Problema B, Problema C"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all text-sm"
                                oninput="validateInput()"
                            >
                        </div>
                        <div class="flex-1">
                            <label for="data" class="block text-sm font-semibold text-gray-700 mb-2">Valores</label>
                            <input
                                type="text"
                                name="data"
                                id="data"
                                placeholder="Valor A, Valor B, Valor C"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all text-sm"
                                oninput="validarInput(event)"
                            >
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row sm:items-center gap-4">
                        <button
                            type="submit"
                            class="w-full sm:w-auto px-8 py-3 bg-red-600 text-white font-semibold rounded-xl hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500/30 transition-all shadow-sm shadow-red-500/25 active:scale-[0.98]"
                        >
                            Calcular
                        </button>
                        <p class="text-xs text-gray-400">Separa los valores con comas. Introduce los datos de mayor a menor valor.</p>
                    </div>
                </form>
            </div>

            <div class="border-t border-gray-100 p-6 sm:p-8 bg-gray-50">
                <div class="w-full" style="height: 320px;">
                    <canvas id="paretoChart"></canvas>
                </div>
            </div>
        </div>

        <div class="mt-4 px-1">
            <div class="flex items-start gap-3 p-4 rounded-xl bg-amber-50 border border-amber-100">
                <svg class="w-5 h-5 text-amber-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <p class="text-sm text-amber-700">Ingresa primero las situaciones separadas por comas, luego los valores correspondientes en el mismo orden, de mayor a menor.</p>
            </div>
        </div>
    </div>

    <script>
        var labels = @json($labels);
        var data = @json($data);
        var cumulative = @json($cumulative);

        var ctx = document.getElementById('paretoChart').getContext('2d');
        var paretoChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Numero de casos',
                    data: data,
                    backgroundColor: 'rgba(239, 68, 68, 0.2)',
                    borderColor: '#dc2626',
                    borderWidth: 1,
                    borderRadius: 6,
                    yAxisID: 'y',
                }, {
                    label: 'Acumulado',
                    data: cumulative,
                    type: 'line',
                    fill: false,
                    borderColor: '#2563eb',
                    backgroundColor: 'transparent',
                    pointBackgroundColor: '#2563eb',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    borderWidth: 2,
                    tension: 0.3,
                    yAxisID: 'y1',
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            usePointStyle: true,
                            padding: 20,
                            font: {
                                family: "'DM Sans', sans-serif",
                                size: 12
                            }
                        }
                    },
                    tooltip: {
                        backgroundColor: '#1f2937',
                        titleFont: { family: "'DM Sans', sans-serif", size: 13 },
                        bodyFont: { family: "'DM Sans', sans-serif", size: 12 },
                        padding: 12,
                        cornerRadius: 8,
                    }
                },
                scales: {
                    x: {
                        grid: { display: false },
                        ticks: {
                            font: { family: "'DM Sans', sans-serif", size: 11 },
                            color: '#6b7280'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        position: 'left',
                        grid: { color: '#f3f4f6' },
                        ticks: {
                            callback: function(value) { return value + ' unid.'; },
                            font: { family: "'DM Sans', sans-serif", size: 11 },
                            color: '#6b7280'
                        }
                    },
                    y1: {
                        beginAtZero: true,
                        position: 'right',
                        grid: { drawOnChartArea: false },
                        ticks: {
                            callback: function(value) { return value + '%'; },
                            font: { family: "'DM Sans', sans-serif", size: 11 },
                            color: '#6b7280'
                        }
                    }
                }
            }
        });
    </script>
@endsection
