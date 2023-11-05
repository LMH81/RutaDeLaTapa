@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: 20px;">

<form action="{{url('/tapa/'.$tapa->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    {{method_field('PATCH')}}

    @include('tapa.form',['modo'=>'Editar'])
    <a href="{{ url('tapa/')}}" class="btn btn-primary"><i class="fa fa-fw fa-lg fa-arrow-left"></i>Regresar</a>  

<button class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i> Editar Tapa</button>

</form>
</div>
@endsection

