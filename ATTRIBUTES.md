#OPENLAYERS SHORTCODE - ATTRIBUTES

Listes des attributs disponibles avec le shortcode.

##id

- Utilité : Identifiant (unique) de la carte
- Valeur par défaut : `1`
- Valeurs acceptées : Nombres entiers de `1` à `n`

##debug

- Utilité : Mode permettant d'afficher des mesages d'erreur
- Valeur par défaut : `non`
- Valeurs acceptées : `non` `oui`

##width

- Utilité : Largeur du bloc `div` contenant la carte
- Valeur par défaut : `100%`
- Valeurs acceptées : Valeurs en pourcentage (%) ou en nombre de pixels (px)

##height

- Utilité : Hauteur du bloc `div` contenant la carte
- Valeur par défaut : `400px`
- Valeurs acceptées : Valeurs en pourcentage (%) ou en nombre de pixels (px)

##mode

- Utilité : Définition de la source de données
- Valeur par défaut : `this`
- Valeurs acceptées : `this` (cette page/article) `posts` (les articles) `pages` (les pages) et `all` (articles et pages)

##tiles

- Utilité : Fond de carte
- Valeur par défaut : `mapquest`
- Valeurs acceptées : `mapquest` `mapquest_aerial` `osm` `transport` `hillshade` `stamen` `bing` `google` et `mapbox`

/!\ : `stamen` requiert de renseigner l'attribut "tiles_layer"

/!\ : `bing` requiert de renseigner les attributs "tiles_key" et "tiles_layer"

/!\ : `google` requiert de renseigner l'attribut "tiles_layer"

/!\ : `mapbox` requiert de renseigner l'attribut "tiles_url"

##tiles_url

- Utilité : Certains fonds de carte (attribut "tiles") requièrent de renseigner une URL (`mapbox` par ex.)
- Valeur par défaut :
- Valeurs acceptées : Adresses URL valides

##tiles_key

- Utilité : Certains fonds de carte (attribut "tiles") requièrent de renseigner une clef d'API (`bing` par ex.)
- Valeur par défaut :
- Valeurs acceptées : Adresses URL valides

##tiles_layer

- Utilité : Certains fonds de carte (attribut "tiles") requièrent de renseigner une couche en particulier (`bing` ou `google` par ex.)
- Valeur par défaut :
- Valeurs acceptées : `road` `hybrid` `aerial` (couches proposées par Bing Maps et Google Maps) `terrain` (couche proposée par Google Maps) `road` `hybrid` (couches proposées par Stamen Design)

##lat

- Utilité : Latitude d'un point à représenter
- Valeur par défaut : 
- Valeurs acceptées : Nombres (avec le point comme séparateur décimal)

##long

- Utilité : Longitude d'un point à représenter
- Valeur par défaut : 
- Valeurs acceptées : Nombres (avec le point comme séparateur décimal)

##champ_lat

- Utilité : Nom formalisé (slug) du champ personnalisé contenant la latitude du ou des points à représenter
- Valeur par défaut : -
- Valeurs acceptées : Slugs de vos champs personnalisés

##champ_long

- Utilité : Nom formalisé (slug) du champ personnalisé contenant la latitude du ou des points à représenter
- Valeur par défaut : -
- Valeurs acceptées : Slugs de vos champs personnalisés

##wkt

- Utilité : Notation WKT (EPSG:3857) de la géométrie que vous voulez représenter
- Valeur par défaut : -
- Valeurs acceptées : Notations WKT valides

/!\ : L'attribut "proj" n'est pas compatible avec cette source de données

##champ_wkt

- Utilité : Nom formalisé (slug) du champ personnalisé contenant la latitude du ou des points à représenter
- Valeur par défaut : -
- Valeurs acceptées : Slugs de vos champs personnalisés

##url

- Utilité : 
- Valeur par défaut : 
- Valeurs acceptées : 

##champ_url

- Utilité :  Nom formalisé (slug) du champ personnalisé contenant l'URL du fichier à charger
- Valeur par défaut : -
- Valeurs acceptées : Slugs de vos champs personnalisés

/!\ : Le ou les fichiers à charger doivent être au format GeoJSON ou au format GML

##proj

- Utilité : Système de projection de vos données (si différent du de l'EPSG:3857)
- Valeur par défaut : `4326` (WGS 84)
- Valeurs acceptées : Codes EPSG valides

##center_lat

- Utilité : Latitude du point sur lequel la carte doit se centrer
- Valeur par défaut : -
- Valeurs acceptées : Nombres (avec le point comme séparateur décimal)

/!\ : Si "center_lat", "center_long" et "zoom" ne sont pas correctement renseignés, la carte sera centrée sur les données qui la composent

/!\ : Si vous avez renseigné l'attribut "proj", ces coordonnées seront aussi reprojetées

##center_long

- Utilité : Longitude du point sur lequel la carte doit se centrer
- Valeur par défaut : -
- Valeurs acceptées : Nombres (avec le point comme séparateur décimal)

/!\ : Si "center_lat", "center_long" et "zoom" ne sont pas correctement renseignés, la carte sera centrée sur les données qui la composent

/!\ : Si vous avez renseigné l'attribut "proj", ces coordonnées seront aussi reprojetées

##zoom

- Utilité : Niveau de zoom sur lequel la carte doit se centrer
- Valeur par défaut : `15`
- Valeurs acceptées : Nombres entiers de `1` à `22`

/!\ : Si "center_lat", "center_long" et "zoom" ne sont pas correctement renseignés, la carte sera centrée sur les données qui la composent

##label

- Utilité : 
- Valeur par défaut : -
- Valeurs acceptées : 

##champ_label

- Utilité : 
- Valeur par défaut : -
- Valeurs acceptées :

##pointradius

- Utilité : 
- Valeur par défaut : `5`
- Valeurs acceptées : 

##strokewidth

- Utilité : 
- Valeur par défaut : `1`
- Valeurs acceptées : 

##strokecolor

- Utilité : 
- Valeur par défaut : 
- Valeurs acceptées : `#000000`

##strokeopacity

- Utilité : 
- Valeur par défaut : `1`
- Valeurs acceptées : 

##fillcolor

- Utilité : 
- Valeur par défaut : `#36b7d1`
- Valeurs acceptées : 

##fillopacity

- Utilité : 
- Valeur par défaut : 
- Valeurs acceptées : 

##labeloffset

- Utilité : 
- Valeur par défaut : `10`
- Valeurs acceptées : 

##fontweight

- Utilité : 
- Valeur par défaut : `bold`
- Valeurs acceptées : 

##fontsize

- Utilité : 
- Valeur par défaut : `12px`
- Valeurs acceptées : 