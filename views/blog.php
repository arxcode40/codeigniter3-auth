<div class="container">
	<div class="row">
		<h1>Blog Page</h1>
		<?php if ($this->auth->allows('admin')): ?>
			<a class="btn btn-primary" href="<?= base_url('admin') ?>" role="button">Admin Page</a>
		<?php endif ?>
		<a class="btn btn-danger" href="<?= base_url('logout') ?>" role="button">Logout</a>
	</div>
</div>
