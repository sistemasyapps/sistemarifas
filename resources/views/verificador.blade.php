@extends('layout.app')

  <link href="{{asset('assets/css/verificador.css')}}" rel="stylesheet">

@section("content") 
  <div class="contact-section">
    <div class="container contact-container text-center">
      <div class="col-11 contact-title-section text-center card">
        <h2 class="contact-title mt-4">VERIFICADOR</h2>
        <p class="contact-subtitle mb-2">DE BOLETOS</p>
        <div id="boxsearchcel" >
          <form>
            <div class="input-field col-12 s12 m6">
              <input placeholder="" id="findPhone" name="cedula" type="number" class="form-control" maxlength="16" required="">
              <label for="findPhone" class="active">Introduzca número de c&eacute;dula</label>
            </div>
            <div class="input-field col s12 m6">
                <button class="vc_general vc_btn3 vc_btn3-size-lg vc_btn3-shape-rounded vc_btn3-style-flat vc_btn3-block vc_btn3-color-success" type='submit'>
                    <i class="fa fa-search" aria-hidden="true"></i> Buscar
                </button>
            </div>
            @foreach ($links as $i => $link)

              @if($link->estatus == '0')
                <p>
                  <b>Tienes 1 compra en proceso de verificación, por favor espere al recibir su correo para verificar sus tickets.</b>
                </p>
              @endif

              @if($link->estatus == '1')
              <a href='https://ganaconandreaaular.com/ticket/{{$link->uuid}}' target="_blank">
                https://ganaconandreaaular.com/ticket/{{$link->uuid}}
              </a>
              <hr />
              @endif
            @endforeach
          </form>
        </div>
        <div class="learn-more-btn-section"></div>
      </div>
    </div>
  </div>
@endsection
