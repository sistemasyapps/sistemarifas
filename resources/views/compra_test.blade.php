<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>{{config('app.name')}} - Comprar Boleto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="{{asset('assets/css/compra.css')}}?ver=<?php echo mktime(time()); ?>" rel="stylesheet">
  </head>
  <body>
    <div class="wpb-content--blank">
      <article id="post-25415" class="post-25415 page type-page status-private hentry">
        <div class="entry-content">
          <div class="container-fluid">
            <!-- <div data-vc-full-width="true" data-vc-full-width-init="false" class="vc_row wpb_row vc_row-fluid row">
              <div class="wpb_column container-fluid vc_col-sm-12">
                <div class="vc_column-inner">
                  <div class="wpb_wrapper">
                    <div class="wpb_raw_code wpb_content_element wpb_raw_html" >
                      <div class="wpb_wrapper">
                        {!! $rifa->descripcion !!}
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div> -->
            <!-- <div class="vc_row-full-width vc_clearfix"></div> -->
            <div class="row paso1" id="paso1">
              <div class="col-md-6 col-sm-12 col-xs-12">
                <div data-vc-full-width="true" data-vc-full-width-init="false" class="vc_row wpb_row vc_row-fluid slide_pasos">
                  <div class="wpb_column container-fluid vc_col-sm-12">
                    <div class="vc_column-inner">
                      <div class="wpb_wrapper">
                        <div class="wpb_raw_code wpb_content_element wpb_raw_html" >
                          <div class="wpb_wrapper">
                            <h3 class="h3_responsive fecha_sorteo" style="text-align: center;"></h3><span id="countdown"></span>
                          </div>
                        </div>
                        <div class="progress" role="progressbar" aria-valuenow="{{ $Barra }}" aria-valuemin="0" aria-valuemax="100" style="height: 35px;">
  <div class="progress-bar vc_custom_1712891704809" style="width: {{ $Barra }}%;">
    QUEDAN {{ $Barra }}%
  </div>
</div>
                        
                        <div class="wpb_raw_code wpb_content_element wpb_raw_html compra_manual d-none">
                          <div class="wpb_wrapper">
                          <h3 class="h3_responsive" style="text-align: center; color: white">Escriba los números a comprar</h3>
                          </div>
                        </div>
                        <div class="vc_row wpb_row vc_inner vc_row-fluid flex flex_row compra_manual d-none">
                          <div class="wpb_column container-fluid vc_col-sm-3">
                            <div class="vc_column-inner">
                              <div class="wpb_wrapper">
                                <div class="flex center flex-center">
                                  <select class="select2 form-control" id="numeros_manual" style="width: 100%;" multiple="multiple"></select>
                                </div>
                              </div>
                            </div>
                          </div>
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
                                      <input type="text" onblur="validar_cant(this.value)" onkeyup="put_cant(this.value)" id="cant_boletos" name="cant_boletos" value="2" class="form-control">
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
                        <div class="wpb_raw_code wpb_content_element wpb_raw_html" >
                          <div class="wpb_wrapper">
                            <h3 class="h4_responsive ptop_0" style="text-align: center; color: white">Cantidad mínima permitida: <span class="yellow_color">2</span></h3>
                          </div>
                        </div>
                        <div class="custom-container">
                          <h4>Métodos de Pago</h4>
                          <div class="info_boletos" style="margin-bottom: 15px;">
                            <div class="info">
                              <h4 class="h3_responsive text-white" style="font-size: 20px!important">Banco</h4> 
                              <h4 class="h3_responsive">Venezuela 0102</h4>
                            </div>
                            <div class="info">
                              <h4 class="h3_responsive text-white" style="font-size: 20px!important">Teléfono</h4> 
                              <h4 class="h3_responsive">04128302095</h4>
                            </div>
                            <div class="info">
                              <h4 class="h3_responsive text-white" style="font-size: 20px!important">Cédula</h4> 
                              <h4 class="h3_responsive">24013171</h4>
                            </div>
                            <div class="d-grid gap-2 col-12 mx-auto">
                              <button type="button" class="btn btn-secondary" onclick="copiarAlPortapapeles('Venezuela 0102 04128302095 24013171')">
                                Copiar Pago Movil <i class="fa fas fa-copy"></i>
                              </button>
                            </div>
                            <!-- <div class="info">
                              <h4 class="h3_responsive text-white" style="font-size: 20px!important">Zelle: </h4>
                              <h4 class="h3_responsive">zamarripanancy@hotmail.com</h4>
                            </div>
                            <div class="d-grid gap-2 col-12 mx-auto">
                              <button type="button" class="btn btn-secondary" onclick="copiarAlPortapapeles('zamarripanancy@hotmail.com')">
                                Copiar Zelle <i class="fa fas fa-copy"></i>
                              </button>
                            </div>
                            <div class="info">
                              <h4 class="h3_responsive text-white" style="font-size: 20px!important">Binance </h4>
                              <h4 class="h3_responsive">nailethlopez09@gmail.com</h4>
                            </div>
                            <div class="d-grid gap-2 col-12 mx-auto">
                              <button type="button" class="btn btn-secondary" onclick="copiarAlPortapapeles('nailethlopez09@gmail.com')">
                                Copiar Binance <i class="fa fas fa-copy"></i>
                              </button>
                            </div> -->
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            
              <div class="col-md-6 col-sm-12 col-xs-12">
                <div data-vc-full-width="true" data-vc-full-width-init="false" class="vc_row wpb_row vc_row-fluid row slide_pasos">
                  <div class="wpb_column container-fluid vc_col-sm-12">
                    <div class="vc_column-inner">
                      <div class="wpb_wrapper">
                        <div class="vc_separator wpb_content_element vc_separator_align_center vc_sep_width_100 vc_sep_border_width_2 vc_sep_pos_align_center vc_separator_no_text vc_sep_color_white vc_custom_1712884726693  vc_custom_1712884726693" ><span class="vc_sep_holder vc_sep_holder_l"><span class="vc_sep_line"></span></span><span class="vc_sep_holder vc_sep_holder_r"><span class="vc_sep_line"></span></span>
                        </div>
                        <div class="wpb_raw_code wpb_content_element wpb_raw_html" >
                          <div class="wpb_wrapper">
                            <div class="info_boletos">
                              <div class="info">
                                <h3 class="h3_responsive text-white" style="font-size: 20px!important">Monto Bs </h3> <h3 class="h3_responsive" id="final_bs"></h3>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="vc_separator wpb_content_element vc_separator_align_center vc_sep_width_100 vc_sep_border_width_2 vc_sep_pos_align_center vc_separator_no_text vc_sep_color_white vc_custom_1712884726693  vc_custom_1712884726693" ><span class="vc_sep_holder vc_sep_holder_l"><span class="vc_sep_line"></span></span><span class="vc_sep_holder vc_sep_holder_r"><span class="vc_sep_line"></span></span>
                        </div>
                        <div>
                          <div class="container-fluid">
                            <div class="roW d-flex" style="gap: 10px">
                              <div class="col-6">
                                <label>Cédula</label>
                                <input type="number" id="cedula" onkeypress="return this.value.length <= 8" name="cedula" class="form-control" maxlength="9" placeholder="12345678">
                              </div>
                              <div class="col-6">
                                <label>Nombre completo</label>
                                <input type="text" onkeyup="put_persona(this.id,this.value)" id="nombre_completo" name="nombre_completo" class="form-control" maxlength="100">
                              </div>
                            </div>
                            <div class="roW d-flex" style="gap: 10px">
                              <div class="col-6">
                                <label>Correo</label>
                                <input type="text" onblur="validateEmail(this.value)" onkeyup="put_persona(this.id,this.value)" id="email" name="email" class="form-control" maxlength="100">
                              </div>
                              <div class="col-6">
                                <label>Teléfono</label>
                                <input type="text" onkeyup="put_persona(this.id,this.value)" id="telefono" name="telefono" class="form-control" maxlength="20">
                              </div>
                            </div>
                            
                            <div class="flex flex-column">
                              <div style="margin-bottom: 15px">
                                <label>Capture Bancario</label>
                                <input type="file" accept="image/*" id="archivo_pago" name="archivo_pago" onblur="put_pago(this.id,this.value)" class="form-control" style="font-weight: bold;">
                              </div>
                              <div class="col-12" style="margin-bottom: 15px">
                                <label>Banco Emisor</label>
                                <select id="bank_code" name="bank_code" class="form-control">
                                  <option value="">Seleccione banco</option>
                                  <option value="0102">0102 - Banco de Venezuela S.A.C.A. Banco Universal</option>
                                  <option value="0104">0104 - Venezolano de Crédito, S.A. Banco Universal</option>
                                  <option value="0105">0105 - Mercantil Banco, C.A. Banco Universal</option>
                                  <option value="0108">0108 - BBVA Provincial, S.A. Banco Universal</option>
                                  <option value="0114">0114 - Bancaribe C.A. Banco Universal</option>
                                  <option value="0115">0115 - Banco Exterior C.A. Banco Universal</option>
                                  <option value="0128">0128 - Banco Caroní C.A. Banco Universal</option>
                                  <option value="0134">0134 - Banesco, Banco Universal S.A.C.A.</option>
                                  <option value="0137">0137 - Banco Sofitasa, Banco Universal</option>
                                  <option value="0138">0138 - Banco Plaza, Banco Universal</option>
                                  <option value="0146">0146 - Bangente C.A</option>
                                  <option value="0151">0151 - BFC Banco Fondo Común C.A. Banco Universal</option>
                                  <option value="0156">0156 - 100% Banco, Banco Universal C.A.</option>
                                  <option value="0157">0157 - DelSur Banco Universal C.A.</option>
                                  <option value="0163">0163 - Banco del Tesoro, C.A. Banco Universal</option>
                                  <option value="0166">0166 - Banco Agrícola de Venezuela, C.A. Banco Universal</option>
                                  <option value="0168">0168 - Bancrecer, S.A. Banco Microfinanciero</option>
                                  <option value="0169">0169 - R4, Banco Microfinanciero C.A.</option>
                                  <option value="0171">0171 - Banco Activo, Banco Universal</option>
                                  <option value="0172">0172 - Bancamiga, Banco Universal C.A.</option>
                                  <option value="0173">0173 - Banco Internacional de Desarrollo, C.A. Banco Universal</option>
                                  <option value="0174">0174 - Banplus Banco Universal, C.A</option>
                                  <option value="0175">0175 - Banco Digital de Los Trabajadores</option>
                                  <option value="0177">0177 - Banco de la Fuerza Armada Nacional Bolivariana, B.U.</option>
                                  <option value="0178">0178 - N58 Banco Digital, S.A. J503581107</option>
                                  <option value="0191">0191 - Banco Nacional de Crédito, C.A. Banco Universal</option>
                                  <option value="0601">0601 - Instituto Municipal de Crédito Popular</option>
                                </select>
                              </div>
                              <div class="col-12">
                                <label>Referencia Bancaria (8 Dígitos)</label>
                                <input type="text" id="ref" name="ref" class="form-control" maxlength="8" placeholder="Ultimos 8 digitos" inputmode="numeric" autocomplete="off">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="vc_separator wpb_content_element vc_separator_align_center vc_sep_width_100 vc_sep_border_width_2 vc_sep_pos_align_center vc_separator_no_text vc_sep_color_white vc_custom_1712884726693  vc_custom_1712884726693" ><span class="vc_sep_holder vc_sep_holder_l"><span class="vc_sep_line"></span></span><span class="vc_sep_holder vc_sep_holder_r"><span class="vc_sep_line"></span></span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="vc_row wpb_row vc_inner vc_row-fluid row">
                  @if ($queda < 9999)
                  <div class="col-md-6 col-xs-6 col-sm-6">
                    <div class="vc_column-inner">
                      <div class="wpb_wrapper">
                        <div class="vc_btn3-container  disabled vc_btn3-center" ><button class="vc_general vc_btn3 vc_btn3-size-lg vc_btn3-shape-rounded vc_btn3-style-flat vc_btn3-block vc_btn3-icon-right vc_btn3-color-success" onclick="finalizar_compra(this)">Comprar <i class="vc_btn3-icon far fa-money-bill-alt"></i></button></div>
                      </div>
                    </div>
                  </div>
                  @endif
                  <div class="col-md-6 col-xs-6 col-sm-6">
                    <div class="vc_column-inner">
                      <div class="wpb_wrapper">
                        <div class="vc_btn3-container vc_btn3-center" ><button class="vc_general vc_btn3 vc_btn3-size-lg vc_btn3-shape-rounded vc_btn3-style-flat vc_btn3-block vc_btn3-color-danger" onclick="atras()">Volver</button></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="vc_row-full-width vc_clearfix"></div>
            <div id="paso_final" data-vc-full-width="true" data-vc-full-width-init="false" class="vc_row wpb_row vc_row-fluid hidden row slide_pasos paso5">
              <div class="wpb_column container-fluid vc_col-sm-12">
                <div class="vc_column-inner">
                  <div class="wpb_wrapper">
                    <div class="vc_separator wpb_content_element vc_separator_align_center vc_sep_width_100 vc_sep_border_width_2 vc_sep_pos_align_center vc_separator_no_text vc_sep_color_white vc_custom_1712884726693  vc_custom_1712884726693" ><span class="vc_sep_holder vc_sep_holder_l"><span class="vc_sep_line"></span></span><span class="vc_sep_holder vc_sep_holder_r"><span class="vc_sep_line"></span></span>
                    </div>
                    <div class="wpb_raw_code wpb_content_element wpb_raw_html" >
                      <p class="wpb_wrapper">
                        <h2 style="text-align: center;"> GRACIAS POR SU COMPRA </h2>
                        <p>Hemos recibido su compra satisfactoriamente, una vez nuestro equipo verifique el pago en un lapso de 24 a 36 horas, recibirás un mensaje vía WhatsApp y a tu correo electrónico donde conocerás tus tickets asignados.</p>
                      </div>
                    </div>
                    <div class="vc_separator wpb_content_element vc_separator_align_center vc_sep_width_100 vc_sep_border_width_2 vc_sep_pos_align_center vc_separator_no_text vc_sep_color_white vc_custom_1712884726693  vc_custom_1712884726693" ><span class="vc_sep_holder vc_sep_holder_l"><span class="vc_sep_line"></span></span><span class="vc_sep_holder vc_sep_holder_r"><span class="vc_sep_line"></span></span>
                    </div>
                    <div class="vc_row wpb_row vc_inner vc_row-fluid">
                      <div class="wpb_column container-fluid vc_col-sm-6">
                        <div class="vc_column-inner">
                          <div class="wpb_wrapper">
                            <div class="vc_btn3-container vc_btn3-center" ><button class="vc_general vc_btn3 vc_btn3-size-lg vc_btn3-shape-rounded vc_btn3-style-flat vc_btn3-block vc_btn3-color-danger" onclick="atras()">Ir al Inicio</button></div>
                          </div>
                        </div>
                      </div>
                      <div class="wpb_column container-fluid vc_col-sm-6">
                        <div class="vc_column-inner">
                          <div class="wpb_wrapper">
                            <div class="vc_btn3-container  disabled vc_btn3-center" ><button class="vc_general vc_btn3 vc_btn3-size-lg vc_btn3-shape-rounded vc_btn3-style-flat vc_btn3-block vc_btn3-icon-right vc_btn3-color-success" onclick="volver_comprar()">Volver a Comprar <i class="vc_btn3-icon far fa-money-bill-alt"></i></button></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>      
        </div>
      </article>
      <div class="vc_row-full-width vc_clearfix"></div>
      <div class="container-fluid _footer">
        <div class="py-1 d-flex justify-center justify-content-center">
          <img src="{{asset('assets/images/logos/logo.png')}}" class="img" />
        </div>
      </div>
      <div class="vc_row-full-width vc_clearfix"></div>
      @include("partials.terminos")

    </div>
    <script src="{{ asset('/node_modules/jquery/dist/jquery.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
      document.getElementById('cedula').addEventListener('keyup', function() {
        this.value = this.value.replace(/[^0-9]/g, '');
        put_persona(this.id,this.value);
      });

      // Campo Referencia Bancaria (test): pegar conserva últimos 8; digitación manual solo números y máximo 8
      (function(){
        const refInput = document.getElementById('ref');
        if (!refInput) return;
        const clampDigits = () => {
          const digits = (refInput.value || '').replace(/\D/g, '').slice(0, 8);
          if (refInput.value !== digits) {
            refInput.value = digits;
          }
          try { put_pago('ref', refInput.value); } catch(e) {}
        };
        refInput.addEventListener('paste', function(e) {
          e.preventDefault();
          const pastedText = (e.clipboardData || window.clipboardData).getData('text') || '';
          const numbersOnly = pastedText.replace(/[^0-9]/g, '');
          const last8Digits = numbersOnly.slice(-8);
          this.value = last8Digits;
          try { put_pago('ref', last8Digits); } catch(e) {}
          this.dispatchEvent(new Event('input'));
        });
        refInput.addEventListener('input', clampDigits);
        refInput.addEventListener('keyup', clampDigits);
        refInput.addEventListener('change', clampDigits);
      })();
      const modalTerms = new bootstrap.Modal(document.getElementById('termsModal'), {
        keyboard: false
      });
      modalTerms.show();

      let cant_boletos = document.getElementById("cant_boletos");
      let email = document.getElementById("email");
      let paso = 1;
      let quedan = 10000 - {{$queda}};

      const datos = {
        cant_boletos: 2,
        precio: {{ $rifa->precio }},
        persona: {
          nombre_completo: "",
          cedula: "",
          telefono: "",
          email: ""
        },
        pago: {
          archivo_pago: "",
          ref: "",
          // fecha: ""
        }
      }

      calcular_total();

      function volver_comprar(){
        cant_boletos.value = 2;
        document.getElementById("ref").value = "";
        // document.getElementById("fecha").value = "";
        document.getElementById("archivo_pago").value = "";
        datos.cant_boletos = 2;
        datos.pago.archivo_pago = "";
        datos.pago.ref = "";
        // datos.pago.fecha = "";
        jQuery("#paso_final").addClass("hidden");
        jQuery("#paso1").removeClass("hidden");
        paso = 1;
      }


      function updateCountdown() {
        const deadline = new Date('2024-05-31T13:59:59-04:00');
        const now = new Date();
        const nowUtc = now.getTime() + (now.getTimezoneOffset() * 60000);
        const nowCaracas = new Date(nowUtc + (3600000 * -4));

        const distance = deadline.getTime() - nowCaracas.getTime();

        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        document.getElementById('countdown').innerHTML = "Quedan: " + days + "d:" + hours + "h:"+ minutes + "m:" + seconds + "s";

        if (distance  < 0)
        {
          document.getElementById('boton_comprar_uno').remove();
        }
      }

      function minus_cant(){
        if(cant_boletos.value > 2){
          cant_boletos.value--; 
          datos.cant_boletos = parseInt(cant_boletos.value);
          calcular_total();
        }
        
      }

      // Eliminado: validateMin para simplificar manejo del campo de referencia

      function sum_cant(){

        if(cant_boletos.value > 199){
          Swal.fire("la compra máxima es de 200 boletos");
          return;
        }

        if(cant_boletos.value > quedan){
          Swal.fire("no hay boletos suficientes");
          return;
        }
        cant_boletos.value++; 
        datos.cant_boletos = parseInt(cant_boletos.value);
        calcular_total();
      }

      function put_cant(value) {
        datos.cant_boletos = parseInt(value);
      }

      function put_persona(object,value){
        datos.persona[object] = value.trim();
      }

      function put_pago(object,value){
        datos.pago[object] = value.trim();
      }

      function validar_cant(value){
        valueInt = parseInt(value);
        if(valueInt < 2 || value == "" || value == null || value == "undefined"){
          Swal.fire("La compra mínima es de 2 boletos");
          cant_boletos.value = 2;
          put_cant(2);
        }

        if(valueInt > 200){
          Swal.fire("La compra máxima es de 200 boletos");
          cant_boletos.value = 2;
          put_cant(2);
        }

        if(valueInt > quedan){
          Swal.fire("no hay boletos suficientes");
          cant_boletos.value = 2;
          put_cant(2);
        }

        calcular_total();
      }

      function comprar_ticket(){
        const total = datos.precio * datos.cant_boletos;
        const total_usd = datos.precio * datos.cant_boletos;

        // jQuery("#span_boletos").html(`${datos.cant_boletos}`)
        // jQuery("#precio_boletos").html(`$${datos.precio} USD`)
        // jQuery("#bcv").html(`${datos.bcv}`)
        // jQuery("#total_boletos").html(`${total.toFixed(2)} Bs.`)
        jQuery("#final_bs").html(`${total.toFixed(2)} Bs.`)
        // jQuery("#final_usd").html(`$${total_usd} USD`)
        
        // paso_adelante();
      }

      function calcular_total() {
        // validar_numeros_manual();
        const total = datos.precio * datos.cant_boletos;
        const total_usd = datos.precio * datos.cant_boletos;
        jQuery("#final_bs").html(`${total.toFixed(2)} Bs.`);
      }

      function validar_datos() {
        let validados = true;

        const arr = {
          "nombre_completo": jQuery("#nombre_completo").val(),
          "cedula": jQuery("#cedula").val(),
          "telefono": jQuery("#telefono").val(),
          "email": jQuery("#email").val(),
          // "ref": jQuery("#ref").val(),
        };

        Object.values(arr).forEach( a => {
          if(a == "undefined" || a == "" || a == null) {
            validados = false;
          }
        });

        return validados;
      }

      function atras() {
        window.location.href = "{{config('app.url')}}";
      }

      function paso_atras(){
        show_hide("atras");
        paso--;
      }

      function paso_adelante() {
        show_hide("adelante");
        paso++;
      }

      function show_hide(tipo){
          if(paso == 1 && tipo=="adelante"){
            jQuery("#paso1").addClass("hidden");
            jQuery("#paso_final").removeClass("hidden");
          }
          
          if(paso == 2 && tipo=="adelante"){
            jQuery("#paso2").addClass("hidden");
            jQuery("#paso_final").removeClass("hidden");
          }
          
          if(paso == 2 && tipo=="atras"){
            jQuery("#paso2").addClass("hidden");
            jQuery("#paso1").removeClass("hidden");
          }
      }

      function validateEmail(emailField) {
        const _email = emailField.trim().toLowerCase();
        const regex = /^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$/i;

        if(!regex.test(_email) ){
          Swal.fire("El correo electrónico está mal escrito, por favor corregir");
          email.value = "";
        }
        datos.persona.email = _email;
      } 

      function finalizar_compra(_this) {
        
        const archivo_pago = document.querySelector("#archivo_pago");

        if(jQuery("#ref").val() == "") {
          Swal.fire("Debes colocar la referencia");
          return;
        }
        if(jQuery("#bank_code").val() == "") {
          Swal.fire("Debes seleccionar el banco emisor");
          return;
        }

        // if(jQuery("#fecha").val() == "") {
        //   Swal.fire("Debes colocar la fecha del pago");
        //   return;
        // }

        if(archivo_pago.files.length != 1) {
          Swal.fire("Debes subir el capture bancario");
          return;
        }

        if(!validar_datos()) {
          Swal.fire("todos los campos son obligatorios");
          return;
        }
        
        const formData = new FormData();
        formData.append("raffle_id", {{$rifa->id}});
        formData.append("nombre_completo", jQuery("#nombre_completo").val());
        formData.append("correo", jQuery("#email").val());
        formData.append("tlf", jQuery("#telefono").val());
        formData.append("cantidad", datos.cant_boletos);
        formData.append("cedula", jQuery("#cedula").val());
        formData.append("ref_banco", jQuery("#ref").val());
        formData.append("bank_code", jQuery("#bank_code").val());
        formData.append("ref_imagen", archivo_pago.files[0]);
        // formData.append("ref_fecha", jQuery("#fecha").val());

        const linkGuardar = "{{config('app.url')}}/api/orderCliente";

        _this.disabled = true;
        _this.innerHTML = "Realizando Compra....";

        fetch(linkGuardar,{
          method: "POST",
          cache: "no-cache",
          body: formData
        })
        .then(response => response.json())
        .then( res => {
          console.log(res)
          if(res.success == true){
            let timerInterval;
              Swal.fire({
                title: "Realizando Compra...",
                timer: 1500,
                timerProgressBar: true,
                didOpen: () => {
                  Swal.showLoading();
                  const timer = Swal.getPopup().querySelector("b");
                  timerInterval = setInterval(() => {
                    timer.textContent = `${Swal.getTimerLeft()}`;
                  }, 100);
                },
                willClose: () => {
                  clearInterval(timerInterval);
                }
              }).then((result) => {
                /* Read more about handling dismissals below */
                if (result.dismiss === Swal.DismissReason.timer) {
                  console.log("se cerró la ventana y se hizo la compra");
                  show_hide("adelante");
                }
              });
          }else {
            Swal.fire({
              icon: "error",
              title: "Error",
              text: res.message,
            });

            _this.disabled = false;
            _this.innerHTML = "Comprar";
          }
        });
      }

      const fileInput = document.getElementById('archivo_pago');
      const imagePreview = document.getElementById('preview_capture');

      fileInput.addEventListener('change', async function () {
        const file = fileInput.files[0];
        
        if (file && file.type.startsWith('image/')) {
          try {
            // Redimensionar y previsualizar la imagen
            const resizedImage = await resizeImage(file);
            //previewImage(resizedImage);
            
            // Reemplazar el archivo de imagen en el input con el archivo redimensionado
            fileInput.files = createFileList(resizedImage);
          } catch (error) {
            console.error('Error al procesar la imagen:', error);
          }
        }
      });

      /**
       * Redimensiona y comprime la imagen a 1024x768.
       * @param {File} file - Archivo de imagen original
       * @returns {Promise<File>} - Imagen comprimida y redimensionada
       */
      function resizeImage(file) {
        return new Promise((resolve, reject) => {
          const reader = new FileReader();
          reader.readAsDataURL(file);

          reader.onload = function (event) {
            const img = new Image();
            img.src = event.target.result;

            img.onload = function () {
              // Crear un canvas con tamaño fijo 1024x768
              const canvas = document.createElement('canvas');
              const ctx = canvas.getContext('2d');
              
              const targetWidth = 768;
              const targetHeight = 1024;
              
              canvas.width = targetWidth;
              canvas.height = targetHeight;

              // Dibujar la imagen en el canvas con el tamaño deseado
              ctx.drawImage(img, 0, 0, targetWidth, targetHeight);

              // Convertir el canvas a Blob con calidad reducida (ajusta la calidad si es necesario)
              canvas.toBlob(
                function (blob) {
                  if (blob) {
                    // Convertir el Blob en un archivo y resolver la promesa
                    const resizedFile = new File([blob], file.name, {
                      type: file.type,
                      lastModified: Date.now(),
                    });
                    resolve(resizedFile);
                  } else {
                    reject(new Error('Error al crear el Blob de la imagen.'));
                  }
                },
                'image/jpeg', // Formato de salida
                0.5 // Calidad de la imagen (entre 0 y 1, donde 1 es la máxima calidad)
              );
            };

            img.onerror = function () {
              reject(new Error('Error al cargar la imagen.'));
            };
          };

          reader.onerror = function () {
            reject(new Error('Error al leer el archivo.'));
          };
        });
      }

      /**
       * Previsualiza la imagen en el formulario.
       * @param {File} file - Archivo de imagen redimensionado
       */
      function previewImage(file) {
        const reader = new FileReader();
        reader.onload = function (event) {
            imagePreview.src = event.target.result;
            imagePreview.style.display = 'block'; // Mostrar la previsualización
        };
        reader.readAsDataURL(file);
      }

      /**
       * Crea un objeto FileList con un solo archivo (redimensionado).
       * @param {File} file - Archivo redimensionado
       * @returns {FileList} - Nuevo FileList con el archivo
       */
      function createFileList(file) {
        const dataTransfer = new DataTransfer();
        dataTransfer.items.add(file);
        return dataTransfer.files;
      }

      function copiarAlPortapapeles(elemento) {
        var temp = document.createElement("textarea");
        document.body.appendChild(temp);
        temp.value = elemento;
        temp.select();
        document.execCommand("copy");
        document.body.removeChild(temp);
      }
    </script>
    <script>
// Código WebSocket
const socket = new WebSocket('wss://rifaalvarado.yapirides.com:2053');

socket.onopen = function(e) {
  console.log("[WebSocket] Conexión establecida");
};

socket.onmessage = function(event) {
  try {
    const data = JSON.parse(event.data);
    // Buscamos los datos de la rifa actual (ID 9)
    const rifaData = data.find(r => r.id === 9);
    
    if (rifaData) {
      console.log(rifaData);
      // Actualizar la barra de progreso
      const progressBar = document.querySelector('.progress-bar');
      if (progressBar) {
        progressBar.style.width = rifaData.barra + '%';
        progressBar.textContent = 'QUEDAN ' + rifaData.barra + '%';
        progressBar.setAttribute('aria-valuenow', rifaData.barra);
      }

      // Actualizar la variable quedan
      quedan = 10000 - parseInt(rifaData.queda);
      
      // Validar si la cantidad actual de boletos seleccionados es válida
      if (cant_boletos.value > quedan) {
        cant_boletos.value = 2;
        datos.cant_boletos = 2;
        calcular_total();
        console.log("Se ha ajustado la cantidad de boletos porque no hay suficientes disponibles");
      }
    }
  } catch (error) {
    console.error('Error procesando mensaje del WebSocket:', error);
  }
};

socket.onclose = function(event) {
  if (event.wasClean) {
    console.log(`[WebSocket] Conexión cerrada limpiamente, código=${event.code} motivo=${event.reason}`);
  } else {
    console.log('[WebSocket] La conexión se perdió');
    // Intentar reconectar después de 5 segundos
    setTimeout(() => {
      window.location.reload();
    }, 5000);
  }
};

socket.onerror = function(error) {
  console.error(`[WebSocket] Error: ${error.message}`);
};
</script>
  </body>
</html>
