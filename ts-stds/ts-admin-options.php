<?php
function ts_add_admin() {
	global $themename, $options;
	$admin_options = array();
	foreach ($options as $value) {
		if(isset($_POST[$value['id']]))
			$admin_options[$value['id']] = $_POST[$value['id']];
		else
			$admin_options[$value['id']] = false;
	}
	$admin_options['has_saved'] = true;
	update_option('ts_admin_options', $admin_options);
	echo '<div id="message" class="updated" style="width:800px; margin-left:0px; padding-right:0px;margin-top:20px"><p><strong>Settings saved.</strong></p></div>';
}

function ts_admin() {
	global $themename, $options, $icons;
	if ( isset($_POST['update_themeoptions']) && $_POST['update_themeoptions'] == 'true' ) { ts_add_admin(); }
	if(isset($_REQUEST['action']) && 'reset' == $_REQUEST['action']) {
		$admin_options = array();
		foreach ($options as $value) {
			if(isset($value['def']))
				$admin_options[$value['id']] = $value['def'];
			else
				$admin_options[$value['id']] = false;
		}
		update_option('ts_admin_options', $admin_options);
	}
	if(isset($_GET['reset']))
		echo '<div id="message" class="updated" style="width:800px; margin-left:0px; padding-right:0px;margin-top:20px"><p><strong>Settings reset.</strong></p></div>';
echo '<div class="wrap tsao clear clearfix" id="poststuff">
		<h2>'.$themename.' settings</h2>
		<form method="post">
		<input type="hidden" name="update_themeoptions" value="true" />';
	$globalMeta = get_option('ts_admin_options');

	foreach ($options as $value) {
		$meta = $globalMeta[$value['id']];
		$fieldType = $value['type'];
		$newField = new adminfield($meta,$value);
		echo $newField->$fieldType();
	}
		echo '
</div>
<p class="submit">
	<input name="save" type="submit" class="button button-primary" value="Save changes" />
	<input type="hidden" name="action" value="save" />
</p>
</form>
<form method="post">
	<p class="submit"> 	<input name="save" type="submit" class="button button-primary" value="Reset" />
<input type="hidden" name="action" value="reset" /></form> </p>
';
}


function themeoptions_admin_menu()  {
	global $themename;
	add_theme_page($themename." Options", "".$themename." Options", 'edit_themes', basename(__FILE__), 'ts_admin');
}
add_action('admin_menu', 'themeoptions_admin_menu');