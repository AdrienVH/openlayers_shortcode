<?php
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////// INTERFACE D'ADMINISTRATION
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
add_action('admin_menu','ols_add_menu');
function ols_add_menu()
{
	// Création d'un lien (avec logo) dans le menu de l'interface d'administration
	if(function_exists('add_menu_page'))
	{
 		add_menu_page('Paramètres de l\'extension Openlayers Shortcode','Op. Shortcode', 'publish_posts', 'reglages-openlayers-shortcode', 'ols_admin_page', plugins_url().'/openlayers_shortcode/img/logo.png');
	}
	// Génération du contenu de la page appelée, lorsqu'on clic sur le lien ajouté dans le menu de l'interface d'administration
	function ols_admin_page()
	{
		// TRAITEMENT
		if($_POST['ols_save'] != '')
		{
			// Modification des options dans la table wp_options (avec valeurs modifiées)
			if(get_option('ols_debug') != $_POST['ols_debug'])					{update_option('ols_debug',			$_POST['ols_debug']);} // To-do : test des variables ?
			if(get_option('ols_width') != $_POST['ols_width'])					{update_option('ols_width',			$_POST['ols_width']);}
			if(get_option('ols_height') != $_POST['ols_height'])				{update_option('ols_height',		$_POST['ols_height']);}
			if(get_option('ols_zoom') != $_POST['ols_zoom'])					{update_option('ols_zoom',			$_POST['ols_zoom']);}
			if(get_option('ols_mode') != $_POST['ols_mode'])					{update_option('ols_mode',			$_POST['ols_mode']);}
			if(get_option('ols_tiles') != $_POST['ols_tiles'])					{update_option('ols_tiles',			$_POST['ols_tiles']);}
			if(get_option('ols_tiles_url') != $_POST['ols_tiles_url'])			{update_option('ols_tiles_url',		$_POST['ols_tiles_url']);}
			if(get_option('ols_champ_lat') != $_POST['ols_champ_lat'])			{update_option('ols_champ_lat',		$_POST['ols_champ_lat']);}
			if(get_option('ols_champ_long') != $_POST['ols_champ_long'])		{update_option('ols_champ_long',	$_POST['ols_champ_long']);}
			if(get_option('ols_champ_wkt') != $_POST['ols_champ_wkt'])			{update_option('ols_champ_wkt',		$_POST['ols_champ_wkt']);}
			if(get_option('ols_champ_url') != $_POST['ols_champ_url'])			{update_option('ols_champ_url',		$_POST['ols_champ_url']);}
			if(get_option('ols_proj') != $_POST['ols_proj'])					{update_option('ols_proj',			$_POST['ols_proj']);}
			if(get_option('ols_center_long') != $_POST['ols_center_long'])		{update_option('ols_center_long',	$_POST['ols_center_long']);}
			if(get_option('ols_center_lat') != $_POST['ols_center_lat'])		{update_option('ols_center_lat',	$_POST['ols_center_lat']);}
			if(get_option('ols_pointradius') != $_POST['ols_pointradius'])		{update_option('ols_pointradius',	$_POST['ols_pointradius']);}
			if(get_option('ols_strokewidth') != $_POST['ols_strokewidth'])		{update_option('ols_strokewidth',	$_POST['ols_strokewidth']);}
			if(get_option('ols_strokecolor') != $_POST['ols_strokecolor'])		{update_option('ols_strokecolor',	$_POST['ols_strokecolor']);}
			if(get_option('ols_strokeopacity') != $_POST['ols_strokeopacity'])	{update_option('ols_strokeopacity',	$_POST['ols_strokeopacity']);}
			if(get_option('ols_fillcolor') != $_POST['ols_fillcolor'])			{update_option('ols_fillcolor',		$_POST['ols_fillcolor']);}
			if(get_option('ols_fillopacity') != $_POST['ols_fillopacity'])		{update_option('ols_fillopacity',	$_POST['ols_fillopacity']);}
			if(get_option('ols_label') != $_POST['ols_label'])					{update_option('ols_label',			$_POST['ols_label']);}
			if(get_option('ols_champ_label') != $_POST['ols_champ_label'])		{update_option('ols_champ_label',	$_POST['ols_champ_label']);}
			if(get_option('ols_labeloffset') != $_POST['ols_labeloffset'])		{update_option('ols_labeloffset',	$_POST['ols_labeloffset']);}
			if(get_option('ols_fontweight') != $_POST['ols_fontweight'])		{update_option('ols_fontweight',	$_POST['ols_fontweight']);}
			if(get_option('ols_fontsize') != $_POST['ols_fontsize'])			{update_option('ols_fontsize',		$_POST['ols_fontsize']);}
		}
		elseif($_POST['ols_reset'] != '')
		{
			//Suppression de toutes les options "ols_" de la table wp_options
			delete_option('ols_id');
			delete_option('ols_debug');
			delete_option('ols_width');
			delete_option('ols_height');
			delete_option('ols_zoom');
			delete_option('ols_mode');
			delete_option('ols_tiles');
			delete_option('ols_tiles_url');
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
			// Ajout des options dans la table wp_options avec leurs valeurs initiales
			if(!get_option('ols_id'))				{add_option('ols_id','1');}
			if(!get_option('ols_debug'))			{add_option('ols_debug','non');}
			if(!get_option('ols_width'))			{add_option('ols_width','100%');}
			if(!get_option('ols_height'))			{add_option('ols_height','400px');}
			if(!get_option('ols_zoom'))				{add_option('ols_zoom','15');}
			if(!get_option('ols_mode'))				{add_option('ols_mode','this');}
			if(!get_option('ols_tiles'))			{add_option('ols_tiles','mapquest');}
			if(!get_option('ols_tiles_url'))		{add_option('ols_tiles_url');}
			if(!get_option('ols_lat'))				{add_option('ols_lat');}
			if(!get_option('ols_champ_lat'))		{add_option('ols_champ_lat');}
			if(!get_option('ols_long'))				{add_option('ols_long');}
			if(!get_option('ols_champ_long'))		{add_option('ols_champ_long');}
			if(!get_option('ols_wkt'))				{add_option('ols_wkt');}
			if(!get_option('ols_champ_wkt'))		{add_option('ols_champ_wkt');}
			if(!get_option('ols_url'))				{add_option('ols_wkt');}
			if(!get_option('ols_champ_url'))		{add_option('ols_champ_wkt');}
			if(!get_option('ols_proj'))				{add_option('ols_proj');}
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
		// AFFICHAGE
		echo '<div class="wrap columns-2 dd-wrap">';
		echo '<div id="icon-options-general" class="icon32 icon32-posts-page"><br /></div>';
		echo '<h2>Openlayers Shortcode - Paramètres de l\'extension (valeurs par défaut)</h2>';
		echo '<div id="poststuff" class="metabox-holder has-right-sidebar">'; // Bloc contenant les deux colonnes
			echo '<div id="side-info-column" class="inner-sidebar">'; // Colonne sidebar de droite
				echo '<div class="postbox">'; // Bloc "Extension"
					echo '<h3>Extension</h3>';
					echo '<div class="inside">';
						echo '<p>Nom : <a href="http://blog.adrienvh.fr/plugin-wordpress-openlayers-shortcode/" target="_blank">Openlayers Shortcode</a></p>';
						echo '<p>Shortcode lié : [openlayers attr="val"]</p>';
						echo '<p>Version : <a href="http://labs.adrienvh.fr/openlayers_shortcode/openlayers_shortcode.1.2.2.zip">1.2.2</a> (31/07/2012)</p>';
						echo '<p>Librairies JS : <a href="http://openlayers.org/" target="_blank">Openlayers</a> (2.12) + <a href="http://mapbox.com/wax/" target="_blank">Wax</a> (6.4.0)</p>';
					echo '</div>';
				echo '</div>';
				echo '<div class="postbox">'; // Bloc "Auteur"
					echo '<h3>Auteur</h3>';
					echo '<div class="inside">';
						echo '<img src="'.plugins_url().'/openlayers_shortcode/img/avatar.jpg" alt="Avatar" style="float:left;margin:0 10px 0 0;" />';
						echo '<p><a href="http://adrienvh.fr" target="_blank">Adrien VAN HAMME</a></p>';
						echo '<p>Mail : <a href="mailto:contact@adrienvh.fr">contact@adrienvh.fr</a></p>';
						echo '<div class="clear"></div>';
						echo '<p>Twitter : <a href="http://twitter.com/adrienvh" target="_blank">adrienvh</a></p>';
						echo '<p>Facebook : <a href="http://facebook.com/adrienvh" target="_blank">adrienvh</a></p>';
					echo '</div>';
				echo '</div>';
				echo '<div class="postbox">'; // Bloc "Attributs modifiables"
					echo '<h3>Attributs modifiables</h3>';
					echo '<div class="inside">';
						echo '<ul>';
							echo '<li class="no">id</li>';
							echo '<li>debug</li>';
							echo '<li>width</li>';
							echo '<li>height</li>';
							echo '<li>zoom</li>';
							echo '<li>mode</li>';
							echo '<li>tiles</li>';
							echo '<li class="no">lat</li>';
							echo '<li>champ_lat</li>';
							echo '<li class="no">long</li>';
							echo '<li>champ_long</li>';
							echo '<li class="no">wkt</li>';
							echo '<li>champ_wkt</li>';
							echo '<li class="no">url</li>';
							echo '<li>champ_url</li>';
							echo '<li>proj</li>';
							echo '<li>center_long</li>';
							echo '<li>center_lat</li>';
							echo '<li>pointradius</li>';
							echo '<li>strokewidth</li>';
							echo '<li>strokecolor</li>';
							echo '<li>strokeopacity</li>';
							echo '<li>fillcolor</li>';
							echo '<li>fillopacity</li>';
							echo '<li>label</li>';
							echo '<li>champ_label</li>';
							echo '<li>labeloffset</li>';
							echo '<li>fontweight</li>';
							echo '<li>fontsize</li>';
						echo '</ul>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
			echo '<div id="post-body">'; // Colonne contenu de gauche
				echo '<div id="post-body-content">';
					echo '<form method="post">';
						echo '<div class="stuffbox">'; // Bloc "Configuration générale de la carte"
							echo '<h3>Configuration générale de la carte</h3>';
							echo '<div class="inside">';
								echo '<table class="form-table">';
									echo '<tr valign="top">'; // Ligne "Largeur de la carte - width"
										echo '<th scope="row">Largeur de la carte<br /><b>width</b></th>';
										echo '<td>';
											echo '<input type="text" value="'.get_option('ols_width').'" name="ols_width" />';
											echo '<p>- valeur initiale : 100%<br />- valeurs acceptées : notations css en px ou en %</p>';
										echo '</td>';
									echo '</tr>';
									echo '<tr valign="top">'; // Ligne "Hauteur de la carte - height"
										echo '<th scope="row">Hauteur de la carte<br /><b>height</b></th>';
										echo '<td>';
											echo '<input type="text" value="'.get_option('ols_height').'" name="ols_height" />';
											echo '<p>- valeur initiale : 400px<br />- valeurs acceptées : notations css en px ou en %</p>';
										echo '</td>';
									echo '</tr>';
									echo '<tr valign="top">'; // Ligne "Source de donnée - mode"
										echo '<th scope="row">Source de donnée<br /><b>mode</b></th>';
										echo '<td>';
											echo '<select name="ols_mode">';
												$vals = array('this','posts','pages','all');
												foreach($vals as $val)
												{
													if($val == get_option('ols_mode'))
														echo '<option value="'.$val.'" selected="selected">'.$val.'</option>';
													else
														echo '<option value="'.$val.'">'.$val.'</option>';
												}
											echo '</select>';
											echo '<p>- valeur initiale : this</p>';
										echo '</td>';
									echo '</tr>';
									echo '<tr valign="top">'; // Ligne "Fond de carte - tiles"
										echo '<th scope="row">Fond de carte<br /><b>tiles</b></th>';
										echo '<td>';
											echo '<select name="ols_tiles">';
												$vals = array('mapquest','mapquest_aerial','osm','mapbox');
												foreach($vals as $val)
												{
													if($val == get_option('ols_tiles'))
														echo '<option value="'.$val.'" selected="selected">'.$val.'</option>';
													else
														echo '<option value="'.$val.'">'.$val.'</option>';
												}
											echo '</select>';
											echo '<p>- valeur initiale : mapquest</p>';
										echo '</td>';
									echo '</tr>';
									echo '<tr valign="top">';
										echo '<th scope="row">Adresse URL du fond de carte <br /><b>tiles_url</b></th>';
										echo '<td>';
											echo '<input type="text" value="'.get_option('ols_tiles_url').'" name="ols_tiles_url" />';
											echo '<p>- pas de valeur initiale</p>';
										echo '</td>';
									echo '</tr>';
									echo '<tr valign="top">'; // Ligne "Mode debug - debug"
										echo '<th scope="row">Mode debug<br /><b>debug</b></th>';
										echo '<td>';
											echo '<select name="ols_debug">';
												$vals = array('non','oui');
												foreach($vals as $val)
												{
													if($val == get_option('ols_debug'))
														echo '<option value="'.$val.'" selected="selected">'.$val.'</option>';
													else
														echo '<option value="'.$val.'">'.$val.'</option>';
												}
											echo '</select>';
											echo '<p>- valeur initiale : non</p>';
										echo '</td>';
									echo '</tr>';
								echo '</table>';
								echo '<div class="submit">';
									echo '<input class="button-primary" name="ols_save" value="Enregistrer comme valeurs par défaut" type="submit" />';
								echo '</div>';
							echo '</div>';
						echo '</div>';
						echo '<div class="stuffbox">'; // Bloc "Valeurs concernant le centre de la carte"
							echo '<h3>Valeurs concernant le centre de la carte</h3>
							<div class="inside">
								<table class="form-table">
									<tr valign="top">
										<th scope="row">Longitude du centre de la carte<br /><b>center_long</b></th>
										<td>
											<input type="text" value="'.get_option('ols_center_long').'" name="ols_center_long" />
											<p>- pas de valeur initiale<br />- valeurs acceptées : nombre avec le point (.) comme séparateur décimal (EPSG:4326)</p>
										</td>
									</tr>
									<tr valign="top">
										<th scope="row">Latitude du centre de la carte<br /><b>center_lat</b></th>
										<td>
											<input type="text" value="'.get_option('ols_center_lat').'" name="ols_center_lat" />
											<p>- pas de valeur initiale<br />- valeurs acceptées : nombre avec le point (.) comme séparateur décimal (EPSG:4326)</p>
										</td>
									</tr>
									<tr valign="top">
										<th scope="row">Niveau de zoom de la carte<br /><b>zoom</b></th>
										<td>
											<input type="text" value="'.get_option('ols_zoom').'" name="ols_zoom" />
											<p>- valeur initiale : 15<br />- valeurs acceptées : nombre entier compris entre 1 et 17</p>
										</td>
									</tr>
								</table>
								<div class="submit">
									<input class="button-primary" name="ols_save" value="Enregistrer comme valeurs par défaut" type="submit" />
								</div>
							</div>
						</div>';
						echo '<div class="stuffbox">'; // Bloc "Valeurs concernant les figurés et leur sémiologie"
							echo '<h3>Valeurs concernant les figurés et leur sémiologie</h3>
							<div class="inside">
								<table class="form-table">
									<tr valign="top">
										<th scope="row">Champ utilisé pour la longitude<br /><b>champ_long</b></th>
									<tr valign="top">
										<th scope="row">Champ utilisé pour la latitude<br /><b>champ_lat</b></th>
										<td>
											<input type="text" value="'.get_option('ols_champ_lat').'" name="ols_champ_lat" />
											<p>- pas de valeur initiale</p>
										</td>
									</tr>
										<td>
											<input type="text" value="'.get_option('ols_champ_long').'" name="ols_champ_long" />
											<p>- pas de valeur initiale</p>
										</td>
									</tr>
									<tr valign="top">
										<th scope="row">Champ utilisé pour la notation WKT<br /><b>champ_wkt</b></th>
										<td>
											<input type="text" value="'.get_option('ols_champ_wkt').'" name="ols_champ_wkt" />
											<p>- pas de valeur initiale</p>
										</td>
									</tr>
									<tr valign="top">
										<th scope="row">Champ utilisé pour l\'URL de fichiers à charger<br /><b>champ_url</b></th>
										<td>
											<input type="text" value="'.get_option('ols_champ_url').'" name="ols_champ_url" />
											<p>- pas de valeur initiale</p>
										</td>
									</tr>
									<tr valign="top">
										<th scope="row">Projection des données source<br /><b>proj</b></th>
										<td>
											<input type="text" value="'.get_option('ols_proj').'" name="ols_proj" />
											<p>- pas de valeur initiale<br />- valeurs acceptées : code EPSG d\'une projection</p>
										</td>
									</tr>
									<tr valign="top">
										<th scope="row">Rayon des points<br /><b>pointradius</b></th>
										<td>
											<input type="text" value="'.get_option('ols_pointradius').'" name="ols_pointradius" />
											<p>- valeur initiale : 5<br />- valeurs acceptées : nombre entier (en px)</p>
										</td>
									</tr>
									<tr valign="top">
										<th scope="row">Epaisseur du contour des points<br />Epaisseur du contour des polygones<br />Epaisseur des lignes<br /><b>strokewidth</b></th>
										<td>
											<input type="text" value="'.get_option('ols_strokewidth').'" name="ols_strokewidth" />
											<p>- valeur initiale : 1<br />- valeurs acceptées : nombre entier (en px)</p>
										</td>
									</tr>
									<tr valign="top">
										<th scope="row">Couleur du contour des points<br />Couleur du contour des polygones<br /> Couleur des lignes<br /><b>strokecolor</b></th>
										<td>
											<input type="text" value="'.get_option('ols_strokecolor').'" name="ols_strokecolor" />
											<p>- valeur initiale : #000000<br />- valeurs acceptées : notations css en héx., en rgb, ...</p>
										</td>
									</tr>
									<tr valign="top">
										<th scope="row">Opacité du contour des points<br />Opacité du contour des polygones<br />Opacité des lignes<br /><b>strokeopacity</b></th>
										<td>
											<input type="text" value="'.get_option('ols_strokeopacity').'" name="ols_strokeopacity" />
											<p>- valeur initiale : 1<br />- valeurs acceptées : nombre entier (en px)</p>
										</td>
									</tr>
									<tr valign="top">
										<th scope="row">Couleur de remplissage des points<br />Couleur de remplissage des polyg.<br /><b>fillcolor</b></th>
										<td>
											<input type="text" value="'.get_option('ols_fillcolor').'" name="ols_fillcolor" />
											<p>- valeur initiale : #36b7d1<br />- valeurs acceptées : notations css en héx., en rgb, ...</p>
										</td>
									</tr>
									<tr valign="top">
										<th scope="row">Opacité du remplissage des points<br />Opacité du remplissage des polyg.<br /><b>fillopacity</b></th>
										<td>
											<input type="text" value="'.get_option('ols_fillopacity').'" name="ols_fillopacity" />
											<p>- valeur initiale : 1<br />- valeurs acceptées : nombre entier (en px)</p>
										</td>
									</tr>
								</table>
								<div class="submit">
									<input class="button-primary" name="ols_save" value="Enregistrer comme valeurs par défaut" type="submit" />
								</div>
							</div>
						</div>';
						echo '<div class="stuffbox">'; // Bloc "Valeurs concernant les étiquettes (label)"
							echo '<h3>Valeurs concernant les étiquettes (label)</h3>';
							echo '<div class="inside">';
								echo '<table class="form-table">';
									echo '<tr valign="top">'; // Ligne "Texte des étiquettes - label"
										echo '<th scope="row">Texte des étiquettes<br /><b>label</b></th>';
										echo '<td>';
											echo '<input type="text" value="'.get_option('ols_label').'" name="ols_label" />';
											echo '<p>- pas de valeur initiale</p>';
										echo '</td>';
									echo '</tr>';
									echo '<tr valign="top">'; // Ligne "Champ utilisé pour ces étiquettes - champ_label"
										echo '<th scope="row">Champ utilisé pour ces étiquettes<br /><b>champ_label</b></th>';
										echo '<td>';
											echo '<input type="text" value="'.get_option('ols_champ_label').'" name="ols_champ_label" />';
											echo '<p>- pas de valeur initiale</p>';
										echo '</td>';
									echo '</tr>';
									echo '<tr valign="top">'; // Ligne "Décalage à droite des étiquettes - labeloffset"
										echo '<th scope="row">Décalage à droite des étiquettes<br /><b>labeloffset</b></th>';
										echo '<td>';
											echo '<input type="text" value="'.get_option('ols_labeloffset').'" name="ols_labeloffset" />';
											echo '<p>- valeur initiale : 10<br />- valeurs acceptées : nombre entier (en px)</p>';
										echo '</td>';
									echo '</tr>';
									echo '<tr valign="top">'; // Ligne "Graisse de la police des étiquettes - fontweight"
										echo '<th scope="row">Graisse de la police des étiquettes<br /><b>fontweight</b></th>';
										echo '<td>';
											echo '<select name="ols_fontweight">';
												$vals = array('bold','normal');
												foreach($vals as $val)
												{
													if($val == get_option('ols_fontweight'))
														echo '<option value="'.$val.'" selected="selected">'.$val.'</option>';
													else
														echo '<option value="'.$val.'">'.$val.'</option>';
												}
											echo '</select>';
											echo '<p>- valeur initiale : bold</p>';
										echo '</td>';
									echo '</tr>';
									echo '<tr valign="top">'; // Ligne "Taille de police des étiquettes - fontsize"
										echo '<th scope="row">Taille de la police des étiquettes<br /><b>fontsize</b></th>';
										echo '<td>';
											echo '<input type="text" value="'.get_option('ols_fontsize').'" name="ols_fontsize" />';
											echo '<p>- valeur initiale : 12px<br />- valeurs acceptées : notations css en px</p>';
										echo '</td>';
									echo '</tr>';
								echo '</table>';
								echo '<div class="submit">';
									echo '<input class="button-primary" name="ols_save" value="Enregistrer comme valeurs par défaut" type="submit" />';
								echo '</div>';
							echo '</div>';
						echo '</div>';
					echo '</form>';
					echo '<div class="stuffbox">'; // Bloc "Remettre toutes les valeurs initiales par défaut"
						echo '<h3>Remettre toutes les valeurs initiales par défaut</h3>';
						echo '<div class="inside">';
							echo '<p>Vous avez ici la possibilité de réinitialiser toutes les valeurs par défaut du plugin. Cela aura pour effet de tout remettre comme si vous veniez tout juste d\'installer ce plugin...</p>';
							echo '<p><span style="color:red;">ATTENTION !</span><br />Cette action écrasera toutes les modifications que vous auriez effectuées sur ces valeurs par défaut depuis l\'activation du plugin.<br />Vous n\'aurez pas la possibilité d\'annuler cette action.</p>';
							echo '<form method="post">';
								echo '<div class="submit">';
									echo '<input class="button-primary" name="ols_reset" value="Remettre toutes les valeurs initiales par défaut" type="submit" />';
								echo '</div>';
							echo '</form>';
						echo '</div>';
					echo '</div>';
				echo '</div>'; // Fin colonne contenu de gauche (content)
			echo '</div>'; // Fin colonne contenu de gauche
		echo '</div>'; // Fin bloc wrap des deux colonnes
		echo '<style>@import url("'.$path.'/css/admin.css");</style>';
	}
}
?>