<?php
/*
 * @link       http://www.girltm.com/
 * @since      1.0.0
 * @package    APOYL_AIARTICLE
 * @subpackage APOYL_AIARTICLE/includes
 * @author     凹凸曼 <jar-c@163.com>
 *
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
class Apoyl_Aiarticle_i18n {


	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'apoyl-aiarticle',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
?>