<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class FunctionsController extends Controller
{

    public function CalculateQuartile(Request $request)
    {
        try {
            $numberString = $request->input('data'); //obtine los datos enviados desde la vista y los guarda en una variable
            $quartileNumber = $request->quartile; //obtine el numero de cuartil a calcular enviado desde la vista
            $numbersArray = explode(',', $numberString); //combierte la cadena enviada de la vista en un array de numeros
            $n = count($numbersArray); //cuenta el numero de datos que hay dentro del array
            $operation = ($quartileNumber * ($n + 1)) / 4; //aplica la operacion del cuartil para encontrar la posicion
            sort($numbersArray); //ordena de menos a mayor los datos contenidos en el array
            $position = $this->PoU($operation); //aplica la duncion privada llamada PoU



            if (($position - (floor($position))) == 0.5) { //si la posicion contiene el .5 en su decimal entonces se aplica el id
                $p1 = floor($position) - 1; //encuentra el valor de la posicion 1 restandole 1 debido a la naturaleza de un array
                $p2 = ($position + 0.5) - 1; // encuentra la posicion 2 restando 1
                $result = ($numbersArray[$p1] + $numbersArray[$p2]) / 2; //se obtiene el valor medio entre ambas posiciones
                //sumandolas y dividiendola entre 2
            } else { // si la posicion no contiene .5 se aplica lo siguiente
                $result = $numbersArray[$position - 1]; // la posicion del valor es igual al valor de la posicion en el array menos 1
            }
            $numbersArray = implode(',', $numbersArray); // se convierte el array a una cadena


            return view('Cuartiles') // se devuleven los valores junto con la vista
                ->with('result', $result)
                ->with('data', $numbersArray)
                ->with('position', $operation);
        } catch (\Throwable $th) {
            $result = "";
            $data = "";
            $position = "";
            return view('Cuartiles')->with('result', $result)->with('data', $data)->with('position', $position);
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

    public function CalculateDecile(Request $request){
        try {
            $numberString = $request->input('data'); //obtine los datos enviados desde la vista y los guarda en una variable
            $decileNumber = $request->decile; //obtine el numero de cuartil a calcular enviado desde la vista
            $numbersArray = explode(',', $numberString); //combierte la cadena enviada de la vista en un array de numeros
            $n = count($numbersArray); //cuenta el numero de datos que hay dentro del array
            $operation = ($decileNumber * ($n + 1)) / 10; //aplica la operacion del cuartil para encontrar la posicion
            sort($numbersArray); //ordena de menos a mayor los datos contenidos en el array
            $position = $this->PoU($operation); //aplica la funcion privada llamada PoU



            if (($position - (floor($position))) == 0.5) { //si la posicion contiene el .5 en su decimal entonces se aplica el id
                $p1 = floor($position) - 1; //encuentra el valor de la posicion 1 restandole 1 debido a la naturaleza de un array
                $p2 = ($position + 0.5) - 1; // encuentra la posicion 2 restando 1
                $result = ($numbersArray[$p1] + $numbersArray[$p2]) / 2; //se obtiene el valor medio entre ambas posiciones
                //sumandolas y dividiendola entre 2
            } else { // si la posicion no contiene .5 se aplica lo siguiente
                $result = $numbersArray[$position - 1]; // la posicion del valor es igual al valor de la posicion en el array menos 1
            }
            $numbersArray = implode(',', $numbersArray); // se convierte el array a una cadena


            return view('Deciles') // se devuleven los valores junto con la vista
                ->with('result', $result)
                ->with('data', $numbersArray)
                ->with('position', $operation);
        } catch (\Throwable $th) {
            $result = "";
            $data = "";
            $position = "";
            return view('Deciles')->with('result', $result)->with('data', $data)->with('position', $position);
        }
    }
}



