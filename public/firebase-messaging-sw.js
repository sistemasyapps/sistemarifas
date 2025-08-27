importScripts('https://www.gstatic.com/firebasejs/12.0.0/firebase-app-compat.js');
importScripts('https://www.gstatic.com/firebasejs/12.0.0/firebase-messaging-compat.js');

firebase.initializeApp({
  apiKey: "AIzaSyC88e6TkKcsFnY9ymS5i3RQR4aUlumSnfc",
  authDomain: "rifavinotinto.firebaseapp.com",
  projectId: "rifavinotinto",
  storageBucket: "rifavinotinto.firebasestorage.app",
  messagingSenderId: "665137785090",
  appId: "1:665137785090:web:6f8c1a2209e0952a3efa1b",
  measurementId: "G-FTPZJQHEXQ"
});

const messaging = firebase.messaging();

messaging.onBackgroundMessage((payload) => {
  console.log('[SW] Notificación recibida:', payload);
  
  const notificationTitle = payload.notification.title;
  console.log(payload)
  const notificationOptions = {
    body: payload.notification.body,
    icon: payload.notification.image || '/icon.png',
    data: { url: payload.data.link }
  };

  return self.registration.showNotification(notificationTitle, notificationOptions);
});

self.addEventListener('notificationclick', (event) => {
  event.notification.close();
  const url = event.notification.data?.url || 'https://rifasvinotinto.com';
  
  event.waitUntil(
    clients.matchAll({ type: 'window' }).then((clientList) => {

      for (const client of clientList) {
        if (client.url === targetUrl && 'focus' in client) {
          return client.focus();
        }
      }
      
      return clients.openWindow(targetUrl);
    })
  );
});