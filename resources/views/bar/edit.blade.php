@extends('layouts.app')

@section('content')
<div class="container">

<form action="{{url('/bars/'.$bar->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    {{method_field('PATCH')}}

    @include('bar.form',['modo'=>'Editar'])

</form>
</div>
@endsection@
