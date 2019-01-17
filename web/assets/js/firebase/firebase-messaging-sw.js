if( 'function' === typeof importScripts) {
    importScripts('https://www.gstatic.com/firebasejs/5.2.2/firebase-app.js');
    importScripts('https://www.gstatic.com/firebasejs/5.2.2/firebase-messaging.js');
    addEventListener('message', onMessage);
 
    function onMessage(e) { 
      // do some work here 
    }    
 }
 var config = {
    apiKey: "AIzaSyDl-kC4sV26vmo_qUGmD4pyKVgqoDMsErk",
    authDomain: "toko-buah.firebaseapp.com",
    databaseURL: "https://toko-buah.firebaseio.com",
    projectId: "toko-buah",
    storageBucket: "toko-buah.appspot.com",
    messagingSenderId: "210352383323"
};
firebase.initializeApp(config);

// Retrieve an instance of Firebase Messaging so that it can handle background
// messages.
const messaging = firebase.messaging();

messaging.requestPermission().then(function () {
        console.log("Notification permission granted.");
        getToken();

   }).catch(function (err) {
        console.log("Unable to get permission to notify.", err);
 });

 messaging.onMessage(function(payload) {
    console.log('Message received. ', payload);
  });

  function getToken() {
    messaging.getToken().then(function(currentToken) {
        if (currentToken) {
          console.log(currentToken);
        } else {
          // Show permission request.
          console.log('No Instance ID token available. Request permission to generate one.');
        }
    }).catch(function(err) {
        console.log('An error occurred while retrieving token. ', err);
    });
  }