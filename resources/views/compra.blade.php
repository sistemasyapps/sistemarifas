<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>{{config('app.name')}} - Comprar Boleto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="{{asset('assets/css/compra.css')}}?ver=3" rel="stylesheet">
    <style>
      /* Modern UI Styles */
      .modern-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
      }
      
      .modern-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 32px 64px -12px rgba(0, 0, 0, 0.6), 0 0 0 1px rgba(255, 255, 255, 0.1);
      }

      /* Modern Input Group */
      .modern-input-group {
        margin-bottom: 1rem;
      }

      .modern-label {
        display: block;
        color: #94a3b8;
        font-weight: 600;
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
        transition: color 0.3s ease;
      }

      .modern-label i {
        color: #10b981;
        opacity: 0.8;
      }

      .modern-form-control {
        background: rgba(30, 41, 59, 0.5) !important;
        border: 1px solid rgba(148, 163, 184, 0.2) !important;
        border-radius: 12px !important;
        color: white !important;
        font-size: 1rem !important;
        padding: 1rem !important;
        transition: all 0.3s ease !important;
        position: relative;
      }

      .modern-form-control::placeholder {
        color: rgba(148, 163, 184, 0.5) !important;
      }

      .modern-form-control:focus {
        background: rgba(30, 41, 59, 0.8) !important;
        border-color: #10b981 !important;
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.15) !important;
        transform: translateY(-1px) !important;
        outline: none !important;
      }

      .modern-form-control:hover {
        border-color: rgba(148, 163, 184, 0.4) !important;
        background: rgba(30, 41, 59, 0.7) !important;
      }

      /* Focus effect on label when input is focused */
      .modern-input-group .modern-form-control:focus + .modern-label,
      .modern-input-group:focus-within .modern-label {
        color: #10b981;
      }

      .modern-input-group .modern-form-control:focus ~ .modern-label,
      .modern-input-group:focus-within .modern-label {
        color: #10b981;
      }

      /* Button Styles */
      .modern-btn-success:hover {
        background: linear-gradient(135deg, #059669, #047857) !important;
        transform: translateY(-2px);
        box-shadow: 0 15px 35px rgba(16, 185, 129, 0.4) !important;
      }

      .modern-btn-success:active {
        transform: translateY(0);
        box-shadow: 0 5px 15px rgba(16, 185, 129, 0.3) !important;
      }

      /* Select styling */
      .modern-form-control option {
        background: #1e293b !important;
        color: white !important;
      }

      /* Loading button animation */
      .modern-btn-success[disabled] {
        background: linear-gradient(135deg, #6b7280, #4b5563) !important;
        cursor: not-allowed;
      }

      @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.5; }
      }

      .modern-btn-success.loading {
        animation: pulse 1.5s infinite;
      }

      /* File input modern styling */
      .modern-form-control[type="file"] {
        padding: 0.875rem 1rem !important;
        font-weight: 600 !important;
        cursor: pointer !important;
      }

      .modern-form-control[type="file"]:hover {
        border-color: rgba(148, 163, 184, 0.5) !important;
        background: rgba(30, 41, 59, 0.8) !important;
      }

      /* Info text styling */
      .info-text {
        font-size: 0.875rem;
        color: #94a3b8;
        display: flex;
        align-items: center;
        gap: 0.25rem;
        margin-top: 0.5rem;
      }

      .info-text-small {
        font-size: 0.8rem;
        color: #94a3b8;
        display: flex;
        align-items: center;
        gap: 0.25rem;
        margin-top: 0.25rem;
      }

      /* Mobile responsiveness - Mobile First Approach */
      @media (max-width: 768px) {
        .modern-card {
          margin: 0.5rem 0 !important;
          padding: 1rem !important;
          border-radius: 16px !important;
        }

        .modern-card .card-body {
          padding: 1rem !important;
        }

        .modern-card h3 {
          font-size: 1.5rem !important;
        }

        /* Compact section headers */
        .modern-card h4 {
          font-size: 1rem !important;
        }

        .modern-card .d-flex.align-items-center.mb-3 {
          margin-bottom: 0.5rem !important;
          padding-bottom: 0.5rem !important;
        }

        .modern-card .d-flex.align-items-center.mb-3 .d-inline-flex {
          width: 1.75rem !important;
          height: 1.75rem !important;
          margin-right: 0.5rem !important;
        }

        .modern-card .d-flex.align-items-center.mb-3 .d-inline-flex i {
          font-size: 0.85rem !important;
        }

        /* Info icon in headers */
        .modern-card .d-flex.align-items-center.mb-3 .fa-info-circle {
          font-size: 0.9rem !important;
        }

        /* Compact sections */
        .modern-card .mb-4 {
          margin-bottom: 1rem !important;
        }

        .modern-card .mb-3 {
          margin-bottom: 0.75rem !important;
        }

        /* Payment methods compact - MOBILE SPECIFIC */
        .payment-method-card {
          padding: 0.5rem !important;
          border-radius: 8px !important;
          min-height: 44px !important;
        }

        .payment-method-card > div,
        .payment-method-card > div.d-flex,
        .payment-method-card div.d-flex.align-items-center,
        div.payment-method-card > div:first-child {
          display: flex !important;
          flex-direction: row !important;
          align-items: center !important;
          justify-content: flex-start !important;
          flex-wrap: nowrap !important;
        }

        div.col-6 > div.payment-method-card > div.d-flex {
          flex-direction: row !important;
        }

        .payment-method-card .payment-logo,
        .payment-method-card div.payment-logo {
          width: 30px !important;
          height: 30px !important;
          min-width: 30px !important;
          max-width: 30px !important;
          margin-right: 0.4rem !important;
          margin-bottom: 0 !important;
          border-radius: 6px !important;
          flex-shrink: 0 !important;
          display: flex !important;
          align-items: center !important;
          justify-content: center !important;
        }

        .payment-method-card .payment-logo img,
        .payment-method-card div.payment-logo img {
          width: 20px !important;
          height: 20px !important;
          max-width: 20px !important;
          max-height: 20px !important;
        }

        .payment-method-card .payment-name,
        .payment-method-card div.payment-name {
          font-size: 0.7rem !important;
          line-height: 1.15 !important;
          word-break: break-word !important;
          text-align: left !important;
          flex: 1 !important;
        }

        .payment-method-card .flex-grow-1,
        .payment-method-card div.flex-grow-1 {
          flex: 1 !important;
          min-width: 0 !important;
          display: flex !important;
          align-items: center !important;
        }

        .modern-form-control {
          padding: 0.75rem !important;
          font-size: 0.9rem !important;
        }

        .modern-label {
          font-size: 0.8rem !important;
          margin-bottom: 0.4rem !important;
        }

        .modern-input-group {
          margin-bottom: 0.75rem !important;
        }

        /* Row spacing */
        .row.g-2 {
          row-gap: 0.5rem !important;
        }

        /* Contestant form compact spacing */
        .contestant-form .modern-form-control {
          padding: 0.65rem !important;
        }

        .contestant-form .modern-label {
          margin-bottom: 0.3rem !important;
        }

        .contestant-form .modern-input-group {
          margin-bottom: 0.45rem !important;
        }

        .contestant-form .row.g-2 {
          row-gap: 0.3rem !important;
        }

        .contestant-form .row.g-2.mb-2 {
          margin-bottom: 0.4rem !important;
        }

        /* Payment data card compact layout */
        .payment-data-card {
          padding: 0.7rem 0.9rem 0.65rem !important;
        }

        .payment-data-card .payment-data-header {
          display: flex !important;
          align-items: center !important;
          justify-content: space-between !important;
          gap: 0.6rem !important;
          flex-wrap: wrap !important;
        }

        .payment-data-card .payment-data-title {
          display: flex !important;
          align-items: center !important;
          gap: 0.6rem !important;
          flex: 1 1 auto !important;
          min-width: 0 !important;
        }

        .payment-data-card .payment-data-icon {
          display: inline-flex !important;
          align-items: center !important;
          justify-content: center !important;
          width: 2.2rem !important;
          height: 2.2rem !important;
          border-radius: 50% !important;
          background: linear-gradient(135deg, #10b981, #059669) !important;
          box-shadow: 0 6px 15px rgba(16, 185, 129, 0.35) !important;
          flex-shrink: 0 !important;
        }

        .payment-data-card .payment-data-icon i {
          font-size: 1rem !important;
          color: #ffffff !important;
        }

        .payment-data-card h4 {
          font-size: 0.95rem !important;
          margin: 0 !important;
          color: #34d399 !important;
          font-weight: 700 !important;
          white-space: nowrap !important;
        }

        .payment-data-card .payment-data-summary {
          display: flex !important;
          align-items: center !important;
          justify-content: flex-end !important;
          gap: 0.5rem !important;
          flex-wrap: wrap !important;
          font-size: 0.8rem !important;
        }

        .payment-data-card .payment-data-summary .summary-item {
          display: inline-flex !important;
          align-items: center !important;
          gap: 0.25rem !important;
          color: #f1f5f9 !important;
          font-weight: 600 !important;
        }

        .payment-data-card .payment-data-summary .summary-item.summary-total {
          color: #34d399 !important;
          font-weight: 700 !important;
        }

        .payment-data-card .payment-data-summary .summary-label {
          opacity: 0.75 !important;
        }

        .payment-data-card .payment-data-summary .summary-separator {
          opacity: 0.35 !important;
          margin: 0 !important;
          color: #cbd5f5 !important;
        }

        .payment-data-card .payment-data-body {
          display: flex !important;
          align-items: flex-start !important;
          justify-content: space-between !important;
          gap: 0.65rem !important;
          flex-wrap: wrap !important;
          margin-top: 0.45rem !important;
        }

        .payment-data-card .payment-data-details {
          font-size: 0.8rem !important;
          padding: 0.5rem 0.65rem !important;
          background: rgba(30, 41, 59, 0.35) !important;
          border-radius: 8px !important;
          margin: 0 !important;
          text-align: center !important;
          color: #ffffff !important;
          line-height: 1.35 !important;
          flex: 1 1 0 !important;
        }

        .payment-data-card .payment-data-copy {
          padding: 0.45rem 0.85rem !important;
          font-size: 0.8rem !important;
          border-radius: 10px !important;
          display: inline-flex !important;
          align-items: center !important;
          gap: 0.35rem !important;
          box-shadow: 0 6px 15px rgba(16, 185, 129, 0.25) !important;
          white-space: nowrap !important;
          align-self: flex-start !important;
          color: #ffffff !important;
          font-weight: 600 !important;
          transition: all 0.3s ease !important;
        }

        /* Mobile-first responsive adjustments */
        @media (max-width: 575.98px) {
          .payment-data-card {
            padding: 0.65rem 0.85rem 0.6rem !important;
          }

          .payment-data-card h4 {
            font-size: 0.88rem !important;
            white-space: normal !important;
          }

          .payment-data-card .payment-data-icon {
            width: 2rem !important;
            height: 2rem !important;
          }

          .payment-data-card .payment-data-icon i {
            font-size: 0.95rem !important;
          }

          .payment-data-card .payment-data-summary {
            width: 100% !important;
            justify-content: space-between !important;
            gap: 0.35rem !important;
            font-size: 0.78rem !important;
          }

          .payment-data-card .payment-data-summary .summary-item {
            white-space: normal !important;
          }

          .payment-data-card .payment-data-body {
            flex-wrap: nowrap !important;
            gap: 0.5rem !important;
            margin-top: 0.4rem !important;
          }

          .payment-data-card .payment-data-details {
            font-size: 0.78rem !important;
            padding: 0.45rem 0.6rem !important;
            line-height: 1.3 !important;
          }

          .payment-data-card .payment-data-copy {
            padding: 0.4rem 0.7rem !important;
            font-size: 0.78rem !important;
          }

          .payment-data-card .payment-data-note {
            font-size: 0.68rem !important;
            margin-top: 0.35rem !important;
            line-height: 1.25 !important;
          }
        }

        /* Main action button compact */
        .modern-btn-success {
          padding: 0.75rem 1.5rem !important;
          font-size: 0.95rem !important;
        }

        .d-grid.mt-2 {
          margin-top: 0.5rem !important;
        }

        /* Payment report specific mobile styles */
        .modern-card[style*="background: rgba(30, 41, 59, 0.2)"] {
          padding: 1.5rem 1rem !important;
        }

        .modern-card[style*="background: rgba(30, 41, 59, 0.2)"] h3 {
          font-size: 1.4rem !important;
        }

        .modern-card[style*="background: rgba(30, 41, 59, 0.2)"] p {
          font-size: 1rem !important;
        }

        /* Icon container mobile adjustments */
        .modern-card[style*="background: rgba(30, 41, 59, 0.2)"] .d-inline-flex {
          width: 3.5rem !important;
          height: 3.5rem !important;
        }

        .modern-card[style*="background: rgba(30, 41, 59, 0.2)"] .d-inline-flex i {
          font-size: 1.75rem !important;
        }
      }

      /* Tooltips for info icons */
      .info-tooltip {
        position: relative;
        display: inline-block;
        cursor: pointer;
      }

      .info-tooltip-text {
        visibility: hidden;
        opacity: 0;
        position: absolute;
        right: 0;
        top: 100%;
        margin-top: 0.5rem;
        background: rgba(30, 41, 59, 0.98);
        color: #e2e8f0;
        text-align: center;
        border-radius: 8px;
        padding: 0.5rem 0.75rem;
        font-size: 0.75rem;
        font-weight: 500;
        z-index: 1000;
        width: 200px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        border: 1px solid rgba(148, 163, 184, 0.2);
        transition: opacity 0.3s ease, visibility 0.3s ease;
      }

      .info-tooltip-text::before {
        content: "";
        position: absolute;
        bottom: 100%;
        right: 10px;
        border-width: 5px;
        border-style: solid;
        border-color: transparent transparent rgba(30, 41, 59, 0.98) transparent;
      }

      .info-tooltip.active .info-tooltip-text {
        visibility: visible;
        opacity: 1;
      }

      /* Payment Methods Hover Effects */
      .payment-method-card:hover {
        transform: translateY(-3px);
        border-color: #10b981 !important;
        background: rgba(16, 185, 129, 0.1) !important;
        box-shadow: 0 15px 35px rgba(16, 185, 129, 0.2) !important;
      }

      .payment-method-card .btn:hover {
        background: linear-gradient(135deg, #059669, #047857) !important;
        transform: scale(1.05);
        box-shadow: 0 8px 20px rgba(16, 185, 129, 0.4) !important;
      }

      .payment-method-card.active {
        border-color: #10b981 !important;
        background: rgba(16, 185, 129, 0.15) !important;
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.3) !important;
      }

      /* Animations */
      @keyframes pulseGlow {
        0%, 100% { 
          box-shadow: 0 0 15px rgba(16, 185, 129, 0.3);
        }
        50% { 
          box-shadow: 0 0 25px rgba(16, 185, 129, 0.6);
        }
      }

      #payment_data_step0,
      #payment_data_step1 {
        animation: pulseGlow 2s infinite;
      }
      #payment_data_step0 *,
      #payment_data_step1 * {
        color: #10b981 !important;
      }

      /* Notification Animations */
      @keyframes slideInRight {
        from {
          transform: translateX(100%);
          opacity: 0;
        }
        to {
          transform: translateX(0);
          opacity: 1;
        }
      }

      @keyframes slideOutRight {
        from {
          transform: translateX(0);
          opacity: 1;
        }
        to {
          transform: translateX(100%);
          opacity: 0;
        }
      }

      /* Modern Action Buttons Styles */
      .modern-btn-primary {
        position: relative;
        overflow: hidden;
        transform: translateZ(0);
      }

      .modern-btn-primary::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
      }

      .modern-btn-primary:hover {
        transform: translateY(-2px) scale(1.02);
        box-shadow: 0 20px 40px rgba(16, 185, 129, 0.4) !important;
        background: linear-gradient(135deg, #059669, #047857) !important;
      }

      .modern-btn-primary:hover::before {
        left: 100%;
      }

      .modern-btn-primary:active {
        transform: translateY(0) scale(0.98);
      }

      .modern-btn-secondary:hover {
        background: rgba(239, 68, 68, 0.2) !important;
        border-color: rgba(239, 68, 68, 0.5) !important;
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(239, 68, 68, 0.2);
      }

      .modern-btn-secondary:active {
        transform: translateY(0);
      }

      /* Payment data copy button styles */
      .modern-card .btn:hover {
        background: linear-gradient(135deg, #059669, #047857) !important;
        transform: translateY(-2px);
        box-shadow: 0 15px 30px rgba(16, 185, 129, 0.4) !important;
      }

      .modern-card .btn:active {
        transform: translateY(0);
      }

      /* Loading state for purchase button */
      .modern-btn-primary:disabled {
        background: rgba(148, 163, 184, 0.7) !important;
        box-shadow: 0 5px 15px rgba(148, 163, 184, 0.2) !important;
        transform: none !important;
        cursor: not-allowed;
        opacity: 0.8;
      }

      .modern-btn-primary:disabled:hover {
        transform: none !important;
        background: rgba(148, 163, 184, 0.7) !important;
        box-shadow: 0 5px 15px rgba(148, 163, 184, 0.2) !important;
      }

      /* Extra small devices - phones in portrait */
      @media (max-width: 576px) {
        .modern-card {
          margin: 0.75rem 0 !important;
          padding: 1rem !important;
          border-radius: 12px !important;
        }

        .modern-form-control {
          padding: 0.75rem !important;
          font-size: 0.9rem !important;
        }

        .modern-label {
          font-size: 0.8rem !important;
        }

        /* Payment form mobile optimizations */
        .modern-card[style*="background: rgba(30, 41, 59, 0.2)"] .row {
          margin: 0 -0.5rem;
        }

        .modern-card[style*="background: rgba(30, 41, 59, 0.2)"] .col-md-6 {
          padding: 0 0.5rem;
          margin-bottom: 0.75rem;
        }

        .modern-card[style*="background: rgba(30, 41, 59, 0.2)"] .text-center {
          margin-bottom: 1.5rem !important;
        }

        /* Mobile payment methods */
        .payment-method-card {
          padding: 1rem !important;
        }
        
        .payment-method-card .d-flex {
          flex-direction: column !important;
          text-align: center !important;
        }
        
        .payment-method-card .payment-logo {
          margin-bottom: 1rem !important;
          margin-right: 0 !important;
        }

        /* Mobile optimizations for forms */
        .modern-card .card-body {
          padding: 1.5rem !important;
        }
        
        .modern-form-control {
          padding: 0.75rem 1rem !important;
          font-size: 0.95rem !important;
        }
        
        .modern-card .row.g-4 {
          row-gap: 0.75rem !important;
        }

        /* Mobile optimizations for summary section */
        .modern-card .row.g-3 .col-md-4,
        .modern-card .row.g-3 .col-md-6 {
          margin-bottom: 0.75rem;
        }

        /* Optimize 3-column layout on mobile */
        .modern-card .col-md-4 {
          flex: 0 0 100%;
          max-width: 100%;
        }
        
        /* Center content on mobile */
        .modern-card .d-flex[style*="text-align: center"] {
          justify-content: center !important;
        }

        /* Modern action buttons - mobile */
        .modern-btn-primary,
        .modern-btn-secondary {
          padding: 0.875rem 1rem !important;
          font-size: 1rem !important;
        }

        /* Payment data section mobile optimization */
        .modern-card .row.g-3 .col-md-6 {
          margin-bottom: 0.75rem;
        }
        
        /* Additional mobile compacting */
        @media (max-width: 768px) {
          .modern-card .text-center {
            margin-bottom: 1rem !important;
          }
          
          .modern-card .row {
            margin-bottom: 0.75rem !important;
          }
        }
      }
    </style>
    
    <style>
      .ticket-chip-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 0.75rem;
        margin-top: 1.5rem;
      }

      .ticket-chip {
        background: rgba(16, 185, 129, 0.18);
        color: #10b981;
        border: 1px solid rgba(16, 185, 129, 0.45);
        border-radius: 9999px;
        padding: 0.5rem 1.2rem;
        font-weight: 700;
        font-size: 1rem;
        letter-spacing: 0.04em;
        box-shadow: 0 8px 20px rgba(16, 185, 129, 0.25);
        text-transform: uppercase;
      }

      .order-approved-actions {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 1rem;
        margin-top: 2.5rem;
      }
    </style>
    
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-56EB9E6237"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'G-56EB9E6237');
    </script>
  </head>
  <body>
    @php
      $cantidadMinima = max((int) ($cantidad_minima ?? 1), 1);
      $initialTickets = max((int) request()->input('q', $cantidadMinima), $cantidadMinima);
    @endphp
    <div class="wpb-content--blank">
      <article id="post-25415" class="post-25415 page type-page status-private hentry">
        <div class="entry-content">
          <div class="container-fluid">
            <div class="row paso0" id="paso0">
              <!-- Tarjeta Unificada -->
              <div class="col-md-8 col-sm-12 col-xs-12 mx-auto">
                <div class="modern-card" style="background: linear-gradient(135deg, rgba(15, 23, 42, 0.95) 0%, rgba(30, 41, 59, 0.9) 100%); border-radius: 20px; border: 1px solid rgba(148, 163, 184, 0.2); box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5), 0 0 0 1px rgba(255, 255, 255, 0.05); backdrop-filter: blur(10px); padding: 2rem;">

                  <!-- Sección de Métodos de Pago -->
                  <div class="mb-4">
                    <div class="d-flex align-items-center mb-3" style="border-bottom: 1px solid rgba(148, 163, 184, 0.1); padding-bottom: 0.75rem;">
                      <div class="d-inline-flex align-items-center justify-content-center me-3" style="width: 2.5rem; height: 2.5rem; background: linear-gradient(135deg, #10b981, #059669); border-radius: 12px; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);">
                        <i class="fas fa-credit-card" style="font-size: 1.2rem; color: white;"></i>
                      </div>
                      <div class="flex-grow-1">
                        <h4 class="text-white mb-0" style="font-weight: 700; font-size: 1.25rem; letter-spacing: -0.025em;">Seleccione el método de pago</h4>
                      </div>
                      <div class="info-tooltip" onclick="toggleTooltip(this)">
                        <i class="fas fa-info-circle" style="color: #94a3b8; font-size: 1.1rem;"></i>
                        <span class="info-tooltip-text">Selecciona cómo procesarás tu pago</span>
                      </div>
                    </div>

                    <div class="row g-2">
                      @foreach($metodos as $i => $metodo)
                      @php
                        $requiresCedulaPagador = \Illuminate\Support\Str::contains($metodo->descripcion, '{{CEDULA_PAGADOR}}');
                      @endphp
                      <div class="col-6 col-md-6">
                        <div class="payment-method-card" style="background: rgba(30, 41, 59, 0.4); border: 2px solid rgba(148, 163, 184, 0.2); border-radius: 12px; padding: 1rem; cursor: pointer; transition: all 0.3s ease; position: relative; overflow: hidden;" id="step0_metodo_{{$metodo->id}}" data-metodo='@json($metodo->only(["id","metodo","descripcion"]))' data-requires-cedula="{{ $requiresCedulaPagador ? '1' : '0' }}" onclick="selectPaymentMethod(this)">
                          <div class="d-flex align-items-center">
                            <div class="payment-logo me-3" style="width: 50px; height: 50px; display: flex; align-items-center; justify-content: center; background: rgba(255, 255, 255, 0.1); border-radius: 10px; backdrop-filter: blur(10px);">
                              <img src="{{Storage::url($metodo->logo)}}" style="width: 35px; height: 35px; border-radius: 8px; object-fit: cover;" class="img_payment">
                            </div>
                            <div class="flex-grow-1">
                              <div class="payment-name" style="color: white; font-weight: 600; font-size: 1rem;">
                                {!!$metodo['metodo']!!}
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      @endforeach
                    </div>
                  </div>

                  <!-- Sección de Datos del Concursante -->
                  <div class="mb-3">
                    <div class="d-flex align-items-center mb-3" style="border-bottom: 1px solid rgba(148, 163, 184, 0.1); padding-bottom: 0.75rem;">
                      <div class="d-inline-flex align-items-center justify-content-center me-3" style="width: 2.5rem; height: 2.5rem; background: linear-gradient(135deg, #10b981, #059669); border-radius: 12px; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);">
                        <i class="fas fa-user-edit" style="font-size: 1.2rem; color: white;"></i>
                      </div>
                      <div class="flex-grow-1">
                        <h4 class="text-white mb-0" style="font-weight: 700; font-size: 1.25rem; letter-spacing: -0.025em;">Datos del Concursante</h4>
                      </div>
                      <div class="info-tooltip" onclick="toggleTooltip(this)">
                        <i class="fas fa-info-circle" style="color: #94a3b8; font-size: 1.1rem;"></i>
                        <span class="info-tooltip-text">Completa tu información personal</span>
                      </div>
                    </div>

                            <!-- Compact Total Badge - HIDDEN -->
                            <div class="text-center mb-3" style="display: none;">
                              <div class="d-inline-block px-3 py-1" style="background: rgba(16, 185, 129, 0.15); border: 1px solid rgba(16, 185, 129, 0.4); border-radius: 20px;">
                                <span class="text-emerald-400" style="font-weight: 600; font-size: 0.9rem;">Total: </span>
                                <span class="text-emerald-400" id="pre_final_bs" style="font-weight: 700; font-size: 1rem;"></span>
                              </div>
                            </div>

                            <!-- Form Fields -->
                            <form class="contestant-form">
                              <div class="row g-2 mb-2">
                                <div class="col-md-6">
                                  <div class="modern-input-group">
                                    <label for="pre_cedula" class="modern-label">
                                      <i class="fas fa-id-card me-2"></i>Cédula
                                    </label>
                                    <input type="number" id="pre_cedula" class="form-control modern-form-control" inputmode="numeric" placeholder="12345678">
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="modern-input-group">
                                    <label for="pre_nombre" class="modern-label">
                                      <i class="fas fa-user me-2"></i>Nombre completo
                                    </label>
                                    <input type="text" id="pre_nombre" class="form-control modern-form-control" maxlength="100" placeholder="Nombre y Apellido">
                                  </div>
                                </div>
                              </div>

                              <div class="row g-2 mb-2">
                                <div class="col-md-6">
                                  <div class="modern-input-group">
                                    <label for="pre_correo" class="modern-label">
                                      <i class="fas fa-envelope me-2"></i>Correo electrónico
                                    </label>
                                    <input type="email" id="pre_correo" class="form-control modern-form-control" maxlength="100" placeholder="tucorreo@dominio.com">
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="modern-input-group">
                                    <label for="pre_telefono" class="modern-label">
                                      <i class="fas fa-phone me-2"></i>Teléfono
                                    </label>
                                    <input type="text" id="pre_telefono" class="form-control modern-form-control" maxlength="11" inputmode="numeric" placeholder="0412XXXXXXX">
                                  </div>
                                </div>
                              </div>

                              <div class="row g-2 mb-2" id="payer_cedula_row" style="display: none;">
                                <div class="col-md-12">
                                  <div class="modern-input-group">
                                    <label for="pre_emisor_cedula" class="modern-label">
                                      <i class="fas fa-id-badge me-2"></i>Cédula del titular de la cuenta
                                    </label>
                                    <input type="text" id="pre_emisor_cedula" class="form-control modern-form-control" maxlength="12" inputmode="numeric" placeholder="Ingresa la cédula del titular de la cuenta">
                                  </div>
                                </div>
                              </div>

                              <!-- Datos para el Pago (ocultos inicialmente) - AHORA ARRIBA DEL BOTÓN -->
                              <div id="payment_data_container" style="display: none; margin: 0.75rem 0;">
                                <div class="modern-card payment-data-card" style="background: linear-gradient(135deg, rgba(16, 185, 129, 0.1), rgba(5, 150, 105, 0.1)); border: 2px solid rgba(16, 185, 129, 0.3); border-radius: 16px; padding: 0.9rem 1rem; position: relative; overflow: hidden;">
                                  <div class="payment-data-header">
                                    <div class="payment-data-title">
                                      <div class="payment-data-icon">
                                        <i class="fas fa-university"></i>
                                      </div>
                                      <h4>Datos para el Pago</h4>
                                    </div>
                                    <div class="payment-data-summary">
                                      <span class="summary-item">
                                        <span class="summary-label">Tickets:</span>
                                        <span class="summary-value" id="top_tickets_display">{{ $initialTickets }}</span>
                                      </span>
                                      <span class="summary-separator">•</span>
                                      <span class="summary-item summary-total">
                                        <span class="summary-label">Total:</span>
                                        <span class="summary-value" id="top_total_display"></span>
                                      </span>
                                    </div>
                                  </div>
                                  <div class="payment-data-body">
                                    <div class="payment-data-details" id="payment_data_step0"></div>
                                    <button class="btn payment-data-copy" style="background: linear-gradient(135deg, #10b981, #059669); border: none; color: white;" onclick="copiarDatosCompletos(document.getElementById('payment_data_step0').innerHTML)" type="button">
                                      <i class="fas fa-copy"></i>Copiar
                                    </button>
                                  </div>
                                  <div class="payment-data-note" id="payment_data_note" style="display: none; font-size: 0.7rem; color: #fbbf24; opacity: 0.9; margin-top: 0.4rem; text-align: center; font-style: italic; line-height: 1.3;">
                                    Nota: la cédula es la del titular de la cuenta.
                                  </div>
                                </div>
                                <div id="manual_upload_container" style="display: none; margin-top: 1rem;">
                                  <div class="row g-3">
                                    <div class="col-12">
                                      <div class="modern-input-group">
                                        <label for="archivo_pago" class="modern-label">
                                          <i class="fas fa-camera me-2"></i>Comprobante de pago
                                        </label>
                                        <input type="file" accept="image/jpeg,image/png,image/svg+xml" id="archivo_pago" name="archivo_pago" class="form-control modern-form-control" style="font-weight: 600; padding: 0.875rem 1rem;">
                                        <div class="info-text mt-2">
                                          <i class="fas fa-info-circle"></i>
                                          <span>Sube una imagen clara del comprobante (JPG, PNG o SVG, máximo 4 MB).</span>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                      <div class="modern-input-group">
                                        <label for="ref" class="modern-label">
                                          <i class="fas fa-hashtag me-2"></i>Referencia bancaria
                                        </label>
                                        <input type="text" id="ref" name="ref" class="form-control modern-form-control" maxlength="6" placeholder="123456" inputmode="numeric" autocomplete="off">
                                        <div class="info-text-small mt-1">
                                          <i class="fas fa-info-circle"></i>
                                          <span>Introduce los últimos 6 dígitos de la referencia.</span>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>

                              <div class="d-grid mt-2">
                                <button type="button" class="btn modern-btn-success" id="btnPreOrder" style="background: linear-gradient(135deg, #10b981, #059669); border: none; border-radius: 12px; padding: 1rem 2rem; font-weight: 600; font-size: 1.1rem; color: white; transition: all 0.3s ease; position: relative; overflow: hidden; box-shadow: 0 10px 25px rgba(16, 185, 129, 0.3);">
                                  <span class="d-flex align-items-center justify-content-center">
                                    <i class="fas fa-eye me-2" id="btnIcon"></i>
                                    <span id="btnText">Ver datos para el pago</span>
                                  </span>
                                </button>
                              </div>
                              <div id="payment_scroll_anchor" style="height: 1px;"></div>
                            </form>
                  </div>
                </div>
              </div>
            </div>

    <!-- Pantalla de verificación automática -->
    <div class="row paso_verificando hidden" id="paso_verificando">
      <div class="col-md-6 col-sm-12 col-xs-12 mx-auto">
        <div class="vc_row wpb_row vc_row-fluid slide_pasos">
          <div class="wpb_column container-fluid vc_col-sm-12">
            <div class="vc_column-inner">
              <div class="wpb_wrapper">
                <div class="modern-card" style="background: linear-gradient(135deg, rgba(15, 23, 42, 0.95) 0%, rgba(30, 41, 59, 0.9) 100%); border-radius: 20px; border: 1px solid rgba(148, 163, 184, 0.2); box-shadow: 0 30px 50px -12px rgba(0, 0, 0, 0.55);">
                  <div class="card-body text-center" style="padding: 2.5rem 2rem;">
                    <div class="mb-4">
                      <div class="spinner-border text-success" role="status" style="width: 3rem; height: 3rem;">
                        <span class="visually-hidden">Loading...</span>
                      </div>
                    </div>
                    <h2 class="text-white mb-2" style="font-weight: 700;">Verificando tu pago...</h2>
                    <p class="text-slate-300" style="font-size: 1rem;">Estamos validando la confirmación con tu banco. Este proceso puede tardar unos minutos. Te notificaremos automáticamente cuando se acrediten tus números.</p>
                    <p class="text-slate-400 mt-4" id="verificando_uuid" style="font-size: 0.9rem;"></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

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
            <div class="vc_row-full-width vc_clearfix"></div>
            <div id="paso_final" data-vc-full-width="true" data-vc-full-width-init="false" class="vc_row wpb_row vc_row-fluid hidden row slide_pasos paso5">
              <div class="wpb_column container-fluid vc_col-sm-12">
                <div class="vc_column-inner">
                  <div class="wpb_wrapper">
                    <div class="modern-card" style="background: linear-gradient(135deg, rgba(15, 23, 42, 0.95) 0%, rgba(30, 41, 59, 0.9) 100%); border-radius: 20px; border: 1px solid rgba(148, 163, 184, 0.2); box-shadow: 0 30px 50px -12px rgba(0, 0, 0, 0.55);">
                      <div class="card-body text-center" style="padding: 2.75rem 2.25rem;">
                        <div id="order_result_content">
                          <div class="mb-4">
                            <i class="fas fa-clock" style="font-size: 3rem; color: #fbbf24;"></i>
                          </div>
                          <h2 class="text-white mb-3" style="font-weight: 700;">Estamos preparando tu confirmación</h2>
                          <p class="text-slate-300" style="font-size: 1rem;">En cuanto el banco confirme tu pago, verás aquí tus números asignados y un enlace directo para consultarlos.</p>
                          <div class="order-approved-actions">
                            <button class="btn btn-outline-light" type="button" onclick="volver_comprar()">
                              <i class="fas fa-shopping-cart me-2"></i>Hacer otra compra
                            </button>
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
          <img src="{{ Storage::url($logo)}}" class="img" />
        </div>
      </div>
      <div class="vc_row-full-width vc_clearfix"></div>
      @include("partials.terminos")

    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    @php($fechaInicialProximoSorteo = $rifa->fecha_inicial ? \Illuminate\Support\Carbon::parse($rifa->fecha_inicial)->format('d/m/Y') : null)
    <script>
      let PRE_ORDER_UUID = null;
      const modalTerms = new bootstrap.Modal(document.getElementById('termsModal'), {
        keyboard: false
      });
      modalTerms.show();

      let cant_boletos = document.getElementById("cant_boletos");
      // No se usan inputs clonados en este paso
      let paso = 1;
      let quedan = 10000 - {{$queda}};
      let cantidad_minima = {{$cantidad_minima}};

      // function consultarAPI() {
      //   return new Promise((resolve, reject) => {
      //     fetch('{{config("app.url")}}/api/getBarra/{{ $rifa->id }}')
      //       .then(response => response.json())
      //       .then(data => {
      //         const {barra, queda} = data;
      //         quedan = queda;
      //         // Update modern progress bar
      //         const barraElement = document.getElementById("barraRealTime");
      //         const barraText = document.getElementById("barraRealTimeText");
      //         if (barraElement) {
      //           barraElement.style.width = `${barra}%`;
      //         }
      //         if (barraText) {
      //           barraText.textContent = `${barra}%`;
      //         }
              
      //         if(queda <= 1){
      //           document.getElementById("boton_comprar").style.visibility = "hidden";
      //         }

      //         resolve(data);
      //       })
      //       .catch(error => {
      //         console.error('Error al consultar la API:', error);
      //         reject(error);
      //       });
      //   });
      // }

      // setInterval(() => {
      //   consultarAPI()
      //     .then(data => {
      //       console.log('Datos actualizados:', data);
      //     })
      //     .catch(error => {
      //       console.error('Error en la actualización:', error);
      //     });
      // }, 2000); 

      // Helper robusto para copiar al portapapeles con fallback en contextos no seguros
      function copyToClipboard(text) {
        if (navigator.clipboard && window.isSecureContext) {
          return navigator.clipboard.writeText(text);
        }
        return new Promise((resolve, reject) => {
          try {
            const textarea = document.createElement('textarea');
            textarea.value = text;
            textarea.style.position = 'fixed';
            textarea.style.top = '-1000px';
            textarea.style.left = '-1000px';
            document.body.appendChild(textarea);
            textarea.focus();
            textarea.select();
            const successful = document.execCommand('copy');
            document.body.removeChild(textarea);
            successful ? resolve() : reject(new Error('execCommand failed'));
          } catch (err) {
            reject(err);
          }
        });
      }

      function copiarTexto(text){
        const normalized = String(text)
          .replace(/<[^>]+>/g, ' ')      // quitar etiquetas HTML si vienen
          .replace(/[\s\u00A0]+/g, ' ') // normalizar espacios (incluye NBSP)
          .trim();
        copyToClipboard(normalized)
          .then(() => {
            const notification = document.createElement('div');
            notification.style.cssText = `
              position: fixed;
              top: 20px;
              right: 20px;
              background: linear-gradient(135deg, #10b981, #059669);
              color: white;
              padding: 1rem 1.5rem;
              border-radius: 12px;
              font-weight: 600;
              box-shadow: 0 10px 25px rgba(16, 185, 129, 0.3);
              z-index: 10000;
              animation: slideInRight 0.3s ease-out;
            `;
            notification.innerHTML = '<i class="fas fa-check-circle me-2"></i>Datos copiados al portapapeles';
            document.body.appendChild(notification);
            setTimeout(() => {
              notification.style.animation = 'slideOutRight 0.3s ease-in';
              setTimeout(() => notification.remove(), 300);
            }, 3000);
          })
          .catch(err => {
            console.error('Error al copiar:', err);
            Swal.fire({ icon: 'error', title: 'Error', text: 'No se pudo copiar al portapapeles' });
          });
      }

      const metodoPagoEntityParser = document.createElement('textarea');
      let selectedMetodoPagoId = null;
      window.selectedMetodoPagoId = selectedMetodoPagoId;
      let paymentFlowMode = null;
      window.paymentFlowMode = paymentFlowMode;
      let paymentPayerCedula = null;
      window.paymentPayerCedula = paymentPayerCedula;
      let currentOrderUuid = null;
      window.currentOrderUuid = currentOrderUuid;
      let orderStatusInterval = null;
      window.orderStatusInterval = orderStatusInterval;
      const ORDER_STATUS_ENDPOINT = {!! json_encode(url('/api/order-status')) !!};
      const ORDER_TICKET_BASE = {!! json_encode(url('/ticket')) !!};
      const ORDER_VIEW_BASE = {!! json_encode(url('/orden')) !!};
      const orderResultContainer = document.getElementById('order_result_content');
      const defaultOrderResultHtml = orderResultContainer ? orderResultContainer.innerHTML : '';
      const ORDER_STATUS_INTERVAL_MS = 5000;
      const proximoSorteoMensaje = @json($rifa->mensaje_proximo_sorteo);
      const proximoSorteoFecha = @json($fechaInicialProximoSorteo);
      let paymentDataTemplate = '';

      function parseMetodoPago(metodo) {
        if (typeof metodo !== 'string') {
          return metodo;
        }

        try {
          return JSON.parse(metodo);
        } catch (error) {
          try {
            metodoPagoEntityParser.innerHTML = metodo;
            return JSON.parse(metodoPagoEntityParser.value);
          } catch (decodedError) {
            console.error('No se pudo interpretar el método de pago seleccionado.', decodedError);
            return null;
          }
        }
      }

      // Variable para controlar si ya se mostraron los datos de pago
      let paymentDataShown = false;
      window.paymentDataShown = paymentDataShown;
      let preOrderRequestInFlight = false;
      window.preOrderRequestInFlight = preOrderRequestInFlight;

      function setPreOrderRequestState(state) {
        preOrderRequestInFlight = Boolean(state);
        window.preOrderRequestInFlight = preOrderRequestInFlight;
      }

      // Función para seleccionar método de pago (sin mostrar datos aún)
      function selectPaymentMethod(element, metodo) {
        // Remove active class from all payment methods
        document.querySelectorAll('.payment-method-card').forEach(card => {
          card.classList.remove('active');
        });

        // Add active class to selected method
        element.classList.add('active');

        const rawMetodo = metodo ?? element?.dataset?.metodo ?? null;
        metodo = parseMetodoPago(rawMetodo);
        const requiresCedula = element?.dataset?.requiresCedula === '1';
        paymentFlowMode = requiresCedula ? 'auto' : 'manual';
        window.paymentFlowMode = paymentFlowMode;
        togglePayerCedulaInput(requiresCedula);
        toggleManualUploadContainer(false);
        PRE_ORDER_UUID = null;
        window.PRE_ORDER_UUID = PRE_ORDER_UUID;
        setPreOrderRequestState(false);
        if (!requiresCedula) {
          paymentPayerCedula = null;
          window.paymentPayerCedula = paymentPayerCedula;
        }

        if (metodo && metodo.id) {
          selectedMetodoPagoId = metodo.id;
          window.selectedMetodoPagoId = selectedMetodoPagoId;
        }

        paymentDataTemplate = metodo?.descripcion || '';

        if (window.paymentDataShown) {
          hidePaymentData();
        }

        // Verificar si todos los campos están completos
        checkFieldsComplete();
      }

      function resetManualUploadFields() {
        const fileInput = document.getElementById('archivo_pago');
        const refInput = document.getElementById('ref');
        if (fileInput) {
          fileInput.value = '';
        }
        if (refInput) {
          refInput.value = '';
        }
      }

      function toggleManualUploadContainer(shouldShow) {
        const container = document.getElementById('manual_upload_container');
        if (!container) return;
        container.style.display = shouldShow ? 'block' : 'none';
        if (!shouldShow) {
          resetManualUploadFields();
        }
      }

      function hidePaymentData() {
        if (!window.paymentDataShown) return;

        setPreOrderRequestState(false);

        const paymentDataContainer = document.getElementById('payment_data_container');
        const paymentDataDivStep0 = document.getElementById('payment_data_step0');
        setPaymentNoteVisibility(false);
        toggleManualUploadContainer(false);
        if (paymentDataContainer) {
          paymentDataContainer.style.display = 'none';
        }
        if (paymentDataDivStep0) {
          paymentDataDivStep0.style.animation = 'none';
        }

        const btnText = document.getElementById('btnText');
        const btnIcon = document.getElementById('btnIcon');
        if (btnText) {
          btnText.textContent = 'Ver datos para el pago';
        }
        if (btnIcon) {
          btnIcon.classList.remove('fa-arrow-right');
          btnIcon.classList.remove('fa-check-circle');
          if (!btnIcon.classList.contains('fa-eye')) {
            btnIcon.classList.add('fa-eye');
          }
        }

        paymentDataShown = false;
        window.paymentDataShown = paymentDataShown;
      }

      function setPaymentNoteVisibility(shouldShow) {
        const note = document.getElementById('payment_data_note');
        if (!note) return;
        note.style.display = shouldShow ? 'block' : 'none';
      }

      // Función para mostrar los datos de pago
      function showPaymentData(element, metodo) {
        selectPaymentMethod(element, metodo);

        const paymentDataDivStep0 = document.getElementById('payment_data_step0');
        renderPaymentDataViews();
        toggleManualUploadContainer(paymentFlowMode === 'manual');

        // Mostrar el contenedor de datos de pago
        const paymentDataContainer = document.getElementById('payment_data_container');
        if (paymentDataContainer) {
          paymentDataContainer.style.display = 'block';
          paymentDataShown = true;
          window.paymentDataShown = paymentDataShown;
          setPaymentNoteVisibility(paymentFlowMode === 'auto');

          // Auto-scroll al contenedor de datos de pago después de un pequeño delay
          const scrollToPaymentSection = () => {
            const target = document.getElementById('payment_scroll_anchor') 
              || document.getElementById('btnPreOrder') 
              || paymentDataContainer;
            if (target && typeof target.scrollIntoView === 'function') {
              target.scrollIntoView({
                behavior: 'smooth',
                block: 'center',
                inline: 'nearest'
              });
            }
          };
          setTimeout(scrollToPaymentSection, 200);
          setTimeout(scrollToPaymentSection, 600);

        // Cambiar el botón según el flujo de pago
          const btnText = document.getElementById('btnText');
          const btnIcon = document.getElementById('btnIcon');
          if (btnText) {
            btnText.textContent = paymentFlowMode === 'auto' ? 'Ya pague' : 'Continuar';
          }
          if (btnIcon) {
            btnIcon.classList.remove('fa-eye');
            btnIcon.classList.remove('fa-arrow-right');
            btnIcon.classList.remove('fa-check-circle');
            btnIcon.classList.add(paymentFlowMode === 'auto' ? 'fa-check-circle' : 'fa-arrow-right');
          }
        }

        if (paymentDataDivStep0) {
          paymentDataDivStep0.style.animation = 'none';
          setTimeout(() => {
            paymentDataDivStep0.style.animation = 'pulseGlow 2s infinite';
          }, 100);
        }
      }

      function getPayerCedulaDigits() {
        const input = document.getElementById('pre_emisor_cedula');
        const raw = input ? String(input.value || '') : '';
        return raw.replace(/[^0-9]/g, '').slice(0, 12);
      }

      function renderPaymentDataViews() {
        const templates = paymentDataTemplate || '';
        const digits = paymentPayerCedula || getPayerCedulaDigits();
        const placeholder = '@{{CEDULA_PAGADOR}}';
        const ids = ['payment_data_step0', 'payment_data_step1'];

        ids.forEach(id => {
          const el = document.getElementById(id);
          if (!el) return;

          if (!templates) {
            el.innerHTML = '<span style="color:#94a3b8;">Selecciona un método de pago para ver los detalles.</span>';
            return;
          }

          let updated = templates;
          if (templates.includes(placeholder)) {
            updated = templates.split(placeholder).join(digits || '');
          }
          const cleanText = updated.replace(/<\/?p>/g, '');
          el.innerHTML = `<span style="color: #10b981;">${cleanText}</span>`;
        });
      }

      function togglePayerCedulaInput(shouldShow) {
        const row = document.getElementById('payer_cedula_row');
        const input = document.getElementById('pre_emisor_cedula');
        if (!row) return;

        if (window.paymentDataShown) {
          hidePaymentData();
        }

        if (shouldShow) {
          row.style.display = 'flex';
          if (input) {
            input.setAttribute('required', 'required');
          }
        } else {
          row.style.display = 'none';
          if (input) {
            input.removeAttribute('required');
            input.value = '';
          }
          paymentPayerCedula = null;
          window.paymentPayerCedula = paymentPayerCedula;
          renderPaymentDataViews();
        }
      }

      // Función para verificar si todos los campos están completos
      function checkFieldsComplete() {
        const pre = {
          cedula: jQuery('#pre_cedula').val().trim(),
          nombre_completo: jQuery('#pre_nombre').val().trim(),
          correo: jQuery('#pre_correo').val().trim(),
          telefono: jQuery('#pre_telefono').val().trim(),
        };

        const requiresCedula = paymentFlowMode === 'auto';
        const payerCedula = jQuery('#pre_emisor_cedula').val().trim();

        let allFieldsComplete = pre.cedula && pre.nombre_completo && pre.correo && pre.telefono;

        if (requiresCedula) {
          allFieldsComplete = allFieldsComplete && payerCedula && payerCedula.replace(/[^0-9]/g, '').length >= 6;
        }

        const btn = document.getElementById('btnPreOrder');
        if (btn) {
          if (allFieldsComplete) {
            btn.disabled = false;
            btn.style.opacity = '1';
            btn.style.cursor = 'pointer';
          } else {
            btn.disabled = true;
            btn.style.opacity = '0.5';
            btn.style.cursor = 'not-allowed';
          }
        }
      }

      // Listener para actualizar automáticamente al escribir la cédula del pagador
      document.addEventListener('DOMContentLoaded', () => {
        const cedulaInput = document.getElementById('pre_emisor_cedula');
        if (cedulaInput) {
          const clampCedula = () => {
            cedulaInput.value = (cedulaInput.value || '').replace(/[^0-9]/g, '').slice(0, 12);
            renderPaymentDataViews();
            if (window.paymentDataShown) {
              hidePaymentData();
            }
            checkFieldsComplete();
          };
          ['input','change','blur'].forEach(evt => cedulaInput.addEventListener(evt, clampCedula));
        }

        // Agregar listeners a todos los campos para verificar completitud
        ['pre_cedula', 'pre_nombre', 'pre_correo', 'pre_telefono'].forEach(id => {
          const field = document.getElementById(id);
          if (field) {
            ['input', 'change', 'blur'].forEach(evt => field.addEventListener(evt, checkFieldsComplete));
          }
        });

        togglePayerCedulaInput(false);

        const fechaSorteoElement = document.querySelector('.fecha_sorteo');
        if (fechaSorteoElement) {
          if (proximoSorteoMensaje) {
            fechaSorteoElement.textContent = proximoSorteoMensaje;
          } else if (proximoSorteoFecha) {
            fechaSorteoElement.textContent = `Próximo sorteo: ${proximoSorteoFecha}`;
          } else {
            fechaSorteoElement.textContent = '';
          }
        }

        // Verificar el estado inicial del botón
        checkFieldsComplete();
      });

      function copiarDatosCompletos(bankData){
        // Get current total amount
        const totalElement = document.getElementById('top_total_display') || document.getElementById('payment_total_display') || document.getElementById('summary_total');
        const totalAmount = totalElement ? totalElement.textContent : '';
        const ticketCount = {{ $initialTickets }};
        
        // Build simple data string: bank data + amount
        const cleanAmount = totalAmount.replace(' Bs.', '').trim();
        const plainBankData = String(bankData)
          .replace(/<[^>]+>/g, ' ')      // quitar etiquetas HTML
          .replace(/[\s\u00A0]+/g, ' ') // normalizar espacios múltiples/NBSP
          .trim();
        const joined = cleanAmount ? `${plainBankData} ${cleanAmount}` : plainBankData;
        const completeData = joined.replace(/[\s\u00A0]+/g, ' ').trim();

        copyToClipboard(completeData)
          .then(() => {
            const notification = document.createElement('div');
            notification.style.cssText = `
              position: fixed;
              top: 20px;
              right: 20px;
              background: linear-gradient(135deg, #10b981, #059669);
              color: white;
              padding: 1rem 1.5rem;
              border-radius: 12px;
              font-weight: 600;
              box-shadow: 0 10px 25px rgba(16, 185, 129, 0.3);
              z-index: 10000;
              animation: slideInRight 0.3s ease-out;
            `;
            notification.innerHTML = '<i class="fas fa-check-circle me-2"></i>Datos completos copiados al portapapeles';
            document.body.appendChild(notification);
            setTimeout(() => {
              notification.style.animation = 'slideOutRight 0.3s ease-in';
              setTimeout(() => notification.remove(), 300);
            }, 4000);
          })
          .catch(err => {
            console.error('Error al copiar:', err);
            Swal.fire({ icon: 'error', title: 'Error', text: 'No se pudo copiar al portapapeles' });
          });
      }

      const datos = {
        cant_boletos: {{ $initialTickets }},
        precio: {{ $rifa->precio }},
        bcv: {{ $BCV }},
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

      // Paso 1: Datos del concursante y preparación de pre-orden
      jQuery('#btnPreOrder').on('click', async function() {
        if (!window.selectedMetodoPagoId) {
          Swal.fire('Selecciona un método de pago');
          return;
        }

        const buttonEl = this;

        const pre = {
          cedula: jQuery('#pre_cedula').val().trim(),
          nombre_completo: jQuery('#pre_nombre').val().trim(),
          correo: jQuery('#pre_correo').val().trim(),
          telefono: jQuery('#pre_telefono').val().trim(),
        };

        if (!pre.cedula || !pre.nombre_completo || !pre.correo || !pre.telefono) {
          Swal.fire('Completa todos los campos del concursante');
          return;
        }

        if (pre.telefono.replace(/[^0-9]/g, '').length !== 11) {
          Swal.fire('El teléfono del concursante debe tener exactamente 11 dígitos');
          return;
        }

        const requiresCedula = paymentFlowMode === 'auto';
        const payerCedulaRaw = jQuery('#pre_emisor_cedula').val().trim();
        const payerCedulaDigits = payerCedulaRaw.replace(/[^0-9]/g, '');

        if (requiresCedula) {
          if (!payerCedulaDigits) {
            Swal.fire('Ingresa la cédula del pagador');
            return;
          }
          if (payerCedulaDigits.length < 6 || payerCedulaDigits.length > 12) {
            Swal.fire('La cédula del pagador debe tener entre 6 y 12 dígitos');
            return;
          }
        }

        window.contestantData = pre;
        paymentPayerCedula = requiresCedula ? payerCedulaDigits : null;
        window.paymentPayerCedula = paymentPayerCedula;

        // Si los datos aún no se han mostrado, crearlos y mostrarlos
        if (!window.paymentDataShown) {
          // Si requiere cédula del pagador, crear la preorden primero
          if (requiresCedula && !PRE_ORDER_UUID) {
            if (preOrderRequestInFlight) {
              return;
            }

            setPreOrderRequestState(true);
            buttonEl.disabled = true;

            const preOrderPayload = {
              raffle_id: {{$rifa->id}},
              cantidad: datos.cant_boletos,
              nombre_completo: pre.nombre_completo,
              correo: pre.correo,
              telefono: pre.telefono,
              metodo_pago_id: window.selectedMetodoPagoId,
              cedula: payerCedulaDigits,
            };

            try {
              const resp = await fetch('{{config('app.url')}}/api/preOrder', {
                method: 'POST',
                headers: {
                  'X-Requested-With': 'XMLHttpRequest'
                },
                body: toFormData(preOrderPayload)
              });
              const data = await resp.json();
              if (!data.success) {
                Swal.fire('No se pudo crear la pre-orden');
                return;
              }
              PRE_ORDER_UUID = data.pre_order.uuid;
              window.PRE_ORDER_UUID = PRE_ORDER_UUID;
            } catch (error) {
              Swal.fire('Error de red creando pre-orden');
              return;
            } finally {
              buttonEl.disabled = false;
              setPreOrderRequestState(false);
            }

            if (!PRE_ORDER_UUID) {
              return;
            }
          }

          // Mostrar los datos de pago
          renderPaymentDataViews();
          const paymentDataContainer = document.getElementById('payment_data_container');
          if (paymentDataContainer) {
            paymentDataContainer.style.display = 'block';
            paymentDataShown = true;
            window.paymentDataShown = paymentDataShown;
            setPaymentNoteVisibility(paymentFlowMode === 'auto');
            toggleManualUploadContainer(paymentFlowMode === 'manual');

            // Auto-scroll al contenedor de datos de pago después de un pequeño delay
            const scrollToPaymentSection = () => {
              const target = document.getElementById('payment_scroll_anchor')
                || document.getElementById('btnPreOrder')
                || paymentDataContainer;
              if (target && typeof target.scrollIntoView === 'function') {
                target.scrollIntoView({
                  behavior: 'smooth',
                  block: 'center',
                  inline: 'nearest'
                });
              }
            };
            setTimeout(scrollToPaymentSection, 200);
            setTimeout(scrollToPaymentSection, 600);

            // Cambiar el botón según el flujo de pago
            const btnText = document.getElementById('btnText');
            const btnIcon = document.getElementById('btnIcon');
            if (btnText) {
              btnText.textContent = paymentFlowMode === 'auto' ? 'Ya pague' : 'Continuar';
            }
            if (btnIcon) {
              btnIcon.classList.remove('fa-eye');
              btnIcon.classList.remove('fa-arrow-right');
              btnIcon.classList.remove('fa-check-circle');
              btnIcon.classList.add(paymentFlowMode === 'auto' ? 'fa-check-circle' : 'fa-arrow-right');
            }
          }
        } else {
          if (!requiresCedula) {
            finalizar_compra(buttonEl);
            return;
          }

          // Si ya se mostraron los datos y es flujo automático, asegurarse de contar con la preorden
          if (!PRE_ORDER_UUID) {
            if (preOrderRequestInFlight) {
              return;
            }

            setPreOrderRequestState(true);
            buttonEl.disabled = true;

            const preOrderPayload = {
              raffle_id: {{$rifa->id}},
              cantidad: datos.cant_boletos,
              nombre_completo: pre.nombre_completo,
              correo: pre.correo,
              telefono: pre.telefono,
              metodo_pago_id: window.selectedMetodoPagoId,
              cedula: payerCedulaDigits,
            };

            try {
              const resp = await fetch('{{config('app.url')}}/api/preOrder', {
                method: 'POST',
                headers: {
                  'X-Requested-With': 'XMLHttpRequest'
                },
                body: toFormData(preOrderPayload)
              });
              const data = await resp.json();
              if (!data.success) {
                Swal.fire('No se pudo crear la pre-orden');
                return;
              }
              PRE_ORDER_UUID = data.pre_order.uuid;
              window.PRE_ORDER_UUID = PRE_ORDER_UUID;
            } catch (error) {
              Swal.fire('Error de red creando pre-orden');
              return;
            } finally {
              buttonEl.disabled = false;
              setPreOrderRequestState(false);
            }

            if (!PRE_ORDER_UUID) {
              return;
            }
          }
          finalizar_compra_auto(buttonEl);
        }
      });

      function toFormData(obj){
        const fd = new FormData();
        Object.keys(obj).forEach(k => fd.append(k, obj[k]));
        return fd;
      }

      function escapeHtml(value) {
        if (value === null || value === undefined) {
          return '';
        }
        return String(value)
          .replace(/&/g, '&amp;')
          .replace(/</g, '&lt;')
          .replace(/>/g, '&gt;')
          .replace(/"/g, '&quot;')
          .replace(/'/g, '&#39;');
      }

      function shortUuid(uuid) {
        if (!uuid) return '';
        const str = String(uuid);
        return str.length > 6 ? str.slice(-6) : str;
      }

      function formatDateTime(value) {
        if (!value) return '';
        try {
          const date = new Date(value);
          if (Number.isNaN(date.getTime())) {
            return '';
          }
          return date.toLocaleString('es-VE', {
            day: '2-digit',
            month: 'short',
            year: 'numeric',
            hour: '2-digit',
            minute: '2-digit',
          });
        } catch (error) {
          return '';
        }
      }

      function renderTicketChips(numbers) {
        if (!Array.isArray(numbers) || numbers.length === 0) {
          return '<p class="text-slate-300 mt-3">Tus números se están generando. Esta pantalla se actualizará automáticamente.</p>';
        }

        const chips = numbers
          .map((value) => `<span class="ticket-chip">${escapeHtml(value)}</span>`)
          .join('');

        return `<div class="ticket-chip-container">${chips}</div>`;
      }

      function stopOrderStatusPolling() {
        if (orderStatusInterval) {
          clearInterval(orderStatusInterval);
          orderStatusInterval = null;
          window.orderStatusInterval = orderStatusInterval;
        }
      }

      function startOrderStatusPolling(uuid) {
        stopOrderStatusPolling();
        if (!uuid) return;

        const poll = () => {
          checkOrderStatus(uuid);
        };

        poll();
        orderStatusInterval = setInterval(poll, ORDER_STATUS_INTERVAL_MS);
        window.orderStatusInterval = orderStatusInterval;
      }

      async function checkOrderStatus(uuid) {
        if (!uuid) return;

        try {
          const resp = await fetch(`${ORDER_STATUS_ENDPOINT}/${encodeURIComponent(uuid)}?t=${Date.now()}`, {
            headers: { 'Accept': 'application/json' },
            cache: 'no-store',
          });

          if (!resp.ok) {
            return;
          }

          const payload = await resp.json();
          if (!payload?.success || !payload.order) {
            return;
          }

          const status = payload.order.estatus;
          if (status === '1') {
            showOrderApproved(payload.order);
          } else if (status === '2' || status === '9') {
            showOrderCanceled(payload.order);
          }
        } catch (error) {
          console.warn('No fue posible consultar el estado de la orden', error);
        }
      }

      function showOrderApproved(order) {
        stopOrderStatusPolling();
        jQuery('#paso_verificando').addClass('hidden');
        jQuery('#paso_final').removeClass('hidden');
        currentOrderUuid = null;
        window.currentOrderUuid = currentOrderUuid;

        if (!orderResultContainer) {
          return;
        }

        const uuid = order?.uuid || '';
        const shortId = shortUuid(uuid);
        const approvalDate = formatDateTime(order?.updated_at);
        const numbersHtml = renderTicketChips(order?.numbers || []);
        const ticketLink = order?.links?.ticket || (uuid ? `${ORDER_TICKET_BASE}/${encodeURIComponent(uuid)}` : null);
        const orderLink = order?.links?.order || (uuid ? `${ORDER_VIEW_BASE}/${encodeURIComponent(uuid)}` : null);
        const statusLabel = order?.estatus_label ? escapeHtml(order.estatus_label) : 'aprobada';
        const dateText = approvalDate ? ` el ${escapeHtml(approvalDate)}` : '';

        const actions = [
          orderLink ? `<a class="btn btn-success" href="${orderLink}" target="_blank" rel="noopener"><i class="fas fa-receipt me-2"></i>Ver detalles</a>` : '',
          '<button class="btn btn-outline-light" type="button" onclick="volver_comprar()"><i class="fas fa-shopping-cart me-2"></i>Hacer otra compra</button>',
        ].filter(Boolean).join('');

        orderResultContainer.innerHTML = `
          <div class="mb-4">
            <i class="fas fa-check-circle" style="font-size: 3rem; color: #10b981;"></i>
          </div>
          <h2 class="text-white mb-3" style="font-weight: 700;">¡Pago verificado!</h2>
          <p class="text-slate-300" style="font-size: 1rem;">
            Tu compra <strong>#${escapeHtml(shortId || uuid)}</strong> fue ${statusLabel}${dateText}.
          </p>
          ${numbersHtml}
          <div class="order-approved-actions">
            ${actions}
          </div>
        `;

        window.scrollTo({ top: 0, behavior: 'smooth' });
      }

      function showOrderCanceled(order) {
        stopOrderStatusPolling();
        jQuery('#paso_verificando').addClass('hidden');
        jQuery('#paso_final').removeClass('hidden');
        currentOrderUuid = null;
        window.currentOrderUuid = currentOrderUuid;

        if (!orderResultContainer) {
          return;
        }

        const uuid = order?.uuid || '';
        const shortId = shortUuid(uuid);
        const ticketLink = order?.links?.ticket || (uuid ? `${ORDER_TICKET_BASE}/${encodeURIComponent(uuid)}` : null);
        const statusLabel = order?.estatus_label ? escapeHtml(order.estatus_label) : 'pendiente';

        orderResultContainer.innerHTML = `
          <div class="mb-4">
            <i class="fas fa-exclamation-triangle" style="font-size: 3rem; color: #f97316;"></i>
          </div>
          <h2 class="text-white mb-3" style="font-weight: 700;">Pago en revisión manual</h2>
          <p class="text-slate-300" style="font-size: 1rem;">
            La orden <strong>#${escapeHtml(shortId || uuid)}</strong> quedó en estado <strong>${statusLabel}</strong>.
            Nuestro equipo la revisará y te notificará por correo o WhatsApp. Si ya tienes comprobante, escríbenos por soporte.
          </p>
          <div class="order-approved-actions">
            ${ticketLink ? `<a class="btn btn-outline-light" href="${ticketLink}" target="_blank" rel="noopener"><i class="fas fa-ticket-alt me-2"></i>Ver tickets</a>` : ''}
            <button class="btn btn-outline-light" type="button" onclick="volver_comprar()"><i class="fas fa-shopping-cart me-2"></i>Hacer otra compra</button>
          </div>
        `;

        window.scrollTo({ top: 0, behavior: 'smooth' });
      }

      function showVerificationScreen(uuid) {
        currentOrderUuid = uuid || null;
        window.currentOrderUuid = currentOrderUuid;
        if (orderResultContainer) {
          orderResultContainer.innerHTML = defaultOrderResultHtml;
        }
        stopOrderStatusPolling();
        const uuidLabel = document.getElementById('verificando_uuid');
        if (uuidLabel) {
          uuidLabel.textContent = uuid
            ? `Tu compra #${shortUuid(uuid)} está en revisión. Recibirás una notificación en cuanto el pago sea aprobado.`
            : 'Estamos confirmando tu pago con el banco. Recibirás una notificación automática apenas se apruebe.';
        }
        jQuery('#paso0').addClass('hidden');
        jQuery('#paso_final').addClass('hidden');
        jQuery('#paso_verificando').removeClass('hidden');
        if (uuid) {
          startOrderStatusPolling(uuid);
        }
        window.scrollTo({ top: 0, behavior: 'smooth' });
      }

      function volver_comprar(){
        const cantBoletosInput = document.getElementById('cant_boletos');
        if (cantBoletosInput) {
          cantBoletosInput.value = cantidad_minima;
        }
        document.getElementById('ref').value = '';
        document.getElementById('archivo_pago').value = '';

        window.contestantData = null;
        paymentPayerCedula = null;
        window.paymentPayerCedula = paymentPayerCedula;
        PRE_ORDER_UUID = null;
        window.PRE_ORDER_UUID = PRE_ORDER_UUID;
        currentOrderUuid = null;
        window.currentOrderUuid = currentOrderUuid;
        stopOrderStatusPolling();
        if (orderResultContainer) {
          orderResultContainer.innerHTML = defaultOrderResultHtml;
        }
        setPreOrderRequestState(false);

        jQuery('#pre_cedula').val('');
        jQuery('#pre_nombre').val('');
        jQuery('#pre_correo').val('');
        jQuery('#pre_telefono').val('');
        jQuery('#pre_emisor_cedula').val('');

        datos.cant_boletos = cantidad_minima;
        datos.pago.archivo_pago = '';
        datos.pago.ref = '';

        selectedMetodoPagoId = null;
        window.selectedMetodoPagoId = selectedMetodoPagoId;
        paymentFlowMode = null;
        window.paymentFlowMode = paymentFlowMode;
        togglePayerCedulaInput(false);

        jQuery('#paso_final').addClass('hidden');
        jQuery('#paso1').addClass('hidden');
        jQuery('#paso_verificando').addClass('hidden');
        jQuery('#paso0').removeClass('hidden');
        window.scrollTo({ top: 0, behavior: 'smooth' });
      }

      // function minus_cant(){
      //   if(cant_boletos.value > cantidad_minima){
      //     cant_boletos.value--; 
      //     datos.cant_boletos = parseInt(cant_boletos.value);
      //     calcular_total();
      //   }
        
      // }

      // Eliminado: validateMin para simplificar manejo del campo de referencia

      // function sum_cant(){

      //   if(cant_boletos.value > 199){
      //     Swal.fire("la compra máxima es de 200 boletos");
      //     return;
      //   }

      //   if(cant_boletos.value > quedan){
      //     Swal.fire("no hay boletos suficientes");
      //     return;
      //   }
      //   cant_boletos.value++; 
      //   datos.cant_boletos = parseInt(cant_boletos.value);
      //   calcular_total();
      // }

      function put_cant(value) {
        datos.cant_boletos = parseInt(value);
        try { calcular_total(); } catch (e) {}
      }

      function put_persona(object,value){
        datos.persona[object] = value.trim();
      }

      function put_pago(object,value){
        datos.pago[object] = value.trim();
      }

      function validar_cant(value){
        valueInt = parseInt(value);
        if(valueInt < cantidad_minima || value == "" || value == null || value == "undefined"){
          Swal.fire(`La compra mínima es de ${cantidad_minima} boletos`);
          cant_boletos.value = cantidad_minima;
          put_cant(cantidad_minima);
        }

        if(valueInt > 200){
          Swal.fire("La compra máxima es de 200 boletos");
          cant_boletos.value = cantidad_minima;
          put_cant(cantidad_minima);
        }

        if(valueInt > quedan){
          Swal.fire("no hay boletos suficientes");
          cant_boletos.value = cantidad_minima;
          put_cant(cantidad_minima);
        }

        calcular_total();
      }

      function calcular_total() {
        // Total en Bs se calcula como precio (en Bs) por cantidad de boletos
        const total = datos.precio * datos.cant_boletos;
        const totalFormatted = `${total.toFixed(2)} Bs.`;
        
        // Actualizar todos los elementos que muestran el total
        jQuery("#final_bs").html(totalFormatted);
        jQuery("#pre_final_bs").html(totalFormatted);
        jQuery("#payment_total_display").html(totalFormatted);
        jQuery("#top_total_display").html(totalFormatted);
        // Actualizar cantidad de tickets si existen los contenedores
        jQuery("#payment_tickets_display").html(datos.cant_boletos);
        jQuery("#pre_tickets_count_2").html(datos.cant_boletos);
        jQuery("#top_tickets_display").html(datos.cant_boletos);
        
        // Mantener sincronizado el resumen
        try { updateSummary(); } catch (e) {}
      }

      // Forzar solo números en cédula del paso "Datos del Comprador"
      (function enforceNumericCedula(){
        const input = document.getElementById('pre_cedula');
        if(!input) return;
        const clamp = () => {
          // eliminar cualquier caracter no numérico
          input.value = (input.value || '').replace(/[^0-9]/g, '').slice(0, 12);
        };
        input.addEventListener('input', clamp);
        input.addEventListener('keyup', clamp);
        input.addEventListener('change', clamp);
      })();

      // Forzar solo números y 11 dígitos en teléfonos
      (function enforceNumericPhones(){
        const phoneInput = document.getElementById('pre_telefono');
        if(phoneInput) {
          const clampPhone = () => {
            phoneInput.value = (phoneInput.value || '').replace(/[^0-9]/g, '').slice(0, 11);
          };
          phoneInput.addEventListener('input', clampPhone);
          phoneInput.addEventListener('keyup', clampPhone);
          phoneInput.addEventListener('change', clampPhone);
        }
      })();

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
            updateSummary(); // Actualizar resumen antes de mostrar paso final
            jQuery("#paso1").addClass("hidden");
            jQuery("#paso_final").removeClass("hidden");
          }
          
          if(paso == 2 && tipo=="adelante"){
            updateSummary(); // Actualizar resumen antes de mostrar paso final
            jQuery("#paso2").addClass("hidden");
            jQuery("#paso_final").removeClass("hidden");
          }
          
          if(paso == 2 && tipo=="atras"){
            jQuery("#paso2").addClass("hidden");
            jQuery("#paso1").removeClass("hidden");
            // Auto-focus first field in step 1 with smooth transition
            setTimeout(() => {
              const firstField = document.getElementById('pre_cedula');
              if (firstField) {
                firstField.focus();
                firstField.style.boxShadow = '0 0 0 3px rgba(16, 185, 129, 0.2)';
                setTimeout(() => {
                  firstField.style.boxShadow = '';
                }, 1500);
              }
            }, 150);
          }
          
          // Auto-focus when advancing to step 2
          if(paso == 1 && tipo=="adelante" && jQuery("#paso2").length){
            setTimeout(() => {
              const firstField = document.getElementById('pre_emisor_cedula');
              if (firstField) {
                firstField.focus();
                firstField.style.boxShadow = '0 0 0 3px rgba(16, 185, 129, 0.2)';
                setTimeout(() => {
                  firstField.style.boxShadow = '';
                }, 1500);
              }
            }, 150);
          }
      }

      function updateSummary() {
        // Actualizar resumen con la información capturada
        if (window.contestantData) {
          const contestantText = `${window.contestantData.nombre_completo}<br><small style="color: #94a3b8;">V-${window.contestantData.cedula}</small>`;
          jQuery('#summary_contestant').html(contestantText);
        }

        const payerSummary = jQuery('#summary_payer');
        const bankSummary = jQuery('#summary_bank');

        if (payerSummary.length) {
          if (paymentFlowMode === 'auto' && paymentPayerCedula) {
            payerSummary.html(`Cédula: V-${paymentPayerCedula}`);
          } else {
            payerSummary.html('Será validado por el equipo de soporte');
          }
        }

        if (bankSummary.length) {
          if (paymentFlowMode === 'auto') {
            bankSummary.text('Validación automática');
          } else {
            bankSummary.text('Pendiente');
          }
        }

        // Total
        const total = jQuery('#final_bs').text() || jQuery('#pre_final_bs').text();
        jQuery('#summary_total').text(total);
      }

      function validateEmail(emailField) {
        const _email = emailField.trim().toLowerCase();
        const regex = /^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$/i;

        if(!regex.test(_email) ){
          Swal.fire("El correo electrónico está mal escrito, por favor corregir");
          return false;
        }
        datos.persona.email = _email;
        return true;
      } 

      function finalizar_compra(_this) {
        const archivo_pago = document.querySelector('#archivo_pago');
        const contestant = window.contestantData || {};
        const metodoPagoId = window.selectedMetodoPagoId;

        if (!metodoPagoId) {
          Swal.fire('Selecciona un método de pago');
          return;
        }

        if (!contestant.cedula || !contestant.nombre_completo || !contestant.telefono || !contestant.correo) {
          Swal.fire('Completa los datos del concursante antes de continuar');
          return;
        }

        const refRaw = jQuery('#ref').val().trim();
        const refDigits = refRaw.replace(/[^0-9]/g, '').slice(-6);
        if (!refDigits || refDigits.length !== 6) {
          Swal.fire('La referencia bancaria debe tener 6 dígitos');
          return;
        }

        const requiresPaymentProof = paymentFlowMode !== 'auto';
        const archivoPagoFile = archivo_pago && archivo_pago.files.length > 0
          ? archivo_pago.files[0]
          : null;

        if (requiresPaymentProof && !archivoPagoFile) {
          Swal.fire('Debes subir el comprobante de pago');
          return;
        }

        const telefonoNormalizado = (contestant.telefono || '').replace(/[^0-9]/g, '').slice(0, 11);

        const formData = new FormData();
        formData.append('raffle_id', {{$rifa->id}});
        formData.append('nombre_completo', (contestant.nombre_completo || '').trim());
        formData.append('correo', (contestant.correo || '').trim());
        formData.append('tlf', (contestant.telefono || '').trim());
        formData.append('cantidad', datos.cant_boletos);
        formData.append('cedula', (contestant.cedula || '').trim());
        formData.append('ref_banco', refDigits);
        formData.append('metodo_pago_id', metodoPagoId);
        if (telefonoNormalizado.length === 11) {
          formData.append('emisor_telefono', telefonoNormalizado);
        }
        if (paymentFlowMode === 'auto' && PRE_ORDER_UUID) {
          formData.append('pre_order_uuid', PRE_ORDER_UUID);
        }
        if (archivoPagoFile) {
          formData.append('ref_imagen', archivoPagoFile);
        }

        const linkGuardar = "{{config('app.url')}}/api/orderCliente";
        let UUID_COMPRA;

        const button = _this;
        const previousHtml = button.dataset.originalHtml || button.innerHTML;
        button.dataset.originalHtml = previousHtml;
        button.disabled = true;
        button.innerHTML = `
          <span class="d-flex align-items-center justify-content-center">
            <i class="fas fa-spinner fa-spin me-2" style="font-size: 1.2rem;"></i>
            Realizando Compra...
          </span>
        `;

        fetch(linkGuardar,{
          method: "POST",
          cache: "no-cache",
          body: formData
        })
        .then(response => response.json())
        .then( res => {
          console.log(res)
          if(res.success == true){
            UUID_COMPRA = res.compra.uuid;
            let timerInterval;
            Swal.fire({
              title: "Realizando Compra...",
              timer: 1500,
              timerProgressBar: true,
              didOpen: () => {
                Swal.showLoading();
              }
            }).then((result) => {
              if (result.dismiss === Swal.DismissReason.timer) {
                show_hide("adelante");
                showTickets(UUID_COMPRA);
              }
            });
          }else {
            let errorMessage = res.message || 'Error en la validación';
            
            // Si hay errores de validación específicos, mostrar el primero
            if (res.errors && typeof res.errors === 'object') {
              const firstError = Object.values(res.errors)[0];
              if (Array.isArray(firstError) && firstError.length > 0) {
                errorMessage = firstError[0];
              }
            }
            
            Swal.fire({
              icon: "error",
              title: "Error",
              text: errorMessage,
            });

            button.disabled = false;
            button.innerHTML = button.dataset.originalHtml || previousHtml;
            if (button.id === 'btnPreOrder') {
              const btnIconEl = document.getElementById('btnIcon');
              const btnTextEl = document.getElementById('btnText');
              if (btnIconEl) {
                btnIconEl.classList.remove('fa-eye');
                btnIconEl.classList.remove('fa-arrow-right');
                btnIconEl.classList.remove('fa-check-circle');
                btnIconEl.classList.add(paymentFlowMode === 'auto' ? 'fa-check-circle' : 'fa-arrow-right');
              }
              if (btnTextEl) {
                btnTextEl.textContent = paymentFlowMode === 'auto' ? 'Ya pague' : 'Continuar';
              }
            }
          }
        });
      }

      async function finalizar_compra_auto(button) {
        const contestant = window.contestantData || {};
        if (!contestant.cedula || !contestant.telefono || !contestant.nombre_completo) {
          Swal.fire('Completa los datos del concursante antes de continuar');
          return;
        }

        if (!window.selectedMetodoPagoId) {
          Swal.fire('Selecciona un método de pago');
          return;
        }

        if (!paymentPayerCedula) {
          Swal.fire('Ingresa la cédula del pagador para continuar');
          return;
        }

        const formData = new FormData();
        formData.append('raffle_id', {{$rifa->id}});
        formData.append('nombre_completo', (contestant.nombre_completo || '').trim());
        formData.append('correo', (contestant.correo || '').trim());
        formData.append('tlf', (contestant.telefono || '').trim());
        formData.append('cantidad', datos.cant_boletos);
        formData.append('cedula', (contestant.cedula || '').trim());
        formData.append('metodo_pago_id', window.selectedMetodoPagoId);
        formData.append('emisor_cedula', paymentPayerCedula);
        const telefonoNormalizado = (contestant.telefono || '').replace(/[^0-9]/g, '').slice(0, 11);
        if (telefonoNormalizado.length === 11) {
          formData.append('emisor_telefono', telefonoNormalizado);
        }
        if (PRE_ORDER_UUID) {
          formData.append('pre_order_uuid', PRE_ORDER_UUID);
        }

        button.disabled = true;
        const originalLabel = button.innerHTML;
        button.innerHTML = `
          <span class="d-flex align-items-center justify-content-center">
            <i class="fas fa-spinner fa-spin me-2"></i>
            Registrando pago...
          </span>
        `;

        try {
          const resp = await fetch('{{config('app.url')}}/api/orderCliente', {
            method: 'POST',
            cache: 'no-cache',
            body: formData
          });
          const res = await resp.json();
          if (res.success === true) {
            const uuid = res.compra?.uuid || null;
            Swal.fire({
              icon: 'success',
              title: '¡Pago registrado! ',
              text: 'Estamos validando tu pago automáticamente.',
              timer: 1800,
              showConfirmButton: false
            }).then(() => {
              showVerificationScreen(uuid);
            });
            button.disabled = false;
            button.innerHTML = originalLabel;
          } else {
            let errorMessage = res.message || 'Error en la validación';
            if (res.errors && typeof res.errors === 'object') {
              const firstError = Object.values(res.errors)[0];
              if (Array.isArray(firstError) && firstError.length > 0) {
                errorMessage = firstError[0];
              }
            }
            Swal.fire({ icon: 'error', title: 'Error', text: errorMessage });
            button.disabled = false;
            button.innerHTML = originalLabel;
          }
        } catch (error) {
          Swal.fire({ icon: 'error', title: 'Error', text: 'No se pudo registrar el pago. Inténtalo nuevamente.' });
          button.disabled = false;
          button.innerHTML = originalLabel;
        }
      }

      function showTickets(uuid) {
        let timeLeft = 5;

        Swal.fire({
          title: 'Generando Tickets...',
          html: `Por favor espere <b>${timeLeft}</b> segundos.`,
          timer: timeLeft * 1000,
          timerProgressBar: true,
          allowOutsideClick: false,
          showConfirmButton: false,
          didOpen: () => {
            const timer = Swal.getHtmlContainer().querySelector('b');
            const timerInterval = setInterval(() => {
              timeLeft--;
              timer.textContent = timeLeft;
            }, 1000);
          },
        }).then((result) => {
          window.location.href = `{{config('app.url')}}/orden/${uuid}`;
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

      // Auto-focus and interaction effects initialization
      document.addEventListener('DOMContentLoaded', function() {
        // Auto-focus first field on page load
        setTimeout(() => {
          const firstField = document.getElementById('pre_cedula');
          if (firstField) firstField.focus();
        }, 500);

        // Campo Referencia Bancaria: permitir pegar cualquier largo, conservar últimos 6 dígitos.
        // En digitación manual, solo números y máximo 6.
        const refInput = document.getElementById('ref');
        if (refInput) {
          const clampDigits = () => {
            const digits = (refInput.value || '').replace(/\D/g, '').slice(0, 6);
            if (refInput.value !== digits) {
              refInput.value = digits;
            }
            try { put_pago('ref', refInput.value); } catch(e) {}
          };

          refInput.addEventListener('paste', function(e) {
            e.preventDefault();
            const pastedText = (e.clipboardData || window.clipboardData).getData('text') || '';
            const numbersOnly = pastedText.replace(/[^0-9]/g, '');
            const last6Digits = numbersOnly.slice(-6);
            this.value = last6Digits;
            try { put_pago('ref', last6Digits); } catch(e) {}
            this.dispatchEvent(new Event('input'));
          });

          refInput.addEventListener('input', clampDigits);
          refInput.addEventListener('keyup', clampDigits);
          refInput.addEventListener('change', clampDigits);

          // Botón de pegar eliminado: se vuelve al comportamiento original
        }
        
        // Add validation visual feedback to all form inputs
        const formInputs = document.querySelectorAll('.modern-form-control');
        formInputs.forEach(input => {
          // Visual feedback on focus
          input.addEventListener('focus', function() {
            this.style.borderColor = '#10b981';
            this.style.boxShadow = '0 0 0 3px rgba(16, 185, 129, 0.1)';
          });
          
          // Validation feedback on blur
          input.addEventListener('blur', function() {
            this.style.borderColor = '';
            this.style.boxShadow = '';
            
            // Add checkmark for completed required fields
            if (this.value.trim() !== '') {
              if (!this.parentNode.querySelector('.field-valid-icon')) {
                const checkIcon = document.createElement('div');
                checkIcon.className = 'field-valid-icon';
                checkIcon.innerHTML = '<i class="fas fa-check-circle text-success"></i>';

                // Make parent relative if not already
                if (getComputedStyle(this.parentNode).position === 'static') {
                  this.parentNode.style.position = 'relative';
                }

                // Calculate the position of the input within its parent
                const inputRect = this.getBoundingClientRect();
                const parentRect = this.parentNode.getBoundingClientRect();
                const inputTopRelativeToParent = inputRect.top - parentRect.top;
                const inputCenterY = inputTopRelativeToParent + (inputRect.height / 2);

                checkIcon.style.cssText = `
                  position: absolute;
                  right: 15px;
                  top: ${inputCenterY}px;
                  transform: translateY(-50%);
                  z-index: 10;
                  pointer-events: none;
                `;

                this.parentNode.appendChild(checkIcon);
              }
            } else {
              // Remove checkmark if field becomes empty
              const existingIcon = this.parentNode.querySelector('.field-valid-icon');
              if (existingIcon) {
                existingIcon.remove();
              }
            }
          });
          
          // Real-time validation for input events
          input.addEventListener('input', function() {
            const existingIcon = this.parentNode.querySelector('.field-valid-icon');
            if (this.value.trim() === '' && existingIcon) {
              existingIcon.remove();
            }
          });
        });
      });

      // Tooltip toggle function for info icons
      function toggleTooltip(element) {
        // Close all other tooltips first
        document.querySelectorAll('.info-tooltip.active').forEach(function(tooltip) {
          if (tooltip !== element) {
            tooltip.classList.remove('active');
          }
        });

        // Toggle current tooltip
        element.classList.toggle('active');
      }

      // Close tooltips when clicking outside
      document.addEventListener('click', function(event) {
        if (!event.target.closest('.info-tooltip')) {
          document.querySelectorAll('.info-tooltip.active').forEach(function(tooltip) {
            tooltip.classList.remove('active');
          });
        }
      });
    </script>
  </body>
</html>
