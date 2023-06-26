if('serviceWorker' in navigator){
    navigator.serviceWorker.register('/service-worker.js').then(regestration => {
        console.log('service worker regestration succeed:', regestration);
    }).catch(err => {
        console.log('service worker regestration failed', err);
    });
}

let deferredPrompt;
 const btnAdd = document.querySelector('.add-button');
 
window.addEventListener('beforeinstallprompt', (e) => {
    e.preventDefault;
   
    window.addEventListener('appinstalled', (evt) =>{
      app.logEvent('a2hs','installed');
    });
  });

  

