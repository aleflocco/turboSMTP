<div class="wrap turboSMTP">
	<div class="turboSMTP-logo"><h2><img src="<?php echo plugins_url( 'images/logo.png' ,  __FILE__ ) ?>" hspace="0" vspace="0" border="0" /></h2></div>
	<div class="turboSMTP-left">
		<h2>
			<?php _e('Email settings','turboSMTP'); ?>
		</h2>
		<p>
			<?php _e('The sender address and sender name here specified will be used for all emails sent on Wordpress via turboSMTP.','turboSMTP'); ?>
		</p>
		<form action="" method="post" enctype="multipart/form-data" name="turboSMTP_form">
			<table class="form-table">
				<tr valign="top">
					<th scope="row"> <label for="turboSMTP_mail_from">
							<?php _e('Email "From" address','turboSMTP'); ?>
						</label>
					</th>
					<td><input type="text" id="turboSMTP_mail_from" name="turboSMTP_mail_from" value="<?php echo $tsOptions["from"]; ?>" size="43" style="width:272px;height:24px;" /></td>
				</tr>
				<tr valign="top">
					<th scope="row"> <label for="turboSMTP_mail_fromname">
							<?php _e('Email "From" name','turboSMTP'); ?>
						</label>
					</th>
					<td><input type="text" id="turboSMTP_mail_fromname" name="turboSMTP_mail_fromname" value="<?php echo $tsOptions["fromname"]; ?>" size="43" style="width:272px;height:24px;" /></td>
				</tr>
			</table>
			<h2>
				<?php _e('SMTP Options','turboSMTP'); ?>
			</h2>
			<table class="form-table">
				<tr valign="top">
					<th scope="row"><label for="turboSMTP_mail_host">
							<?php _e('SMTP Host','turboSMTP'); ?>
						</label>
					</th>
					<td><input type="text" id="turboSMTP_mail_host" name="turboSMTP_mail_host" value="<?php echo $tsOptions["host"]; ?>" size="43" style="width:272px;height:24px;" /></td>
				</tr>
				<tr valign="top">
					<th scope="row"><?php _e('SMTP Encryption','turboSMTP'); ?>
					</th>
					<td><p>
							<input id="turboSMTP_mail_smtpsecure_none" name="turboSMTP_mail_smtpsecure" type="radio" value=""<?php if ($tsOptions["smtpsecure"] == '') { ?> checked="checked"<?php } ?> />
							<label for="turboSMTP_mail_smtpsecure_none">
								<?php _e('No encryption','turboSMTP'); ?>
							</label>
						</p>
						<p>
							<input id="turboSMTP_mail_smtpsecure_ssl" name="turboSMTP_mail_smtpsecure" type="radio" value="ssl"<?php if ($tsOptions["smtpsecure"] == 'ssl') { ?> checked="checked"<?php } ?> />
							<label for="turboSMTP_mail_smtpsecure_ssl">
								<?php _e('Use SSL encryption','turboSMTP'); ?>
							</label>
						</p></td>
				</tr>
				<tr valign="top">
					<th scope="row"><label for="turboSMTP_mail_port">
							<?php _e('SMTP Port','turboSMTP'); ?>
						</label>
					</th>
					<td><input type="text" id="turboSMTP_mail_port" name="turboSMTP_mail_port" value="<?php echo $tsOptions["port"]; ?>" size="43" style="width:50px;height:24px;" />
						<br>
						<span class="description">
						<?php _e('Use 25, 587 or 2525 for non encrypted connection, 465 or 25025 for encrypted connection','turboSMTP'); ?>
						</span></td>
				</tr>
			</table>
			<h2>
				<?php _e('SMTP Authentication','turboSMTP'); ?>
			</h2>
			<table class="form-table">
				<tr valign="top">
					<th scope="row"><label for="turboSMTP_mail_username">
							<?php _e('turboSMTP username','turboSMTP'); ?>
						</label>
					</th>
					<td><input type="text" id="turboSMTP_mail_username" name="turboSMTP_mail_username" value="<?php echo $tsOptions["username"]; ?>" size="43" style="width:272px;height:24px;" /></td>
				</tr>
				<tr valign="top">
					<th scope="row"><label for="turboSMTP_mail_password">
							<?php _e('turboSMTP password','turboSMTP'); ?>
						</label>
					</th>
					<td><input type="password" id="turboSMTP_mail_password" name="turboSMTP_mail_password" value="<?php echo $tsOptions["password"]; ?>" size="43" style="width:272px;height:24px;" /></td>
				</tr>
			</table>
			<p class="submit">
				<input type="hidden" name="turboSMTP_mail_deactivate" value="yes" />
				<input type="hidden" name="turboSMTP_mail_smtpauth" value="yes" />
				<input type="hidden" name="turboSMTP_mail_update" value="update" />
				<input type="hidden" name="turboSMTP_mail_nonce_update" value="<?php echo $ts_nonce; ?>" />
				<input type="submit" class="button-primary" name="Submit" value="<?php _e('Save Changes'); ?>" />
			</p>
		</form>
		<h2>
			<?php _e('Send a Test Email','turboSMTP'); ?>
		</h2>
		<form action="" method="post" enctype="multipart/form-data" name="turboSMTP_mail_testform">
			<table class="form-table">
				<tr valign="top">
					<th scope="row"><label for="turboSMTP_mail_to">
							<?php _e('To:','turboSMTP'); ?>
						</label>
					</th>
					<td><input type="text" id="turboSMTP_mail_to" name="turboSMTP_mail_to" value="" size="43" style="width:272px;height:24px;" />
						<br>
						<span class="description">
						<?php _e('Type an email address here and then click Send Test to generate a test email.','turboSMTP'); ?>
						</span></td>
				</tr>
			</table>
			<p class="submit">
				<input type="hidden" name="turboSMTP_mail_subject" value="<?php _e('[turboSMTP WP] Your plugin is working','turboSMTP');?>"/>
				<input type="hidden" name="turboSMTP_mail_message" value="<?php _e('If you are reading this email, it is because your plugin is successfully configured.','turboSMTP');?>"/>
				<input type="hidden" name="turboSMTP_mail_test" value="test" />
				<input type="hidden" name="turboSMTP_mail_nonce_test" value="<?php echo $ts_nonce; ?>" />
				<input type="submit" class="button-primary" value="<?php _e('Send Test','turboSMTP'); ?>" />
			</p>
		</form>
	</div>
	<div class="turboSMTP-right">
		<h3>
			<?php _e('Still don\'t have an account?','turboSMTP'); ?>
		</h3>
		<p>
			<?php _e('Register now and get 6.000 emails/month lifetime','turboSMTP'); ?>
		</p>
		<p><a class="button-primary turboSMTP-free" href="https://www.serversmtp.com/en/signup" target="_blank">
			<?php _e('Get turboSMTP free','turboSMTP'); ?>
			</a></p>
		<p>&nbsp;</p>
		<h3>
			<?php _e('Need help?','turboSMTP'); ?>
		</h3>
		<p><a href="http://serversmtp.com/en/contact-us" target="_blank">
			<?php _e('Contact turboSMTP support','turboSMTP'); ?>
			</a></p>
	</div>
	<div class="clear"></div>
</div>
