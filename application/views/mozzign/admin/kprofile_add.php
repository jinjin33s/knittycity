<script>
 $(document).ready(function() {
     $("#profDate").datepicker({dateFormat:'yy-mm-dd'});
 });
 
 </script>

<div class="box">
	<h2>
		Add Profile
	</h2>
        <a href="<?=base_url()."admin/kprofile/";?>">back to list</a>
	<?
		if(count($error_list) > 0 OR count($notice_list) > 0)
		{
	?>
			<table cellpadding="0" cellspacing="0" class="form_info">
				<tbody>
					<?
						foreach($error_list as $error)
						{
					?>
							<tr>
								<td class="error">
									<? echo $error; ?>
								</td>
							</tr>
					<?
						}
					?>
					<?
						foreach($notice_list as $notice)
						{
					?>
							<tr>
								<td class="notice">
									<? echo $notice; ?>
								</td>
							</tr>
					<?
						}
					?>
				</tbody>
			</table>

	<?
		}
	?>
	<? echo form_open('admin/kprofile/add'); ?>
		<table cellpadding="0" cellspacing="0" class="form">
			<tbody>
                            <tr>
					<td>
						Title
					</td>
					<td>
						<?
							$data = array(
							              'name'        => 'profTitle',
							              'id'          => 'profTitle',
							              
							              'size'        => '85'
							            );

							echo form_input($data);
						?>
					</td>
				</tr>
                                <tr>
					<td>
						Summary
					</td>

					<td>
						<?
							$data = array(
							              'name'        => 'profSummary',
							              'id'          => 'profSummary',
							              'size'        => '85',
                                                                      'style'       =>'height:50px;'
							              
							            );

							echo form_textarea($data);
						?>
					</td>
				</tr>
                                <tr>
					<td>Input Date</td>
                                        <td>
                                                <?
							$data = array(
							              'name'        => 'profDate',
							              'id'          => 'profDate',
							              'maxlength'   => '20',
							              'size'        => '20',
							              'value'		=> set_value('profDate')
							            );

							echo form_input($data);
						?>					
					</td>
                                </tr>
                                <tr>
                                        <td>Description</td>
					<td>
						<?
							$fckeditorConfig = array(
                                                                            'instanceName' => 'profContent',
                                                                            'BasePath' => base_url().APPPATH.'plugins/fckeditor/',
                                                                            'ToolbarSet' => 'Default',
                                                                            'Width' => '710px',
                                                                            'Height' => '400',
                                                                            'Value' => unprep_for_form(set_value('profContent'))
                                                                            );
							$this->fckeditor->init($fckeditorConfig);
							echo $this->fckeditor->Create();
						?>
					</td>
				</tr>
                                <tr>
					<td colspan="2">
						<?
							$data = array(
							              'name'        => 'submit',
							              'id'          => 'submit',
							              'value'		=> 'Save',
							              'class'		=> 'submit'
							            );

							echo form_submit($data);
						?>
					</td>
				</tr>
			</tbody>
		</table>
	<? echo form_close(); ?>
</div>

<link href="knittyblog/js/jquery/ui/themes/ui-lightness/ui.all.css" type="text/css" rel="stylesheet">
<script type="text/javascript" src="/knittyblog/js/jquery/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="/knittyblog/js/jquery/ui/ui.core.js"></script>
<script type="text/javascript" src="/knittyblog/js/jquery/ui/ui.draggable.js"></script>
<script type="text/javascript" src="/knittyblog/js/jquery/ui/ui.resizable.js"></script>
<script type="text/javascript" src="/knittyblog/js/jquery/ui/ui.dialog.js"></script>
<script type="text/javascript" src="/knittyblog/js/jquery/ui/external/bgiframe/jquery.bgiframe.js"></script>
<script type="text/javascript"><!--
function image_upload(field, preview) {
        alert('image_upload' + field + ":" + preview);
	$('#dialog').remove();

	$('.box').prepend('<div id="dialog" style="padding: 3px 0px 0px 0px;"><iframe src="index.php?route=admin/filemanager&field='
                            + encodeURIComponent(field)
                            + '" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="auto"></iframe></div>');

	$('#dialog').dialog({
		title: 'MOZ File Uplader',
		close: function (event, ui) {
			if ($('#' + field).attr('value')) {
				$.ajax({
					url: 'index.php?route=admin/filemanager/image',
					type: 'POST',
					data: 'image=' + encodeURIComponent($('#' + field).val()),
					dataType: 'text',
					success: function(data) {
						$('#' + preview).replaceWith('<img src="' + data + '" alt="" id="' + preview + '" class="image" onclick="image_upload(\'' + field + '\', \'' + preview + '\');" />');
					}
				});
			}
		},
		bgiframe: false,
		width: 700,
		height: 400,
		resizable: false,
		modal: false
	});
};
//--></script>