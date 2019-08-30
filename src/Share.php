<?php

namespace easyWechatShare;

use EasyWeChat\Foundation\Application;

/**
 * wechat share
 * 
 * @author 0x00 <0x00gc@gmail.com>
 */
class Share
{
    private $wechatApp;

    /**
     * init wechat option
     * 
     * @param     EasyWeChat\Foundation\Application
     */
    public function __construct(Application $wechatApp)
    {
        $this->wechatApp = $wechatApp;
    }

    /**
     * Get WeChat share js initialization configuration.
     * 
     * @param     array       $config  wechat share config
     * @see https://mp.weixin.qq.com/wiki?t=resource/res_main&id=mp1421141115
     * 
     * @param     string      $url     wechat share url,defualt use HTTP Referer
     * @param     bool        $debug   
     * @return    json
     */
    public function getConfig($config = [], $url = '', $debug = false)
    {
        $js = $this->wechatApp->js;

        if (empty($config)) {
            $config = [
                'onMenuShareAppMessage',
                'onMenuShareTimeline',
                'onMenuShareQQ',
                'onMenuShareWeibo',
                'onMenuShareQZone'
            ];
        }

        if (isset($_SERVER["HTTP_REFERER"]) && $url == '') {
            $url = $_SERVER["HTTP_REFERER"];
        }

        if ($url == '') {
            throw new \Exception("Share URL is empty");
        }

        $js->setUrl($url);
        return $js->config($config, $debug);
    }
}
