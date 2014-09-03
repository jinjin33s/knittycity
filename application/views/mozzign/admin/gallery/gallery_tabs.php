

<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/styles/jquery.fancybox.css" media="screen" />
<script type="text/javascript" src="<?php echo base_url();?>/scripts/jquery.fancybox-1.2.1.pack.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$(".gallerypic a").fancybox();
	});
</script>

                    <div id="tabs" class="htabs">
			<a href="<?php echo site_url("admin_gallery/gallery")?>"<?php if ($this->uri->segment(3) == "gallery") echo ' class="active"'; ?>>Manage Gallery</a>
                       
			
                    </div>
			<div id="content-box">