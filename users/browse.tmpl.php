<?php require(AT_INCLUDE_PATH.'header.inc.php'); ?>
<div class="input-form" >
<fieldset class="group_form"><legend class="group_form"><?php echo _AT('filter'); ?></legend>
	<form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		
			
		<?php if ($this->has_categories): ?>
		
				<label for="category"><?php echo _AT('category'); ?></label><br/>
				<select name="category" id="category">
					<option value="-1">- - - <?php echo _AT('cats_all'); ?> - - -</option>
					<option value="0" <?php if ($_GET['category'] == 0) { echo 'selected="selected"'; } ?>>- - - <?php echo _AT('cats_uncategorized'); ?> - - -</option>
					<?php echo $this->categories_select; ?>
				</select>
			</div>
		<?php endif; ?>

				<label for="search"><?php echo _AT('search'); ?> (<?php echo _AT('title').', '._AT('description'); ?>)</label><br />

				<input type="text" name="search" id="search" size="40" value="<?php echo htmlspecialchars($_GET['search']); ?>" /> <input type="submit"  class="button" name="filter" value="<?php echo _AT('Browse'); ?>"/>
				<br/>
				<?php echo _AT('search_match'); ?>:
				<input type="radio" name="include" value="all" id="match_all" <?php echo $this->checked_include_all; ?> /><label for="match_all"><?php echo _AT('search_all_words'); ?></label> 
				<input type="radio" name="include" value="one" id="match_one" <?php echo $this->checked_include_one; ?> /><label for="match_one"><?php echo _AT('search_any_word'); ?></label>


		
	</form>
</fieldset>
</div>
<div class="row">
				<h3><?php echo _AT('results_found', $this->num_results); ?></h3>
			</div>
			<div class="row">
				

<div class="container">
<table class="data">
<tr>
<th><?php echo _AT('title'); ?></th>
<th><?php echo _AT('action'); ?></th>
<th><?php echo _AT('instructor'); ?></th>

</tr>
<?php if (is_array($this->courses_rows)){ ?>
	<?php foreach ($this->courses_rows as $row){ ?>
	    <?php  $counter++; ?>
		 <tr class="<?php if ($counter %2) { echo 'odd'; } else { echo 'even'; } ?>">
		 
		<td>
				 <a href="<?php echo url_rewrite('bounce.php?course='.$row['course_id'], true); ?>"><?php echo htmlentities($row['title'], ENT_QUOTES, 'UTF-8'); ?></a> 
		</td>
        
		<td>
			<span class="begincourse"><a href="<?php echo url_rewrite('bounce.php?course='.$row['course_id'], true); ?>">Begin Course
            </a><img src="<?php echo $this->img; ?>beginarrow.png"/></span> </span>
			<span class="enrollme"><?php
		    // insert enrolment link if allowed
		    if (isset($row['enroll_link'])) : ?> 
			 <?php echo $row['enroll_link']; ?><img src="<?php echo $this->img; ?>enroll.png"/>
		<?php endif; ?></span>
		</td>
		
		<td>
				<a href="<?php echo AT_BASE_HREF; ?>contact_instructor.php?id=<?php echo $row['course_id']; ?>"><?php echo get_display_name($row['member_id']); ?></a>
		</td>
	
		</tr>
	      
	<?php } // end foreach ?>
<?php } // end if ?>
</table>
</div>

<?php require(AT_INCLUDE_PATH.'footer.inc.php'); ?>