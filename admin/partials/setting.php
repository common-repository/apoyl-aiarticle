<?php
/*
 * @link http://www.girltm.com
 * @since 1.0.0
 * @package APOYL_AIARTICLE
 * @subpackage APOYL_AIARTICLE/admin/partials
 * @author 凹凸曼 <jar-c@163.com>
 *
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if (isset($_POST['apoyl-aiarticle-wpnonce']) && check_admin_referer($options_name, 'apoyl-aiarticle-wpnonce')) {

        $arr_options = array(
        	'open'=>isset ( $_POST ['open'] ) ? ( int ) sanitize_key ( $_POST ['open'] ) :  0,
            'apikey' => sanitize_text_field($_POST['apikey']),
            'secretkey' => sanitize_text_field($_POST['secretkey']),
            'openrewrite'=>isset ( $_POST ['openrewrite'] ) ? ( int ) sanitize_key ( $_POST ['openrewrite'] ) :  0,
            'openpolish'=>isset ( $_POST ['openpolish'] ) ? ( int ) sanitize_key ( $_POST ['openpolish'] ) :  0,
            'openllm'=>isset ( $_POST ['openllm'] ) ? ( int ) sanitize_key ( $_POST ['openllm'] ) :  0,
            'openaiapikey' => sanitize_text_field($_POST['openaiapikey']),
        );
   
        $updateflag = update_option($options_name, $arr_options);
        $updateflag = true;
    }
    $arr = get_option($options_name);

    
    ?>
    <?php if( !empty( $updateflag ) ) { echo '<div id="message" class="updated fade"><p>' . esc_html__('updatesuccess','apoyl-aiarticle') . '</p></div>'; } ?>
    
    <div class="wrap">
    
<?php   require_once APOYL_AIARTICLE_DIR . 'admin/partials/nav.php';?>
    </p>
    	<form
    		action="<?php echo esc_url(admin_url('options-general.php?page=apoyl-aiarticle-settings'));?>"
    		name="settings-apoyl-aiarticle" method="post">
    		<table class="form-table">
    			<tbody>
    				<tr>
    					<th><label><?php esc_html_e('open','apoyl-aiarticle'); ?></label></th>
    					<td><input type="checkbox" class="regular-text"
    						value="1" id="open" name="open" <?php checked( '1', $arr['open'] ); ?> >
    					<?php esc_html_e('open_desc','apoyl-aiarticle'); ?>
    					</td>
    				</tr>
                    <tr>
                        <th><label><?php _e('Model','apoyl-aiarticle'); ?></label></th>
                        <td><input type="radio" class="regular-text"
                                   value="1" id="openllm" name="openllm" <?php if(isset($arr['openllm'])) checked( '1', $arr['openllm'] ); ?> ><?php _e('ERNIE-4.0-Turbo-8K','apoyl-aiarticle'); ?>
                            <input type="radio" class="regular-text" value="2" id="openllm" name="openllm" <?php if(isset($arr['openllm']))  checked( '2', $arr['openllm'] ); ?> ><?php _e('GPT-3.5-turbo','apoyl-aiarticle'); ?>
                            <input type="radio" class="regular-text" value="3" id="openllm" name="openllm" <?php if(isset($arr['openllm']))  checked( '3', $arr['openllm'] ); ?> ><?php _e('GPT-4-turbo','apoyl-aiarticle'); ?>
                            <input type="radio" class="regular-text" value="4" id="openllm" name="openllm" <?php if(isset($arr['openllm']))  checked( '4', $arr['openllm'] ); ?> ><?php _e('GPT-4o','apoyl-aiarticle'); ?>

                            <p><strong><?php _e('calldev_desc','apoyl-aiarticle'); ?></strong></p>
                        </td>
                    </tr>
  					<tr>
                    <th><label><?php esc_html_e('apikey','apoyl-aiarticle'); ?></label></th>
                    <td><input type="text" class="regular-text" value="<?php echo esc_attr($arr['apikey']); ?>" id="apikey" name="apikey">
                    <p class="description"><?php esc_html_e('apikey_desc','apoyl-aiarticle'); ?></p>
                    </td>
                	</tr>
                	
                	<tr>
                    <th><label><?php esc_html_e('secretkey','apoyl-aiarticle'); ?></label></th>
                    <td><input type="text" class="regular-text" value="<?php echo esc_attr($arr['secretkey']); ?>" id="secretkey" name="secretkey">
                    <p class="description"><?php esc_html_e('secretkey_desc','apoyl-aiarticle'); ?></p>
                    </td>
                	</tr>
                    <tr>
                        <th><label><?php _e('OpenAI Key','apoyl-aiarticle'); ?></label></th>
                        <td><input type="text" class="regular-text" value="<?php if(isset($arr['openaiapikey'])) echo esc_attr($arr['openaiapikey']); ?>" id="openaiapikey" name="openaiapikey">
                            <p class="description"><?php _e('Please apply for OpenAI Key by yourself Application address: https://platform.openai.com/account/api-keys','apoyl-aiarticle'); ?></p>
                        </td>
                    </tr>
                    <tr>
                        <th><label><?php esc_html_e('openrewrite','apoyl-aiarticle'); ?></label></th>
                        <td><input type="checkbox" class="regular-text"
                                   value="1" id="openrewrite" name="openrewrite" <?php checked( '1', $arr['openrewrite'] ); ?> >
                            <?php esc_html_e('rewrite_desc','apoyl-aiarticle'); ?>--<strong><?php _e('calldev_desc','apoyl-aiarticle'); ?></strong>
                        </td>
                    </tr>
                    <tr>
                        <th><label><?php esc_html_e('openpolish','apoyl-aiarticle'); ?></label></th>
                        <td><input type="checkbox" class="regular-text"
                                   value="1" id="openpolish" name="openpolish" <?php checked( '1', $arr['openpolish'] ); ?> >
                            <?php esc_html_e('polish_desc','apoyl-aiarticle'); ?>--<strong><?php _e('calldev_desc','apoyl-aiarticle'); ?></strong>
                        </td>
                    </tr>
    			</tbody>
    		</table>
                <?php
                wp_nonce_field("apoyl-aiarticle-settings","apoyl-aiarticle-wpnonce");
                submit_button();
                ?>
               
    </form>
    </div>