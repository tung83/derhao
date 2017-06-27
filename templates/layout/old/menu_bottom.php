<?php

?>
<ul>
    <li><a class="<?php if((!isset($_REQUEST['com'])) or ($_REQUEST['com']==NULL) or $_REQUEST['com']=='index') echo 'active'; ?>" href="index.html">Trang chủ</a></li>
    <li><a class="<?php if($_REQUEST['com'] == 'gioi-thieu') echo 'active'; ?>" href="gioi-thieu.html">Giới thiệu</a></li>
    <li><a class="<?php if($_REQUEST['com'] == 'san-pham' or $_REQUEST['com'] == 'tim-kiem') echo 'active'; ?>" href="san-pham.html">Sản phẩm</a></li>
    <li><a class="<?php if($_REQUEST['com'] == 'tin-tuc') echo 'active'; ?>" href="tin-tuc.html">Tin tức</a></li>
    <li><a class="<?php if($_REQUEST['com'] == 'tuyen-dung') echo 'active'; ?>" href="tuyen-dung.html">Tuyển dụng</a></li>
     <li><a class="<?php if($_REQUEST['com'] == 'bang-gia') echo 'active'; ?>" href="bang-gia.html">Bảng giá</a></li>
    <li><a class="<?php if($_REQUEST['com'] == 'lien-he') echo 'active'; ?>" href="lien-he.html">Liên hệ</a></li>
</ul>
