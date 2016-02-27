<?php

class o3_cms_admin_template_admin extends o3_cms_admin_template_controller {

	//on init
	public function init() {	

		//parent init
		parent::init( func_get_args() );

		//set title
		$this->page_title = $this->o3->lang->_('o3-cms-sign-in');		

		//check for logout
		if ( isset($_GET['o3-cms-admin-logout']) ) {

			//log out user
			$this->o3_cms->logged_user()->set_logged_out();
			
			//reload admin page
			o3_redirect(O3_CMS_ADMIN_URL);
		}		

		//check for language change
		if ( isset($_GET['o3-cms-admin-lang']) ) {
			$new_lang = o3_get('o3-cms-admin-lang');
			$languages = $this->languages();
			if ( isset($languages[$new_lang]) ) {
				o3_cookie('o3-cms-admin-lang',$new_lang);
			}

			//set new lang cookie
			$this->update_lang_cookie( $new_lang );

			//reload admin page
			o3_redirect(O3_CMS_ADMIN_URL);
		}
		
		//update lang cookie expire time
		$this->update_lang_cookie( $this->o3->lang->current );		

		//if user logged send to frontpage
		if ( $this->o3_cms->logged_user()->is_logged() ) {
			o3_redirect('/');
		}
	}

	/*
	* Update language cookie expire time
	*/
	public function update_lang_cookie( $value ) {
		o3_unset_cookie('o3-cms-admin-lang');
		o3_set_cookie('o3-cms-admin-lang', $value, 30 * 24 * 3600);
	}

	/*
	* Get current language index
	*/
	public function current_lang() {		
		return $this->o3->lang->current;		
	}

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

	/*
	* Ajax call handler for login
	*/
	public function ajax_login() {

		$username = $this->ajax_result->value('username');
		$password = $this->ajax_result->value('password');

		if ( $this->o3_cms->logged_user()->is_logged() )
			;//todo logout user

		if ( $this->o3_cms->logged_user()->set_logged( $username, $password ) ) {
			$this->ajax_result->redirect('/');
		} else {
			$this->ajax_result->error();
		}
	}


}

?>