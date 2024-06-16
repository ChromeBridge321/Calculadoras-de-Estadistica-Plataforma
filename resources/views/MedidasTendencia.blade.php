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
                                <a href="{{url('/medididas-de-tendencia-central/media')}}"
                                    class=" link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover ">Calculadora
                                    de media</a>

                            </div>
                            <div class=" w-100 ps-3 pb-2">
                                <a href="{{url('/medididas-de-tendencia-central/mediana')}}"
                                    class=" link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover ">Calculadora
                                    de mediana</a>
                            </div>
                            <div class=" w-100 ps-3 pb-2">
                                <a href="{{url('/medididas-de-tendencia-central/moda')}}"
                                    class=" link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover ">Calculadora
                                    de moda</a>
                            </div>

                            <div class=" w-100 ps-3 pb-2">
                                <a href=""
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
                                <a href=""
                                    class=" link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover ">Datos
                                    agrupados</a>
                            </div>
                            <div class=" w-100 ps-3 pb-2">
                                <a href=""
                                    class=" link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover ">Datos
                                    no agrupados</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Accordion Item #3
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            a
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                            Accordion Item #4
                        </button>
                    </h2>
                    <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            a
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
                    <form action="{{route('media')}}" method="post" class="d-flex flex-column">
                        @csrf
                        <h2>Calculadora de media</h2>
                        <label for="datos">Ingresa los datos a calcular separados por una coma ","</label>
                        <input type="text" name="datos" id="">
                        <button type="submit">Calcular</button>
                        <label for="">Resultado</label>
                        <input type="text" name="" id="" value="{{$promedio}}">
                    </form>
                </div>
            </div>
        </div>  
        @endif

        @if ($operacion == 2)
        <div class="pt-4 container">
            <div class="row">
                <div class=" col-12">
                    <form action="{{route('mediana')}}" method="post" class="d-flex flex-column">
                        @csrf
                        <h2>Calculadora de mediana</h2>
                        <label for="datos">Ingresa los datos a calcular separados por una coma ","</label>
                        <input type="text" name="datos" id="">
                        <button type="submit">Calcular</button>
                        <label for="">Resultado</label>
                        <input type="text" name="" id="" value="{{$mediana}}">
                    </form>
                </div>
            </div>
        </div>  
        @endif

        @if ($operacion == 3)
        <div class="pt-4 container">
            <div class="row">
                <div class=" col-12">
                    <form action="{{route('moda')}}" method="post" class="d-flex flex-column">
                        @csrf
                        <h2>Calculadora de Moda</h2>
                        <label for="datos">Ingresa los datos a calcular separados por una coma ","</label>
                        <input type="text" name="datos" id="">
                        <button type="submit">Calcular</button>
                        <label for="">Resultado</label>
                        <input type="text" name="" id="" value="{{$moda}}">
                    </form>
                </div>
            </div>
        </div>  
        @endif
</body>

</html>
<script src="{{ asset('js/bootstrap.js') }}"></script>
