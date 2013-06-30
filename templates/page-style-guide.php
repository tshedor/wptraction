<?php
/*
Template Name: Style Guide
*/
get_header(); if(have_posts()) : while(have_posts()) : the_post(); ?>
<?php global $a; ?>
<div class="row clearfix">
	<div class="large-12 columns">
		<h1 class="single-title"><?php the_title(); ?></h1>
		<div <?php post_class('entry clearfix'); ?>>
			<?php the_content(); ?>
			<h2>Colors</h2>
			<div class="row">
				<div class="color-block large-4 columns dom-color"></div>
				<div class="color-block large-4 columns sub-color"></div>
				<div class="color-block large-4 columns ter-color"></div>
			</div>
			<div class="row">
				<h2>Quote (blockquote)</h2>
				<blockquote>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean pulvinar tellus lorem. Suspendisse est arcu, pretium a commodo nec, placerat ac metus. Praesent non ipsum lorem. Quisque dolor nulla, pulvinar eu orci ut, mollis malesuada ligula. Nam eu elit nec erat mollis mattis sed sit amet nunc. Cras tincidunt ligula id vestibulum vehicula. Vestibulum ornare nisl a enim mattis, in dignissim felis consectetur. Vestibulum sed feugiat diam. Sed id urna lacinia velit consectetur egestas eget sit amet est. Nam blandit varius tempor. Nulla vel risus pellentesque, imperdiet lacus id, lobortis enim. Ut mattis aliquam metus eget faucibus. Curabitur sed facilisis lacus, at malesuada orci. Praesent volutpat velit vitae mauris faucibus, quis lacinia lectus faucibus. Curabitur aliquet, elit convallis rutrum pretium, magna nulla posuere eros, ac feugiat odio risus quis dui.
					<cite>Quote Source</cite>
				</blockquote>
			</div>
			<div class="row clearfix">
				<div class="large-6 columns">
					<h2>Unordered List</h2>
					<ul>
						<li>List Item</li>
						<li>List Item</li>
						<li>List Item</li>
						<li>List Item</li>
						<li>List Item</li>
						<li>List Item</li>
					</ul>
				</div>
				<div class="large-6 columns">
					<h2>Ordered List</h2>
					<ol>
						<li>List Item</li>
						<li>List Item</li>
						<li>List Item</li>
						<li>List Item</li>
						<li>List Item</li>
						<li>List Item</li>
					</ol>
				</div>
			</div>
			<div class="row clearfix">
				<div class="large-12 columns">
					<h1>Forms</h1>
				</div>
			</div>
			<form class="row clearfix">
				<div class="large-6 columns">
					<h4>Text</h4>
						<input type="text" placeholder="Text" />
					<h4>Text Prepent</h4>
						<div class="clearfix">
							<span class="attached-label">Prefix</span>
							<input type="text" class="attached-input" />
						</div>
					<h4>Radio</h4>
					<div class="inline-radio">
						<label>Radio
							<input type="radio" name="radio" />
						</label>
						<label>Radio 2
							<input type="radio" name="radio" />
						</label>
						<label>Radio 3
							<input type="radio" name="radio" />
						</label>
					</div>
					<h4>Checkbox</h4>
					<div class="inline-radio">
						<label>Checkbox
							<input type="checkbox" name="checkbox" />
						</label>
						<label>Checkbox 2
							<input type="checkbox" name="checkbox" />
						</label>
						<label>Checkbox 3
							<input type="checkbox" name="checkbox" />
						</label>
					</div>
					<h4>Textarea</h4>
						<textarea placeholder="Textarea"></textarea>
					<h4>Speech Input</h4>
						<input type="text" x-webkit-speech />
					<h4>Select</h4>
						<select>
							<option>Option 1</option>
							<option>Option 1</option>
							<option>Option 1</option>
							<option>Option 1</option>
						</select>
				</div>
				<div class="large-6 columns">
					<h4>Password</h4>
						<input type="password" />
					<h4>Range</h4>
						<input type="range" />
					<h4>Color</h4>
						<input type="color" />
					<h4>Number</h4>
						<input type="number" />
					<h4>Date</h4>
						<input type="date" />
					<h4>Submit</h4>
						<input type="submit" value="Button" />
					</form>
				</div>
			</div>
			<div class="row clearfix">
			</div>
			<div class="row clearfix">
				<div class="large-12 columns">
					<h2>Content</h2>
				</div>
			</div>
			<div class="row clearfix">
				<h2>Type</h2>
				<hr />
				<div class="large-6 columns">
					<h1>Heading 1</h1>
					<h2>Heading 2</h2>
					<h3>Heading 3</h3>
					<h4>Heading 4</h4>
					<h5>Heading 5</h5>
				</div>
				<div class="large-6 columns">
					<div class="font-block font-display">Display Font</div>
					<div class="font-block font-sub">Sub Font</div>
					<div class="font-block font-cond">Condensed Font</div>
					<div class="font-block font-body">Body Font</div>
					<div class="font-block font-light">Light Font</div>
					<hr />
					<h4>Paragraph</h4>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean pulvinar tellus lorem. Suspendisse est arcu, pretium a commodo nec, placerat ac metus. Praesent non ipsum lorem. Quisque dolor nulla, pulvinar eu orci ut, mollis malesuada ligula. Nam eu elit nec erat mollis mattis sed sit amet nunc. Cras tincidunt ligula id vestibulum vehicula. Vestibulum ornare nisl a enim mattis, in dignissim felis consectetur. Vestibulum sed feugiat diam.</p>
				</div>
			</div>
			<div class="row clearfix">
				<div class="large-4 columns">
					<h4>Bold</h4>
					<p>Lorem ipsum <strong>dolor sit amet</strong></p>
					<h4>Italic</h4>
					<p>Lorem ipsum <em>dolor sit amet</em></p>
					<h4>Underline</h4>
					<p>Lorem ipsum <span style="text-decoration:underline">dolor sit amet</span></p>
				</div>
				<div class="large-4 columns">
					<h4>Link</h4>
					<p>Lorem ipsum <a href="#" title="And a title">dolor sit amet</a></p>
					<h4>Strikethrough</h4>
					<p>Lorem ipsum <span style="text-decoration:line-through">dolor sit amet</span></p>
					<h4>Small</h4>
					<p>Lorem ipsum <small>dolor sit amet</small></p>
				</div>
				<div class="large-4 columns">
					<h4>Sup</h4>
					<p>Lorem ipsum <sup>dolor sit amet</sup></p>
					<h4>Sub</h4>
					<p>Lorem ipsum <sub>dolor sit amet</sub></p>
					<h4>Code</h4>
					<p>Lorem ipsum <code>dolor sit amet</code></p>
				</div>
			</div>
			<div class="row clearfix">
				<div class="large-12 columns">
					<h2>UI</h2>
				</div>
			</div>
			<div class="row clearfix">
				<div class="large-6 columns">
					<h3>Alerts</h3>
					<div class="alert md-margin">Regular alert with text</div>
					<div class="alert md-margin success">Success alert with text</div>
					<div class="alert md-margin error">Error alert with text</div>
				</div>
				<div class="large-6 columns">
					<h3>Buttons</h3>
					<button>Regular button</button>
					<div class="button">Regular button</div>
					<div class="button success">Regular button</div>
					<div class="button error">Regular button</div>
				</div>
			</div>
			<div class="row clearfix">
				<div class="large-6 columns">
					<h3>Breadcrumbs</h3>
					<div class="breadcrumbs">
						<a href="#">Breadcrumb one</a>
						<a href="#">Breadcrumb two</a>
						<a href="#">Breadcrumb three</a>
						<a href="#" class="current-item">Current page</a>
					</div>
				</div>
				<div class="large-6 columns">
					<h3>Pagination</h3>
					<div class="page-navigation">
						<span class="page-numbers current">1</span>
						<a href="#" class="page-numbers">2</a>
						<a href="#" class="page-numbers">3</a>
						<a href="#" class="page-numbers">4</a>
						<a href="#" class="next page-numbers">&nbsp;Next&nbsp;&raquo;</a>
					</div>
				</div>
			</div>
			<div class="row clearfix">
				<div class="large-6 columns">
					<div class="label">Regular label</div>
					<div class="label label-success">Success label</div>
					<div class="label label-warning">Warning label</div>
				</div>
			</div>
			<div class="clear"></div>
		</div>
	</div>
</div>
<?php endwhile; else :
	get_template_part('inc/ts-stds/loop', 'error');
endif;
get_footer();