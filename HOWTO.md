#OPENLAYERS SHORTCODE - HOW TO

Ce petit guide va vous permettre de prendre en main le fonctionnement du shortcode. Suivez l'ordre, et le guide !

##0. Plusieurs cartes dans le même article ou la même page

Si vous désirez intégrer plusieurs cartes dans un même article, ou une même page, vous allez devoir les identifier en renseignant un numéro dans l'attribut "id".

`[openlayers id="1"]`
`[openlayers id="2"]`
`[openlayers id="3"]`
`[openlayers id="4"]`
`[openlayers id="..."]`

Si vous n'avez qu'une seule carte, il n'est pas nécessaire de renseigner cet attribut.

Vous pouvez inclure autant de cartes que vous le souhaitez. Rappelez-vous juste que le temps de chargement/affichage de votre page peut être allongé...

##1. Fond de carte

En renseignant l'attribut "tiles", vous pouvez changer le fond de carte de vos cartographies :

`[openlayers tiles="osm"]` : Fond de carte OpenStreetMap (OSM)

`[openlayers tiles="mapquest"]` : Fond de carte OSM selon MapQuest

`[openlayers tiles="mapquest_aerial"]` : Photo aérienne selon MapQuest

Si vous connaissez d'autres fonds de carte ouverts/libres, n'hésitez pas à [me les proposer](https://github.com/AdrienVH/openlayers_shortcode/blob/master/README.md#contact) !

##2.1 Source de donnée : mode "this"

`[openlayers mode="this"]` : Utilisation des données présentes dans l'article ou la page où le shortcode a été inséré.

Le mode "this" est le mode par défaut. Il n'est donc pas nécessaire de l'indiquer, sauf si vous avez changé les valeurs par défaut dans l'interface d'administration.

**2.1.1 D'après des coordonnées (figuré ponctuel uniquement)**

Deux attributs doivent être renseignés :

`[openlayers lat="..." lng="..."]`

###2.1.2 D'après des coordonnées contenues dans des champs personnalisés (figuré ponctuel uniquement)

Deux attributs doivent être renseignés :

`[openlayers champ_lat="..." champ_long="..."]`

Vous devez y indiquer les noms formalisés (slug) des deux champs personnalisés qui contiennent les latitude et longitude des figurés ponctuels à représenter.

###2.1.3 D'après la géométrie WKT

`[openlayers wkt="..."]`

###2.1.4 D'après la géométrie WKT contenues dans un champ personnalisé

`[openlayers mode="this" champ_wkt="..."]`

###2.1.5 D'après l'URL d'un fichier distant

`[openlayers url="..."]`

###2.1.6 D'après l'URL d'un fichier distant contenue dans un champ personnalisé

`[openlayers champ_url="..."]`

##2.2 Source de donnée : modes "posts", "pages" ou "all"

Avec ces trois modes, vous pouvez construire une carte avec les données contenues dans des champs personnalisés des articles et/ou des pages de votre WordPress :

`[openlayers mode="posts"]` : Parcours de tous les articles de votre Wordpress

`[openlayers mode="pages"]` : Parcours de toutes les pages de votre Wordpress

`[openlayers mode="all"]` : Parcours de tous les articles et toutes les pages de votre Wordpress

###2.2.1 D'après des coordonnées contenues dans des champs personnalisés (figuré ponctuel uniquement)

Deux attributs doivent être renseignés :

`[openlayers mode="..." champ_lat="..." champ_long="..."]`

Vous devez y indiquer les noms formalisés (slug) des deux champs personnalisés qui contiennent les latitude et longitude des figurés ponctuels à représenter.

###2.2.2 D'après des géométries WKT contenues dans un champ personnalisé

`[openlayers mode="..." champ_wkt="..."]`

##3. Reprojection des données à la volée

Vous pouvez demander à OpenLayers de reprojeter vos données en indiquant dans quelle projection elles sont notées initialement (via le code EPSG de cette projection) :

`[openlayers epsg="..."]`

Vos données seront alors reprojetées à la volée dans la projection "Google Mercator" (EPSG:3857, anciennement 3875 et 900913). Pour plus d'informations sur la notation EPSG, consultez le site [spatialreference.org](http://www.spatialreference.org/).

##4. Centrage et zoom de la carte

Vous pouvez centrer la carte manuellement en indiquant des coordonnées et un niveau de zoom :

`[openlayers center_lat="..." center_long="..."]` : Coordonnées sur lesquelles la carte doit se centrer (WGS 84 uniq.)

`[openlayers zoom="..."]` : Niveau de zoom que la carte doit adopté à son affichage

Si vous n'indiquez pas ces trois attributs ou s'ils sont mal renseignés, la carte sera centrée et zoomée sur les figurés qui la composent.