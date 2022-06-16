# Projet "Kiff ton Écharpe"

## Configuration utilisée

### Système d'exploitation utilisé

Ce projet a été créé sur la distribution Linux Ubuntu v22.04 LTS.

La configuration php utilisée est la version v8.1.2 avec xDebug v3.1.2.

### IDE utilisés pour le développement

Il a été édité à l'aide des IDE :

- Visual Studio Code Version v1.68.0 (64 bits)
- PhpStorm Version v2022.1.2 (64-bit).

#### Visual Studio Code (VSCode)

Les extensions VSCode utilisées sont :

- accessibility-snippets.accessibility-snippets,
- DavidAnson.vscode-markdownlint,
- EditorConfig.EditorConfig,
- esbenp.prettier-vscode,
- firefox-devtools.vscode-firefox-debug,
- formulahendry.auto-rename-tag,
- GitHub.codespaces,
- GitHub.copilot,
- GitHub.remotehub,
- GitHub.vscode-pull-request-github,
- mrmlnc.vscode-autoprefixer,
- ms-vscode.js-debug-nightly,
- naumovs.color-highlight,
- pranaygp.vscode-css-peek,
- shd101wyy.markdown-preview-enhanced,
- VisualStudioExptTeam.vscodeintellicode,
- xabikos.JavaScriptSnippets,
- xdebug.php-debug,
- xdebug.php-pack,
- zobo.php-intellisense.

#### PhpStorm

Les extensions PhpStorm utilisées sont :

- gitHub Copilot,
- prettier,
- php-annotators,
- indent-rainbow,
- rainbow-brackets.

### Réglage du serveur en local :

Ce projet utilise en local un serveur apache :

- Server version: Apache/2.4.52 (Ubuntu)
- Server built: 2022-03-25T00:35:40.
  Les modules chargés pour ce projet sont les suivants :
- php_module,
- rewrite_module.

Un fichier de configuration a donc été créé pour le serveur. C'est le suivant :

```
## 3waProject.conf
<VirtualHost 127.0.0.2:80>
    ServerName 3waProject
    DocumentRoot [dossier racine du projet]"
    <Directory [dossier racine du projet]">
    Require all granted
    Options Indexes FollowSymLinks Includes
    AllowOverride All
    Order allow,deny
    Allow from all
</Directory>
    ErrorLog /var/log/apache2/error.3waProject.log
    CustomLog /var/log/apache2/access.3waProject.log combined
</VirtualHost>
```

## Objectifs du projet

Dans le cadre de la formation de développeur web effectuée auprès de la 3W Academy, j'ai souhaité créé un site internet
de présentation de mon auto-entreprise.
Pour la présentation de ce projet, je souhaite montrer les prestations que je propose, ainsi que les tarifs.
Je souhaite également mettre en place un formulaire de contact, ainsi qu'n espace administrateur qui me permettra de
modifier l'ensemble des données du site directement depuis le site internet et non depuis un système de gestion de base
de données.
L'objectif de la présentation du projet est de montrer que je suis en capacité de maîtriser les langages natifs du web,
comme le HTML/CSS, Javascript, php, sql, et que je suis en capacité d'utiliser des outils tels que SASS, NodeJS ou
Composer.

### Origine de l'auto-entreprise "Kiff ton Écharpe"

À l'origine, j'ai créé cette auto-entreprise en qualité de moniteur de portage. Je proposais donc des prestations de
formation pour les parents et futurs parents afin de leur permettre de porter leur nourisson en écharpe ou en
porte-bébé, de manière sécuritaire et la plus adaptée possible à leur situation mais aussi à celle de leur enfant.
Au fil des ans, on m'a proposé d'être formateur en travail social, principalement sur les sujets de protection de
l'enfance et des violences conjugales et intrafamiliales. J'ai donc utilisé cette auto-entreprise pour effectuer ces
prestations.
Aujourd'hui, je souhaite proposer de la maintenance informatique software, mais également du développement de site
internet ou d'application web. Je vais donc utilisé cette même structure pour proposer ces prestations en plus.

## Projets pour le site

À terme, je souhaite que les personnes puissent effectuer leur commande directement sur ce site. Ils ou elles feront
leur demande de prestation, et je génèrerai un devis une fois la demande effectuée. Il y aura donc un espace utilisateur
distinct de l'espace administrateur.

### Améliorations envisagées

- Implémenter un système d'utilisateurs avec un rôle différent pour les utilisateurs et les administrateurs.
- Permettre des actions différenciées qu'on soit utilisateur ou administrateur.
- Rendre la SPA dynamique en implémentant un routeur en ajax combiné à celui en php.
- Utilisation probable des framworks Synfony (php) et VueJS ou React (js)

#### A  plus long terme :

- Passer d'un back-end PHP à un back-end TypeScript
- Mise en place d'un serveur distant avec nom de domaine.