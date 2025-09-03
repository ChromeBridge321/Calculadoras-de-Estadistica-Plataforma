<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto+Slab:wght@100..900&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <title>Calculadoras</title>
    <link rel="icon" type="images/png" href="https://calculadoras-de-estadistica-plataforma.onrender.com/images/logo.png">
</head>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
   function validarInput(event) {
    const input = event.target;
    const valor = input.value;

    // Permitir solo números, comas y puntos
    if (!/^[0-9,\.]*$/.test(valor)) {
        input.value = valor.slice(0, -1);
        return;
    }

    // No permitir dos comas seguidas
    if (valor.includes(",,")) {
        input.value = valor.replace(",,", ",");
        return;
    }

    // No permitir dos puntos seguidos
    if (valor.includes("..")) {
        input.value = valor.replace("..", ".");
        return;
    }

    // No permitir que el primer caracter sea una coma
    if (valor.startsWith(",")) {
        input.value = valor.slice(1);
        return;
    }

    // No permitir que el primer caracter sea un punto
    if (valor.startsWith(".")) {
        input.value = valor.slice(1);
        return;
    }
}
function validateInput() {
            const inputField = document.getElementById('inputField');
            let value = inputField.value;

            // Eliminar cualquier carácter que no sea una letra, una coma o un espacio
            value = value.replace(/[^a-zA-Z, ]/g, '');

            // No permitir iniciar con una coma o espacio
            if (value.charAt(0) === ',' || value.charAt(0) === ' ') {
                value = value.slice(1);
            }

            // No permitir comas consecutivas o espacios consecutivos
            value = value.replace(/,{2,}/g, ',');  // Reemplaza dobles comas con una sola coma
            value = value.replace(/ {2,}/g, ' ');  // Reemplaza dobles espacios con un solo espacio

            // No permitir una coma justo después de un espacio o un espacio justo después de una coma
            value = value.replace(/, /g, ',');  // Elimina el espacio después de una coma
            value = value.replace(/ ,/g, ',');  // Elimina el espacio antes de una coma

            // Actualizar el valor del campo de entrada
            inputField.value = value;
        }
</script>


<body>
    <nav class=" pt-2 pb-2 " style="background-color: #DE1141;">
        <div class="container-fluid">
            <div class="row">
                <div class=" col-6">
                    <a href="{{ url('/') }}"> <img src="{{ asset('images/logo.png') }}" alt=""
                            class=" img-fluid" style="width: 60px; height: 60px;"></a>
                </div>

                <div class=" col-6 d-flex justify-content-end align-items-center text-white pe-4">
                    <h2>StatSolver</h2>
                </div>
            </div>
        </div>
    </nav>

    <div class=" d-flex">
        <div class=" border border-2 border-end" style="width: 300px; height: 100vh;">
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
                                    class=" link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover ">Media</a>

                            </div>
                            <div class=" w-100 ps-3 pb-2">
                                <a href="{{ url('/medididas-de-tendencia-central/mediana') }}"
                                    class=" link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover ">Mediana</a>
                            </div>
                            <div class=" w-100 ps-3 pb-2">
                                <a href="{{ url('/medididas-de-tendencia-central/moda') }}"
                                    class=" link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover ">Moda</a>
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
                                    class=" link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover ">Datos no agrupados</a>
                            </div>
                            <div class=" w-100 ps-3 pb-2">
                                <a href="{{ url('/tablas-de-distribucion-de-frecuencias/datos/no-agrupados') }}"
                                    class=" link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover ">Datos agrupados</a>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Medidas de Posicion
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class=" w-100 ps-3 pb-2">
                                <a href="{{ url('/Medidas-de-posicion/cuartiles') }}"
                                    class=" link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover ">Cuartiles</a>
                            </div>
                            <div class=" w-100 ps-3 pb-2">
                                <a href="{{ url('/Medidas-de-posicion/deciles') }}"
                                    class=" link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover ">Deciles</a>
                            </div>
                            <div class=" w-100 ps-3 pb-2">
                                <a href="{{ url('/Medidas-de-posicion/percentiles') }}"
                                    class=" link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover ">Percentiles</a>
                            </div>
                        </div>
                    </div>


                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                            Calculadoras extras
                        </button>
                    </h2>
                    <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class=" w-100 ps-3 pb-2">
                                <a href="{{ url('/Calculadoras-extras/Coeficiente-de-Fisher') }}"
                                    class=" link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover ">Asimetria
                                    de Fisher
                                </a>
                            </div>
                            <div class=" w-100 ps-3 pb-2">
                                <a href="{{ url('/Calculadoras-extras/Coeficiente-de-Bowley') }}"
                                    class=" link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover ">Coeficiente
                                    de Bowley
                                </a>
                            </div>
                            <div class=" w-100 ps-3 pb-2">
                                <a href="{{ url('/Calculadoras-extras/Coeficiente-de-Pearson') }}"
                                    class=" link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover ">Correlación
                                    de Pearson
                                </a>
                            </div>
                            <div class=" w-100 ps-3 pb-2">
                                <a href="{{ url('/Calculadoras-extras/Coeficiente-de-curtosis') }}"
                                    class=" link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover ">Curtosis
                                </a>
                            </div>
                            <div class=" w-100 ps-3 pb-2">
                                <a href="{{ url('/Calculadoras-extras/Grafica-de-pareto') }}"
                                    class=" link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover ">Grafica de pareto
                                </a>
                            </div>
                        </div>
                    </div>


                </div>
            </div>

        </div>
        @yield('Content')
    </div>
</body>

</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>

