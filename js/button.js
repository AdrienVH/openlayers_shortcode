tinymce.create('tinymce.plugins.openlayers',
{
	init:function(ed,url)
	{
		ed.addButton('openlayers',
		{
			title:'Ajouter une carte Openlayers',
			image:url+'/../img/logo.png',
			onclick:function()
			{
				ed.selection.setContent('[openlayers attribut="valeur"]');
			}
		})
	},
	createControl:function(n,cn)
	{
		return null;
	}
});
tinymce.PluginManager.add('openlayers',tinymce.plugins.openlayers);