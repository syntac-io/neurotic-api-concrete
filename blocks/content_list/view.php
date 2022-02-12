<?php if ($contents): ?>
	<p>
		<?= t(sprintf('Found %s records.', '<strong>' . $contents['total'] . '</strong>')) ?>
	</p>
	<ul>
		<?php foreach($contents as $content): ?>
			<?php /* Example response
				<li>
					<?= $content->property('title') ?>
				</li>
			*/ ?>
		<?php endforeach; ?>
	</ul>
<?php else: ?>
	<p>
		<?= t('Nothing to show.') ?>
	</p>
<?php endif; ?>