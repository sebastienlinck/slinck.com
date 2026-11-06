<div class="bento-grid">
  <article class="card span-3 card-c1">
    <h3>Recherche Post-Doctorale (CReSTIC)</h3>
    <h4>De l'optimisation réseau aux EIAH</h4>

    <div class="split-content">
      <div>
        <p>
          Après ma thèse, j'ai rejoint le <strong>CReSTIC</strong> (Centre de Recherche en STIC) pour travailler
          sur les <strong>EIAH</strong> (Environnements Informatiques pour l'Apprentissage Humain).
        </p>
        <p>
          Mes activités se sont orientées vers la modélisation 3D et les réseaux de capteurs sans fil,
          mais surtout vers une problématique pédagogique rencontrée en enseignement : comment rendre
          l'algorithmique accessible à un public parfois réfractaire à l'abstraction pure ?
        </p>
      </div>
      <div>
        <p>
          <strong>Le constat :</strong> Demander à des étudiants "digital natives" d'apprendre la programmation
          avec "une feuille et un stylo" est souvent perçu comme décalé et frustrant.
        </p>
        <p>
          Redonner une place au numérique dans cet apprentissage est vécu comme <strong>apaisant et rassurant</strong>,
          augmentant considérablement leur intérêt et leur concentration.
        </p>
      </div>
    </div>
  </article>

  <article class="card span-2 card-c2">
    <h3>Le Projet AlgoPath</h3>
    <p>
      Pour répondre au besoin de réalisme, j'ai participé à la création du prototype <strong>"AlgoPath"</strong>
      avec Estelle Perrin (MCF HDR). Contrairement aux logiciels existants (Algoris, LARP) qui restent schématiques,
      nous avons opté pour une immersion totale.
    </p>
    <p>
      AlgoPath est un <strong>monde virtuel en 3D</strong> comparable aux jeux vidéo :
    </p>
    <ul>
      <li>Les concepts (variables, boucles) sont des <strong>figurines 3D</strong>.</li>
      <li>La logique du programme est représentée par des <strong>chemins à emprunter</strong>.</li>
    </ul>

  </article>

  <article class="card card-c3">
    <h3>Serious Game</h3>
    <p>
      Tout être humain peut apprendre en s'amusant. Les études montrent que pour les étudiants actuels,
      le <strong>réalisme</strong> est le facteur clé d'engagement.
    </p>
    <p>
      En plongeant l'étudiant dans un univers graphique familier, on lève les blocages liés à la
      logique scientifique pure.
    </p>
  </article>
  <article class="card span-3 card-c1">
    <h3>Doctorat (2004-2008)</h3>
    <h4>
      Optimisation et adaptation des communications dans un réseau hétérogène
    </h4>

    <div class="split-content">
      <div>
        <p>
          Ma thèse, menée au sein du
          <strong>Laboratoire d'Informatique de l'Université de Franche-Comté
            (LIFC)</strong>, s'est étalée sur une période de quatre années. Sous la direction de
          François Spies et Eugen Dedu, j'ai exploré les communications dans les
          réseaux hétérogènes, bénéficiant du soutien financier de la CAPM et de
          l'Université.
        </p>
        <p>
          Mon objectif principal était de répondre à un défi majeur :
          l'optimisation des communications pour la
          <strong>diffusion vidéo (streaming)</strong>. Face à l'absence de
          méthodes de transport adaptées, j'ai exploré différentes stratégies,
          en me concentrant sur les aspects matériel et applicatif des
          transmissions.
        </p>
      </div>
      <div>
        <p>
          Au cœur de ma démarche résidait la nécessité de considérer les
          spécificités des réseaux traversés (filaire et radio). Conscients des
          limites des protocoles existants (UDP, TCP), nous avons développé des
          stratégies de
          <strong>congestion prioritaire</strong> au niveau des équipements
          actifs.
        </p>
        <p>
          L'innovation majeure résidait dans l'adaptation dynamique aux
          conditions changeantes du réseau, nécessitant une synchronisation
          étroite avec les <strong>algorithmes de codage vidéo</strong> pour
          maintenir la qualité tout en retardant les interruptions.
        </p>
      </div>
    </div>
  </article>
  <div class="span-3 cols-2">
    <article class="card card-c2">
      <h3>Contrôle de congestion (DDRED)</h3>
      <p>
        Dans une phase initiale, notre attention s'est portée sur l'amélioration
        du contrôle de la congestion au sein d'une architecture filaire,
        principalement au niveau des files d'attente des routeurs.
      </p>
      <p>
        Nous avons conçu une extension prenant en compte l'historique et
        l'ancienneté d'un flux. Une métrique clé était la distance parcourue par
        un paquet (nombre de routeurs traversés).
      </p>
      <p>
        Intégrée à la politique RED, cette stratégie baptisée
        <strong>DDRED (Distant-Dependent RED)</strong>
        favorisait les paquets ayant parcouru une plus grande distance. Au lieu
        de traiter tous les paquets uniformément, notre politique rejetait ou
        marquait (ECN) prioritairement ceux proches de leur source, optimisant
        ainsi l'utilisation des ressources réseau globales.
      </p>
    </article>

    <article class="card row-2 card-c3">
      <h3>Plate-forme de diffusion</h3>
      <p>
        Nous avons conçu un système de diffusion vidéo modulaire (horizontalement
        et verticalement) utilisant le protocole
        <strong>DCCP (Datagram Congestion Control Protocol)</strong>.
      <ul>
        <li>
          <strong>Modularité horizontale : </strong>Incorporation d'éléments intermédiaires dans la chaîne de diffusion,
          tels que le mixeur. Ce composant offrait la possibilité de ré-encoder la vidéo ou de l'adapter en fonction de
          certaines contraintes spécifiques, garantissant ainsi une flexibilité accrue dans le processus de diffusion.
        </li>
        <li>
          <strong>Modularité verticale : </strong>Intégration d'un choix possible dans le protocole de transport utilisé
          sous
          RTP (Real-time Transport Protocol). Cette approche permettait d'explorer différentes options de protocoles de
          transport, offrant ainsi une adaptabilité supplémentaire en fonction des besoins spécifiques de la diffusion
          vidéo.
        </li>
      </ul>
      </p>
      <p>
        Grâce à DCCP, nous avons établi une communication étroite entre les
        couches transport et application. La couche transport déterminait la bande
        passante disponible, et l'encodeur vidéo (mixeur) décidait en temps réel
        s'il fallait procéder à un ré-encodage.
      </p>
      <p>
        Cette approche "Cross-layer" a permis à l'application de réagir de manière
        adaptative aux fluctuations pour garantir une expérience utilisateur
        optimale.
      </p>
    </article>

    <article class="card card-c2">
      <h3>Connexion Sans-fil &amp; RTT</h3>
      <p>
        Avec l'émergence du Wi-Fi, il devenait crucial d'adapter les protocoles
        de transport. Les protocoles basés sur le
        <strong>RTT (Round-Trip Time)</strong> interprètent souvent mal les
        délais dans les réseaux sans fil.
      </p>
      <p>
        Nous avons identifié qu'une augmentation du temps de transmission est
        souvent due à des retransmissions induites par la couche MAC
        (interférences) et non à une congestion réelle.
      </p>
      <p>
        Nous avons proposé une <strong>correction du RTT</strong> en excluant le
        temps perdu attribuable aux retransmissions de la norme 802.11,
        garantissant que le contrôle de congestion ne se déclenche pas à tort
        sur de simples interférences.
      </p>
    </article>
  </div>



  <article class="card span-3 card-c1">
    <h3>Simulation et Validation (NS-2)</h3>
    <p>
      Les progrès réalisés ont été étayés par l'utilisation intensive du
      simulateur <strong>Network Simulator v2 (NS-2)</strong>. Il a joué un rôle
      crucial dans le développement et la validation de nos algorithmes.
    </p>
    <p>
      NS-2 nous a permis de modéliser des topologies hétérogènes complexes et
      d'évaluer nos théories dans des conditions contrôlées et répétables avant
      toute mise en œuvre réelle, garantissant la robustesse de nos
      propositions.
    </p>
  </article>


</div>