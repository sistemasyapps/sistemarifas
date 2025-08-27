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

import { initializeApp } from "firebase/app";
import { getMessaging, getToken, onMessage} from "firebase/messaging";

const firebaseConfig = {
  apiKey: "AIzaSyC88e6TkKcsFnY9ymS5i3RQR4aUlumSnfc",
  authDomain: "rifavinotinto.firebaseapp.com",
  projectId: "rifavinotinto",
  storageBucket: "rifavinotinto.firebasestorage.app",
  messagingSenderId: "665137785090",
  appId: "1:665137785090:web:6f8c1a2209e0952a3efa1b",
  measurementId: "G-FTPZJQHEXQ"
};

const app = initializeApp(firebaseConfig);
const messaging = getMessaging(app);

async function initPush() {
    try {
        await Notification.requestPermission();
        if (Notification.permission === 'granted') {
            const token = await getToken(messaging, { 
                vapidKey: "BLRXgajKu-xoq9dhiwsfj43w1tO0iexWbZVFd2tZs_9j91ZyXsBHjR1KOUNagujUOc17eA4jrBt0OAM6XtJHy2w" 
            });
            console.log("token:: ",token);

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
    console.log('subscribing...')
    return fetch(`https://rifasvinotinto.com/api/toTopic/${token}`, {
        method: 'POST',
    })
    .then(response => {
        if (!response.ok) throw new Error('Suscripción fallida');
        console.log(`Suscrito`);
    });
}

initPush();

// Escuchar notificaciones en primer plano
onMessage(messaging, (payload) => {
    console.log('Notificación:', payload);
    new Notification(payload.notification.title, {
        body: payload.notification.body,
        icon: payload.notification.icon,
        data: { url: payload.data.url }
    });
});