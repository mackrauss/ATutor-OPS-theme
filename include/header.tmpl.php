<?php
/************************************************************************/
/* ATutor																*/
/************************************************************************/
/* Copyright (c) 2002-2010 by Greg Gay, Joel Kronenberg & Heidi Hazelton*/
/* Adaptive Technology Resource Centre / University of Toronto			*/
/* http://atutor.ca														*/
/*																		*/
/* This program is free software. You can redistribute it and/or		*/
/* modify it under the terms of the GNU General Public License			*/
/* as published by the Free Software Foundation.						*/
/************************************************************************/
// $Id: header.tmpl.php 3825 2005-03-11 15:35:51 joel $
if (!defined('AT_INCLUDE_PATH')) { exit; }
/* available header.tmpl.php variables:
 * $this->lang_code			the ISO language code
 * SITE_NAME				the site name from the config file
 * $this->page_title		the name of this page to use in the <title>
 * $this->lang_charset		the ISO language character set
 * $this->content_base_href	the <base href> to use for this page
 * $this->base_path			the absolute path to this atutor installation
 * $this->rtl_css			if set, the path to the RTL style sheet
 * $this->icon			the path to a course icon
 * $this->banner_style		-deprecated-
 * $this->cats		 array or course categories
 * $this->theme				the directory name of the current theme
 * $this->base_href			the full url to this atutor installation
 * $this->onload			javascript onload() calls
 * $this->img				the absolute path to this theme's images/ directory
 * $this->sequence_links	associative array of 'previous', 'next', and/or 'resume' links
 * $this->path				associative array of path to this page: aka bread crumbs
 * $this->rel_url			the relative url from the installation root to this page
 * $this->nav_courses		associative array of this user's enrolled courses
 * $this->section_title		the title of this section (course, public, admin, my start page)
 * $this->top_level_pages	associative array of the top level navigation
 * $this->current_top_level_page	the full path to the current top level page with file name
 * $this->sub_level_pages			associate array of sub level navigation
 * $this->back_to_page				if set, the path and file name to the part of this page (if parent is not a top level nav)
 * $this->current_sub_level_page	the full path to the current sub level page with file name
 * $this->guide				the full path and file name to the guide page
 * ======================================
 * top_level_pages           array(array('url', 'title'))     the top level pages. ATutor default creates tabs.
 * section_title             string                           the name of the current section. either name of the course, administration, my start page, etc.
 * page_title                string                           the title of the current page.
 * path                      array(array('url', 'title'))     the path to the current page.
 * back_to_page              array('url', 'title')            the link back to the part of the current page, if needed.
 * current_top_level_page    string                           full url to the current top level page in "top_leve_pages"
 * current_sub_level_page    string                           full url to the current sub level page in the "sub_level_pages"
 * sub_level_pages           array(array('url', 'title'))     the sub level pages.
 */

// will have to be moved to the header.inc.php
global $system_courses, $_custom_css, $db;

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="<?php echo $this->lang_code; ?>"> 
<head>
	<title><?php echo SITE_NAME; ?> : <?php echo $this->page_title; ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $this->lang_charset; ?>" />
	<meta name="Generator" content="ATutor - Copyright 2010 by http://atutor.ca" />
	<base href="<?php echo $this->content_base_href; ?>" />
	<link rel="shortcut icon" href="<?php echo $this->base_path; ?>favicon.ico" type="image/x-icon" />
	<link rel="stylesheet" href="<?php echo $this->base_path.'themes/'.$this->theme; ?>/print.css" type="text/css" media="print" />
	<link rel="stylesheet" href="<?php echo $this->base_path.'themes/'.$this->theme; ?>/styles.css" type="text/css" />
	<!--[if IE]>
	  <link rel="stylesheet" href="<?php echo $this->base_path.'themes/'.$this->theme; ?>/ie_styles.css" type="text/css" />
	<![endif]-->
    <link rel="stylesheet" href="<?php echo $this->base_path.'themes/'.$this->theme; ?>/forms.css" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?php echo $this->base_path; ?>jscripts/infusion/framework/fss/css/fss-layout.css" />
<?php echo $this->rtl_css; ?>
<?php if (isset($this->course_id) && $system_courses[$this->course_id]['rss']): ?>
	<link rel="alternate" type="application/rss+xml" title="<?php echo SITE_NAME; ?> - RSS 2.0" href="<?php echo $this->base_href; ?>get_rss.php?<?php echo $this->course_id; ?>-2" />
	<link rel="alternate" type="application/rss+xml" title="<?php echo SITE_NAME; ?> - RSS 1.0" href="<?php echo $this->base_href; ?>get_rss.php?<?php echo $this->course_id; ?>-1" />
<?php endif; ?>
	<script src="<?php echo $this->base_path; ?>jscripts/infusion/InfusionAll.js" type="text/javascript"></script>
    <script src="<?php echo $this->base_path; ?>jscripts/infusion/jquery.autoHeight.js" type="text/javascript"></script>
	<script language="javascript" type="text/javascript">
	//<!--
	jQuery.noConflict();
	//-->
	</script>
    <script src="<?php echo $this->base_path; ?>jscripts/ATutor.js" type="text/javascript"></script>   
    <?php echo $this->custom_css; ?>
    <style id="pref_style" type="text/css"></style> 
    
</head>
<body onload="<?php echo $this->onload; ?>">
<div class="page_wrapper">
<div id="header">
	<a href="<?php echo htmlspecialchars($_SERVER['REQUEST_URI'], ENT_QUOTES); ?>#content" accesskey="c">
	<img src="<?php echo $this->base_path; ?>images/clr.gif" height="1" width="1" border="0" alt="<?php echo _AT('goto_content'); ?> ALT+c" /></a>		

	<a href="<?php echo htmlspecialchars($_SERVER['REQUEST_URI'], ENT_QUOTES); ?>#menu<?php echo htmlentities_utf8($_REQUEST['cid']); ?>"  accesskey="m"><img src="<?php echo $this->base_path; ?>images/clr.gif" height="1" width="1" border="0" alt="<?php echo _AT('goto_menu'); ?> ALT+m" /></a>
	
	<?php if (isset($_SESSION['valid_user']) && $_SESSION['valid_user']): 
		echo '<div class="site-name">'.stripslashes(SITE_NAME).'</div>'; 
	else:
		echo '<br />';	
	endif; ?>
	<div id="top-links"> <!-- top help/search/login links -->
			<div id="top-links-text">
         <?php if (isset($_SESSION['valid_user']) && $_SESSION['valid_user']): ?>
			<strong><?php echo get_display_name($_SESSION['member_id']); ?></strong> <span class="nav-break2">|</span>
<!-- 			<a href="">xxx</a> <span class="nav-break2">|</span>  -->
			<a href="<?php echo $this->base_path; ?>logout.php"><?php echo _AT('logout'); ?></a> <span class="nav-break2">|</span>
		<?php else: ?>
			 <a href="<?php echo $this->base_path; ?>login.php?course=<?php echo $this->course_id; ?>"><?php echo _AT('login'); ?></a>  <a href="<?php echo $this->base_path; ?>registration.php"><?php echo _AT('register'); ?></a>
		<?php endif; ?> 
        
		<?php if (isset($_SESSION['member_id']) && $_SESSION['member_id']): ?>
			
			<?php if ($_SESSION['is_super_admin']): ?>
				<a href="<?php echo $this->base_path; ?>bounce.php?admin"><?php echo _AT('return_to_admin_area'); ?></a> 
			<?php endif; ?>

			<?php if ($this->course_id > -1): ?>
				<?php if (get_num_new_messages()): ?>
					<a href="<?php echo $this->base_path; ?>inbox/index.php"><?php echo _AT('inbox'); ?> (<?php echo get_num_new_messages(); ?>)</a>  
				<?php else: ?>
					<a href="<?php echo $this->base_path; ?>inbox/index.php"><?php echo _AT('inbox'); ?></a>
				<?php endif; ?><span class="nav-break2">|</span>
			<?php endif; ?>
		<?php endif; ?>
		<?php if(!$this->just_social): ?>
			<a href="<?php echo $this->base_path; ?>search.php"><?php echo _AT('search'); ?></a> <span class="nav-break2">|</span>
		<?php endif; ?>
		<a href="<?php echo $this->base_path; ?>help/index.php"><?php echo _AT('help'); ?></a>
		</div>

	</div>
	<?php // if (!empty($this->icon)) { // if a course icon is available, display it here.  ?>
		<!--<a href="<?php echo $this->base_path.url_rewrite('index.php'); ?>"><img src="<?php echo $this->icon; ?>" class="headicon" alt="<?php echo  _AT('home'); ?>" /></a>	 -->
	<?php // } ?>

	<?php
	// If there is a custom course banner in the file manager called banner.html, display it here
	@readfile(AT_CONTENT_DIR . $this->course_id.'/banner.html'); 

	/*
	and example banner.html file might look like:
	<div style="width: 760px; height: 42px; background: white;"><img src="http://[mysite]/atutor15rc3/banners/kart-camb.jpg"></div>
	*/

	?>
	<!-- section title -->

	


</div>

<div id="topnavlistcontainer">
<!-- Armin: Import ocad_images.inc.php which maps navigation items to picture locations -->
<?php 
    include('ocad_images.inc.php');
?>
<!-- the main navigation. in our case, tabs -->
	<ul id="topnavlist">
		<?php $accesscounter = 0; //initialize ?>
		<?php foreach ($this->top_level_pages as $page): ?>
			<!-- Armin 29.09.2010: construct img path -->
			<?php $img_url = str_replace('/atutor', '', url_rewrite($page['url'])); ?>
			<?php ++$accesscounter; $accesscounter = ($accesscounter == 10 ? 0 : $accesscounter); ?>
			<?php $accesskey_text = ($accesscounter < 10 ? 'accesskey="'.$accesscounter.'"' : ''); ?>
			<?php $accesskey_title = ($accesscounter < 10 ? ' Alt+'.$accesscounter : ''); ?>
			<?php if ($page['url'] == $this->current_top_level_page): ?>
				<li>
					<a href="<?php echo $page['url']; ?>" <?php echo $accesskey_text; ?> title="<?php echo $page['title'] . $accesskey_title; ?>" class="active">
						<img border="0" src="<?php echo $this->img; ?><?php echo $_ocad_images[$img_url]; ?>" alt="Picture of <?php echo $page['title']; ?>">
						<?php echo $page['title']; ?>
					</a>
					<span class="nav-break">|</span>
				</li>
			<?php else: ?>
				<li>
					<a href="<?php echo $page['url']; ?>" <?php echo $accesskey_text; ?> title="<?php echo $page['title'] . $accesskey_title; ?>">
						<img border="0" src="<?php echo $this->img; ?><?php echo $_ocad_images[$img_url]; ?>" alt="Picture of <?php echo $page['title']; ?>">
						<?php echo $page['title']; ?>
					</a> <span class="nav-break">|</span>
				</li>
			<?php endif; ?>
			<?php $accesscounter = ($accesscounter == 0 ? 11 : $accesscounter); ?>
		<?php endforeach; ?>
        <li>  
		<?php $path_parts = explode("/", $this->current_top_level_page); 
		      $last_path_part = $path_parts[sizeof($path_parts) - 1];
               if (!admin_authenticate(AT_ADMIN_PRIV_ADMIN, AT_PRIV_RETURN) && $last_path_part != 'preferences.php') {?>
		    <a class="pref_wiz_launcher"><img border="0" alt="<?php echo _AT('preferences').' - '._AT('new_window'); ?>" src="<?php echo $this->img; ?>color-swatch.png"> Preferences wizard </a> <?php } ?> </li> 
	</ul>
    <div id="topnav-search">
	
<form action="/search.php#search_results" method="get" name="searchform">
<input type="hidden" name="search" value="1" />

<input type="hidden" name="find_in" value="this" />
<input type="hidden" name="display_as" value="pages" />
<input type="hidden" name="search_within[]" value="content" />
<input type="hidden" name="search_within[]" value="forums" />
<label for="words" style="display:none;"> <?php echo _AT('Search') ?> </label>
<input type="text" name="words" class="formfield" size="20" id="words" value="" />

<input type="submit" name="submit" value="<?php echo _AT('Search') ?>" class="button" />
</form>


</div>
<div class="clear"></div>
</div>


<div class="clear"></div>

<div class="logoutbar">

	<div>
		
	</div>

</div>

<div class="crumbcontainer">
	  <?php if (isset($_SESSION["prefs"]["PREF_SHOW_BREAD_CRUMBS"]) && $_SESSION["prefs"]["PREF_SHOW_BREAD_CRUMBS"]) { ?>
		  <!-- the bread crumbs -->
		  <div id="breadcrumbs">
			  <?php foreach ($this->path as $page): ?>
				  <a href="<?php echo $page['url']; ?>"><?php echo htmlspecialchars($page['title'], ENT_COMPAT, "UTF-8"); ?></a> > 
			  <?php endforeach; ?> <?php echo $this->page_title; ?>
		  </div>
	  <?php } ?>

<!-- Armin 10.09.2010: Enable shortcuts?? -->
	  <?php if ($this->shortcuts): ?>
      <div id="shortcuts">
	      <ul>
		      <?php foreach ($this->shortcuts as $link): ?>
			      <li><a href="<?php echo $link['url']; ?>"><!--<img src="<?php echo $link['icon']; ?>" alt="<?php echo $link['title']; ?>"  title="<?php echo $link['title']; ?>" class="shortcut_icon"/>--> <?php echo $link['title']; ?> </a></li>
		      <?php endforeach; ?>
	      </ul>
      </div>
      <?php endif; ?>
      </div>
    
</div>
<div class="clear"></div>
<!-- Course Title -->
	<div id="course_title_container" <?php if(empty($this->icon)){echo ' style="left:1em;"';}   ?>>
	<h1 id="section-title"><?php echo $this->section_title; ?>
		<?php if ((isset($this->course_id) && $this->course_id > 0) && ($_SESSION['enroll'] == AT_ENROLL_NO)) : ?> 
			- <small><a href="<?php echo $this->base_path; ?>enroll.php?course=<?php echo $this->course_id; ?>"><?php echo _AT('enroll_me'); ?></a></small>
		<?php endif; ?>
	</h1>
	</div>

	<div id="contentwrapper" 
		<?php if ($_SESSION["prefs"]["PREF_SHOW_BREAD_CRUMBS"] == 0):
			$style.='margin-top:-2em;';
			echo 'style="'.$style.'"';
		endif; ?>>
	<?php if (isset($this->course_id) && $this->course_id > 0 && $system_courses[$this->course_id]['side_menu']): ?>
		<div id="leftcolumn">
		<!-- Armin out 18.08.2010
		  <div id="menutoggle">
		      <a accesskey="n"><img src="" title="" alt="" /></a>
		  </div>
		  
		  <div class="clear"></div>
		  <a name="menu"></a>
		  -->
		  <div id="side-menu">
		      <?php require(AT_INCLUDE_PATH.'side_menu.inc.php'); ?>
		  </div>
		</div>
	<?php endif; ?>

	<div id="contentcolumn">
		<?php if (isset($this->course_id) && $this->course_id > 0 && $system_courses[$this->course_id]['side_menu']): ?>
	

		
		<?php endif; ?>

<!-- subnav group -->
	<?php if (count($this->sub_level_pages) > 0): ?>

<!-- <div id="topnavlistcontainer">
	<ul id="topnavlist">
		<?php $accesscounter = 0; //initialize ?>
		<?php foreach ($this->top_level_pages as $page): ?>
			<?php ++$accesscounter; $accesscounter = ($accesscounter == 10 ? 0 : $accesscounter); ?>
			<?php $accesskey_text = ($accesscounter < 10 ? 'accesskey="'.$accesscounter.'"' : ''); ?>
			<?php $accesskey_title = ($accesscounter < 10 ? ' Alt+'.$accesscounter : ''); ?>
			<?php if ($page['url'] == $this->current_top_level_page): ?>
				<li><a href="<?php echo $page['url']; ?>" <?php echo $accesskey_text; ?> title="<?php echo $page['title'] . $accesskey_title; ?>" class="active"><?php echo $page['title']; ?></a></li>
			<?php else: ?>
				<li><a href="<?php echo $page['url']; ?>" <?php echo $accesskey_text; ?> title="<?php echo $page['title'] . $accesskey_title; ?>"><?php echo $page['title']; ?></a></li>
			<?php endif; ?>
			<?php $accesscounter = ($accesscounter == 0 ? 11 : $accesscounter); ?>
		<?php endforeach; ?>
	</ul>
</div> -->

		<div id="subnavlistcontainer">
		

			<ul id="subnavlist">
			<?php $num_pages = count($this->sub_level_pages); 

?>
			<?php for ($i=0; $i<$num_pages; $i++): ?>
				
				<?php if ($this->sub_level_pages[$i]['url'] == $this->current_sub_level_page): ?>
				      <li class="active"><?php echo htmlentities_utf8($this->sub_level_pages[$i]['title']); ?></li>
				<?php else: ?>
					<li><a href="<?php echo $this->sub_level_pages[$i]['url']; ?>"><?php echo htmlentities_utf8($this->sub_level_pages[$i]['title']); ?></a></li>
				<?php endif; ?>
				<?php if ($i < $num_pages-1): 
					echo " ";?>
				<?php endif; ?>
			<?php endfor; ?>
			</ul>
		</div>
	<?php endif; ?>


<!-- the page title -->
	<a name="content" title="<?php echo _AT('content'); ?>"></a>
	<h2 class="page-title"><?php echo $this->page_title; ?></h2>
    <div class="sequence-links">
		<?php if ($_SESSION["prefs"]["PREF_SHOW_NEXT_PREVIOUS_BUTTONS"]) { ?>
			<?php if ($this->sequence_links['resume']): ?>
					<a style="color:white;" href="<?php echo $this->sequence_links['resume']['url']; ?>" accesskey="."><img src="<?php echo $this->img; ?>resume.png" border="0" title="<?php echo _AT('resume').': '.$this->sequence_links['resume']['title']; ?> Alt+." alt="<?php echo $this->sequence_links['resume']['title']; ?> Alt+." class="img-size-ascdesc" /></a>
			<?php else:
				if ($this->sequence_links['previous']): ?>
					<a href="<?php echo $this->sequence_links['previous']['url']; ?>" title="<?php echo _AT('previous_topic').': '. $this->sequence_links['previous']['title']; ?> Alt+," accesskey=","><img src="<?php echo $this->img; ?>previous.png" border="0" alt="<?php echo _AT('previous_topic').': '. $this->sequence_links['previous']['title']; ?> Alt+," class="img-size-ascdesc" /> Previous Section </a>
				<?php endif;
				if ($this->sequence_links['next']): ?>
					| <a href="<?php echo $this->sequence_links['next']['url']; ?>" title="<?php echo _AT('next_topic').': '.$this->sequence_links['next']['title']; ?> Alt+." accesskey=".">Next Section <img src="<?php echo $this->img; ?>next.png" border="0" alt="<?php echo _AT('next_topic').': '.$this->sequence_links['next']['title']; ?> Alt+." class="img-size-ascdesc" /> </a>
				<?php endif; ?>
			<?php endif; ?>
		<?php } ?>
			&nbsp;
		</div>
    
    
	<?php global $msg; $msg->printAll(); $_base_href;?>


