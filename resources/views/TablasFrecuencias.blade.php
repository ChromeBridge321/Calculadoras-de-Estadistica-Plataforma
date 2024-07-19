@extends('layouts.app')

@section('Content')
{{-- Cuerpo de la calculadora --}}

<div class=" container pt-4 ps-5 pe-5">
    @if ($operacion == 2)
    
    <div class=" row">
    
    <form class=" col-12" action="{{ route('showFrequencyDistribution') }}" method="post">
        @csrf
    
    
        <div class=" row">
            <div class=" col-12">
            <h3>Porfavor separe los datos por una coma ","</h3>
            </div>
            <div class=" col-9">
                <label for="" class=" form-label">Datos</label>
                <input type="" name="datos" id="" class=" form-control" oninput="validarInput(event)">
            </div>
            <div class=" col-3 d-flex align-items-end">
                <button type="submit" class=" btn btn-danger w-100">Calcular</button>
            </div>
    
            <div class=" col-12">
                <div class=" row">
                    <div class=" col-4">
                        <label for="" class=" form-label">Media</label>
                        <input type="text" name="" id="" class=" form-control"
                            value="{{ $media }}" readonly>
                    </div>
    
    
    
                    <div class=" col-4">
                        <label for="" class=" form-label">Mediana</label>
                        <input type="text" name="" id="" class=" form-control"
                            value="{{ $mediana }}" readonly>
                    </div>
    
    
    
                    <div class=" col-4">
                        <label for="" class=" form-label">Moda</label>
                        <input type="text" name="" id="" class=" form-control"
                            value="{{ $moda }}" readonly>
                    </div>
    
    
    
                    <div class=" col-4">
                        <label for="" class=" form-label">Varianza</label>
                        <input type="text" name="" id="" class=" form-control"
                            value="{{ $varianza }}" readonly>
                    </div>
    
    
                    <div class=" col-4">
                        <label for="" class=" form-label">Desviascion media</label>
                        <input type="text" name="" id="" class=" form-control"
                            value="{{ $desviacionM }}" readonly>
                    </div>
    
    
                    <div class=" col-4">
                        <label for="" class=" form-label">Desviascion estandar</label>
                        <input type="text" name="" id="" class=" form-control"
                            value="{{ $estandarD }}" readonly>
                    </div>
                </div>
            </div>
        </div>
    
    </form>
    
    <div class=" col-12 pt-5">
        <h2>Tabla de distribucion de frecuencias no agrupados</h2>
    </div>
    
    <div class=" col-12">
        <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Intervalo</th>
                        <th>Marca de Clase</th>
                        <th>Frecuencia Absoluta</th>
                        <th>Frecuencia Acumulada</th>
                        <th>Frecuencia Relativa</th>
                        <th>Frecuencia Relativa Acumulada</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($frequencyDistribution as $distribution)
     @php
         try {
            @endphp 
            <tr>
                            <td>{{ $distribution['interval'] }}</td>
                            <td>{{ $distribution['classMark'] }}</td>
                            <td>{{ $distribution['absoluteFrequency'] }}</td>
                            <td>{{ $distribution['cumulativeFrequency'] }}</td>
                            <td>{{ number_format($distribution['relativeFrequency'], 3) }}</td>
                            <td>{{ number_format($distribution['cumulativeRelativeFrequency'], 3) }}</td>
                        </tr>
                    @php
         } catch (\Throwable $th) {
            @endphp
    
            @php
         }
     @endphp
                    @endforeach
                </tbody>
            </table>
    </div>
    </div> 
    
    @endif
    
    
    @if ($operacion == 1)
    @php
    try {  
    @endphp
    
    <div class=" row">
    
    <form class=" col-12" action="{{ route('tabla1') }}" method="post">
    @csrf
    
    
    <div class=" row">
        <div class=" col-12">
            <h3>Porfavor separe los datos por una coma ","</h3>
            </div>
     <div class=" col-9">
         <label for="" class=" form-label">Datos</label>
         <input type="" name="datos" id="" class=" form-control" oninput="validarInput(event)">
     </div>
     <div class=" col-3 d-flex align-items-end">
         <button type="submit" class=" btn btn-danger w-100">Calcular</button>
     </div>
    
     <div class=" col-12">
         <div class=" row">
             <div class=" col-4">
                 <label for="" class=" form-label">Media</label>
                 <input type="text" name="" id="" class=" form-control"
                     value="{{ $media }}" readonly>
             </div>
    
    
    
             <div class=" col-4">
                 <label for="" class=" form-label">Mediana</label>
                 <input type="text" name="" id="" class=" form-control"
                     value="{{ $mediana }}" readonly>
             </div>
    
    
    
             <div class=" col-4">
                 <label for="" class=" form-label">Moda</label>
                 <input type="text" name="" id="" class=" form-control"
                     value="{{ $moda }}" readonly>
             </div>
    
    
    
             <div class=" col-4">
                 <label for="" class=" form-label">Varianza</label>
                 <input type="text" name="" id="" class=" form-control"
                     value="{{ $varianza }}" readonly>
             </div>
    
    
             <div class=" col-4">
                 <label for="" class=" form-label">Desviascion media</label>
                 <input type="text" name="" id="" class=" form-control"
                     value="{{ $desviacionM }}" readonly>
             </div>
    
    
             <div class=" col-4">
                 <label for="" class=" form-label">Desviascion estandar</label>
                 <input type="text" name="" id="" class=" form-control"
                     value="{{ $estandarD }}" readonly>
             </div>
         </div>
     </div>
    </div>
    
    </form>
    
    <div class=" col-12 pt-5">
    <h2>Tabla de distribucion de frecuencias agrupados</h2>
    </div>
    
    <div class=" col-12">
    <table class="table table-bordered table-hover">
     <thead>
         <tr class=" table-danger">
             <th scope="col">Datos</th>
             <th scope="col">f</th>
             <th scope="col">F</th>
             <th scope="col">fi</th>
             <th scope="col">Fi</th>
             <th scope="col">fr</th>
             <th scope="col">Fr</th>
         </tr>
     </thead>
     <tbody>
         @php
             $F = 0;
             $Fi = 0;
             $fi = 0;
             $fr = 0;
             $Fr = 0;
    
         @endphp
         @foreach ($frequency as $key => $item)
             <tr>
                 @php
                     $F = $F + $item;
                     $fi = $item / $n;
                     $Fi = $F / $n;
                     $fr = $fi * 100;
                     $Fr = $Fr + $fr;
                     $Fr = round(floatval($Fr), 3);
                     $fr = round(floatval($fr), 3);
                     $fi = round(floatval($fi), 3);
                     $Fi = round(floatval($Fi), 3);
                 @endphp
    
                 <th scope="row">{{ $key }}</th>
                 <td>{{ $item }}</td>
                 <td>{{ $F }}</td>
                 <td>{{ $fi }}</td>
                 <td>{{ $Fi }}</td>
                 <td>{{ $fr }}%</td>
                 <td>{{ $Fr }}%</td>
             </tr>
         @endforeach
     </tbody>
    </table>
    </div>
    </div> 
    @php
    } catch (\Throwable $th) {
    
    }
    @endphp
    @endif
</div>
@endsection
