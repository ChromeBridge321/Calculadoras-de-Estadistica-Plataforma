<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FunctionsController extends Controller
{
    /**
     * Calcula cuartiles, deciles o percentiles según el tipo de operación
     */
    public function calculateQuartile(Request $request)
    {
        return $this->calculatePositionalMeasure($request, 'Cuartiles', 1);
    }

    public function calculateDecile(Request $request)
    {
        return $this->calculatePositionalMeasure($request, 'Deciles', 2);
    }

    public function calculatePercentile(Request $request)
    {
        return $this->calculatePositionalMeasure($request, 'Percentiles', 3);
    }

    /**
     * Calcula el coeficiente de asimetría de Fisher
     */
    public function calculateFisher(Request $request)
    {
        try {
            $data = $this->parseAndValidateData($request->input('data'));
            
            $n = count($data);
            $mean = array_sum($data) / $n;
            $variance = $this->calculateSampleVariance($data, $mean);
            $stdDev = sqrt($variance);
            
            // Coeficiente de asimetría de Fisher
            $sum = 0;
            foreach ($data as $value) {
                $sum += pow(($value - $mean) / $stdDev, 3);
            }
            
            $fisher = $sum / $n;
            $result = $this->interpretFisherCoefficient($fisher);
            
            return view('CoeficienteFisher', ['result' => $result]);
        } catch (\Exception $e) {
            return view('CoeficienteFisher', ['result' => ['', '', '']]);
        }
    }

    /**
     * Calcula el coeficiente de asimetría de Bowley
     */
    public function calculateBowley(Request $request)
    {
        try {
            $data = $this->parseAndValidateData($request->input('data'));
            
            $Q1 = $this->calculatePercentileValue($data, 25);
            $Q2 = $this->calculatePercentileValue($data, 50); // Mediana
            $Q3 = $this->calculatePercentileValue($data, 75);
            
            $bowley = ($Q3 + Q1 - 2 * $Q2) / ($Q3 - Q1);
            
            return view('CoeficienteBowley', ['result' => round($bowley, 4)]);
        } catch (\Exception $e) {
            return view('CoeficienteBowley', ['result' => '']);
        }
    }

    /**
     * Calcula el coeficiente de correlación de Pearson
     */
    public function calculatePearson(Request $request)
    {
        try {
            $data1 = $this->parseAndValidateData($request->input('data1'));
            $data2 = $this->parseAndValidateData($request->input('data2'));
            
            if (count($data1) !== count($data2)) {
                throw new \Exception('Los conjuntos de datos deben tener el mismo tamaño');
            }
            
            $n = count($data1);
            $mean1 = array_sum($data1) / $n;
            $mean2 = array_sum($data2) / $n;
            
            $numerator = 0;
            $sumSquares1 = 0;
            $sumSquares2 = 0;
            
            for ($i = 0; $i < $n; $i++) {
                $diff1 = $data1[$i] - $mean1;
                $diff2 = $data2[$i] - $mean2;
                
                $numerator += $diff1 * $diff2;
                $sumSquares1 += pow($diff1, 2);
                $sumSquares2 += pow($diff2, 2);
            }
            
            $denominator = sqrt($sumSquares1 * $sumSquares2);
            $pearson = $denominator != 0 ? $numerator / $denominator : 0;
            
            return view('CoeficientePearson', ['pearson' => round($pearson, 4)]);
        } catch (\Exception $e) {
            return view('CoeficientePearson', ['pearson' => '']);
        }
    }

    /**
     * Calcula el coeficiente de curtosis
     */
    public function calculateCurtosis(Request $request)
    {
        try {
            $data = $this->parseAndValidateData($request->input('data'));
            
            $n = count($data);
            $mean = array_sum($data) / $n;
            $variance = $this->calculateSampleVariance($data, $mean);
            $stdDev = sqrt($variance);
            
            $sum = 0;
            foreach ($data as $value) {
                $sum += pow(($value - $mean) / $stdDev, 4);
            }
            
            $curtosis = ($sum / $n) - 3; // Curtosis exceso
            
            return view('CoeficienteCurtosis', [
                'curtosis' => round($curtosis, 4),
                'n' => $n,
                'median' => round($mean, 4),
                'variance' => round($variance, 4),
                'desviation' => round($stdDev, 4)
            ]);
        } catch (\Exception $e) {
            return view('CoeficienteCurtosis', [
                'curtosis' => '',
                'n' => '',
                'median' => '',
                'variance' => '',
                'desviation' => ''
            ]);
        }
    }

    /**
     * Genera un diagrama de Pareto
     */
    public function calculatePareto(Request $request)
    {
        try {
            $data = $this->parseAndValidateData($request->input('data'));
            $labels = array_map('trim', explode(',', $request->input('labels')));
            
            if (count($data) !== count($labels)) {
                throw new \Exception('Los datos y las etiquetas deben tener el mismo tamaño');
            }
            
            // Combinar datos y etiquetas, luego ordenar por valor descendente
            $combined = array_combine($labels, $data);
            arsort($combined);
            
            $sortedLabels = array_keys($combined);
            $sortedData = array_values($combined);
            
            // Calcular porcentajes acumulados
            $total = array_sum($sortedData);
            $cumulative = [];
            $sum = 0;
            
            foreach ($sortedData as $value) {
                $sum += $value;
                $cumulative[] = round(($sum / $total) * 100, 2);
            }
            
            return view('pareto', [
                'labels' => $sortedLabels,
                'data' => $sortedData,
                'cumulative' => $cumulative
            ]);
        } catch (\Exception $e) {
            return view('pareto', [
                'labels' => [],
                'data' => [],
                'cumulative' => []
            ]);
        }
    }

    // ===========================================
    // MÉTODOS AUXILIARES PRIVADOS
    // ===========================================

    /**
     * Método genérico para calcular medidas posicionales
     */
    private function calculatePositionalMeasure(Request $request, $viewName, $operation)
    {
        try {
            $data = $this->parseAndValidateData($request->input('data'));
            $number = (int) $request->number;
            
            $result = $this->calculatePositionalValue($data, $number, $operation);
            $position = $this->calculatePosition($data, $number, $operation);
            
            sort($data);
            $dataString = implode(', ', $data);
            
            return view($viewName, [
                'result' => round($result, 4),
                'data' => $dataString,
                'position' => $position
            ]);
        } catch (\Exception $e) {
            return view($viewName, [
                'result' => '',
                'data' => '',
                'position' => ''
            ]);
        }
    }

    /**
     * Calcula el valor posicional (cuartil, decil o percentil)
     */
    private function calculatePositionalValue($data, $number, $operation)
    {
        sort($data);
        $n = count($data);
        
        switch ($operation) {
            case 1: // Cuartiles
                $percentile = $number * 25;
                break;
            case 2: // Deciles
                $percentile = $number * 10;
                break;
            case 3: // Percentiles
                $percentile = $number;
                break;
            default:
                throw new \Exception('Operación no válida');
        }
        
        return $this->calculatePercentileValue($data, $percentile);
    }

    /**
     * Calcula un percentil específico
     */
    private function calculatePercentileValue($data, $percentile)
    {
        sort($data);
        $n = count($data);
        
        $index = ($percentile / 100) * ($n - 1);
        
        if (floor($index) == $index) {
            return $data[$index];
        } else {
            $lower = floor($index);
            $upper = ceil($index);
            $weight = $index - $lower;
            
            return $data[$lower] * (1 - $weight) + $data[$upper] * $weight;
        }
    }

    /**
     * Calcula la posición teórica
     */
    private function calculatePosition($data, $number, $operation)
    {
        $n = count($data);
        
        switch ($operation) {
            case 1: // Cuartiles
                return ($number * ($n + 1)) / 4;
            case 2: // Deciles
                return ($number * ($n + 1)) / 10;
            case 3: // Percentiles
                return ($number * ($n + 1)) / 100;
            default:
                return 0;
        }
    }

    /**
     * Parsea y valida los datos de entrada
     */
    private function parseAndValidateData($dataString)
    {
        if (empty($dataString)) {
            throw new \Exception('No se proporcionaron datos');
        }

        $data = explode(',', $dataString);
        $data = array_map('trim', $data);
        $data = array_filter($data, function($value) {
            return is_numeric($value);
        });
        
        if (empty($data)) {
            throw new \Exception('No se encontraron datos numéricos válidos');
        }

        return array_map('floatval', $data);
    }

    /**
     * Calcula la varianza muestral
     */
    private function calculateSampleVariance($data, $mean)
    {
        $n = count($data);
        if ($n <= 1) return 0;
        
        $sumSquaredDifferences = array_sum(array_map(function($value) use ($mean) {
            return pow($value - $mean, 2);
        }, $data));
        
        return $sumSquaredDifferences / ($n - 1);
    }

    /**
     * Interpreta el coeficiente de Fisher
     */
    private function interpretFisherCoefficient($fisher)
    {
        $value = round($fisher, 4);
        
        if (abs($fisher) < 0.5) {
            if ($fisher > 0) {
                return ["Asimetría Positiva Leve", $value, "2"];
            } elseif ($fisher < 0) {
                return ["Asimetría Negativa Leve", $value, "3"];
            } else {
                return ["Simétrica", $value, "1"];
            }
        } elseif (abs($fisher) < 1) {
            if ($fisher > 0) {
                return ["Asimetría Positiva Moderada", $value, "2"];
            } else {
                return ["Asimetría Negativa Moderada", $value, "3"];
            }
        } else {
            if ($fisher > 0) {
                return ["Asimetría Positiva Alta", $value, "2"];
            } else {
                return ["Asimetría Negativa Alta", $value, "3"];
            }
        }
    }
}
