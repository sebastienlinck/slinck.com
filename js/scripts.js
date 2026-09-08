/* --- SCRIPT JS PRINCIPAL --- */

/* --- GESTION DES COOKIES --- */
function fcookie() {
  if (
    window.cookieAccepted === true ||
    (document.cookie && document.cookie.includes("__Secure-cookieDef"))
  ) {
    return;
  }

  const cookieEl = document.querySelector("#cookie");
  if (!cookieEl) return;

  setTimeout(() => {
    cookieEl.classList.add("show");
  }, 1000);

  const acceptBtn = document.querySelector("#cookie-button");
  if (acceptBtn) {
    acceptBtn.addEventListener("click", (e) => {
      e.preventDefault(); // Empêche le saut de page immédiat
      cookieEl.classList.remove("show");

      // Écriture du cookie (durée : 13 mois / conforme CNIL)
      const maxAge = 60 * 60 * 24 * 395;
      document.cookie = `__Secure-cookieDef=accepted; max-age=${maxAge}; path=/; SameSite=Lax; Secure`;
      window.cookieAccepted = true;

      const href =
        acceptBtn.getAttribute("href") || acceptBtn.dataset.acceptUrl;
      if (href && href !== "#") {
        window.location.href = href;
      }
    });
  }
}
window.addEventListener("load", fcookie);

/* --- GESTION DU DARK MODE --- */
document.addEventListener("DOMContentLoaded", () => {
  const btn = document.getElementById("theme-toggle");
  const html = document.documentElement;

  // Vérifier le thème préféré de l'utilisateur
  const savedTheme = localStorage.getItem("theme");
  if (savedTheme) {
    html.setAttribute("data-theme", savedTheme);
  } else if (window.matchMedia("(prefers-color-scheme: dark)").matches) {
    html.setAttribute("data-theme", "dark");
  }

  // Gestion du clic uniquement
  if (btn) {
    btn.addEventListener("click", () => {
      const currentTheme = html.getAttribute("data-theme");
      const newTheme = currentTheme === "dark" ? "light" : "dark";
      html.setAttribute("data-theme", newTheme);
      localStorage.setItem("theme", newTheme);
    });
  }
});

/* --- UTILITAIRES --- */
function convertNumberToWords(number) {
  const units = [
    "zéro",
    "un",
    "deux",
    "trois",
    "quatre",
    "cinq",
    "six",
    "sept",
    "huit",
    "neuf",
  ];
  return units[number];
}

/**
 * Affiche graphiquement le retour du serveur (Succès ou Erreur)
 */
function showStatusMessage(message, type, container) {
  if (!container) return;

  // Utilisation des variables de couleurs définies dans votre thème
  const bgColor = type === "success" ? "var(--deep-purple)" : "var(--magenta)";
  const textColor = type === "success" ? "var(--soft-purple)" : "var(--soft-pink)";

  container.innerHTML = `
    <div style="padding: 1rem; border-radius: var(--radius); margin-bottom: 1rem; 
                text-align: center; font-weight: bold; background: ${bgColor}; color: ${textColor};">
      ${message}
    </div>
  `;
}

/* --- GESTION DU CAPTCHA AVANCÉ --- */ function generateCaptcha() {
  const questionElement = document.getElementById("captcha-question");
  const refreshButton = document.getElementById("refresh-captcha");
  if (!questionElement || !refreshButton) return;

  let num1 = Math.floor(Math.random() * 10);
  let num2 = Math.floor(Math.random() * 10);
  const operators = ["plus", "moins", "fois"];
  const operator = operators[Math.floor(Math.random() * operators.length)];

  // UX : Éviter les résultats négatifs pour l'opérateur "moins"
  if (operator === "moins" && num1 < num2) {
    [num1, num2] = [num2, num1]; // On inverse les deux nombres
  }

  let solution;
  let questionText = `${convertNumberToWords(num1)} ${operator} ${convertNumberToWords(num2)}`;

  if (operator === "plus") solution = num1 + num2;
  else if (operator === "moins") solution = num1 - num2;
  else solution = num1 * num2;

  questionElement.textContent = questionText;
  questionElement.dataset.solution = solution;

  // On stocke aussi l'opération dans des champs cachés pour le PHP (Optionnel mais conseillé)
  let form = document.getElementById("contact-form");
  if (!document.getElementById("captcha_op")) {
    form.insertAdjacentHTML(
      "beforeend",
      `<input type="hidden" name="c_n1" value="${num1}"><input type="hidden" name="c_n2" value="${num2}"><input type="hidden" name="c_op" value="${operator}">`,
    );
  } else {
    document.getElementsByName("c_n1")[0].value = num1;
    document.getElementsByName("c_n2")[0].value = num2;
    document.getElementsByName("c_op")[0].value = operator;
  }
}

function checkCaptchaAndUpdateButton() {
  const captchaInput = document.getElementById("captcha");
  const captchaQuestion = document.querySelector("#captcha-question");
  const submitButton = document.getElementById("envoyer-contact");

  if (captchaInput && captchaQuestion && submitButton) {
    const userAnswer = parseInt(captchaInput.value);
    const correctAnswer = parseInt(captchaQuestion.dataset.solution);

    if (isNaN(userAnswer) || userAnswer !== correctAnswer) {
      submitButton.disabled = true;
      return false;
    } else {
      submitButton.disabled = false;
      return true;
    }
  }
  return false;
}

/* --- INITIALISATION FORMULAIRE --- */
document.addEventListener("DOMContentLoaded", () => {
  generateCaptcha();

  const contactForm = document.getElementById("contact-form");
  const submitButton = document.getElementById("envoyer-contact");

  if (contactForm && submitButton) {
    submitButton.disabled = true;

    const captchaInput = document.getElementById("captcha");
    if (captchaInput) {
      captchaInput.addEventListener("input", checkCaptchaAndUpdateButton);
    }

    contactForm.addEventListener("submit", async function (e) {
      e.preventDefault();

      if (checkCaptchaAndUpdateButton()) {
        const form = e.target;
        const formData = new FormData(form);

        // IMPORTANT : On ajoute manuellement 'envoyer' pour que le PHP le détecte
        formData.append("envoyer", "1");

        const statusMessageElement = document.getElementById("status-message");
        if (statusMessageElement) statusMessageElement.innerHTML = "";

        try {
          // On cible bien sendmail.php
          const response = await fetch("./pages/sendmail.php", {
            method: "POST",
            body: formData,
          });

          if (!response.ok) throw new Error("Erreur réseau");

          const result = await response.json();

          if (result.success) {
            showStatusMessage(result.message, "success", statusMessageElement);
            form.reset();
            generateCaptcha();
            submitButton.disabled = true;
          } else {
            showStatusMessage(result.message, "error", statusMessageElement);
          }
        } catch (error) {
          showStatusMessage(
            "Erreur technique lors de l'envoi du message.",
            "error",
            statusMessageElement,
          );
        }
      }
    });
  }
});
