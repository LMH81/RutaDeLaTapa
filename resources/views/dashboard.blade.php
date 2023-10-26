@extends('layouts.app')

@section('content')

@if (session('status'))
<div class="alert alert-success">
    {{ session('status') }}
</div>
@endif

@if (!request()->hasCookie('cookie_consent'))
<div id="cookie-banner" class="cookie-banner" role="group" aria-label="Acciones">
    <p>Este sitio web utiliza cookies para mejorar su experiencia de usuario y analizar de forma anónima y estadística el uso que hace de la web. Para más información acceda a la <a href="https://www.exteriores.gob.es/es/Paginas/Cookies.aspx" target="_blank">Política de Cookies</a>.<br><br>Al hacer clic en <b>ACEPTAR</b>, usted acepta el uso de todas las cookies.</p><br><br>
    <a href="{{ url('/')}}" class="btn btn-success" id="accept-btn">Aceptar</a>
    <form action="{{ url('/del-cookie')}}" class="d-inline" method="get">
        @csrf
        <input class="btn btn-danger" type="submit" onclick="return confirm('¿Estás seguro?')" value="Rechazar">
    </form>
</div>
@endif

@unlessrole('admin')
<div class="text-center mx-auto my-5">
    <h1>Elije una tapa y vota</h1>
    <p>Bienvenido a la ruta de la tapa</p>
</div>
@endunless

@endsection

@section('scripts')
@if (!request()->hasCookie('cookie_consent'))
<script>
  document.getElementById('accept-btn').addEventListener('click', function() {
    document.getElementById('cookie-banner').style.display = 'none';
  });
</script>
@endif
@endsection

<style>
    .cookie-banner {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        background-color: #f2f2f2;
        padding: 20px;
        text-align: center;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    }

    .cookie-banner button {
        background-color: #4CAF50;
        color: white;
        border: none;
        padding: 10px 20px;
        font-size: 16px;
        cursor: pointer;
        margin: 10px;
    }

    .cookie-banner button:hover {
        background-color: #3e8e41;
    }
</style>
