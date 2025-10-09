@extends('nuevo.layout')

@php
    use Illuminate\Support\Str;
    $minimumTickets = max((int) ($minimumTickets ?? 1), 1);
@endphp

@section('content')
  <div id="colorlib-page">
    @include('nuevo.header')

    <main class="home-shell">
      <section class="home-hero container px-3 px-md-0">
        <div class="raffle-navigation">
          <button class="btn-nav btn-nav-prev" id="prevRaffle" aria-label="Rifa anterior">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
              <path d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
            </svg>
            Rifa Anterior
          </button>
          <button class="btn-nav btn-nav-next" id="nextRaffle" aria-label="Rifa siguiente">
            Rifa Siguiente
            <svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
              <path d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
            </svg>
          </button>
        </div>
      </section>

      <section id="seccion-rifas" class="raffle-section container px-3 px-md-0">
        <header class="raffle-section__header">
          <div>
            <h2 class="raffle-section__title">Rifas activas</h2>
            <p class="raffle-section__subtitle">
              Revisa la disponibilidad en tiempo real y entra a tus rifas favoritas.
            </p>
          </div>
        </header>
        <div class="raffle-swiper swiper">
          <div class="swiper-wrapper">
          @forelse($raffles as $raffle)
            @php
                $imageUrl = $raffle->imagen_premio
                    ? Storage::url($raffle->imagen_premio)
                    : asset('assets/images/bg/fondo.webp');
                $soldPercent = number_format($raffle->vendido ?? 0, 0);
                $ticketsLeft = number_format($raffle->queda ?? 0);
            @endphp
            <div class="swiper-slide">
              <article class="raffle-card {{ $raffle->is_featured ? 'is-featured' : '' }}">
              <div class="raffle-card__media">
                <img src="{{ $imageUrl }}" alt="Premio de la rifa {{ $raffle->nombre }}" loading="lazy">
                @if(! $raffle->is_buyable)
                  <span class="raffle-card__status is-soldout">Agotado</span>
                @elseif(($raffle->vendido ?? 0) >= 75)
                  <span class="raffle-card__status is-alerta">Últimos boletos</span>
                @endif
              </div>
              <div class="raffle-card__body">
                <div class="raffle-card__meta">
                  <span class="raffle-card__badge">{{ $raffle->sorteo_label }}</span>
                  <span class="raffle-card__price">Bs {{ number_format($raffle->precio, 2, ',', '.') }}</span>
                </div>
                <h3 class="raffle-card__title">{{ $raffle->nombre }}</h3>
                @if($raffle->descripcion)
                  <p class="raffle-card__description">
                    {{ Str::limit(strip_tags($raffle->descripcion), 120) }}
                  </p>
                @endif
                <div class="raffle-card__progress" role="progressbar" aria-valuenow="{{ $soldPercent }}" aria-valuemin="0" aria-valuemax="100">
                  <div class="raffle-card__progress-bar" style="width: {{ $soldPercent }}%"></div>
                </div>
                <div class="raffle-card__progress-hint">
                  <span>{{ $soldPercent }}% vendido</span>
                  <span>{{ $ticketsLeft }} tickets disponibles</span>
                </div>
                <div class="raffle-card__actions">
                  @if($raffle->is_buyable)
                    <a class="raffle-card__cta js-quick-buy"
                       href="{{ route('compra', ['raffle' => $raffle->id]) }}"
                       data-purchase-url="{{ route('compra', ['raffle' => $raffle->id]) }}"
                       data-raffle-name="{{ $raffle->nombre }}"
                       data-min="{{ $minimumTickets }}"
                       data-max="{{ $raffle->queda ?? '' }}"
                       data-price="{{ $raffle->precio ?? '' }}">
                      Comprar tickets
                    </a>
                  @else
                    <span class="raffle-card__cta is-disabled" aria-disabled="true">
                      Agotado
                    </span>
                  @endif
                  <a class="raffle-card__ghost" href="{{ route('verificador', ['raffle' => $raffle->id]) }}">
                    Consultar mis tickets
                  </a>
                  <a class="raffle-card__community" href="#">
                    Únete a mi comunidad
                  </a>
                </div>
              </div>
              </article>
            </div>
          @empty
            <div class="raffle-empty">
              <p>En este momento no hay rifas publicadas. Vuelve pronto o síguenos en redes para enterarte primero.</p>
            </div>
          @endforelse
          </div>
        </div>
      </section>

      <div class="quick-buy-overlay" data-quick-buy-overlay hidden aria-hidden="true">
        <div class="quick-buy-modal" role="dialog" aria-modal="true" aria-labelledby="quick-buy-title">
          <button type="button" class="quick-buy-close" data-quick-buy-close aria-label="Cerrar selector de tickets">&times;</button>
          <header class="quick-buy-header">
            <h2 id="quick-buy-title">Selecciona tus tickets</h2>
            <p class="quick-buy-subtitle" data-quick-buy-subtitle></p>
          </header>
          <div class="quick-buy-body">
            <div class="quick-buy-counter">
              <button type="button" class="quick-buy-counter__btn" data-quick-buy-decrease aria-label="Disminuir cantidad">
                <span aria-hidden="true">−</span>
              </button>
              <input
                type="number"
                inputmode="numeric"
                min="{{ $minimumTickets }}"
                value="{{ $minimumTickets }}"
                step="1"
                data-quick-buy-input
                aria-live="polite"
                aria-label="Cantidad de tickets seleccionada">
              <button type="button" class="quick-buy-counter__btn" data-quick-buy-increase aria-label="Incrementar cantidad">
                <span aria-hidden="true">+</span>
              </button>
            </div>
            <div class="quick-buy-shortcuts" data-quick-buy-shortcuts aria-label="Selecciona rápidamente la cantidad deseada"></div>
            <p class="quick-buy-price" data-quick-buy-price hidden></p>
          </div>
          <footer class="quick-buy-footer">
            <button type="button" class="quick-buy-button quick-buy-button--secondary" data-quick-buy-close>
              Cancelar
            </button>
            <button type="button" class="quick-buy-button quick-buy-button--primary" data-quick-buy-confirm>
              Continuar
            </button>
          </footer>
        </div>
      </div>
    </main>
  </div>
@endsection
