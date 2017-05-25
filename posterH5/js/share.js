if(String(window.location.href).indexOf("http://localhost")==-1){
(function () {
    var jsApiSrc = document.createElement("script");
    jsApiSrc.src = "//www.crazymoments.cn/wechat/getJsSign?url=" + encodeURIComponent(window.location.href) + "&callback=wxSetConfig";
    var s = document.getElementsByTagName("script")[0];
    s.parentNode.insertBefore(jsApiSrc, s);
})();
function wxSetConfig(config) {
    console.log(config);
    wx.config({
        debug: false,
        appId: config.appId,
        timestamp: config.timestamp,
        nonceStr: config.nonceStr,
        signature: config.signature,
        jsApiList: config.jsApiList
    });
    share0();
}
function share(w_link, w_imgUrl, w_title, w_desc, w_title2, func) {
    wx.ready(function () {
        wx.checkJsApi({
            jsApiList: [
                'onMenuShareTimeline',
                'onMenuShareAppMessage',
            ]
        });
        //分享给朋友
        wx.onMenuShareAppMessage({
            title: w_title,
            link: w_link,
            imgUrl: w_imgUrl,
            desc: w_desc,
            type: 'link', // 分享类型,music、video或link，不填默认为link
            dataUrl: '',
            success: function () {
                func();
            }
        });
        //分享到朋友圈
        wx.onMenuShareTimeline({
            title: w_title2,
            link: w_link,
            imgUrl: w_imgUrl,
            success: function () {
                func();
            }
        });
    });
}

//正式地址：

//var base_url = 'http://c.3viso.cn/milan/';
function share0() {
    var _w_link = url;
    var _w_imgUrl = url + 'img/share.jpg'+version;
    var _w_title = '春风十里不如定制专属，给你的亲子生活加点料';
    var _w_title2 = '春风十里不如定制专属，给你的亲子生活加点料';
    var _w_desc = '你读懂你家小怪兽的画了吗？';
    share(_w_link, _w_imgUrl, _w_title, _w_desc, _w_title2);
}

}