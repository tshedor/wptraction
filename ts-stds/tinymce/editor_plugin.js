
(function() {
	function ButtonClick(btn,ed,url){
		var tbEntry = '';
		var tbInput = '';
		if(btn === 'audio'){
			tbEntry += '<table class="ts-shortcode-options"><tbody>\
			<tr><td>File URL*<span>The direct link to the audio file</span></td><td><input type="text" id="field1" name="src" placeholder="http://kansan.com/media/2012/10/15/how-to-eat-apples.mp3" /></td></tr>\
				<tr><td>Title*<span>An appropriate name</span></td><td><input type="text" id="field2" name="title" placeholder="How to Plant an Appleseed" /></td></tr>\
				<tr><td>Description*<span>Sort of like a caption</span></td><td><input type="text" id="field3" name="description" placeholder="Johnny describes the best way to slice, dice, and dissect yo fruit." /></td></tr>\
				<tr><td>Align<span>left, right, center</span></td><td><select name="align"><option value="left">Left</option><option value="right">Right</option><option value="center">Center</option></select></td></tr>\
				<tr><td>Extension<span>File type. mp3 preferred.</span></td><td><input type="text" id="field4" name="extension" placeholder="mp3" /></td></tr>\
				<tr><td>Author<span>The author of said file</span></td><td><input type="text" id="field5" name="author" placeholder="Johnny Appleseed" /></td></tr>\
				<tr><td><input type="hidden" id="field8" name="after" value=" /]" /></td><td></td></tr>\
				<tr><td></td><td><button class="button button-large button-primary" name="insertTiny" id="insertTiny">Submit</button></td></tr></tbody></table>';
			tb_show( 'Audio Shortcode', '#TB_inline?width=670&height=500&inlineId=appearID' );
			jQuery('#TB_ajaxContent').html(tbEntry);
		}
		if(btn === 'video'){
			tbEntry += '<table class="ts-shortcode-options"><tbody>\
				<tr><td>File URL*<span>The direct link to the audio file</span></td><td><input type="text" id="field1" name="src" placeholder="http://kansan.com/media/2012/10/15/how-to-eat-apples.m4v" /></td></tr>\
				<tr><td>Title*<span>An appropriate name</span></td><td><input type="text" id="field2" name="title" placeholder="How to Plant an Appleseed" /></td></tr>\
				<tr><td>Caption*<span>Describe the clip</span></td><td><textarea id="field3" name="caption" placeholder="Johnny describes the best way to slice, dice, and dissect yo fruit."></textarea></td></tr>\
				<tr><td>Screenshot*<span>A placeholder image before the video is played.<br />Should be same dimensions as video</span></td><td><input type="text" id="field6" name="screenshot" placeholder="http://kansan.com/media/2012/10/15/how-to-eat-apples.png" /></td></tr>\
				<tr><td>Align<span>left, right, center</span></td><td><select name="align"><option value="left">Left</option><option value="right">Right</option><option value="center">Center</option></select></td></tr>\
				<tr><td>Width<span>In pixels</span></td><td><input type="text" id="field7" name="width" placeholder="490" value="" /></td></tr>\
				<tr><td>Height<span>In pixels</span></td><td><input type="text" id="field8" name="height" placeholder="276" value="" /></td></tr>\
				<tr><td>Type<span>m4v preferred. If Flash, enter "flash."</span></td><td><input type="text" id="field8" name="height" placeholder="m4v" value="" /></td></tr>\
				<tr><td></td><td><input type="hidden" id="field8" name="after" value=" /]" /></td></tr>\
				<tr><td></td><td><button class="button button-large button-primary" name="insertTiny" id="insertTiny">Submit</button></td></tr></tbody></table>';
			tb_show( 'Video Shortcode', '#TB_inline?width=670&height=500&inlineId=appearID' );
			jQuery('#TB_ajaxContent').html(tbEntry);
		}
		if(btn === 'inline_text'){
			tbEntry += '<table class="ts-shortcode-options"><tbody>\
				<tr><td>Title*<span>An appropriate name</span></td><td><input type="text" id="field1" name="title" placeholder="How to Plant an Appleseed" /></td></tr>\
				<tr><td>Align<span>left, right, center</span></td><td><select name="align"><option value="left">Left</option><option value="right">Right</option><option value="center">Center</option></select></td></tr>\
				<tr><td><input type="hidden" id="field3" name="after" value="] YOUR CONTENT HERE [/inline_text]" /></td><td></td></tr>\
				<tr><td></td><td><button class="button button-large button-primary" name="insertTiny" id="insertTiny">Submit</button></td></tr></tbody></table>';
			tb_show( 'Aside Text Shortcode', '#TB_inline?width=670&height=500&inlineId=appearID' );
			jQuery('#TB_ajaxContent').html(tbEntry);
		}
		if(btn === 'timeline'){
			tbEntry += '<table class="ts-shortcode-options"><tbody>\
				<tr><td>URL*<span>Link to Storify article or Google Docs Spreadsheet</span></td><td><input type="type" id="field1" name="url" placeholder="http://storify.com/kansan/booze" /></td></tr>\
				<tr><td>Title*<span>An appropriate name</span></td><td><input type="text" id="field2" name="title" placeholder="How to Plant an Appleseed" /></td></tr>\
				<tr><td>Description*<span>Describe the timeline</span></td><td><textarea id="field3" name="description" placeholder="Johnny describes the best way to slice, dice, and dissect yo fruit."></textarea></td></tr>\
				<tr><td><input type="hidden" id="field5" name="after" value=" /]" /></td><td></td></tr>\
				<tr><td><a href="https://drive.google.com/previewtemplate?id=0AppSVxABhnltdEhzQjQ4MlpOaldjTmZLclQxQWFTOUE&mode=public&pli=1#" title="Google Spreadsheet">Google Spreadsheet Template</a></td><td><a href="http://storify.com/zachwise/test" title="Storify Sample">Storify Sample</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://timeline.verite.co/" title="Timeline">Timeline Example</a></td></tr>\
				<tr><td></td><td><button class="button button-large button-primary" name="insertTiny" id="insertTiny">Submit</button></td><td</td></tr></tbody></table>';
			tb_show( 'Timeline Shortcode', '#TB_inline?width=670&height=500&inlineId=appearID' );
			jQuery('#TB_ajaxContent').html(tbEntry);
		}
		if(btn === 'tabs'){
			var count = 1;
			tbEntry += '<table class="ts-shortcode-options" id="tabsTable"><tbody>\
				<tr><td>Style<span>The style of the tabs</span></td><td><select name="type"><option value="horizontal">Horizontal</option><option value="vertical">Vertical</option></select></td></tr>\
				<tr><td><button class="button button-large button-primary" id="addNewTab">Add Another Tab</button></td><td></td></tr>\
				<tr><td><input type="hidden" id="field5" name="after" value=" ]<br />[tab " /></td><td></td></tr>\
				<tr><td>Tab '+count+'<span>An appropriate name</span></td><td><input type="text" id="field2" name="name" placeholder="How to Plant an Appleseed" /></td></tr>\
				<tr><td><input type="hidden" id="field5" name="after" value=" ]<br />" /></td><td></td></tr>\
				<tr><td>Tab '+count+' Content<span>The tab content</span></td><td><textarea id="field3" name="description" placeholder="Johnny describes the best way to slice, dice, and dissect yo fruit."></textarea></td></tr>\
				<tr><td><input type="hidden" id="field5" name="after" value="<br />[/tab]<br />" /></td><td></td></tr>\
				<tr id="tinyRow"><td></td><td><button class="button button-large button-primary" name="insertTiny" id="insertTiny">Submit</button></td></tr></tbody></table>';
			tb_show( 'Tabs Shortcode', '#TB_inline?width=670&height=500&inlineId=appearID' );
			jQuery('#TB_ajaxContent').html(tbEntry);
			jQuery('#TB_window').css('overflow-y', 'scroll');
			jQuery('#TB_window').css('overflow-x', 'hidden');
			jQuery('#addNewTab').click(function(){
				count++;
				tbNewTab = '';
				tbNewTab += '<tr><td><input type="hidden" id="field5" name="after" value="[tab " /></td><td></td></tr>\
					<tr><td>Tab '+count+'<span>An appropriate name</span></td><td><input type="text" id="field2" name="name" placeholder="How to Plant an Appleseed" /></td></tr>\
					<tr><td><input type="hidden" id="field5" name="after" value=" ]<br />" /></td><td></td></tr>\
					<tr><td>Tab '+count+' Content<span>The tab content</span></td><td><textarea id="field3" name="description" placeholder="Johnny describes the best way to slice, dice, and dissect yo fruit."></textarea></td></tr>\
					<tr><td><input type="hidden" id="field5" name="after" value="<br />[/tab]<br />" /></td><td></td></tr>';
				var tbHeight = jQuery('#TB_ajaxContent').css('height');
				var newTBHeight = parseInt(tbHeight.slice(0,-2))+200;
				jQuery('#TB_ajaxContent').css('height', newTBHeight+'px');
				jQuery('#tinyRow').before(tbNewTab);
			});
		}
		if(btn === 'sibling'){
			tbEntry += '<table class="ts-shortcode-options"><tbody>\
				<tr><td>Media Type<span>If related post is photo gallery, video or neither</span></td><td><select name="media"><option value="">Please Select One</option><option value="audio">Audio</option><option value="video">Video</option><option value="gallery">Gallery</option></select></td></tr>\
				<tr><td>Description<span>Describe the related story. If nothing provided, <br />excerpt will be used</span></td><td><textarea id="field3" name="description" placeholder="Johnny describes the best way to slice, dice, and dissect yo fruit."></textarea></td></tr>\
				<tr><td>Align<span>left, right, center</span></td><td><select name="align"><option value="left">Left</option><option value="right">Right</option><option value="center">Center</option></select></td></tr>\
				<tr><td>Post<span>Pick the related post</span></td><td><select id="addMoreJson" name="post"><option value="">Please select one</option>';
			jQuery.getJSON("/api/get_recent_posts",function(data){
					jQuery.each(data.posts, function(i,article) {
						jQuery('#addMoreJson').append('<option value="'+article.id+'">'+article.title+'</option>');
					})
			});
			tbEntry += '</select></td></tr>\
				<tr><td><input type="hidden" id="field5" name="after" value=" /]" /></td><td></td></tr>\
				<tr><td></td><td><button class="button button-large button-primary" name="insertTiny" id="insertTiny">Submit</button></td></tr></tbody></table>';
			tb_show( 'Related Post Shortcode', '#TB_inline?width=670&height=800&inlineId=appearID' );
			jQuery('#TB_ajaxContent').html(tbEntry);
		}
		jQuery('#insertTiny').click(function(){
			jQuery('#TB_ajaxContent input, #TB_ajaxContent select, #TB_ajaxContent textarea').each(function(){
				if((jQuery(this).attr('name')) != 'after'){
					if(btn === 'tabs'){
						if(jQuery(this).attr('name') === 'type' || jQuery(this).attr('name') === 'name'){
							tbInput += jQuery(this).attr('name')+'="'+jQuery(this).val()+'" ';
						} else {
							tbInput += jQuery(this).val();
						}
					} else {
						tbInput += jQuery(this).attr('name')+'="'+jQuery(this).val()+'" ';
					}
				} else {
					tbInput += jQuery(this).val();
				}
			});
			if(btn === 'tabs'){
				btn = 'tabbed ';
				tbInput +='[/tabbed]<br />';
			}
			ed.execCommand('mceInsertContent', false, '['+btn+' '+tbInput);
			tbInput = '';
			tbEntry = '';
			tb_remove();
		});
  };
	tinymce.create('tinymce.plugins.Text', {
		init : function(ed, url) {
			ed.addButton('text', {
				title : 'Insert Text',
				image : url+'/text.png',
				onclick : function() {
					ButtonClick('inline_text',ed,url);
				}
			});
		},
		createControl : function(n, cm) {
			return null;
		},
		getInfo : function() {
			return {
				longname : "Text Shortcode",
				author : 'Tim Shedor w/ help from Brett Terpstra (http://brettterpstra.com/)',
				authorurl : 'http://timshedor.com',
				infourl : 'http://timshedor.com/',
				version : "1.0"
			};
		}
	});
	tinymce.PluginManager.add('text', tinymce.plugins.Text);
	tinymce.create('tinymce.plugins.audio', {
		init : function(ed, url) {
			ed.addButton('audio', {
				title : 'Insert Audio',
				image : url+'/audio.png',
				onclick : function() {
					ButtonClick('audio',ed,url);
				}
			});
		},
		createControl : function(n, cm) {
			return null;
		},
		getInfo : function() {
			return {
				longname : "HTML5 Audio Shortcode",
				author : 'Tim Shedor w/ help from Brett Terpstra (http://brettterpstra.com/)',
				authorurl : 'http://timshedor.com',
				infourl : 'http://timshedor.com/',
				version : "1.0"
			};
		}
	});
	tinymce.PluginManager.add('audio', tinymce.plugins.audio);
	tinymce.create('tinymce.plugins.video', {
		init : function(ed, url) {
			ed.addButton('video', {
				title : 'Insert Custom Video',
				image : url+'/video.png',
				onclick : function() {
					ButtonClick('video',ed,url);
				}
			});
		},
		createControl : function(n, cm) {
			return null;
		},
		getInfo : function() {
			return {
				longname : "HTML5 Video Shortcode",
				author : 'Tim Shedor w/ help from Brett Terpstra (http://brettterpstra.com/)',
				authorurl : 'http://timshedor.com',
				infourl : 'http://timshedor.com/',
				version : "1.0"
			};
		}
	});
	tinymce.PluginManager.add('video', tinymce.plugins.video);
	tinymce.create('tinymce.plugins.Timeline', {
		init : function(ed, url) {
			ed.addButton('timeline', {
				title : 'Insert Timeline',
				image : url+'/timeline.png',
				onclick : function() {
					ButtonClick('timeline',ed,url);
				}
			});
		},
		createControl : function(n, cm) {
			return null;
		},
		getInfo : function() {
			return {
				longname : "Timeline Shortcode",
				author : 'Tim Shedor w/ help from Brett Terpstra (http://brettterpstra.com/)',
				authorurl : 'http://timshedor.com',
				infourl : 'http://timshedor.com/',
				version : "1.0"
			};
		}
	});
	tinymce.PluginManager.add('timeline', tinymce.plugins.Timeline);
	tinymce.create('tinymce.plugins.Tabs', {
		init : function(ed, url) {
			ed.addButton('tabs', {
				title : 'Insert Tabs',
				image : url+'/tabs.png',
				onclick : function() {
					ButtonClick('tabs',ed,url);
				}
			});
		},
		createControl : function(n, cm) {
			return null;
		},
		getInfo : function() {
			return {
				longname : "Tabs Shortcode",
				author : 'Tim Shedor w/ help from Brett Terpstra (http://brettterpstra.com/)',
				authorurl : 'http://timshedor.com',
				infourl : 'http://timshedor.com/',
				version : "1.0"
			};
		}
	});
	tinymce.PluginManager.add('tabs', tinymce.plugins.Tabs);
	tinymce.create('tinymce.plugins.Sibling', {
		init : function(ed, url) {
			ed.addButton('sibling', {
				title : 'Insert Link to Related Post',
				image : url+'/sibling.png',
				onclick : function() {
					ButtonClick('sibling',ed,url);
				}
			});
		},
		createControl : function(n, cm) {
			return null;
		},
		getInfo : function() {
			return {
				longname : "Sibling Shortcode",
				author : 'Tim Shedor w/ help from Brett Terpstra (http://brettterpstra.com/)',
				authorurl : 'http://timshedor.com',
				infourl : 'http://timshedor.com/',
				version : "1.0"
			};
		}
	});
	tinymce.PluginManager.add('sibling', tinymce.plugins.Sibling);
})();
