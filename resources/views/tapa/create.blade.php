@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: 20px;">

<form action="{{ url('/tapa')}}" method="post" enctype="multipart/form-data"><br> 
@csrf
@include('tapa.form',['modo'=>'Añadir'])
<a href="{{ url('tapa/')}}" class="btn btn-primary"><i class="fa fa-fw fa-lg fa-arrow-left"></i>Regresar</a>  

<button class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i> Añadir Tapa</button>
   
</form>
</div>
@endsection