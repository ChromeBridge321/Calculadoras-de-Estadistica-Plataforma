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
                                <a href="{{ url('/tablas-de-distribucion-de-frecuencias/datos/agrupados') }}"
                                    class=" link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover ">Datos
                                    agrupados</a>
                            </div>
                            <div class=" w-100 ps-3 pb-2">
                                <a href="{{ url('/tablas-de-distribucion-de-frecuencias/datos/no-agrupados') }}"
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

        <div class=" container pt-4 ps-5 pe-5">
            <div class=" row">

                <form class=" col-12" action="{{ route('tablas') }}" method="post">
                    @csrf
                    <button type="submit">enviar</button>
                    <input type="checkbox" name="tipo" id="" class=" form-check-input" checked>
                    
                    <div class=" row">
                        <div class=" col-12">
                            <label for="" class=" form-label">Datos</label>
                            <input type="" name="datos" id="" class=" form-control">
                        </div>

                        <div class=" col-12">
                            <div class=" row">
                                <div class=" col-4">
                                    <label for="" class=" form-label">Media</label>
                                    <input type="text" name="" id="" class=" form-control" value="{{$media}}">
                                </div>



                                <div class=" col-4">
                                    <label for="" class=" form-label">Mediana</label>
                                    <input type="text" name="" id="" class=" form-control" value="{{$mediana}}">
                                </div>



                                <div class=" col-4">
                                    <label for="" class=" form-label">Moda</label>
                                    <input type="text" name="" id="" class=" form-control" value="{{$moda}}">
                                </div>



                                <div class=" col-4">
                                    <label for="" class=" form-label">Varianza</label>
                                    <input type="text" name="" id="" class=" form-control">
                                </div>


                                <div class=" col-4">
                                    <label for="" class=" form-label">Desviascion media</label>
                                    <input type="text" name="" id="" class=" form-control">
                                </div>


                                <div class=" col-4">
                                    <label for="" class=" form-label">Desviascion estandar</label>
                                    <input type="text" name="" id="" class=" form-control">
                                </div>
                            </div>
                        </div>
                    </div>

                </form>

                <div class=" col-12 pt-5">
                    <h2>Tabla de distribucion de frecuencias</h2>
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
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                                <td>@mdo</td>
                                <td>@mdo</td>
                                <td>@mdo</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<script src="{{ asset('js/bootstrap.js') }}"></script>
