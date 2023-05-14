@extends('layouts.app')

@section('content')
<div class="container">

<form action="{{ url('/bars')}}" method="post" enctype="multipart/form-data"><br> 
@csrf
@include('bar.form',['modo'=>'Añadir'])
   
</form>
</div>
@endsection
