@extends('layouts.app')

@section('Content')
    <div class=" container pt-4 ps-5">
        <div class=" row">
            <div class=" col-12">
                <h2>Calcular coeficiente de curtosis</h2>
            </div>

            <form action="{{route('Curtosis')}}" method="post" class=" col-12">
                @csrf
                <div class=" row">
                    <div class=" col-9">
                        <label for="data" class=" form-label">Por favor introduzca los datos separados por una coma
                            ","</label>
                        <input type="text" name="data" id="data" class=" form-control">
                    </div>

                    <div class=" col-3 d-flex align-items-end">
                        <button type="submit" class=" btn btn-danger w-75">Calcular</button>
                    </div>

                    <div class=" col-6 pt-2">
                        <label for="result" class=" form-label">Tamaño de muestras</label>
                        <input type="text" name="result" id="result" class=" form-control" value="{{$n}}">
                    </div>
                    <div class=" col-6"></div>

                    <div class=" col-6 pt-2">
                        <label for="result" class=" form-label">Media</label>
                        <input type="text" name="result" id="result" class=" form-control" value="{{$median}}">
                    </div>
                    <div class=" col-6"></div>

                    <div class=" col-6 pt-2">
                        <label for="result" class=" form-label">Varianza</label>
                        <input type="text" name="result" id="result" class=" form-control" value="{{$variance}}">
                    </div>
                    <div class=" col-6"></div>

                    <div class=" col-6 pt-2">
                        <label for="result" class=" form-label">Desviacion estandar</label>
                        <input type="text" name="result" id="result" class=" form-control" value="{{$desviation}}">
                    </div>
                    <div class=" col-6"></div>

                    <div class=" col-6 pt-2">
                        <label for="result" class=" form-label">Resultado</label>
                        <input type="text" name="result" id="result" class=" form-control" value="{{$curtosis}}">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
