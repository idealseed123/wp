<?php







// loads the shortcodes class, wordpress is loaded with it



require_once( 'shortcodes.class.php' );







// get popup type



$popup = trim( $_GET['popup'] );



$shortcode = new ve_pb_shortcodes( $popup );



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<body>
<div id="ve_pb-popup">
	<div id="ve_pb-shortcode-wrap">
		<div id="ve_pb-sc-form-wrap">
			<?php
			$select_shortcode = array(
					'select' => 'Choose a Shortcode',
					'already-earn' => 'Already Earn',
					'about_block' => 'About Block',
					'achievements' => 'Add Achievements',
					'accordians' => 'Accordian',
                    'blog' => 'Blog',
					'container' => 'Container with row',
					'column' => 'Column',
					'content_boxes' => 'Content Boxes',
                    'clients' => 'Clients',
					'consult_block' => 'Consult Block',
					'heading' => 'Heading',
                    'invetments' =>'Investments',
					'imageblock' => 'Imageblock',
					'get_advice' =>'Get Advice',
					'latest_news_slide' =>'Latest News Slider',
                    'new_services'=> 'New Services',
                    'price_block' => 'Pricing Block',
					'page_title' => 'Page Title',
					'video_section'=>'Video Section',
                    'reviews'=>'Review',
					'row'=>'Row',
					'section'=>'Section',
					'step-block'=>'Step Block',
                   'section_header'=>'Section Header',
					'services'=>'Services',
					'services_list'=>'Services List',
					'service_block' =>'Service Block',
					'service_price' =>'Service Price',
					'team_member' =>'Team Member',
					'multilists' =>'Multi list',
					'we_can' =>'We Can',

            );
			?>
			<table id="ve_pb-sc-form-table" class="ve_pb-shortcode-selector">
				<tbody>
					<tr class="form-row">
						<td class="label">Choose Shortcode</td>
						<td class="field">
							<div class="ve_pb-form-select-field">
							<div class="ve_pb-shortcodes-arrow">&#xf107;</div>
								<select name="ve_pb_select_shortcode" id="ve_pb_select_shortcode" class="ve_pb-form-select ve_pb-input">
									<?php foreach($select_shortcode as $shortcode_key => $shortcode_value): ?>
									<?php if($shortcode_key == $popup): $selected = 'selected="selected"'; else: $selected = ''; endif; ?>
									<option value="<?php echo $shortcode_key; ?>" <?php echo $selected; ?>><?php echo $shortcode_value; ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
			<form method="post" id="ve_pb-sc-form">
				<table id="ve_pb-sc-form-table">
					<?php echo $shortcode->output; ?>
					<tbody class="ve_pb-sc-form-button">
						<tr class="form-row">
							<td class="field"><a href="#" class="ve_pb-insert">Insert Shortcode</a></td>
						</tr>
					</tbody>
				</table>
				<!-- /#ve_pb-sc-form-table -->
			</form>
			<!-- /#ve_pb-sc-form -->
		</div>
		<!-- /#ve_pb-sc-form-wrap -->
		<div class="clear"></div>

	</div>
	<!-- /#ve_pb-shortcode-wrap -->
</div>
<!-- /#ve_pb-popup -->
</body>
</html>