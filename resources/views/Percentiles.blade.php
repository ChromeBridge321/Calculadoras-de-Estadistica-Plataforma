@extends('layouts.app')
<script>
    function validarInput(event) {
        const input = event.target;
        const valor = input.value;
        const ultimoCaracter = valor[valor.length - 1];

        // Permitir solo números y comas
        if (!/^[0-9,]*$/.test(valor)) {
            input.value = valor.slice(0, -1);
            return;
        }

        // No permitir dos comas seguidas
        if (valor.includes(",,")) {
            input.value = valor.replace(",,", ",");
            return;
        }

        // No permitir que el primer caracter sea una coma
        if (valor.startsWith(",")) {
            input.value = valor.slice(1);
            return;
        }
    }
</script>
@section('Content')
    <div class="ps-5 container pt-4">
        <div class=" row">
            <form action="{{ route('Percentile') }}" method="post" class=" col-12" id="myForm">
                @csrf

                <div class=" row">
                    <div class=" col-12">
                        <h2>Calculadora de Percentiles</h2>
                    </div>


                    <div class=" col-7">
                        <label for="" class=" form-label">Porfavor separe los numeros mediate una coma ","</label>
                        <input type="text" name="operation" id="" value="3" class=" d-none"">
                        <textarea name="data" cols="10" rows="5" class=" form-control" oninput oninput="validarInput(event)"></textarea>
                    </div>

                    <div class=" col-3">
                        <label for="" class=" form-label">Numero de percentil</label>
                        <select name="number" id="" class=" form-select">
                            @for ($i = 1; $i < 100; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>

                        <div class=" w-100 d-flex justify-content-center pt-3">
                            <button type="submit" class=" btn btn-danger w-100">Calcular</button>
                        </div>
                    </div>

                    <div class=" col-7 pt-2">
                        <label for="">Cadena acomodada</label>
                        <textarea  id="" cols="10" rows="7" class=" form-control">{{$data}}</textarea>
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
            <h5>Para obtener un mejor resultado es recomendable ingresar al menos 100 datos</h5>
        </div>
    </div>


@endsection
