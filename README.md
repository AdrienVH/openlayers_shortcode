#OPENLAYERS SHORTCODE - READ ME

"OpenLayers Shortcode" est un plugin WordPress permettant d'intégrer une ou plusieurs cartes interactives à vos pages et articles Wordpress. Ce plugin s'appuie grandement sur la librairie javascript (JS) OpenLayers. Il utilise aussi la librairie javascript Wax, développée par Mapbox.

Le shortcode à utiliser est : `[openlayers attribut="valeur"]`

**Attention : Ce plugin WordPress n'est pas officiel : il ne dépend pas du projet OpenLayers.**

##Langages utilisés

Le majeure partie du plugin est écrite en PHP. Ce code PHP sert principalement à "pondre" du code JS d'après les attributs renseignés dans le shortcode. Quelques lignes de CSS sont aussi utiles afin de régler quelques soucis de compatibilité avec les feuilles CSS propres à Wordpress et ses thèmes.

##Librairies embarquées

Le plugin embarque deux librairies javascript externes au projet:

- OpenLayers en version 2.12 - [openlayers.org](http://openlayers.org/)
- Wax en version 6.4.0 - [mapbox.com/wax](http://mapbox.com/wax/)

##Évolutions futures

- Personnalisation de l’icône d'un marker, en indiquant l’URL d'une image par exemple
- Possibilité de charger des données dans d’autres projections que le 900913, en indiquant un code EPSG
- Amélioration des feuilles et propriétés CSS
- Refonte du chargement des feuilles et propriétés CSS
- Intégration d’autres fonds de carte (sans fin)

##Contact

Adrien VAN HAMME - contact@adrienvh.fr - site web : [adrienvh.fr](http://adrienvh.fr/) - blog : [blog.adrienvh.fr](http://blog.adrienvh.fr/)