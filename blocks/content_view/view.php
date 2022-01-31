<?php if ($content): ?>
	<div>
		<?php /* Example response
			$title = $content['properties'][array_search('title', array_column($content['properties'], 'identifier'))]['value'] ?? null;
			echo $title;
		*/ ?>
	</div>
<?php else: ?>
	<p>
		<?= t('Nothing to show.') ?>
	</p>
<?php endif; ?>