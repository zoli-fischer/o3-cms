<?php

//Require payment class
require_once(O3_CMS_THEME_DIR.'/classes/snafer_payment.php');

class o3_cms_template_view_render_pdf_invoice extends o3_cms_template_view_controller {

	protected $payment = null;

	public function init() {
		$args = func_get_args();

		//parent init
		parent::init( func_get_args() );

		$md5 = substr( $args[0], 0, 32 );
		$id = substr( $args[0], 32, 10 );

		$this->payment = new snafer_payment( $id );
		
	}

	public function title() {
		return 'invoice-'.preg_replace( "/[^0-9]/", "-", $this->payment->display_date() ).'-'.$this->payment->get('username');
	} 

	public function address() {
		$lines = array();
		$lines[] = ucfirst(strtolower(o3_html($this->payment->get('bil_name'))));
		if ( $this->payment->show_vat() && strlen($this->payment->get('bil_vat')) > 0 )
			$lines[] = o3_html($this->payment->get('bil_vat'));	
		$lines[] = o3_html($this->payment->get('bil_address'));
		$lines[] = o3_html($this->payment->get('bil_zip').' '.$this->payment->get('bil_city'));
		$lines[] = ucfirst(strtolower(o3_html($this->payment->get('bil_country'))));
		return implode("<br>", $lines);
	}

	

}

?>