@extends('layouts.app')
@php

@endphp
@section('Content')
    <div class="ps-5 container pt-4">
        <div class=" row">
            <form action="{{ route('Quartile') }}" method="post" class=" col-12">
                @csrf
                <div class=" row">
                    <div class=" col-12">
                        <h2>Calculadora de Cuartiles</h2>
                    </div>


                    <div class=" col-7">
                        <label for="" class=" form-label">Porfavor separe los numeros mediate una coma ","</label>
                        <input type="text" name="data" id="" class=" form-control w-100">
                    </div>

                    <div class=" col-3">
                        <label for="" class=" form-label">Numero de cuartil</label>
                        <select name="quartile" id="" class=" form-select">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                    </div>

                    <div class=" col-2 d-flex align-items-end">
                        <button type="submit" class=" btn btn-danger w-75">Calcular</button>
                    </div>

                    <div class=" col-7 pt-2">
                        <label for="">Cadena acomodada</label>
                        <input type="text" name="" id="" value="{{$data}}" class=" form-control w-100">
                    </div>

                    <div class=" col-7 pt-2">
                        <label for="">Posicion</label>
                        <input type="text" name="" id="" class=" form-control w-100" value="{{$position}}">
                    </div>

                    <div class=" col-7 pt-2">
                        <label for="">Resultado</label>
                        <input type="text" name="" id="" class=" form-control w-100"
                            value="{{ $result }}">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
