# ce script est un script de compilation du code sass en css.
# Il est appelé par la commande "bash lib/script/sass-css.sh" effectuée dans un terminal, à la racine du projet.

#!/usr/bin/env bash

# On appelle la commande sass pour compiler le fichier sass en css en temps réel, de manière minifié et sans le source-map.
sass --watch src/scss/style.scss public/assets/css/style.css --style compressed --no-source-map
