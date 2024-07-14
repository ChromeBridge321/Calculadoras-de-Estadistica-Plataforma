<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use function PHPUnit\Framework\returnValue;

class FuncionesController extends Controller
{

    public function media(Request $request)
    {
        // Obtén la cadena de números del request
        $numbersString = $request->input('datos');
        // Convertir la cadena en un array de números
        $numbersArray = explode(',', $numbersString);
        // Convertir cada elemento a un número (entero o flotante)
        $numbersArray = array_map('floatval', $numbersArray);
        // Calcular la suma de los números
        $sum = array_sum($numbersArray);
        // Calcular la cantidad de números
        $count = count($numbersArray);
        // Calcular el promedio
        $promedio = $sum / $count;
        $operacion = 1;
        $mediana = 1;
        $moda = 0;
        return view('MedidasTendencia')
            ->with('promedio', $promedio)
            ->with('mediana', $mediana)
            ->with('operacion', $operacion)
            ->with('moda', $moda);
    }

    public function mediana(Request $request)
    {
        // Obtén la cadena de números del request
        $numbersString = $request->input('datos');

        // Convertir la cadena en un array de números
        $numbersArray = explode(',', $numbersString);

        // Ordenar los números
        sort($numbersArray);

        // Convertir cada elemento a un número (entero o flotante)
        $numbersArray = array_map('floatval', $numbersArray);

        // Obtener el número de elementos
        $count = count($numbersArray);

        // Si el número de elementos es par
        if ($count % 2 == 0) {
            $middle1 = $numbersArray[$count / 2 - 1];
            $middle2 = $numbersArray[$count / 2];
            $mediana = ($middle1 + $middle2) / 2;
        } else {
            // Si el número de elementos es impar
            $mediana = $numbersArray[floor($count / 2)];
        }
        $operacion = 2;
        $promedio = 0;
        $moda = 0;
        return view('MedidasTendencia')
            ->with('mediana', $mediana)
            ->with('operacion', $operacion)
            ->with('promedio', $promedio)
            ->with('moda', $moda);
    }

    public function moda(Request $request)
    {
        // Obtén la cadena de números del request
        $numbers = $request->input('datos');
        // Convertir la cadena en un array de números
        $numbersArray = explode(',', $numbers);
        // Calcular la frecuencia de cada número
        $valuesFrequency = array_count_values($numbersArray);

        // Obtener la frecuencia máxima
        $maxFrequency = max($valuesFrequency);

        // Obtener todos los valores que tienen la frecuencia máxima
        $moda = array_keys($valuesFrequency, $maxFrequency);
        $moda = implode(',', $moda);
        $operacion = 3;
        $promedio = 0;
        $mediana = 0;
        return view('MedidasTendencia')
            ->with('mediana', $mediana)
            ->with('operacion', $operacion)
            ->with('promedio', $promedio)
            ->with('moda', $moda);
    }


    public function muestra(Request $request)
    {

        $poblacion = $request->poblacion;
        $poblacion_1 = $request->poblacion_1;
        $confianza_1 = (($request->confianza_1) * ($request->confianza_1));
        $probabilidadP_1 = $request->probabilidadP_1;
        $probabilidadN_1 = $request->probabilidadN_1;
        $confianza_2 = (($request->confianza_2) * ($request->confianza_2));
        $probabilidadP_2 = $request->probabilidadP_2;
        $probabilidadN_2 = $request->probabilidadN_2;
        $margenR = (($request->margenR) * ($request->margenR));


        $muestra = (($poblacion) * ($confianza_1) * ($probabilidadP_1) * ($probabilidadN_1)) /
            (($margenR * $poblacion_1) + (($confianza_2) * ($probabilidadN_2) * ($probabilidadP_2)));

        $moda = 0;
        $operacion = 4;
        $promedio = 0;
        $mediana = 0;
        return view('MedidasTendencia')
            ->with('mediana', $mediana)
            ->with('operacion', $operacion)
            ->with('promedio', $promedio)
            ->with('moda', $moda)
            ->with('muestra', $muestra);
    }

    public function tablafrecuencia(Request $request)
    {
        $datos = $request->datos;
        $media = round(floatval($this->Tmedia($datos)), 3);
        $mediana = $this->Tmediana($datos);
        $moda = $this->Tmoda($datos);
        


         // Obtén la cadena de números del request
         $numbersString = $request->datos;

         // Convertir la cadena en un array de números
         $numbersArray = explode(',', $numbersString);
 
         // Calcular la frecuencia de cada número
         $frequency = array_count_values($numbersArray);
         //cantidad de numeros
         $n = count($numbersArray);
         $varianza = round(floatval($this ->varianza($numbersArray)), 3);
         $estandarD = round(floatval(sqrt($varianza)), 3);
         $desviacionM = round(floatval($this->desviacionM($numbersArray)), 3);
         $operacion = 1;
 
         // Ordenar los números por su valor
         ksort($frequency);
         return view('TablasFrecuencias')->with('media',$media)->with('mediana',$mediana)->with('moda',$moda)
         ->with('frequency',$frequency)->with('n',$n)->with('varianza',$varianza)->with('estandarD',$estandarD)
         ->with('desviacionM',$desviacionM)->with('operacion',$operacion);
    }

    private function Tmedia($datos)
    {

        // Convertir la cadena en un array de números
        $numbersArray = explode(',', $datos);
        // Convertir cada elemento a un número (entero o flotante)
        $numbersArray = array_map('floatval', $numbersArray);
        // Calcular la suma de los números
        $sum = array_sum($numbersArray);
        // Calcular la cantidad de números
        $count = count($numbersArray);
        // Calcular el promedio
        $promedio = $sum / $count;
        return $promedio;
    }


    private function Tmediana($datos)
    {
        // Convertir la cadena en un array de números
        $numbersArray = explode(',', $datos);
        // Ordenar los números
        sort($numbersArray);
        // Convertir cada elemento a un número (entero o flotante)
        $numbersArray = array_map('floatval', $numbersArray);

        // Obtener el número de elementos
        $count = count($numbersArray);
        // Si el número de elementos es par
        if ($count % 2 == 0) {
            $middle1 = $numbersArray[$count / 2 - 1];
            $middle2 = $numbersArray[$count / 2];
            $mediana = ($middle1 + $middle2) / 2;
        } else {
            // Si el número de elementos es impar
            $mediana = $numbersArray[floor($count / 2)];
        }

        return $mediana;
    }


    private function Tmoda($datos){
        // Convertir la cadena en un array de números
        $numbersArray = explode(',', $datos);
        // Calcular la frecuencia de cada número
        $valuesFrequency = array_count_values($numbersArray);

        // Obtener la frecuencia máxima
        $maxFrequency = max($valuesFrequency);

        // Obtener todos los valores que tienen la frecuencia máxima
        $moda = array_keys($valuesFrequency, $maxFrequency);
        $moda = implode(',', $moda);
        return $moda;
    }


    private function varianza($numbersArray)
    {
        $n = count($numbersArray);
        if ($n === 0) {
            return 0; // Evitar división por cero
        }

        $mean = array_sum($numbersArray) / $n;
        $sumOfSquares = 0;

        foreach ($numbersArray as $number) {
            $sumOfSquares += pow(($number - $mean), 2);
        }

        $variance = $sumOfSquares / $n;

        return $variance;
    }


    function desviacionM($numbersArray)
{
    $n = count($numbersArray);
    if ($n === 0) {
        return 0; // Evitar división por cero
    }

    // Calcular la media (promedio)
    $mean = array_sum($numbersArray) / $n;

    // Calcular la suma de las diferencias absolutas
    $sumOfAbsoluteDifferences = 0;
    foreach ($numbersArray as $number) {
        $sumOfAbsoluteDifferences += abs($number - $mean);
    }

    // Calcular la desviación media como la suma de las diferencias absolutas dividida por n
    $meanAbsoluteDeviation = $sumOfAbsoluteDifferences / $n;

    return $meanAbsoluteDeviation;
}

public function showFrequencyDistribution(Request $request)
{
    // Datos estáticos
    $datos = $request->datos;
    $data = explode(',', $datos);

    // Llamamos a la función para calcular la distribución de frecuencias
    $frequencyDistribution = $this->calculateFrequencyDistribution($data);
    $media = $this->calculateMean($frequencyDistribution);
    $mediana = $this->media2($datos);
    $moda = $this->moda2($datos);
    $varianza = $this->calculateVariance($frequencyDistribution, $media);
    $desviacionM = $this->calculateMeanDeviation($frequencyDistribution, $media);
    $estandarD = $this->calculateStdDeviation($varianza);
    $operacion = 2;
    return view('TablasFrecuencias')->with('media',$media)->with('mediana',$mediana)->with('moda',$moda)
    ->with('varianza',$varianza)->with('estandarD',$estandarD)->with('desviacionM',$desviacionM)
    ->with('operacion',$operacion)->with('frequencyDistribution',$frequencyDistribution);
}

private function calculateFrequencyDistribution($data)
{
    // Ordenamos los datos
    sort($data);

    // Calculamos el número de intervalos usando la raíz cuadrada del número de datos
    $numIntervals = ceil(sqrt(count($data)));

    // Obtenemos el valor mínimo y máximo
    $min = min($data);
    $max = max($data);

    // Calculamos el tamaño del intervalo y redondeamos si es necesario
    $intervalSize = ($max - $min) / $numIntervals;
    $intervalSize = ceil($intervalSize); // Redondeamos hacia arriba

    // Inicializamos los intervalos, frecuencias y otras variables
    $intervals = [];
    $frequencies = array_fill(0, $numIntervals, 0);
    $classMarks = [];
    $absoluteFrequencies = [];
    $cumulativeFrequencies = [];
    $relativeFrequencies = [];
    $cumulativeRelativeFrequencies = [];

    // Definimos los intervalos y calculamos las marcas de clase
    for ($i = 0; $i < $numIntervals; $i++) {
        $lowerBound = $min + ($i * $intervalSize);
        $upperBound = $lowerBound + $intervalSize - 1;
        $intervals[] = "{$lowerBound} - {$upperBound}";
        $classMarks[] = ($lowerBound + $upperBound) / 2; // Calculamos la marca de clase
    }

    // Contamos las frecuencias absolutas
    foreach ($data as $value) {
        for ($i = 0; $i < $numIntervals; $i++) {
            $lowerBound = $min + ($i * $intervalSize);
            $upperBound = $lowerBound + $intervalSize - 1;
            if ($value >= $lowerBound && $value <= $upperBound) {
                $frequencies[$i]++;
                break;
            }
        }
    }

    // Calculamos las frecuencias acumuladas y relativas
    $cumulativeFrequency = 0;
    foreach ($frequencies as $key => $frequency) {
        $cumulativeFrequency += $frequency;
        $absoluteFrequencies[] = $frequency;
        $cumulativeFrequencies[] = $cumulativeFrequency;
        $relativeFrequencies[] = $frequency / count($data);
        $cumulativeRelativeFrequencies[] = $cumulativeFrequency / count($data);
    }

    // Combinamos todos los datos en el formato esperado para la distribución de frecuencias
    $frequencyDistribution = [];
    for ($i = 0; $i < $numIntervals; $i++) {
        $frequencyDistribution[] = [
            'interval' => $intervals[$i],
            'classMark' => $classMarks[$i],
            'absoluteFrequency' => $absoluteFrequencies[$i],
            'cumulativeFrequency' => $cumulativeFrequencies[$i],
            'relativeFrequency' => $relativeFrequencies[$i],
            'cumulativeRelativeFrequency' => $cumulativeRelativeFrequencies[$i],
        ];
    }

    return $frequencyDistribution;
}
private function calculateMean($frequencyDistribution)
{
    $sum = 0;
    $totalFrequency = 0;

    foreach ($frequencyDistribution as $distribution) {
        $sum += $distribution['classMark'] * $distribution['absoluteFrequency'];
        $totalFrequency += $distribution['absoluteFrequency'];
    }

    return $sum / $totalFrequency;
}

private function calculateMedian($frequencyDistribution, $totalCount)
{
    // Encontrar la posición de la mediana
    $middlePosition = ($totalCount) / 2;

    $cumulativeFrequency = 0;
    foreach ($frequencyDistribution as $distribution) {
        $cumulativeFrequency += $distribution['absoluteFrequency'];
        if ($cumulativeFrequency >= $middlePosition) {
            return $distribution['interval'][0] + (($middlePosition - ($cumulativeFrequency - $distribution['absoluteFrequency'])) / $distribution['absoluteFrequency']) * ($distribution['interval'][1] - $distribution['interval'][0]);
        }
    }

    return null; // En caso de no encontrar una mediana válida
}

private function calculateMode($frequencyDistribution)
{
    // Encontrar la clase con la frecuencia absoluta máxima
    $maxFrequency = max(array_column($frequencyDistribution, 'absoluteFrequency'));
    $modalClass = null;

    foreach ($frequencyDistribution as $distribution) {
        if ($distribution['absoluteFrequency'] == $maxFrequency) {
            $modalClass = $distribution;
            break; // Encontramos la primera clase modal, salimos del bucle
        }
    }

    // Si encontramos la clase modal, calculamos la moda utilizando la fórmula de la clase modal
    if ($modalClass) {
        // Extraer límites y frecuencias necesarias
        $lowerBound = intval($modalClass['interval'][0]);
        $upperBound = intval($modalClass['interval'][1]);
        $modalFrequency = $modalClass['absoluteFrequency'];

        // Calcular la moda utilizando la fórmula específica para datos agrupados
        $classSize = $upperBound - $lowerBound + 1;
        $previousFrequency = ($modalClass === $frequencyDistribution[0]) ? 0 : $frequencyDistribution[array_search($modalClass, $frequencyDistribution) - 1]['absoluteFrequency'];
        $nextFrequency = ($modalClass === end($frequencyDistribution)) ? 0 : $frequencyDistribution[array_search($modalClass, $frequencyDistribution) + 1]['absoluteFrequency'];

        $modal = $lowerBound + (($modalFrequency - $previousFrequency) / (2 * $modalFrequency - $previousFrequency - $nextFrequency)) * $classSize;

        return $modal;
    }

    return null; // En caso de no encontrar una moda válida
}


private function calculateVariance($frequencyDistribution, $mean)
{
    $sum = 0;
    $totalFrequency = 0;

    foreach ($frequencyDistribution as $distribution) {
        $sum += pow($distribution['classMark'] - $mean, 2) * $distribution['absoluteFrequency'];
        $totalFrequency += $distribution['absoluteFrequency'];
    }

    return $sum / $totalFrequency;
}

private function calculateMeanDeviation($frequencyDistribution, $mean)
{
    $sum = 0;
    $totalFrequency = 0;

    foreach ($frequencyDistribution as $distribution) {
        $sum += abs($distribution['classMark'] - $mean) * $distribution['absoluteFrequency'];
        $totalFrequency += $distribution['absoluteFrequency'];
    }

    return $sum / $totalFrequency;
}

private function calculateStdDeviation($variance)
{
    return sqrt($variance);
}


private function media2($datos) {
    // Paso 1: Parsear la cadena de datos
    $dataString = $datos;
    $dataArray = array_map('intval', explode(',', $dataString));

    // Paso 2: Ordenar los datos
    sort($dataArray);

    // Paso 3: Calcular el rango y la amplitud
    $minValue = min($dataArray);
    $maxValue = max($dataArray);
    $range = $maxValue - $minValue;

    $numClasses = 5;
    $classWidth = ceil($range / $numClasses);

    // Paso 4: Crear la tabla de distribución de frecuencias
    $frequencyTable = [];
    for ($i = 0; $i < $numClasses; $i++) {
        $lowerBound = $minValue + ($i * $classWidth);
        $upperBound = $lowerBound + $classWidth - 1;
        $frequencyTable[] = [
            'lowerBound' => $lowerBound,
            'upperBound' => $upperBound,
            'frequency' => 0,
            'accumulatedFrequency' => 0,
        ];
    }

    // Llenar la tabla de frecuencias
    foreach ($dataArray as $value) {
        foreach ($frequencyTable as &$class) {
            if ($value >= $class['lowerBound'] && $value <= $class['upperBound']) {
                $class['frequency']++;
                break;
            }
        }
    }

    // Calcular la frecuencia acumulada
    $accumulatedFrequency = 0;
    foreach ($frequencyTable as &$class) {
        $accumulatedFrequency += $class['frequency'];
        $class['accumulatedFrequency'] = $accumulatedFrequency;
    }

    // Calcular la mediana
    $N = count($dataArray);
    $target = $N / 2;

    $accumulatedFrequency = 0;
    $median = null;

    foreach ($frequencyTable as $class) {
        $accumulatedFrequency += $class['frequency'];

        if ($accumulatedFrequency >= $target) {
            $median = $class['lowerBound'] + (($target - ($accumulatedFrequency - $class['frequency'])) / $class['frequency']) * $classWidth;
            break;
        }
    }

    // Si no se encontró la mediana por alguna razón, tomar el último valor de la clase
    if (is_null($median)) {
        $lastClass = end($frequencyTable);
        $median = $lastClass['upperBound'];
    }

    return $median;
}


public  function  moda2($datos) {
    // Paso 1: Parsear la cadena de datos
    $dataString = $datos;
    $dataArray = array_map('intval', explode(',', $dataString));

    // Paso 2: Ordenar los datos
    sort($dataArray);

    // Paso 3: Calcular el rango y la amplitud
    $minValue = min($dataArray);
    $maxValue = max($dataArray);
    $range = $maxValue - $minValue;

    $numClasses = 5;
    $classWidth = ceil($range / $numClasses);

    // Paso 4: Crear la tabla de distribución de frecuencias
    $frequencyTable = [];
    for ($i = 0; $i < $numClasses; $i++) {
        $lowerBound = $minValue + ($i * $classWidth);
        $upperBound = $lowerBound + $classWidth - 1;
        $frequencyTable[] = [
            'lowerBound' => $lowerBound,
            'upperBound' => $upperBound,
            'frequency' => 0,
        ];
    }

    // Llenar la tabla de frecuencias
    foreach ($dataArray as $value) {
        foreach ($frequencyTable as &$class) {
            if ($value >= $class['lowerBound'] && $value <= $class['upperBound']) {
                $class['frequency']++;
                break;
            }
        }
    }

    // Paso 5: Calcular la moda de los datos agrupados
    $mode = null;
    $maxFrequency = 0;
    $modalClassIndex = 0;

    // Encontrar la clase modal (con mayor frecuencia)
    foreach ($frequencyTable as $index => $class) {
        if ($class['frequency'] > $maxFrequency) {
            $maxFrequency = $class['frequency'];
            $modalClassIndex = $index;
        }
    }

    if ($maxFrequency > 0) {
        $modalClass = $frequencyTable[$modalClassIndex];
        $L = $modalClass['lowerBound'];
        $f_m = $modalClass['frequency'];
        $f_1 = $modalClassIndex > 0 ? $frequencyTable[$modalClassIndex - 1]['frequency'] : 0;
        $f_2 = $modalClassIndex < count($frequencyTable) - 1 ? $frequencyTable[$modalClassIndex + 1]['frequency'] : 0;
        $w = $classWidth;

        $mode = $L + (($f_m - $f_1) / (2 * $f_m - $f_1 - $f_2)) * $w;
    }

    return $mode;
}
}