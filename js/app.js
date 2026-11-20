/* Thème clair / sombre + service worker.
   Chargé dans <head> (sans defer) pour appliquer le thème avant l'affichage. */
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

  // Filtres de la page Enseignements (un seul filtre actif à la fois)
  function initFiltres() {
    const barre = document.querySelector(".filter-bar");
    if (!barre) return; // pas sur cette page
    const cartes = document.querySelectorAll(".modules [data-tags]");
    const boutons = barre.querySelectorAll("[data-filter]");
    const compteur = barre.querySelector(".filter-count");

    function appliquer(filtre) {
      let visibles = 0;
      cartes.forEach((carte) => {
        // data-tags = liste de mots séparés par des espaces, ex. "eisine lp-mn"
        const ok =
          filtre === "all" || carte.dataset.tags.split(" ").includes(filtre);
        carte.hidden = !ok; // la grille se réorganise toute seule
        if (ok) visibles++;
      });
      boutons.forEach((b) =>
        b.setAttribute("aria-pressed", String(b.dataset.filter === filtre)),
      );
      const mot = visibles > 1 ? "modules" : "module";
      compteur.textContent =
        filtre === "all"
          ? `${visibles} ${mot}`
          : `${visibles} ${mot} sur ${cartes.length}`;
    }

    barre.addEventListener("click", (e) => {
      const bouton = e.target.closest("[data-filter]");
      if (bouton) appliquer(bouton.dataset.filter);
    });
    barre.hidden = false; // la barre n'apparaît que si JavaScript fonctionne
    appliquer("all");
  }
  document.addEventListener("DOMContentLoaded", initFiltres);

  // Service worker (hors ligne)
  if ("serviceWorker" in navigator) {
    addEventListener("load", () => navigator.serviceWorker.register("/sw.js"));
  }
})();

// Reconstitution des liens mailto: (l'adresse n'est jamais en clair dans le HTML)
document.addEventListener("DOMContentLoaded", () => {
  document.querySelectorAll("a[data-mail]").forEach((lien) => {
    const { u, d } = lien.dataset;
    if (!u || !d) return;
    const adresse = `${u}@${d}`;
    lien.href = `mailto:${adresse}`;
    lien.textContent = adresse;
  });
});
