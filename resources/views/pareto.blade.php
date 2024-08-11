@extends('layouts.app')

@section('Content')
    <div class=" container pt-4 ps-5">
        <div class=" row d-flex justify-content-center">

            <form action="{{ route('Pareto') }}" method="POST" class=" col-12">
                @csrf
                <div class=" row">
                    <div class="col-12">
                        <h2>Calcular coeficiente de Pearson</h2>
                    </div>
                    <div class="col-9">
                        <p>Por favor, introduzca ambos datos separados por una coma ",".</p>
                    </div>
                    


                    <div class=" col-9">
                        <p class="text-danger">
                            Antes de comenzar, introduzca primero el nombre de la <b>"Situación"</b> o las Situaciones a
                            graficar. Una vez hecho, asígnele el valor a cada situación en <b>"Valores"</b> según el orden
                            en que agregó cada Situación. <b>Por favor, introduzca los datos de mayor a menor valor.</b>
                        </p>

                    </div>

                    <div class=" col-9">
                        <label for="" class=" form-label">Situacion</label>
                        <input type="text" name="labels" id="inputField" class=" form-control" oninput="validateInput()"
                            placeholder="Problema A,Problema B,Problema C">
                    </div>
                    <div class=" col-3 d-flex align-items-end">
                        <button class=" btn btn-danger w-75">Calcular</button>
                    </div>
                    <div class=" col-9 pt-2">
                        <label for="" class=" form-label">Valores</label>
                        <input type="text" name="data" id="" class=" form-control"
                            oninput="validarInput(event)" placeholder="Valor A,Valor B,Valor C">
                    </div>

                </div>
            </form>

            <div class=" col6">
                <canvas id="paretoChart" width="300" height="100"></canvas>
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
                labels: labels, // la variable de donde toma el nombre de cada caso
                datasets: [{
                    label: 'Numero de casos',
                    data: data,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                    yAxisID: 'y',
                }, {
                    label: 'Acumulado', //aqui se cambia la descripcion que tiene la barra al posicionarse sobre ella
                    data: cumulative, //aqui va la variable de donde va a tomar los datos
                    type: 'line',
                    fill: false,
                    borderColor: 'rgba(153, 102, 255, 1)', //el color de la barra
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    yAxisID: 'y1', //el nombre del eje
                }]
            },
            options: {
                scales: {
                    y: { //a que eje pertenece
                        beginAtZero: true, // esto sera si inicia desde cero o no
                        position: 'left', //posicion dode ira el eje
                        ticks: {
                            callback: function(value) {
                                return value +
                                    ' unidades'; // Ajusta esto según tus unidades // toma los valores de la variable 
                                // del eje al que pertenece y le agrega el un nombre a cada dato dentro de la variable
                            }
                        }
                    },
                    y1: {
                        beginAtZero: true,
                        position: 'right',
                        ticks: {
                            callback: function(value) {
                                return value + '%'; // Porcentaje acumulado
                            }
                        },
                        grid: {
                            drawOnChartArea: false,
                        }
                    }
                }
            }
        });
    </script>
@endsection
