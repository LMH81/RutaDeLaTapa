@extends('layouts.app')

@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    {{-- @if (!request()->hasCookie('cookie_consent'))
        <div id="cookie-banner" class="cookie-banner" role="group" aria-label="Acciones">
            <p>Este sitio web utiliza cookies para mejorar su experiencia de usuario y analizar de forma anónima y
                estadística el uso que hace de la web. Para más información acceda a la <a
                    href="https://www.exteriores.gob.es/es/Paginas/Cookies.aspx" target="_blank">Política de
                    Cookies</a>.<br><br>Al hacer clic en <b>ACEPTAR</b>, usted acepta el uso de todas las cookies.</p>
            <br><br>
            <a href="{{ url('/') }}" class="btn btn-success" id="accept-btn">Aceptar</a>
<form action="{{ url('/del-cookie') }}" class="d-inline" method="get">
    @csrf
    <input class="btn btn-danger" type="submit" onclick="return confirm('¿Estás seguro?')" value="Rechazar">
</form>
</div>
@endif --}}
    @if (!request()->hasCookie('cookie_consent'))
        <div id="cookie-banner" class="cookie-banner" role="group" aria-label="Acciones">
            <p>Este sitio web utiliza cookies para mejorar su experiencia de usuario y analizar de forma anónima y
                estadística el uso que hace de la web. Para más información, acceda a la <a
                    href="https://www.exteriores.gob.es/es/Paginas/Cookies.aspx" target="_blank">Política de
                    Cookies</a>.<br><br>Al hacer clic en <b>ACEPTAR</b>, usted acepta el uso de todas las cookies.</p>
            <br><br>
            <a href="#" class="btn btn-success" id="accept-btn">Aceptar</a>
            <form action="{{ url('/del-cookie') }}" class="d-inline" method="get">
                @csrf
                <input class="btn btn-danger" type="submit" onclick="return confirm('¿Estás seguro?')" value="Rechazar">
            </form>
        </div>
        <script>
            document.getElementById('accept-btn').addEventListener('click', function() {
                document.getElementById('cookie-banner').style.display = 'none';
            });
        </script>
    @endif


    @unlessrole('admin')
        <!-- Tapas Section-->
        <section class="page-section portfolio" id="portfolio">
            <div class="container">
                <!-- Tapas Section Heading-->
                <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Tapas</h2>
                <!-- Icon Divider-->
                <div class="divider-custom">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <!-- Portfolio Grid Items-->
                <div class="row justify-content-center">

                    @foreach ($grouped_tapas as $bar => $tapas)
                        <!-- Portfolio Item 1-->
                        <div class="col-md-6 col-lg-4 mb-5">
                            <div class="portfolio-item mx-auto" data-bs-toggle="modal"
                                data-bs-target="#portfolioModal{{ $tapas[0]['bartapa_Id'] }}">
                                <div
                                    class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                                    <div class="portfolio-item-caption-content text-center text-white"><i
                                            class="fas fa-plus fa-3x"></i></div>
                                </div>
                                <img class="img-fluid" src="{{ asset('storage/' . $tapas[0]['tapa']->img) }}" width="200px"
                                    alt="{{ $tapas[0]['tapa']->name }}" />
                            </div>
                        </div>
                        <!-- Portfolio Modal 1-->
                        <div class="portfolio-modal modal fade" id="portfolioModal{{ $tapas[0]['bartapa_Id'] }}" tabindex="-1"
                            aria-labelledby="portfolioModal{{ $tapas[0]['bartapa_Id'] }}" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header border-0"><button class="btn-close" type="button"
                                            data-bs-dismiss="modal" aria-label="Close"></button></div>
                                    <div class="modal-body text-center pb-5">
                                        <div class="container">
                                            <div class="row justify-content-center">
                                                <div class="col-lg-8">
                                                    <!-- Portfolio Modal - Title-->
                                                    <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0">Tapa
                                                    </h2>
                                                    <!-- Icon Divider-->
                                                    <div class="divider-custom">
                                                        <div class="divider-custom-line"></div>
                                                        <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                                        <div class="divider-custom-line"></div>
                                                    </div>
                                                    <!-- Portfolio Modal - Image-->
                                                    <img class="img-fluid rounded mb-5"
                                                        src="{{ asset('storage/' . $tapas[0]['tapa']->img) }}"
                                                        alt="{{ $tapas[0]['tapa']->name }}" />
                                                    <!-- Portfolio Modal - Text-->
                                                    <p class="mb-4">{{ $tapas[0]['tapa']->name }}</p>
                                                    <p class="mb-4">{{ $bar }}</p>
                                                    <button class="btn"
                                                        style="background-color: var(--bs-blue);color: white;"
                                                        data-bs-dismiss="modal">
                                                       
                                                        <i class="fas fa-xmark fa-fw"></i>
                                                        Cerrar ventana
                                                    </button>
                                                    
                                                    <a href="{{ route('voto.create', $tapas[0]['bartapa_Id']) }}"
                                                        class="btn btn-success mb-3 mt-3">Vota</a>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach


                </div>
        </section>







        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>


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
            z-index: 999;
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