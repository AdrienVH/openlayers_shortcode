#OPENLAYERS SHORTCODE - READ ME

Ce plugin Wordpress met à votre disposition un nouveau shortcode qui vous permet d'intégrer une ou plusieurs cartes OpenLayers à vos pages et articles Wordpress. Ces cartes s'appuient sur plusieurs fonds de carte (OpenStreetMap, OpenCycleMap, OpenPisteMap, MapQuest, Stamen, MapBox, Bing Maps, Google Maps). Sur ces cartes, vous pouvez faire apparaitre un ou plusieurs objets géographiques (points, lignes ou polygones). Pour fonctionner, le plugin embarque les librairies Openlayers (2.12), Wax (6.4.0) et apelle Google Maps (3.x).

Le shortcode à utiliser est : `[openlayers attribut="valeur"]`

**Attention : Ce plugin WordPress n'est pas officiel : il ne dépend pas du projet OpenLayers.**

##Langages utilisés

Le majeure partie du plugin est écrite en PHP. Ce code PHP sert principalement à "pondre" du code JS d'après les attributs renseignés dans le shortcode. Quelques lignes de CSS sont aussi utiles afin de régler quelques soucis de compatibilité avec les feuilles CSS propres à Wordpress et ses thèmes.

##Librairies embarquées

Le plugin embarque deux librairies javascript externes au projet:

- OpenLayers en version 2.12 - [openlayers.org](http://openlayers.org/)
- Wax en version 6.4.0 - [mapbox.com/wax](http://mapbox.com/wax/)

Elle faut aussi appel à une autre librairie :

- Google Maps en version 3.x - [developers.google.com/maps/documentation/javascript/](https://developers.google.com/maps/documentation/javascript/)

##Évolutions futures

- Personnalisation de l'icône d'un marker, en indiquant l'URL d'une image par exemple
- Possibilité de charger un fichier CSV contenant des coordonnées (ou une colonne WKT) (en cours de finalisation)
- Refonte du chargement des feuilles CSS (une seule fois, dans le footer)
- Possibilité d'avoir un titre et un sous-titre en haut à droite des cartes (en cours)
- Intégration d'autres fonds de carte (WMS avec tiles_url et tiles_proj, etc.)
- Ajout d'un bouton dans l'éditeur de texte (en cours, déjà présent en mode "visuel")
...

##Contact

Adrien VAN HAMME - contact@adrienvh.fr - site web : [adrienvh.fr](http://adrienvh.fr/) - blog : [blog.adrienvh.fr/categorie/cartographie](http://blog.adrienvh.fr/categorie/cartographie)