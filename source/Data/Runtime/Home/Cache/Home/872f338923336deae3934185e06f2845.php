<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta content="领袖户外" name="author"/>
	<!--特殊专题新疆标题关键字-->
	<?php if(C('MENU_CURRENT') == 'subject_xinjiang'): ?><title>新疆旅游的首选_领袖户外旅行网_好玩不贵的小团慢旅行_领袖户外官方网站</title>	
	    <meta content="新疆旅游的首选,领袖户外旅行网,好玩不贵的小团慢旅行,领袖户外官方网站" name="title"/>
	    <meta content="新疆旅游,新疆旅游攻略,新疆旅游费用,新疆旅游价格,新疆旅游景点大全,新疆驴友网,禾木驴友网,新疆驴友攻略,喀纳斯驴友网,新疆定制游" name="keywords"/>
	    <meta content="新疆旅游攻略，小团慢旅行,新疆自助游攻略，包括小团慢旅行,新疆热门景点、户外俱乐部、游记攻略、出行交通、餐饮等旅游信息，以及小团慢旅行,新疆驴友交流、驴友俱乐部信息。小团慢旅行,新疆旅游怎么订制。" name="description"/>
	<!--特殊专题丝绸之路标题关键字-->
	<?php elseif(C('MENU_CURRENT') == 'subject_silk'): ?>
	    <meta content="青海湖旅游攻略,青海湖旅游价格,敦煌旅游景点,敦煌旅游价格,青海驴友线路,青海驴友攻略,茶卡盐湖门票多钱,茶卡盐湖什么时候去好玩" name="keywords"/>
	    <meta content="300度环青海湖旅行，长达三天湖边游玩时间，避开顶光去茶卡，这是丝绸之路线路中最好的体验。丝绸之路旅游去哪儿玩？领袖户外为您独家定制专属线路,从青海湖到敦煌莫高窟,从嘉峪关到祁连山....更多的西北旅游信息就来领袖户外旅行网。" name="description"/>
		<title>丝绸之路旅游线路推荐-青海驴友俱乐部-甘肃驴友俱乐部-领袖户外旅行网-好玩不贵的小团慢旅行-茶卡盐湖驴友俱乐部</title>	
	<!--通用标题关键字-->
	<?php elseif(empty($PageKeyword) == false): ?>
		<meta content="<?php echo ($PageKeyword["title"]); ?>" name="title"/>
		<meta content="<?php echo ($PageKeyword["keywords"]); ?>" name="keywords"/>
		<meta content="<?php echo ($PageKeyword["description"]); ?>" name="description"/>
		<title><?php echo ($PageKeyword["title"]); ?></title>
	<?php else: ?>
		<title><?php echo C('PAGE_TITLE');?>-领袖户外</title><?php endif; ?>
	<!-- css Reset -->
	<link rel="stylesheet" href="/source/Static/home/common/css/cssreset.css">
	<!-- 轮播样式 -->
	<link rel="stylesheet" href="/source/Static/home/common/css/slide.css">
	<!-- 公共样式 -->
	<link rel="stylesheet" href="/source/Static/home/common/css/common.css">
	<!-- 公共样式 -->
	<link rel="stylesheet" href="/source/Static/common/css/common.css">
	<!--图标-->
	<link type="image/x-icon" rel="shortcut icon" href="/source/Static/home/common/images/favicon.ico" />
	<!-- 引用jq -->
	<script src="/source/Static/home/common/js/jquery-1.11.3.min.js"></script>
	
	<!-- Imported toastr -->
	<script src="/source/Static/assets/js/toastr/toastr.min.js"></script>
	<script src="/source/Static/common/js/functions.js"></script>

	<!--[if lt IE 9]>
		<script>
			(function() {
				if (! 
					/*@cc_on!@*/
				0) return;
				var e = "abbr, article, aside, audio, canvas, datalist, details, dialog, eventsource, figure, footer, header, hgroup, mark, menu, meter, nav, output, progress, section, time, video".split(', ');
				var i= e.length;
				while (i--){
					document.createElement(e[i])
				} 
			})() ;
		</script>
    	<script src="../common/js/html5shiv.min.js"></script>
    <![endif]-->
	
</head>
<body>
	<header>
		<div class="nav01">
			<div class="nav-top">
				<div class="nav-top-left">
					<?php if(is_array($stations)): $i = 0; $__LIST__ = $stations;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$s): $mod = ($i % 2 );++$i; if($s['forbidden'] === '0'): if($station['id'] == $s['id']): ?><a href="<?php echo U('index/welcome');?>/station/<?php echo ($s["key"]); ?>" style="color: #ff8000"> <?php echo ($s["name"]); ?> </a> |
							<?php else: ?>
								<a href="<?php echo U('index/welcome');?>/station/<?php echo ($s["key"]); ?>"> <?php echo ($s["name"]); ?> </a> |<?php endif; endif; endforeach; endif; else: echo "" ;endif; ?>
				</div>
				<div class="nav-top-right">
					<img src="/source/Static/home/common/images/login_header.png" alt=""></a>
					<?php if(empty($user) == true): ?><a href="<?php echo U('user/login');?>">登录</a> |
						<a href="<?php echo U('user/register');?>">注册</a>
					<?php else: ?>
						你好<a href="<?php echo U('user/info');?>" style="color: blue;"><?php echo ($user["show_name"]); ?></a>欢迎光临，
						<a href="javascript:;" style="color: blue;" class="user_logout">安全退出</a>！<?php endif; ?>
					<a href="<?php echo U('line/order');?>/type/center" target="_blank"> | 我的订单</a>
					<a href="<?php echo U('Subject/brand');?>" target="_blank"> | 关于我们</a>
					<a href="<?php echo U('service/center');?>" target="_blank"> | 服务中心</a>
					<img src="/source/Static/home/common/images/tel_header.png" alt="联系电话">
					<span>400-080-5860<!--<?php echo ($cs_tel); ?>--></span>
				</div>
			</div>
		</div>
		<script type="text/javascript">
			$('.user_logout').click(function(){
				logoutShequ('<?php echo U("user/exit");?>');	
			});
		</script>
		<div class="nav02">
			<div class="nav-list">
				<a class="go-welcome" href="<?php echo U('index/welcome');?>"><img src="/source/Static/home/common/images/logo1.png" alt="领袖户外"></a>
				<!--logo图片加链接会导致样式混乱-->
				<!--<img src="/source/Static/home/common/brand/logo_header.png" alt="领袖户外">-->
				<ul>
					<?php if(is_array($menus)): $i = 0; $__LIST__ = $menus;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i; if (is_array($menu) === false) { continue; } $jumpToLineList = false; switch($menu['item_desc']) { case '首页': $href=U('index/welcome'); break; case '跟拍游': $href=U('line/xiezhenlvxing'); break; case '私人定制': { $href=$pcset['team_link']; $target = '_blank'; }break; case '论坛': { $href = "http://shequ.kllife.com"; $target = '_blank'; }break; default: { $jumpToLineList = true; $href=U('line/list'); } break; } ?>
						<li class="nav-list-top">
							<?php $nav = $href; if ($jumpToLineList === true) { $nav = $href.'/m0/'.$menu['id']; } ?>
							<a href="<?php echo ($nav); ?>" target="<?php echo ($target); ?>"><?php echo ($menu["item_desc"]); ?></a>
							<?php if(!empty($menu["child"])): ?><div>
								<?php if(is_array($menu["child"])): $i = 0; $__LIST__ = $menu["child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$c): $mod = ($i % 2 );++$i;?><ul>
									<li>
										<?php $nav = $href; if (!empty($jumpToLineList)) { $nav = $href.'/m0/'.$menu['id'].'/m1/'.$c['id']; } ?>
										<a href="<?php echo ($nav); ?>" target="<?php echo ($target); ?>"><?php echo ($c["item_desc"]); ?></a>
									</li>
									<?php if(!empty($c["child"])): if(is_array($c["child"])): $i = 0; $__LIST__ = $c["child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cc): $mod = ($i % 2 );++$i;?><li>
												<?php $nav = $href; if (!empty($jumpToLineList)) { $nav = $href.'/m0/'.$menu['id'].'/m1/'.$c['id'].'/m2/'.$cc['id']; } ?>
												<a href="<?php echo ($nav); ?>"  target="<?php echo ($target); ?>"><?php echo ($cc["item_desc"]); ?></a>
											</li><?php endforeach; endif; else: echo "" ;endif; endif; ?>
								</ul><?php endforeach; endif; else: echo "" ;endif; ?>
							</div><?php endif; ?>
						</li><?php endforeach; endif; else: echo "" ;endif; ?>
				</ul>
				<div class="search-header" style="margin-right: 17px;">
					<img src="/source/Static/home/common/images/search_header.png" alt="">
					<input type="text" value="<?php echo ($searchval); ?>" placeholder="身未动 心已远..."/>
					<a href="javascript:;">搜索</a>
				</div>
				<script type="text/javascript">
					$(document).ready(function(){
						// 定位首页菜单
						positionTopMenu();
					});
					
					// 首页菜单动态定位
					function positionTopMenu(){
						var rootObj = $('.nav02').find('.nav-list');
						var firstMenuLeft = $(rootObj).find('.nav-list-top:first').offset().left;
						var startLeft = $(rootObj).offset().left;
						var leftOffset = parseInt(firstMenuLeft)-parseInt(startLeft);
						
						$(rootObj).find('.nav-list-top').each(function(i,el){
							if ($(this).find('div').length > 0) {						
								var childLength = $(this).find('div').find('ul').length;
								var ulObj = $(this).find('div').find('ul:first');
								var childWidth = parseInt($(ulObj).css('margin-left')) + parseInt($(ulObj).width());
								var totalWidth = parseInt(childWidth) * parseInt(childLength) + 30;
								$(this).find('div').css('width', totalWidth);
								
								var menuOffset = parseInt($(rootObj).width())-parseInt(totalWidth);
								if (menuOffset > leftOffset) {
									menuOffset = leftOffset;
								}
								$(this).find('div').css('left',menuOffset);								
							}
						});
						
					}
					
					function topSearchLine() {
						var search_val = $('.search-header').find('input').val();
						$.post('<?php echo U("line/search");?>', {searchval:search_val}, function(data){
							if (data.jumpUrl != null) {
								location.href = data.jumpUrl;
							}
						});
					}
					// 绑定回车时间
					bindKeyUp($('.search-header').find('input'),topSearchLine);
					$('.search-header').find('a').click(function(){
						topSearchLine();
					});					
				</script>
			</div>
		</div>		
	</header>
<link rel="stylesheet" href="/source/Static/home/css/northwest.css">
<div class="northwest">
    <!--banner-->
    <div class="banner"></div>
    <!--小团-->
    <div class="xiaotuan"></div>
    <!--推荐线路-->
    <div class="item template_item hidden_ctrl" data-id="">
        <div class="left"><img class="line_image" src="" alt=""></div>
        <div class="right">
            <h1 class="title"></h1><span class="tag"></span>
            <p class="subheading"></p>
            <p class="brief">丝路简介：<span class="send_word"></span></p>
            <div class="choice-time">
                <div class="time"><p>活动时间：<span class="date"></span></p></div>
                <div class="time">
                    <span class="span">出发日期：</span>
                    <select class="batch">
                    </select>
                </div>
            </div>
            <p>集合地点：<span class="assembly"></span></p>
            <p>目的地：<span class="destination"></span></p>
            <p class="price">￥<span class="adult_price"></span>元起 (成人)</p>
            <div class="sig-up">
                <p>本条线路已有 <span class="order_member_count"></span> 人已报名</p>
                <span class="btn">立即报名</span>
            </div>
        </div>
        <a href="" target="_blank"></a>
    </div>
    <!--盛夏西北-->
    <div class="recommend recommend1">
        <div class="content xibei1" data-subject="'xibei1">
            <div class="tit">
                <img src="/source/Static/home/images/northwest/recommend-tit1.png" alt="">
                <ul class="recommend_filter">
                	<?php if(is_array($subject_line_tab_xibei1)): $i = 0; $__LIST__ = $subject_line_tab_xibei1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tab): $mod = ($i % 2 );++$i; if($key == 0): ?><li class="active" data-subject="xibei1" data-tab="<?php echo ($tab["type_key"]); ?>"><?php echo ($tab["type_desc"]); ?></li>
                    	<?php else: ?>
                    		<li data-subject="xibei1" data-tab="<?php echo ($tab["type_key"]); ?>"><?php echo ($tab["type_desc"]); ?></li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                </ul>
                <div class="border"><!--此div只用于border--></div>
            </div>
            <?php if(is_array($subject_line_xibei1)): $i = 0; $__LIST__ = $subject_line_xibei1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$l): $mod = ($i % 2 );++$i;?><div class="item" data-id="<?php echo ($l["id"]); ?>">
                    <div class="left"><img class="line_image" src="<?php echo ($l["img1"]); ?>" alt=""></div>
                    <div class="right">
                        <h1 class="title"><?php echo ($l['title']); ?></h1><span class="tag <?php echo ($l['theme_type_list'][0]['type_key']); ?>"><?php echo ($l['theme_type_list'][0]['type_desc']); ?></span>
                        <p class="subheading"><?php echo ($l['subheading']); ?></p>
                        <p class="brief">丝路简介：<span class="send_word"><?php echo ($l["send_word_show"]); ?></span></p>
                        <div class="choice-time">
                            <div class="time"><p>活动时间：<span class="date"><?php echo ($l["start_time"]); ?> 至 <?php echo ($l["end_time"]); ?></span></p></div>
                            <div class="time">
                                <span class="span">出发日期：</span>
                                <select class="batch">
                                    <?php if(is_array($l["batchs"])): $i = 0; $__LIST__ = $l["batchs"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$b): $mod = ($i % 2 );++$i;?><option value="<?php echo ($b["id"]); ?>"><?php echo ($b["start_date_show"]); ?>[<?php echo ($b["state_data"]["type_desc"]); ?>]</option><?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                            </div>
                        </div>
                        <p>集合地点：<span class="assembly"><?php echo ($l["assembly_point_show_text"]); ?></span></p>
                        <p>目的地：<span class="destination"><?php echo ($l["destination_show_text"]); ?></span></p>
                        <p class="price">
                            <?php if(empty($l['check_price'])): ?><span class="adult_price">核算中</span>
                                <?php else: ?>
                                ￥<span class="adult_price"><?php echo ($l["start_price_adult"]); ?></span>元起 (成人)<?php endif; ?>
                        </p>
                        <div class="sig-up">
                            <p>本条线路已有 <span class="order_member_count"><?php echo ($l["order_member_count"]); ?></span> 人已报名</p>
                            <span class="btn">立即报名</span>
                        </div>
                    </div>
                    <a href="<?php echo U('line/info');?>/id/<?php echo ($l["id"]); ?>" target="_blank"></a>
                </div><?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
        <img class="bottom" style="margin-top:-400px;" src="/source/Static/home/images/northwest/recommend2-bottom.jpg" alt="">
    </div>
    <!--金秋西北-->
    <div class="recommend">
    	<div style="width:1200px;margin:auto;"><a href="http://pqt.zoosnet.net/lr/chatpre.aspx?id=pqt43116159&lng=cn&r=&rf1=&rf2=&p=http%3A//kllife.com/home/index.php%3Fs%3D/home/subject/xinjiang&cid=1497598677796708383968&sid=1499908846033380364902" target="_blank"><img src="/source/Static/home/images/xinjiang/ejina-kefu.gif" alt="" /></a></div>
        <div class="content xibei2" data-subject="'xibei2">
            <div class="tit">
                <img src="/source/Static/home/images/northwest/recommend-tit2.png" alt="">
                <ul class="recommend_filter"  style="width:552px;">
                	<?php if(is_array($subject_line_tab_xibei2)): $i = 0; $__LIST__ = $subject_line_tab_xibei2;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tab): $mod = ($i % 2 );++$i; if($key == 0): ?><li class="active" data-subject="xibei2" data-tab="<?php echo ($tab["type_key"]); ?>"><?php echo ($tab["type_desc"]); ?></li>
                    	<?php else: ?>
                    		<li data-subject="xibei2" data-tab="<?php echo ($tab["type_key"]); ?>"><?php echo ($tab["type_desc"]); ?></li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                </ul>
                <div class="border"></div>
            </div>
            <?php if(is_array($subject_line_xibei2)): $i = 0; $__LIST__ = $subject_line_xibei2;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$l): $mod = ($i % 2 );++$i;?><div class="item" data-id="<?php echo ($l["id"]); ?>">
                    <div class="left"><img class="line_image" src="<?php echo ($l["img1"]); ?>" alt=""></div>
                    <div class="right">
                        <h1 class="title"><?php echo ($l['title']); ?></h1><span class="tag <?php echo ($l['theme_type_list'][0]['type_key']); ?>"><?php echo ($l['theme_type_list'][0]['type_desc']); ?></span>
                        <p class="subheading"><?php echo ($l['subheading']); ?></p>
                        <p class="brief">丝路简介：<span class="send_word"><?php echo ($l["send_word_show"]); ?></span></p>
                        <div class="choice-time">
                            <div class="time"><p>活动时间：<span class="date"><?php echo ($l["start_time"]); ?> 至 <?php echo ($l["end_time"]); ?></span></p></div>
                            <div class="time">
                                <span class="span">出发日期：</span>
                                <select class="batch">
                                    <?php if(is_array($l["batchs"])): $i = 0; $__LIST__ = $l["batchs"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$b): $mod = ($i % 2 );++$i;?><option value="<?php echo ($b["id"]); ?>"><?php echo ($b["start_date_show"]); ?>[<?php echo ($b["state_data"]["type_desc"]); ?>]</option><?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                            </div>
                        </div>
                        <p>集合地点：<span class="assembly"><?php echo ($l["assembly_point_show_text"]); ?></span></p>
                        <p>目的地：<span class="destination"><?php echo ($l["destination_show_text"]); ?></span></p>
                        <p class="price">
                            <?php if(empty($l['check_price'])): ?><span class="adult_price">核算中</span>
                                <?php else: ?>
                                ￥<span class="adult_price"><?php echo ($l["start_price_adult"]); ?></span>元起 (成人)<?php endif; ?>
                        </p>
                        <div class="sig-up">
                            <p>本条线路已有 <span class="order_member_count"><?php echo ($l["order_member_count"]); ?></span> 人已报名</p>
                            <span class="btn">立即报名</span>
                        </div>
                    </div>
                    <a href="<?php echo U('line/info');?>/id/<?php echo ($l["id"]); ?>" target="_blank"></a>
                </div><?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
        <img class="bottom" style="margin-top:-400px;" src="/source/Static/home/images/northwest/recommend-bottom.jpg" alt="">
    </div>
    <!--小团慢每刻美切换-->
    <div class="xiaotuanman">
        <div class="xiaotuanman2">
            <div class="kllife"><a href="javascript:;"><img src="/source/Static/home/images/xinjiang/kllife.png" alt=""></a></div>
            <div class="meikemei"><a href="javascript:;"><img src="/source/Static/home/images/xinjiang/meikemei1.png" alt=""></a></div>
        </div>
        <div class="box box-one">
            <!--第一行-->
            <div class="lineS" style="top:-166px;">
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/northwest/xiaotuanman1.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/northwest/01.PNG">
                        </div>
                    </div>
                </div>
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/northwest/xiaotuanman2.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/northwest/02.PNG">
                        </div>
                    </div>
                </div>
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/northwest/xiaotuanman3.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/northwest/03.PNG">
                        </div>
                    </div>
                </div>
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/northwest/xiaotuanman4.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/northwest/04.PNG">
                        </div>
                    </div>
                </div>
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/northwest/xiaotuanman5.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/northwest/05.PNG">
                        </div>
                    </div>
                </div>
            </div>
            <!--第2行-->
            <div class="lineF" style="padding-left:222px">
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/northwest/xiaotuanman6.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/northwest/06.PNG">
                        </div>
                    </div>
                </div>
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/northwest/xiaotuanman7.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/northwest/07.PNG">
                        </div>
                    </div>
                </div>
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/northwest/xiaotuanman8.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/northwest/08.PNG">
                        </div>
                    </div>
                </div>
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/northwest/xiaotuanman9.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/northwest/09.PNG">
                        </div>
                    </div>
                </div>
            </div>
            <!--第3行-->
            <div class="lineS">
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/northwest/xiaotuanman10.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/northwest/10.JPG">
                        </div>
                    </div>
                </div>
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/northwest/xiaotuanman11.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/northwest/11.jpg">
                        </div>
                    </div>
                </div>
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/northwest/xiaotuanman12.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/northwest/12.jpg">
                        </div>
                    </div>
                </div>
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/northwest/xiaotuanman13.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/northwest/13.PNG">
                        </div>
                    </div>
                </div>
                <div class="boxF">
                    <div class="boxS">
                        <a href="<?php echo U('index/welcome');?>" target="_blank"><div class="boxT" style="background: url(/source/Static/home/images/xinjiang/kllife-add.png);"></div></a>
                    </div>
                </div>
            </div>
            <div class="lg-left"></div>
            <div class="lg-right"></div>
        </div>
        <div class="box box-two">
            <!--第一行-->
            <div class="lineS" style="top:-166px;">
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/xinjiang/xiaotuanman16.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/northwest/14.PNG">
                        </div>
                    </div>
                </div>
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/xinjiang/xiaotuanman17.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/northwest/15.PNG">
                        </div>
                    </div>
                </div>
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/xinjiang/xiaotuanman18.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/northwest/16.JPG">
                        </div>
                    </div>
                </div>
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/xinjiang/xiaotuanman19.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/northwest/17.PNG">
                        </div>
                    </div>
                </div>
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/xinjiang/xiaotuanman20.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/northwest/18.PNG">
                        </div>
                    </div>
                </div>
            </div>
            <!--第2行-->
            <div class="lineF" style="padding-left:222px;">
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/xinjiang/xiaotuanman21.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/northwest/19.PNG">
                        </div>
                    </div>
                </div>
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/xinjiang/xiaotuanman22.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/northwest/20.PNG">
                        </div>
                    </div>
                </div>
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/xinjiang/xiaotuanman23.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/northwest/21.PNG">
                        </div>
                    </div>
                </div>
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/xinjiang/xiaotuanman24.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/northwest/22.PNG">
                        </div>
                    </div>
                </div>
            </div>
            <!--第3行-->
            <div class="lineS">
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/xinjiang/xiaotuanman27.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/northwest/23.JPG">
                        </div>
                    </div>
                </div>
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/xinjiang/xiaotuanman28.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/northwest/24.PNG">
                        </div>
                    </div>
                </div>
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/xinjiang/xiaotuanman29.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/northwest/25.PNG">
                        </div>
                    </div>
                </div>
                <div class="boxF box-B">
                    <div class="boxS">
                        <div class="boxT" style="background: url(/source/Static/home/images/xinjiang/xiaotuanman30.jpg);background-position: center center;background-size: 100% 100%;" data-img="/source/Static/home/images/northwest/26.PNG">
                        </div>
                    </div>
                </div>
                <div class="boxF">
                    <div class="boxS">
                        <a href="http://xiezhenlvxing.com" target="_blank"><div class="boxT" style="background: url(/source/Static/home/images/xinjiang/meikemei-add.png);"></div></a>
                    </div>
                </div>
            </div>
            <div class="lg-left" style="background-color: #fff;background-repeat: no-repeat;background-position: center center;background-size:auto 100%;"></div>
            <div class="lg-right" style="background-color: #fff;background-repeat: no-repeat;background-position: center center;background-size:auto 100%;"></div>
        </div>
    </div>
    <!--私人定制-->
    <div class="customized">
        <div class="earth"><img style="width:140px;" src="/source/Static/home/images/silk/earth.gif" alt=""></div>
        <div class="customized2"><img src="/source/Static/home/images/silk/customized2.png" alt=""></div>
        <a href="<?php echo U('line/book');?>" class="btn btn-customized" target="_blank">定制我的旅行</a>
    </div>
    <!--往期游记-->
    <div class="review">
        <div class="content">
            <div class="tit"><img src="/source/Static/home/images/northwest/review-tit.png" alt=""></div>
            <video style="position:absolute;left:0px;right:0px;margin:auto;margin-top:40px;background: #fff;" height="255" width="420" controls="controls"  x5-video-player-type="h5"/>
            <source src="/source/Static/home/mp4/10029799-1.mp4" type="video/mp4">
            </video>
            <div class="goods-group">
                <div class="item">
                    <div class="img"><img class="img-responsive" src="/source/Static/home/images/silk/youji2016-07-25_57957e6b6fa9a.jpeg" alt=""></div>
                    <div class="tit">
                        <p>七月的丝路之行！</p>
                    </div>
                    <a href="http://shequ.kllife.com/Index/youjidetail/id/1495.html" target="_blank"></a>
                </div>
                <div class="item">
                    <div class="img"><img class="img-responsive" src="http://7xosrp.com1.z0.glb.clouddn.com/youji2016-10-28_5812f55e8c4ab.jpg?imageView2/2/w/1000/q/100/|watermark/1/image/aHR0cDovLzd4b3NycC5jb20xLnowLmdsYi5jbG91ZGRuLmNvbS95b3VqaTIwMTYtMDYtMjRfNTc2Y2RmZTBiOWUzZi5wbmc=/dissolve/100/gravity/SouthEast" alt=""></div>
                    <div class="tit">
                        <p>西北偏北———额济纳</p>
                    </div>
                    <a href="http://shequ.kllife.com/Index/youjidetail.html?id=2034" target="_blank"></a>
                </div>
                <div class="item">
                    <div class="img"><img class="img-responsive" src="/source/Static/home/images/northwest/youji2.jpg" alt=""></div>
                    <div class="tit">
                        <p>兰州集合，丝路经典9天西北大环线领略水上魔鬼城--2016.8.7</p>
                    </div>
                    <a href="http://shequ.kllife.com/Index/youjidetail.html?id=1783" target="_blank"></a>
                </div>
                <div class="item">
                    <div class="img"><img class="img-responsive" src="http://7xosrp.com1.z0.glb.clouddn.com/youji2017-06-08_5938ce270a797.jpg?watermark/1/image/aHR0cDovLzd4b3NycC5jb20xLnowLmdsYi5jbG91ZGRuLmNvbS95b3VqaTIwMTYtMDYtMjRfNTc2Y2RmZTBiOWUzZi5wbmc=/dissolve/100/gravity/SouthEast" alt=""></div>
                    <div class="tit">
                        <p>有了纵情丝路，其它的都弱爆了——直播，有大量美女，看的时候口水不要滴键盘上</p>
                    </div>
                    <a href="http://shequ.kllife.com/Index/youjidetail.html?id=3050" target="_blank"></a>
                </div>
                <div class="item">
                    <div class="img"><img class="img-responsive" src="/source/Static/home/images/northwest/youji3.jpg" alt=""></div>
                    <div class="tit">
                        <p>西北行漫记——大漠传奇意象</p>
                    </div>
                    <a href="http://shequ.kllife.com/Index/youjidetail.html?id=2186" target="_blank"></a>
                </div>
                <div class="item">
                    <div class="img"><img class="img-responsive" src="http://7xosrp.com1.z0.glb.clouddn.com/youji2016-10-25_580ecfc2be0a9.png?watermark/1/image/aHR0cDovLzd4b3NycC5jb20xLnowLmdsYi5jbG91ZGRuLmNvbS95b3VqaTIwMTYtMDYtMjRfNTc2Y2RmZTBiOWUzZi5wbmc=/dissolve/100/gravity/SouthEast" alt=""></div>
                    <div class="tit">
                        <p>西北游</p>
                    </div>
                    <a href="http://shequ.kllife.com/Index/youjidetail.html?id=2013" target="_blank"></a>
                </div>

                <a class="more" href="http://shequ.kllife.com" target="_blank"><img src="/source/Static/home/images/northwest/more.png" alt=""></a>
            </div>
        </div>
    </div>
    <!--其他线路推荐-->
    <div class="other">
        <div class="tit-one"><img class="background-img-loading" src="/source/Static/home/images/northwest/qita-tit.png" alt=""></div>
        <div class="goods-group">
            <?php if(is_array($recommend)): $i = 0; $__LIST__ = $recommend;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$rd): $mod = ($i % 2 );++$i;?><div class="item" data-id="<?php echo ($rd["id"]); ?>">
                    <div class="img">
                        <img class="background-img-loading" src="<?php echo ($rd["img1"]); ?>" alt="">
                        <p><span><?php echo ($rd["travel_day"]); ?></span>日游</p>
                    </div>
                    <div class="tit">
                        <p><span class="theme <?php echo ($rd['theme_type_list'][0]['type_key']); ?>"><?php echo ($rd['theme_type_list'][0]['type_desc']); ?></span></p>
                        <p class="lg"><?php echo ($rd['title']); ?></p>
                        <p class="money">
                            <span class="sm"><?php echo ($rd["send_word_show"]); ?></span>
                            <span class="sm1">
	                        	<?php if(empty($rd['check_price'])): ?><span class="lg1">核算中</span>
	                        	<?php else: ?>
	                        		¥<span class="lg1"><?php echo ($rd["start_price_adult"]); ?></span>起<?php endif; ?>
	                        </span>
                        </p>
                    </div>
                    <div class="choice-time">
                        <div class="time1">
                            <span class="span">出发时间：</span>
                            <select class="batch">
                                <?php if(is_array($rd["batchs"])): $i = 0; $__LIST__ = $rd["batchs"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$b): $mod = ($i % 2 );++$i;?><option value="<?php echo ($b["id"]); ?>"><?php echo ($b["start_date_show"]); ?>[<?php echo ($b["state_data"]["type_desc"]); ?>]</option><?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                        </div>
                        <div class="time2">本条线路已有 <span><?php echo ($rd["order_member_count"]); ?></span> 人报名</div>
                    </div>
                    <a href="<?php echo U('line/info');?>/id/<?php echo ($rd["id"]); ?>" target="_blank"></a>
                </div><?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
    </div>
    <!--周边线路推荐-->
    <div class="other zhoubian">
        <div class="tit-one"><img class="background-img-loading" src="/source/Static/home/images/northwest/zhoubian-tit.png" alt=""></div>
        <div class="goods-group">
            <?php if(is_array($surrounding)): $i = 0; $__LIST__ = $surrounding;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sur): $mod = ($i % 2 );++$i;?><div class="item" data-id="<?php echo ($sur["id"]); ?>">
                    <div class="img">
                        <img class="background-img-loading" src="<?php echo ($sur["img1"]); ?>" alt="">
                        <p><span><?php echo ($sur["travel_day"]); ?></span>日游</p>
                    </div>
                    <div class="tit">
                        <p><span class="theme <?php echo ($sur['theme_type_list'][0]['type_key']); ?>"><?php echo ($sur['theme_type_list'][0]['type_desc']); ?></span></p>
                        <p class="lg"><?php echo ($sur['title']); ?></p>
                        <p class="money">
                            <span class="sm"><?php echo ($sur["send_word_show"]); ?></span>
                            <span class="sm1">
	                        	<?php if(empty($sur['check_price'])): ?><span class="lg1">核算中</span>
	                        	<?php else: ?>
	                        		¥<span class="lg1"><?php echo ($sur["start_price_adult"]); ?></span>起<?php endif; ?>
	                        </span>
                        </p>
                    </div>
                    <div class="choice-time">
                        <div class="time1">
                            <span class="span">出发时间：</span>
                            <select class="batch">
                                <?php if(is_array($sur["batchs"])): $i = 0; $__LIST__ = $sur["batchs"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$b): $mod = ($i % 2 );++$i;?><option value="<?php echo ($b["id"]); ?>"><?php echo ($b["start_date_show"]); ?>[<?php echo ($b["state_data"]["type_desc"]); ?>]</option><?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                        </div>
                        <div class="time2">本条线路已有 <span><?php echo ($sur["order_member_count"]); ?></span> 人报名</div>
                    </div>
                    <a href="<?php echo U('line/info');?>/id/<?php echo ($sur["id"]); ?>" target="_blank"></a>
                </div><?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
    </div>
</div>
<!--弹框-->
<!--<div class="Popup" style="background: rgba(0,0,0,0.5);width:100%;height:100%;position: fixed;top:0px;left:0px;z-index:1000;">-->
<!--<div style="text-align: center;text-align: -webkit-center;margin-top:15%;">-->
<!--<span style="position: relative;display: inline-block;cursor: pointer;">-->
<!--<img src="/source/Static/home/images/northwest/cuxiao-pc.jpg" alt="">-->
<!--<img style="position: absolute;top:10px;right:10px;" src="/source/Static/home/images/index_img/xiaotuanmannone.png" alt="">-->
<!--</span>-->
<!--</div>-->
<!--</div>-->
</body>
<!--图片延迟加载-->
<script type="text/javascript" src="/source/Static/qinglvpai/common/js/jquery.lazyload.js"></script>
<script type="text/javascript">
    jQuery(document).ready(
        function($){
            $("img").lazyload({
                placeholder : "/source/Static/qinglvpai/common/js/grey.gif",
                effect      : "fadeIn",
                threshold : 100,
                failure_limit : 10
            });
        });
</script>
<script>
    //关闭弹框
    //    $(".Popup").on("click",function(){
    //        $(this).fadeOut("slow");
    //    })
    //推荐标签切换
//	$(".recommend_filter li").index(0).addClass('active');	
    $(".recommend_filter li").on("click",function(){
        $(this).addClass("active").siblings().removeClass("active");
        var opModal = $(this).attr('data-subject');
        var jsonData = {
        	op: opModal,
            tab: $(this).attr('data-tab'),
        };
        if ('<?php echo ($refresh); ?>' != '') {
            jsonData['refresh'] = '<?php echo ($refresh); ?>';
        }
        $.post('<?php echo U("subject/xibei_test");?>', jsonData, function(data){
            if (data.result != null && data.result.errno != 0) {
                alert(data.result.message);
            }

            $('.recommend').find('.'+opModal).find('.item').remove();
            if (data.ds != null) {
                for (var i=0; i < data.ds.length; i++) {
                    var d = data.ds[i];
                    var itemObj = $('.template_item').clone();
                    $(itemObj).removeClass('hidden_ctrl');
                    $(itemObj).removeClass('template_item');
                    $(itemObj).attr('data-id', d.id);
                    $(itemObj).find('.line_image').attr('src', d.img1);
                    $(itemObj).find('.title').html(d.title);
                    var themeType = d.theme_type_list != null && d.theme_type_list.length > 0 ? d.theme_type_list[0] : {type_key:'unknow', type_desc:'未知类型'};
                    $(itemObj).find('.tag').addClass(themeType.type_key);
                    $(itemObj).find('.tag').html(themeType.type_desc);
                    $(itemObj).find('.subheading').html(d.subheading);
                    $(itemObj).find('.send_word').html(d.send_word_show);
                    $(itemObj).find('.date').html(d.start_time+' 至 '+d.end_time);
                    if (d.batchs != null && d.batchs.length > 0) {
                        for (var j=0; j < d.batchs.length; j++) {
                            var b = d.batchs[j];
                            var sel = j==0 ? 'selected' : '';
                            if (b.state_data != null) {
                                $(itemObj).find('.batch').append('<option '+sel+' value="'+b.id+'">'+b.start_date_show+'['+b.state_data.type_desc+']</option>');
                            } else {
                                $(itemObj).find('.batch').append('<option '+sel+' value="'+b.id+'">'+b.start_date_show+'</option>');
                            }
                        }
                    }
                    $(itemObj).find('.assembly').html(d.assembly_point_show_text);
                    $(itemObj).find('.destination').html(d.destination_show_text);
                    if (d.check_price == 0) {
                        $(itemObj).find('.adult_price').parent().html('<span class="adult_price">核算中</span>');
                    } else {
                        $(itemObj).find('.adult_price').html(d.start_price_adult);
                    }
                    $(itemObj).find('.order_member_count').html(d.order_member_count);
                    $(itemObj).find('a').attr('href', '<?php echo U("line/info");?>/id/'+d.id);
                    $('.recommend').find('.'+opModal).append(itemObj);
                }

                if (data.ds.length > 0)  {
                    $(".bottom").css("margin-top","-870px");
                } else {
                    $(".bottom").css("margin-top","-550px");
                }
            }
        });
    })

    //推荐线路背景图片定位
    if($(".recommend .content .item").length>0){
        $(".bottom").css("margin-top","-870px")
    }else{
        $(".bottom").css("margin-top","-550px")
    }

    //kliiife和meikemei图片切换
    $(".xiaotuanman2 .kllife").on("mouseover",function(){
        $(".box-one").show();
        $(".box-two").hide();
        $(this).find("img").attr("src","/source/Static/home/images/xinjiang/kllife.png")
        $(".meikemei").find("img").attr("src","/source/Static/home/images/xinjiang/meikemei1.png")
    })
    $(".xiaotuanman2 .meikemei").on("mouseover",function(){
        $(".box-two").show();
        $(".box-one").hide();
        $(this).find("img").attr("src","/source/Static/home/images/xinjiang/meikemei.png")
        $(".kllife").find("img").attr("src","/source/Static/home/images/xinjiang/kllife1.png")
    })
    $(".box-B").on("mouseover",function(){
        var index = $(this).index();
        var img = $(this).find(".boxT").attr("data-img");
        if(index<2){
            $(".lg-right").show();
            $(".lg-left").hide();
            $(".lg-right").css({"background":"url("+ img +")","background-repeat":"no-repeat","background-color":"#fff","background-position":"center center","background-size":"auto 100%"});
        }else{
            $(".lg-left").show();
            $(".lg-right").hide();
            $(".lg-left").css({"background":"url("+ img +")","background-repeat":"no-repeat","background-color":"#fff","background-position":"center center","background-size":"auto 100%"});
        }
    })
    $(".box-B").on("mouseout",function(){
        $(".lg-right").hide();
        $(".lg-left").hide();
    })

    //点击显示筛选
    $("#show").on("click",function(){
        $(this).slideUp();
        $(".xinjiang .select").slideDown(1000);
    })
</script>
</html>

	<!-- 右侧侧边栏 -->
	<aside>
		<div class="join-us" style="margin-top:50px;">
			<a href="<?php echo U('subject/brand');?>"></a>
		</div>
		<a class="aside_hot" href="<?php echo U('service/center');?>" target="_blank">
			<i></i>
			<div class="aside_show aside_show_hot">
				<p>帮助中心</p>
			</div>
		</a>
		<a class="aside_mine" href="<?php echo U('user/info');?>" target="_blank">
			<i></i>
			<div class="aside_show aside_show_mine">
				<p>个人中心</p>
			</div>
		</a>
		<a class="aside_order" href="<?php echo U('line/order');?>/type/center" target="_blank">
			<i></i>
			<div class="aside_show aside_show_order">
				<p>订单中心</p>
			</div>
		</a>
		<a class="aside_weixin" href="javascript:;">
			<i></i>
			<div class="aside_show aside_show_weixin">
				<img src="/source/Static/home/common/images/aside_erweima.png" alt="二维码">
			</div>
		</a>
		<a class="aside_tel" href="javascript:;">
			<i></i>
			<div class="aside_show aside_show_tel">
				<p>400-080-5860</p>
			</div>
		</a>
		<a class="aside_qq" onclick="openZoosUrl('chatwin');">
			<i></i>
			<div class="aside_show aside_show_qq">
				<p>在线咨询</p>
			</div>
		</a>
		<a class="aside_top" href="#">
			<i></i>
		</a>
	</aside>

	<footer>
		<div class="footer-content">
			<div class="footer-content-left">
				<?php if(is_array($question_type)): $i = 0; $__LIST__ = $question_type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$qt): $mod = ($i % 2 );++$i; if ($key === 'config_update_time') { continue; } ?>
					<ul class="<?php echo ($qt["class"]); ?>">
						<li><?php echo ($qt["type_desc"]); ?></li>
						<?php if(is_array($qt["questions"])): $i = 0; $__LIST__ = $qt["questions"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$quest): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('service/question');?>/id/<?php echo ($quest["id"]); ?>"><?php echo ($quest["content"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
					</ul><?php endforeach; endif; else: echo "" ;endif; ?>
			</div>
			<div class="footer-content-right">
				<img src="/source/Static/home/common/images/footer_erweima.png" alt="">
			</div>
		</div>
	</footer>
	<div class="footer-bottom">
		<div class="footer-bottom-content">
			<p>
				友情链接：
				<?php if(is_array($pcset)): $i = 0; $__LIST__ = $pcset;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$set_val): $mod = ($i % 2 );++$i; if(stripos($key, 'pc_friend_link') === 0): if(!empty($fk)): ?>&nbsp;|&nbsp;<?php endif; ?>
						<?php $fk = json_decode($set_val, true); ?>
						<a href="<?php echo ($fk["url"]); ?>" target="_blank" this.onclick();><?php echo ($fk["text"]); ?></a><?php endif; endforeach; endif; else: echo "" ;endif; ?>
			</p>
			<span style="margin-top: 20px;">Copyright © 2006-2014 kllife.com | 陕西浪客国际旅行社有限责任公司版权所有</span><em>公司地址：陕西省西安市雁塔区太白南路上上国际</em>
			<br>
			<span>领袖户外经营许可证号：L-SNX00306 陕ICP备14011728号-1</span>
            <?php echo ($pcset["statistic_script"]); ?>
		</div>
	</div>
	
	<!-- Imported toastr -->
	<script src="/source/Static/assets/js/toastr/toastr.min.js"></script>
	<script src="/source/Static/common/js/functions.js"></script>
	<!-- 日期 -->
	<script src="/source/Static/home/common/js/jQuery-jcDate.js"></script>
	<!-- 轮播 -->
	<script src="/source/Static/home/js/unslider.min.js"></script>
	<!-- 自绑定 -->
	<script src="/source/Static/home/common/js/showAndHide.js"></script>
	<!-- 头部js -->
	<script src="/source/Static/home/common/js/headroom.js"></script>
	<!-- 侧边栏&头部 -->
	<script src="/source/Static/home/common/js/aside-header.js"></script>
	<script type="text/javascript">

	</script>
</body>
</html>