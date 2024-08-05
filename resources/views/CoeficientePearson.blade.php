@extends('layouts.app')

@section('Content')
    <div class=" container pt-4 ps-5">
        <div class=" row">
            <form action="{{ route('Pearson') }}" method="POST" class=" col-12">
                @csrf
                <div class=" row">
                    <div class=" col-12">
                        <h2>Calcular coeficiente de Pearson</h2>
                    </div>
                    <div class=" col-9">
                        <p>Por favor introduzca los datos separados por una coma
                            "," e ingrese el mismo numero de datos para ambas variables</p>
                    </div>
                    <div class=" col-9">
                        <label for="" class=" form-label">Variable 1</label>
                        <input type="text" name="data1" id="" class=" form-control"
                            oninput="validarInput(event)">
                    </div>
                    <div class=" col-3 d-flex align-items-end">
                        <button class=" btn btn-danger w-75">Calcular</button>
                    </div>
                    <div class=" col-9 pt-2">
                        <label for="" class=" form-label">Variable 2</label>
                        <input type="text" name="data2" id="" class=" form-control"
                            oninput="validarInput(event)">
                    </div>


                    <div class=" col-6 pt-2 ">
                        <label for="result" class=" form-label">Resultado</label>
                        <input type="text" name="result" id="result" class=" form-control"
                            value="{{ $pearson }}">
                    </div>

                </div>
            </form>

            <div class=" col-12 pt-4">
                <b>Interpretación:</b> <br>
                Si r es cercano a 1, existe una fuerte correlación positiva (a medida que x aumenta, y tiende a aumentar).
                <br>
                Si r es cercano a -1, existe una fuerte correlación negativa (a medida que x aumenta, y tiende a disminuir).
                <br>
                Si r es cercano a 0, no hay una correlación lineal aparente entre x e y.
            </div>
        </div>
    </div>
@endsection
