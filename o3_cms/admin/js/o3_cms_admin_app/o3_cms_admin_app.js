/*
* O3 CMS main controller
*/
function o3CMSAdminApp() {
	var self = this,
		$ = jQuery;

	//window handler
	self.wnd = new o3CMSAdminWndApp( { parent: self } );

	//website content handler
	self.content = new o3CMSAdminContentApp( { parent: self } );

	//flag to show/hide left menu
	self.leftmenu = ko.observable( false );

	//constructor
	+function() {

		//load content
		self.content.load();

	}();

};