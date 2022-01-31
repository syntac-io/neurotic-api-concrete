<?php if ($contents): ?>
	<p>
		<?= t(sprintf('Found %s records.', '<strong>' . $contents['total'] . '</strong>')) ?>
	</p>
	<ul>
		<?php foreach($contents['items'] as $content): ?>
			<?php /* Example response
				<li>
					<?php
						$title = $content['properties'][array_search('title', array_column($content['properties'], 'identifier'))]['value'] ?? null;
						echo $title;
					?>
				</li>
			*/ ?>
		<?php endforeach; ?>
	</ul>
<?php else: ?>
	<p>
		<?= t('Nothing to show.') ?>
	</p>
<?php endif; ?>