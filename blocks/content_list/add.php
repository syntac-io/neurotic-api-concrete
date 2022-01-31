<div class="form-group">
	<label for="bContentTypeIdentifier"><?= t('Content Type') ?></label>
	<select name="bContentTypeIdentifier" id="bContentTypeIdentifier" required class="form-control">
		<?php foreach ($contentTypes as $identifier => $name): ?>
			<option value="<?= $identifier ?>" <?= $bContentTypeIdentifier === $identifier ? 'selected' : '' ?>><?= $name ?></option>
		<?php endforeach; ?>
	</select>
</div>