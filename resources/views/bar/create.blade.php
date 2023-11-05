@extends('layouts.app')

@section('content')
    <div class="container" style="margin-top: 20px;">

        <form action="{{ url('/bars') }}" method="post" enctype="multipart/form-data"><br>
            @csrf
            @include('bar.form', ['modo' => 'Añadir'])
            <a href="{{ url('bars/') }}" class="btn btn-primary"><i class="fa fa-fw fa-lg fa-arrow-left"></i>Regresar</a>

            <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i> Añadir bar</button>

        </form>
    </div>
@endsection
