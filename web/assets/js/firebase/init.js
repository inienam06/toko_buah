$(document).ready(function(){
    var config = {
        apiKey: "AIzaSyDl-kC4sV26vmo_qUGmD4pyKVgqoDMsErk",
        authDomain: "toko-buah.firebaseapp.com",
        databaseURL: "https://toko-buah.firebaseio.com",
        projectId: "toko-buah",
        storageBucket: "toko-buah.appspot.com",
        messagingSenderId: "210352383323"
    };
    firebase.initializeApp(config);

    const messaging = firebase.messaging();

    messaging.requestPermission().then(function () {
        console.log("Notification permission granted. "+messaging.getToken());
        //getToken();

    }).catch(function (err) {
        console.log("Unable to get permission to notify.", err);
    });

    messaging.onMessage(function(payload) {
        console.log('Message received. ', payload);
    });
});