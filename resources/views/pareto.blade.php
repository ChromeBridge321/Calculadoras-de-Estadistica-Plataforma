<!DOCTYPE html>
<html>
<head>
    <title>Gráfica de Pareto</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <canvas id="paretoChart" width="400" height="200"></canvas>
    <script>
        var labels = @json($labels);
        var data = @json($data);
        var cumulative = @json($cumulative);

        var ctx = document.getElementById('paretoChart').getContext('2d');
        var paretoChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,// la variable de donde toma el nombre de cada caso
                datasets: [{
                    label: 'Numero de casos',
                    data: data,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                    yAxisID: 'y',
                }, {
                    label: 'Acumulado',//aqui se cambia la descripcion que tiene la barra al posicionarse sobre ella
                    data: cumulative,//aqui va la variable de donde va a tomar los datos
                    type: 'line',
                    fill: false,
                    borderColor: 'rgba(153, 102, 255, 1)',//el color de la barra
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    yAxisID: 'y1',//el nombre del eje
                }]
            },
            options: {
                scales: {
                    y: {//a que eje pertenece
                        beginAtZero: true, // esto sera si inicia desde cero o no
                        position: 'left',//posicion dode ira el eje
                        ticks: {
                            callback: function(value) {
                                return value + ' unidades'; // Ajusta esto según tus unidades // toma los valores de la variable 
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
</body>
</html>