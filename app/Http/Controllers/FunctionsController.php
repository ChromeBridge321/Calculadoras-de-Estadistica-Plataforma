<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpParser\Node\Stmt\For_;
use PhpParser\Node\Stmt\TryCatch;

class FunctionsController extends Controller
{

    public function CalculateQuartile(Request $request)
    {
        try {
            $array = $this->calculate($request->input('data'), $request->number, $request->input('operation')); // aqui solo hace uso de la funcion calculate y se le pasan 3 parametros
            $result = $array[0]; // el resultado esta en la posicion 0 del array                                //la cadena de numeros, el numero de cuartil, decil o percentil y el tipo de operacion                                                                               // que le corresponde a cada operacion
            $data = $array[1];                                                                                  // que le corresponde a cada operacion
            $position = $array[2];

            return view('Cuartiles')->with('result', $result)->with('data', $data)->with('position', $position);
        } catch (\Throwable $th) {
            $result = "";
            $data = "";
            $position = "";
            return view('Cuartiles')->with('result', $result)->with('data', $data)->with('position', $position);
        }
    }



    public function CalculateDecile(Request $request)
    {
        try {
            $array = $this->calculate($request->input('data'), $request->number, $request->input('operation'));
            $result = $array[0];
            $data = $array[1];
            $position = $array[2];

            return view('Deciles')->with('result', $result)->with('data', $data)->with('position', $position);
        } catch (\Throwable $th) {
            $result = "";
            $data = "";
            $position = "";
            return view('Deciles')->with('result', $result)->with('data', $data)->with('position', $position);
        }
    }

    public function CalculatePercentile(Request $request)
    {
        try {
            $array = $this->calculate($request->input('data'), $request->number, $request->input('operation'));
            $result = $array[0];
            $data = $array[1];
            $position = $array[2];

            return view('Percentiles')->with('result', $result)->with('data', $data)->with('position', $position);
        } catch (\Throwable $th) {
            $result = "";
            $data = "";
            $position = "";
            return view('Percentiles')->with('result', $result)->with('data', $data)->with('position', $position);
        }
    }

    private function calculate($string, $number, $operation)
    {
        try {
            $numberString = $string; //obtine los datos enviados desde la vista y los guarda en una variable

            if ($operation == 1) {
                $quartileNumber = $number; //obtine el numero de cuartil a calcular enviado desde la vista
            }

            if ($operation == 2) {
                $decileNumber = $number; //obtine el numero de cuartil a calcular enviado desde la vista
            }


            if ($operation == 3) {
                $percentileNumber = $number; //obtine el numero de cuartil a calcular enviado desde la vista
            }


            $numbersArray = explode(',', $numberString); //combierte la cadena enviada de la vista en un array de numeros
            $n = count($numbersArray); //cuenta el numero de datos que hay dentro del array

            if ($operation == 1) {
                $OP = ($quartileNumber * ($n + 1)) / 4; //aplica la operacion del cuartil para encontrar la posicion
            }

            if ($operation == 2) {
                $OP = ($decileNumber * ($n + 1)) / 10; //aplica la operacion del decil para encontrar la posicion
            }

            if ($operation == 3) {
                $OP = ($percentileNumber * ($n + 1)) / 100; //aplica la operacion del percentil para encontrar la posicion
            }

            sort($numbersArray); //ordena de menos a mayor los datos contenidos en el array
            $position = $this->PoU($OP); //aplica la funcion privada llamada PoU



            if (($position - (floor($position))) == 0.5) { //si la posicion contiene el .5 en su decimal entonces se aplica el id
                $p1 = floor($position) - 1; //encuentra el valor de la posicion 1 restandole 1 debido a la naturaleza de un array
                $p2 = ($position + 0.5) - 1; // encuentra la posicion 2 restando 1
                $result = ($numbersArray[$p1] + $numbersArray[$p2]) / 2; //se obtiene el valor medio entre ambas posiciones
                //sumandolas y dividiendola entre 2
            } else { // si la posicion no contiene .5 se aplica lo siguiente
                $result = $numbersArray[$position - 1]; // la posicion del valor es igual al valor de la posicion en el array menos 1
            }
            $numbersArray = implode(',  ', $numbersArray); // se convierte el array a una cadena

            $array = [$result, $numbersArray, $position]; // guerda las operaciones realizadas dentro de un array y lo retorna
            return $array;
        } catch (\Throwable $th) {
        }
    }

    private function PoU($data)
    {
        //funcion encargada de convertir los decimales dependiendo que valor tenga
        $raw = floor($data); //redondea el valor de la posicion hacia abajo quitando los decimales
        // y dejando solo el valor neto
        $whatIf = $data - $raw; // resta la posicion optenida de $data y le resta el valor neto

        if ($whatIf < 0.5) { // si el resultado de la resta es menor a 0.5 redondea hacia abajo
            $data = floor($data);
        }

        if ($whatIf > 0.55) { // si la resta es mayor a 0.55 redondea hacia arriba
            $data = round($data);
        }

        if ($whatIf == 0.5) { //si el valor es 0.5 exacto devuelve el valor tal cual es
            return $data;
        }

        return $data; //devuelve el valor segun sea el caso  aplicado
    }


    public function CalculateFisher(Request $request)
    {

        try {
            $numberString = $request->input('data'); //obtengo la cadena de datos
            $numbersArray = explode(',', $numberString); // transformo esa cadena a un array de numeros
            $n = count($numbersArray); // cuento la cantidad de datos que hay en el array
            $median = array_sum($numbersArray) / $n; // calculo la media
            sort($numbersArray); // ordeno de menor a mayor el array de numeros

            $variance = 0; //variable donde se guardara el resultado de la varianza
            for ($i = 0; $i < $n; $i++) {
                $variance += pow(($numbersArray[$i] - $median), 2); // calculo la varianza usando su formula haciendo uso de un recorrido for para
                //poser hacer la sumatoria total del array menos la media en cada posicion del array y elevarlas al cuadrado usado la duncion pow()
            }
            $variance = $variance / ($n); // hago el ultimo paso para calcular la varianza

            $sDesviation = sqrt($variance); //calculo la desviacion estandar sacando la raiz cuadrada de la varianza haciendo uso de la funcio sqrt()


            $sum = 0; // variable para poder almacenar la sumatoria requeria para el coeficiente de fisher
            for ($i = 0; $i < $n; $i++) {
                $sum += pow(($numbersArray[$i] - $median), 3); //haciendo uso de un recorrido for hago la sumatoria de cada numero en el array en cada posicion 
                //menos la media ya calculada y todo elevado al cuadrado
            }

            $result = ((1 / $n) * ($sum)) / pow($sDesviation, 3); // al resultado de la sumatoria le aplicamos la formula de coeficiente de fisher


            if ($result == 0) { // comprobatorias para cada resltado. esto esta hecho para darle una mejor retro alimentacion al usuario
                $fisher = ["Simétrica", "$result", "1"]; // si el resultado es = 0
            } elseif ($result > 0 && $result < 0.5) {
                $fisher = ["Asimetría Positiva Leve", "$result", "2"]; // si el resultado esta entre 0 y 0.5
            } elseif ($result >= 0.5 && $result < 1) {
                $fisher = ["Asimetría Positiva Moderada", "$result", "2"]; // si el resultado esta entre 0.5 y 1
            } elseif ($result >= 1) {
                $fisher = ["Asimetría Positiva Alta", "$result", "2"]; // si el resultado es = 1 0 mayor
            } elseif ($result < 0 && $result > -0.5) {
                $fisher = ["Asimetría Negativa Leve", "$result", "3"]; // si el resultado esta entre 0 y -0.5
            } elseif ($result <= -0.5 && $result > -1) {
                $fisher = ["Asimetría Negativa Moderada", "$result", "3"]; // si el resultado esta entre -0.5 y -1
            } elseif ($result <= -1) {
                $fisher = ["Asimetría Negativa Alta", "$result", "3"]; // si el resultado es menor o igual a -1
            } else {
                $fisher = ["Valor de γ fuera del rango esperado", "$result", "0"]; // si por cualquier otro motivo es diferente a todo retornara un mensaje de error
                // algo que es poco probable
            }


            return view('CoeficienteFisher')->with('result', $fisher); // se retorna el resultado a la vista correspondiente
        } catch (\Throwable $th) {
            $fisher = ["", "", ""];
            return view('CoeficienteFisher')->with('result', $fisher); // se retorna el resultado vacio a la vista correspondiente 
        }
    }

    public function CalculatePareto()
    {
        // Datos de ejemplo: frecuencias de problemas
        $data = [205, 195, 185, 165, 150, 120, 115, 110, 105, 95, 85, 75, 65, 50, 20, 15, 10, 5,];
        $labels = ['Problema A', 'Problema B', 'Problema C', 'Problema D', 'Problema E', 'Problema A', 'Problema B', 'Problema C', 'Problema D', 'Problema E', 'Problema A', 'Problema B', 'Problema C', 'Problema D', 'Problema E'];

        // Ordenar los datos de mayor a menor (ya están ordenados en este ejemplo)
        // Calcular el porcentaje acumulado
        $total = array_sum($data);
        $cumulative = [];
        $sum = 0;

        foreach ($data as $value) {
            $sum += $value;
            $cumulative[] = round(($sum / $total) * 100, 2);
        }

        return view('pareto', compact('labels', 'data', 'cumulative'));
    }


    public function CalculateBowley(Request $request)
    {

        try {
            $array1 = $this->calculate($request->input('data'), 1, 1); //aplico la funcion calculate pasandole los paramatros que pide 
            $array2 = $this->calculate($request->input('data'), 2, 1); //la cadena, el numero de cuartil y el tipo de operacion al que pertenece
            $array3 = $this->calculate($request->input('data'), 3, 1);
            $Q1 = $array1[0]; // cada cuartil pertenece a un tipo de array y solo obtengo el resultado de la operacion que esta en la posicion o del array
            $Q2 = $array2[0];
            $Q3 = $array3[0];

            $result = (($Q3 - $Q2) - ($Q2 - $Q1)) / ($Q3 - $Q1); // aplico la formula para calcular el coeficiente de bowley

            return view('CoeficienteBowley')->with('result', $result); //retorno la vista junto con el resultado de la operacion

        } catch (\Throwable $th) { // en caso de que falle algo retorno la vista con un resultado vacio para evitar errores al mostrar la vista
            $result = "";
            return view('CoeficienteBowley')->with('result', $result);
        }
    }
}
