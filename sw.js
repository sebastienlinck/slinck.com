/* Service worker minimal : réseau d'abord, cache en secours (hors ligne).
   Changer VERSION force le renouvellement du cache. */
const VERSION = "slinck-v3";

self.addEventListener("install", () => self.skipWaiting());

self.addEventListener("activate", (event) => {
  event.waitUntil(
    caches
      .keys()
      .then((noms) => Promise.all(noms.filter((n) => n !== VERSION).map((n) => caches.delete(n))))
      .then(() => self.clients.claim()),
  );
});

self.addEventListener("fetch", (event) => {
  const req = event.request;
  const url = new URL(req.url);

  // Uniquement les GET du site ; on laisse passer le formulaire (POST) et les PDF (volumineux)
  if (req.method !== "GET" || url.origin !== location.origin || url.pathname.startsWith("/articles/")) return;

  event.respondWith(
    fetch(req)
      .then((reponse) => {
        if (reponse.ok) {
          const copie = reponse.clone();
          caches.open(VERSION).then((cache) => cache.put(req, copie));
        }
        return reponse;
      })
      .catch(() => caches.match(req)),
  );
});
