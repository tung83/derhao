
<ul>
    <li><a class="<?php if((!isset($_REQUEST['com'])) or ($_REQUEST['com']==NULL) or ($_REQUEST['com']=='home') or $_REQUEST['com']=='index') echo 'active'; ?>" href="index.html"><?=_home?></a></li>
    <li><a class="<?php if($_REQUEST['com'] == 'about') echo 'active'; ?>" href="about.html"><?=_about_us?></a></li>
    <li><a class="<?php if($_REQUEST['com'] == 'gallery' or $_REQUEST['com'] == 'gallery') echo 'active'; ?>" href="gallery.html"><?=_gallery?></a></li>
    <li><a class="<?php if($_REQUEST['com'] == 'admission') echo 'active'; ?>" href="admission.html"><?=_admission?></a></li>
    <li><a class="<?php if($_REQUEST['com'] == 'school-info') echo 'active'; ?>" href="school-info.html"><?=_school_info?></a></li>
     <li><a class="<?php if($_REQUEST['com'] == 'curriculum') echo 'active'; ?>" href="curriculum.html"><?=_curriculum?></a></li>
    <li><a class="<?php if($_REQUEST['com'] == 'classes') echo 'active'; ?>" href="classes.html"><?=_classes?></a></li>
	<li><a class="<?php if($_REQUEST['com'] == 'news') echo 'active'; ?>" href="news.html"><?=_news?></a></li>
	<li><a class="<?php if($_REQUEST['com'] == 'contact') echo 'active'; ?>" href="contact.html"><?=_contact_us?></a></li>
</ul>

<div class="clear"></div>