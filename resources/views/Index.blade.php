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

    <div class=" container-fluid mt-5">
        <div class="row">
            <div class=" col-7 d-flex justify-content-center align-items-start flex-column ps-4 pe-4">
                <div>
                    <h1 class="">StatSolver</h1>
                </div>
                <div class=" pb-3">
                    <p class=" fs-3 text-secondary">Calculadora de problemas de probabilidad y estadística. Resuelve y
                        aprende cómo
                        funcionan los problemas más comunes en probabilidad y estadística.</p>
                </div>
                <div>
                    <a href="{{ url('/list') }}" class=" btn btn-danger btn-lg">Ver calculadoras</a>
                </div>

            </div>
            <div class=" col-5 d-flex justify-content-center align-items-center">
                <img src="{{ asset('images/studing.png') }}" alt="" class=" img-fluid">
            </div>

        </div>
    </div>
    <footer class=" h-100 " style="background-color:#F4F4F4;">

        <div class=" col-12 d-flex justify-content-center align-items-center pt-2 p-0">
            <img src="{{ asset('images/logo2.png') }}" alt="" class=" img-fluid"
                style="width: 200px; backgroud-color:#F4F4F4;">

        </div>
        <br>
        <br>
        <br>
        <br>

    </footer>
</body>

</html>
<script src="{{ asset('js/bootstrap.js') }}"></script>
