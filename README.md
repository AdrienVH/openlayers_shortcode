#OPENLAYERS SHORTCODE - READ ME

"OpenLayers Shortcode" est un plugin WordPress permettant d'intégrer une ou plusieurs cartes interactives à vos pages et articles Wordpress. Ce plugin s'appuie grandement sur la librairie javascript (JS) OpenLayers. Il utilise aussi la librairie javascript Wax, développée par Mapbox.

Le shortcode à utiliser est : `[openlayers attribut="valeur" attribut="valeur"]`

**Attention : Ce plugin WordPress n'est pas officiel : il ne dépend pas du projet OpenLayers.**

##Langages utilisés

Le gros du plugin est écrit en PHP. Ce code PHP sert principalement à "pondre" du code JS selon les attributs renseignés dans le shortcode. Quelques lignes CSS sont aussi utiles afin de régler quelques soucis de compatibilité avec les feuilles CSS inhérentes à Wordpress.

##Librairies emportées

Le plugin embarque deux librairies javascript :

- OpenLayers 2.12 - http://openlayers.org/
- Wax 6.4.0 - http://mapbox.com/wax/

##Évolutions futures

- Personnalisation de l’icône d'un marker, en indiquant l’URL d'une image par exemple
- Prise en charge de fichiers distants (GeoJSON, GML, etc.), en indiquant l’URL d'un fichier
- Possibilité de charger des données dans d’autres projections que le 900913, en indiquant un code EPSG
- Amélioration des feuilles et propriétés CSS
- Refonte du chargement des feuilles et propriétés CSS
- Intégration d’autres fonds de carte

##Contact

Auteur : Adrien VAN HAMME - contact@adrienvh.fr