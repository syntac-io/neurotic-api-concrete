<?php

defined('C5_EXECUTE') or die("Access Denied."); ?>
<p>
	<?php
		if ($content) {
			/* Example response
				<?= $content->property('title') ?>
			*/
		} else {
			echo t('No content found.');
		}
	?>
</p>