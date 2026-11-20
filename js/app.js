/* Thème clair / sombre, filtres, liens mailto et service worker.
   Chargé dans <head> (sans defer) pour appliquer le thème avant l'affichage. */
(function () {
  const root = document.documentElement;
  const claire = matchMedia("(prefers-color-scheme: light)");

  // --- 1. Gestion du thème (exécuté immédiatement pour éviter tout flash blanc) ---
  const choix = () => {
    try {
      const t = localStorage.getItem("theme");
      return t === "light" || t === "dark" ? t : null;
    } catch {
      return null;
    }
  };

  const appliquerTheme = (t) => (root.dataset.theme = t);
  appliquerTheme(choix() || (claire.matches ? "light" : "dark"));

  claire.addEventListener("change", (e) => {
    if (!choix()) appliquerTheme(e.matches ? "light" : "dark");
  });

  // --- 2. Initialisation des interactions une fois le DOM prêt ---
  document.addEventListener("DOMContentLoaded", () => {
    // Bouton de bascule de thème
    document.getElementById("theme-toggle")?.addEventListener("click", () => {
      const suivant = root.dataset.theme === "dark" ? "light" : "dark";
      appliquerTheme(suivant);
      try {
        localStorage.setItem("theme", suivant);
      } catch {}
    });

    // Reconstitution des liens mailto: (adresse absente du HTML source)
    document.querySelectorAll("a[data-mail]").forEach((lien) => {
      const { u, d } = lien.dataset;
      if (!u || !d) return;
      const adresse = `${u}@${d}`;
      lien.href = `mailto:${adresse}`;
      lien.textContent = adresse;
      lien.setAttribute("aria-label", `Envoyer un courriel à ${adresse}`);
    });

    // Filtres de la page Enseignements
    const barre = document.querySelector(".filter-bar");
    if (barre) {
      const cartes = document.querySelectorAll(".modules [data-tags]");
      const boutons = barre.querySelectorAll("[data-filter]");
      const compteur = barre.querySelector(".filter-count");

      const filtrer = (filtre) => {
        let visibles = 0;
        cartes.forEach((carte) => {
          const ok =
            filtre === "all" || carte.dataset.tags.split(" ").includes(filtre);
          carte.hidden = !ok;
          if (ok) visibles++;
        });
        boutons.forEach((b) =>
          b.setAttribute("aria-pressed", String(b.dataset.filter === filtre)),
        );
        if (compteur) {
          compteur.textContent =
            filtre === "all"
              ? `${visibles} cours`
              : `${visibles} cours sur ${cartes.length}`;
        }
      };

      barre.addEventListener("click", (e) => {
        const cible = e.target.closest("[data-filter]");
        if (cible) filtrer(cible.dataset.filter);
      });

      barre.hidden = false;
      filtrer("all");
    }
  });

  // --- 3. Service worker (mode hors ligne) ---
  if ("serviceWorker" in navigator) {
    window.addEventListener("load", () =>
      navigator.serviceWorker.register("/sw.js"),
    );
  }
})();
