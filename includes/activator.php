<?php

/*
 * @link http://www.girltm.com/
 * @since 1.0.0
 * @package APOYL_AIARTICLE
 * @subpackage APOYL_AIARTICLE/includes
 * @author 凹凸曼 <jar-c@163.com>
 *
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
class Apoyl_Aiarticle_Activator
{

    public static function activate()
    {
        $options_name = 'apoyl-aiarticle-settings';
        $arr_options = array(
            'open' => 1,
            'apikey' => '',
            'secretkey' => '',
            'openrewrite' => 0,
            'openpolish' => 0,
            'openllm'=>0,
            'openaiapikey' => '',


        );
        add_option($options_name, $arr_options);
    }

    public static function install_db()
    {
        global $wpdb;
        $sql='';
        $apoyl_aiarticle_db_version = APOYL_AIARTICLE_VERSION;
        $tablename = $wpdb->prefix . 'apoyl_aiarticle';
        $ishave = $wpdb->get_var($wpdb->prepare("SHOW TABLES LIKE %s", $wpdb->esc_like($tablename)));

        if ($tablename != $ishave) {
            $sql = "CREATE TABLE " . $tablename . " (
                      `id`	bigint(20) unsigned  NOT NULL AUTO_INCREMENT,
                      `user_id` bigint(20) unsigned NOT NULL DEFAULT '0',
                      `message` text NOT NULL,
                      `addtime` int(10) NOT NULL default '0',
                      PRIMARY KEY (`id`),
                      KEY `user_id` (`user_id`)
                    );";
        }
        if($sql) {
            include_once ABSPATH . 'wp-admin/includes/upgrade.php';
            dbDelta($sql);
        }

        add_option('apoyl_aiarticle_db_version', $apoyl_aiarticle_db_version);
    }
}
?>