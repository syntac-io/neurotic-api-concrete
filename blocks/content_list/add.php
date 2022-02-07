<div class="form-group">
	<label for="bContentTypeIdentifier"><?= t('Content Type') ?></label>
	<select name="bContentTypeIdentifier" id="bContentTypeIdentifier" required class="form-control">
		<option value="" disabled><?= t('Select Content Type') ?></option>
		<?php foreach ($contentTypes as $identifier => $name): ?>
			<option value="<?= $identifier ?>" <?= $bContentTypeIdentifier === $identifier ? 'selected' : '' ?>><?= $name ?></option>
		<?php endforeach; ?>
	</select>
</div>