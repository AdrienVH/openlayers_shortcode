#OpenLayers Shortcode - HOW TO

##1. Fond de carte

- `[openlayers tiles="osm"]` : Fond de carte OpenStreetMpa (OSM)
- `[openlayers tiles="mapquest"]` : Fond de carte OSM selon MapQuest
- `[openlayers tiles="mapquest_aerial"]` : Photo aérienne selon MapQuest

##2.1 Mode d'affichage "this"

- `[openlayers mode="this" ]`

###2.1.1 D'après des coordonnées (ponctuel uniq.)

- `[openlayers mode="this" lat="..." lng="..."]`

###2.1.2 D'après des coordonnées (ponctuel uniq.) contenues dans un champ

- `[openlayers mode="this" champ_lat="..." champ_long="..."]`

###2.1.3 D'après la géométrie WKT

- `[openlayers mode="this" wkt="..."]`

###2.1.4 D'après la géométrie WKT contenues dans un champ

- `[openlayers mode="this" champ_wkt="..."]`

###2.1.5 D'après un fichier distant

- `[openlayers mode="this" url="..."]`

###2.1.6 D'après un fichier distant contenu dans un champ

- `[openlayers mode="this" champ_url="..."]`

##2.2 Mode d'affichage "loop" : "posts", "pages" ou "all"

- `[openlayers mode="posts"]` : Parcours des articles de votre Wordpress
- `[openlayers mode="pages"]` : Parcours des pages de votre Wordpress
- `[openlayers mode="all"]` : Parcours des articles et des pages de votre Wordpress

###2.2.1 D'après des coordonnées (ponctuel uniq.) contenues dans un champ

- `[openlayers mode="..." champ_lat="..." champ_long="..."]`

###2.2.2 D'après des géométries WKT contenues dans un champ

- `[openlayers mode="..." champ_wkt="..."]`

###2.2.3 D'après des fichiers distants contenues dans un champ

- `[openlayers mode="..." champ_url="..."]`

##3. Reprojection

- `[openlayers epsg="2154"]`

##4. Centrage et zoom

- `[openlayers center_lat="..." center_long="..."]`