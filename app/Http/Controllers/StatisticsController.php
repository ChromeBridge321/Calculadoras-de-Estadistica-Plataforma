<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    /**
     * Calcula medidas de tendencia central según el tipo solicitado
     */
    public function calculateCentralTendency(Request $request, $type)
    {
        try {
            $data = $this->parseAndValidateData($request->input('datos'));
            
            $result = [
                'promedio' => 0,
                'mediana' => 0,
                'moda' => 0,
                'operacion' => $this->getOperationType($type),
                'muestra' => 0
            ];

            switch ($type) {
                case 'media':
                    $result['promedio'] = round($this->calculateMean($data), 4);
                    break;
                case 'mediana':
                    $result['mediana'] = round($this->calculateMedian($data), 4);
                    break;
                case 'moda':
                    $result['moda'] = $this->calculateMode($data);
                    break;
            }

            return view('MedidasTendencia', $result);
        } catch (\Exception $e) {
            return $this->returnEmptyView('MedidasTendencia', $this->getOperationType($type));
        }
    }

    /**
     * Calcula el tamaño de muestra requerido
     */
    public function calculateSampleSize(Request $request)
    {
        try {
            $poblacion = (float) $request->poblacion;
            $nivelConfianza = (float) $request->confianza_1; // Z value
            $probabilidadExito = (float) $request->probabilidadP_1;
            $probabilidadFracaso = (float) $request->probabilidadN_1;
            $margenError = (float) $request->margenR;

            // Validaciones
            if ($poblacion <= 0 || $nivelConfianza <= 0 || $margenError <= 0) {
                throw new \Exception('Valores inválidos');
            }
            
            if (abs($probabilidadExito + $probabilidadFracaso - 1.0) > 0.001) {
                throw new \Exception('La suma de probabilidades debe ser 1');
            }

            // Fórmula corregida para tamaño de muestra
            $numerador = $poblacion * pow($nivelConfianza, 2) * $probabilidadExito * $probabilidadFracaso;
            $denominador = pow($margenError, 2) * ($poblacion - 1) + pow($nivelConfianza, 2) * $probabilidadExito * $probabilidadFracaso;
            
            $muestra = ceil($numerador / $denominador);

            return view('MedidasTendencia', [
                'promedio' => 0,
                'mediana' => 0,
                'moda' => 0,
                'operacion' => 4,
                'muestra' => $muestra
            ]);
        } catch (\Exception $e) {
            return $this->returnEmptyView('MedidasTendencia', 4);
        }
    }

    /**
     * Genera tabla de frecuencias para datos no agrupados
     */
    public function generateFrequencyTable(Request $request)
    {
        try {
            $data = $this->parseAndValidateData($request->input('datos'));
            
            $statistics = $this->calculateBasicStatistics($data);
            $frequency = array_count_values($data);
            ksort($frequency);

            return view('TablasFrecuencias', array_merge($statistics, [
                'frequency' => $frequency,
                'n' => count($data),
                'operacion' => 1
            ]));
        } catch (\Exception $e) {
            return $this->returnEmptyFrequencyView(1);
        }
    }

    /**
     * Genera tabla de frecuencias para datos agrupados
     */
    public function generateGroupedFrequencyTable(Request $request)
    {
        try {
            $data = $this->parseAndValidateData($request->input('datos'));
            
            $frequencyDistribution = $this->calculateFrequencyDistribution($data);
            $statistics = $this->calculateGroupedStatistics($frequencyDistribution);

            return view('TablasFrecuencias', array_merge($statistics, [
                'operacion' => 2,
                'frequencyDistribution' => $frequencyDistribution
            ]));
        } catch (\Exception $e) {
            return $this->returnEmptyFrequencyView(2);
        }
    }

    // ===========================================
    // MÉTODOS AUXILIARES PRIVADOS
    // ===========================================

    /**
     * Obtiene el tipo de operación según el tipo de medida
     */
    private function getOperationType($type)
    {
        switch ($type) {
            case 'media': return 1;
            case 'mediana': return 2;
            case 'moda': return 3;
            default: return 1;
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
     * Calcula la media aritmética
     */
    private function calculateMean($data)
    {
        return array_sum($data) / count($data);
    }

    /**
     * Calcula la mediana
     */
    private function calculateMedian($data)
    {
        sort($data);
        $count = count($data);
        
        if ($count % 2 == 0) {
            return ($data[$count / 2 - 1] + $data[$count / 2]) / 2;
        } else {
            return $data[floor($count / 2)];
        }
    }

    /**
     * Calcula la moda
     */
    private function calculateMode($data)
    {
        $frequency = array_count_values($data);
        $maxFrequency = max($frequency);
        $modes = array_keys($frequency, $maxFrequency);
        
        // Si todos los valores tienen la misma frecuencia, no hay moda
        if (count($modes) == count($frequency)) {
            return 'No hay moda';
        }
        
        return implode(', ', $modes);
    }

    /**
     * Calcula la varianza poblacional
     */
    private function calculateVariance($data)
    {
        $n = count($data);
        $mean = $this->calculateMean($data);
        
        $sumSquaredDifferences = array_sum(array_map(function($value) use ($mean) {
            return pow($value - $mean, 2);
        }, $data));
        
        return $sumSquaredDifferences / $n;
    }

    /**
     * Calcula la desviación media
     */
    private function calculateMeanDeviation($data, $mean)
    {
        $n = count($data);
        
        $sumAbsoluteDifferences = array_sum(array_map(function($value) use ($mean) {
            return abs($value - $mean);
        }, $data));
        
        return $sumAbsoluteDifferences / $n;
    }

    /**
     * Calcula estadísticas básicas para datos no agrupados
     */
    private function calculateBasicStatistics($data)
    {
        $media = $this->calculateMean($data);
        $mediana = $this->calculateMedian($data);
        $moda = $this->calculateMode($data);
        $varianza = $this->calculateVariance($data);
        $estandarD = sqrt($varianza);
        $desviacionM = $this->calculateMeanDeviation($data, $media);

        return [
            'media' => round($media, 3),
            'mediana' => round($mediana, 3),
            'moda' => $moda,
            'varianza' => round($varianza, 3),
            'estandarD' => round($estandarD, 3),
            'desviacionM' => round($desviacionM, 3)
        ];
    }

    /**
     * Calcula la distribución de frecuencias para datos agrupados
     */
    private function calculateFrequencyDistribution($data)
    {
        sort($data);
        
        $n = count($data);
        $min = min($data);
        $max = max($data);
        $range = $max - $min;
        
        // Regla de Sturges para determinar el número de intervalos
        $numIntervals = max(1, ceil(1 + log($n, 2)));
        $intervalSize = $range > 0 ? ceil($range / $numIntervals) : 1;
        
        $intervals = [];
        $frequencies = array_fill(0, $numIntervals, 0);
        
        // Crear intervalos
        for ($i = 0; $i < $numIntervals; $i++) {
            $lowerBound = $min + ($i * $intervalSize);
            $upperBound = $lowerBound + $intervalSize - 1;
            
            // Para el último intervalo, incluir el máximo
            if ($i == $numIntervals - 1) {
                $upperBound = $max;
            }
            
            $intervals[] = [$lowerBound, $upperBound];
        }
        
        // Contar frecuencias
        foreach ($data as $value) {
            for ($i = 0; $i < $numIntervals; $i++) {
                if ($value >= $intervals[$i][0] && $value <= $intervals[$i][1]) {
                    $frequencies[$i]++;
                    break;
                }
            }
        }
        
        // Construir resultado
        $result = [];
        $cumulativeFreq = 0;
        
        for ($i = 0; $i < $numIntervals; $i++) {
            $cumulativeFreq += $frequencies[$i];
            $classMark = ($intervals[$i][0] + $intervals[$i][1]) / 2;
            
            $result[] = [
                'interval' => $intervals[$i][0] . ' - ' . $intervals[$i][1],
                'classMark' => $classMark,
                'absoluteFrequency' => $frequencies[$i],
                'cumulativeFrequency' => $cumulativeFreq,
                'relativeFrequency' => $frequencies[$i] / $n,
                'cumulativeRelativeFrequency' => $cumulativeFreq / $n,
            ];
        }
        
        return $result;
    }

    /**
     * Calcula estadísticas para datos agrupados
     */
    private function calculateGroupedStatistics($frequencyDistribution)
    {
        $media = $this->calculateGroupedMean($frequencyDistribution);
        $mediana = $this->calculateGroupedMedian($frequencyDistribution);
        $moda = $this->calculateGroupedMode($frequencyDistribution);
        $varianza = $this->calculateGroupedVariance($frequencyDistribution, $media);
        $estandarD = sqrt($varianza);
        $desviacionM = $this->calculateGroupedMeanDeviation($frequencyDistribution, $media);

        return [
            'media' => round($media, 3),
            'mediana' => round($mediana, 3),
            'moda' => round($moda, 3),
            'varianza' => round($varianza, 3),
            'estandarD' => round($estandarD, 3),
            'desviacionM' => round($desviacionM, 3)
        ];
    }

    /**
     * Calcula la media para datos agrupados
     */
    private function calculateGroupedMean($frequencyDistribution)
    {
        $sum = 0;
        $totalFrequency = 0;
        
        foreach ($frequencyDistribution as $interval) {
            $sum += $interval['classMark'] * $interval['absoluteFrequency'];
            $totalFrequency += $interval['absoluteFrequency'];
        }
        
        return $totalFrequency > 0 ? $sum / $totalFrequency : 0;
    }

    /**
     * Calcula la mediana para datos agrupados
     */
    private function calculateGroupedMedian($frequencyDistribution)
    {
        $totalFreq = array_sum(array_column($frequencyDistribution, 'absoluteFrequency'));
        $targetPosition = $totalFreq / 2;
        $cumulativeFreq = 0;
        
        foreach ($frequencyDistribution as $interval) {
            $cumulativeFreq += $interval['absoluteFrequency'];
            
            if ($cumulativeFreq >= $targetPosition) {
                $bounds = explode(' - ', $interval['interval']);
                $lowerBound = (float) $bounds[0];
                $upperBound = (float) $bounds[1];
                $intervalWidth = $upperBound - $lowerBound + 1;
                
                $prevCumulativeFreq = $cumulativeFreq - $interval['absoluteFrequency'];
                
                if ($interval['absoluteFrequency'] > 0) {
                    return $lowerBound + (($targetPosition - $prevCumulativeFreq) / $interval['absoluteFrequency']) * $intervalWidth;
                }
                
                return $lowerBound;
            }
        }
        
        return 0;
    }

    /**
     * Calcula la moda para datos agrupados
     */
    private function calculateGroupedMode($frequencyDistribution)
    {
        $maxFreq = max(array_column($frequencyDistribution, 'absoluteFrequency'));
        $modalInterval = null;
        $modalIndex = 0;
        
        foreach ($frequencyDistribution as $index => $interval) {
            if ($interval['absoluteFrequency'] == $maxFreq) {
                $modalInterval = $interval;
                $modalIndex = $index;
                break;
            }
        }
        
        if ($modalInterval && $maxFreq > 0) {
            $bounds = explode(' - ', $modalInterval['interval']);
            $lowerBound = (float) $bounds[0];
            $upperBound = (float) $bounds[1];
            $intervalWidth = $upperBound - $lowerBound + 1;
            
            $f1 = $modalIndex > 0 ? $frequencyDistribution[$modalIndex - 1]['absoluteFrequency'] : 0;
            $f2 = $modalIndex < count($frequencyDistribution) - 1 ? $frequencyDistribution[$modalIndex + 1]['absoluteFrequency'] : 0;
            $fm = $modalInterval['absoluteFrequency'];
            
            $denominator = 2 * $fm - $f1 - $f2;
            
            if ($denominator != 0) {
                return $lowerBound + (($fm - $f1) / $denominator) * $intervalWidth;
            }
        }
        
        return 0;
    }

    /**
     * Calcula la varianza para datos agrupados
     */
    private function calculateGroupedVariance($frequencyDistribution, $mean)
    {
        $sum = 0;
        $totalFreq = 0;
        
        foreach ($frequencyDistribution as $interval) {
            $sum += pow($interval['classMark'] - $mean, 2) * $interval['absoluteFrequency'];
            $totalFreq += $interval['absoluteFrequency'];
        }
        
        return $totalFreq > 0 ? $sum / $totalFreq : 0;
    }

    /**
     * Calcula la desviación media para datos agrupados
     */
    private function calculateGroupedMeanDeviation($frequencyDistribution, $mean)
    {
        $sum = 0;
        $totalFreq = 0;
        
        foreach ($frequencyDistribution as $interval) {
            $sum += abs($interval['classMark'] - $mean) * $interval['absoluteFrequency'];
            $totalFreq += $interval['absoluteFrequency'];
        }
        
        return $totalFreq > 0 ? $sum / $totalFreq : 0;
    }

    /**
     * Retorna vista vacía para medidas de tendencia central
     */
    private function returnEmptyView($viewName, $operacion)
    {
        return view($viewName, [
            'promedio' => 0,
            'mediana' => 0,
            'moda' => 0,
            'operacion' => $operacion,
            'muestra' => 0
        ]);
    }

    /**
     * Retorna vista vacía para tablas de frecuencias
     */
    private function returnEmptyFrequencyView($operacion)
    {
        $emptyData = [
            'media' => 0,
            'mediana' => 0,
            'moda' => 0,
            'varianza' => 0,
            'estandarD' => 0,
            'desviacionM' => 0,
            'operacion' => $operacion
        ];

        if ($operacion == 1) {
            $emptyData['frequency'] = [];
            $emptyData['n'] = 0;
        } else {
            $emptyData['frequencyDistribution'] = [];
        }

        return view('TablasFrecuencias', $emptyData);
    }
}
