<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<?php if(empty($PageKeyword) == false): ?><meta content="<?php echo ($PageKeyword["title"]); ?>" name="title"/>
	<meta content="<?php echo ($PageKeyword["keywords"]); ?>" name="keywords"/>
	<meta content="<?php echo ($PageKeyword["description"]); ?>" name="description"/>
	<title><?php echo ($PageKeyword["title"]); ?></title>
	<?php else: ?>
	<title><?php echo C('PAGE_TITLE');?></title><?php endif; ?>    
	<!-- 引用jq -->
	<script src="http://kllife.com/source/Static/home/common/js/jquery-1.11.3.min.js"></script>
	
	<link rel="stylesheet" href="http://kllife.com/source/Static/qinglvpai/css/bootstrap.min.css">
	<link rel="stylesheet" href="http://kllife.com/source/Static/qinglvpai/css/animate.css">
	<link rel="stylesheet" href="http://kllife.com/source/Static/qinglvpai/css/style/style.css">
	<link rel="stylesheet" href="http://kllife.com/source/Static/qinglvpai/css/style.css">
	<link rel="stylesheet" href="http://kllife.com/source/Static/qinglvpai/css/iconfont.css">
	<!-- css Reset -->
	<link rel="stylesheet" href="http://kllife.com/source/Static/home/common/css/cssreset.css">
	<!-- 公共样式 -->
	<link rel="stylesheet" href="http://kllife.com/source/Static/home/common/css/common.css">
	<!-- 公共样式 -->
	<link rel="stylesheet" href="http://kllife.com/source/Static/common/css/common.css">
    <!--图标-->
    <link type="image/x-icon" rel="shortcut icon" href="http://kllife.com/source/Static/qinglvpai/common/images/favicon.ico" />
    <style>
        .top-ask{position: fixed;right:50px;bottom:100px;display: none;z-index:1000;}
        .top-ask div{margin:2px 0px;cursor: pointer;}
        .top-ask div img{width:50px;height:50px;}
    </style>
</head>
<body>
<!--header-->
<div class="header">
    <?php if(C('MENU_CURRENT') === 'index_welcome'): ?><a href="<?php echo U('index/story');?>" target="_blank"><div class="banner" style="background-image: url(<?php echo ($set["banner"]); ?>);"></div></a>
   	<?php elseif(C('MENU_CURRENT') === 'line_list'): ?>
        <div class="banner" style="background-image: url(<?php echo ($set["content_banner"]); ?>);"></div>
    <?php elseif(C('MENU_CURRENT') === 'line_content'): ?>
        <div class="banner-content" style="background-image: url(<?php echo ($set["qinglvpai_content_banner"]); ?>);"></div>
   	<?php elseif(C('MENU_CURRENT') === 'line_main_list'): ?>
        <div class="banner" style="background-image: url(<?php echo ($set["xiaomantuan_banner"]); ?>);"></div>
    <?php elseif(C('MENU_CURRENT') === 'line_main_content'): ?>
        <div class="banner-content" style="background-image: url(<?php echo ($set["xiaomantuan_content_banner"]); ?>);"></div>
    <?php elseif(C('MENU_CURRENT') === 'book_line' or C('MENU_CURRENT') === 'line_pay_result' or C('MENU_CURRENT') === 'index_story' or stripos(C('MENU_CURRENT'),'leader_list') !== FALSE): ?>
    <?php else: ?>
        <div class="banner-content" style="background-image: url(<?php echo ($set["qinglvpai_content_banner"]); ?>);"></div><?php endif; ?>
    <div class="div-two">
        <div class="list">
            <a href="<?php echo U('Index/welcome');?>" target="_blank"><img class="logo-white" src="http://kllife.com/source/Static/qinglvpai/images/index/logo-qinglvpai.png" alt=""></a>
            <ul>
                <a class="active" href="<?php echo U('index/welcome');?>" target="_blank">首页</a>
                <a href="<?php echo U('index/story');?>" target="_blank">品牌故事</a>
                <a href="<?php echo U('line/list');?>" target="_blank">跟拍游</a>
                <a href="<?php echo U('line/slowly');?>" target="_blank">小团慢旅行</a>
                <a href="<?php echo U('Leader/list');?>" target="_blank">摄影师</a>
                <!--<a href="javascript:;">客户回顾</a>-->
            </ul>
            <div class="tel">
                <img src="http://kllife.com/source/Static/qinglvpai/images/index/tel-img.png" alt="">
                <img src="http://kllife.com/source/Static/qinglvpai/images/index/tel-number.png" alt="">
                <!--<em><?php echo ($pcset["askfor_tel"]); ?></em>-->
            </div>
            <div class="tel login" style="line-height:80px;color:#fff;font-size: 14px;width:170px;text-align: center;text-align: -webkit-center">
				<?php if(empty($user) == true): ?><a href="<?php echo U('user/login');?>" target="_blank">登录</a> |
					<a href="<?php echo U('user/register');?>" target="_blank">注册</a>
				<?php else: ?>
					<a href="<?php echo U('line/order');?>/type/center" target="_blank">我的订单</a> |
					<a href="<?php echo U('user/exit');?>">退出</a><?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!--返回顶部，咨询-->
<div class="top-ask">
    <div onclick="openZoosUrl('chatwin');"><img src="http://kllife.com/source/Static/qinglvpai/common/images/ask1.jpg" alt=""></div>
    <div class="return-top"><img src="http://kllife.com/source/Static/qinglvpai/common/images/return-top.jpg" alt=""></div>
</div>
<script type="text/javascript">	
	// 导航划过变色
	$('.list ul a').mouseenter(function(){
		$(this).toggleClass('active');
	});
	$('.list ul a').mouseleave(function(){
		$(this).toggleClass('active');
	});

	// 登录我的订单点击选中
    $(".login a").on("click",function(){
        $(this).addClass("active").siblings("a").removeClass("active");
    })
    
    //屏幕滚动显示一键返回顶部按钮
    $(window).scroll( function (){
        if ($(this).scrollTop() > 150) {
            $('.top-ask').fadeIn();
        }else{
            $('.top-ask').fadeOut();
        };
    });

    //点击返回顶部
    $(".return-top").click(
        function(){
            $("html,body").animate({scrollTop: 0}, 1000);
        }
    );

</script>
<link rel="stylesheet" href="http://kllife.com/source/Static/qinglvpai/css/story.css">
    <div class="story">
        <div class="top-two">
        </div>
        <div class="share share-width" style="margin-top:30px; ">
            <div class="left left1" style="height:489px;">
                <div class="div2">
                    <h3 class="h3">深入目的地</h3>
                    <h3 class="h3">深度畅玩  全程跟拍</h3>
                    <div style="border-bottom:1px solid #ff1c77;width:140px;margin: auto;margin-top:10px;margin-bottom:10px;"><!--从div只用于显示border--></div>
                    <p class="h2">想拍漂亮的旅行照却不知道去哪拍好</p>
                    <p class="h2">身处美丽的风景中却不知道怎么拍才好看</p>
                    <p class="h2">你的旅途往往为此纠结不已</p>
                    <p class="h2">每刻美，十年深度旅行及旅拍经验</p>
                    <p class="h2">在不同的风景设计应景的主题场景</p>
                    <p class="h2">拍出你极致的美和不一样的风格</p>
                </div>
            </div>
            <div class="right right2" style="height:489px;">
                <img src="http://kllife.com/source/Static/qinglvpai/images/story/theme1.jpg" alt="">
            </div>
            <div class="left left2 left1" style="height:372px;">
                <div class="div3">
                    <h3 class="h3">严选摄影师</h3>
                    <h3 class="h3">所有美好 专业捕捉</h3>
                    <div style="border-bottom:1px solid #ff1c77;width:140px;margin: auto;margin-top:10px;margin-bottom:10px;"><!--从div只用于显示border--></div>
                    <p class="h2">我们的摄影师</p>
                    <p class="h2">要求娴熟的相机操作技术</p>
                    <p class="h2">及丰富的旅行拍摄经验</p>
                    <p class="h2">他们不仅是专业的拍摄者，也是快乐的同行者</p>
                    <p class="h2">积极热情负责任，用独特的美学视角</p>
                    <p class="h2">捕捉你的每一刻精彩瞬间</p>
                </div>
            </div>
            <div class="right right2" style="height:372px;">
                <img src="http://kllife.com/source/Static/qinglvpai/images/story/theme2.jpg" alt="">
            </div>
            <div class="left left1" style="height:372px;">
                <div class="div3">
                    <h3 class="h3">产品多样化</h3>
                    <h3 class="h3">体验款与定制款 随你所选</h3>
                    <div style="border-bottom:1px solid #ff1c77;width:140px;margin: auto;margin-top:10px;margin-bottom:10px;"><!--从div只用于显示border--></div>
                    <p class="h2">如果你有一群同好闺蜜</p>
                    <p class="h2">欢迎你私人定制</p>
                    <p class="h2">但偶尔，你也会单独出游</p>
                    <p class="h2">需要一个人承担高昂的旅拍费用</p>
                    <p class="h2">还不如参加初级体验款</p>
                    <p class="h2">享受美景拥有美照的同时，结识更多同好</p>
                    <p class="h2">每刻美，初级体验款&高端定制款</p>
                    <p class="h2">总有你喜欢的那一款</p>
                </div>
            </div>
            <div class="right right2" style="height:372px;">
                <img src="http://kllife.com/source/Static/qinglvpai/images/story/theme3.jpg" alt="">
            </div>
        </div>
        <div style="background: #f8f8f8;padding:0px 0px 50px;">
            <div class="brand-story">
                <h1 class="h1">品牌故事</h1>
                <div class="border"><!--此div只用于显示border--></div>
                <div class="left">
                    <div class="div">
                        <div><p>此生不长，有些精彩只会经历一次，有些风景只能路过一回。</p></div>
                        <div><p>我们总忙着实现事业目标，追寻社会存在感的光影里，每每有时间停下来，翻看那些旅途中的照片，才发现诸多照片中自己的身影少之又少，有几张还丑的不像样，一种说不出的落寞萦绕在心间。</p></div>
                        <div>
                            <p>我们知道热爱生活的你，同样也热爱旅行，热爱拍照</p>
                            <p>我们知道路过的风景无限，却不及白墙绿植下你笑靥如花</p>
                            <p>我们知道拍照是个让人又爱又受罪的事情，尤其是拍上整整一天，能让人累崩溃。</p>
                            <p>我们知道相较于动辄万元固定一地的旅拍，你其实更需要一次场景多变，能更多时间沉醉在风景里的旅拍体验。</p>
                        </div>
                        <div>
                            <p>所以，我们创立了跟拍游。让一群喜欢美，追求美的姐妹们欢聚在一起。深度玩，拍美照，交流美的秘籍。再也不怕时间紧张，匆匆赶场、再也不怕除了剪刀手，就是大头照了。你的美需要发现、需要珍藏、需要炫耀！</p>
                            <p>人生总有一天会疲倦，会老去，</p>
                            <p>但我们拍摄的每一张照片，都蕴含着一个故事，记录着一段过往。</p>
                            <p>那些重要的人，不可遗忘的事，曾经漂洋过海去看的风景，都会通过照片让记忆变得丰满而生动。</p>
                        </div>
                        <div>
                            <p>愿你旅途中的每一刻美好都有光影为伴，都有照片为鉴！</p>
                            <p>每刻美由此而来。</p>
                        </div>
                    </div>
                </div>
                <div class="right">
                    <img src="http://kllife.com/source/Static/qinglvpai/images/story/brand-1.jpg" alt="">
                    <img src="http://kllife.com/source/Static/qinglvpai/images/story/brand-2.jpg" alt="">
                    <img src="http://kllife.com/source/Static/qinglvpai/images/story/brand-3.jpg" alt="">
                </div>
            </div>
        </div>
        <div class="share">
            <h1 class="h1">美粉分享</h1>
            <div class="border"><!--此div只用于显示border--></div>
            <div class="left" style="background: #43b18c;color:#fff;">
                <div class="div1">
                    <p class="h2">典型的大射手，放纵不羁爱自由</p>
                    <p class="h2">颜值始终在线，萌值有增无减</p>
                    <p class="h2">喜欢独自出发去旅行、爱拍照，</p>
                    <p class="h2">跟过走马观花式的旅行团，但更向往慢下来享受旅行的乐趣</p>
                    <p class="h2">遛狗喝酒晒太阳，拼命浪费时光</p>
                    <p class="h2">内心有好多浪漫小想法</p>
                    <p class="h2">想在每一处风景绝佳处都留下自己的身影</p>
                </div>
            </div>
            <div class="right">
                <img src="http://kllife.com/source/Static/qinglvpai/images/story/share-1.jpg" alt="">
            </div>
            <div class="left left2">
                <div class="div1">
                    <p class="h2">烦透了影楼千篇一律的布景，夸张的大浓妆</p>
                    <p class="h2">受够了赶场拍摄的匆忙，傻瓜似的从头笑到尾</p>
                    <p class="h2">我要穿上最爱的白球鞋，带着婚纱去旅行</p>
                    <p class="h2">做最自在，最美的新娘</p>
                    <p class="h2">要和亲爱的他，十指相扣</p>
                    <p class="h2">一起越过千山，踏过万水</p>
                    <p class="h2">在最美的风景里</p>
                    <p class="h2">留下我们洋溢幸福的脸庞</p>
                </div>
            </div>
            <div class="right right2">
                <img src="http://kllife.com/source/Static/qinglvpai/images/story/share-2.jpg" alt="">
            </div>
            <div class="left">
                <div class="div1">
                    <p class="h2">结婚纪念日不只有玫瑰花、礼物、米其林大餐……</p>
                    <p class="h2">还有</p>
                    <p class="h2">你送我的这次旅行</p>
                    <p class="h2">结婚时许愿一起走一趟丝绸之路</p>
                    <p class="h2">一年后我们如约而至</p>
                    <p class="h2">雅丹魔鬼城的午后</p>
                    <p class="h2">夕阳如火，霞光满天</p>
                    <p class="h2">你俯身吻我，摄影师帮我们定格</p>
                    <p class="h2">就这样让我们相亲相爱一辈子</p>
                </div>
            </div>
            <div class="right">
                <img src="http://kllife.com/source/Static/qinglvpai/images/story/share-3.jpg" alt="">
            </div>
            <div class="left left2">
                <div class="div1">
                    <p class="h2">儿子尼莫</p>
                    <p class="h2">是我们夫妇去海南旅游时怀上的</p>
                    <p class="h2">所以起了这个名字</p>
                    <p class="h2">从他呱呱坠地后，我们经常会带他出去玩</p>
                    <p class="h2">5岁时在涠洲岛第一次见到大海</p>
                    <p class="h2">6岁半时在稻城亚丁看到了雪山</p>
                    <p class="h2">7岁，去了西藏，看了林芝桃花</p>
                    <p class="h2">今年，在喀拉峻大草原，他活蹦乱跳，兴奋到不行</p>
                    <p class="h2">家人、朋友都曾说：孩子太小，带出去很麻烦</p>
                    <p class="h2">但我就想带着他，去看看这个世界有多美</p>
                    <p class="h2">每一次我们都会拍很多照片</p>
                    <p class="h2">纪念他的成长，记录下我们一家人共同走过的路</p>
                </div>
            </div>
            <div class="right right2">
                <img src="http://kllife.com/source/Static/qinglvpai/images/story/share-4.jpg" alt="">
            </div>
            <div class="left">
                <div class="div1">
                    <p class="h2">十年前就商量着一起去新疆玩儿</p>
                    <p class="h2">可总被各种生活琐碎打乱</p>
                    <p class="h2">终于，我们的梦想实现了</p>
                    <p class="h2">赛里木湖、喀纳斯，禾木……</p>
                    <p class="h2">每一处景点，我们都拍照留念</p>
                    <p class="h2">十年的老闺蜜</p>
                    <p class="h2">一起谈天说地，享受美景，美酒，还有好心情</p>
                    <p class="h2">愿我们一生幸福，不被世俗羁绊</p>
                    <p class="h2">笑容爽朗，从容优雅</p>
                    <p class="h2">一直美下去</p>
                </div>
            </div>
            <div class="right">
                <img src="http://kllife.com/source/Static/qinglvpai/images/story/share-5.jpg" alt="">
            </div>
            <div class="left left2">
                <div class="div1">
                    <p class="h2">坐在余晖下的摇椅上</p>
                    <p class="h2">翻看年轻时拍的一张张旅行照</p>
                    <p class="h2">那时的你风流潇洒，我笑靥如花</p>
                    <p class="h2">一张张照片，记录着一个个故事</p>
                    <p class="h2">或尴尬，或欢喜……</p>
                    <p class="h2">细水流年、繁华落尽</p>
                    <p class="h2">无论我们惊艳了时光</p>
                    <p class="h2">还是温柔了岁月</p>
                    <p class="h2">在我这里</p>
                    <p class="h2">我们的故事有了寄托</p>
                </div>
            </div>
            <div class="right right2">
                <img src="http://kllife.com/source/Static/qinglvpai/images/story/share-6.jpg" alt="">
            </div>
        </div>
        <div class="my">
            <h1 class="h1">美粉心声</h1>
            <div class="border"><!--此div只用于显示border--></div>
            <img src="http://kllife.com/source/Static/qinglvpai/images/story/my.jpg" alt="">
            <div class="centent">
                <div>
                    <p class="h2">出发前你是否在纠结</p>
                    <p class="h2">碰到喜欢碎碎念、爱抱怨的人怎么办？</p>
                    <p class="h2">碰到爱磨蹭，</p>
                    <p class="h2">喜欢插队的人会影响我的旅拍计划吗？</p>
                    <p class="h2">碰到爱争抢摄影师的人，</p>
                    <p class="h2">能否拍到足够多的美照？</p>
                    <p class="h2">……</p>
                    <p class="h2">接触后，才发现，原先的顾虑都是多余的</p>
                </div>
                <div>
                    <p class="h2">热情爱美的王姨，气质优雅的李姐</p>
                    <p class="h2">超级温柔贴心的蓓蓓，团里的开心果小瑞</p>
                    <p class="h2">……</p>
                    <p class="h2">她们每一位都是热情善良，好相处</p>
                    <p class="h2">相由心生，我信了</p>
                </div>
                <div>
                    <p class="h2">游玩时，我们结伴而行</p>
                    <p class="h2">遇到美食，我们分而食之，再也不纠结</p>
                    <p class="h2">拍照时，交流pose，共享拍照小道具</p>
                    <p class="h2">休息时，畅谈生活中所有美的秘籍</p>
                    <p class="h2">感恩这23位旅伴</p>
                    <p class="h2">让我的拍照过程不再枯燥,</p>
                    <p class="h2">满满的都是欢笑和温暖</p>
                    <p class="h2">美照很重要，但跟大家一起交流美更可贵</p>
                </div>
            </div>
        </div>
        <div class="diff">
            <h1 class="h1">跟拍游与婚纱旅拍、普通跟拍游的区别</h1>
            <div class="border"><!--此div只用于显示border--></div>
            <img src="http://kllife.com/source/Static/qinglvpai/images/story/diff.jpg" alt="">
        </div>
        <!--<div class="contact">-->
            <!--<h1 class="h1">联系我们</h1>-->
            <!--<div class="border">&lt;!&ndash;此div只用于显示border&ndash;&gt;</div>-->
            <!--<h3 class="h3">每刻美新旅拍是领袖户外旗下专为爱美女性打造的子品牌</h3>-->
            <!--<h2 class="h2">公司地址：陕西省西安市雁塔区太白南路上上国际3号楼19层11903室</h2>-->
            <!--<h2 class="h2">联系电话：400-836-0002</h2>-->
            <!--<h2 class="h2">商务合作：029-882255622</h2>-->
            <!--<h2 class="h2">传真：029-89526056</h2>-->
            <!--<img src="http://kllife.com/source/Static/qinglvpai/images/story/qrcode.jpg" alt="">-->
        <!--</div>-->
        <div class="contact">
            <h1 class="h1">联系我们</h1>
            <div class="border"><!--此div只用于显示border--></div>
            <h2 class="h2">每刻美是领袖户外旗下杭州浪客旅行社有限公司针对女性消费者的跟拍游品牌，是针对女性消费群体推出的高品质旅游产品，将深度旅行体验</h2>
            <h2 class="h2" style="margin-bottom: 20px;">与主题拍摄相结合，满足中高端女性旅游消费者赏美景、深体验、玩美拍的旅游消费习惯及消费需求。</h2>
            <h2 class="h2">联系电话：400-836-0002</h2>
            <!--<h2 class="h2">商务合作：0571-89839741</h2>-->
            <!--<h2 class="h2">传真：0571-89839742</h2>-->
            <img src="http://kllife.com/source/Static/qinglvpai/images/story/qrcode.jpg" alt="">
        </div>
    </div>
<script type="text/javascript" src="http://kllife.com/source/Static/qinglvpai/common/js/jquery.lazyload.js"></script>
<script type="text/javascript">
    jQuery(document).ready(
        function($){
            $("img").lazyload({
                placeholder : "http://kllife.com/source/Static/qinglvpai/common/js/grey.gif",
                effect      : "fadeIn",
                threshold : 100,
                failure_limit : 10
            });
        });
</script>
<script>
    //队友分享文字垂直居中
    $(document).ready(function(){
        $(".left .div1").each(function(){
            var div1h = $(this).height();
            var top = (526-div1h)/2 +"px";
            $(this).css("padding-top",top);
        });
    });
    //489
    $(document).ready(function(){
        $(".left .div2").each(function(){
            var div2h = $(this).height();
            var top = (489-div2h)/2 +"px";
            $(this).css("padding-top",top);
        });
    });
    //372
    $(document).ready(function(){
        $(".left .div3").each(function(){
            var div3h = $(this).height();
            var top = (372-div3h)/2 +"px";
            $(this).css("padding-top",top);
        });
    });
</script>
<style>
	.footer-bottom-content span{margin-right:0px;}
</style>
	<footer>
		<!--<?php echo p_a($question_type);?>-->
		<div class="footer-content">
			<div class="footer-content-left">
				<?php if(is_array($question_type)): $i = 0; $__LIST__ = $question_type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$qt): $mod = ($i % 2 );++$i; if ($key === 'config_update_time') { continue; } ?>
					<ul class="<?php echo ($qt["class"]); ?>">
						<li><?php echo ($qt["type_desc"]); ?></li>
						<?php if(is_array($qt["questions"])): $i = 0; $__LIST__ = $qt["questions"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$quest): $mod = ($i % 2 );++$i;?><li><a target="_blank" href="<?php echo U('service/question');?>/id/<?php echo ($quest["id"]); ?>"><?php echo ($quest["content"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
					</ul><?php endforeach; endif; else: echo "" ;endif; ?>
			</div>
			<div class="footer-content-right">
				<img src="http://kllife.com/source/Static/qinglvpai/common/images/footer_erweima.png" alt="">
			</div>
		</div>
	</footer>
	<div class="footer-bottom">
		<div class="footer-bottom-content">
			<!--<p>
				友情链接：
				<?php if(is_array($pcset)): $i = 0; $__LIST__ = $pcset;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$set_val): $mod = ($i % 2 );++$i; if(stripos($key, 'pc_friend_link') === 0): if(!empty($fk)): ?>&nbsp;|&nbsp;<?php endif; ?>
						<?php $fk = json_decode($set_val, true); ?>
						<a href="<?php echo ($fk["url"]); ?>" target="_blank"><?php echo ($fk["text"]); ?></a><?php endif; endforeach; endif; else: echo "" ;endif; ?>
			</p>-->
			<span style="margin-top: 20px;">Copyright  2017 <a href="http://xiezhenlvxing.com" target="_blank" style="color:#fff;">xiezhenlvxing.com</a> | 杭州浪客旅行社有限公司版权所有</span>
			<br>
			<span>旅行社经营许可证号：ZJ30301 浙ICP备17010959号
			<span>
				<!--商务通代码--> 
				<script language="javascript" src="http://pqt.zoosnet.net/JS/LsJS.aspx?siteid=PQT43116159&float=1&lng=cn"></script>
				<script language="javascript" type="text/javascript" src="http://kllife.com/swt_xlp/js/swt.js"></script>
				<!--CNZZ统计--> 
				<script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1261595265'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s95.cnzz.com/z_stat.php%3Fid%3D1261595265%26show%3Dpic' type='text/javascript'%3E%3C/script%3E"));</script>
				<!--百度统计-->
				<script>
					var _hmt = _hmt || [];
					(function() {
						var hm = document.createElement("script");
						hm.src = "https://hm.baidu.com/hm.js?5b19bad2c5e7328683965e7447d46f4c";
						var s = document.getElementsByTagName("script")[0]; 
						s.parentNode.insertBefore(hm, s);
					})();
				</script>
			</span>
		</div>
	</div>
	
	<!-- Imported toastr -->
	<script src="http://kllife.com/source/Static/assets/js/toastr/toastr.min.js"></script>
	<script src="http://kllife.com/source/Static/common/js/functions.js"></script>

	
</body>
</html>