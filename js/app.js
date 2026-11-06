/* Thème clair / sombre + service worker.
   Chargé dans <head> (sans defer) 
   pour appliquer le thème avant l'affichage. */
(function () {
  const root = document.documentElement;
  const claire = matchMedia("(prefers-color-scheme: light)");

  // Choix mémorisé par le visiteur (ou null)
  const choix = () => {
    try {
      const t = localStorage.getItem("theme");
      return t === "light" || t === "dark" ? t : null;
    } catch (e) {
      return null;
    }
  };

  // Sombre par défaut ; clair seulement si le système le demande ou si le visiteur l'a choisi
  const appliquer = (t) => (root.dataset.theme = t);
  appliquer(choix() || (claire.matches ? "light" : "dark"));

  // Tant que le visiteur n'a rien choisi, on suit le système en direct
  claire.addEventListener("change", (e) => {
    if (!choix()) appliquer(e.matches ? "light" : "dark");
  });

  // Bouton de bascule
  document.addEventListener("DOMContentLoaded", () => {
    const bouton = document.getElementById("theme-toggle");
    if (!bouton) return;
    bouton.addEventListener("click", () => {
      const suivant = root.dataset.theme === "dark" ? "light" : "dark";
      appliquer(suivant);
      try {
        localStorage.setItem("theme", suivant);
      } catch (e) {}
    });
  });

  // Service worker (hors ligne)
  if ("serviceWorker" in navigator) {
    addEventListener("load", () => navigator.serviceWorker.register("/sw.js"));
  }
})();
