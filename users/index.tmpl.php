<?php require(AT_INCLUDE_PATH.'header.inc.php'); ?>

<!-- List of users' courses -->
<div id="my_courses_container">
	<table class="data" >
		<tr>
			<th><?php echo _AT('course'); ?></th>
			<th> <?php echo _AT('Action'); ?> </th>
			<th><?php echo _AT('instructor'); ?></th>
		</tr>
		<?php 
			foreach ($this->courses as $row):
			
			// Harris and Armin 19.08.2010: retrieve the top level content page for each course
			$sql = 'SELECT content_id FROM '.TABLE_PREFIX."content WHERE course_id=$row[course_id] AND content_parent_id=0 AND ordering=1";
			$result = mysql_query($sql, $db);
			if ($result){
				$cp_row = mysql_fetch_assoc($result);
			}
			static $counter;
			$counter++;
		?>		
			<tr class="<?php if ($counter %2) { echo 'odd'; } else { echo 'even'; } ?>">
			
				<!-- COURSES! --><td>
					<!-- Armin: changed call to course and point at first content element to start course right away -->
					<!-- Harris and Armin 19.08.2010 pointing at first element in the tree now -->
					<?php echo '<a href="'.url_rewrite('bounce.php?course=' . $row['course_id']).SEP. 'p='.urlencode('content.php?cid='.$cp_row['content_id']) . '"> '.htmlentities_utf8($row['title']).'</a>' ?>
					<br />
				</td>
               <!-- ACTIONS! --> <td> 
					
                    
                 
                            					<!-- resume links -->

                            <?php if ($row['last_cid']): ?>
							
							<span class="begincourse"><a href="bounce.php?course=<?php echo $row['course_id'].SEP.'p='.urlencode('content.php?cid='.$row['last_cid']); ?>"><?php echo _AT('resume_course'); ?>
								<img src="<?php echo $_base_href;  ?>themes/ocadnew/images/beginarrow.png" border="" alt="<?php echo _AT('resume'); ?>" title="<?php echo _AT('resume'); ?>" /> 
							</a></span>
					<?php endif; ?>
                    
                                        <!--unenroll me -->

                       <span class="unenrollme"><?php if ($row['member_id'] != $_SESSION['member_id']  && $_config['allow_unenroll'] == 1): ?>
									<a href="users/remove_course.php?course=<?php echo $row['course_id']; ?>"><?php echo _AT('unenroll_me'); ?> <img src="<?php echo $this->img; ?>unenroll.png" border="0"/></a>
							<?php endif; ?></span>
							<?php if ($row['tests']): ?>
								<?php foreach ($row['tests'] as $test): ?>
										<a href="bounce.php?course=<?php echo $row['course_id'].SEP.'p='.urlencode('mods/_standard/tests/test_intro.php?tid='.$test['test_id']); ?>">
										<span title="<?php echo _AT('tests'); ?>:<?php echo $test['title']; ?>"><?php echo $test['title']; ?></span>
										</a>
								<?php endforeach ;?>
							<?php endif; ?>
                    
                                    </td>
				<!-- PROFESSORS --><td>
					<?php echo '<a href="'.AT_BASE_HREF.'inbox/send_message.php?id='.$row['member_id'].'">'. get_display_name($row['member_id']).'<a/>'; ?>
				</td>
					
				
			</tr>
		<?php endforeach; ?>
	</table>
</div>
<!-- End: List of users' courses -->

<!-- recent activity -->
<div class="recent_activity_container">
	<h2 class="page-title"><?php echo _AT('Recent Activity'); ?></h2>
	<div class="recent_activity_box">
		<div> 
			<?php 
				
			//display current news
			// Armin 18.08.2010 set per page maximum here in one place (important for toggeling)
 			$max_news = 3;
		
			if($_GET['p'] == 0){
			  $p = 1;
			}else{
			  $p = intval($_GET['p']);
			}
// 			if($_GET['p'] == "all"){
// 			  //$perpage = count($this->all_news);
// 			  // Armin 18.08.2010: Per page maximum of 5
// 			  $perpage = $max_news;
// 			}else{
// 			  $perpage = 2;
// 			}
// 		
// 			$newscount = count($this->all_news);
// 			// Armin 18.08.2010: Modify the recent activity so that only up to 6 itmes are displayed
// 			if ($newscount >= 4)
// 			{
// 				$newscount = 3;
// 			}
			// Armin end

			// Armin 19.08.2010: Only show n items with now ability to switch pages
			if (count($this->all_news) < $max_news) {
				$perpage = count($this->all_news) - 1;
			}
			else {
				$perpage = $max_news;
			}
			$newscount = $max_news;

			if ($perpage != 0)
			{
				$num_pages = (ceil($newscount/$perpage));;
			}
			$start = ($p-1)*$perpage;
			$end = ($p*$perpage);

			// Armin 19.08.2010 Do not print the page changer anymore
			//print_paginator($page, $num_pages, '', 1);
			if (isset($this->all_news) && count($this->all_news) > 0) {
				for($i=$start;$i<=$end; $i++){
					$count = $i;
					if (isset($this->all_news) && count($this->all_news) > 0) {
						echo '<ul class="recent_item">';
						if(isset($this->all_news[$i]['thumb'])){
							echo '<li"><img src="'.$this->all_news[$i]['thumb'].'" alt="'.$this->all_news[$i]['alt'].'" title="'.$this->all_news[$i]['alt'].'"/> ' . $this->all_news[$i]['link'] .' <br />';
							if($this->all_news[$i]['object']['course_id']){
							echo '<small>(<a href="bounce.php?course='.$this->all_news[$i]['object']['course_id'].'">'.$this->all_news[$i]['course'].'</a>)|';
							}
							echo '('.AT_DATE('%F %j, %g:%i',$this->all_news[$i]['time']).')</small></li>';
						}
						echo '</ul>';
					}
				}
			}
			else {
				echo _AT('none_found');
			}
			?>
<!-- Armin 19.08.2010 Not toggling link -->
<!--
			<?php
				// Armin 18.08.2010 use new $max_news instead of count($this->all_news)
				if($perpage == $max_news){ ?>
				<a class="toggle-view" href="<?php echo $_SERVER['PHP_SELF']; ?>?p=1"><?php echo _AT('show_pages'); ?></a>
			<?php }else{ ?>
				<a class="toggle-view" href="<?php echo $_SERVER['PHP_SELF']; ?>?p=all"><?php echo _AT('show_all'); ?></a>
			<?php } ?>

			<br />
			<br />
-->
		</div>
	</div>
</div>
<!-- End of recent activity -->

<!-- Browse Courses -->
<!-- Armin 13.10.2010: Removed Browse courses
<div class="current_container">
	<h2 class="page-title"><?php echo _AT('Browse Courses'); ?></h2>
	<div class="current_box">
		<form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">						
	
			<?php if ($this->has_categories): ?>
				
			<?php endif; ?>
	
					<label for="search"><?php echo _AT('search'); ?> (<?php echo _AT('title').', '._AT('description'); ?>)</label><br />
	
					<input type="text" name="search" id="search" size="20" value="<?php echo htmlspecialchars($_GET['search']); ?>" />
					<input type="submit" name="filter" class="button" value="<?php echo _AT('Browse'); ?>"/><br/>
					<?php echo _AT('search_match'); ?>:
					<input type="radio" name="include" value="all" id="match_all" <?php echo $this->checked_include_all; ?> /><label for="match_all"><?php echo _AT('search_all_words'); ?></label> 
					<input type="radio" name="include" value="one" id="match_one" <?php echo $this->checked_include_one; ?> /><label for="match_one"><?php echo _AT('search_any_word'); ?></label>
			
		</form>
</div>
-->
<!-- End: Browse Courses -->

<?php require(AT_INCLUDE_PATH.'footer.inc.php'); ?>
