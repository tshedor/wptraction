<?php
function traction_add_admin() {
	global $themename, $options;
	$admin_options = array();
	foreach ($options as $value) {
		$admin_options[$value['id']] = isset($_POST[$value['id']]) ? $_POST[$value['id']] : false;
	}
	$admin_options['has_saved'] = true;
	update_option('traction_admin_options', $admin_options);
	echo '<div id="message" class="updated" style="width:800px; margin-left:0px; padding-right:0px;margin-top:20px"><p><strong>'.__('Settings saved.', 'trwp').'</strong></p></div>';
}

function traction_admin() {
	global $themename, $options;
	if ( isset($_POST['update_themeoptions']) && $_POST['update_themeoptions'] == 'true' ) { traction_add_admin(); }
	if(isset($_REQUEST['action']) && 'reset' == $_REQUEST['action']) {
		$admin_options = array();
		foreach ($options as $value) {
			if(isset($value['def']))
				$admin_options[$value['id']] = $value['def'];
			else
				$admin_options[$value['id']] = false;
		}
		update_option('traction_admin_options', $admin_options);
		echo '<div id="message" class="updated" style="width:800px; margin-left:0px; padding-right:0px;margin-top:20px"><p><strong>'.__('Settings reset', 'trwp').'</strong></p></div>';
	}
	echo '<div class="wrap trao clear clearfix" id="poststuff">
		<h2>'.$themename.' '.__('settings', 'trwp').'</h2>
		<form method="post" novalidate data-validate="parsley">
		<input type="hidden" name="update_themeoptions" value="true" />';
	$globalMeta = get_option('traction_admin_options');

	foreach ($options as $value) {
		$meta = $globalMeta[$value['id']];
		$fieldType = $value['type'];
		$newField = new TractionInput($meta,$value);
		$newField->$fieldType();
	}
		echo '
</div>
<p class="submit">
	<input name="save" type="submit" class="button button-primary button-large" value="'.__('Save changes', 'trwp').'" />
	<input type="hidden" name="action" value="save" />
</p>
</form>
<script type="text/javascript">
function reallyreset(){
var agree=confirm("'.__('Are you sure you want to reset all options?', 'trwp').'");
if (agree)
	return true ;
else
	return false ;
}
</script>
<form method="post">
	<p class="submit"> 	<input name="save" type="submit" class="button" value="'.__('Reset', 'trwp').'" onclick="return reallyreset()" />
<input type="hidden" name="action" value="reset" /></form> </p>
';
}

function traction_themeoptions_admin_menu()  {
	global $themename;
	add_theme_page($themename.' '.__('Options', 'trwp'), $themename.' '.__('Options', 'trwp'), 'edit_themes', basename(__FILE__), 'traction_admin');
}
add_action('admin_menu', 'traction_themeoptions_admin_menu');