@extends('layouts.app')
@section('Content')
    <div class="ps-5 container pt-4">
        <div class=" row">
            <form action="{{ route('Decile') }}" method="post" class=" col-12" id="myForm">
                @csrf

                <div class=" row">
                    <div class=" col-12">
                        <h2>Calculadora de Deciles</h2>
                    </div>


                    <div class=" col-7">
                        <label for="" class=" form-label">Porfavor separe los numeros mediate una coma ","</label>
                        <input type="text" name="data" id="data" class=" form-control w-100" oninput="validarInput(event)">
                        <input type="text" name="operation" value="2" class=" d-none" oninput="validarInput(event)">
                    </div>

                    <div class=" col-3">
                        <label for="" class=" form-label">Numero de decil</label>
                        <select name="number" id="" class=" form-select">
                            @for ($i = 1; $i < 10; $i++)
                            <option value="{{$i}}">{{$i}}</option>
                            @endfor
                        </select>
                    </div>

                    <div class=" col-2 d-flex align-items-end">
                        <button type="submit" class=" btn btn-danger w-75">Calcular</button>
                    </div>

                    <div class=" col-7 pt-2">
                        <label for="">Cadena acomodada</label>
                        <input type="text" name="" id="" value="{{ $data }}"
                            class=" form-control w-100">
                    </div>

                    <div class=" col-7 pt-2">
                        <label for="">Posicion</label>
                        <input type="text" name="" id="" class=" form-control w-100"
                            value="{{ $position }}">
                    </div>

                    <div class=" col-7 pt-2">
                        <label for="">Resultado</label>
                        <input type="text" name="" id="" class=" form-control w-100"
                            value="{{ $result }}">
                    </div>
                </div>
            </form>
        </div>
        <div class=" col-12 pt-3">
            <h5>Para obtener un mejor resultado es recomendable ingresar al menos 10 datos</h5>
        </div>
    </div>
@endsection
