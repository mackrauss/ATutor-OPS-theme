<!-- Include the header -->
<?php require(AT_INCLUDE_PATH.'header.inc.php'); ?>

<script language="JavaScript" src="sha-1factory.js" type="text/javascript"></script>

<script type="text/javascript">
/* 
 * Encrypt login password with sha1
 */
function encrypt_password() {
	document.form.form_password_hidden.value = hex_sha1(hex_sha1(document.form.form_password.value) + "<?php echo $_SESSION['token']; ?>");
	document.form.form_password.value = "";
	return true;
}
</script>
<div class="column">
	<!-- Login box -->
	<div class="current_box">
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="form">
			<input type="hidden" name="form_login_action" value="true" />
			<input type="hidden" name="form_course_id" value="<?php echo $this->form_course_id; ?>" />
			<input type="hidden" name="form_password_hidden" value="" />
			<input type="hidden" name="p" value="<?php echo urlencode($_GET['p']);?>" />
		
			<fieldset class="group_form">
				<legend class="group_form"><?php echo _AT('returning_user') ;?></legend>
				<p><?php echo _AT('login_text') ;?></p>
				<?php if ($_GET['course']): ?>
					                   
				<?php endif;?>

				<label for="login"><?php echo _AT('login_name_or_email'); ?></label><br />
				<input type="text" name="form_login" size="50" style="max-width: 80%; width: 80%;" id="login" /><br /><br/>

				<label for="pass"><?php echo _AT('password'); ?></label><br />
				<input type="password" class="formfield" name="form_password" style="max-width: 80%; width: 80%;" id="pass" />
				<br /><br />
				<input type="submit" name="submit" value="<?php echo _AT('login'); ?>" class="button" onclick="return encrypt_password();" /> 
				<div style="float: right">
					<a href="<?php echo $this->sub_level_pages[1]['url']; ?>"><?php echo htmlentities_utf8($this->sub_level_pages[1]['title']); ?></a>
				</div>
			</fieldset>			
		
		</form>
	</div>
	<!-- Login box end -->
</div>

<!-- Registration and course browse are only shown if allow_registration is set to 1 -->
<?php
if($_config['allow_registration'] ==1){
?>
<div class="column">
	<!-- Registration box -->
	<div class="current_box">	
		<form action="registration.php" method="get">			
			<fieldset class="group_form">
				<legend class="group_form"><?php echo _AT('new_user') ;?></legend>
				
				<p><?php echo _AT('registration_text'); ?></p>
	
				<?php if (defined('AT_EMAIL_CONFIRMATION') && AT_EMAIL_CONFIRMATION): ?>
					<p><?php echo _AT('confirm_account_text'); ?></p>
				<?php endif; ?>
				
				<input type="submit" name="register" value="<?php echo _AT('register'); ?>" class="button" />
			</fieldset>			
		</form>
	</div>
	<!-- Registration box end -->
	
	<!-- Browse course box -->
<!--
	<div class="current_box">
		<fieldset >
			<form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">	
				<h3>Browse Courses</h3>
		
				<?php if ($this->has_categories): ?>
					<label for="category"><?php echo _AT('category'); ?></label>
					<br/>
					<select name="category" id="category">
						<option value="-1">- - - <?php echo _AT('cats_all'); ?> - - -</option>
						<option value="0" <?php if ($_GET['category'] == 0) { echo 'selected="selected"'; } ?>>- - - <?php echo _AT('cats_uncategorized'); ?> - - -</option>
						<?php echo $this->categories_select; ?>
					</select>
				<?php endif; ?>
				
				<label for="search"><?php echo _AT('search'); ?> (<?php echo _AT('title').', '._AT('description'); ?>)</label>
				<br />
				<input type="text" name="search" id="search" size="20" value="<?php echo htmlspecialchars($_GET['search']); ?>" />
				<br/>
				<?php echo _AT('search_match'); ?>:
				<input type="radio" name="include" value="all" id="match_all" <?php echo $this->checked_include_all; ?> />
				<label for="match_all"><?php echo _AT('search_all_words'); ?></label> 
				<input type="radio" name="include" value="one" id="match_one" <?php echo $this->checked_include_one; ?> />
				<label for="match_one"><?php echo _AT('search_any_word'); ?></label>
				<br/>
				<input type="submit" name="filter" class="button" value="<?php echo _AT('Browse'); ?>"/>		
			</form>
		</fieldset>
	</div>
-->
	<!-- Browse course box end -->	

<!-- End of: Registration and course browse are only shown if allow_registration is set to 1 -->
</div>
<?php } ?>

<!--	<br style="clear:both;" /> -->

<?php require(AT_INCLUDE_PATH.'footer.inc.php'); ?>
