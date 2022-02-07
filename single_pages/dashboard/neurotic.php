<!-- Welcome message -->
<p class="alert alert-info">
	<?= t(sprintf('Welcome to %s v%s.', $package->getPackageName(), $package->getPackageVersion())) ?>
</p>

<!-- Settings -->
<section class="card">
	<h5 class="card-header"><?= t('Settings') ?></h5>
	<div class="card-body">
		<!-- Form -->
		<form action="<?= $this->action('submit') ?>" method="POST">
			<!-- Origin -->
			<div class="form-group">
				<label for="origin" <?= isset($errors['origin']) ? 'class="text-danger"' : '' ?>><?= t('Origin URL') ?></label>
				<input type="url" name="origin" value="<?= $origin ?>" id="origin" placeholder="https://manager.domain.com" required class="form-control <?= isset($errors['origin']) ? 'border-danger text-danger' : '' ?>">
				<?php if (isset($errors['origin'])) : ?><p class="text-danger"><?= $errors['origin'] ?></p><?php endif; ?>
			</div>

			<!-- API Token -->
			<div class="form-group">
				<label for="api_token" <?= isset($errors['api_token']) ? 'class="text-danger"' : '' ?>><?= t('API Token') ?></label>
				<input type="password" name="api_token" value="<?= $apiToken ?>" id="api_token" required class="form-control <?= isset($errors['api_token']) ? 'border-danger text-danger' : '' ?>">
				<?php if (isset($errors['api_token'])) : ?><p class="text-danger"><?= $errors['api_token'] ?></p><?php endif; ?>
			</div>

			<!-- Submit -->
			<button class="btn btn-primary"><?= t('Save Settings') ?></button>
		</form>
	</div>
</section>