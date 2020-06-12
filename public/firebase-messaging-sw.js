importScripts('https://www.gstatic.com/firebasejs/7.15.1/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/7.15.1/firebase-messaging.js');

// Initialize the Firebase app in the service worker by passing in the
// messagingSenderId.
firebase.initializeApp({
   'messagingSenderId': '573000129838',
   'apiKey': 'AIzaSyCcwExrXpb4DTRalJBkbepLqpDzsmvqRP0',
   'projectId': 'my-laravelxfirebase', 
   'appId': '1:573000129838:web:5827b20d8cb18037df6ebf',
});

// Retrieve an instance of Firebase Messaging so that it can handle background
// messages.
const messaging = firebase.messaging();

messaging.setBackgroundMessageHandler(function(payload) {
  console.log('[firebase-messaging-sw.js] Received background message ', payload);
  // Customize notification here
  const notificationTitle = 'Background Message Title';
  const notificationOptions = {
    body: 'Background Message body.',
    icon: '/itwonders-web-logo.png'
  };

  return self.registration.showNotification(notificationTitle,
      notificationOptions);
});