@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-8">
            <h1 class="m-0">Asigna Tapa</h1>
        </div>
    </div>
</div>

<div class="container mt-2">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">

                    <form method="POST" action="{{route('bar_tapa.store')}}">
                        @csrf
                       
                        
                        {{-- <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" name="name" id="name" class="form-control {{$errors->has('name') ? 'is-invalid' : ''}}" placeholder="Ingrese el nombre de la tapa" value="{{old('name', '')}}">
                            @if ($errors->has('name'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                        </div> --}}


                        <div class="form-group">
                            <label for="bars">Tapas</label>
                            <select class="form-control select2" name="tapas[]" id="bars" multiple required>
                                @foreach($tapas as $id => $tapa)
                                <option value="{{ $id }}">{{ $tapa }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('tapas'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('tapas') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="bars">Bares</label>
                            <select class="form-control select2" name="bars[]" id="bars" multiple required>
                                @foreach($bars as $id => $bar)
                                <option value="{{ $id }}">{{ $bar }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('bars'))
                            <span class="text-danger">
                                <strong>{{ $errors->first('bars') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="row d-print-none mt-2">
                            <div class="col-12 text-right">
                                <a class="btn btn-danger" href="{{route('bar_tapa')}}">
                                    <i class="fa fa-fw fa-lg fa-arrow-left"></i>
                                    Regresar
                                </a>
                                <button class="btn btn-success" type="submit">
                                    <i class="fa fa-fw fa-lg fa-check-circle"></i>Guardar
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        $('.select2').select2()
    })
</script>
@endsection