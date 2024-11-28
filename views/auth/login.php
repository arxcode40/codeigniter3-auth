<div class="container" style="padding-block: 1.5rem;">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title"><?= ucfirst($this->lang->line('auth_login_title')) ?></h3>
				</div>
				<div class="panel-body">
					<?php $this->load->view('components/alert') ?>
					<?= form_open(uri_string()) ?>
						<div class="form-horizontal">
							<div class="form-group <?= form_error('username') ? 'has-error' : '' ?>">
								<label class="col-md-4 control-label" for="username"><?= ucfirst($this->lang->line('auth_username_label')) ?></label>
								<div class="col-md-6">
									<input autocomplete="username" autofocus="autofocus" class="form-control" id="username" name="username" type="text" value="<?= set_value('username') ?>" />
									<?= form_error('username', '<span class="help-block">', '</span>') ?>
								</div>
							</div>
							<div class="form-group <?= form_error('password') ? 'has-error' : '' ?>">
								<label class="col-md-4 control-label" for="password"><?= ucfirst($this->lang->line('auth_password_label')) ?></label>
								<div class="col-md-6">
									<input autocomplete="current-password" class="form-control" id="password" name="password" type="password" />
									<?= form_error('password', '<span class="help-block">', '</span>') ?>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-6 col-md-offset-4">
									<div class="checkbox">
										<label>
											<input <?= set_checkbox('remember', 'remember') ?> id="remember" name="remember" type="checkbox" value="remember" />
											<?= ucfirst($this->lang->line('auth_remember_me_label')) ?>
										</label>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-8 col-md-offset-4">
									<button class="btn btn-primary" type="submit"><?= ucfirst($this->lang->line('auth_login_title')) ?></button>
									<a class="btn btn-default" href="<?= base_url('register') ?>"><?= ucfirst($this->lang->line('auth_register_title')) ?></a>
								</div>
							</div>
						</div>
					<?= form_close() ?>
				</div>
			</div>
		</div>
	</div>
</div>
