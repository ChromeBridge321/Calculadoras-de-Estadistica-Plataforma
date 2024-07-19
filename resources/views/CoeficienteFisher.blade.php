@extends('layouts.app')
@section('Content')
    <div class=" container pt-4 ps-5">
        <div class=" row">
            <div class=" col-12">
                <h2>Calcular coeficiente de Fisher</h2>
            </div>

            <form action="{{ route('Fisher') }}" method="post" class=" row">
                @csrf
                <div class=" col-10">
                    <label for="data" class=" form-label">Porfavor ingrese los datos separados por una coma ","</label>
                    <input type="text" name="data" id="data" class=" form-control" oninput="validarInput(event)">
                </div>

                <div class=" col d-flex align-items-end justify-content-center">
                    <button class=" btn btn-danger w-75" type="submit">Calcular</button>
                </div>
            </form>

            <div class=" col-6">
                <div class=" row">
                    <div class=" col-12 pt-2">
                        <label for="result" class=" form-label">Resultado</label>
                        <input type="text" name="" id="result" class=" form-control"
                            value="{{ $result[1] }}">
                    </div>

                    <div class="col-12 pt-2">
                        <label for="categoria" class=" form-label">Categoria</label>
                        <input type="text" name="" id="categoria" value="{{$result[0]}}" class=" form-control">
                    </div>

                    <div class=" col-12 pt-4">
                        <h5>Posibles resultados</h5>
                    </div>

                    <div class=" col-12">
                        <img src="https://seactuario.com/ContMatematicas/ProbEstadistica/probimages/asimetria.png"
                            alt="" class=" w-100">
                    </div>
                </div>
            </div>

            @if ($result[2] == "2")
            <div class=" col-6" style="text-align: justify">
                <div class=" w-100 ps-2 pe-2">
                    <br>
                    <br>
                    <h4>Interpretacion del resultado:</h4>
                    <p>
                        <b>Coeficiente de Asimetría Positivo (γ > 0)</b>
                        <br>
                        <br>
                        <b>Significado: </b>Una asimetría positiva indica que la cola de la distribución se extiende más
                        hacia la
                        derecha.
                        <br>
                        <b>Interpretación Visual:</b> La distribución tiene una cola larga hacia la derecha y la mayoría de
                        los datos
                        se concentran en el lado izquierdo.
                        <br>
                        <b>Ejemplo:</b> Ingresos de una población donde pocos individuos tienen ingresos extremadamente
                        altos.
                        <br>
                        <br>
                        Puede indicar que hay valores extremos altos en el conjunto de datos, como ingresos, precios de
                        propiedades, etc.
                    </p>
                </div>
            </div>    
            @endif


@if ($result[2] == "3")
<div class=" col-6" style="text-align: justify">
    <div class=" w-100 ps-2 pe-2">
        <br>
        <br>
        <h4>Interpretacion del resultado:</h4>
        <p>
            <b>Coeficiente de Asimetría Positivo (γ > 0)</b>
            <br>
            <br>
            <b>Significado: </b>Una asimetría negativa indica que la cola de la distribución se extiende más
            hacia
            la izquierda.
            <br>
            <b>Interpretación Visual:</b> La distribución tiene una cola larga hacia la izquierda y la mayoría
            de
            los datos se concentran en el lado derecho.
            <br>
            <b>Ejemplo:</b> Edad de jubilación en una empresa donde la mayoría de los empleados se jubilan
            alrededor de la misma edad, pero algunos se jubilan mucho más temprano.
            <br>
            <br>
            Puede sugerir la presencia de valores extremos bajos, como puntuaciones de exámenes en una prueba
            difícil donde pocos alumnos sacan notas muy bajas.
        </p>
    </div>
</div>  
@endif

@if ($result[2] == "1")
<div class=" col-6" style="text-align: justify">
    <div class=" w-100 ps-2 pe-2">
        <br>
        <br>
        <h4>Interpretacion del resultado:</h4>
        <p>
            <b>Coeficiente de Asimetría Igual a Cero (γ = 0)</b>
            <br>
            <br>
            <b>Significado: </b>Un coeficiente de asimetría igual a cero indica que la distribución es
            simétrica.
            <br>
            <b>Interpretación Visual:</b> La distribución tiene colas igualmente largas a ambos lados de la
            media, y los datos se distribuyen de manera uniforme a ambos lados.
            <br>
            <b>Ejemplo:</b> Altura de una población donde la distribución es perfectamente simétrica alrededor
            de la media.
            <br>
            <br>
            Es común en muchas distribuciones naturales y teóricas, como la distribución normal.
        </p>
    </div>
</div>   
@endif

        </div>
    </div>
@endsection
