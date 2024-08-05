<?php

use Illuminate\Support\Facades\Route;

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




Route::post('/medididas-de-tendencia-central/media/resultado', [App\Http\Controllers\FuncionesController::class, 'media'])->name('media');
Route::post('/medididas-de-tendencia-central/mediana/resultado', [App\Http\Controllers\FuncionesController::class, 'mediana'])->name('mediana');
Route::post('/medididas-de-tendencia-central/moda/resultado', [App\Http\Controllers\FuncionesController::class, 'moda'])->name('moda');
Route::post('/medididas-de-tendencia-central/muestra/resultado', [App\Http\Controllers\FuncionesController::class, 'muestra'])->name('muestra');

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



Route::post('/tablas-de-distribucion-de-frecuencias/datos/agrupados/resultado', [App\Http\Controllers\FuncionesController::class, 'tablafrecuencia'])->name('tabla1');
Route::post('/tablas-de-distribucion-de-frecuencias/datos/no-agrupados/resultado', [App\Http\Controllers\FuncionesController::class, 'showFrequencyDistribution'])->name('showFrequencyDistribution');

Route::get('/Medidas-de-posicion/cuartiles', function () {
    $result = "";
    $data = "";
    $position = "";
    return view('Cuartiles')->with('result', $result)->with('data', $data)->with('position', $position);
});

Route::post('/Medidas-de-posicion/cuartiles/resultado', [App\Http\Controllers\FunctionsController::class, 'CalculateQuartile'])->name('Quartile');

Route::get('/Medidas-de-posicion/deciles', function () {
    $result = "";
    $data = "";
    $position = "";
    return view('Deciles')->with('result', $result)->with('data', $data)->with('position', $position);
});

Route::post('/Medidas-de-posicion/deciles/resultado', [App\Http\Controllers\FunctionsController::class, 'CalculateDecile'])->name('Decile');

Route::get('/Medidas-de-posicion/percentiles', function () {
    $result = "";
    $data = "";
    $position = "";
    return view('Percentiles')->with('result', $result)->with('data', $data)->with('position', $position);
});

Route::post('/Medidas-de-posicion/percentiles/resultado', [App\Http\Controllers\FunctionsController::class, 'CalculatePercentile'])->name('Percentile');

Route::get('/Calculadoras-extras/Coeficiente-de-Fisher', function () {
    $result = ["", "", ""];
    return view('CoeficienteFisher')->with('result', $result);
});

Route::post('/Calculadoras-extras/Coeficiente-de-Fisher/resultado', [App\Http\Controllers\FunctionsController::class, 'CalculateFisher'])->name('Fisher');
// Route::get('/pareto', [App\Http\Controllers\FunctionsController::class, 'CalculatePareto'])->name('pareto');

Route::get('/Calculadoras-extras/Coeficiente-de-Bowley', function () {
    $result = "";

    return view('CoeficienteBowley')->with('result', $result);
});

Route::post('/Calculadoras-extras/Coeficiente-de-Bowley/resultado', [App\Http\Controllers\FunctionsController::class, 'CalculateBowley'])->name('Bowley');


Route::get('/Calculadoras-extras/Coeficiente-de-curtosis', function () {
    $result = "";

    return view('CoeficienteCurtosis')->with('result', $result);
});

Route::post('/Calculadoras-extras/Coeficiente-de-curtosis/resultado', [App\Http\Controllers\FunctionsController::class, ''])->name('');


Route::get('/Calculadoras-extras/Coeficiente-de-Pearson', function () {
    $pearson = "";

    return view('CoeficientePearson')->with('pearson', $pearson);
});

Route::post('/Calculadoras-extras/Coeficiente-de-Pearson/resultado', [App\Http\Controllers\FunctionsController::class, 'CalculatePearson'])->name('Pearson');

Route::get('/Calculadoras-extras/Grafica-de-pareto', [App\Http\Controllers\FunctionsController::class, 'CalculatePareto'])->name('Pareto');
