@extends('layouts.app')

@section('template_title')
    {{ $bar->name ?? "{{ __('Detalle') Bar" }}
@endsection

@section('content')
    <section class="content container-fluid h-100" style="margin-top: 20px;">

        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <strong>{{ __('Detalle') }} Bar </strong>
                        </div>

                    </div>

                    <div class="card-body">

                        {{-- <div class="form-group mb-1">
                            <strong>Bar Id:</strong>
                            {{ $bar->id }}
                        </div> --}}
                        <div class="form-group mb-1">
                            <strong>Nombre: </strong>
                            <strong> {{ $bar->name }} </strong>
                        </div>
                        <div class="form-group mb-1">
                            <strong>Descripción: </strong>
                            {{ $bar->description }}
                        </div>
                        <div class="form-group mb-1">
                            <strong>Dirección: </strong>
                            {{ $bar->address }}
                        </div>
                        <div class="form-group mb-1">
                            <strong>Teléfono: </strong>
                            {{ $bar->phone }}
                        </div>
                        <div class="form-group mb-1">
                            <strong>Horario: </strong>
                            {{ $bar->opening_hours }}
                        </div>

                    </div>

                </div>
            </div>

        </div>
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-md-5 mb-3">
                <div class="d-flex justify-content-start align-items-center mt-2 ml-2">
                    <a class="btn" style="background-color: var(--bs-blue); color: white;"
                        href="{{ route('bar.index') }}"><i class="fa fa-fw fa-lg fa-arrow-left"></i>
                        {{ __('Regresar') }}</a>
                </div>
            </div>
        </div>
    </section>
@endsection
