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

    </div>
</div>