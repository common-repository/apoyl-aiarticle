<?php
/*
 * Plugin Name: apoyl-aiarticle
 * Plugin URI:  http://www.girltm.com/
 * Description: 基于百度大模型ERNIE-4.0-、GPT-3.5、GPT-4，通过prompt一句话标题描述智能创造一篇高质量的文章，可智能生成文章、AI一键改写内容、AI一键润色内容，为管理者提供大量参考内容。
 * Version:     1.5.0
 * Author:      凹凸曼
 * Author URI:  http://www.girltm.com/
 * License:     GPL-2.0+
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: apoyl-aiarticle
 * Domain Path: /languages
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
define('APOYL_AIARTICLE_VERSION','1.5.0');
define('APOYL_AIARTICLE_PREFIX','apoyl_aiarticle');
define('APOYL_AIARTICLE_FILE',plugin_basename(__FILE__));
define('APOYL_AIARTICLE_URL',plugin_dir_url( __FILE__ ));
define('APOYL_AIARTICLE_DIR',plugin_dir_path( __FILE__ ));

function apoyl_aiarticle_activate(){
    require plugin_dir_path(__FILE__).'includes/activator.php';
    Apoyl_Aiarticle_Activator::activate();
    Apoyl_Aiarticle_Activator::install_db();
}
register_activation_hook(__FILE__, 'apoyl_aiarticle_activate');


require plugin_dir_path(__FILE__).'includes/aiarticle.php';

function apoyl_aiarticle_file($filename)
{
    $file = WP_PLUGIN_DIR . '/apoyl-common/v1/apoyl-aiarticle/components/' . $filename . '.php';
    if (file_exists($file))
        return $file;
    return '';
}
function apoyl_aiarticle_run(){
    $plugin=new APOYL_AIARTICLE();
    $plugin->run();
}
apoyl_aiarticle_run();
?>