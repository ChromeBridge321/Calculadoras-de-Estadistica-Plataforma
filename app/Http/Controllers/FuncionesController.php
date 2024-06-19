<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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


    public function muestra(Request $request){

        $poblacion = $request->poblacion;
        $poblacion_1 = $request->poblacion_1;
        $confianza_1 = (($request->confianza_1)*($request->confianza_1));
        $probabilidadP_1 = $request->probabilidadP_1;
        $probabilidadN_1 = $request->probabilidadN_1;
        $confianza_2 = (($request->confianza_2)*($request->confianza_2));
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
    }

