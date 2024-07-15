@extends('layouts.app')
        {{-- Cuerpo de la calculadora --}}

@section('Content')
    @if ($operacion == 0)
    <div></div>
@endif

@if ($operacion == 1)
    <div class="pt-4 container ps-5">
        <div class="row">
            <div class=" col-12">
                <form action="{{ route('media') }}" method="post" class="d-flex flex-column">
                    @csrf
                    <h2>Calculadora de media</h2>
                    <label for="datos">Ingresa los datos a calcular separados por una coma ","</label>
                    <input type="text" name="datos" id="" class=" form-control mb-4">
                    <button type="submit" class=" btn btn-danger">Calcular</button>
                    <label for="">Resultado</label>
                    <input type="text" name="" id="" value="{{ $promedio }}" class=" form-control">
                </form>
            </div>
        </div>
    </div>
@endif

@if ($operacion == 2)
    <div class="pt-4 container ps-5">
        <div class="row">
            <div class=" col-12">
                <form action="{{ route('mediana') }}" method="post" class="d-flex flex-column">
                    @csrf
                    <h2>Calculadora de mediana</h2>
                    <label for="datos">Ingresa los datos a calcular separados por una coma ","</label>
                    <input type="text" name="datos" id="" class=" form-control mb-4">
                    <button type="submit" class=" btn btn-danger">Calcular</button>
                    <label for="">Resultado</label>
                    <input type="text" name="" id="" value="{{ $mediana }}" class=" form-control">
                </form>
            </div>
        </div>
    </div>
@endif

@if ($operacion == 3)
    <div class="pt-4 container ps-5">
        <div class="row">
            <div class=" col-12">
                <form action="{{ route('moda') }}" method="post" class="d-flex flex-column">
                    @csrf
                    <h2>Calculadora de Moda</h2>
                    <label for="datos">Ingresa los datos a calcular separados por una coma ","</label>
                    <input type="text" name="datos" id="" class=" form-control mb-4">
                    <button type="submit" class=" btn btn-danger">Calcular</button>
                    <label for="">Resultado</label>
                    <input type="text" name="" id="" value="{{ $moda }}" class=" form-control">
                </form>
            </div>
        </div>
    </div>
@endif

@if ($operacion == 4)
    <form action="{{ route('muestra') }}" method="post" class="container pt-4 m-0 ps-5">
        @csrf

        <div class=" row pb-4">
            <div class="col-12">
                <h2>Calculadora de tamaño de muestra</h2>
            </div>

        </div>
        <div class=" row pb-4 border border-3 border-top-0 border-start-0 border-end-0">
            <div class="col-12 d-flex justify-content-around align-items-end text-center">

                <div class="ps-3 pe-3">
                    <label for="" class=" form-label">Tamaño de poblacion</label>
                    <input type="number" name="poblacion" id="" placeholder="N"
                        class=" form-control text-center">
                </div>

                <h3 class=" ps-3 pe-3">*</h3>

                <div>
                    <label for="" class=" form-label">Nivel de confianza</label>
                    <select name="confianza_1" id="" class=" form-select">
                        <option value="1.645">90%</option>
                        <option value="1.96">95%</option>
                        <option value="2.576">99%</option>
                    </select>
                </div>

                <h3 class=" ps-3 pe-3">*</h3>

                <div>
                    <label for="" class=" form-label">Probabilidad de que suceda</label>
                    <input type="text" name="probabilidadP_1" id="" class=" form-control">
                </div>

                <h3 class=" ps-3 pe-3">*</h3>

                <div>
                    <label for="" class=" form-label">Probabilidad de que no suceda</label>
                    <input type="text" name="probabilidadN_1" id="" class=" form-control">
                </div>
            </div>
        </div>



        <div class="pb-3 row pt-4">
            <div class="col-12 d-flex justify-content-around align-items-end text-center">
                <div class="">
                    <label for="" class=" form-label ">Margen de error</label>
                    <input type="text" name="margenR" id="" placeholder="e^2"
                        class=" form-control text-center ">
                </div>

                <div class=" ps-2 pe-2">
                    <h3>*</h3>
                </div>

                <div class="w-auto ">
                    <label for="" class=" form-label ">Tamaño de poblacion - 1</label>
                    <input type="number" name="poblacion_1" id="" placeholder="N-1"
                        class=" form-control text-center ">
                </div>

                <div class=" ps-2 pe-2">
                    <h3>+</h3>
                </div>

                <div class="w-auto ">
                    <label for="" class=" form-label ">Nivel de confianza</label>
                    <select name="confianza_2" id="" class=" form-select">
                        <option value="1.645">90%</option>
                        <option value="1.96">95%</option>
                        <option value="2.576">99%</option>
                    </select>
                </div>

                <div class=" ps-2 pe-2">
                    <h3>*</h3>
                </div>

                <div class="w-auto ">
                    <label for="" class=" form-label ">Probabilidad de que suceda</label>
                    <input type="text" name="probabilidadP_2" id="" class=" form-control">
                </div>

                <div class=" ps-2 pe-2">
                    <h3>*</h3>
                </div>

                <div class="w-auto">
                    <label for="" class=" form-label ">Probabilidad de que no suceda</label>
                    <input type="text" name="probabilidadN_2" id="" class=" form-control">
                </div>
            </div>

            <div class="row pt-5">
                <div class=" col-12">
                    <label for="" class=" form-label">Tamaño de muestra</label>
                    <input type="text" value="{{ $muestra }}" class=" form-control">
                </div>
            </div>

            <div class="row  pt-4 d-flex justify-content-center align-items-center">
                <div class="col-3 pe-4 d-flex justify-content-end">
                    <button class=" btn btn-danger w-100" type="submit">Calcular</button>
                </div>

            </div>
        </div>
    </form>
</div>
@endif
@endsection