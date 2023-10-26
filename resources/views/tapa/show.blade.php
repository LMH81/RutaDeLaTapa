@extends('layouts.app')

@section('template_title')
    {{ $tapa->name ?? __('Detalle') }}
@endsection


@section('content')
    <section class="content container-fluid h-100">

        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-md-5 mb-3">
                <div class="d-flex justify-content-start align-items-center mt-2 ml-2">
                    <a class="btn btn-primary" href="{{ route('tapa') }}"> {{ __('Regresar') }}</a>
                </div>
            </div>
        </div>
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <strongs>{{ __('Detalle') }} Tapa </strong>
                        </div>

                    </div>


                    <div class="card-body">

                        <div class="form-group">
                            <strong>Tapa_id:</strong>
                            {{ $tapa->id }}
                        </div>

                        <div class="form-group">


                            <img class="img-fluid img-thumbnail" src="{{ asset('storage' . '/' . $tapa->img) }}" width="200px"
                                alt="">

                        </div>
                        <div class="form-group">
                            <strong>Nombre: </strong>
                            {{ $tapa->name }}
                        </div>
                        <div class="form-group">
                            <strong>Descripción: </strong>
                            {{ $tapa->description }}
                        </div>
                        <div class="form-group">
                            <strong>Precio: </strong>
                            {{ $tapa->price }} €
                        </div>


                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
