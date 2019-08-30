# easywechatshare
easy wechat share sdk

实现同域名下，任意页面获取微信分享js配置文件。

```
Server端使用方法

假设该文件访问地址为 http://www.domain.com/share.php

<?php 

include __DIR__ . '/vendor/autoload.php'; // 引入 composer 入口文件

use EasyWeChat\Foundation\Application;
use easyWechatShare\Share;

$options = [
    'debug'  => false,

    /**
     * 账号基本信息，请从微信公众平台/开放平台获取
     */
    'app_id'  => 'xxx',         // AppID
    'secret'  => 'xxxxxx',     // AppSecret
    'token'   => '',          // Token
    'aes_key' => '',         // EncodingAESKey，安全模式与兼容模式下请一定要填写！！！
    'log' => [
        'level' => 'debug',
        'file'  => '/tmp/m/easywechat.log', // XXX: 绝对路径！！！！
    ],
];

$config = [
    'onMenuShareAppMessage', 
    'onMenuShareTimeline', 
    'onMenuShareQQ', 
    'onMenuShareWeibo', 
    'onMenuShareQZone'
];

$Application = new Application($options);
$Share = new Share($Application);

echo $Share->getConfig($config);


```


```
客户端调用方法

假设页面为 http://www.domain.com/test.html

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script src="https://res.wx.qq.com/open/js/jweixin-1.0.0.js" type="802c90f6bcf1fac8408d53c7-text/javascript" charset="utf-8"></script>
	<script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js" type="802c90f6bcf1fac8408d53c7-"></script>
</head>
<body>
<script type="text/javascript">

	$.ajax({
		type: 'POST',
		url: 'xxx.php',
		success: function($data){
			wx.config(JSON.parse($data));
		}
	});


	// 微信JSSDK开发
	wx.ready(function () {

		// 分享给朋友
		wx.onMenuShareAppMessage({
			title: '商品名', // 商品名
			desc: '店铺名', // 店铺名
			link: 'http://domain.com/x.html', // 商品购买地址
			imgUrl: 'https://gss0.bdstatic.com/7Ls0a8Sm1A5BphGlnYG/sys/portrait/item/9822455368656c7065729364.jpg', // 分享的图标
			fail: function (res) {
				alert(JSON.stringify(res));
			}
		});

		// 分享到朋友圈
		wx.onMenuShareTimeline({
			title: '商品名', // 商品名
			link: 'http://domain.com/x.html', // 商品购买地址
			imgUrl: 'https://gss0.bdstatic.com/7Ls0a8Sm1A5BphGlnYG/sys/portrait/item/9822455368656c7065729364.jpg', // 分享的图标
			fail: function (res) {
				alert(JSON.stringify(res));
			}
		});

		wx.onMenuShareQQ({
			title: '商品名', // 商品名
			desc: '店铺名', // 店铺名
			link: 'http://domain.com/x.html', // 商品购买地址
			imgUrl: 'https://gss0.bdstatic.com/7Ls0a8Sm1A5BphGlnYG/sys/portrait/item/9822455368656c7065729364.jpg', // 分享的图标
			success: function () { 
				// 用户确认分享后执行的回调函数
				alert(JSON.stringify(res));
			},
			cancel: function () { 
				alert(JSON.stringify(res));
				// 用户取消分享后执行的回调函数
			}
		});

		wx.onMenuShareQZone({
			title: '', // 分享标题
			title: '商品名', // 商品名
			desc: '店铺名', // 店铺名
			link: 'http://domain.com/x.html', // 商品购买地址
			imgUrl: 'https://gss0.bdstatic.com/7Ls0a8Sm1A5BphGlnYG/sys/portrait/item/9822455368656c7065729364.jpg', // 分享的图标
			success: function () { 
				alert(JSON.stringify(res));
				// 用户确认分享后执行的回调函数
			},
			cancel: function () { 
				alert(JSON.stringify(res));
				// 用户取消分享后执行的回调函数
			}
		});
	});

</script>
	
</body>
</html>


```