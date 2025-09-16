@extends('nuevo.layout')
@section("content")
    
  <div id="colorlib-page">
    @include('nuevo.header')
    <section class="hero-wrap ">
          <div class="container px-0">
            <div class="no-gutters slider-text js-fullheight align-items-center justify-content-center" data-scrollax-parent="true">
              <div class="col-12 ftco-animate">
                <div class="desc">
                    <div class="wrapper items-center mx-auto max-w-[745px]">
                      <div>
                        Rifas activas: 
                        @foreach($raffles as $r)
                          <a href="#">{{$r["nombre"]}}</a>
                        @endforeach
                      </div>
                      @if($raffle)
                        <div class="relative px-0 pt-0 lg:px-5 pb-4 lg:pt-5">
                            <div class="relative overflow-hidden shadow-none rounded-none lg:shadow-lg lg:radius-rounded">
                              <img src="{{ Storage::url($raffle->imagen_premio) }}" class="w-full lg:rounded-lg max-w-[745px] max-h-[260px] md:max-h-[460px] object-cover object-center" alt="Foto de rifa">
                            </div>
                        </div>
                        <div class="grid px-0 radius-rounded gap-y-5 max-w-[100vw]  md:max-w-[1200px] ">
                          <div class="flex flex-col items-start justify-center gap-4 px-3">
                            <div class="flex flex-row justify-between items-center w-full">
                              <div class="flex radius-rounded bg-[var(--color-surface-secondary)] overflow-hidden">
                                <div class="flex flex-row gap-2 items-center justify-center bg-[#00D3441F] px-2 py-1">
                                  <span class="label-large-medium text-color-brand">
                                    {{ $raffle->sorteo_label ?? ('Sorteo: ' . ($raffle->dia ?? '') . ' ' . ($raffle->mes ?? '')) }}
                                  </span>
                                </div>
                              </div>
                              <div class="flex flex-col text-left">
                                <span class="body-large-regular">Ticket</span>
                                <span class="body-large-bold">Bs. {{$raffle->precio}}</span>
                              </div>
                            </div>
                            <h2 class="title-large-bold">{{$raffle->nombre}} </h2>
                          </div>
                          <div class="">
                            <div class="progress" role="progressbar" aria-valuenow="{{ $raffle->barra }}" aria-valuemin="0" aria-valuemax="100" style="height: 50px;">
                              <div class="progress-bar" style="width: {{ $raffle->barra }}%; background: #0bb20a; font-size: 16px;" id="barraRealTime">
                                {{ $raffle->barra }} % DISPONIBLE
                              </div>
                            </div>
                          </div>
                          <div class="mt-1 pt-0 pb-6  md:mx-0 md:px-5 px-3 flex flex-col justify-center items-center gap-6 radius-rounded">
                            <h2 class="title-large-bold text-black">Elige los tickets a comprar</h2>
                            <div class="grid grid-cols-6  md:grid-cols-6 gap-2 md:gap-6  w-full">
                              <button class="price-button" id="button-2" onclick="put_cant(1)">
                                  <span>+1</span>
                              </button>
                              <button class="price-button" id="button-5" onclick="put_cant(2)">
                                  <span>+2</span>
                              </button>
                              <button class="price-button" id="button-10" onclick="put_cant(3)">
                                  <span>+3</span>
                              </button>
                              <button class="price-button" id="button-20" onclick="put_cant(4)">
                                  <span>+4</span>
                              </button>
                              <button class="price-button" id="button-30" onclick="put_cant(5)">
                                  <span>+5</span>
                              </button>
                              <button class="price-button" id="button-50" onclick="put_cant(10)">
                                  <span>+10</span>
                              </button>
                            </div>
                            <div class="vc_row wpb_row vc_inner vc_row-fluid flex flex_row compra_auto mt-3">
                              <div class="wpb_column container-fluid vc_col-sm-3">
                                <div class="vc_column-inner">
                                  <div class="wpb_wrapper">
                                    <div class="vc_btn3-container vc_btn3-center" ><button class="vc_general vc_btn3 vc_btn3-size-lg vc_btn3-shape-rounded vc_btn3-style-flat vc_btn3-o-empty vc_btn3-block vc_btn3-icon-left vc_btn3-color-danger" onclick="minus_cant()"><i class="vc_btn3-icon fas fa-minus"></i> <span class="vc_btn3-placeholder">&nbsp;</span></button></div>
                                  </div>
                                </div>
                              </div>
                              <div class="p_0 m_0 wpb_column container-fluid vc_col-sm-6">
                                <div class="vc_column-inner">
                                  <div class="wpb_wrapper">
                                    <div class="wpb_raw_code wpb_content_element wpb_raw_html" >
                                      <div class="wpb_wrapper">
                                        <div class="flex center flex-center">
                                          <input type="text" onblur="validar_cant(this.value)" id="cant_boletos" name="cant_boletos" value="1" class="form-control">
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="wpb_column container-fluid vc_col-sm-3">
                                <div class="vc_column-inner">
                                  <div class="wpb_wrapper">
                                    <div class="vc_btn3-container vc_btn3-center" ><button class="vc_general vc_btn3 vc_btn3-size-lg vc_btn3-shape-rounded vc_btn3-style-flat vc_btn3-o-empty vc_btn3-block vc_btn3-icon-left vc_btn3-color-success" onclick="sum_cant()"><i class="vc_btn3-icon fas fa-plus"></i> <span class="vc_btn3-placeholder">&nbsp;</span></button></div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            
                            <div class="flex flex-col gap-2 justify-stretch items-stretch w-full">
                              @if($raffle->estatus_compra == 1)
                              <a href="javascript:void()" id="btnComprar" class="button-active button-medium" style="text-decoration: none; text-align: center; padding: 10px; font-size: 22px;">
                                <span>Comprar Tickets</span>
                              </a>
                              @endif
                              <a href="/verificador/{{$raffle->id}}" class="button-active button-medium" style="text-decoration: none; text-align: center; padding: 10px; font-size: 20px;">
                                <span>Verificar mis Tickets</span>
                              </a>
                            </div>
                          </div>
                        </div>
                        @endif
                    </div>
                </div>
              </div>
            </div>
          </div>
    </section>
  </div>
  
  <!-- <a href="https://wa.me/{{$whatsapp}}" class="whatsapp" target="_blank"> 
      <img src="/assets/images/icon/whatsapp.png" alt="whatsapp soporte javiierdu"/>
  </a> -->

  <script type="text/javascript">
    let cant_boletos = document.getElementById("cant_boletos");
    let quedan = {{ isset($raffle) && isset($raffle->queda) ? (int)$raffle->queda : 0 }};
    let minimo = 1;

    const btnComprar = document.getElementById("btnComprar");
    if (btnComprar && cant_boletos) {
      btnComprar.addEventListener("click",function(){
        window.location.href="{{config('app.url')}}/compra?q="+cant_boletos.value;
      });
    }

    function validar_cant(value){
      valueInt = parseInt(value);
      if(valueInt < minimo || value == "" || value == null || value == "undefined"){
        alert("La compra mínima es de 1 boleto");
        cant_boletos.value = minimo;
      }

      if(valueInt > quedan){
        alert("no hay boletos suficientes");
        cant_boletos.value = minimo;
      }
    }

    function put_cant(cant){
      let valorActual = parseInt(cant_boletos.value);
      if(cant > quedan){
        alert("no hay boletos suficientes");
        return;
      }
      const valorNuevo = valorActual + parseInt(cant);
      cant_boletos.value = valorNuevo;
    }

    function sum_cant(){
      if(cant_boletos.value > quedan){
        alert("no hay boletos suficientes");
        return;
      }
      cant_boletos.value++; 
    }

    function minus_cant(){
      if(cant_boletos.value > minimo){
        cant_boletos.value--; 
      }
    }

  </script>
@endsection
