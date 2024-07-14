<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <title>Document</title>
</head>

<body>
    <nav class=" pt-2 pb-2 " style="background-color: #DE1141;">
        <div class="container-fluid">
            <div class="row">
                <div class=" col-6">
                    <img src="{{ asset('images/logo.png') }}" alt="" class=" img-fluid"
                        style="width: 60px; height: 60px;">
                </div>

                <div class=" col-6 d-flex justify-content-end align-items-center text-white pe-4">
                    <h2>StatSolver</h2>
                </div>
            </div>
        </div>
    </nav>
    <div class=" container-fluid d-flex p-0">
        {{-- Barra de navegacion --}}
        <div class=" border border-2 border-end " style="width: 300px; height: 100vh;">
            <div class="accordion accordion-flush" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            Medidas de tendencia central
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse add" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class=" w-100 ps-3 pb-2 pt-2">
                                <a href="{{ url('/medididas-de-tendencia-central/media') }}"
                                    class=" link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover ">Calculadora
                                    de media</a>

                            </div>
                            <div class=" w-100 ps-3 pb-2">
                                <a href="{{ url('/medididas-de-tendencia-central/mediana') }}"
                                    class=" link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover ">Calculadora
                                    de mediana</a>
                            </div>
                            <div class=" w-100 ps-3 pb-2">
                                <a href="{{ url('/medididas-de-tendencia-central/moda') }}"
                                    class=" link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover ">Calculadora
                                    de moda</a>
                            </div>

                            <div class=" w-100 ps-3 pb-2">
                                <a href="{{ url('/medididas-de-tendencia-central/muestra') }}"
                                    class=" link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover ">Calculadora
                                    de muestra</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Tabla de distribucion de frecuencias
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class=" w-100 ps-3 pb-2">
                                <a href="{{url('/tablas-de-distribucion-de-frecuencias/datos/agrupados')}}"
                                    class=" link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover ">Datos
                                    agrupados</a>
                            </div>
                            <div class=" w-100 ps-3 pb-2">
                                <a href="{{url('/tablas-de-distribucion-de-frecuencias/datos/no-agrupados')}}"
                                    class=" link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover ">Datos
                                    no agrupados</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        {{-- Cuerpo de la calculadora --}}


        @if ($operacion == 0)
            <div></div>
        @endif

        @if ($operacion == 1)
            <div class="pt-4 container">
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
            <div class="pt-4 container">
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
            <div class="pt-4 container">
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
            <form action="{{ route('muestra') }}" method="post" class="container pt-4">
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
</body>

</html>
<script src="{{ asset('js/bootstrap.js') }}"></script>
