<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <meta name="format-detection" content="telephone=no"/>
    <title>巾帼文明岗标兵 网络投票</title>
    <link rel="stylesheet" href="/static/vote/css/style.css"/>
    <link rel="stylesheet" href="/static/vote/css/font-awesome.min.css"/>
    <script type="text/javascript" src="/static/vote/js/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="/static/vote/js/touch.min.js"></script>
    <script type="text/javascript" src="/static/vote/js/app.js"></script>
    <script type="text/javascript" src="/static/vote/js/jquery.artDialog.js"></script>
    <script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <script type="text/javascript">
    wx.config({
    	beta:true,
    	debug:false,
    	appId: '<?php echo $jsinfo["appId"];?>',
    	timestamp: <?php echo $jsinfo["timestamp"];?>,
    	nonceStr: '<?php echo $jsinfo["nonceStr"];?>',
    	signature: '<?php echo $jsinfo["signature"];?>',
    	jsApiList: [
    	'checkJsApi',
    	'onMenuShareTimeline',
    	'onMenuShareAppMessage',
    	'onMenuShareQQ',
    	'onMenuShareWeibo',
    	'hideMenuItems',
    	'showMenuItems',
    	'translateVoice',
    	'startRecord',
    	'stopRecord',
    	'onRecordEnd',
    	'playVoice',
    	'pauseVoice',
    	'stopVoice',
    	'uploadVoice',
    	'downloadVoice',
    	'getNetworkType',
    	'hideOptionMenu',
    	'showOptionMenu',
    	'chooseVideo',
    	'uploadVideo'
    	]
    	});
    	wx.ready(function(){
    		msgshare();
    	});
    	function msgshare(){
    		wx.onMenuShareTimeline({
    		    title: '<?php echo $share['title'];?>',
    		    link: '<?php echo $share['link'];?>',
    		    imgUrl: '<?php echo $share['img'];?>',
    		    success: function () {
    		    },
    		    cancel: function () {
    		    }
    		});
    		//分享给朋友
    		wx.onMenuShareAppMessage({
    		    title: '<?php echo $share['title'];?>',
    		    desc: '<?php echo $share['desc'];?>',
    		    link: '<?php echo $share['link'];?>',
    		    imgUrl: '<?php echo $share['img'];?>',
    		    type: 'link',
    		    dataUrl: '',
    		    success: function () {
    		    },
    		    cancel: function () {
    		    }
    		});
    		//分享到QQ
    		wx.onMenuShareQQ({
    		    title: '<?php echo $share['title'];?>',
    		    desc: '<?php echo $share['desc'];?>',
    		    link: '<?php echo $share['link'];?>',
    		    imgUrl: '<?php echo $share['img'];?>',
    		    success: function () {
    		    },
    		    cancel: function () {
    		    }
    		});
    		//分享到微博
    		wx.onMenuShareWeibo({
    		    title: '<?php echo $share['title'];?>',
    		    desc: '<?php echo $share['desc'];?>',
    		    link: '<?php echo $share['link'];?>',
    		    imgUrl: '<?php echo $share['img'];?>',
    		    success: function () {
    		    },
    		    cancel: function () {
    		    }
    		});
    	}
    </script>
</head>
<body class="dfv">
	<header class="home-header">
		<div class="g-scroll">
            <div class="slider" id="slider">
                <div class="slider-box">
                    <img src="/static/vote/images/banner.png">
                </div>
            </div>
        </div>
	</header>

	<div class="container flex" style="padding-bottom: 70px;">
		<div class="list-header">
			<h2><i class="fa fa-list"></i> 排行榜</h2>
		</div>
		<div class="list-wrap">
			<?php 
			$i = 1;
			foreach ($list as $v){?>
			<div class="item-l">
				<div class="item-wrap">
					<div class="item-rank">
						<i class="fa fa-bookmark-o"></i>第<span><?php echo $i;?></span>名
					</div>
					<div class="item-info">
						<span class="item-no">NO.<?php echo $v['mid'];?></span>
						<span class="item-count"><font><?php echo $v['votecount'];?></font>票</span>
					</div>
					<div class="item-title">
						<a href="<?php echo $v['type']==2?$v['content']:'detail?id='.$v['itemid'];?>"><?php echo $v['title'];?></a>
					</div>
					<div class="item-tips df">
						<span class="item-name flex">
							<?php echo $v['fm'];?>
						</span>
						<span class="item-date flex">
							<?php echo $v['date'];?>
						</span>
						<?php if (in_array($v['itemid'],$myitem)){?>
						<div class="item-btn flex voted" data-itemid="<?php echo $v['itemid'];?>">
							<i class="fa fa-heart"></i><span>已支持</span>
						</div>
						<?php }else {?>
						<div class="item-btn flex" data-itemid="<?php echo $v['itemid'];?>">
							<i class="fa fa-heart"></i><span>投上一票</span>
						</div>
						<?php }?>
					</div>
				</div>
			</div>
			<?php 
			$i++;
			}
			?>
		</div>
	</div>

	<footer>
		<div class="footer-wrap">
			<div class="footer-link df">
				<a href="index?vid=<?php echo $vid;?>" class="flex"><i class="fa fa-home"></i> 首页</a>
				<a href="top?vid=<?php echo $vid;?>" class="flex active"><i class="fa fa-list"></i> 排行榜</a>
				<a href="rule?vid=<?php echo $vid;?>" class="flex"><i class="fa fa-file"></i> 投票规则</a>
				<a href="mine?vid=<?php echo $vid;?>" class="flex"><i class="fa fa-user"></i> 我的</a>
			</div>
		</div>
	</footer>


</body>
<script>
	// 显示二维码弹窗
    function showErwei(){
    	$(document).toast.alert({
	        str: '<img src="images/code.jpg" style="width: 50%; margin: auto;" alt=""><p>请先关注江苏省妇联<br />关注后回复“投票”即可参与</p>'
	    })
    }

	//点击投票按钮
	/*
	$(".item-btn").on("tap", function(e){
        var dom = $(this).parents(".item-l").find("font");
        var num = +dom.html();
        if($(this).hasClass("voted")){		//取消投票
            $(this).removeClass("voted");
            dom.html(num-1);
            $(this).find("span").html('投上一票');
            hdAlert("取消成功");
        }else{				//投票
            dom.html(num+1);
            $(this).addClass("voted");
            $(this).find("span").html('已支持');
            hdAlert("投票成功");
        }
    })*/
    
    $(".item-btn").on("tap click", function(e){
        var dom = $(this).parents(".item-l").find("font");
        var num = +dom.html();
        var o = this;
        var itemid = $(this).attr("data-itemid");
        $.ajax({
			type:"post",
			url:"vote",
			data:{'itemid':itemid},
			dataType:'json',
			async:false,
			success:function(m){
				if(m.status==0){
					if(m.do==1){
						$(o).removeClass("voted");
			            dom.html(num-1);
			            $(o).find("span").html('投上一票');
			            //hdAlert("取消成功");
					}else{
						dom.html(num+1);
			            $(o).addClass("voted");
			            $(o).find("span").html('已支持');
			            //hdAlert("投票成功");
					}
				}else if(m.status==2){
					showForm();
				}else{
					hdAlert(m.msg);
				}
			}
	    });
    })

    var hdAlert = function(b, c) {
	    var a = c;
	    a || (a = function() {});
	    jQuery.dialog({
	        content: b,
	        lock: !0,
	        opacity: 0,
	        ok: a,
	        title: "\u63d0\u793a"
	    })
	};

</script>
</html>