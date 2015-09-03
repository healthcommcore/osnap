<?php
/*
Plugin Name: Admin&Single Gravity Forms Add-On - Updated by SLAVEN
Plugin URI: http://www.troydesign.it
Description: This plugin allows users to edit their single entry in a gravity form. Besides it allows to use gravity forms on Admin side.
Version: 0.1
Author: TroyDesign
Author URI: http://www.troydesign.it

------------------------------------------------------------------------*/

//Allow to use gravity forms on Admin Side. You must use a page with a menu_slug that doesn't start with "gf_"
if (is_admin() && isset($_GET['page']) && !preg_match('/^gf_/i',$_GET['page'])) {
	define("IS_ADMIN",  false);
	add_action('admin_menu', array('RGForms', 'create_menu'));
	add_action('admin_init', array('RGForms', 'maybe_process_form'), 9);
}

//Look for our "single" attribute in the gravity shortcode before wp process shortcodes
add_filter('the_content', array('GFAdminSingleForms', 'the_content'), 10);

//Avoid to insert a new record and allow to edit the exist one(if exists, otherwise a new one is created)
add_filter( 'query', array('GFAdminSingleForms', 'query') );

class GFAdminSingleForms {

	public static function query($query) {
		if (method_exists('RGFormsModel','get_lead_table_name') && isset($_POST['gform_lead_id']) && preg_match('/^INSERT INTO '.RGFormsModel::get_lead_table_name().'/i',$query)) {
			$lid = (int)$_POST['gform_lead_id'];
			if ($lid) {
				$lead = RGFormsModel::get_lead($lid);
				if (GFCommon::current_user_can_any("gravityforms_edit_entries") || $lead['created_by'] == wp_get_current_user()->ID) {
					global $wpdb;
					$wpdb->insert_id = $lid;
					$query = 'SELECT 1';
				}
			}
		}
		return $query;
	}

	public static function the_content($content) {
		global $shortcode_tags;
		$shortcode_tags_old = $shortcode_tags;
		$shortcode_tags = array('gravityform'=>array('GFAdminSingleForms','parse_shortcode'));
		$content = do_shortcode($content);
		$shortcode_tags = $shortcode_tags_old;
		return $content;
	}

	public static $lead_ids = array();
	public static function gform_submit_button($button_input, $form) {
		$fid = (int)$form['id'];
		if (isset(GFAdminSingleForms::$lead_ids[$fid])) {
			$lid = GFAdminSingleForms::$lead_ids[$fid];
			$button_input .= "<input type='hidden' class='gform_hidden' name='gform_lead_id' value='{$lid}' />";
		}
		return $button_input;
	}

	public static function parse_shortcode($attributes) {
		$ret = '[gravityform';
		foreach($attributes as $k=>$v) {
			if ($k == 'single') {
				if ($v == 'true') {
					$fid = (int)$attributes['id']; $lid = null;
					if ($_SERVER['REQUEST_METHOD'] == 'GET' && $values = GFAdminSingleForms::get_form_values($fid)) {
						GFAdminSingleForms::simulate_post($values['lead'],$values['meta']);
						$lid = (int)$values['lead']['id'];
					}
					else if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['gform_lead_id'])) {
						$lid = (int)$_POST['gform_lead_id'];
					}
					if ($lid) {
						GFAdminSingleForms::$lead_ids[$fid] = $lid;
						add_filter("gform_submit_button_".$fid, array('GFAdminSingleForms', 'gform_submit_button'), 100, 2);
					}
					//$ret .= ' field_values="lid=' . $values['lead']['id'] . '"';
				}
				continue;
			}
			$ret .= ' ' . $k . '="' . $v . '"';
		}
		$ret .= ']';
		return $ret;
	}

	public static function get_form_values($form_id) {
		global $wpdb;
		$ret = false;
		//$lid = $wpdb->get_var(sprintf("SELECT DISTINCT id FROM %s WHERE form_id = %d AND created_by=%d ORDER BY id DESC LIMIT 1", RGFormsModel::get_lead_table_name(), $form_id, wp_get_current_user()->ID));
		
		// added by slaven 3/28/13 
		// see http://software.troydesign.it/php/wordpress/adminsingle-gravity-forms-add-on.html 
		// allows editing of entry by ID
		$rid = (int)$_GET['rid']; // Requested ID
		if ($rid) {
			// SLAVEN
			//echo "<h4>RID:".$rid."</h4>";
			$lid = $wpdb->get_var(sprintf("SELECT DISTINCT id FROM %s WHERE form_id = %d AND created_by=%d AND id=%d", RGFormsModel::get_lead_table_name(), $form_id, wp_get_current_user()->ID, $rid));
		} else {
		// SLAVEN
			//echo "<h4>NO RID</h4>";
			$lid = $wpdb->get_var(sprintf("SELECT DISTINCT id FROM %s WHERE form_id = %d AND created_by=%d ORDER BY id DESC LIMIT 1", RGFormsModel::get_lead_table_name(), $form_id, wp_get_current_user()->ID));
		}
		
		
		if ($lid) {
			$meta = RGFormsModel::get_form_meta($form_id);
			$lead = RGFormsModel::get_lead($lid);
			$ret = array('lead'=>$lead,'meta'=>$meta);
		}
		return $ret;
	}

	public static function simulate_post($lead,$meta) {
		$form_id = $lead['form_id'];
		$upload_ids = array();
		foreach($meta["fields"] as $m) {
			if ($m['type'] == 'fileupload') $upload_ids[]=$m['id'];
		}
		$upload_arr = array();
		$upload_copy = array();
		$upload_target = array();
		$target_path = RGFormsModel::get_upload_path($form_id) . "/tmp/";
		foreach ($lead as $key => $value) {
			$input = "input_".str_replace('.', '_', strval($key));
			if (in_array($key,$upload_ids) && $value!="") {
				if (!isset(RGFormsModel::$uploaded_files[$form_id])) RGFormsModel::$uploaded_files[$form_id] = array();
				$upath = $_SERVER['DOCUMENT_ROOT'].parse_url($value,PHP_URL_PATH);
				$path_parts = pathinfo($upath);
				$source = str_replace('//', '/', $upath);
				$upload_arr[$input] = basename($value);
				$upload_copy[$input] = $source;
				RGFormsModel::$uploaded_files[$form_id][$input] = $upload_arr[$input];
				$_POST[$input] = "";
				continue;
			}
			$_POST[$input] = $value;
		}
		if (sizeof($upload_arr) > 0) {
			$_POST["gform_uploaded_files"] = addslashes(GFCommon::json_encode($upload_arr));
		}
		$_POST['gform_target_page1_number_' . $form_id]='0';
		$_POST['gform_source_page_number_' . $form_id]='1';
		$_POST["is_submit_" . $form_id] = '1';
		$form_unique_id = RGFormsModel::get_form_unique_id($form_id);
		$_POST["gform_submit"] = $form_id;
		$_POST["gform_unique_id"] = $form_unique_id;
		foreach ($upload_copy as $key => $value) {
			$path_parts = pathinfo($value);
			$dest_dir = str_replace('//', '/', $target_path.'/');
			mkdir($dest_dir);
			$dest = $dest_dir.$form_unique_id.'_'.$key.'.'.$path_parts['extension'];
			copy($value,$dest);
		}
	}
}
?>