@extends('layout.app')
@section("js")
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
	<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script>
	<script type="text/javascript">
		document.addEventListener('DOMContentLoaded', function() {
			const swiperEl = document.querySelector('.mySwiper');
			document.querySelector('#next').addEventListener("click",function(){
				swiperEl.swiper.slideNext();
			});
			document.querySelector('#prev').addEventListener("click",function(){
				swiperEl.swiper.slidePrev();
			});

		})
	</script>
@endsection
@section("content")
	<style type="text/css">
		swiper-container {
	      width: 100%;
	      padding-bottom: 25px;
	    }

	    swiper-slide {
	      background-position: center;
	      background-size: cover;
	      width: 300px;
	      height: 800px;
	    }

	    swiper-slide img {
	      display: block;
	      width: 100%;
	    }

	    .font-sm{
	    	font-size: 0.8rem!important;
	    }

	</style>
    <main class="container">
        <section class="sorteo-info">
        	<div class="row">
        		<div class="col-6">
	        		<button type="button" id="prev" class="btn btn-danger font-sm">
	        			<i class="fa fa-fw fa-backward"></i> Rifa Anterior
	        		</button>	
	        	</div>
	        	<div class="col-6">
	        		<button type="button" id="next" class="btn btn-success font-sm">
	        			Rifa Siguiente <i class="fa fa-fw fa-forward"></i>
	        		</button>	
	        	</div>
        	</div>
        	
        	<swiper-container class="mySwiper" pagination="false" effect="coverflow" grab-cursor="true" centered-slides="true"
			    slides-per-view="auto" coverflow-effect-rotate="50" coverflow-effect-stretch="0" coverflow-effect-depth="100"
			    coverflow-effect-modifier="1" coverflow-effect-slide-shadows="true">
			    @foreach($raffles as $i => $raffle)
			    <swiper-slide>
			      	<div class="wrapper">
						<div class="clash-card barbarian">
						  	<div class="clash-card__image clash-card__image--barbarian">
								<img src="{{ Storage::url($raffle->imagen_premio) }}" alt="{{$raffle->imagen_premio}}" />
						  	</div>
						  	<!-- <div class="clash-card__unit-name">{{$raffle->nombre}}</div>
						  	<div class="clash-card__unit-description">
								{!! $raffle-> descripcion !!}
						  	</div> -->
						  	<div class="comprar-tickets">
                                @if ($raffle->queda > 0 && $raffle->estatus_compra == 1)
							  	<div class="boton" class="d-flex">
					                <a href="/compra/{{$raffle->id}}">
					                    <i class="fas fa-ticket-alt text-warning"></i>
					                    <span>COMPRAR TICKETS</span>
					                </a>
					            </div>
                                @endif
                                <div class="boton" class="d-flex">
					                <a href="/verificador/{{$raffle->id}}">
					                    <i class="fas fa-ticket-alt text-warning"></i>
					                    <span>VER MIS TICKETS</span>
					                </a>
					            </div>
					        </div>
						  	<div class="clash-card__unit-stats clash-card__unit-stats--barbarian clearfix">
								<div class="one-third">
									<div class="stat">{{date("d", strtotime($raffle->fecha_final))}}</div>
									<div class="stat-value">{{$raffle->mes}}</div>
								</div>
								<div class="one-third">
									<div class="stat">
										<div class="progress" role="progressbar" aria-valuenow="{{ $raffle->barra }}" aria-valuemin="0" aria-valuemax="100" style="height: 35px;">
				                          	<div class="progress-bar" style="width: {{ $raffle->barra }}%; background-color: var(--fondo) !important;">
				                            	QUEDAN {{ $raffle->barra }}%
				                          	</div>
				                        </div>
									</div>
									<div class="stat-value">Disponible</div>
								</div>
							</div>
						</div> 
					</div>
			    </swiper-slide>
			    @endforeach
			</swiper-container>
        	
        	
        </section>
    </main>
    
    
    <a href="https://wa.me/{{$whatsapp}}" class="whatsapp" target="_blank"> 
        <img src="/assets/images/icon/whatsapp.png"/>
    </a>
@endsection
