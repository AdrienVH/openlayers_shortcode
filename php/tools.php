<?php
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////// CHARGEMENT UNIQUE DES SCRIPTS JS
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
add_action('wp_enqueue_scripts','enqueue_ols_js');
function enqueue_ols_js()
{
	global $post; // On utilise la variable $post générée par WordPress
	$return = false;
	if($post)
	{
		$resultats = array();
		$pattern = get_shortcode_regex();
		preg_match_all('/'.$pattern.'/s', $post->post_content, $resultats);
		foreach($resultats[2] as $shortcode)
		{
			if($shortcode == 'openlayers')
			{
				$path = plugins_url().'/openlayers_shortcode/js';
				wp_enqueue_script('ols_js_openlayers', $path.'/openlayers.js', null, null, false);
				wp_enqueue_script('ols_js_wax', $path.'/wax.ol.js', null, null, false);
				wp_enqueue_script('ols_js_google', 'http://maps.googleapis.com/maps/api/js?v=3&sensor=true', null, null, false);
				$return = true;
				break; // On arrête de boucler sur les résultats car on a trouvé ce que l'on cherchait
			}
		}
	}
	return $return;
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////// CHARGEMENT UNIQUE DES FEUILLES CSS
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// add_action('wp_enqueue_styles','enqueue_ols_css'); // bug : fonction désactivée car le chargement se fait dans le header alors qu'il faut charger dans le footer obligatoirement (surcouche)
// function enqueue_ols_css()
// {
	// global $post; // On utilise la variable $post générée par WordPress
	// $return = false;
	// if($post)
	// {
		// $resultats = array();
		// $pattern = get_shortcode_regex();
		// preg_match_all('/'.$pattern.'/s', $post->post_content, $resultats);
		// foreach($resultats[2] as $shortcode)
		// {
			// if($shortcode == 'openlayers')
			// {
				// $path = plugins_url().'/openlayers_shortcode/css';
				// wp_enqueue_style('ols_css_carto', $path.'/carto.css', null, null, true);
				// wp_enqueue_style('ols_css_admin', $path.'/admin.css', null, null, true);
				// $return = true;
				// break; // On arrête de boucler sur les résultats car on a trouvé ce que l'on cherchait
			// }
		// }
	// }
	// return $return;
// }
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////// HOOK ACTIVATION
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
register_activation_hook(__FILE__,'ols_activation');
function ols_activation() // To-do à l'activation du plugin (et non à l'installation)
{
	if(!get_option('ols_id'))				{add_option('ols_id','1');}
	if(!get_option('ols_debug'))			{add_option('ols_debug','non');}
	if(!get_option('ols_width'))			{add_option('ols_width','100%');}
	if(!get_option('ols_height'))			{add_option('ols_height','400px');}
	if(!get_option('ols_zoom'))				{add_option('ols_zoom','15');}
	if(!get_option('ols_mode'))				{add_option('ols_mode','this');}
	if(!get_option('ols_tiles'))			{add_option('ols_tiles','mapquest');}
	if(!get_option('ols_tiles_url'))		{add_option('ols_tiles_url');}
	if(!get_option('ols_tiles_key'))		{add_option('ols_tiles_key');}
	if(!get_option('ols_tiles_layer'))		{add_option('ols_tiles_layer');}
	if(!get_option('ols_lat'))				{add_option('ols_lat');}
	if(!get_option('ols_champ_lat'))		{add_option('ols_champ_lat');}
	if(!get_option('ols_long'))				{add_option('ols_long');}
	if(!get_option('ols_champ_long'))		{add_option('ols_champ_long');}
	if(!get_option('ols_wkt'))				{add_option('ols_wkt');}
	if(!get_option('ols_champ_wkt'))		{add_option('ols_champ_wkt');}
	if(!get_option('ols_url'))				{add_option('ols_url');}
	if(!get_option('ols_champ_url'))		{add_option('ols_champ_url');}
	if(!get_option('ols_proj'))				{add_option('ols_proj','3857');}
	if(!get_option('ols_center_long'))		{add_option('ols_center_long');}
	if(!get_option('ols_center_lat'))		{add_option('ols_center_lat');}
	if(!get_option('ols_pointradius'))		{add_option('ols_pointradius','5');}
	if(!get_option('ols_strokewidth'))		{add_option('ols_strokewidth','1');}
	if(!get_option('ols_strokecolor'))		{add_option('ols_strokecolor','#000000');}
	if(!get_option('ols_strokeopacity'))	{add_option('ols_strokeopacity','1');}
	if(!get_option('ols_fillcolor'))		{add_option('ols_fillcolor','#36b7d1');}
	if(!get_option('ols_fillopacity'))		{add_option('ols_fillopacity','1');}
	if(!get_option('ols_label'))			{add_option('ols_label');}
	if(!get_option('ols_champ_label'))		{add_option('ols_champ_label');}
	if(!get_option('ols_labeloffset'))		{add_option('ols_labeloffset','10');}
	if(!get_option('ols_fontweight'))		{add_option('ols_fontweight','bold');}
	if(!get_option('ols_fontsize'))			{add_option('ols_fontsize','12px');}
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////// HOOK UNINSTALL
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
register_uninstall_hook(__FILE__,'ols_uninstall');
function ols_uninstall() // To-do à la désinstallation du plugin (et non à la désactivation)
{
	delete_option('ols_id');
	delete_option('ols_debug');
	delete_option('ols_width');
	delete_option('ols_height');
	delete_option('ols_zoom');
	delete_option('ols_mode');
	delete_option('ols_tiles');
	delete_option('ols_tiles_url');
	delete_option('ols_tiles_key');
	delete_option('ols_tiles_layer');
	delete_option('ols_lat');
	delete_option('ols_champ_lat');
	delete_option('ols_long');
	delete_option('ols_champ_long');
	delete_option('ols_wkt');
	delete_option('ols_champ_wkt');
	delete_option('ols_url');
	delete_option('ols_champ_url');
	delete_option('ols_proj');
	delete_option('ols_center_long');
	delete_option('ols_center_lat');
	delete_option('ols_pointradius');
	delete_option('ols_strokewidth');
	delete_option('ols_strokecolor');
	delete_option('ols_strokeopacity');
	delete_option('ols_fillcolor');
	delete_option('ols_fillopacity');
	delete_option('ols_label');
	delete_option('ols_champ_label');
	delete_option('ols_labeloffset');
	delete_option('ols_fontweight');
	delete_option('ols_fontsize');
}
?>