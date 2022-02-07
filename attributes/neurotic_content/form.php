<div x-data="NeuroticContentAttribute">
	<!-- Content Type -->
	<div class="form-group">
		<select @change="update($el.value)" class="form-control">
			<option value=""><?= t('Select Content Type') ?></option>
			<template x-for="(name, id) in contentTypes">
				<option :value="id" :selected="id == <?= $contentTypeID ?? 'null' ?>" x-text="name"></option>
			</template>
		</select>
	</div>

	<!-- Content -->
	<div x-show="listsForFields.contents" class="form-group" style="display: none;">
		<select class="form-control" name="<?= $view->field('value') ?>">
			<option value=""><?= t('Select Content') ?></option>
			<template x-for="(name, id) in listsForFields.contents">
				<option :value="id" :selected="id === '<?= $contentID ?>'" x-text="name"></option>
			</template>
		</select>
	</div>
</div>

<script>
	const NeuroticContentAttribute = () => ({
		contentTypes: <?= json_encode($contentTypes) ?>,
		contents: <?= json_encode($contents) ?>,
		listsForFields: {
			contents: null,
		},

		init() {
			const contentTypeID = <?= $contentTypeID ?? 'null' ?>
			
			if (contentTypeID) {
				this.update(contentTypeID)
			}
		},

		update(contentTypeID) {
			this.listsForFields.contents = this.contents[contentTypeID]
		}
	})
</script>