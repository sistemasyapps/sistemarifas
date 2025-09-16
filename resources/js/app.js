import './bootstrap';
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

if (typeof window !== 'undefined') {
    const isAdminRoute = window.location.pathname.startsWith('/admin');

    if (! isAdminRoute && 'Notification' in window) {
        import('firebase/app').then(({ initializeApp }) => {
            import('firebase/messaging').then(({ getMessaging, getToken, onMessage }) => {
                const firebaseConfig = {
                    apiKey: 'AIzaSyC88e6TkKcsFnY9ymS5i3RQR4aUlumSnfc',
                    authDomain: 'rifavinotinto.firebaseapp.com',
                    projectId: 'rifavinotinto',
                    storageBucket: 'rifavinotinto.firebasestorage.app',
                    messagingSenderId: '665137785090',
                    appId: '1:665137785090:web:6f8c1a2209e0952a3efa1b',
                    measurementId: 'G-FTPZJQHEXQ',
                };

                const firebaseApp = initializeApp(firebaseConfig);
                const messaging = getMessaging(firebaseApp);

                async function initPush() {
                    try {
                        await Notification.requestPermission();

                        if (Notification.permission === 'granted') {
                            const token = await getToken(messaging, {
                                vapidKey: 'BLRXgajKu-xoq9dhiwsfj43w1tO0iexWbZVFd2tZs_9j91ZyXsBHjR1KOUNagujUOc17eA4jrBt0OAM6XtJHy2w',
                            });

                            subscribeToTopic(token);
                        }

                        if (Notification.permission === 'denied') {
                            alert('Por favor habilita notificaciones manualmente en ajustes del navegador');
                        }
                    } catch (error) {
                        console.error('Error en notificaciones:', error);
                    }
                }

                function subscribeToTopic(token) {
                    return fetch(`https://rifasvinotinto.com/api/toTopic/${token}`, {
                        method: 'POST',
                    }).then(response => {
                        if (! response.ok) {
                            throw new Error('Suscripción fallida');
                        }
                    });
                }

                initPush();

                onMessage(messaging, payload => {
                    new Notification(payload.notification.title, {
                        body: payload.notification.body,
                        icon: payload.notification.icon,
                        data: { url: payload.data.url },
                    });
                });
            });
        });
    }
}
