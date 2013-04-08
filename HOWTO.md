#OPENLAYERS SHORTCODE - HOW TO

Ce petit guide va vous permettre de prendre en main le fonctionnement du shortcode.

Suivez l'ordre, et le guide !

##0. Plusieurs cartes dans un même article / une même page

Si vous désirez intégrer plusieurs cartes dans un même article ou une même page, vous devez les identifier en renseignant l'attribut "id" :

`[openlayers id="1"]`
`[openlayers id="2"]`
`[openlayers id="3"]`
`[openlayers id="4"]`
`[openlayers id="..."]`

Vous pouvez inclure autant de cartes que vous le souhaitez. Rappelez-vous juste que le temps de chargement et d'affichage de votre page peut en être allongé...

##1. Fond de carte

Vous pouvez choisir le fond de carte de vos cartes en renseignant l'attribut "tiles" :

- `[openlayers tiles="mapquest"]` : Fond de carte OpenStreetMap stylé et fourni par MapQuest

- `[openlayers tiles="mapquest_aerial"]` : Image satelittaire fournie par MapQuest

- `[openlayers tiles="osm"]` : Fond de carte OpenStreetMap original

Si vous connaissez d'autres fonds de carte ouverts/libres, n'hésitez pas à [me les proposer](https://github.com/AdrienVH/openlayers_shortcode/blob/master/README.md#contact) !

- `[openlayers tiles="mapbox" mapbox_url="..."]` : Fond de carte hébergé par votre compte [Mapbox](http://mapbox.com/) personnel

Pour utiliser ce type de fond de carte, vous devez en plus indiquer l'URL pointant vers le fichier .jsonp généré par Mapbox (via l'attribut "mapbox_url")

##2.1 Source de donnée : mode "this"

- `[openlayers mode="this"]` : Utilisation des données présentes dans l'article ou la page où le shortcode a été inséré.

Le mode "this" est le mode par défaut. Il n'est donc pas nécessaire de l'indiquer, sauf si vous avez changé les valeurs par défaut dans l'interface d'administration.

###2.1.1 D'après des coordonnées (figuré ponctuel uniquement)

- `[openlayers lat="..." lng="..."]`

Vous devez indiquer les latitude et longitude du figuré ponctuel à représenter.

###2.1.2 D'après des coordonnées contenues dans des champs personnalisés (figuré ponctuel uniquement)

- `[openlayers champ_lat="..." champ_long="..."]`

Vous devez indiquer les noms formalisés (slug) des deux champs personnalisés qui contiennent les latitude et longitude du figuré ponctuel à représenter.

###2.1.3 D'après la géométrie WKT

- `[openlayers wkt="..."]`

Vous devez indiquer la [géométrie WKT](http://fr.wikipedia.org/wiki/Well-known_text) à représenter.

###2.1.4 D'après la géométrie WKT contenues dans un champ personnalisé

- `[openlayers mode="this" champ_wkt="..."]`

Vous devez indiquer le nom formalisé (slug) du champ personnalisé qui contient les [géométries WKT](http://fr.wikipedia.org/wiki/Well-known_text) à représenter.

###2.1.5 D'après l'URL d'un fichier distant

- `[openlayers url="..."]`

Vous devez indiquer l'URL du fichier à charger (GML ou GeoJSON).

###2.1.6 D'après l'URL d'un fichier distant contenue dans un champ personnalisé

- `[openlayers champ_url="..."]`

Vous devez indiquer le nom formalisé (slug) du champ personnalisé qui contient l'URL du fichier à charger (GML ou GeoJSON).

##2.2 Source de donnée : modes "posts", "pages" ou "all"

Avec ces trois modes, vous pouvez construire une carte avec toutes les données contenues dans les champs personnalisés de tous vos articles et/ou de toutes vos pages de votre WordPress :

- `[openlayers mode="posts"]` : Parcours de tous les articles de votre Wordpress

- `[openlayers mode="pages"]` : Parcours de toutes les pages de votre Wordpress

- `[openlayers mode="all"]` : Parcours de tous les articles et toutes les pages de votre Wordpress

###2.2.1 D'après des coordonnées contenues dans des champs personnalisés (figuré ponctuel uniquement)

- `[openlayers mode="..." champ_lat="..." champ_long="..."]`

Vous devez indiquer les noms formalisés (slug) des deux champs personnalisés qui contiennent les latitude et longitude des figurés ponctuels à représenter.

Si le champ personnalisé indiqué n'est pas renseigné pour un(e) ou plusieurs articles/pages, ces articles/pages seront ignoré(e)s.

###2.2.2 D'après des géométries WKT contenues dans un champ personnalisé

- `[openlayers mode="..." champ_wkt="..."]`

Vous devez indiquer le nom formalisé (slug) du champ personnalisé qui contient les [géométries WKT](http://fr.wikipedia.org/wiki/Well-known_text) à représenter.

Si le champ personnalisé indiqué n'est pas renseigné pour un(e) ou plusieurs articles/pages, ces articles/pages seront ignoré(e)s.

##3. Reprojection des données à la volée

Vous pouvez demander à OpenLayers de reprojeter vos données en indiquant dans quelle projection elles sont notées initialement (via le code EPSG de cette projection) :

- `[openlayers proj="..."]`

Vos données seront alors reprojetées à la volée dans la projection "Google Mercator" (EPSG:3857, anciennement 3875 et 900913). Pour plus d'informations sur la notation EPSG, consultez le site [spatialreference.org](http://www.spatialreference.org/).

##4. Centrage et zoom de la carte

Vous pouvez centrer la carte manuellement en indiquant des coordonnées et un niveau de zoom :

- `[openlayers center_lat="..." center_long="..."]` : Coordonnées sur lesquelles la carte doit se centrer

Attention, si vous avez indiqué une projection via l'attribut "proj", ces coordonnées-là seront aussi reprojetées !

- `[openlayers zoom="..."]` : Niveau de zoom que la carte doit adopté à son affichage

Si vous n'indiquez pas ces trois attributs ou s'ils sont mal renseignés, la carte sera centrée et zoomée sur l'ensemble des figurés qui la composent.