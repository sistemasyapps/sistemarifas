import '../css/app.css';
import './bootstrap';
import Swiper from 'swiper';
import { Navigation, EffectCoverflow } from 'swiper/modules';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/effect-coverflow';
/*import Echo from 'laravel-echo';

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    wsHost: window.location.hostname,
    wsPort: 6001,
    forceTLS: true,
    disableStats: true,
});

window.Echo.channel('orders')
    .listen('OrderUpdated', () => {
        window.Livewire.dispatch('refresh');
    });*/

// if (typeof window !== 'undefined') {
//     const isAdminRoute = window.location.pathname.startsWith('/admin');

//     if (! isAdminRoute && 'Notification' in window) {
//         import('firebase/app').then(({ initializeApp }) => {
//             import('firebase/messaging').then(({ getMessaging, getToken, onMessage }) => {
//                 const firebaseConfig = {
//                     apiKey: 'AIzaSyC88e6TkKcsFnY9ymS5i3RQR4aUlumSnfc',
//                     authDomain: 'rifavinotinto.firebaseapp.com',
//                     projectId: 'rifavinotinto',
//                     storageBucket: 'rifavinotinto.firebasestorage.app',
//                     messagingSenderId: '665137785090',
//                     appId: '1:665137785090:web:6f8c1a2209e0952a3efa1b',
//                     measurementId: 'G-FTPZJQHEXQ',
//                 };

//                 const firebaseApp = initializeApp(firebaseConfig);
//                 const messaging = getMessaging(firebaseApp);

//                 async function initPush() {
//                     try {
//                         await Notification.requestPermission();

//                         if (Notification.permission === 'granted') {
//                             const token = await getToken(messaging, {
//                                 vapidKey: 'BLRXgajKu-xoq9dhiwsfj43w1tO0iexWbZVFd2tZs_9j91ZyXsBHjR1KOUNagujUOc17eA4jrBt0OAM6XtJHy2w',
//                             });

//                             subscribeToTopic(token);
//                         }

//                         if (Notification.permission === 'denied') {
//                             alert('Por favor habilita notificaciones manualmente en ajustes del navegador');
//                         }
//                     } catch (error) {
//                         console.error('Error en notificaciones:', error);
//                     }
//                 }

//                 function subscribeToTopic(token) {
//                     return fetch(`https://rifasvinotinto.com/api/toTopic/${token}`, {
//                         method: 'POST',
//                     }).then(response => {
//                         if (! response.ok) {
//                             throw new Error('Suscripción fallida');
//                         }
//                     });
//                 }

//                 initPush();

//                 onMessage(messaging, payload => {
//                     new Notification(payload.notification.title, {
//                         body: payload.notification.body,
//                         icon: payload.notification.icon,
//                         data: { url: payload.data.url },
//                     });
//                 });
//             });
//         });
//     }
// }

// Swiper carousel for raffles
document.addEventListener('DOMContentLoaded', () => {
    const swiperContainer = document.querySelector('.raffle-swiper');

    if (!swiperContainer) return;

    const swiper = new Swiper('.raffle-swiper', {
        modules: [Navigation, EffectCoverflow],
        effect: 'coverflow',
        grabCursor: true,
        centeredSlides: true,
        slidesPerView: 'auto',
        initialSlide: 0,
        coverflowEffect: {
            rotate: 0,
            stretch: 0,
            depth: 100,
            modifier: 2,
            slideShadows: false,
        },
        navigation: {
            nextEl: '#nextRaffle',
            prevEl: '#prevRaffle',
        },
        // breakpoints: {
        //     320: {
        //         slidesPerView: 1.5,
        //         coverflowEffect: {
        //             depth: 100,
        //             modifier: 1.5,
        //         },
        //     },
        //     768: {
        //         slidesPerView: 'auto',
        //         coverflowEffect: {
        //             depth: 150,
        //             modifier: 2,
        //         },
        //     },
        // },
    });
});

document.addEventListener('DOMContentLoaded', () => {
    const overlay = document.querySelector('[data-quick-buy-overlay]');
    const triggers = document.querySelectorAll('.js-quick-buy');

    if (!overlay || !triggers.length) {
        return;
    }

    const quantityInput = overlay.querySelector('[data-quick-buy-input]');
    const subtitle = overlay.querySelector('[data-quick-buy-subtitle]');
    const priceLabel = overlay.querySelector('[data-quick-buy-price]');
    const shortcutsContainer = overlay.querySelector('[data-quick-buy-shortcuts]');
    const confirmBtn = overlay.querySelector('[data-quick-buy-confirm]');
    const decreaseBtn = overlay.querySelector('[data-quick-buy-decrease]');
    const increaseBtn = overlay.querySelector('[data-quick-buy-increase]');
    const closeButtons = overlay.querySelectorAll('[data-quick-buy-close]');

    if (!quantityInput || !subtitle || !priceLabel || !shortcutsContainer || !confirmBtn) {
        return;
    }

    let currentUrl = null;
    let minimumTickets = parseInt(quantityInput.getAttribute('min') || '1', 10) || 1;
    let maximumTickets = null;
    let ticketPrice = null;
    let returnFocusElement = null;

    const toNumber = (value, fallback = null) => {
        const numeric = Number(value);
        return Number.isFinite(numeric) ? numeric : fallback;
    };

    const setAriaVisibility = (isVisible) => {
        overlay.setAttribute('aria-hidden', isVisible ? 'false' : 'true');
        document.body.classList.toggle('quick-buy-open', isVisible);
    };

    const clampQuantity = (value, allowEmpty = false) => {
        if (typeof value === 'string') {
            value = value.replace(/[^\d]/g, '');
        }

        if (value === '' || value === undefined || value === null) {
            return allowEmpty ? '' : minimumTickets;
        }

        let numeric = parseInt(value, 10);

        if (Number.isNaN(numeric)) {
            numeric = minimumTickets;
        }

        if (numeric < minimumTickets) {
            numeric = minimumTickets;
        }

        if (maximumTickets !== null && numeric > maximumTickets) {
            numeric = maximumTickets;
        }

        return numeric;
    };

    const formatTotal = (quantity) => {
        if (ticketPrice === null) {
            return null;
        }

        const total = ticketPrice * quantity;

        if (!Number.isFinite(total)) {
            return null;
        }

        const formatter = new Intl.NumberFormat('es-VE', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
        });

        return `Total estimado: Bs ${formatter.format(total)}`;
    };

    const updatePriceLabel = () => {
        const quantity = parseInt(quantityInput.value, 10);
        const text = Number.isFinite(quantity) ? formatTotal(quantity) : null;

        if (text) {
            priceLabel.textContent = text;
            priceLabel.removeAttribute('hidden');
        } else {
            priceLabel.textContent = '';
            priceLabel.setAttribute('hidden', '');
        }
    };

    const syncShortcuts = () => {
        if (!shortcutsContainer.children.length) {
            return;
        }

        const quantity = parseInt(quantityInput.value, 10);

        Array.from(shortcutsContainer.children).forEach((button) => {
            const shortcutValue = parseInt(button.dataset.value, 10);

            if (!Number.isNaN(quantity) && shortcutValue === quantity) {
                button.classList.add('is-active');
            } else {
                button.classList.remove('is-active');
            }
        });
    };

    const renderShortcuts = () => {
        // Valores fijos para selección rápida de tickets: 1, 2, 5, 10, 25, 50
        const fixedValues = [1, 2, 5, 10, 25, 50];

        shortcutsContainer.innerHTML = '';

        fixedValues
            .filter((value) => value >= minimumTickets && (maximumTickets === null || value <= maximumTickets))
            .sort((a, b) => a - b)
            .forEach((value) => {
                const button = document.createElement('button');
                button.type = 'button';
                button.dataset.value = String(value);
                button.className = 'quick-buy-shortcut';
                button.textContent = String(value);
                button.addEventListener('click', () => {
                    quantityInput.value = String(value);
                    updatePriceLabel();
                    syncShortcuts();
                });
                shortcutsContainer.appendChild(button);
            });

        if (!shortcutsContainer.children.length) {
            shortcutsContainer.setAttribute('hidden', '');
        } else {
            shortcutsContainer.removeAttribute('hidden');
        }

        syncShortcuts();
    };

    const focusTrapHandler = (event) => {
        if (event.key !== 'Tab' || overlay.hasAttribute('hidden')) {
            return;
        }

        const focusableSelectors = 'button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])';
        const focusableElements = overlay.querySelectorAll(focusableSelectors);
        const focusables = Array.from(focusableElements).filter((element) => !element.hasAttribute('disabled'));

        if (!focusables.length) {
            return;
        }

        const first = focusables[0];
        const last = focusables[focusables.length - 1];

        if (event.shiftKey && document.activeElement === first) {
            event.preventDefault();
            last.focus();
        } else if (!event.shiftKey && document.activeElement === last) {
            event.preventDefault();
            first.focus();
        }
    };

    const closeOverlay = () => {
        if (overlay.hasAttribute('hidden')) {
            return;
        }

        overlay.classList.remove('is-visible');
        setAriaVisibility(false);

        window.setTimeout(() => {
            overlay.setAttribute('hidden', '');
            if (returnFocusElement) {
                returnFocusElement.focus();
            }
            returnFocusElement = null;
        }, 180);
    };

    const openOverlay = (trigger) => {
        returnFocusElement = trigger;
        currentUrl = trigger.dataset.purchaseUrl || trigger.getAttribute('href');

        if (!currentUrl) {
            return;
        }

        const rawMin = toNumber(trigger.dataset.min, minimumTickets);
        const rawMax = toNumber(trigger.dataset.max, null);
        const rawPrice = toNumber(trigger.dataset.price, null);

        minimumTickets = Math.max(rawMin || 1, 1);
        maximumTickets = rawMax !== null && rawMax > 0 ? rawMax : null;
        ticketPrice = rawPrice !== null && rawPrice >= 0 ? rawPrice : null;

        quantityInput.min = String(minimumTickets);
        quantityInput.value = String(minimumTickets);

        if (maximumTickets !== null) {
            quantityInput.max = String(maximumTickets);
        } else {
            quantityInput.removeAttribute('max');
        }

        const raffleName = trigger.dataset.raffleName || 'Compra de tickets';
        subtitle.textContent = `Rifa: ${raffleName}`;

        renderShortcuts();
        updatePriceLabel();

        overlay.classList.add('is-visible');
        overlay.removeAttribute('hidden');
        setAriaVisibility(true);
    };

    const adjustQuantity = (delta) => {
        const current = clampQuantity(quantityInput.value);
        const next = clampQuantity(Number(current) + Number(delta));
        quantityInput.value = String(next);
        updatePriceLabel();
        syncShortcuts();
    };

    triggers.forEach((trigger) => {
        trigger.addEventListener('click', (event) => {
            event.preventDefault();
            openOverlay(trigger);
        });
    });

    if (decreaseBtn) {
        decreaseBtn.addEventListener('click', () => adjustQuantity(-1));
    }

    if (increaseBtn) {
        increaseBtn.addEventListener('click', () => adjustQuantity(1));
    }

    quantityInput.addEventListener('input', () => {
        const { value } = quantityInput;
        const nextValue = clampQuantity(value, value === '');

        if (nextValue === '') {
            updatePriceLabel();
            syncShortcuts();
            return;
        }

        if (String(nextValue) !== value) {
            quantityInput.value = String(nextValue);
        }

        updatePriceLabel();
        syncShortcuts();
    });

    quantityInput.addEventListener('blur', () => {
        const nextValue = clampQuantity(quantityInput.value);
        quantityInput.value = String(nextValue);
        updatePriceLabel();
        syncShortcuts();
    });

    quantityInput.addEventListener('keydown', (event) => {
        if (event.key === 'Enter') {
            event.preventDefault();
            confirmBtn.click();
        }
    });

    confirmBtn.addEventListener('click', () => {
        if (!currentUrl) {
            return;
        }

        const quantity = clampQuantity(quantityInput.value);

        try {
            const url = new URL(currentUrl, window.location.origin);
            url.searchParams.set('q', quantity);
            window.location.href = url.toString();
        } catch (error) {
            const separator = currentUrl.includes('?') ? '&' : '?';
            window.location.href = `${currentUrl}${separator}q=${quantity}`;
        }
    });

    closeButtons.forEach((button) => {
        button.addEventListener('click', closeOverlay);
    });

    overlay.addEventListener('click', (event) => {
        if (event.target === overlay) {
            closeOverlay();
        }
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            closeOverlay();
        }
    });

    document.addEventListener('keydown', focusTrapHandler);
});
