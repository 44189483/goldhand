<?php
include 'include/common.php';

/*banner*/
$banner = $db->get_all('gh_slide','ORDER BY ord DESC');
$smarty->assign("banner", $banner);

/*关于乾豪*/
$about = $db->get_one('gh_article','WHERE articleId=12');
$smarty->assign("about", $about);

/*新闻中心*/
$news = $db->get_all('gh_article','WHERE showIndex=1 AND classId IN(1,2,3) ORDER BY ord DESC,addTime DESC,articleId DESC LIMIT 2');
$smarty->assign("news", $news);

$smarty->display('index.html');

?>