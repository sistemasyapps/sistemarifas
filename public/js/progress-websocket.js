let ws;
let reconnectAttempts = 0;
const MAX_RECONNECT_ATTEMPTS = 5;
const RECONNECT_DELAY = 1000; // Delay base en milisegundos

function initWebSocket() {
    if (reconnectAttempts >= MAX_RECONNECT_ATTEMPTS) {
        console.log('Máximo número de intentos de reconexión alcanzado');
        return;
    }

    ws = new WebSocket('wss://rifaalvarado.yapirides.com:2053');
    
    ws.onopen = function() {
        console.log('WebSocket conectado');
        reconnectAttempts = 0;
        
        // Obtener raffleId y enviar inicialización
        const raffleId = getRaffleIdFromUrl();
        if (raffleId) {
            ws.send(JSON.stringify({
                init: true,
                raffleId: raffleId
            }));
        } else {
            console.error('No se pudo obtener el raffleId');
        }
    };
    
    ws.onmessage = function(e) {
        try {
            const data = JSON.parse(e.data);
            if (data.barra !== undefined && data.queda !== undefined) {
                updateProgressBar(data);
                saveProgressData(data);
            }
        } catch (error) {
            console.error('Error al procesar mensaje:', error);
        }
    };
    
    ws.onclose = function(e) {
        console.log('WebSocket desconectado:', e.reason);
        handleReconnect();
    };
    
    ws.onerror = function(e) {
        console.error('Error en WebSocket:', e);
    };
}

function handleReconnect() {
    reconnectAttempts++;
    const delay = Math.min(RECONNECT_DELAY * Math.pow(2, reconnectAttempts - 1), 30000);
    console.log(`Intentando reconectar en ${delay/1000} segundos...`);
    setTimeout(initWebSocket, delay);
}

function updateProgressBar(data) {
    const progressBar = document.querySelector('.progress-bar');
    if (progressBar) {
        progressBar.style.width = data.barra + '%';
        progressBar.textContent = 'QUEDAN ' + data.queda + ' BOLETOS';
        
        // Actualizar variable global quedan
        window.quedan = data.queda;
        
        // Actualizar máximo permitido para compra
        actualizarMaximoPermitido(data.queda);
    }
}

function actualizarMaximoPermitido(quedaDisponible) {
    const cantBoletosInput = document.getElementById('cant_boletos');
    if (cantBoletosInput) {
        const valorActual = parseInt(cantBoletosInput.value) || 2;
        if (valorActual > quedaDisponible) {
            cantBoletosInput.value = quedaDisponible;
            window.datos.cant_boletos = quedaDisponible;
            window.calcular_total();
        }
    }
}

function getRaffleIdFromUrl() {
    // Obtener la URL actual
    const path = window.location.pathname;
    
    // Patrones para ambas rutas
    const compraMatch = path.match(/\/compra\/(\d+)/);
    const compraTestMatch = path.match(/\/compraTest\/(\d+)/);
    
    // Retornar el ID si se encuentra en cualquiera de las rutas
    if (compraMatch) return compraMatch[1];
    if (compraTestMatch) return compraTestMatch[1];
    
    // Buscar en input oculto
    const raffleInput = document.querySelector('input[name="raffle_id"]');
    if (raffleInput) return raffleInput.value;
    
    // Buscar en la variable PHP inyectada
    if (typeof window.currentRaffleId !== 'undefined') {
        return window.currentRaffleId;
    }
    
    return null;
}

function saveProgressData(data) {
    try {
        const raffleId = getRaffleIdFromUrl();
        if (!raffleId) return;

        localStorage.setItem(`progress_${raffleId}_barra`, data.barra.toString());
        localStorage.setItem(`progress_${raffleId}_queda`, data.queda.toString());
        localStorage.setItem(`progress_${raffleId}_update`, Date.now().toString());
    } catch (error) {
        console.error('Error guardando datos en localStorage:', error);
    }
}

function getLastProgressValue() {
    try {
        const raffleId = getRaffleIdFromUrl();
        if (!raffleId) return;

        const lastBarra = localStorage.getItem(`progress_${raffleId}_barra`);
        const lastQueda = localStorage.getItem(`progress_${raffleId}_queda`);
        const lastUpdate = localStorage.getItem(`progress_${raffleId}_update`);
        
        if (lastBarra && lastQueda && lastUpdate) {
            const now = Date.now();
            const timeDiff = now - parseInt(lastUpdate);
            
            if (timeDiff < 5000) {
                updateProgressBar({
                    barra: parseFloat(lastBarra),
                    queda: parseInt(lastQueda)
                });
            }
        }
    } catch (error) {
        console.error('Error recuperando datos del localStorage:', error);
    }
}

// Inicialización
document.addEventListener('DOMContentLoaded', function() {
    getLastProgressValue();
    initWebSocket();
});