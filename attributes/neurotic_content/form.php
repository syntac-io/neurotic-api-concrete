<div x-data="NeuroticContentView">
	<!-- Content Type -->
	<div class="form-group">
		<label><?= t('Content Type') ?></label>
		<select @change="update($el.value)" required class="form-control">
			<option value="" disabled><?= t('Select Content Type') ?></option>
			<?php foreach ($contentTypes as $id => $name): ?>
				<option value="<?= $id ?>" <?= $contentTypeID === $id ? 'selected' : '' ?>><?= $name ?></option>
			<?php endforeach; ?>
			</template>
		</select>
	</div>

	<!-- Content -->
	<div x-show="contentOptions" required class="form-group" style="display: none;">
		<label><?= t('Content') ?></label>
		<select class="form-control" name="<?= $view->field('value') ?>">
			<option value="" disabled><?= t('Select Content') ?></option>
			<template x-for="content in contentOptions">
				<option
					:value="content.identifier"
					:selected="content.identifier === '<?= $contentID ?>'"
					x-text="content.name"
				></option>
			</template>
		</select>
	</div>
</div>

<script>
	const NeuroticContentView = () => ({
		contents: <?= json_encode($contents) ?>,
		contentOptions: null,

		init() {
			const contentTypeID = <?= $contentTypeID ?? 'null' ?>;
			if (contentTypeID) this.update(contentTypeID)
		},

		update(contentTypeID) {
			let options = this.contents.filter(content => content.content_type.id == contentTypeID)

			this.contentOptions = options.map(entry => {
				let name = entry.properties.find(property => property.identifier === 'name'),
					title = entry.properties.find(property => property.identifier === 'title'),
					label = entry.properties.find(property => property.identifier === 'label');

				name = name ? name.value : null
				title = title ? title.value : null
				label = label ? label.value : null

				return {
					identifier: entry.identifier,
					name: name ?? title ?? label ?? entry.identifier,
				}
			})
		}
	})
</script>