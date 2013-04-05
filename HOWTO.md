#OpenLayers Shortcode - HOW TO

##1. Fond de carte

- `[openlayers tiles="osm"]` : Fond de carte OpenStreetMpa (OSM)
- `[openlayers tiles="mapquest"]` : Fond de carte OSM selon MapQuest
- `[openlayers tiles="mapquest_aerial"]` : Photo aérienne selon MapQuest

##2.1 Mode d'affichage "this"

- `[openlayers mode="this"]`

###2.1.1 D'après des coordonnées (ponctuel uniq.)

- `[openlayers mode="this" lat="..." lng="..."]`

###2.1.2 D'après des coordonnées (ponctuel uniq.) contenues dans un champ

- `[openlayers mode="this" champ_lat="..." champ_long="..."]`

###2.1.3 D'après la géométrie WKT

- `[openlayers mode="this" wkt="..."]`

###2.1.4 D'après la géométrie WKT contenues dans un champ

- `[openlayers mode="this" champ_wkt="..."]`

###2.1.5 D'après l'URL d'un fichier distant

- `[openlayers mode="this" url="..."]`

###2.1.6 D'après l'URL d'un fichier distant contenue dans un champ

- `[openlayers mode="this" champ_url="..."]`

##2.2 Mode d'affichage "loop" : "posts", "pages" ou "all"

- `[openlayers mode="posts"]` : Parcours des articles de votre Wordpress
- `[openlayers mode="pages"]` : Parcours des pages de votre Wordpress
- `[openlayers mode="all"]` : Parcours des articles et des pages de votre Wordpress

###2.2.1 D'après des coordonnées (ponctuel uniq.) contenues dans un champ

- `[openlayers mode="..." champ_lat="..." champ_long="..."]`

###2.2.2 D'après des géométries WKT contenues dans un champ

- `[openlayers mode="..." champ_wkt="..."]`

##3. Reprojection

Vous pouvez demander à OpenLayers de reprojeter vos données en indiquant dans quel système de projection elles sont notées (via le code ESPG) :

- `[openlayers epsg="..."]`

Vos données seront alors reprojetées en Google Mercator (ESPG:3857, anciennement 3875 et 900913). Si celles-ci sont déjà projetées en Google Mercator, vous pouvez laisser ce champ vide. 

##4. Centrage et zoom

Vous pouvez centrer la carte manuellement en indiquant des coordonnées et un niveau de zoom :

- `[openlayers center_lat="..." center_long="..."]` : Coordonnées sur lesquelles la carte doit se centrer (WGS 84 uniq.)
- `[openlayers zoom="..."]` : Niveau de zoom que la carte doit adopté à son affichage

Si vous n'indiquez pas ces attributs ou s'ils sont mal renseignés, la carte sera centrée et zoomée sur les figurés qui la composent