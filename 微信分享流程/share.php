<?php
defined('__R__') or exit('');
$id = intval(input::post('id'));
$id = 1;

if ($id>0){
    system::db();
    $payname = db::first('select `name` from ' . db::table('order') . ' where `orderid`=\'' . $id . '\'');
    var_dump($payname);
    db::db_close_conn();

}

$paytime = date('Y-m-d H:i:s',time());

$wx = new wx();

$share = array(
    'title'=>  '爱心证书，传递爱心 ',
    'desc' =>  '爱心证书，传递爱心 ',
    'link' =>  "",
    'img'  =>  "/static/public/images/fenxiang.jpg"
);

$shareid  = 10000 + $id;

view::render('/public/certificate',array(
    'payname'=> $payname,
    'paytime'=> $paytime,
    'jsinfo' => $wx->getSignPackage(),
    'share'  => $share,
    'shareid'=> $shareid
));

