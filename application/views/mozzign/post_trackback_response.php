<? echo '<?xml version="1.0" encoding="utf-8"?>' ?>
<response>
	<error><? echo $error_code; ?></error>
	<?
		if($error_message != FALSE)
		{
	?>
			<message><? echo $error_message; ?></message>
	<?
		}
	?>
</response>