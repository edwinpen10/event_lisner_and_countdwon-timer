       // Your web app's Firebase configuration
  var firebaseConfig = {
    apiKey: "AIzaSyCcwExrXpb4DTRalJBkbepLqpDzsmvqRP0",
    authDomain: "my-laravelxfirebase.firebaseapp.com",
    databaseURL: "https://my-laravelxfirebase.firebaseio.com",
    projectId: "my-laravelxfirebase",
    storageBucket: "my-laravelxfirebase.appspot.com",
    messagingSenderId: "573000129838",
    appId: "1:573000129838:web:5827b20d8cb18037df6ebf"
  };
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);

    
      const messaging = firebase.messaging();    
    
        messaging
        .requestPermission()
        .then(function(){
            
            console.log("permisson generated")

            return messaging.getToken()
    
        }).then(function(token){
    
            console.log(token)
        
        }).catch(function(err){
        
            console.log(err)
        
        })
    
        messaging.onMessage((payload) => {
            console.log(payload)
        })