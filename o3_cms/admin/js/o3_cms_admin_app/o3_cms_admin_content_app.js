/*
* O3 CMS wnd handler
*/
function o3CMSAdminContentApp( opts ) {
	var self = this,
		$ = jQuery;

	//options
	self.opts = $.extend( {
		parent: null
	}, opts );

	//set parent
	self.parent = function() { return self.opts.parent; };

	//pointer to iframe jQuery object
	self.$ = jQuery("#o3-cms-frame iframe");

	//on content load
	self.onload = function(event) {
		//when iframe loaded set window title
		self.parent().wnd.title( jQuery(this)[0].contentWindow.document.title );		
	};

	//load content
	self.load = function() {
		//load page into iframe 
		self.$.load(self.onload);
		self.$.attr('src',o3_param2url(window.location.toString(),'o3_cms_ignore_admin'));
	};

};