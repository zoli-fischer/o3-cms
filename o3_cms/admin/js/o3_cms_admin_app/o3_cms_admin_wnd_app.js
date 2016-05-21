/*
* O3 CMS wnd handler
*/
function o3CMSAdminWndApp( opts ) {
	var self = this,
		$ = jQuery;

	//options
	self.opts = $.extend( {
		parent: null
	}, opts );

	//set parent
	self.parent = function() { return self.opts.parent; };

	//window title
	self.title = ko.observable(document.title);

};