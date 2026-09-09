// Bump cache name to force renewal when SW changes
const CACHE = "pwabuilder-offline-v2";

// On essaie de charger Workbox
importScripts(
  "https://storage.googleapis.com/workbox-cdn/releases/5.1.2/workbox-sw.js",
);

self.addEventListener("message", (event) => {
  if (event.data && event.data.type === "SKIP_WAITING") {
    self.skipWaiting();
  }
});

// On vérifie que Workbox est bien chargé avant de l'utiliser
if (workbox) {
  workbox.routing.registerRoute(
    new RegExp("/*"),
    new workbox.strategies.StaleWhileRevalidate({
      cacheName: CACHE,
    }),
  );
} else {
  console.log("Workbox n'a pas pu être chargé.");
}
