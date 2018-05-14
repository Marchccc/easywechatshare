<?php 
namespace easyWechatShare;

use EasyWeChat\Foundation\Application;

class Share
{
    private $wechatApp;

    /**
     * init wechat option
     *
     * @author 剑心 <0x00gc@gmail.com>
     * @DateTime  2018-05-14
     * @param     array      $options  配置数组
     */
    public function __construct($options)
    {
        $this->wechatApp = new Application($options);
    }

    /**
     * Get WeChat share js initialization configuration.
     *
     * @author 剑心 <0x00gc@gmail.com>
     * @DateTime  2018-05-14
     * @param     boolean     $debug  is open debug
     * @param     string      $url    申请配置的url，默认读取HTTP Referer
     * @return    json
     */
    public function getConfig($debug = false, $url = '')
    {
        $js = $this->wechatApp->js;

        if ($url == '') {
            $url = $_SERVER["HTTP_REFERER"];
        } else {
            if (isset($_SERVER["HTTP_REFERER"])) {
                return 'not found http referer';
            }
        }
        $js->setUrl($url);

        return $js->config(array('onMenuShareAppMessage','onMenuShareTimeline','onMenuShareQQ', 'onMenuShareWeibo','onMenuShareQZone'), $debug);
    }
}
