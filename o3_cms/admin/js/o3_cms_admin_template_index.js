jQuery(document).ready(function(){


	//todo only test
	jQuery("#o3-cms-frame iframe").load(function(){
		document.title = jQuery(this)[0].contentWindow.document.title;
	});

});