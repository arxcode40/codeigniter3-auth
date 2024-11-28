<div class="container" style="padding-block: 1.5rem;">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title"><?= ucfirst($this->lang->line('auth_register_title')) ?></h3>
				</div>
				<div class="panel-body">
					<?php $this->load->view('components/alert') ?>
					<?= form_open(uri_string()) ?>
						<div class="form-horizontal">
							<div class="form-group <?= form_error('name') ? 'has-error' : '' ?>">
								<label class="col-md-4 control-label" for="name"><?= ucfirst($this->lang->line('auth_name_label')) ?></label>
								<div class="col-md-6">
									<input autocomplete="name" autofocus="autofocus" class="form-control" id="name" name="name" type="text" value="<?= set_value('name') ?>" />
									<?= form_error('name', '<span class="help-block">', '</span>') ?>
								</div>
							</div>
							<div class="form-group <?= form_error('username') ? 'has-error' : '' ?>">
								<label class="col-md-4 control-label" for="username"><?= ucfirst($this->lang->line('auth_username_label')) ?></label>
								<div class="col-md-6">
									<input autocomplete="username" class="form-control" id="username" name="username" type="text" value="<?= set_value('username') ?>" />
									<?= form_error('username', '<span class="help-block">', '</span>') ?>
								</div>
							</div>
							<div class="form-group <?= form_error('password') ? 'has-error' : '' ?>">
								<label class="col-md-4 control-label" for="password"><?= ucfirst($this->lang->line('auth_password_label')) ?></label>
								<div class="col-md-6">
									<input autocomplete="new-password" class="form-control" id="password" name="password" type="password" />
									<?= form_error('password', '<span class="help-block">', '</span>') ?>
								</div>
							</div>
							<div class="form-group <?= form_error('confirm_password') ? 'has-error' : '' ?>">
								<label class="col-md-4 control-label" for="confirmPassword"><?= ucfirst($this->lang->line('auth_confirm_password_label')) ?></label>
								<div class="col-md-6">
									<input autocomplete="new-password" class="form-control" id="confirmPassword" name="confirm_password" type="password" />
									<?= form_error('confirm_password', '<span class="help-block">', '</span>') ?>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-8 col-md-offset-4">
									<button class="btn btn-primary" type="submit"><?= ucfirst($this->lang->line('auth_register_title')) ?></button>
									<a class="btn btn-default" href="<?= base_url('login') ?>"><?= ucfirst($this->lang->line('auth_login_title')) ?></a>
								</div>
							</div>
						</div>
					<?= form_close() ?>
				</div>
			</div>
		</div>
	</div>
</div>
