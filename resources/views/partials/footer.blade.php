@include("partials.terminos")
<footer class="bg-footer text-center">
    <div class="container">
        <div class="row justify-content-center">
            @foreach ( $patrocinadores as $patrocionador )
                <div class="col">
                    <img class="img-fluid img-brand lazyload" data-src="{{ Storage::url($patrocionador->imagen) }}" src="{{ Storage::url($patrocionador->imagen) }}">
                </div>
            @endforeach
        </div>
    </div>
    <div class="footer-links d-flex">
        <a href="#" data-bs-toggle="modal" data-bs-target="#termsModal">Términos y Condiciones</a>
        <div class="d-flex social_links_footer">
            <ul>
                <li>
                    <a href="https://instagram.com/andreastefaular.21" target="_blank" rel="noopener">
                        <img alt="instagram andreastefaular.21" src="/assets/images/icon/instagram.png">
                    </a>
                </li>	
                <!-- <li>
                    <a href="https://www.instagram.com/rifasisayronald" target="_blank" rel="noopener">
                        <img alt="instagram rifasisayronald" src="/assets/images/icon/instagram.png">
                    </a>
                </li> -->
            </ul>
        </div>
    </div>
    <p>Copyright © 2024. Desarrollado por <a href="https://www.instagram.com/softvencaoficial" target="_blank" rel="noopener">SOFTVENCA</a></p>
</footer>