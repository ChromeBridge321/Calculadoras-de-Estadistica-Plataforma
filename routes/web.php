<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('index');
});


Route::get('/list', function () {
    return view('layouts.app');
});

Route::get('/medididas-de-tendencia-central/media', function () {
    $promedio = 0;
    $mediana = 0;
    $operacion = 1;
    $moda = 0;
    $muestra = 0;
    return view('MedidasTendencia')->with('mediana', $mediana)->with('promedio', $promedio)
        ->with('operacion', $operacion)->with('moda', $moda)
        ->with('muestra', $muestra);
});
Route::get('/medididas-de-tendencia-central/mediana', function () {
    $mediana = 0;
    $operacion = 2;
    $promedio = 0;
    $moda = 0;
    $muestra = 0;
    return view('MedidasTendencia')->with('mediana', $mediana)->with('promedio', $promedio)
        ->with('operacion', $operacion)->with('moda', $moda)
        ->with('muestra', $muestra);
});

Route::get('/medididas-de-tendencia-central/moda', function () {
    $mediana = 0;
    $operacion = 3;
    $promedio = 0;
    $moda = 0;
    $muestra = 0;
    return view('MedidasTendencia')->with('mediana', $mediana)->with('promedio', $promedio)
        ->with('operacion', $operacion)->with('moda', $moda)
        ->with('muestra', $muestra);
});


Route::get('/medididas-de-tendencia-central/muestra', function () {
    $mediana = 0;
    $operacion = 4;
    $promedio = 0;
    $moda = 0;
    $muestra = 0;
    return view('MedidasTendencia')->with('mediana', $mediana)->with('promedio', $promedio)
        ->with('operacion', $operacion)->with('moda', $moda)
        ->with('muestra', $muestra);
});




// Rutas optimizadas para medidas de tendencia central
Route::post('/medididas-de-tendencia-central/media/resultado', function(Request $request) {
    return app(App\Http\Controllers\StatisticsController::class)->calculateCentralTendency($request, 'media');
})->name('media');

Route::post('/medididas-de-tendencia-central/mediana/resultado', function(Request $request) {
    return app(App\Http\Controllers\StatisticsController::class)->calculateCentralTendency($request, 'mediana');
})->name('mediana');

Route::post('/medididas-de-tendencia-central/moda/resultado', function(Request $request) {
    return app(App\Http\Controllers\StatisticsController::class)->calculateCentralTendency($request, 'moda');
})->name('moda');

Route::post('/medididas-de-tendencia-central/muestra/resultado', [App\Http\Controllers\StatisticsController::class, 'calculateSampleSize'])->name('muestra');

Route::get('/tablas-de-distribucion-de-frecuencias/datos/agrupados', function () {
    $media = 0;
    $mediana = 0;
    $moda = 0;
    $varianza = 0;
    $estandarD = 0;
    $desviacionM = 0;
    $operacion = 1;
    return view('TablasFrecuencias')->with('media', $media)->with('mediana', $mediana)->with('moda', $moda)
        ->with('varianza', $varianza)->with('estandarD', $estandarD)->with('desviacionM', $desviacionM)
        ->with('operacion', $operacion);
});

Route::get('/tablas-de-distribucion-de-frecuencias/datos/no-agrupados', function () {
    $media = 0;
    $mediana = 0;
    $moda = 0;
    $varianza = 0;
    $estandarD = 0;
    $desviacionM = 0;
    $operacion = 2;
    $frequencyDistribution[0][0] = '';
    return view('TablasFrecuencias')->with('media', $media)->with('mediana', $mediana)->with('moda', $moda)
        ->with('varianza', $varianza)->with('estandarD', $estandarD)->with('desviacionM', $desviacionM)
        ->with('operacion', $operacion)->with('frequencyDistribution', $frequencyDistribution);
});



// Rutas optimizadas para tablas de frecuencias
Route::post('/tablas-de-distribucion-de-frecuencias/datos/agrupados/resultado', [App\Http\Controllers\StatisticsController::class, 'generateFrequencyTable'])->name('tabla1');
Route::post('/tablas-de-distribucion-de-frecuencias/datos/no-agrupados/resultado', [App\Http\Controllers\StatisticsController::class, 'generateGroupedFrequencyTable'])->name('showFrequencyDistribution');

Route::get('/Medidas-de-posicion/cuartiles', function () {
    $result = "";
    $data = "";
    $position = "";
    return view('Cuartiles')->with('result', $result)->with('data', $data)->with('position', $position);
});

Route::post('/Medidas-de-posicion/cuartiles/resultado', [App\Http\Controllers\FunctionsController::class, 'calculateQuartile'])->name('Quartile');

Route::get('/Medidas-de-posicion/deciles', function () {
    $result = "";
    $data = "";
    $position = "";
    return view('Deciles')->with('result', $result)->with('data', $data)->with('position', $position);
});

Route::post('/Medidas-de-posicion/deciles/resultado', [App\Http\Controllers\FunctionsController::class, 'calculateDecile'])->name('Decile');

Route::get('/Medidas-de-posicion/percentiles', function () {
    $result = "";
    $data = "";
    $position = "";
    return view('Percentiles')->with('result', $result)->with('data', $data)->with('position', $position);
});

Route::post('/Medidas-de-posicion/percentiles/resultado', [App\Http\Controllers\FunctionsController::class, 'calculatePercentile'])->name('Percentile');

Route::get('/Calculadoras-extras/Coeficiente-de-Fisher', function () {
    $result = ["", "", ""];
    return view('CoeficienteFisher')->with('result', $result);
});

Route::post('/Calculadoras-extras/Coeficiente-de-Fisher/resultado', [App\Http\Controllers\FunctionsController::class, 'calculateFisher'])->name('Fisher');
// Route::get('/pareto', [App\Http\Controllers\FunctionsController::class, 'CalculatePareto'])->name('pareto');

Route::get('/Calculadoras-extras/Coeficiente-de-Bowley', function () {
    $result = "";

    return view('CoeficienteBowley')->with('result', $result);
});

Route::post('/Calculadoras-extras/Coeficiente-de-Bowley/resultado', [App\Http\Controllers\FunctionsController::class, 'calculateBowley'])->name('Bowley');


Route::get('/Calculadoras-extras/Coeficiente-de-curtosis', function () {
    $curtosis = "";
    $n = "";
    $median = "";
    $variance = "";
    $desviation = "";
    return view('CoeficienteCurtosis')->with('curtosis',$curtosis)->with('n',$n)
    ->with('median',$median)
    ->with('variance',$variance)
    ->with('desviation',$desviation);
});

Route::post('/Calculadoras-extras/Coeficiente-de-curtosis/resultado', [App\Http\Controllers\FunctionsController::class, 'calculateCurtosis'])->name('Curtosis');


Route::get('/Calculadoras-extras/Coeficiente-de-Pearson', function () {
    $pearson = "";

    return view('CoeficientePearson')->with('pearson', $pearson);
});

Route::post('/Calculadoras-extras/Coeficiente-de-Pearson/resultado', [App\Http\Controllers\FunctionsController::class, 'calculatePearson'])->name('Pearson');


Route::get('/Calculadoras-extras/Grafica-de-pareto', function () {
    $data = "";
    $labels = "";
    $cumulative = "";
    return view('pareto', compact('labels', 'data', 'cumulative'));
});

Route::post('/Calculadoras-extras/Grafica-de-pareto/resultado', [App\Http\Controllers\FunctionsController::class, 'calculatePareto'])->name('Pareto');
