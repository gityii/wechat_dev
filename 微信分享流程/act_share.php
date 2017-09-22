<?php
defined('__R__') or exit('');
$voteid = intval(input::get('vid'));
$uid = user::uid();
$page = intval(input::get('page'));
$per = 30;
system::db();
$list = db::query_get('select `itemid`,`mid`,`type`,`title`,`fm`,`date`,`img`,`content`,`votecount` from '.db::table('act_vote_item').' where `voteid`=\''.$voteid.'\' order by `votecount` desc');
$myitem_data = db::query_get('select `itemid` from '.db::table('act_vote_log').' where `voteid`=\''.$voteid.'\' and `uid`=\''.$uid.'\'');
$myitem = array();
foreach ($myitem_data as $v){
	$myitem[] = $v['itemid'];
}
db::query('update '.db::table('act_vote').' set `viewcount`=`viewcount`+1 where `voteid`=\''.$voteid.'\'');
$wx = new wx();
$share = array(
'title'=>'全省公安“微警务”推送信息“最佳原创文章”评选活动开始啦！ ',
'desc'=>'全省公安“微警务”推送信息“最佳原创文章”评选活动开始啦！更有30名幸运用户将获得50元手机话费！赶快邀请小伙伴们参加吧！',
'link'=>"http://$_SERVER[HTTP_HOST]/top",
'img'=>"http://$_SERVER[HTTP_HOST]/static/jiaojing/images/ico.jpg"
);
view::render('vote/top',array(
'list'=>$list,
'myitem'=>$myitem,
'jsinfo'=>$wx->getSignPackage(),
'share'=>$share,
'vid'=>$voteid
));