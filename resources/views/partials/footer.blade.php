@include("partials.terminos")
<footer class="bg-footer text-white text-center">
    <div class="container">
        <div class="row justify-content-center">
            @foreach ( $patrocinadores as $patrocionador )
                <div class="col">
                    <img class="img-fluid img-brand lazyload" alt="patrocinador {{$patrocionador->nombre}} de javiierdu " data-src="{{ Storage::url($patrocionador->imagen) }}" src="{{ Storage::url($patrocionador->imagen) }}">
                </div>
            @endforeach
        </div>
    </div>
    <div class="footer-links d-flex">
        <a href="#" data-bs-toggle="modal" data-bs-target="#termsModal">Términos y Condiciones</a>
        <!-- <a href="#">Información de Compras</a> -->
        <div class="d-flex social_links_footer">
            <ul>
                @foreach($rrss as $red)
                <li>
                    <a href="{{$red->link}}" target="_blank" rel="noopener">
                        <img width="64" height="64" alt="{{$red->tipo}}" src="/assets/images/icon/{{$red->tipo}}.png?v=2">
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    <p style="color: black!important;">Copyright © 2024. Desarrollado por <a href="https://www.instagram.com/softvencaoficial" target="_blank" rel="noopener">SOFTVENCA</a></p>
</footer>