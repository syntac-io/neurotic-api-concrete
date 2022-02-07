<?php

defined('C5_EXECUTE') or die("Access Denied."); ?>
<p>
	<?php
		if ($content) {
			extract($properties);
			// Example usage: echo $title;
		} else {
			echo t('No content found.');
		}
	?>
</p>