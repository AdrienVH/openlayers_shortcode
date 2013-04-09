<?php
/*
Plugin Name: Openlayers Shortcode
Plugin URI: http://blog.adrienvh.fr/plugin-wordpress-openlayers-shortcode
Description: Ce plugin Wordpress met à votre disposition un nouveau shortcode qui va vous permettre d'intégrer une ou plusieurs cartes OpenLayers à vos pages et articles Wordpress. Ces cartes s’appuieront sur plusieurs fonds de carte (OpenStreetMap, MapBox Streets, MapQuest et MapQuest Aerial). Sur ces cartes, vous pourrez faire apparaitre un ou plusieurs objets géographiques (points, lignes ou polygones). Pour fonctionner, le plugin comprend les deux librairies JS Openlayers (2.12) et Wax (6.4.0).
Author: Adrien VAN HAMME
Author URI: http://adrienvh.fr/
Version: 1.5.3
*/
require_once('php/tools.php');
require_once('php/admin.php');
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////////////////////// SHORTCODE
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
add_shortcode('openlayers','openlayers_shortcode');
function openlayers_shortcode($attributs)
{
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////////////////// CONFIGURATION
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	extract(shortcode_atts(array(
	'id'			=> get_option('ols_id'),
	'debug'			=> get_option('ols_debug'),
	'width'			=> get_option('ols_width'),
	'height'		=> get_option('ols_height'),
	'zoom'			=> get_option('ols_zoom'),
	'mode'			=> get_option('ols_mode'),
	'tiles'			=> get_option('ols_tiles'),
	'tiles_url'		=> get_option('ols_tiles_url'),
	'lat'			=> get_option('ols_lat'),
	'champ_lat'		=> get_option('ols_champ_lat'),
	'long'			=> get_option('ols_long'),
	'champ_long'	=> get_option('ols_champ_long'),
	'wkt'			=> get_option('ols_wkt'),
	'champ_wkt'		=> get_option('ols_champ_wkt'),
	'url'			=> get_option('ols_url'),
	'champ_url'		=> get_option('ols_champ_url'),
	'proj'			=> get_option('ols_proj'),
	'center_lat'	=> get_option('ols_center_lat'),
	'center_long'	=> get_option('ols_center_long'),
	'pointradius'	=> get_option('ols_pointradius'),
	'strokewidth'	=> get_option('ols_strokewidth'),
	'strokecolor'	=> get_option('ols_strokecolor'),
	'strokeopacity'	=> get_option('ols_strokeopacity'),
	'fillcolor'		=> get_option('ols_fillcolor'),
	'fillopacity'	=> get_option('ols_fillopacity'),
	'label'			=> get_option('ols_label'),
	'champ_label'	=> get_option('ols_champ_label'),
	'labeloffset'	=> get_option('ols_labeloffset'),
	'fontweight'	=> get_option('ols_fontweight'),
	'fontsize'		=> get_option('ols_fontsize')
	),$attributs));
	$erreur = false;
	$message = 'Les erreurs suivantes ont été rencontrées :';
	$output = '<div id="cartographie'.$id.'" class="cartographie" style="width:'.$width.';height:'.$height.';"></div>';
	$output .= '<script>';
	$output .= 'var map'.$id.' = new OpenLayers.Map("cartographie'.$id.'");';
	$output .= 'var center = new OpenLayers.LonLat(0,0).transform(new OpenLayers.Projection("EPSG:4326"),new OpenLayers.Projection("EPSG:900913"));';
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////// TILES
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	$output .= 'var coucheOSM = new OpenLayers.Layer.OSM();'; // Fond de carte OSM
	$output .= 'map'.$id.'.addLayer(coucheOSM);';
	if($tiles == 'mapquest') // Fond de carte MapQuest OSM
	{
		$output .= 'var tuiles = ["http://otile1.mqcdn.com/tiles/1.0.0/osm/${z}/${x}/${y}.jpg","http://otile2.mqcdn.com/tiles/1.0.0/osm/${z}/${x}/${y}.jpg","http://otile3.mqcdn.com/tiles/1.0.0/osm/${z}/${x}/${y}.jpg","http://otile4.mqcdn.com/tiles/1.0.0/osm/${z}/${x}/${y}.jpg"];';
		$output .= 'var coucheMQ = new OpenLayers.Layer.OSM("MapQuest-OSM Tiles",tuiles,{attribution:"MapQuest, Open Street Map et leurs contributeurs, CC-BY-SA"});';
		$output .= 'map'.$id.'.addLayer(coucheMQ);';
	}
	if($tiles == 'mapquest_aerial') // Fond de carte MapQuest Aerial
	{
		$output .= 'var tuiles = ["http://oatile1.mqcdn.com/tiles/1.0.0/sat/${z}/${x}/${y}.jpg","http://oatile2.mqcdn.com/tiles/1.0.0/sat/${z}/${x}/${y}.jpg","http://oatile3.mqcdn.com/tiles/1.0.0/sat/${z}/${x}/${y}.jpg","http://oatile4.mqcdn.com/tiles/1.0.0/sat/${z}/${x}/${y}.jpg"];';
		$output .= 'var coucheMQ = new OpenLayers.Layer.OSM("MapQuest Open Aerial Tiles",tuiles,{attribution:"MapQuest, NASA/JPL-Caltech et U.S. Dpt. of Agric.,Farm Service Ag."});';
		$output .= 'map'.$id.'.addLayer(coucheMQ);';
	}
	if($tiles == 'mapbox' AND filter_var($tiles_url,FILTER_VALIDATE_URL)) // Fond de carte MapBox
	{
		$output .= 'var coucheMB;';
		$output .= 'wax.tilejson("'.$tiles_url.'",function(tilejson){';
		$output .= 'coucheMB = new wax.ol.connector(tilejson);';
		$output .= 'map'.$id.'.addLayer(coucheMB);';
		$output .= '});';
	}
	// if($tiles == 'wms' AND $tiles_proj != '' AND filter_var($tiles_url,FILTER_VALIDATE_URL))  // to-do : Fond de carte WMS
	// {
		// $output .= 'var tuiles = ["'.$tiles_url.'"];';
		// $output .= 'var coucheWMS = new OpenLayers.Layer.WMS("Fond de carte WMS",tuiles,{srs:"EPSG:'.$tiles_proj.'"});';
		// $output .= 'map'.$id.'.addLayer(coucheWMS);';
	// }
	// Style des figurés
	$output .= 'var defaultStyle = new OpenLayers.Style({pointRadius:'.$pointradius.',strokeWidth:'.$strokewidth.',strokeColor:"'.$strokecolor.'",strokeOpacity:'.$strokeopacity.',fillColor:"'.$fillcolor.'",fillOpacity:'.$fillopacity.',label:"${label}",labelAlign:"lc",labelXOffset:'.$labeloffset.',fontFamily:"Trebuchet MS",fontWeight:"'.$fontweight.'",fontSize:"'.$fontsize.'"});';
	$output .= 'var style = new OpenLayers.StyleMap({"default":defaultStyle});';
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////////////////////// MODE THIS
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	if($mode == 'this')
	{
		// Récupération de l'id du post actuel
		$id_this = get_the_ID();
		// Détermination du label
		if($champ_label == 'title')
		{
			$p_label = get_the_title();
		}
		elseif($champ_label == '')
		{
			$p_label = ($label != '') ? $label : '' ;
		}
		elseif(get_post_meta($id_this,$champ_label,true) != '')
		{
			$p_label = get_post_meta($id_this,$champ_label,true);
		}
		// Création de la couche
		if(filter_var($url,FILTER_VALIDATE_URL)) // Si une URL valide a été renseignée dans l'attribut "url"
		{
			$extension = substr(strrchr($url,'.'),1);
			$extensions = array('gml','xml','geojson','json');
			if(in_array($extension, $extensions)) // Si cette URL valide présente une extension qui correspond au GML et au GeoJSON
			{
				if		($extension == 'gml' OR $extension == 'xml'){$format = 'GML';}
				elseif	($extension == 'geojson' OR $extension == 'json'){$format = 'GeoJSON';}
				$output .= 'var couche'.$id.' = new OpenLayers.Layer.Vector("Couche '.$id.'",{protocol:new OpenLayers.Protocol.HTTP({url:"'.$url.'",format:new OpenLayers.Format.'.$format.'()}),projection:new OpenLayers.Projection("EPSG:900913"),styleMap:style,strategies:[new OpenLayers.Strategy.Fixed()]});';
			}
			else
			{
				$erreur = true;
				$message .= '<br />- D\'après l\'extension du fichier indiqué (attribut "url"), vos données ne sont ni au format GML, ni au format GeoJSON';
			}
		}
		elseif($champ_wkt != '') // Si un champ personnalisé est indiqué pour représenter un objet WKT (to-do : tester si le WKT est valide)
		{
			$p_wkt = get_post_meta($id_this,$champ_wkt,true);
			if($p_wkt != '') // remplacer par args sur meta key pour filtrer
			{
				$output .= 'var couche'.$id.' = new OpenLayers.Layer.Vector("Couche '.$id.'",{styleMap:style});';
				$output .= 'map'.$id.'.addLayer(couche'.$id.');';
				$output .= 'entite = new OpenLayers.Feature.Vector(new OpenLayers.Geometry.fromWKT("'.$p_wkt.'"),{label:"'.$p_label.'"});';
				$output .= 'couche'.$id.'.addFeatures(entite);';
			}
		}
		elseif($wkt != '')  // Sinon, on se contente de la notation WKT "en dur" (to-do : tester si le WKT est valide avec une regexp)
		{
			$output .= 'var couche'.$id.' = new OpenLayers.Layer.Vector("Couche '.$id.'",{styleMap:style});';
			$output .= 'map'.$id.'.addLayer(couche'.$id.');';
			$output .= 'entite = new OpenLayers.Feature.Vector(new OpenLayers.Geometry.fromWKT("'.$wkt.'"),{label:"'.$p_label.'"});';
			$output .= 'couche'.$id.'.addFeatures(entite);';
		}
		elseif($champ_lat != '' AND $champ_long != '') // Sinon, si deux champs personnalisés sont indiqués pour représenter un point (to-do : tester s'ils sont valables)
		{
			$p_long = get_post_meta($id_this,$champ_long,true);
			$p_lat = get_post_meta($id_this,$champ_lat,true);
			if($p_long != '' AND $p_lat != '') // remplacer par args sur meta key pour filtrer
			{
				$output .= 'var couche'.$id.' = new OpenLayers.Layer.Vector("Couche '.$id.'",{styleMap:style});';
				$output .= 'entite = new OpenLayers.LonLat('.$p_long.','.$p_lat.');';
				$output .= 'entite.transform(new OpenLayers.Projection("EPSG:4326"),new OpenLayers.Projection("EPSG:900913"));';
				$output .= 'point = new OpenLayers.Geometry.Point(entite.lon, entite.lat);';
				$output .= 'couche'.$id.'.addFeatures([new OpenLayers.Feature.Vector(point,{label:"'.$p_label.'"})]);';
			}
		}
		elseif($lat != '' AND $long != '') // Sinon, on se contente des coordonnées "en dur" pour représenter un point (to-do : tester si elles sont bien des numériques)
		{
			$output .= 'var couche'.$id.' = new OpenLayers.Layer.Vector("Couche '.$id.'",{styleMap:style});';
			$output .= 'entite = new OpenLayers.LonLat('.$long.','.$lat.');';
			$output .= 'entite.transform(new OpenLayers.Projection("EPSG:4326"),new OpenLayers.Projection("EPSG:900913"));';
			$output .= 'point = new OpenLayers.Geometry.Point(entite.lon, entite.lat);';
			$output .= 'couche'.$id.'.addFeatures([new OpenLayers.Feature.Vector(point,{label:"'.$p_label.'"})]);';
		}
		else // Sinon on renvoie une erreur car il n'y a rien à représenter
		{
			$erreur = true;
			$message .= '<br />- Les attributs n\'ont pas été correctement renseignés : aucune source de données valide n\'a été trouvée.';
		}
	}
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////// MODES POSTS, PAGES ET ALL
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	elseif($mode == 'posts' OR $mode == 'pages' OR $mode == 'all')
	{
		if($champ_lat != '' AND $champ_long != '') // Si des champs personnalisés sont bien indiqués (to-do : tester s'ils sont valables)
		{
			$output .= 'var couche'.$id.' = new OpenLayers.Layer.Vector("Couche '.$id.'",{styleMap:style});';
			if($mode == 'posts' OR $mode == 'all')
			{
				$posts = get_posts(); // to-do : array('meta_key' => 'longitude,latitude')
				foreach($posts as $post)
				{
					// Détermination du label
					if($champ_label == 'title')
					{
						$p_label = get_the_title($post->ID);
					}
					elseif($champ_label == '')
					{
						$p_label = ($label != '') ? $label : '' ;
					}
					elseif(get_post_meta($post->ID,$champ_label,true) != '')
					{
						$p_label = get_post_meta($post->ID,$champ_label,true);
					}
					// Récupération des coordonnées
					$p_wkt = get_post_meta($post->ID,$champ_wkt,true);
					if($p_wkt != '') // to-do : array('meta_key' => 'wkt')
					{
						$output .= 'var couche'.$id.' = new OpenLayers.Layer.Vector("Couche '.$id.'",{styleMap:style});';
						$output .= 'map'.$id.'.addLayer(couche'.$id.');';
						$output .= 'entite = new OpenLayers.Feature.Vector(new OpenLayers.Geometry.fromWKT("'.$p_wkt.'"),{label:"'.$p_label.'"});';
						$output .= 'couche'.$id.'.addFeatures(entite);';
					}
					else
					{
						$p_long = get_post_meta($post->ID,$champ_long,true);
						$p_lat = get_post_meta($post->ID,$champ_lat,true);
						if($p_long != '' AND $p_lat != '') // to-do : array('meta_key' => 'longitude,latitude')
						{
							$output .= 'entite = new OpenLayers.LonLat('.$p_long.','.$p_lat.');';
							$output .= 'entite.transform(new OpenLayers.Projection("EPSG:4326"),new OpenLayers.Projection("EPSG:900913"));';
							$output .= 'point = new OpenLayers.Geometry.Point(entite.lon, entite.lat);';
							$output .= 'couche'.$id.'.addFeatures([new OpenLayers.Feature.Vector(point,{label:"'.$p_label.'"})]);';
						}
						else // Sinon on renvoie une erreur car il n'y a rien à représenter
						{
							$erreur = true;
							$message .= '<br />- Les attributs lat, long, wkt, champ_lat, champ_long et/ou champ_wkt n\'ont pas été correctement renseignés';
						}
					}
				}
			}
			if($mode == 'pages' OR $mode == 'all') // to-do : mutualiser les cas des pages et les cas des posts
			{
				$posts = get_pages(); // to-do : array('meta_key' => 'longitude,latitude')
				foreach($posts as $post)
				{
					// Détermination du label
					if($champ_label == 'title')
					{
						$p_label = get_the_title($post->ID);
					}
					elseif($champ_label == '')
					{
						$p_label = ($label != '') ? $label : '' ;
					}
					elseif(get_post_meta($post->ID,$champ_label,true) != '')
					{
						$p_label = get_post_meta($post->ID,$champ_label,true);
					}
					// Récupération des coordonnées
					$p_wkt = get_post_meta($post->ID,$champ_wkt,true);
					if($p_wkt != '') // to-do : array('meta_key' => 'wkt')
					{
							$output .= 'var couche'.$id.' = new OpenLayers.Layer.Vector("Couche '.$id.'",{styleMap:style});';
							$output .= 'map'.$id.'.addLayer(couche'.$id.');';
							$output .= 'entite = new OpenLayers.Feature.Vector(new OpenLayers.Geometry.fromWKT("'.$p_wkt.'"),{label:"'.$p_label.'"});';
							$output .= 'couche'.$id.'.addFeatures(entite);';
					}
					else
					{
						$p_long = get_post_meta($post->ID,$champ_long,true);
						$p_lat = get_post_meta($post->ID,$champ_lat,true);
						if($p_long != '' AND $p_lat != '') // to-do : array('meta_key' => 'longitude,latitude')
						{
							$output .= 'entite = new OpenLayers.LonLat('.$p_long.','.$p_lat.');';
							$output .= 'entite.transform(new OpenLayers.Projection("EPSG:4326"),new OpenLayers.Projection("EPSG:900913"));';
							$output .= 'point = new OpenLayers.Geometry.Point(entite.lon, entite.lat);';
							$output .= 'couche'.$id.'.addFeatures([new OpenLayers.Feature.Vector(point,{label:"'.$p_label.'"})]);';
						}
						else // Sinon on renvoie une erreur car il n'y a rien à représenter
						{
							$erreur = true;
							$message .= '<br />- Les attributs lat, long, wkt, champ_lat, champ_long et/ou champ_wkt n\'ont pas été correctement renseignés';
						}
					}
				}
			}
		}
		else
		{
			$erreur = true;
			$message .= '<br />- En mode "posts", "pages" ou "all", les attributs champ_lat et champ_long doivent être correctement renseignés';
		}
	}
	else
	{
		$erreur = true;
		$message .= '<br />- Le mode que vous avez choisi est inconnu (valeurs acceptées : "this", "posts", "pages" ou "all")';
	}
	$output .= 'map'.$id.'.addLayer(couche'.$id.');'; // to-do : risque d'erreur js objet non déclaré
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////////////////////////////// CENTRAGE
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	if($center_lat != '' AND $center_long != '') // to-do : tester si numérique
	{
		$output .= 'center = new OpenLayers.LonLat('.$center_long.','.$center_lat.').transform(new OpenLayers.Projection("EPSG:4326"),new OpenLayers.Projection("EPSG:900913"));';
		$output .= 'map'.$id.'.setCenter(center,'.$zoom.');';
	}
	else
	{
		$output .= 'map'.$id.'.zoomToExtent(couche'.$id.'.getDataExtent());';
	}
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////////////////// FOND DE CARTE
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	if($tiles != 'osm')
	{
		$output .= 'map'.$id.'.removeLayer(coucheOSM);';
	}
	$output .= '</script>';
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////////////////////////// FEUILLES CSS
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	if($id <= 1 OR !is_numeric($id)) // Si $id vaut bien 1 ou si on a un doute (inf. à 1 ? non numérique ?) / to-do : charger une seule fois (cf. ébauche de fonction dans ols_functions.php)
	{
		$output .= '<style>';
		$output .= '<!--';
		$output .= '@import url("'.plugins_url().'/openlayers_shortcode/js/theme/default/style.css");';
		$output .= '@import url("'.plugins_url().'/openlayers_shortcode/css/carto.css");';
		$output .= '-->';
		$output .= '</style>';
	}
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////// OUTPUT
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	if($erreur == true AND $debug == 'oui') // S'il y a au moins une erreur et que le mode "debug" est activé
	{
		return $message;
	}
	elseif($erreur == true AND $debug == 'non') // S'il y a au moins une erreur et que le mode "debug" est activé
	{
		return null;
	}
	elseif($erreur == false AND $debug == 'oui') // S'il n'y a aucune erreur, mais que le mode "debug" est activé
	{
		return $output.'<br />'.$message;
	}
	else // S'il n'y a aucune erreur et que le mode "debug" n'est pas activé
	{
		return $output;
	}
}
?>