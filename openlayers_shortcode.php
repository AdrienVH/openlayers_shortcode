<?php
/*
Plugin Name: Openlayers Shortcode
Plugin URI: http://blog.adrienvh.fr/plugin-wordpress-openlayers-shortcode
Description: Ce plugin Wordpress met à votre disposition un nouveau shortcode qui va vous permettre d'intégrer une ou plusieurs cartes OpenLayers à vos pages et articles Wordpress. Ces cartes s’appuieront sur plusieurs fonds de carte (OpenStreetMap, MapQuest, MapBox, Bing Maps, Google Maps). Sur ces cartes, vous pourrez faire apparaitre un ou plusieurs objets géographiques (points, lignes ou polygones). Pour fonctionner, le plugin comprend les librairies JS Openlayers (2.12), Wax (6.4.0) et Google Maps (3.x).
Author: Adrien Van Hamme
Author URI: http://adrienvh.fr/
Version: 2.1.7
*/
require_once('php/tools.php');
require_once('php/admin.php');
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// SHORTCODE
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
add_shortcode('openlayers','openlayers_shortcode');
function openlayers_shortcode($attributs)
{
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// CONFIGURATION
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	extract(shortcode_atts(array(
	'id'			=> get_option('ols_id'),
	'debug'			=> get_option('ols_debug'),
	'width'			=> get_option('ols_width'),
	'height'		=> get_option('ols_height'),
	'zoom'			=> get_option('ols_zoom'),
	'mode'			=> get_option('ols_mode'),
	'tiles'			=> get_option('ols_tiles'),
	'tiles_url'		=> get_option('ols_tiles_url'),
	'tiles_key'		=> get_option('ols_tiles_key'),
	'tiles_layer'	=> get_option('ols_tiles_layer'),
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
	$output = '<div id="ols_carte'.$id.'" class="ols_carte" style="width:'.$width.';height:'.$height.';"></div>';
	$output .= '<script>';
	$output .= 'var map'.$id.' = new OpenLayers.Map("ols_carte'.$id.'");';
	$output .= 'var center = new OpenLayers.LonLat(0,0).transform(new OpenLayers.Projection("EPSG:4326"),new OpenLayers.Projection("EPSG:900913"));';
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 1. FOND DE CARTE
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	$output .= 'var coucheOSM = new OpenLayers.Layer.OSM();'; // Fond de carte OSM  / to-do : se passer d'OSM quand ce n'est pas le fond de carte demandé
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
	if($tiles == 'bing' AND $tiles_key != '' AND $tiles_layer != '') // Fond de carte Bing Maps
	{
		if($tiles_layer == 'road')
		{
			$output .= 'var coucheB = new OpenLayers.Layer.Bing({name:"'.$tiles_layer.'",key:"'.$tiles_key.'",type:"Road"});';
		}
		elseif($tiles_layer == 'hybrid')
		{
			$output .= 'var coucheB = new OpenLayers.Layer.Bing({name:"'.$tiles_layer.'",key:"'.$tiles_key.'",type:"AerialWithLabels"});';
		}
		elseif($tiles_layer == 'aerial')
		{
			$output .= 'var coucheB = new OpenLayers.Layer.Bing({name:"'.$tiles_layer.'",key:"'.$tiles_key.'",type:"Aerial"});';
		}
		else
		{
			$output .= 'var coucheB = new OpenLayers.Layer.Bing({name:"'.$tiles_layer.'",key:"'.$tiles_key.'",type:"Aerial"});';
			$message .= '<br />&bull; Vous n\'avez pas indiquée de couche Bing valide à afficher (couche "aerial" affichée par défaut)';
		}
		$output .= 'map'.$id.'.addLayer(coucheB);';
	}
	if($tiles == 'google' AND $tiles_layer != '') // Fond de carte Google Maps
	{
		if($tiles_layer == 'road')
		{
			$output .= 'var coucheG = new OpenLayers.Layer.Google("'.$tiles_layer.'",{type:google.maps.MapTypeId.ROADMAP ,numZoomLevels:22});';
		}
		elseif($tiles_layer == 'hybrid')
		{
			$output .= 'var coucheG = new OpenLayers.Layer.Google("'.$tiles_layer.'",{type:google.maps.MapTypeId.HYBRID ,numZoomLevels:22});';
		}
		elseif($tiles_layer == 'aerial')
		{
			$output .= 'var coucheG = new OpenLayers.Layer.Google("'.$tiles_layer.'",{type:google.maps.MapTypeId.SATELLITE,numZoomLevels:22});';
		}
		elseif($tiles_layer == 'terrain')
		{
			$output .= 'var coucheG = new OpenLayers.Layer.Google("'.$tiles_layer.'",{type:google.maps.MapTypeId.TERRAIN,numZoomLevels:16});';
		}
		else
		{
			$output .= 'var coucheG = new OpenLayers.Layer.Google("'.$tiles_layer.'",{type:google.maps.MapTypeId.SATELLITE,numZoomLevels:22});';
			$message .= '<br />&bull; Vous n\'avez pas indiquée de couche Google valide à afficher (couche "aerial" affichée par défaut)';
		}
		$output .= 'map'.$id.'.addLayer(coucheG);';
	}
	/*  to-do : Fond de carte WMS
	if($tiles == 'wms' AND filter_var($tiles_url,FILTER_VALIDATE_URL) AND $tiles_proj != '')
	{
		$output .= 'var coucheWMS = new OpenLayers.Layer.WMS("Fond de carte WMS",'.$tiles_url.',{srs:"EPSG:'.$tiles_proj.'"});';
		$output .= 'map'.$id.'.addLayer(coucheWMS);';
	}
	*/
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 2.1 MODE THIS
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	if($mode == 'this')
	{
		$this_id = get_the_ID();
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 2.1.2 LAT ET LONG
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		if($lat != '' AND $long != '') // Si des coordonnées sont indiquées
		{
			// Label
			if($champ_label == 'this_title')
				$label = get_the_title();
			elseif($champ_label != '' AND get_post_meta($this_id,$champ_label,true) != '')
				$label = get_post_meta($this_id,$champ_label,true);
			// Style
			$output .= 'var defaultStyle = new OpenLayers.Style({pointRadius:'.$pointradius.',strokeWidth:'.$strokewidth.',strokeColor:"'.$strokecolor.'",strokeOpacity:'.$strokeopacity.',fillColor:"'.$fillcolor.'",fillOpacity:'.$fillopacity.',label:"${ols_label}",labelAlign:"lc",labelXOffset:'.$labeloffset.',fontFamily:"Trebuchet MS",fontWeight:"'.$fontweight.'",fontSize:"'.$fontsize.'"});';
			$output .= 'var style = new OpenLayers.StyleMap({"default":defaultStyle});';
			// Layer
			$output .= 'var couche'.$id.' = new OpenLayers.Layer.Vector("Couche '.$id.'",{styleMap:style});';
			$output .= 'var entite = new OpenLayers.LonLat('.$long.','.$lat.');';
			if($proj != '')
				$output .= 'entite.transform(new OpenLayers.Projection("EPSG:'.$proj.'"),new OpenLayers.Projection("EPSG:3857"));';
			$output .= 'var point = new OpenLayers.Geometry.Point(entite.lon, entite.lat);';
			$output .= 'couche'.$id.'.addFeatures([new OpenLayers.Feature.Vector(point,{ols_label:"'.$label.'"})]);';
			$output .= 'map'.$id.'.addLayer(couche'.$id.');';
		}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 2.1.2 CHAMP_LAT ET CHAMP_LONG
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		elseif($champ_lat != '' AND $champ_long != '') // Si des champs personnalisés contenant des coordonnées sont indiqués
		{
			if(get_post_meta($this_id,$champ_lat,true) != '' OR get_post_meta($this_id,$champ_long,true) != '')
			{
				// Label
				if($champ_label == 'this_title')
					$label = get_the_title();
				elseif($champ_label != '' AND get_post_meta($this_id,$champ_label,true) != '')
					$label = get_post_meta($this_id,$champ_label,true);
				// Style
				$output .= 'var defaultStyle = new OpenLayers.Style({pointRadius:'.$pointradius.',strokeWidth:'.$strokewidth.',strokeColor:"'.$strokecolor.'",strokeOpacity:'.$strokeopacity.',fillColor:"'.$fillcolor.'",fillOpacity:'.$fillopacity.',label:"${ols_label}",labelAlign:"lc",labelXOffset:'.$labeloffset.',fontFamily:"Trebuchet MS",fontWeight:"'.$fontweight.'",fontSize:"'.$fontsize.'"});';
				$output .= 'var style = new OpenLayers.StyleMap({"default":defaultStyle});';
				// Layer
				$output .= 'var couche'.$id.' = new OpenLayers.Layer.Vector("Couche '.$id.'",{styleMap:style});';
				$output .= 'var entite = new OpenLayers.LonLat('.get_post_meta($this_id,$champ_long,true).','.get_post_meta($this_id,$champ_lat,true).');';
				if($proj != '')
					$output .= 'entite.transform(new OpenLayers.Projection("EPSG:'.$proj.'"),new OpenLayers.Projection("EPSG:3857"));';
				$output .= 'var point = new OpenLayers.Geometry.Point(entite.lon, entite.lat);';
				$output .= 'couche'.$id.'.addFeatures([new OpenLayers.Feature.Vector(point,{ols_label:"'.$label.'"})]);';
				$output .= 'map'.$id.'.addLayer(couche'.$id.');';
			}
			else
			{
				$erreur = true;
				$message .= '<br />&bull; Au moins un des deux champs personnalisés "champ_lat" ('.$champ_lat.') et "champ_long" ('.$champ_long.') indiqués semble vide';
			}
		}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 2.1.3 WKT
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		elseif($wkt != '') // Si une géométrie WKT est indiquée (to-do : tester si elle est valable)
		{
			// Label
			if($champ_label == 'this_title')
				$label = get_the_title();
			elseif($champ_label != '' AND get_post_meta($this_id,$champ_label,true) != '')
				$label = get_post_meta($this_id,$champ_label,true);
			// Style
			$output .= 'var defaultStyle = new OpenLayers.Style({pointRadius:'.$pointradius.',strokeWidth:'.$strokewidth.',strokeColor:"'.$strokecolor.'",strokeOpacity:'.$strokeopacity.',fillColor:"'.$fillcolor.'",fillOpacity:'.$fillopacity.',label:"${ols_label}",labelAlign:"lc",labelXOffset:'.$labeloffset.',fontFamily:"Trebuchet MS",fontWeight:"'.$fontweight.'",fontSize:"'.$fontsize.'"});';
			$output .= 'var style = new OpenLayers.StyleMap({"default":defaultStyle});';
			// Layer
			$output .= 'var couche'.$id.' = new OpenLayers.Layer.Vector("Couche '.$id.'",{styleMap:style});';
			$output .= 'var entite = new OpenLayers.Feature.Vector(new OpenLayers.Geometry.fromWKT("'.$wkt.'"),{ols_label:"'.$label.'"});';
			// to-do : reprojection de la chaîne de caractères ? du Geometry ? du Vector ? du Layer ?
			$output .= 'couche'.$id.'.addFeatures(entite);';
			$output .= 'map'.$id.'.addLayer(couche'.$id.');';
		}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 2.1.4 CHAMP_WKT
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		elseif($champ_wkt != '') // Si un champ personnalisé contenant une géométrie WKT est indiqué
		{
			if(get_post_meta($this_id,$champ_wkt,true) != '')
			{
				// 4. Label
				if($champ_label == 'this_title')
					$label = get_the_title();
				elseif($champ_label != '' AND get_post_meta($this_id,$champ_label,true) != '')
					$label = get_post_meta($this_id,$champ_label,true);
				// 3. Style
				$output .= 'var defaultStyle = new OpenLayers.Style({pointRadius:'.$pointradius.',strokeWidth:'.$strokewidth.',strokeColor:"'.$strokecolor.'",strokeOpacity:'.$strokeopacity.',fillColor:"'.$fillcolor.'",fillOpacity:'.$fillopacity.',label:"${ols_label}",labelAlign:"lc",labelXOffset:'.$labeloffset.',fontFamily:"Trebuchet MS",fontWeight:"'.$fontweight.'",fontSize:"'.$fontsize.'"});';
				$output .= 'var style = new OpenLayers.StyleMap({"default":defaultStyle});';
				// Layer
				$output .= 'var couche'.$id.' = new OpenLayers.Layer.Vector("Couche '.$id.'",{styleMap:style});';
				$output .= 'var entite = new OpenLayers.Feature.Vector(new OpenLayers.Geometry.fromWKT("'.get_post_meta($this_id,$champ_wkt,true).'"),{ols_label:"'.$label.'"});';
				// to-do : reprojection de la chaîne de caractères ? du Geometry ? du Vector ? du Layer ?
				$output .= 'couche'.$id.'.addFeatures(entite);';
				$output .= 'map'.$id.'.addLayer(couche'.$id.');';
			}
			else
			{
				$erreur = true;
				$message .= '<br />&bull; Le champ personnalisé "champ_wkt" ('.$champ_wkt.') indiqué semble vide';
			}
		}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 2.1.5 URL
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		elseif($url != '') // Si une URL d'un fichier est indiquée
		{
			if(filter_var($url,FILTER_VALIDATE_URL))
			{
				$extension = substr(strrchr($url,'.'),1);
				$extensions = array('gml','xml','geojson','json');
				if(in_array($extension, $extensions)) // Si cette URL valide présente une extension qui correspond au GML ou au GeoJSON
				{
					// Format
					if($extension == 'gml' OR $extension == 'xml')
						$format = 'GML';
					elseif($extension == 'geojson' OR $extension == 'json')
						$format = 'GeoJSON';
					// Style / Label
					if($champ_label != '')
					{
						$output .= 'var defaultStyle = new OpenLayers.Style({pointRadius:'.$pointradius.',strokeWidth:'.$strokewidth.',strokeColor:"'.$strokecolor.'",strokeOpacity:'.$strokeopacity.',fillColor:"'.$fillcolor.'",fillOpacity:'.$fillopacity.',label:"${'.$champ_label.'}",labelAlign:"lc",labelXOffset:'.$labeloffset.',fontFamily:"Trebuchet MS",fontWeight:"'.$fontweight.'",fontSize:"'.$fontsize.'"});';
						$output .= 'var style = new OpenLayers.StyleMap({"default":defaultStyle});';
					}
					else
					{
						$output .= 'var defaultStyle = new OpenLayers.Style({pointRadius:'.$pointradius.',strokeWidth:'.$strokewidth.',strokeColor:"'.$strokecolor.'",strokeOpacity:'.$strokeopacity.',fillColor:"'.$fillcolor.'",fillOpacity:'.$fillopacity.',labelAlign:"lc",labelXOffset:'.$labeloffset.',fontFamily:"Trebuchet MS",fontWeight:"'.$fontweight.'",fontSize:"'.$fontsize.'"});';
						$output .= 'var style = new OpenLayers.StyleMap({"default":defaultStyle});';
					}
					// Layer
					$output .= 'var couche'.$id.' = new OpenLayers.Layer.Vector("Couche '.$id.'",{protocol:new OpenLayers.Protocol.HTTP({url:"'.$url.'",format:new OpenLayers.Format.'.$format.'()}),projection:new OpenLayers.Projection("EPSG:'.$proj.'"),styleMap:style,strategies:[new OpenLayers.Strategy.Fixed()]});';
					$output .= 'map'.$id.'.addLayer(couche'.$id.');';
				}
				else
				{
					$erreur = true;
					$message .= '<br />- D\'après l\'extension du fichier indiqué dans "url" ('.$url.'), vos données ne sont ni au format GML, ni au format GeoJSON';
				}
			}
			else
			{
				$erreur = true;
				$message .= '<br />&bull; L\'adresse URL dans "url" ('.$url.') indiquée est invalide';
			}
		}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 2.1.6 CHAMP_URL
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		elseif($champ_url != '') // Si un champ personnalisé contenant une URL d'un fichier est indiqué
		{
			if(filter_var(get_post_meta($this_id,$champ_url,true),FILTER_VALIDATE_URL))
			{
				$extension = substr(strrchr(get_post_meta($this_id,$champ_url,true),'.'),1);
				$extensions = array('gml','xml','geojson','json');
				if(in_array($extension, $extensions)) // Si cette URL valide présente une extension qui correspond au GML ou au GeoJSON
				{
					// Format
					if($extension == 'gml' OR $extension == 'xml')
						$format = 'GML';
					elseif($extension == 'geojson' OR $extension == 'json')
						$format = 'GeoJSON';
					// Style / Label
					if($champ_label != '')
					{
						$output .= 'var defaultStyle = new OpenLayers.Style({pointRadius:'.$pointradius.',strokeWidth:'.$strokewidth.',strokeColor:"'.$strokecolor.'",strokeOpacity:'.$strokeopacity.',fillColor:"'.$fillcolor.'",fillOpacity:'.$fillopacity.',label:"${'.$champ_label.'}",labelAlign:"lc",labelXOffset:'.$labeloffset.',fontFamily:"Trebuchet MS",fontWeight:"'.$fontweight.'",fontSize:"'.$fontsize.'"});';
						$output .= 'var style = new OpenLayers.StyleMap({"default":defaultStyle});';
					}
					else
					{
						$output .= 'var defaultStyle = new OpenLayers.Style({pointRadius:'.$pointradius.',strokeWidth:'.$strokewidth.',strokeColor:"'.$strokecolor.'",strokeOpacity:'.$strokeopacity.',fillColor:"'.$fillcolor.'",fillOpacity:'.$fillopacity.',labelAlign:"lc",labelXOffset:'.$labeloffset.',fontFamily:"Trebuchet MS",fontWeight:"'.$fontweight.'",fontSize:"'.$fontsize.'"});';
						$output .= 'var style = new OpenLayers.StyleMap({"default":defaultStyle});';
					}
					// Layer
					$output .= 'var couche'.$id.' = new OpenLayers.Layer.Vector("Couche '.$id.'",{protocol:new OpenLayers.Protocol.HTTP({url:"'.get_post_meta($this_id,$champ_url,true).'",format:new OpenLayers.Format.'.$format.'()}),projection:new OpenLayers.Projection("EPSG:'.$proj.'"),styleMap:style,strategies:[new OpenLayers.Strategy.Fixed()]});';
					$output .= 'map'.$id.'.addLayer(couche'.$id.');';
				}
				else
				{
					$erreur = true;
					$message .= '<br />- Le format du fichier indiqué dans le champ personnalisé n\'est pas du GML ou du GeoJSON';
				}
			}
			else
			{
				$erreur = true;
				$message .= '<br />&bull; L\'adresse URL indiquée dans le champ personnalisé est invalide';
			}
		}
		else
		{
			$erreur = true;
			$message .= '<br />&bull; Aucune source de donnée n\'a été indiquée';
		}
	}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 2.2.1 CHAMP_LAT ET CHAMP_LONG
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	elseif($mode == 'posts' OR $mode == 'pages' OR $mode == 'all')
	{
		if($champ_lat != '' AND $champ_long != '')
		{
			// Style
			$output .= 'var defaultStyle = new OpenLayers.Style({pointRadius:'.$pointradius.',strokeWidth:'.$strokewidth.',strokeColor:"'.$strokecolor.'",strokeOpacity:'.$strokeopacity.',fillColor:"'.$fillcolor.'",fillOpacity:'.$fillopacity.',label:"${ols_label}",labelAlign:"lc",labelXOffset:'.$labeloffset.',fontFamily:"Trebuchet MS",fontWeight:"'.$fontweight.'",fontSize:"'.$fontsize.'"});';
			$output .= 'var style = new OpenLayers.StyleMap({"default":defaultStyle});';
			// Layer
			$output .= 'var couche'.$id.' = new OpenLayers.Layer.Vector("Couche '.$id.'",{styleMap:style});';
			if($mode == 'posts' OR $mode == 'all')
			{
				foreach(get_posts() as $post)
				{
					if(get_post_meta($post->ID,$champ_long,true) != '' AND get_post_meta($post->ID,$champ_lat,true) != '')
					{
						// Label
						if($champ_label == 'this_title')
							$label = get_the_title($post->ID);
						elseif($champ_label != '' AND get_post_meta($post->ID,$champ_label,true) != '')
							$label = get_post_meta($post->ID,$champ_label,true);
						// Layer
						$output = 'var entite = new OpenLayers.LonLat('.get_post_meta($post->ID,$champ_long,true).','.get_post_meta($post->ID,$champ_lat,true).');';
						if($proj != '')
							$output .= 'entite.transform(new OpenLayers.Projection("EPSG:'.$proj.'"),new OpenLayers.Projection("EPSG:3857"));';
						$output .= 'var point = new OpenLayers.Geometry.Point(entite.lon, entite.lat);';
						$output .= 'couche'.$id.'.addFeatures([new OpenLayers.Feature.Vector(point,{ols_label:"'.$label.'"})]);';
					}
				}
			}
			if($mode == 'pages' OR $mode == 'all')
			{
				foreach(get_pages() as $post)
				{
					if(get_post_meta($post->ID,$champ_long,true) != '' AND get_post_meta($post->ID,$champ_lat,true) != '')
					{
						// Label
						if($champ_label == 'this_title')
							$label = get_the_title($post->ID);
						elseif($champ_label != '' AND get_post_meta($post->ID,$champ_label,true) != '')
							$label = get_post_meta($post->ID,$champ_label,true);
						// Layer
						$output = 'var entite = new OpenLayers.LonLat('.get_post_meta($post->ID,$champ_long,true).','.get_post_meta($post->ID,$champ_lat,true).');';
						if($proj != '')
							$output .= 'entite.transform(new OpenLayers.Projection("EPSG:'.$proj.'"),new OpenLayers.Projection("EPSG:3857"));';
						$output .= 'var point = new OpenLayers.Geometry.Point(entite.lon, entite.lat);';
						$output .= 'couche'.$id.'.addFeatures([new OpenLayers.Feature.Vector(point,{ols_label:"'.$label.'"})]);';
					}
				}
			}
			// Layer
			$output .= 'map'.$id.'.addLayer(couche'.$id.');';
		}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 2.2.2 CHAMP_WKT
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		elseif($champ_wkt != '')
		{
			$output .= 'var couche'.$id.' = new OpenLayers.Layer.Vector("Couche '.$id.'",{styleMap:style});';
			if($mode == 'posts' OR $mode == 'all')
			{
				foreach(get_posts() as $post)
				{
					if(get_post_meta($post->ID,$champ_wkt,true) != '')
					{
						// Label
						if($champ_label == 'this_title')
							$label = get_the_title($post->ID);
						elseif($champ_label != '' AND get_post_meta($post->ID,$champ_label,true) != '')
							$label = get_post_meta($post->ID,$champ_label,true);
						// Layer
						$output = 'var entite = new OpenLayers.Feature.Vector(new OpenLayers.Geometry.fromWKT("'.get_post_meta($post->ID,$champ_wkt,true).'"),{post_id:"'.$post->ID.'",ols_label:"'.$label.'"});';
						// to-do : reprojection de la chaîne de caractères ? du Geometry ? du Vector ? du Layer ?
						$output .= 'couche'.$id.'.addFeatures(entite);';
					}
				}
			}
			if($mode == 'pages' OR $mode == 'all')
			{
				foreach(get_pages() as $post)
				{
					if(get_post_meta($post->ID,$champ_wkt,true) != '')
					{
						// Label
						if($champ_label == 'this_title')
							$label = get_the_title($post->ID);
						elseif($champ_label != '' AND get_post_meta($post->ID,$champ_label,true) != '')
							$label = get_post_meta($post->ID,$champ_label,true);
						// Layer
						$output = 'var entite = new OpenLayers.Feature.Vector(new OpenLayers.Geometry.fromWKT("'.get_post_meta($post->ID,$champ_wkt,true).'"),{post_id:"'.$post->ID.'",ols_label:"'.$label.'"});';
						// to-do : reprojection de la chaîne de caractères ? du Geometry ? du Vector ? du Layer ?
						$output .= 'couche'.$id.'.addFeatures(entite);';
					}
				}
			}
			// Layer
			$output .= 'map'.$id.'.addLayer(couche'.$id.');';
		}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 2.2.3 CHAMP_URL
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		elseif($champ_url != '')
		{
			if($mode == 'posts' OR $mode == 'all')
			{
				foreach(get_posts() as $post)
				{
					if(filter_var(get_post_meta($post->ID,$champ_url,true),FILTER_VALIDATE_URL))
					{
						$extension = substr(strrchr($url,'.'),1);
						$extensions = array('gml','xml','geojson','json');
						if(in_array($extension, $extensions))
						{
							// Format
							if($extension == 'gml' OR $extension == 'xml')
								$format = 'GML';
							elseif($extension == 'geojson' OR $extension == 'json')
								$format = 'GeoJSON';
							// Style / Label
							if($champ_label != '')
							{
								$output .= 'var defaultStyle = new OpenLayers.Style({pointRadius:'.$pointradius.',strokeWidth:'.$strokewidth.',strokeColor:"'.$strokecolor.'",strokeOpacity:'.$strokeopacity.',fillColor:"'.$fillcolor.'",fillOpacity:'.$fillopacity.',label:"${'.$champ_label.'}",labelAlign:"lc",labelXOffset:'.$labeloffset.',fontFamily:"Trebuchet MS",fontWeight:"'.$fontweight.'",fontSize:"'.$fontsize.'"});';
								$output .= 'var style = new OpenLayers.StyleMap({"default":defaultStyle});';
							}
							else
							{
								$output .= 'var defaultStyle = new OpenLayers.Style({pointRadius:'.$pointradius.',strokeWidth:'.$strokewidth.',strokeColor:"'.$strokecolor.'",strokeOpacity:'.$strokeopacity.',fillColor:"'.$fillcolor.'",fillOpacity:'.$fillopacity.',labelAlign:"lc",labelXOffset:'.$labeloffset.',fontFamily:"Trebuchet MS",fontWeight:"'.$fontweight.'",fontSize:"'.$fontsize.'"});';
								$output .= 'var style = new OpenLayers.StyleMap({"default":defaultStyle});';
							}
							// Layer
							$output .= 'var couche'.$id.'_'.$post->ID.' = new OpenLayers.Layer.Vector("Couche '.$id.' - '.$post->ID.'",{protocol:new OpenLayers.Protocol.HTTP({url:"'.$url.'",format:new OpenLayers.Format.'.$format.'()}),projection:new OpenLayers.Projection("EPSG:'.$proj.'"),styleMap:style,strategies:[new OpenLayers.Strategy.Fixed()]});';
							$output .= 'map'.$id.'.addLayer(couche'.$id.'_'.$post->ID.');';
						}
						else
						{
							$message .= '<br />- Le format du fichier indiqué dans le champ personnalisé n\'est pas du GML ou du GeoJSON';
						}
					}
					else
					{
						$message .= '<br />&bull; L\'adresse URL indiquée dans le champ personnalisé est invalide';
					}
				}
			}
			if($mode == 'pages' OR $mode == 'all')
			{
				foreach(get_pages() as $post)
				{
					if(filter_var(get_post_meta($post->ID,$champ_url,true),FILTER_VALIDATE_URL))
					{
						$extension = substr(strrchr($url,'.'),1);
						$extensions = array('gml','xml','geojson','json');
						if(in_array($extension, $extensions))
						{
							// Format
							if($extension == 'gml' OR $extension == 'xml')
								$format = 'GML';
							elseif($extension == 'geojson' OR $extension == 'json')
								$format = 'GeoJSON';
							// Style / Label
							if($champ_label != '')
							{
								$output .= 'var defaultStyle = new OpenLayers.Style({pointRadius:'.$pointradius.',strokeWidth:'.$strokewidth.',strokeColor:"'.$strokecolor.'",strokeOpacity:'.$strokeopacity.',fillColor:"'.$fillcolor.'",fillOpacity:'.$fillopacity.',label:"${'.$champ_label.'}",labelAlign:"lc",labelXOffset:'.$labeloffset.',fontFamily:"Trebuchet MS",fontWeight:"'.$fontweight.'",fontSize:"'.$fontsize.'"});';
								$output .= 'var style = new OpenLayers.StyleMap({"default":defaultStyle});';
							}
							else
							{
								$output .= 'var defaultStyle = new OpenLayers.Style({pointRadius:'.$pointradius.',strokeWidth:'.$strokewidth.',strokeColor:"'.$strokecolor.'",strokeOpacity:'.$strokeopacity.',fillColor:"'.$fillcolor.'",fillOpacity:'.$fillopacity.',labelAlign:"lc",labelXOffset:'.$labeloffset.',fontFamily:"Trebuchet MS",fontWeight:"'.$fontweight.'",fontSize:"'.$fontsize.'"});';
								$output .= 'var style = new OpenLayers.StyleMap({"default":defaultStyle});';
							}
							// Layer
							$output .= 'var couche'.$id.'_'.$post->ID.' = new OpenLayers.Layer.Vector("Couche '.$id.' - '.$post->ID.'",{protocol:new OpenLayers.Protocol.HTTP({url:"'.$url.'",format:new OpenLayers.Format.'.$format.'()}),projection:new OpenLayers.Projection("EPSG:'.$proj.'"),styleMap:style,strategies:[new OpenLayers.Strategy.Fixed()]});';
							$output .= 'map'.$id.'.addLayer(couche'.$id.'_'.$post->ID.');';
						}
						else
						{
							$message .= '<br />- Le format du fichier indiqué dans le champ personnalisé n\'est pas du GML ou du GeoJSON';
						}
					}
					else
					{
						$message .= '<br />&bull; L\'adresse URL indiquée dans le champ personnalisé est invalide';
					}
				}
			}
		}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////// FIN 2.2 MODES POSTS, PAGES ET ALL
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		else
		{
			$erreur = true;
			$message .= '<br />&bull; Aucune source de donnée n\'a été indiquée';
		}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// FIN 2. MODES
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	}
	else
	{
		$erreur = true;
		$message .= '<br />&bull; Aucun mode n\'a été indiqué';
	}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// 6. CENTRAGE ET ZOOM
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	if($center_lat != '' AND $center_long != '' AND $zoom != '')
	{
		if($proj != '')
			$output .= 'var center = new OpenLayers.LonLat('.$center_long.','.$center_lat.').transform(new OpenLayers.Projection("EPSG:'.$proj.'"),new OpenLayers.Projection("EPSG:3857"));';
		else
			$output .= 'var center = new OpenLayers.LonLat('.$center_long.','.$center_lat.');';
		$output .= 'map'.$id.'.setCenter(center,'.$zoom.');';
	}
	else // to-do : sur quoi centrer si plusieurs URL chargées ?
	{
		$output .= 'map'.$id.'.zoomToExtent(couche'.$id.'.getDataExtent());';
	}
	// FIN
	if($tiles != 'osm') // to-do : se passer d'OSM quand ce n'est pas le fond de carte demandé
	{
		$output .= 'map'.$id.'.removeLayer(coucheOSM);';
	}
	$output .= '</script>';
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// FEUILLES CSS
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	if($id <= 1 OR !is_numeric($id)) // to-do : charger une seule fois (cf. ébauche de fonction dans ols_functions.php)
	{
		$output .= '<style>';
		$output .= '<!--';
		$output .= '@import url("'.plugins_url().'/openlayers_shortcode/js/theme/default/style.css");';
		$output .= '@import url("'.plugins_url().'/openlayers_shortcode/css/carto.css");';
		$output .= '-->';
		$output .= '</style>';
	}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// OUTPUT
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

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