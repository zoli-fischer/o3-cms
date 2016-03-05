<?php

class o3_cms_view_topbar extends o3_cms_admin_template_view_controller {

	/*
	* Get list of languages
	*/
	public function languages() {		
		$languages = $this->o3->lang->languages();	
		//add language change url to the array
		foreach ( $languages as $key => $value )
			$languages[$key]['url'] = O3_CMS_ADMIN_URL.'?o3-cms-admin-lang='.$value['index'];		
		return $languages;		
	}

}

?>