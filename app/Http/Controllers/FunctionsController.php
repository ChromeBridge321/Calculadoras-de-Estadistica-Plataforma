<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FunctionsController extends Controller
{

    public function CalculateQuartile(Request $request)
    {
        $numberString = $request->input('data');
        $quartileNumber = $request->quartile;
        $numbersArray = explode(',', $numberString);
        $n = count($numbersArray);
        $operation = ($quartileNumber * ($n + 1)) / 4;
        sort($numbersArray);
        $position = $this->PoU($operation);



        if (($position - (floor($position))) == 0.5) {
            $p1 = floor($position)-1;
            $p2 = ($position + 0.5)-1;
            $result = ($numbersArray[$p1] + $numbersArray[$p2]) / 2;
        } else {
            $result = $numbersArray[$position - 1];
        }
        $numbersArray = implode(',', $numbersArray);





        return view('MedidasPosicion')->with('result', $result)->with('data', $numbersArray)->with('position', $operation);
    }

    private function PoU($data)
    {

        $raw = floor($data);
        $whatIf = $data - $raw;

        if ($whatIf < 0.5) {
            $data = floor($data);
        }

        if ($whatIf > 0.55) {
            $data = round($data);
        }

        if ($whatIf == 0.5) {
            return $data;
        }

        return $data;
    }
}
