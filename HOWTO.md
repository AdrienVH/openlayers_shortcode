#OPENLAYERS SHORTCODE - HOW TO

##1. Fond de carte

- `[openlayers tiles="osm"]` : Fond de carte OpenStreetMpa (OSM)
- `[openlayers tiles="mapquest"]` : Fond de carte OSM selon MapQuest
- `[openlayers tiles="mapquest_aerial"]` : Photo aérienne selon MapQuest

##2.1 Source de donnée : mode "this"

- `[openlayers mode="this"]` : Utilisation des données présentes dans l'article ou la page où le shortcode a été inséré.

###2.1.1 D'après des coordonnées (ponctuel uniq.)

- `[openlayers mode="this" lat="..." lng="..."]`

###2.1.2 D'après des coordonnées (ponctuel uniq.) contenues dans des champs personnalisés

- `[openlayers mode="this" champ_lat="..." champ_long="..."]`

###2.1.3 D'après la géométrie WKT

- `[openlayers mode="this" wkt="..."]`

###2.1.4 D'après la géométrie WKT contenues dans un champ personnalisé

- `[openlayers mode="this" champ_wkt="..."]`

###2.1.5 D'après l'URL d'un fichier distant

- `[openlayers mode="this" url="..."]`

###2.1.6 D'après l'URL d'un fichier distant contenue dans un champ personnalisé

- `[openlayers mode="this" champ_url="..."]`

##2.2 Source de donnée : modes "posts", "pages" ou "all"

Avec ces trois modes, vous pouvez construire une carte avec les données contenues dans des champs personnalisés des articles et/ou des pages de votre WordPress.

- `[openlayers mode="posts"]` : Parcours de tous les articles de votre Wordpress
- `[openlayers mode="pages"]` : Parcours de toutes les pages de votre Wordpress
- `[openlayers mode="all"]` : Parcours de tous les articles et toutes les pages de votre Wordpress

###2.2.1 D'après des coordonnées (ponctuel uniq.) contenues dans des champs personnalisés

Deux attributs doivent être renseignés :

- `[openlayers mode="..." champ_lat="..." champ_long="..."]`

Vous devez y indiquer les noms formalisés (slug) des deux champs personnalisés qui contiennent les latitude et longitude des figurés ponctuels à représenter.

###2.2.2 D'après des géométries WKT contenues dans un champ personnalisé

- `[openlayers mode="..." champ_wkt="..."]`

##3. Reprojection des données à la volée

Vous pouvez demander à OpenLayers de reprojeter vos données en indiquant dans quelle projection elles sont notées initialement (via le code ESPG de cette projection) :

- `[openlayers epsg="..."]`

Vos données seront alors reprojetées à la volée dans la projection "Google Mercator" (ESPG:3857, anciennement 3875 et 900913). Pour plus d'informations sur la notation ESPG, consultez le site [spatialreference.org/](http://www.spatialreference.org/).

##4. Centrage et zoom de la carte

Vous pouvez centrer la carte manuellement en indiquant des coordonnées et un niveau de zoom :

- `[openlayers center_lat="..." center_long="..."]` : Coordonnées sur lesquelles la carte doit se centrer (WGS 84 uniq.)
- `[openlayers zoom="..."]` : Niveau de zoom que la carte doit adopté à son affichage

Si vous n'indiquez pas ces attributs ou s'ils sont mal renseignés, la carte sera centrée et zoomée sur les figurés qui la composent.