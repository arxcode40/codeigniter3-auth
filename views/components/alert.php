<?php $alert = $this->session->flashdata('alert') ?>
<?php if ($alert): ?>
	<div class="alert alert-<?= $alert['status'] ?> alert-dismissible">
		<button class="close" data-dismiss="alert" type="button">
			<span>&times;</span>
		</button>
		<?= $alert['text'] ?>
	</div>
<?php endif ?>
