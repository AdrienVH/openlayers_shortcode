#OpenLayers Shortcode - HOW TO

##1. Fond de carte

- `[openlayers tiles="osm"]` : Fond de carte OpenStreetMpa (OSM)
- `[openlayers tiles="mapquest"]` : Fond de carte OSM selon MapQuest
- `[openlayers tiles="mapquest_aerial"]` : Photo aérienne selon MapQuest

##2.1 Mode d'affichage "this"

- `[openlayers mode="this" ]`

##2.2 Modes d'affichage "posts", "pages" et "all"

- `[openlayers mode="posts"]`
- `[openlayers mode="pages"]`
- `[openlayers mode="all"]`

###2.2.1 D'après des coordonnées latitude et longitude (ponctuel uniq.)

- `[openlayers champ_lat="..." champ_long="..."]`

###2.2.2 D'après des géométries WKT

- `[openlayers champ_wkt="..."]`

###2.2.3 D'après des fichiers distants

- `[openlayers champ_url="..."]`

##3. Reprojection en ESPG:3857

- `[openlayers epsg="2154"]`