//importScripts('/cache-polyfill.js');


self.addEventListener('install', function(e) {
 e.waitUntil(
   caches.open('airhorner').then(function(cache) {
     return cache.addAll([
       '/',
       'index.php',
       'index.php?homescreen=1',
       '?homescreen=1',
       '/assets/style.css',
       '/css/custom.css',
       '/assets/images/perpus.jpg'
     ]);
   })
 );
});