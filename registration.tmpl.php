<?php 
require(AT_INCLUDE_PATH.'header.inc.php'); 
?>

<script language="JavaScript" src="sha-1factory.js" type="text/javascript"></script>
<script type="text/javascript">
	function encrypt_password()
	{
		document.form.password_error.value = "";
	
		err = verify_password(document.form.form_password1.value, document.form.form_password2.value);
		
		if (err.length > 0)
		{
			document.form.password_error.value = err;
		}
		else
		{
			document.form.form_password_hidden.value = hex_sha1(document.form.form_password1.value);
			document.form.form_password1.value = "";
			document.form.form_password2.value = "";
		}
	}
</script>

<form method="post" action="<?php if (isset($_REQUEST["en_id"]) && $_REQUEST["en_id"] <> "") $getvars = '?en_id='. $_REQUEST["en_id"]; echo $_SERVER['PHP_SELF'] . $getvars; ?>" name="form">
	<?php global $languageManager, $_config, $moduleFactory; ?>
	<input name="ml" type="hidden" value="<?php echo $this->ml; ?>" />
	<input name="password_error" type="hidden" />
	<input type="hidden" name="form_password_hidden" value="" />
	<input type="hidden" name="registration_token" value="<?php echo sha1($_SESSION['token']); ?>" />
	
	<div class="input-form">
		<!-- Fieldset for all required information -->
		<fieldset class="group_form">
			<legend class="group_form"><h2><?php echo _AT('required_information'); ?></h2><!--11.20.2010 Symon: H2 Added--></legend>
            
            <!--<h4><?php /*echo _AT('required_field'); */?> = *</h4> Removing form revisions ************************-->
				
                
                <ol class="registration_info">

					<?php if (!$_POST['member_id'] && defined('AT_MASTER_LIST') && AT_MASTER_LIST && !admin_authenticate(AT_ADMIN_PRIV_USERS, TRUE)): ?>
						<li>
							<h3><?php echo _AT('account_authorization'); ?></h3>
						</li>
				
						<li>
							<span class="required" title="<?php echo _AT('required_field'); ?>">*
								<label for="student_id"><?php echo _AT('student_id'); ?></label>
							</span>
							
							<input id="student_id" name="student_id" type="text" size="15" maxlength="15" value="<?php echo stripslashes(htmlspecialchars($_POST['student_id'])); ?>" />
						</li>
				
						<li>
							<span class="required" title="<?php echo _AT('required_field'); ?>">*					
								<label for="student_pin"><?php echo _AT('student_pin'); ?></label>
							</span>
							
							<input id="student_pin" name="student_pin" type="password" size="15" maxlength="15" value="<?php echo stripslashes(htmlspecialchars($_POST['student_pin'])); ?>" />
						</li>
					<?php endif; ?>

<!-- Armin 29.10.2010 What is this code for??		 -->
					<?php 
						$table_title="
						<div class=\"row\">
							<h3>" . _AT('course_to_auto_enroll'). "</h3>
							<small>&middot; " ._AT('auto_enroll_msg')."</small>
						</div>";
						
						require(AT_INCLUDE_PATH.'html/auto_enroll_list_courses.inc.php'); 
					?>
					
<!-- 					<li> -->
					<li>
						<span class="required" title="<?php echo _AT('required_field'); ?>">
							<label for="login"><?php echo _AT('login_name'); ?></label>
						</span>
					
						
					<?php if ($_POST['member_id']) : ?>
						
							<span id="login"><?php echo stripslashes(htmlspecialchars($_POST['login'])); ?></span>
							<input name="member_id" type="hidden" value="<?php echo intval($_POST['member_id']); ?>" />
							<input name="login" type="hidden" value="<?php echo stripslashes(htmlspecialchars($_POST['login'])); ?>" />
						
					<?php else: ?>
						<!-- Armin 18.10.2010: add hint to also as title -->
						
							<input id="login" name="login" type="text" maxlength="20" size="30" value="<?php echo stripslashes(htmlspecialchars($_POST['login'])); ?>" title="<?php echo _AT('login_name').': '._AT('contain_only').' - '._AT('20_max_chars') ?>" />
						</li>
						<!-- <li class="explanation_small"><small><?php /*echo _AT('contain_only'); */ ?></small></li> Removing form revisions ************************-->
						<!--<li class="explanation_small"><small><?php /*echo _AT('20_max_chars'); */?></small></li> Removing form revisions ************************-->
					<?php endif; ?>
<!-- 					</div> -->
				
					<?php if (!admin_authenticate(AT_ADMIN_PRIV_USERS, TRUE) || !$_POST['member_id']): ?>
						<li>
							<span class="required" title="<?php echo _AT('required_field'); ?>">
								<label for="form_password1"><?php echo _AT('password'); ?></label>
							</span>
							
							<!-- Armin 18.10.2010: add hint to also as title -->
							<input id="form_password1" name="form_password1" type="password" size="15" maxlength="15" title="<?php echo _AT('password').': '._AT('combination').' - '._AT('15_max_chars') ?>" />
							<!--<p><?php /*echo _AT('combination'); */?></p> Removing form revisions ************************-->
								  <!--<p><?php /*echo _AT('15_max_chars'); */?></p> Removing form revisions ************************-->
						</li>
				
						<li>
							<span class="required" title="<?php echo _AT('required_field'); ?>">
								<label for="form_password2"><?php echo _AT('password_again'); ?></label>
							</span>
							
							<input id="form_password2" name="form_password2" type="password" size="15" maxlength="15" />
						</li>
					<?php endif; ?>
				
					<?php if (isset($_config['use_captcha']) && $_config['use_captcha']==1 && !$this->no_captcha): ?>
					<li>
						<span class="required" title="<?php echo _AT('required_field'); ?>">
							<label for="secret"><img src="<?php echo AT_INCLUDE_PATH; ?>securimage/securimage_show.php?sid=<?php echo md5(uniqid(time())); ?>" id="simage" align="left" /></label>
						</span>
						<a href="<?php echo AT_INCLUDE_PATH; ?>securimage/securimage_play.php" title="<?php echo _AT('audible_captcha'); ?>"><img src="<?php echo AT_INCLUDE_PATH; ?>securimage/images/audio_icon.gif" alt="<?php echo _AT('audible_captcha'); ?>" onclick="this.blur()" align="top" border="0"></a><br>
						<a href="#" title="<?php echo _AT('refresh_image'); ?>" onclick="document.getElementById('simage').src = '<?php echo AT_INCLUDE_PATH; ?>securimage/securimage_show.php?sid=' + Math.random(); return false"><img src="<?php echo AT_INCLUDE_PATH; ?>securimage/images/refresh.gif" alt="<?php echo _AT('refresh_image'); ?>" onclick="this.blur()" align="bottom" border="0"></a>
				
						
						<p><?php echo _AT('image_validation_text'); ?>
						<input id="secret" name="secret" type="text" size="6" maxlength="6" value="" />
						
						<small><?php echo _AT('image_validation_text2'); ?></small>
					</li>
					<?php endif; ?>
				
					<li>
						<span class="required" title="<?php echo _AT('required_field'); ?>">
							<label for="email"><?php echo _AT('email_address'); ?></label>
						</span>
						
						<input id="email" name="email" type="text" size="20" maxlength="50" value="<?php echo stripslashes(htmlspecialchars($_POST['email'])); ?>" />
						</li>
                       
					<li>
						<span class="required" title="<?php echo _AT('required_field'); ?>">
							<label for="email2"><?php echo _AT('email_again'); ?></label>
						</span>
						
						<input id="email2" name="email2" type="text" size="20" maxlength="50" value="<?php echo stripslashes(htmlspecialchars($_POST['email2'])); ?>" />
					</li>
                    
                     <li>
                        <input type="checkbox" id="priv" name="private_email" value="1" <?php if ($_POST['private_email'] || !isset($_POST['submit'])) { echo 'checked="checked"'; } ?> />
                        <label for="priv"><?php echo _AT('keep_email_private');?></label>
                        </li>
				
					<li>
						<span class="required" title="<?php echo _AT('required_field'); ?>">
							<label for="first_name"><?php echo _AT('first_name'); ?></label>
						</span>
						
						<input id="first_name" name="first_name" type="text" value="<?php echo stripslashes(htmlspecialchars($_POST['first_name'])); ?>" />
					</li>
				
					<li>
						<label for="second_name"><?php echo _AT('second_name'); ?></label>
						<input id="second_name" name="second_name" type="text" value="<?php echo stripslashes(htmlspecialchars($_POST['second_name'])); ?>" />
					</li>
				
					<li>
						<span class="required" title="<?php echo _AT('required_field'); ?>">
							<label for="last_name"><?php echo _AT('last_name'); ?></label>
						</span>
						
						<input id="last_name" name="last_name" type="text" value="<?php echo stripslashes(htmlspecialchars($_POST['last_name'])); ?>" />
					</li>
					
					<?php if (admin_authenticate(AT_ADMIN_PRIV_USERS, TRUE)): 
							if ($_POST['status'] == AT_STATUS_INSTRUCTOR) {
								$inst = ' checked="checked"';
							} else if ($_POST['status'] == AT_STATUS_STUDENT) {
								$stud = ' checked="checked"';
							}  else if ($_POST['status'] == AT_STATUS_DISABLED) {
								$disa = ' checked="checked"';
							} else {
								$uncon = ' checked="checked"';
							}?>
							<input type="hidden" name="id" value="<?php echo $_POST['member_id']; ?>" >
							<li>
								<span class="required" title="<?php echo _AT('required_field'); ?>"></span><?php echo _AT('account_status'); ?>
				
								<input type="radio" name="status" value="0" id="disa" <?php echo $disa; ?> /><label for="disa"><?php echo _AT('disabled'); ?></label>
								<?php if (defined('AT_EMAIL_CONFIRMATION') && AT_EMAIL_CONFIRMATION): ?>
									<input type="radio" name="status" value="1" id="uncon" <?php echo $uncon; ?> /><label for="uncon"><?php echo _AT('unconfirmed'); ?></label>
								<?php endif; ?>
				
								<input type="radio" name="status" value="2" id="stud" <?php echo $stud; ?> /><label for="stud"><?php echo _AT('student'); ?></label>
				
								<input type="radio" name="status" value="3" id="inst" <?php echo $inst; ?> /><label for="inst"><?php echo _AT('instructor'); ?></label>
				
								<input type="hidden" name="old_status" value="<?php echo $_POST['old_status']; ?>" />
							</li>
					<?php endif; ?>
					
			</ol>
		</fieldset>
		<!-- End: Fieldset for all required information -->
		
		<!-- Fieldset for all optional information -->
		<fieldset class="group_form">

			<legend class="group_form"><h2><?php echo _AT('personal_information').' ('._AT('optional').')'; ?></h2><!--11.20.2010 Symon: H2 Added--></legend>
            
            <ol class="optional_info">

			<?php 
			$mod = $moduleFactory->getModule('_standard/profile_pictures');
			if (admin_authenticate(AT_ADMIN_PRIV_USERS, TRUE) && $_POST['member_id'] && $mod->isEnabled() === TRUE): ?>
            
				<li>
					<?php echo _AT('picture'); ?>
					<?php if (profile_image_exists($_POST['member_id'])): ?>
						<a href="get_profile_img.php?id=<?php echo $_POST['member_id'].SEP.'size=o'; ?>"><?php print_profile_img($_POST['member_id']); ?></a>
						<input type="checkbox" name="profile_pic_delete" value="1" id="profile_pic_delete" /><label for="profile_pic_delete"><?php echo _AT('delete'); ?></label>
					<?php else: ?>
						<?php echo _AT('none'); ?> <a href="admin/profile_picture.php?member_id=<?php echo $_POST['member_id']; ?>"><?php echo _AT('add'); ?></a>
					<?php endif; ?>
				</li>
			<?php endif; ?>
		
			<?php if (admin_authenticate(AT_ADMIN_PRIV_USERS, TRUE) && defined('AT_MASTER_LIST') && AT_MASTER_LIST): ?>
				<input type="hidden" name="old_student_id" value="<?php echo $_POST['old_student_id']; ?>" />
				<li>
					<label for="student_id"><?php echo _AT('student_id'); ?></label>
						<input type="text" name="student_id" value="<?php echo $_POST['student_id']; ?>" size="20" />
				</li>
				<li>
					<input type="checkbox" id="overwrite" name="overwrite" value="1" <?php if ($_POST['overwrite']) { echo 'checked="checked"'; } ?> /><label for="overwrite"><?php echo _AT('overwrite_master');?></label>
				</li>
		
			<?php endif; ?>
		
			<li>
				<fieldset class="group_choice">
                
					<legend class="group_choice"><h3><?php echo _AT('date_of_birth'); ?></h3><!--11.20.2010 Symon: H3 Added--></legend>
					<ol id="date-of-birth">
                    <li><label for="year"><?php echo _AT('year'); ?>: </label>
					<input id="year" class="formfield" name="year" type="text" size="4" maxlength="4" value="<?php echo $_POST['year']; ?>" />
                    </li>
					<li><label for="month"><?php echo _AT('month'); ?>: </label>
					<input id="month" class="formfield" name="month" type="text" size="2" maxlength="2" value="<?php echo $_POST['month']; ?>" />
                    </li>
					<li><label for="day"><?php echo _AT('day'); ?>: </label>
					<input id="day" class="formfield" name="day" type="text" size="2" maxlength="2" value="<?php echo $_POST['day']; ?>" />
                    </li>
                    </ol>
				</fieldset>
			</li>
		
			<li>
				<fieldset class="group_choice">
                
					<legend class="group_choice"><h3><?php echo _AT('gender'); ?></h3><!--11.20.2010 Symon: H3 Added--></legend>
                    <ol id="gender">
                    <li>
					<label for="m"><?php echo _AT('male'); ?></label>
					<input type="radio" name="gender" id="m" value="m" <?php if ($_POST['gender'] == 'm') { echo 'checked="checked"'; } ?> />
					</li>
                    <li>
                    <label for="f"><?php echo _AT('female'); ?></label>
					<input type="radio" value="f" name="gender" id="f" <?php if ($_POST['gender'] == 'f') { echo 'checked="checked"'; } ?> />
					</li>
                    <li>
                    <label for="ns"><?php echo _AT('not_specified'); ?></label>
					<input type="radio" value="n" name="gender" id="ns" <?php if (($_POST['gender'] == 'n') || ($_POST['gender'] == '')) { echo 'checked="checked"'; } ?> />					
				 	</li>
                    </ol>
                    
                </fieldset>
			</li>
			</ol>
            
            <!-- Fieldset added because there was nothing distinguishing the address info from the gender info -->

            <fieldset class="group_choice">
                
					<legend class="group_choice"><h3>Address</h3><!--11.20.2010 Symon: H3 Added--></legend>
                    
             <!-- All of this was added, there is no correct PHP markup -->
            <ol class="optional_info">
			<li>
				<label for="address"><?php echo _AT('street_address'); ?></label>
				<input id="address" name="address" size="40" type="text" value="<?php echo stripslashes(htmlspecialchars($_POST['address'])); ?>" />
			</li>
		
			<li>
				<label for="postal"><?php echo _AT('postal_code'); ?></label>
				<input id="postal" name="postal" size="7" type="text" value="<?php echo stripslashes(htmlspecialchars($_POST['postal'])); ?>" />
			</li>
		
			<li>
				<label for="city"><?php echo _AT('city'); ?></label>
				<input id="city" name="city" type="text" value="<?php echo stripslashes(htmlspecialchars($_POST['city'])); ?>" />
			</li>
		
			<li>
				<label for="province"><?php echo _AT('province'); ?></label>
				<input id="province" name="province" type="text" value="<?php echo stripslashes(htmlspecialchars($_POST['province'])); ?>" />
			</li>
		
			<li>
				<label for="country"><?php echo _AT('country'); ?></label>
				<input id="country" name="country" type="text" value="<?php echo stripslashes(htmlspecialchars($_POST['country'])); ?>" />
			</li>
		
			<li>
				<label for="phone"><?php echo _AT('phone'); ?></label>
				<input size="11" name="phone" type="text" value="<?php echo stripslashes(htmlspecialchars($_POST['phone'])); ?>" id="phone" />
			</li>
		
			<li>
				<label for="website"><?php echo _AT('web_site'); ?></label>
				<input id="website" name="website" size="40" type="text" value="<?php if ($_POST['website'] == '') { echo 'http://'; } else { echo stripslashes(htmlspecialchars($_POST['website'])); } ?>" />
			</li>
            </ol>
		</fieldset>
		<!-- End: Fieldset for all optional information -->
		<div class="row buttons">
			<input type="submit" name="submit" value=" <?php echo _AT('save'); ?> " accesskey="s" onClick="encrypt_password()" class="button"/>
			<input type="submit" name="cancel" value=" <?php echo _AT('cancel'); ?> "  class="button" />
		</div>
	</div>
</form>

<?php require(AT_INCLUDE_PATH.'footer.inc.php'); ?>