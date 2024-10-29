<?php
/*
 * @link http://www.girltm.com/
 * @since 1.0.0
 * @package APOYL_AIARTICLE
 * @subpackage APOYL_AIARTICLE/admin
 * @author 凹凸曼 <jar-c@163.com>
 *
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
class Apoyl_Aiarticle_Admin
{

    private $plugin_name;

    private $version;

    public function __construct($plugin_name, $version)
    {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    public function enqueue_styles()
    {
        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/admin.css', array(), $this->version, 'all');
    }

    public function enqueue_scripts()
    {
        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/admin.js', array(
            'jquery'
        ), $this->version, false);
    }

    public function links($alinks)
    {
        $links[] = '<a href="' . esc_url(get_admin_url(null, 'options-general.php?page=apoyl-aiarticle-settings')) . '">' . __('settingsname', 'apoyl-aiarticle') . '</a>';
        $alinks = array_merge($links, $alinks);
        
        return $alinks;
    }

    public function menu()
    {
        add_options_page(__('AI-generated articles', 'apoyl-aiarticle'), __('AI-generated articles', 'apoyl-aiarticle'), 'manage_options', 'apoyl-aiarticle-settings', array(
            $this,
            'settings_page'
        ));
    }

    public function settings_page()
    {
        global $wpdb;
        $options_name = 'apoyl-aiarticle-settings';
        isset($_GET['do'])?$do = sanitize_text_field($_GET['do']):$do='';
        if ($do == 'list') {
            require_once plugin_dir_path(__FILE__) . 'partials/list.php';
        } else {
            require_once plugin_dir_path(__FILE__) . 'partials/setting.php';
        }
    }

    public function post_editor_meta_box()
    {
        $options_name = 'apoyl-aiarticle-settings';
        $arr = get_option($options_name);
        if ($arr['open'])
            add_meta_box('apoyl-aiarticle-editor-url', __('editor-url-title', 'apoyl-aiarticle'), array(
                $this,
                'editor_url'
            ), 'post');
    }
    public function editor_url()
    {
        require_once plugin_dir_path(__FILE__) . 'partials/editorsetting.php';
    }
    public function apoyl_aiarticle_ajax()
    {
        $options_name = 'apoyl-aiarticle-settings';
        $arr = get_option($options_name);

        if (isset($_POST['apoyl-aiarticle-wpnonce']) && wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['apoyl-aiarticle-wpnonce'])),'apoyl-aiarticle-ajax')) {
            $title = sanitize_text_field($_POST['apoyl_aiarticle_title']);
            require_once APOYL_AIARTICLE_DIR . 'api/baidu.php';
            $baidu = new Apoyl_Aiarticle_Baidu();
            $res = $baidu->run($arr, $title);
            if ($res->result)
                $content = $res->result;
            $error_msg = '';
            $error_open = 0;
            if ($res->error_msg) {
                $error_open = 1;
                $error_msg = $res->error_msg;
            }
            if ($title || $content) {
                echo wp_json_encode(array(
                    'post_title' => esc_attr($title),
                    'content' => wp_kses_post($content),
                    'error_open'=>$error_open,
                    'error_msg'=>esc_attr($error_msg)
                ));
                exit();
            }
        }

     
    }


}
