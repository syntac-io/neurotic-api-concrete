<div x-data="NeuroticContentView">
	<!-- Content Type -->
	<div class="form-group">
		<label><?= t('Content Type') ?></label>
		<select @change="update($el.value)" required class="form-control">
			<option value=""><?= t('Select Content Type') ?></option>
			<template x-for="(name, id) in contentTypes">
				<option :value="id" :selected="id == <?= $contentTypeID ?? 'null' ?>" x-text="name"></option>
			</template>
		</select>
	</div>

	<!-- Content -->
	<div x-show="listsForFields.contents" required class="form-group" style="display: none;">
		<label><?= t('Content') ?></label>
		<select class="form-control" name="bContentIdentifier">
			<option value=""><?= t('Select Content') ?></option>
			<template x-for="(name, id) in listsForFields.contents">
				<option :value="id" :selected="id === '<?= $bContentIdentifier ?>'" x-text="name"></option>
			</template>
		</select>
	</div>
</div>

<script>
	const NeuroticContentView = () => ({
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