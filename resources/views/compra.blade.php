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
          margin: 1rem 0 !important;
          padding: 1.25rem !important;
          border-radius: 16px !important;
        }
        
        .modern-card .card-body {
          padding: 1.5rem !important;
        }
        
        .modern-card h3 {
          font-size: 1.5rem !important;
        }

        .modern-form-control {
          padding: 0.875rem !important;
          font-size: 0.95rem !important;
        }
        
        .modern-label {
          font-size: 0.85rem !important;
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

      #payment_data {
        animation: pulseGlow 2s infinite;
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

        /* Mobile optimizations for summary section */
        .modern-card .row.g-3 .col-md-4,
        .modern-card .row.g-3 .col-md-6 {
          margin-bottom: 1rem;
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
          margin-bottom: 1rem;
        }
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
    <div class="wpb-content--blank">
      <article id="post-25415" class="post-25415 page type-page status-private hentry">
        <div class="entry-content">
          <div class="container-fluid">
            <div class="row paso0" id="paso0">
              <div class="col-md-6 col-sm-12 col-xs-12 mx-auto">
                <div class="vc_row wpb_row vc_row-fluid slide_pasos">
                  <div class="wpb_column container-fluid vc_col-sm-12">
                    <div class="vc_column-inner">
                      <div class="wpb_wrapper">
                        <div class="modern-card" style="background: linear-gradient(135deg, rgba(15, 23, 42, 0.95) 0%, rgba(30, 41, 59, 0.9) 100%); border-radius: 20px; border: 1px solid rgba(148, 163, 184, 0.2); box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5), 0 0 0 1px rgba(255, 255, 255, 0.05); backdrop-filter: blur(10px);">
                          <div class="card-body" style="padding: 2.5rem;">
                            <!-- Header Section -->
                            <div class="text-center mb-4">
                              <div class="d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px; background: linear-gradient(135deg, #10b981, #059669); border-radius: 20px; box-shadow: 0 10px 25px rgba(16, 185, 129, 0.3);">
                                <i class="fas fa-user-edit" style="font-size: 2rem; color: white;"></i>
                              </div>
                              <h3 class="h3_responsive text-white mb-2" style="font-weight: 700; font-size: 1.875rem; letter-spacing: -0.025em;">Datos del Concursante</h3>
                              <p class="text-slate-300" style="font-size: 1.1rem; margin-bottom: 0;">Completa los datos del concursante para continuar con la compra.</p>
                            </div>

                            <!-- Total Amount -->
                            <div class="text-center mb-4">
                              <div class="d-inline-block px-4 py-3" style="background: linear-gradient(135deg, rgba(16, 185, 129, 0.1), rgba(5, 150, 105, 0.1)); border: 1px solid rgba(16, 185, 129, 0.3); border-radius: 12px;">
                                <span class="text-slate-200" style="font-weight: 500; font-size: 1rem;">Total a pagar: </span>
                                <span class="text-emerald-400" id="pre_final_bs" style="font-weight: 800; font-size: 1.25rem;"></span>
                              </div>
                            </div>

                            <!-- Form Fields -->
                            <form>
                              <div class="row g-4 mb-4">
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

                              <div class="row g-4 mb-4">
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


                              <div class="d-grid mt-4">
                                <button type="button" class="btn modern-btn-success" id="btnPreOrder" style="background: linear-gradient(135deg, #10b981, #059669); border: none; border-radius: 12px; padding: 1rem 2rem; font-weight: 600; font-size: 1.1rem; color: white; transition: all 0.3s ease; position: relative; overflow: hidden; box-shadow: 0 10px 25px rgba(16, 185, 129, 0.3);">
                                  <span class="d-flex align-items-center justify-content-center">
                                    <i class="fas fa-arrow-right me-2"></i>
                                    Continuar
                                  </span>
                                </button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Segunda ventana: Datos del Pagador -->
            <div class="row paso0_5 hidden" id="paso0_5">
              <div class="col-md-6 col-sm-12 col-xs-12 mx-auto">
                <div class="vc_row wpb_row vc_row-fluid slide_pasos">
                  <div class="wpb_column container-fluid vc_col-sm-12">
                    <div class="vc_column-inner">
                      <div class="wpb_wrapper">
                        <div class="modern-card" style="background: linear-gradient(135deg, rgba(15, 23, 42, 0.95) 0%, rgba(30, 41, 59, 0.9) 100%); border-radius: 20px; border: 1px solid rgba(148, 163, 184, 0.2); box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5), 0 0 0 1px rgba(255, 255, 255, 0.05); backdrop-filter: blur(10px);">
                          <div class="card-body" style="padding: 2.5rem;">
                            <!-- Header Section -->
                            <div class="text-center mb-4">
                              <div class="d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px; background: linear-gradient(135deg, #10b981, #059669); border-radius: 20px; box-shadow: 0 10px 25px rgba(16, 185, 129, 0.3);">
                                <i class="fas fa-mobile-alt" style="font-size: 2rem; color: white;"></i>
                              </div>
                              <h3 class="h3_responsive text-white mb-2" style="font-weight: 700; font-size: 1.875rem; letter-spacing: -0.025em;">Datos del Pagador</h3>
                              <p class="text-slate-300" style="font-size: 1.1rem; margin-bottom: 0.5rem;">Información del titular de la cuenta del pago móvil</p>
                              <div class="d-inline-block px-3 py-2" style="background: linear-gradient(135deg, rgba(16, 185, 129, 0.1), rgba(5, 150, 105, 0.1)); border: 1px solid rgba(16, 185, 129, 0.3); border-radius: 8px; font-size: 0.9rem; color: #10b981; font-weight: 600;">
                                <i class="fas fa-mobile-alt me-1"></i>Pago Móvil - Banco R4
                              </div>
                            </div>

                            <!-- Total Amount -->
                            <div class="text-center mb-4">
                              <div class="d-inline-block px-4 py-3" style="background: linear-gradient(135deg, rgba(16, 185, 129, 0.1), rgba(5, 150, 105, 0.1)); border: 1px solid rgba(16, 185, 129, 0.3); border-radius: 12px;">
                                <span class="text-slate-200" style="font-weight: 500; font-size: 1rem;">Total a pagar: </span>
                                <span class="text-emerald-400" id="pre_final_bs_2" style="font-weight: 800; font-size: 1.25rem;"></span>
                              </div>
                            </div>

                            <!-- Form Fields -->
                            <form>
                              <div class="row g-4 mb-4">
                                <div class="col-md-6">
                                  <div class="modern-input-group">
                                    <label for="pre_emisor_cedula" class="modern-label">
                                      <i class="fas fa-id-card me-2"></i>Cédula
                                    </label>
                                    <input type="number" id="pre_emisor_cedula" class="form-control modern-form-control" inputmode="numeric" placeholder="12345678">
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="modern-input-group">
                                    <label for="pre_emisor_telefono" class="modern-label">
                                      <i class="fas fa-phone me-2"></i>Teléfono
                                    </label>
                                    <input type="text" id="pre_emisor_telefono" class="form-control modern-form-control" maxlength="11" inputmode="numeric" placeholder="0412XXXXXXX">
                                  </div>
                                </div>
                              </div>

                              <div class="mb-4">
                                <div class="modern-input-group">
                                  <label for="pre_bank_code" class="modern-label">
                                    <i class="fas fa-university me-2"></i>Banco Emisor
                                  </label>
                                  <select id="pre_bank_code" class="form-select modern-form-control">
                                    <option value="" style="background: #1e293b; color: white;">Seleccione banco</option>
                                    <option value="0102" style="background: #1e293b; color: white;">0102 - Banco de Venezuela S.A.C.A. Banco Universal</option>
                                    <option value="0104" style="background: #1e293b; color: white;">0104 - Venezolano de Crédito, S.A. Banco Universal</option>
                                    <option value="0105" style="background: #1e293b; color: white;">0105 - Mercantil Banco, C.A. Banco Universal</option>
                                    <option value="0108" style="background: #1e293b; color: white;">0108 - BBVA Provincial, S.A. Banco Universal</option>
                                    <option value="0114" style="background: #1e293b; color: white;">0114 - Bancaribe C.A. Banco Universal</option>
                                    <option value="0115" style="background: #1e293b; color: white;">0115 - Banco Exterior C.A. Banco Universal</option>
                                    <option value="0128" style="background: #1e293b; color: white;">0128 - Banco Caroní C.A. Banco Universal</option>
                                    <option value="0134" style="background: #1e293b; color: white;">0134 - Banesco, Banco Universal S.A.C.A.</option>
                                    <option value="0137" style="background: #1e293b; color: white;">0137 - Banco Sofitasa, Banco Universal</option>
                                    <option value="0138" style="background: #1e293b; color: white;">0138 - Banco Plaza, Banco Universal</option>
                                    <option value="0146" style="background: #1e293b; color: white;">0146 - Bangente C.A</option>
                                    <option value="0151" style="background: #1e293b; color: white;">0151 - BFC Banco Fondo Común C.A. Banco Universal</option>
                                    <option value="0156" style="background: #1e293b; color: white;">0156 - 100% Banco, Banco Universal C.A.</option>
                                    <option value="0157" style="background: #1e293b; color: white;">0157 - DelSur Banco Universal C.A.</option>
                                    <option value="0163" style="background: #1e293b; color: white;">0163 - Banco del Tesoro, C.A. Banco Universal</option>
                                    <option value="0166" style="background: #1e293b; color: white;">0166 - Banco Agrícola de Venezuela, C.A. Banco Universal</option>
                                    <option value="0168" style="background: #1e293b; color: white;">0168 - Bancrecer, S.A. Banco Microfinanciero</option>
                                    <option value="0169" style="background: #1e293b; color: white;">0169 - R4, Banco Microfinanciero C.A.</option>
                                    <option value="0171" style="background: #1e293b; color: white;">0171 - Banco Activo, Banco Universal</option>
                                    <option value="0172" style="background: #1e293b; color: white;">0172 - Bancamiga, Banco Universal C.A.</option>
                                    <option value="0173" style="background: #1e293b; color: white;">0173 - Banco Internacional de Desarrollo, C.A. Banco Universal</option>
                                    <option value="0174" style="background: #1e293b; color: white;">0174 - Banplus Banco Universal, C.A</option>
                                    <option value="0175" style="background: #1e293b; color: white;">0175 - Banco Digital de Los Trabajadores</option>
                                    <option value="0177" style="background: #1e293b; color: white;">0177 - Banco de la Fuerza Armada Nacional Bolivariana, B.U.</option>
                                    <option value="0178" style="background: #1e293b; color: white;">0178 - N58 Banco Digital, S.A. J503581107</option>
                                    <option value="0191" style="background: #1e293b; color: white;">0191 - Banco Nacional de Crédito, C.A. Banco Universal</option>
                                    <option value="0601" style="background: #1e293b; color: white;">0601 - Instituto Municipal de Crédito Popular</option>
                                  </select>
                                </div>
                              </div>

                              <div class="d-grid mt-4">
                                <button type="button" class="btn modern-btn-success" id="btnPreOrder2" style="background: linear-gradient(135deg, #10b981, #059669); border: none; border-radius: 12px; padding: 1rem 2rem; font-weight: 600; font-size: 1.1rem; color: white; transition: all 0.3s ease; position: relative; overflow: hidden; box-shadow: 0 10px 25px rgba(16, 185, 129, 0.3);">
                                  <span class="d-flex align-items-center justify-content-center">
                                    <i class="fas fa-arrow-right me-2"></i>
                                    Continuar
                                  </span>
                                </button>
                              </div>
                            </form>
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
            <div class="row paso1 hidden" id="paso1">
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
                        <!-- Modern Progress Bar -->
                        <div class="mb-4" style="background: rgba(15, 23, 42, 0.6); border-radius: 16px; padding: 1.5rem; border: 1px solid rgba(148, 163, 184, 0.1);">
                          <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="d-flex align-items-center">
                              <div class="d-inline-flex align-items-center justify-content-center me-3" style="width: 3rem; height: 3rem; background: linear-gradient(135deg, #10b981, #059669); border-radius: 12px; box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);">
                                <i class="fas fa-ticket-alt" style="font-size: 1.5rem; color: white;"></i>
                              </div>
                              <div>
                                <h5 class="text-white mb-1" style="font-weight: 600;">Disponibilidad de Tickets</h5>
                                <p class="text-slate-400 mb-0" style="font-size: 0.9rem;">Tickets disponibles en esta rifa</p>
                              </div>
                            </div>
                            <div class="text-end">
                              <span class="text-emerald-400" style="font-size: 1.5rem; font-weight: 700;" id="barraRealTimeText">{{ $Barra }}%</span>
                              <div class="text-slate-400" style="font-size: 0.8rem;">disponible</div>
                            </div>
                          </div>
                          <div class="progress" style="height: 8px; border-radius: 4px; background: rgba(30, 41, 59, 0.5);">
                            <div class="progress-bar" style="background: linear-gradient(90deg, #10b981, #059669); width: {{ $Barra }}%; border-radius: 4px; transition: width 0.3s ease;" id="barraRealTime"></div>
                          </div>
                        </div>
                        
                        <!-- <div class="wpb_raw_code wpb_content_element wpb_raw_html compra_manual d-none">
                          <div class="wpb_wrapper">
                          <h3 class="h3_responsive" style="text-align: center; color: white">Escriba los números a comprar</h3>
                          </div>
                        </div> -->
                        <!-- <div class="vc_row wpb_row vc_inner vc_row-fluid flex flex_row compra_manual d-none">
                          <div class="wpb_column container-fluid vc_col-sm-3">
                            <div class="vc_column-inner">
                              <div class="wpb_wrapper">
                                <div class="flex center flex-center">
                                  <select class="select2 form-control" id="numeros_manual" style="width: 100%;" multiple="multiple"></select>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div> -->
                        <!-- <div class="vc_row wpb_row vc_inner vc_row-fluid flex flex_row compra_auto mt-3">
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
                                      <input type="text" onblur="validar_cant(this.value)" onkeyup="put_cant(this.value)" id="cant_boletos" name="cant_boletos" value="{{$cantidad_minima}}" class="form-control">
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
                        </div> -->
                       <!--  <div class="wpb_raw_code wpb_content_element wpb_raw_html" >
                          <div class="wpb_wrapper">
                            <h3 class="h4_responsive ptop_0" style="text-align: center; color: white">Cantidad mínima permitida: <span class="yellow_color">{{$cantidad_minima}}</span></h3>
                          </div>
                        </div> -->
                        <!-- Modern Payment Methods Section -->
                        <div class="modern-card" style="background: rgba(15, 23, 42, 0.6); border-radius: 20px; padding: 2rem; border: 1px solid rgba(148, 163, 184, 0.1); margin-bottom: 1.5rem;">
                          <!-- Header -->
                          <div class="text-center mb-4">
                            <div class="d-inline-flex align-items-center justify-content-center mb-3" style="width: 4rem; height: 4rem; background: linear-gradient(135deg, #10b981, #059669); border-radius: 50%; box-shadow: 0 10px 25px rgba(16, 185, 129, 0.3);">
                              <i class="fas fa-credit-card" style="font-size: 2rem; color: white;"></i>
                            </div>
                            <h3 class="text-white mb-2" style="font-weight: 700; font-size: 1.875rem; letter-spacing: -0.025em;">Datos para el Pago</h3>
                          </div>

                          <!-- Payment Methods Grid -->
                          <div class="row g-3 mb-4">
                            @foreach($metodos as $i => $metodo)
                            <div class="col-12">
                              <div class="payment-method-card" style="background: rgba(30, 41, 59, 0.4); border: 2px solid rgba(148, 163, 184, 0.2); border-radius: 16px; padding: 1.5rem; cursor: pointer; transition: all 0.3s ease; position: relative; overflow: hidden;" id="metodo_{{$metodo->id}}" onclick="showPaymentData(this,'{{$metodo}}')">
                                <div class="d-flex align-items-center">
                                  <div class="payment-logo me-4" style="width: 80px; height: 80px; display: flex; align-items: center; justify-content: center; background: rgba(255, 255, 255, 0.1); border-radius: 50%; backdrop-filter: blur(10px);">
                                    <img src="{{Storage::url($metodo->logo)}}" style="width: 60px; height: 60px; border-radius: 50%; object-fit: cover;" class="img_payment">
                                  </div>
                                  <div class="flex-grow-1">
                                    <div class="payment-name mb-2" style="color: white; font-weight: 600; font-size: 1.2rem;">
                                      {!!$metodo['metodo']!!}
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            @endforeach
                          </div>

                          <!-- Payment Data Display -->
                          <div class="modern-card" style="background: linear-gradient(135deg, rgba(16, 185, 129, 0.1), rgba(5, 150, 105, 0.1)); border: 2px solid rgba(16, 185, 129, 0.3); border-radius: 16px; padding: 2rem; text-align: center; position: relative; overflow: hidden;">
                            <div class="d-inline-flex align-items-center justify-content-center mb-3" style="width: 3rem; height: 3rem; background: linear-gradient(135deg, #10b981, #059669); border-radius: 50%; box-shadow: 0 8px 20px rgba(16, 185, 129, 0.4);">
                              <i class="fas fa-university" style="font-size: 1.5rem; color: white;"></i>
                            </div>
                            <h4 class="text-emerald-400 mb-3" style="font-weight: 700; font-size: 1.25rem;">Datos para el Pago</h4>
                            <div id="payment_data" style="color: #10b981; font-size: 1.5rem; font-weight: 700; font-family: 'Courier New', monospace; text-shadow: 0 0 10px rgba(16, 185, 129, 0.3); letter-spacing: 2px;">
                              {!!$metodos[0]['descripcion']!!}
                            </div>
                            
                            <!-- Copy Button -->
                            <div class="mt-4">
                              <button class="btn" style="background: linear-gradient(135deg, #10b981, #059669); border: none; border-radius: 12px; padding: 0.75rem 1.5rem; font-weight: 600; color: white; font-size: 1rem; transition: all 0.3s ease; box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);" onclick="copiarDatosCompletos(document.getElementById('payment_data').innerHTML)" type="button">
                                <i class="fas fa-copy me-2"></i>Copiar datos
                              </button>
                            </div>
                            
                            <!-- Purchase Summary -->
                            <div class="mt-4">
                              <div class="row g-3">
                                <div class="col-md-6">
                                  <div class="d-flex align-items-center justify-content-center" style="background: rgba(30, 41, 59, 0.4); padding: 1rem; border-radius: 12px; border: 1px solid rgba(148, 163, 184, 0.2);">
                                    <div class="d-inline-flex align-items-center justify-content-center me-3" style="width: 2.5rem; height: 2.5rem; background: linear-gradient(135deg, #10b981, #059669); border-radius: 50%; box-shadow: 0 5px 15px rgba(16, 185, 129, 0.3);">
                                      <i class="fas fa-ticket-alt" style="font-size: 1rem; color: white;"></i>
                                    </div>
                                    <div class="text-center">
                                      <span class="text-slate-400" style="font-size: 0.85rem; font-weight: 500; display: block;">TICKETS</span>
                                      <span class="text-white" style="font-weight: 700; font-size: 1.25rem;"><?=$_GET["q"]?></span>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="d-flex align-items-center justify-content-center" style="background: rgba(16, 185, 129, 0.1); padding: 1rem; border-radius: 12px; border: 2px solid rgba(16, 185, 129, 0.3);">
                                    <div class="d-inline-flex align-items-center justify-content-center me-3" style="width: 2.5rem; height: 2.5rem; background: linear-gradient(135deg, #10b981, #059669); border-radius: 50%; box-shadow: 0 5px 15px rgba(16, 185, 129, 0.3);">
                                      <i class="fas fa-dollar-sign" style="font-size: 1rem; color: white;"></i>
                                    </div>
                                    <div class="text-center">
                                      <span class="text-emerald-400" style="font-size: 0.85rem; font-weight: 500; display: block;">TOTAL A PAGAR</span>
                                      <span class="text-emerald-400" id="payment_total_display" style="font-weight: 700; font-size: 1.25rem;"></span>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            
                            <div class="mt-3 text-center">
                              <span class="text-emerald-300" style="font-size: 0.9rem; font-weight: 500;">💡 Los datos se han copiado al portapapeles</span>
                            </div>
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
                        <div class="vc_separator wpb_content_element vc_separator_align_center vc_sep_width_100 vc_sep_border_width_2 vc_sep_pos_align_center vc_separator_no_text vc_sep_color_white vc_custom_1712884726693  vc_custom_1712884726693" ><span class="vc_sep_holder vc_sep_holder_l"><span class="vc_sep_line"></span></span><span class="vc_sep_holder vc_sep_holder_r"><span class="vc_sep_line"></span></span>
                        </div>
                        <!-- Modern Payment Report Section -->
                        <div class="modern-card" style="background: rgba(30, 41, 59, 0.2); border: 1px solid rgba(148, 163, 184, 0.1); border-radius: 20px; padding: 2rem; margin: 1.5rem 0;">
                          <div class="container-fluid">
                            <!-- Header -->
                            <div class="text-center mb-4">
                              <div class="d-inline-flex align-items-center justify-content-center" style="width: 4rem; height: 4rem; background: linear-gradient(135deg, #10b981, #059669); border-radius: 50%; margin-bottom: 1rem; box-shadow: 0 10px 25px rgba(16, 185, 129, 0.3);">
                                <i class="fas fa-credit-card" style="font-size: 2rem; color: white;"></i>
                              </div>
                              <h3 class="h3_responsive text-white mb-2" style="font-weight: 700; font-size: 1.875rem; letter-spacing: -0.025em;">Reporte de Pago</h3>
                              <p class="text-slate-300" style="font-size: 1.1rem; margin-bottom: 0;">Confirma tu información y sube el comprobante de pago</p>
                            </div>

                            <!-- Resumen de Información -->
                            <div class="mb-4 p-3" style="background: rgba(15, 23, 42, 0.4); border: 1px solid rgba(148, 163, 184, 0.1); border-radius: 12px;">
                              <h5 class="text-white mb-3" style="font-weight: 600; display: flex; align-items: center;">
                                <i class="fas fa-clipboard-list me-2" style="color: #10b981;"></i>
                                Resumen de tu compra
                              </h5>
                              <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                  <div class="d-flex flex-column" style="background: rgba(30, 41, 59, 0.3); padding: 0.75rem; border-radius: 8px;">
                                    <span class="text-slate-400" style="font-size: 0.8rem; font-weight: 500; margin-bottom: 0.25rem;">CONCURSANTE</span>
                                    <span id="summary_contestant" class="text-white" style="font-weight: 600;">-</span>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="d-flex flex-column" style="background: rgba(30, 41, 59, 0.3); padding: 0.75rem; border-radius: 8px;">
                                    <span class="text-slate-400" style="font-size: 0.8rem; font-weight: 500; margin-bottom: 0.25rem;">PAGADOR</span>
                                    <span id="summary_payer" class="text-white" style="font-weight: 600;">-</span>
                                  </div>
                                </div>
                              </div>
                              <div class="row g-3">
                                <div class="col-md-4">
                                  <div class="d-flex flex-column" style="background: rgba(30, 41, 59, 0.3); padding: 0.75rem; border-radius: 8px;">
                                    <span class="text-slate-400" style="font-size: 0.8rem; font-weight: 500; margin-bottom: 0.25rem;">BANCO EMISOR</span>
                                    <span id="summary_bank" class="text-white" style="font-weight: 600;">-</span>
                                  </div>
                                </div>
                                <div class="col-md-4">
                                  <div class="d-flex flex-column" style="background: rgba(30, 41, 59, 0.3); padding: 0.75rem; border-radius: 8px;">
                                    <span class="text-slate-400" style="font-size: 0.8rem; font-weight: 500; margin-bottom: 0.25rem;">TICKETS</span>
                                    <span id="summary_tickets" class="text-white" style="font-weight: 600;"><?=$_GET["q"]?></span>
                                  </div>
                                </div>
                                <div class="col-md-4">
                                  <div class="d-flex flex-column" style="background: rgba(16, 185, 129, 0.1); padding: 0.75rem; border-radius: 8px; border: 1px solid rgba(16, 185, 129, 0.2); text-align: center;">
                                    <span class="text-emerald-400" style="font-size: 0.8rem; font-weight: 500; margin-bottom: 0.25rem;">TOTAL A PAGAR</span>
                                    <span id="summary_total" class="text-emerald-400" style="font-weight: 700; font-size: 1.25rem;">-</span>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <!-- Datos del concursante ya capturados en pasos previos; no se duplican inputs -->

                            <!-- Payment Fields -->
                            <div class="row g-4">
                              <div class="col-12">
                                <div class="modern-input-group">
                                  <label for="archivo_pago" class="modern-label">
                                    <i class="fas fa-camera me-2"></i>Comprobante de Pago
                                  </label>
                                  <input type="file" accept="image/jpeg,image/png,image/svg+xml" id="archivo_pago" name="archivo_pago" onblur="put_pago(this.id,this.value)" class="form-control modern-form-control" style="font-weight: 600; padding: 0.875rem 1rem;">
                                  <div class="info-text mt-2">
                                    <i class="fas fa-info-circle"></i>
                                    <span>Sube una imagen clara del comprobante (JPG, PNG, SVG)</span>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="row g-4 mt-2">
                              <div class="col-md-6 col-12">
                                <div class="modern-input-group">
                                  <label for="ref" class="modern-label">
                                    <i class="fas fa-hashtag me-2"></i>Referencia Bancaria
                                  </label>
                                  <input type="text" onkeyup="put_pago(this.id,this.value)" onblur="validateMin(this,8)" id="ref" name="ref" class="form-control modern-form-control" maxlength="8" placeholder="12345678" inputmode="numeric">
                                  <div class="info-text-small mt-1">
                                    <i class="fas fa-info-circle"></i>
                                    <span>Últimos 8 dígitos de la referencia</span>
                                  </div>
                                </div>
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
              <!-- Modern Action Buttons -->
              <div class="col-12 mt-4">
                <div class="row g-3">
                  @if($queda < 9999 || $logged)
                  <div class="col-md-6 col-12" id="boton_comprar">
                    <button class="btn modern-btn-primary w-100" onclick="finalizar_compra(this)" style="background: linear-gradient(135deg, #10b981, #059669); border: none; border-radius: 12px; padding: 1rem 1.5rem; font-weight: 700; color: white; font-size: 1.1rem; transition: all 0.3s ease; box-shadow: 0 10px 25px rgba(16, 185, 129, 0.3); position: relative; overflow: hidden;">
                      <span class="d-flex align-items-center justify-content-center">
                        <i class="fas fa-shopping-cart me-2" style="font-size: 1.2rem;"></i>
                        Comprar
                      </span>
                    </button>
                  </div>
                  @endif
                  <div class="col-md-6 col-12">
                    <button class="btn modern-btn-secondary w-100" onclick="atras()" style="background: rgba(239, 68, 68, 0.1); border: 2px solid rgba(239, 68, 68, 0.3); border-radius: 12px; padding: 1rem 1.5rem; font-weight: 700; color: #ef4444; font-size: 1.1rem; transition: all 0.3s ease; backdrop-filter: blur(10px);">
                      <span class="d-flex align-items-center justify-content-center">
                        <i class="fas fa-arrow-left me-2" style="font-size: 1.2rem;"></i>
                        Volver
                      </span>
                    </button>
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
          <img src="{{ Storage::url($logo)}}" class="img" />
        </div>
      </div>
      <div class="vc_row-full-width vc_clearfix"></div>
      @include("partials.terminos")

    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
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

      function copiarTexto(text){
        navigator.clipboard.writeText(text)
        .then(() => {
          // Show modern success notification
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
          
          // Remove after 3 seconds
          setTimeout(() => {
            notification.style.animation = 'slideOutRight 0.3s ease-in';
            setTimeout(() => notification.remove(), 300);
          }, 3000);
        })
        .catch(err => {
          console.error("Error al copiar:", err);
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'No se pudo copiar al portapapeles'
          });
        });
      }

      function showPaymentData(element, metodo) {
        // Remove active class from all payment methods
        document.querySelectorAll('.payment-method-card').forEach(card => {
          card.classList.remove('active');
        });
        
        // Add active class to selected method
        element.classList.add('active');
        
        // Update payment data display
        const paymentDataDiv = document.getElementById('payment_data');
        if (paymentDataDiv && metodo.descripcion) {
          paymentDataDiv.innerHTML = metodo.descripcion;
        }
        
        // Smooth scroll to payment data
        paymentDataDiv.scrollIntoView({ 
          behavior: 'smooth', 
          block: 'nearest' 
        });
        
        // Add pulse animation
        paymentDataDiv.style.animation = 'none';
        setTimeout(() => {
          paymentDataDiv.style.animation = 'pulseGlow 2s infinite';
        }, 100);
      }

      function copiarDatosCompletos(bankData){
        // Get current total amount
        const totalElement = document.getElementById('payment_total_display') || document.getElementById('summary_total');
        const totalAmount = totalElement ? totalElement.textContent : '';
        const ticketCount = <?= $_GET["q"] ?>;
        
        // Build simple data string: bank data + amount
        const cleanAmount = totalAmount.replace(' Bs.', '').trim();
        const completeData = `${bankData} ${cleanAmount}`;

        navigator.clipboard.writeText(completeData)
        .then(() => {
          // Show modern success notification
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
          
          // Remove after 4 seconds (longer for complete data)
          setTimeout(() => {
            notification.style.animation = 'slideOutRight 0.3s ease-in';
            setTimeout(() => notification.remove(), 300);
          }, 4000);
        })
        .catch(err => {
          console.error("Error al copiar:", err);
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'No se pudo copiar al portapapeles'
          });
        });
      }

      const datos = {
        cant_boletos: <?= $_GET["q"] ?>,
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

      // Step 1: Datos del Concursante
      jQuery('#btnPreOrder').on('click', async function(){
        const pre = {
          cedula: jQuery('#pre_cedula').val().trim(),
          nombre_completo: jQuery('#pre_nombre').val().trim(),
          correo: jQuery('#pre_correo').val().trim(),
          telefono: jQuery('#pre_telefono').val().trim(),
        };

        if(!pre.cedula || !pre.nombre_completo || !pre.correo || !pre.telefono){
          Swal.fire('Completa todos los campos del concursante');
          return;
        }

        // Validar teléfono de 11 dígitos exactos
        if(pre.telefono.replace(/[^0-9]/g, '').length !== 11){
          Swal.fire('El teléfono del concursante debe tener exactamente 11 dígitos');
          return;
        }

        // Almacenar datos del concursante
        window.contestantData = pre;
        
        // Mostrar total en el paso siguiente
        jQuery('#pre_final_bs_2').text(jQuery('#pre_final_bs').text());
        
        // Pasar al paso 0.5 (Datos del Pagador)
        jQuery('#paso0').addClass('hidden');
        jQuery('#paso0_5').removeClass('hidden');
      });

      // Step 2: Datos del Pagador
      jQuery('#btnPreOrder2').on('click', async function(){
        const emisor = {
          emisor_cedula: jQuery('#pre_emisor_cedula').val().trim(),
          emisor_telefono: jQuery('#pre_emisor_telefono').val().trim(),
          bank_code: jQuery('#pre_bank_code').val(),
        };

        if(!emisor.emisor_cedula || !emisor.emisor_telefono || !emisor.bank_code){
          Swal.fire('Completa todos los datos del pagador');
          return;
        }

        // Validar teléfono del emisor de 11 dígitos exactos
        if(emisor.emisor_telefono.replace(/[^0-9]/g, '').length !== 11){
          Swal.fire('El teléfono del pagador debe tener exactamente 11 dígitos');
          return;
        }

        // Ya no replicamos campos; el resumen muestra la info y se usa memoria (window.*)

        // Almacenar datos del emisor
        window.emisorData = emisor;

        try {
          const resp = await fetch('{{config('app.url')}}/api/preOrder', {
            method: 'POST',
            headers: {
              'X-Requested-With': 'XMLHttpRequest'
            },
            body: toFormData({
              raffle_id: {{$rifa->id}},
              cantidad: datos.cant_boletos,
              // Datos principales (del pagador/emisor)
              cedula: emisor.emisor_cedula,
              telefono: emisor.emisor_telefono,
              // Datos del concursante
              nombre_completo: window.contestantData.nombre_completo,
              correo: window.contestantData.correo,
              // Datos adicionales del emisor
              emisor_cedula: emisor.emisor_cedula,
              emisor_telefono: emisor.emisor_telefono,
              bank_code: emisor.bank_code,
            })
          });
          const data = await resp.json();
          if(!data.success){
            Swal.fire('No se pudo crear la pre-orden');
            return;
          }
          PRE_ORDER_UUID = data.pre_order.uuid;
          jQuery('#paso0_5').addClass('hidden');
          jQuery('#paso1').removeClass('hidden');
          // Actualizar el resumen al entrar en la ventana de Reporte de Pago
          try { updateSummary(); } catch (e) {}
        } catch (e) {
          Swal.fire('Error de red creando pre-orden');
        }
      });

      function toFormData(obj){
        const fd = new FormData();
        Object.keys(obj).forEach(k => fd.append(k, obj[k]));
        return fd;
      }

      function volver_comprar(){
        cant_boletos.value = cantidad_minima;
        document.getElementById("ref").value = "";
        // document.getElementById("fecha").value = "";
        document.getElementById("archivo_pago").value = "";
        
        // Limpiar datos almacenados
        window.contestantData = null;
        window.emisorData = null;
        
        // Resetear campos de los pasos anteriores
        jQuery('#pre_cedula').val('');
        jQuery('#pre_nombre').val('');
        jQuery('#pre_correo').val('');
        jQuery('#pre_telefono').val('');
        jQuery('#pre_emisor_cedula').val('');
        jQuery('#pre_emisor_telefono').val('');
        jQuery('#pre_bank_code').val('');
        
        datos.cant_boletos = 2;
        datos.pago.archivo_pago = "";
        datos.pago.ref = "";
        // datos.pago.fecha = "";
        
        // Volver al primer paso
        jQuery("#paso_final").addClass("hidden");
        jQuery("#paso0_5").addClass("hidden");
        jQuery("#paso1").addClass("hidden");
        jQuery("#paso0").removeClass("hidden");
        paso = 0;
      }

      // function minus_cant(){
      //   if(cant_boletos.value > cantidad_minima){
      //     cant_boletos.value--; 
      //     datos.cant_boletos = parseInt(cant_boletos.value);
      //     calcular_total();
      //   }
        
      // }

      function validateMin(_this,length) {
        const isValid = _this.value.length == length;

        if(!isValid) {
          Swal.fire(`La referencia debe ser de ${length} números`);
          datos.pago.ref = "";
          _this.value = "";
        }
      }

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
        // Teléfono del concursante
        const phoneInput = document.getElementById('pre_telefono');
        if(phoneInput) {
          const clampPhone = () => {
            phoneInput.value = (phoneInput.value || '').replace(/[^0-9]/g, '').slice(0, 11);
          };
          phoneInput.addEventListener('input', clampPhone);
          phoneInput.addEventListener('keyup', clampPhone);
          phoneInput.addEventListener('change', clampPhone);
        }
        
        // Teléfono del emisor
        const emisorPhoneInput = document.getElementById('pre_emisor_telefono');
        if(emisorPhoneInput) {
          const clampEmisorPhone = () => {
            emisorPhoneInput.value = (emisorPhoneInput.value || '').replace(/[^0-9]/g, '').slice(0, 11);
          };
          emisorPhoneInput.addEventListener('input', clampEmisorPhone);
          emisorPhoneInput.addEventListener('keyup', clampEmisorPhone);
          emisorPhoneInput.addEventListener('change', clampEmisorPhone);
        }
      })();

      function validar_datos() {
        // Validar que lo capturado en pasos previos está completo
        const c = window.contestantData || {};
        const e = window.emisorData || {};
        const arr = [c.nombre_completo, c.cedula, c.telefono, c.correo, e.bank_code];
        return arr.every(v => !!(v !== undefined && v !== null && String(v).trim() !== ''));
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
          }
      }

      function updateSummary() {
        // Actualizar resumen con la información capturada
        if (window.contestantData) {
          const contestantText = `${window.contestantData.nombre_completo}<br><small style="color: #94a3b8;">V-${window.contestantData.cedula}</small>`;
          jQuery('#summary_contestant').html(contestantText);
        }

        if (window.emisorData) {
          const payerText = `Cédula: V-${window.emisorData.emisor_cedula}<br><small style="color: #94a3b8;">Telf: ${window.emisorData.emisor_telefono}</small>`;
          jQuery('#summary_payer').html(payerText);
          
          // Obtener nombre del banco desde el select
          const bankSelect = jQuery('#pre_bank_code');
          const bankText = bankSelect.find('option:selected').text() || 'No seleccionado';
          jQuery('#summary_bank').text(bankText.replace(/^\d{4} - /, ''));
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
        // Usar directamente los datos capturados en pasos anteriores
        const archivo_pago = document.querySelector("#archivo_pago");

        const contestant = window.contestantData || {};
        const emisor = window.emisorData || {};

        const ref = jQuery("#ref").val();
        const bank_code = emisor.bank_code;

        if(!ref) {
          Swal.fire("Debes colocar la referencia");
          return;
        }
        if(!bank_code) {
          Swal.fire("Debes seleccionar el banco emisor");
          return;
        }
        if(archivo_pago.files.length != 1) {
          Swal.fire("Debes subir el capture bancario");
          return;
        }
        if(!validar_datos()) {
          Swal.fire("todos los campos son obligatorios");
          return;
        }

        // Normalizar payload a partir de los objetos ya capturados
        const nombre_completo = (contestant.nombre_completo || '').trim();
        const correo = (contestant.correo || '').trim();
        const telefono = (contestant.telefono || '').trim();
        const cedula = (contestant.cedula || '').trim();
        const emisor_cedula = (emisor.emisor_cedula || '').trim();
        const emisor_telefono = (emisor.emisor_telefono || telefono || '').trim();

        const formData = new FormData();
        formData.append("raffle_id", {{$rifa->id}});
        formData.append("nombre_completo", nombre_completo);
        formData.append("correo", correo);
        formData.append("tlf", telefono);
        formData.append("cantidad", datos.cant_boletos);
        formData.append("cedula", cedula);
        formData.append("ref_banco", ref);
        formData.append("bank_code", bank_code);
        if(emisor_cedula) formData.append("emisor_cedula", emisor_cedula);
        if(emisor_telefono) formData.append("emisor_telefono", emisor_telefono);
        if(PRE_ORDER_UUID){ formData.append("pre_order_uuid", PRE_ORDER_UUID); }
        formData.append("ref_imagen", archivo_pago.files[0]);

        const linkGuardar = "{{config('app.url')}}/api/orderCliente";
        let UUID_COMPRA;

        _this.disabled = true;
        _this.innerHTML = `
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
            Swal.fire({
              icon: "error",
              title: "Error",
              text: res.message,
            });

            _this.disabled = false;
            _this.innerHTML = `
              <span class="d-flex align-items-center justify-content-center">
                <i class="fas fa-shopping-cart me-2" style="font-size: 1.2rem;"></i>
                Comprar
              </span>
            `;
          }
        });
      }

      // Sincronizar resumen al cambiar el banco en Paso 0.5
      jQuery('#pre_bank_code').on('change', function(){
        if (!window.emisorData) window.emisorData = {};
        window.emisorData.bank_code = this.value;
        try { updateSummary(); } catch (e) {}
      });

      function showTickets(uuid) {
        let timeLeft = 10;
        const checkInterval = 18000;
        let verificationInterval;

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
    </script>
  </body>
</html>
