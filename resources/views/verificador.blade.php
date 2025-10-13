@extends('nuevo.layout')

<link href="{{ asset('assets/css/verificador.css?ver=2') }}" rel="stylesheet">

@php
  use Illuminate\Support\Str;
@endphp

@section('content')
  @include('nuevo.header')

  @php
    $formAction = $raffle
        ? route('verificador', ['raffle' => $raffle->id])
        : route('verificador');
  @endphp

  <section class="verifier">
    <div class="container">
      <div class="verifier-card">
        <header class="verifier-card__header">
          <h1 class="verifier-card__title">Consultar tickets</h1>
          @if($raffle)
            <p class="verifier-card__subtitle">
              Rifa seleccionada: <span>{{ $raffle->nombre }}</span>
            </p>
          @else
            <p class="verifier-card__subtitle">
              Ingresa tu número de cédula para revisar tus compras.
            </p>
          @endif
        </header>

        <nav class="verifier-nav" aria-label="Acciones rápidas">
          <a class="verifier-nav__link" href="{{ route('home') }}">
            <span class="verifier-nav__icon" aria-hidden="true">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="M3 9.5 12 3l9 6.5"></path>
                <path d="M5 10.5V20a1 1 0 0 0 1 1h4v-6h4v6h4a1 1 0 0 0 1-1v-9.5"></path>
              </svg>
            </span>
            Ir al inicio
          </a>
        </nav>

        <form class="verifier-form" method="GET" action="{{ $formAction }}">
          <label class="verifier-form__label" for="cedula">
            Número de cédula
          </label>
          <div class="verifier-form__controls">
            <input
              type="number"
              inputmode="numeric"
              pattern="[0-9]*"
              name="cedula"
              id="cedula"
              class="verifier-form__input"
              placeholder="Ej. 12345678"
              value="{{ $cedula }}"
              required
              aria-describedby="verifier-form-hint">
            <button type="submit" class="verifier-form__button">
              Buscar
            </button>
          </div>
          <span id="verifier-form-hint" class="verifier-form__hint">
            Usa la cédula sin puntos ni guiones.
          </span>
        </form>

        @if($hasSearch)
          <div class="verifier-results">
            @if($orders->isEmpty())
              <div class="verifier-empty">
                <p>
                  No encontramos compras registradas con la cédula
                  <strong>{{ $cedula }}</strong>
                  @if($raffle)
                    en esta rifa.
                  @else
                    .
                  @endif
                </p>
                <p>Verifica el número ingresado o contáctanos si necesitas ayuda.</p>
              </div>
            @else
              <ul class="verifier-list" role="list">
                @foreach($orders as $order)
                  <li class="verifier-item verifier-item--{{ $order['variant'] }}">
                    <div class="verifier-item__header">
                      <span class="verifier-badge verifier-badge--{{ $order['variant'] }}">
                        {{ $order['status'] }}
                      </span>
                      <span class="verifier-item__date">
                        {{ $order['created_at'] ?? 'Fecha no disponible' }}
                      </span>
                    </div>
                    <div class="verifier-item__body">
                      <p class="verifier-item__title">
                        {{ $order['raffle'] ?? 'Rifa' }}
                      </p>
                      <p class="verifier-item__meta">
                        {{ $order['cantidad'] }} {{ Str::plural('ticket', $order['cantidad']) }}
                      </p>
                      <p class="verifier-item__message">
                        {{ $order['message'] }}
                      </p>
                    </div>
                    @if(!empty($order['numbers']))
                      <div class="verifier-item__tickets" aria-label="Tickets aprobados">
                        @foreach($order['numbers'] as $ticket)
                          <span class="verifier-ticket">{{ $ticket }}</span>
                        @endforeach
                      </div>
                    @endif
                  </li>
                @endforeach
              </ul>
            @endif
          </div>
        @endif
      </div>

      <div class="verifier-support">
        <p>
          ¿Necesitas ayuda? Escríbenos por WhatsApp
          <a href="https://wa.me/{{ $whatsapp }}" target="_blank" rel="noopener noreferrer">
            aquí
          </a>.
        </p>
      </div>
    </div>
  </section>
@endsection
