@extends('layouts.app')

@section('Content')
    <div class=" container pt-4 ps-5">
        <div class=" row">

            <div class=" col-12">
                <h2>Calcular Coeficiente de Bowley</h2>
            </div>

            <form action="{{ route('Bowley') }}" method="post" class=" col-12">
                @csrf
                <div class=" row">
                    <div class=" col-9">
                        <label for="data" class=" form-label">Por favor introduzca los datos separados por una coma
                            ","</label>
                        <input type="text" name="data" id="data" class=" form-control">
                    </div>

                    <div class=" col-3 d-flex align-items-end">
                        <button class=" btn btn-danger w-75">Calcular</button>
                    </div>
                </div>
            </form>

            <div class=" col-6 pt-2">
                <label for="result" class=" form-label">Resultado</label>
                <input type="text" name="" id="result" value="{{ $result }}" class=" form-control">
            </div>
        </div>
    </div>
@endsection
