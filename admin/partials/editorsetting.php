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
$ajaxurl = admin_url('admin-ajax.php');
$rewritefile = apoyl_aiarticle_file('rewrite');
$polishfile = apoyl_aiarticle_file('polish');

?>
<form
	action="<?php echo esc_url(admin_url('admin-ajax.php?page=apoyl-aiarticle-settings'));?>"
	name="apoyl-aiarticle-form" method="post">
	<input type="text" class="regular-text" value=""
		id="apoyl-aiarticle-title" name="apoyl-aiarticle-title">
        <?php
       wp_nonce_field("apoyl-aiarticle-settings",'apoyl_aiarticle_wpnonce');
        ?>
        <span id="apoyl-aiarticle-tips"></span> <input type="button"
		name="apoyl-aiarticle-button" id="apoyl-aiarticle-button"
		class="button button-primary"
		value="<?php esc_html_e('apoyl-aiarticle-button','apoyl-aiarticle')?>">

    <input type="button"
           name="apoyl-aiarticle-rewritebutton" id="apoyl-aiarticle-rewritebutton"
           class="button button-primary"
           value="<?php esc_html_e('apoyl-aiarticle-rewritebutton','apoyl-aiarticle')?>">
    <input type="button"
           name="apoyl-aiarticle-polishbutton" id="apoyl-aiarticle-polishbutton"
           class="button button-primary"
           value="<?php esc_html_e('apoyl-aiarticle-polishbutton','apoyl-aiarticle')?>">

</form>
<script>
    jQuery(document).ready(function() {
        <?php
        if($rewritefile){
            include $rewritefile;
        }else{
        ?>
        jQuery('#apoyl-aiarticle-rewritebutton').click(
            function() {
                alert('<?php _e('alertcalldev_desc','apoyl-aiarticle')?>');
            });
        <?php
        }
        ?>

        <?php
        if($polishfile){
        include $polishfile;
    }else{
        ?>
        jQuery('#apoyl-aiarticle-polishbutton').click(
            function() {
                alert('<?php _e('alertcalldev_desc','apoyl-aiarticle')?>');
            });
        <?php
        }
        ?>


        jQuery('#apoyl-aiarticle-button').click(function() {
            if(jQuery('.block-editor-default-block-appender__content').length >0)
      	  		jQuery('.block-editor-default-block-appender__content').focus();
            var apoyl_aiarticle_title=jQuery('#apoyl-aiarticle-title').val();
           
        	jQuery('#apoyl-aiarticle-tips').html('<img src="<?php echo esc_url(APOYL_AIARTICLE_URL.'/admin/img/loading.gif');?>" height=15 style="vertical-align:text-bottom;"/>');
        	jQuery.ajax({
  			  type: "POST",
				  url:'<?php echo esc_url($ajaxurl);?>',
    			  data:{
        			  'action':'apoyl_aiarticle_ajax',
    			  	  'apoyl_aiarticle_title':apoyl_aiarticle_title,
                      'apoyl-aiarticle-wpnonce':'<?php echo esc_attr(wp_create_nonce('apoyl-aiarticle-ajax'));?>'
    			  },
    			  async: true,
    			  success: function (data) { 
    				  var obj=JSON.parse(data);
		
    				  if(obj.error_open==1){
    					  jQuery('#apoyl-aiarticle-tips').html('<font color="red"><?php esc_html_e('fail','apoyl-aiarticle')?>'+obj.error_msg+'</font>');
    					  return;
    				  }
        			  if(data!=0){
        				  jQuery('#apoyl-aiarticle-tips').html('<font color="green"><?php esc_html_e('success','apoyl-aiarticle')?></font>');
						  if(jQuery('.wp-block-post-title'))
        				  	jQuery('.wp-block-post-title').html(obj.post_title);
        				  if(jQuery('#title').length >0){
            				 if(jQuery( '#title-prompt-text' ).length >0)
        					 		jQuery('#title-prompt-text' ).html('');
        				  	jQuery('#title').val(obj.post_title);
        				  	
        				  }
        				
        				  if(jQuery('.block-editor-rich-text__editable').length >0)
        				  	jQuery('.block-editor-rich-text__editable').first().html(obj.content);
        				
        				  if(tinymce.get('content')!=null){
        					  tinymce.get('content').setContent(obj.content);
        				  }
        			  }else{
            			  jQuery('#apoyl-aiarticle-tips').html('<font color="red"><?php esc_html_e('fail','apoyl-aiarticle')?></font>');
        			  }
    			  },
    			  error: function(data){
    				  jQuery('#apoyl-aiarticle-tips').html('<font color="red"><?php esc_html_e('fail','apoyl-aiarticle')?></font>');
    			  }
    			  
    			})	
        });
 
    });
</script>