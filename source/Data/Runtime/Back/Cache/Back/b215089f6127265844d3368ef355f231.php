<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Xenon Boostrap Admin Panel" />
	<meta name="author" content="" />
	
	<title><?php echo C('PAGE_TITLE');?> - 领袖户外</title>

	<!--<link rel="stylesheet" href="http://fonts.useso.com/css?family=Arimo:400,700,400italic">-->
	<link rel="stylesheet" href="/source/Static/assets/css/fonts/linecons/css/linecons.css">
	<link rel="stylesheet" href="/source/Static/assets/css/fonts/fontawesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="/source/Static/assets/css/fonts/elusive/css/elusive.css">
	<link rel="stylesheet" href="/source/Static/assets/css/bootstrap.css">
	<link rel="stylesheet" href="/source/Static/assets/css/xenon-core.css">
	<link rel="stylesheet" href="/source/Static/assets/css/xenon-forms.css">
	<link rel="stylesheet" href="/source/Static/assets/css/xenon-components.css">
	<link rel="stylesheet" href="/source/Static/assets/css/xenon-skins.css">
	<link rel="stylesheet" href="/source/Static/assets/css/custom.css">
	<!--Import dropzone css-->
	<link rel="stylesheet" href="/source/Static/assets/js/dropzone/css/dropzone.css">
	<!--Import fileupload css-->
	<link rel="stylesheet" href="/source/Static/assets/js/fileupload/css/jquery.fileupload.css">
	<link rel="stylesheet" href="/source/Static/assets/js/fileupload/css/jquery.fileupload-ui.css">
	
	<link rel="stylesheet" href="/source/Static/common/css/common.css">

	<script src="/source/Static/assets/js/jquery-1.11.1.min.js"></script>

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="/source/Static/assets/js/html5shiv.min.js"></script>
		<script src="/source/Static/assets/js/respond.min.js"></script>
	<![endif]-->
	
	<style>
		.loading { position: fixed; z-index: 999; background: rgba(0,0,0,.5); top: 0; left: 0; width: 100%; text-align: center; display: none;}
		.loading .dashboard { position: absolute; top: 50%; left: 50%; margin-top: -125px; }
	</style>
	<script>
		$(document).ready(function(){
			var LoadingHeight = document.body.scrollHeight;
			$('.loading').css("height",LoadingHeight);	
		});
		
		function showLoading(bshow, tips) {
			if (bshow == false) {
				$('.loading').css('display', 'none');
			} else {
				$('.loading').css('display', 'block');
				if (tips != null && tips != 'undefined') {
					$('.loading').find('span').html(tips);	
				}
			}
		}
	</script>
	
</head>
<body class="page-body">
	<?php if(!empty($modal_data_edit)): ?><!-- Modal -->                    
	<div id="modal_data_edit"  class="modal fade custom-width">
		<div class="modal-dialog" style="width: 40%;">
			<div class="modal-content">
				
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h3 id="lab_modal_data_edit_title" class="modal-title">窗口标题</h3>
				</div>
				
				<div class="modal-body pan">
					<form>
						<div class="form-group has-error">
							<label class="control-label col-sm-11" id="lab_modal_data_edit_errmsg"></label>
						</div>
					</form>
	        		<form class="form-horizontal" id="form_modal_data_edit">
	       			</form>							
				</div>
				
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" id="btn_modal_data_edit_confirm">确认</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">关闭</button>
				</div>
			</div>
		</div>
	</div>
	
	<script type="text/javascript" >
		var modal_data_edit_init_data;
		$('document').ready(function(){
			_initModalDataEdit();		
		}); 
		
		// 设置操作提示语言
		function setModalDataEditTips(msg) {
			$('#lab_modal_data_edit_errmsg').html(msg);
		}
		
		// 重置窗口（需要重新初始化）
		function _resetModalDataEdit() {
			setModalDataEditTips('');
			$('#form_modal_data_edit').empty();
		}
		
		// 重置窗口Form（不许再次初始化）
		function _resetModalDataEditForm() {
			setModalDataEditTips('');
			var ds = modal_data_edit_init_data;
			var elmt = ds['elmt'];
			for (var i = 0; i < elmt.length; ++ i) {
				$('#field_modal_data_edit_'+elmt[i]['id']).val(elmt[i]['value']);
			}
		}
		
		// 初始化
		function _initModalDataEdit() {
			$('#modal_data_edit').on('show.bs.modal', function () {
			    $('body', document).addClass('modal-open');
			    $('<div class="modal-backdrop fade in"></div>').appendTo($('body', document));
			});
			$('#modal_data_edit').on('hide.bs.modal', function () {
			    $('body', document).removeClass('modal-open');
			    $('div.modal-backdrop').remove();
			    _resetModalDataEditForm();
			});
		}
		
		// 获取输入值
		function getModalDataEditInputValues(ds) {
			var vals = new Object();
			var elmt = ds['elmt'];
			for (var i = 0; i < elmt.length; ++ i) {
				var idText = '#field_modal_data_edit_'+elmt[i]['id'];				
				var tagName = $(idText).get(0).tagName				
				if (tagName == ''){
					vals[elmt[i]['id']] = $(idText).html();
				} else {
					vals[elmt[i]['id']] = $(idText).val();
				}
			}
			return vals;
		}
		
		// 填充输入值
		function setModalDataEditInputValues(ds) {
			var elmt = ds['elmt'];
			for (var i = 0; i < elmt.length; ++ i) {
				var attrs = elmt[i];
				var idText = '#field_modal_data_edit_'+attrs['id'];
				var tagName = $(idText).get(0).tagName
//				alert(tagName+'==>>'+JSON.stringify(attrs));
				if (tagName == 'SELECT') {
					$(idText).children('option').each(function(){
						if ($(this).val() == attrs['value']){
							$(this).prop('selected', true);
//							$(this).val(attrs['value']).trigger('change');
						} else {
							$(this).removeAttr('selected');
						}
					});
				} else {
					$(idText).val(attrs['value']);
				}
			}
		}
		
		// 添加可选值
		function appendModalDataEditInputValues(ds, clean) {
			var elmt = ds['elmt'];
			for (var i = 0; i < elmt.length; ++ i) {
				var idText = '#field_modal_data_edit_'+elmt[i]['id'];
				var tagName = $(idText).get(0).tagName
//				alert(tagName+'==>>'+JSON.stringify(elmt[i]));
				if (tagName == 'INPUT') {					
					var val = elmt[i]['value'];
					if (clean == false) {
						val = val + elmt[i]['value'];
					}
					$(idText).val(val);
				} else {			
					var html = elmt[i]['value'];
					if (clean == false) {
						html = html + elmt[i]['value'];
					}
					$(idText).html(html);	
				}
			}
		}
		
		// 绑定移除属性
		function bindModalDataEditInputAttr(ds) {
			var elmt = ds['elmt'];
			for (var i = 0; i < elmt.length; ++ i) {
				var d = elmt[i];
				if (d['id'] == 'undefined') {
					continue;
				}
				var idText = '#field_modal_data_edit_' + d['id'];
				if (d['op'] != 'undefined' && d['attr'] != 'undefined' && d['attr'].length > 0) {					
					for (var k = 0; k < d['attr'].length; ++ k) {
						var a = d['attr'][k];
						if (a['op'] == 'bind') {
							if (a['name'] != 'undefined' && a['value'] != 'undefined'){
								$(idText).attr(a['name'], a['value']);	
							}
						} else {
							if (a['name'] != 'undefined'){
								$(idText).removeAttr(a['name']);	
							}
						}
					}
				}
			}
		}
		
		// 绑定确认按钮事件
		function bindModalDataEditConfirmEvent(callback) {
			modal_data_edit_init_data['callback_confirm'] = callback;
		    // 重新绑定事件
		    $('#btn_modal_data_edit_confirm').off('click');
			$('#btn_modal_data_edit_confirm').on('click', function(){
				if (typeof(modal_data_edit_init_data['callback_confirm']) == 'function'){
					var vals = getModalDataEditInputValues(modal_data_edit_init_data);
					modal_data_edit_init_data['callback_confirm'](vals);
				}
			});
		}
		
		// 引入插件
		function bindModalDataEditPlugins(ds) {
			if (ds['elmt']=='undefined') {
				return false;
			}
			for (var i = 0; i < ds['elmt'].length; i++) {
				var elmt = ds['elmt'][i];
				var idText = '#field_modal_data_edit_' + elmt['id'];
				if (elmt['tag'] == 'select') {
//					alert(idText + '   ' + JSON.stringify(elmt));					
					$(idText).select2({
						placeholder: '请选择批次',
						allowClear: true,
						minimumResultsForSearch: -1, 
						// Hide the search bar
						formatResult: function(d){
							return "<div class='select2-user-result cx_border02'>" + d.text + "</div>"; 
						}
					});
				}
			}
		}
		
		// 添加元素
		function appendModalDataEditElement(ds) {
			if (ds['elmt']=='undefined') {
				return false;
			}
			var	html = $('#form_modal_data_edit').html();
			for (var i = 0; i < ds['elmt'].length; i++) {
				var elmt = ds['elmt'][i];
				html += '<div class="row">';
				html += '	<div class="col-md-2">';
				html += '		<label for="field_modal_data_edit_'+elmt['id']+'" class="control-label">'+elmt['lab']+'</label>';
				html += '	</div>';
				html += '	<div class="col-md-9">';
				html += '		<div class="form-group">';										
				html += '			<'+elmt['tag']+' id="field_modal_data_edit_'+elmt['id']+'" class="form-control"></'+elmt['tag']+'>';
				html += '		</div>';									
				html += '	</div>';
				html += '</div>';
			}
						
			$('#form_modal_data_edit').append(html);
			bindModalDataEditInputAttr(ds);
		}
		
		// 初始化页面
		function initModalDataEditPage(ds) {
			modal_data_edit_init_data = ds;
			// 初始化窗口输入
			appendModalDataEditElement(ds);
			// 初始化插件
//			bindModalDataEditPlugins(ds);
			// 其他控件初始化
			$('#lab_modal_data_edit_title').html(ds['lab_title_text']);
			$('#btn_modal_data_edit_confirm').html(ds['btn_confirm_text']);
			// 绑定事件
			bindModalDataEditConfirmEvent(ds['callback_confirm']);
		}
		
		// 显示窗口
		function showModalDataEdit() {		
			$("#modal_data_edit").modal('show', {backdrop: 'static'});
		}
		
		// 隐藏窗口
		function hideModalDataEdit() {
			$("#modal_data_edit").modal('hide');
		}
		
	</script><?php endif; ?>
<?php if(!empty($modal_type_data)): ?><!-- 添加数据类型 -->
	<div class="modal fade" id="gallery-type-data-modal" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content">
				
				<div class="modal-header">
					<h4 class="modal-title">数据类型添加</h4>
				</div>
				
				<div class="modal-body">
					
					<div class="row">
						<div class="col-md-12">
							<label class="control-label" for="modal_data_key">主键<span style="color: red;">（*只能由字母、数字、短线、下划线其中任意类型组合而且不能为空）</span></label>
							<input class="form-control" name="modal_data_key" id="modal_data_key" data-validate="required"/>
						</div>						
					</div>
					
					<div class="row">
						<div class="col-md-12">
							<label class="control-label" for="modal_data_desc">键值<span style="color: red;">（*只能由字母、数字、短线、下划线或者汉字其中任意类型组合而且不能为空）</span></label>
							<input class="form-control" name="modal_data_desc" id="modal_data_desc" data-validate="required"/>
						</div>						
					</div>
					
				</div>
				
				<div class="modal-footer">
					<button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
					<button type="button" class="btn btn-secondary">添加</button>
				</div>
			</div>
		</div>
	</div>
	
	<script type="text/javascript">			
		// 添加类型
		var modal_type_key = null;
		$('#gallery-type-data-modal').find('.btn-secondary').click(function(){
			var jsonData = {
				'type_key': modal_type_key,
				'data_key': $('#modal_data_key').val(),
				'data_desc': $('#modal_data_desc').val(),
			}
			$.post('<?php echo U("help/appendtypedata");?>', jsonData, function(data){
				if (data.result.errno == 0) {
					$('#gallery-type-data-modal').modal('hide');
				} else {
					alert(data.result.message);
				}
			});
		});
		
		// 显示类型数据添加界面
		function showModalTypeDataDialog(typeKey) {
			modal_type_key = typeKey;
			$('#modal_data_key').val('');
 			$('#modal_data_desc').val('');
			$("#gallery-type-data-modal").modal('show');
		}
	</script><?php endif; ?> 
<?php if(!empty($modal_upload_image)): ?><!-- 上传图片确认 -->
	<div class="modal fade custom-width" id="gallery-image-upload-modal" data-backdrop="static">
		<div class="modal-dialog" style="width: 90%">
			<div class="modal-content">
				
				<div class="modal-header">
					<h4 class="modal-title">上传图片</h4>
				</div>
				
				<div class="modal-body">
	
					<section class="gallery-env">
											
						<!-- Gallery Album Optipns and Images -->
						<div class="col-sm-9 gallery-right">
				
							<!-- Auto initialization -->
							<form id="ModalImageUpload" class="dropzone"></form>	
							
						</div>
						
						<!-- Gallery Sidebar -->
						<div class="col-sm-3 gallery-left">
							
							<!-- Album Header -->
							<div class="album-header">
								<h2>筛选</h2>
							</div>		
									
												
							<div class="row">					
								<div class="col-md-12">
									<div class="form-group">
										<p>图片标题：</p><br />
										<input type="text" style="height: 32px;" class="dingdan_bianji col-sm-12 modal_img_title">
									</div>
								</div>
							</div>
							<br />
							
							<div class="row">					
								<div class="col-md-12">
									<div class="form-group">
										<p>图片作者：</p><br />
										<input type="text" style="height: 32px;" class="dingdan_bianji col-sm-12 modal_img_author">
									</div>
								</div>
							</div>
							<br />
							
							<div class="row">					
								<div class="col-md-12">
									<div class="form-group">
										<p>图片类型：</p><br />
										<div class="input-group col-sm-12" style="border-color: #40bbea; float:left; margin-right:3px;">
											<script type="text/javascript">
												jQuery(document).ready(function($)
												{
													var modal_image_type_obj = $('.gallery-image-selector-modal').find(".modal_img_type").selectBoxIt().on('open', function()
													{
														// Adding Custom Scrollbar
														$(this).data('selectBoxSelectBoxIt').list.perfectScrollbar();
													});	
													
													// 默认选择第一个
													var initVal = $(modal_image_type_obj).find('option:first').attr('value');									
													$(modal_image_type_obj).val(initVal).trigger('change');
												});
											</script>
											<select class="form-control modal_img_type">
												<option value="-1">不限</option>
												<?php if(is_array($ImageTypes)): $i = 0; $__LIST__ = $ImageTypes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$imgType): $mod = ($i % 2 );++$i;?><option value="<?php echo ($imgType["id"]); ?>"><?php echo ($imgType["type_desc"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
											</select>
										</div>
									</div>
								</div>
							</div>
							<br />
							
							<div class="row">					
								<div class="col-md-12">
									<div class="form-group">
										<p>图片来源：</p><br />
										<div class="input-group col-sm-12" style="border-color: #40bbea; float:left; margin-right:3px;">
											<script type="text/javascript">
												jQuery(document).ready(function($)
												{
													var modal_image_from_obj = $('.gallery-image-selector-modal').find(".modal_img_from").selectBoxIt().on('open', function()
													{
														// Adding Custom Scrollbar
														$(this).data('selectBoxSelectBoxIt').list.perfectScrollbar();
													});	
													var initVal = $(modal_image_from_obj).find('option:first').attr('value');									
													$(modal_image_from_obj).val(initVal).trigger('change');
												});
											</script>
											<select class="form-control modal_img_from">
												<option value="-1">不限</option>
												<?php if(is_array($ImageFroms)): $i = 0; $__LIST__ = $ImageFroms;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$imgFrom): $mod = ($i % 2 );++$i;?><option value="<?php echo ($imgFrom["id"]); ?>"><?php echo ($imgFrom["type_desc"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
											</select>
										</div>
									</div>
								</div>
							</div>
							<br />
							
							<div class="row">					
								<div class="col-md-12">
									<div class="form-group">
										<p>内容类型：</p><br />
										<div class="input-group col-sm-12" style="border-color: #40bbea; float:left; margin-right:3px;">
											<script type="text/javascript">
												jQuery(document).ready(function($)
												{
													var modal_image_content_obj = $('.gallery-image-selector-modal').find(".modal_img_content").selectBoxIt().on('open', function()
													{
														// Adding Custom Scrollbar
														$(this).data('selectBoxSelectBoxIt').list.perfectScrollbar();
													});	
													var initVal = $(modal_image_content_obj).find('option:first').attr('value');									
													$(modal_image_content_obj).val(initVal).trigger('change');
												});
											</script>
											<select class="form-control modal_img_content">
												<option value="-1">不限</option>
												<?php if(is_array($ImageContents)): $i = 0; $__LIST__ = $ImageContents;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$imgContent): $mod = ($i % 2 );++$i;?><option value="<?php echo ($imgContent["id"]); ?>"><?php echo ($imgContent["type_desc"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
											</select>
										</div>
									</div>
								</div>
							</div>
							<br />
							
							<div class="row">					
								<div class="col-md-12">
									<div class="form-group">
										<p>地域类型：</p><br />
										<div class="input-group col-sm-12" style="border-color: #40bbea; float:left; margin-right:3px;">
											<script type="text/javascript">
												function getMenuItem(parentObj, childObj) {
													if ($(parentObj).val() == null) {
														return false;
													}
													
													var jsonData = {
														op_type: 'find',
														data_type: 'all',
														parent_id: $(parentObj).val(),
													};
																				
													$.post('<?php echo U("menu/list");?>', jsonData, function(backData){
														if (backData.result.errno == 0) {
															$(childObj).data('selectBox-selectBoxIt').remove();
															if (backData.data != null) {
																for (var k=0; k < backData.data.length; k++) {		
																	var d = backData.data[k];													
																	$(childObj).data('selectBox-selectBoxIt').add({value:d['id'], text:d['item_desc']});
																}	
															}
														}
													});
												}
												
												var modal_image_domain_obj=null, modal_image_district_obj=null, modal_image_distination_obj=null;	
												jQuery(document).ready(function($)
												{
													modal_image_domain_obj = $('.gallery-image-selector-modal').find(".modal_img_domain").selectBoxIt().on('open', function()
													{
														// Adding Custom Scrollbar
														$(this).data('selectBoxSelectBoxIt').list.perfectScrollbar();
													});	
													
													// 初始化
													var initVal = $(modal_image_domain_obj).find('option:first').attr('value');									
													$(modal_image_domain_obj).val(initVal).trigger('change');
													
													// 选项改变
													$(modal_image_domain_obj).change(function(){	
														if (modal_image_domain_obj != null && modal_image_district_obj != null) {
															getMenuItem(modal_image_domain_obj, modal_image_district_obj);
														}									
													});
													
												});
											</script>
											<select class="form-control modal_img_domain">
												<option value="-1">不限</option>
												<?php if(is_array($ImageDomains)): $i = 0; $__LIST__ = $ImageDomains;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$imgDomain): $mod = ($i % 2 );++$i;?><option value="<?php echo ($imgDomain["id"]); ?>"><?php echo ($imgDomain["item_desc"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
											</select>
										</div>
									</div>
								</div>
							</div>
							<br />
							
							<div class="row">					
								<div class="col-md-12">
									<div class="form-group">
										<p>辖区类型：</p><br />
										<div class="input-group col-sm-12" style="border-color: #40bbea; float:left; margin-right:3px;">
											<script type="text/javascript">
												jQuery(document).ready(function($)
												{
													modal_image_district_obj = $('.gallery-image-selector-modal').find(".modal_img_district").selectBoxIt().on('open', function()
													{
														// Adding Custom Scrollbar
														$(this).data('selectBoxSelectBoxIt').list.perfectScrollbar();
													});	
													var initVal = $(modal_image_district_obj).find('option:first').attr('value');									
													$(modal_image_district_obj).val(initVal).trigger('change');
												});
													
												// 选项改变
												$(modal_image_district_obj).change(function(){	
													if (modal_image_district_obj != null && modal_image_distination_obj != null) {
														getMenuItem(modal_image_district_obj, modal_image_distination_obj);
													}									
												});
											</script>
											<select class="form-control modal_img_district">
												<option value="-1">不限</option>
											</select>
										</div>
									</div>
								</div>
							</div>
							<br />
							
							<div class="row">					
								<div class="col-md-12">
									<div class="form-group">
										<p>目的地：</p><br />
										<div class="input-group col-sm-12" style="border-color: #40bbea; float:left; margin-right:3px;">
											<script type="text/javascript">
												jQuery(document).ready(function($)
												{
													var modal_image_distination_obj = $('.gallery-image-selector-modal').find(".modal_img_distination").selectBoxIt().on('open', function()
													{
														// Adding Custom Scrollbar
														$(this).data('selectBoxSelectBoxIt').list.perfectScrollbar();
													});	
													var initVal = $(modal_image_distination_obj).find('option:first').attr('value');									
													$(modal_image_distination_obj).val(initVal).trigger('change');
												});
											</script>
											<select class="form-control modal_img_distination">
												<option value="-1">不限</option>
											</select>
										</div>
									</div>
								</div>
							</div>
							<br />
																					
						</div> <!--End Left-->
									
					</section>
					
				</div>
				
				<div class="modal-footer">
					<button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
					<button type="button" class="btn btn-secondary btn-use">上传并使用</button>
				</div>
			</div>
		</div>
	</div>
	
	<script type="text/javascript">
		// 上传成功的回调函数
		var funcModalUploadCallBack = null;
		var modalUploadCallBack = null;
		var modalDropZone = null;
		var modalImageList = null;
		var modalUploadMaxFileCount = 20;
		var modalUploadMaxFileSize = 3;
		var modalUploadInitialized = false; // 已初始化
				
		// 显示上传插件
		function showModalUploadImageDialog(obj) {
			if (modalUploadInitialized == false) {
				_modalInitDropZone();
				// 一键上传所有图片
				$('#gallery-image-upload-modal').find('.btn-use').click(_modalUploadAllImage);
			}
			modalUploadCallBack = obj;
			_modalClearAllImage();
			$("#gallery-image-upload-modal").modal('show');
		}
		
		// 初始化上传插件
//		$(document).ready(function()
//			{
//			Dropzone.autoDiscover = false;
//			Dropzone.options.myAwesomeDropzone = false;
//			_modalInitDropZone();	
//			
//			// 上传所有图片
//			$('#gallery-image-upload-modal').find('.btn-use').click(_modalUploadAllImage);
//		});	
		
		// 初始化dropzone
		function _modalInitDropZone() {
			$('#ModalImageUpload').dropzone({
				url: '<?php echo U("image/fupload");?>',
				maxFiles: modalUploadMaxFileCount,	// 允许上传的文件个数
				maxFilesize: modalUploadMaxFileSize,	// 单个文件最大上传大小，3MB
				acceptFiles:'.jpg,.jpeg,.png,.gif',
				addRemoveLinks: true,
				uploadMultiple: false,
				autoProcessQueue: false,
				dictDefaultMessage: '点击此处添加图片',
				dictRemoveFile: '删除',
				init:function(){
					modalDropZone = this;
					this.on('addedfile', _modalAddUploadImage);
					this.on('removedfile', _modalRemoveUploadImage);
					this.on('error', _modalImageError);
					this.on('processing', _modalImageProcessing);
					this.on('uploadprogress', _modalImageUploadProgress);
					this.on('sending', _modalImageSending);
					this.on('success', _modalImageSucess);
					this.on('complete', _modalImageComplete);
					this.on('canceled', _modalImagecanceled);
					this.on('maxfilesreached', _modalImageMaxFilesReached);
					this.on('maxfilesexceeded', _modalImageMaxFilesExceeded);
									
				},
			});
			modalUploadInitialized = true;
		}
		
		
		// 检测是否可以添加图片
		var modalFileCount = 0;
		function _modalCheckAllowUpload() {
			modalFileCount = modalDropZone.getAcceptedFiles().length;	
			if (modalFileCount < 1) {
				alert('请上传照片...');
				return false;
			}
			if (modalFileCount > 20) {
				alert('您一次上传的照片不应该超过20张');
				return false;
			}
			return true;
		}
		
		// 检查编辑图片的信息
		function _modalcheckImageInfo() {
			var rootObj = $('#gallery-image-upload-modal');
			var title = $(rootObj).find('.modal_img_title').val();
			if (title == '') {
				alert('图片的标题不能为空，可能的话请尽量补全其它图片信息，谢谢合作!');
				return false;
			}
			return true;
		}
		
		// 添加所有图片
		function _modalUploadAllImage(){
			// 检查是否允许上传
		    if (_modalCheckAllowUpload() == false) {
		    	return false;
		    }
		    // 检查图片描述
		    if (_modalcheckImageInfo() == false) {
		    	return false;
		    }
			
			// 加载上传等待层
			showLoading(true);
			// 开始上传
			modalDropZone.processQueue();
			
			modalImageList = new Array();
//			var fs = modalDropZone.getAcceptedFiles();
//			for (var i = 0; i < fs.length; ++ i) {
//			}
			
		}
		
		// 清除所有添加的图片
		function _modalClearAllImage(){	
			// console.log('_modalClearAllImage->清除所有图片');
			modalDropZone.removeAllFiles(true);
		}
		
		// 添加图片
		function _modalAddUploadImage(f) {	
			// console.log('_modalAddUploadImage->'+JSON.stringify(f));		
			//alert('add:' + f.name);
//			f.previewElement.addEventListener("click", function(f) {
//				alert(111);
//				modalDropZone.removeFile(f);
//			});
			
		}
		
		// 删除图片
		function _modalRemoveUploadImage(f) {
			// console.log('_modalRemoveUploadImage->'+JSON.stringify(f));	
		}
		
		// 出错时. 接受 errorMessage 作为第二个参数，并且如果错误是 XMLHttpRequest对象， 那就作为第三个参数.
		function _modalImageError(f, errMsg, xhr) {
			// console.log('_modalImageError->'+ JSON.stringify(f) + ",error:" + errMsg);	
		}
		
		// 当一个文件获取处理 （因为不是所有的文件会立即得到处理的队列）。以前，此事件被称为 processingfile
		function _modalImageProcessing(f) {
			// console.log('_modalImageProcessing->'+JSON.stringify(f));	
		}
		
		//	无论文件在什么时候被改变都会调用此函数.
		//	处理进度作为第二个参数，范围为(0-100); 发送到服务的字节数作为第三个参数
		//	当上传文件完成确保至少一次处理进度被设置为100%
		//	警告: 函数可能同时被多次调用
		function _modalImageUploadProgress(f, p, b) {
			// console.log('_modalImageUploadProgress->'+JSON.stringify(f) + ",process" + p + ",byte:" + b + "KB");
		}
		
		// 在每个文件被发送前调用. 得到 xhr 对象 和 formData 对象作为第二个和第三个参数, 所以你可以修改他们(add a CSRF token) 或者追加额外的数据.
		function _modalImageSending(f, xhr, formData) {	
			var rootObj = $('#gallery-image-upload-modal');
			formData.append('title', $(rootObj).find('.modal_img_title').val());
			formData.append('author', $(rootObj).find('.modal_img_author').val());
			formData.append('intro', $(rootObj).find('.img_intro').val());
//			formData.append('type_id', $(rootObj).find('.modal_img_type').val());
			formData.append('from_type_id', $(rootObj).find('.modal_img_from').val());
			formData.append('content_type_id', $(rootObj).find('.modal_img_content').val());
			formData.append('tags', $(rootObj).find('.modal_img_domain').val());
			formData.append('domain_type_id', $(rootObj).find('.img_domain').val());
			formData.append('district_type_id', $(rootObj).find('.modal_img_district').val());
			formData.append('distination_type_id', $(rootObj).find('.modal_img_distination').val());
			// console.log('_modalImageSending->'+JSON.stringify(f)+JSON.stringify(formData));	
		}
		
		// 文件已经成功上传，获得服务器返回信息作为第二个参数(这个时间又被称作finished)
		function _modalImageSucess(f, backData) {
			// console.log('_modalImageSucess->'+JSON.stringify(f)+JSON.stringify(backData));
			if (backData['result']['errno'] == 0) {
				// 调用上传成功图片函数
				var imageUrl = backData.ds.url;
				modalImageList.push(imageUrl);
				// 上传成功后移除该文件
				modalDropZone.removeFile(f);
				
				
			} else {
				alert('上传失败,原因如下:\n' + backData['result']['message']);
			}
		}
		
		// 当上传完成，成功或者出现错误时调用
		function _modalImageComplete(f) {
			// console.log('_modalImageComplete->'+JSON.stringify(f));
//			goBtnTop($('#gallery-image-upload-modal').find('.btn-use'));
//			console.log(123);
			modalFileCount--;
			if (modalFileCount == 0) {
				if (typeof(funcModalUploadCallBack) == 'function') {
					funcModalUploadCallBack(modalUploadCallBack, modalImageList);
					
				}
				showLoading(false);
				// 关闭窗口
				$('#gallery-image-upload-modal').modal('hide');
				
			}
			if (f.accepted != false) {
				modalDropZone.processQueue();	
			}
		}
		
		// 当取消文件上传式调用
		function _modalImagecanceled(f) {
			// console.log('_modalImagecanceled->'+JSON.stringify(f));
		}
		
		// 当文件的数量达到maxFiles限制时调用
		function _modalImageMaxFilesReached(f) {
			// console.log('_modalImageMaxFilesReached->'+JSON.stringify(f));
		}
		
		// 由于文件数量达到 maxFiles 限制数量被拒绝时调用
		function _modalImageMaxFilesExceeded(f) {
			// console.log('_modalImageMaxFilesExceeded->'+JSON.stringify(f));
			modalDropZone.removeFile(f);
		}		
		
	</script><?php endif; ?>
<?php if(!empty($modal_select_image)): if(empty($modal_upload_image) == true): ?><!-- 上传图片确认 -->
	<div class="modal fade custom-width" id="gallery-image-upload-modal" data-backdrop="static">
		<div class="modal-dialog" style="width: 90%">
			<div class="modal-content">
				
				<div class="modal-header">
					<h4 class="modal-title">上传图片</h4>
				</div>
				
				<div class="modal-body">
	
					<section class="gallery-env">
											
						<!-- Gallery Album Optipns and Images -->
						<div class="col-sm-9 gallery-right">
				
							<!-- Auto initialization -->
							<form id="ModalImageUpload" class="dropzone"></form>	
							
						</div>
						
						<!-- Gallery Sidebar -->
						<div class="col-sm-3 gallery-left">
							
							<!-- Album Header -->
							<div class="album-header">
								<h2>筛选</h2>
							</div>		
									
												
							<div class="row">					
								<div class="col-md-12">
									<div class="form-group">
										<p>图片标题：</p><br />
										<input type="text" style="height: 32px;" class="dingdan_bianji col-sm-12 modal_img_title">
									</div>
								</div>
							</div>
							<br />
							
							<div class="row">					
								<div class="col-md-12">
									<div class="form-group">
										<p>图片作者：</p><br />
										<input type="text" style="height: 32px;" class="dingdan_bianji col-sm-12 modal_img_author">
									</div>
								</div>
							</div>
							<br />
							
							<div class="row">					
								<div class="col-md-12">
									<div class="form-group">
										<p>图片类型：</p><br />
										<div class="input-group col-sm-12" style="border-color: #40bbea; float:left; margin-right:3px;">
											<script type="text/javascript">
												jQuery(document).ready(function($)
												{
													var modal_image_type_obj = $('.gallery-image-selector-modal').find(".modal_img_type").selectBoxIt().on('open', function()
													{
														// Adding Custom Scrollbar
														$(this).data('selectBoxSelectBoxIt').list.perfectScrollbar();
													});	
													
													// 默认选择第一个
													var initVal = $(modal_image_type_obj).find('option:first').attr('value');									
													$(modal_image_type_obj).val(initVal).trigger('change');
												});
											</script>
											<select class="form-control modal_img_type">
												<option value="-1">不限</option>
												<?php if(is_array($ImageTypes)): $i = 0; $__LIST__ = $ImageTypes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$imgType): $mod = ($i % 2 );++$i;?><option value="<?php echo ($imgType["id"]); ?>"><?php echo ($imgType["type_desc"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
											</select>
										</div>
									</div>
								</div>
							</div>
							<br />
							
							<div class="row">					
								<div class="col-md-12">
									<div class="form-group">
										<p>图片来源：</p><br />
										<div class="input-group col-sm-12" style="border-color: #40bbea; float:left; margin-right:3px;">
											<script type="text/javascript">
												jQuery(document).ready(function($)
												{
													var modal_image_from_obj = $('.gallery-image-selector-modal').find(".modal_img_from").selectBoxIt().on('open', function()
													{
														// Adding Custom Scrollbar
														$(this).data('selectBoxSelectBoxIt').list.perfectScrollbar();
													});	
													var initVal = $(modal_image_from_obj).find('option:first').attr('value');									
													$(modal_image_from_obj).val(initVal).trigger('change');
												});
											</script>
											<select class="form-control modal_img_from">
												<option value="-1">不限</option>
												<?php if(is_array($ImageFroms)): $i = 0; $__LIST__ = $ImageFroms;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$imgFrom): $mod = ($i % 2 );++$i;?><option value="<?php echo ($imgFrom["id"]); ?>"><?php echo ($imgFrom["type_desc"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
											</select>
										</div>
									</div>
								</div>
							</div>
							<br />
							
							<div class="row">					
								<div class="col-md-12">
									<div class="form-group">
										<p>内容类型：</p><br />
										<div class="input-group col-sm-12" style="border-color: #40bbea; float:left; margin-right:3px;">
											<script type="text/javascript">
												jQuery(document).ready(function($)
												{
													var modal_image_content_obj = $('.gallery-image-selector-modal').find(".modal_img_content").selectBoxIt().on('open', function()
													{
														// Adding Custom Scrollbar
														$(this).data('selectBoxSelectBoxIt').list.perfectScrollbar();
													});	
													var initVal = $(modal_image_content_obj).find('option:first').attr('value');									
													$(modal_image_content_obj).val(initVal).trigger('change');
												});
											</script>
											<select class="form-control modal_img_content">
												<option value="-1">不限</option>
												<?php if(is_array($ImageContents)): $i = 0; $__LIST__ = $ImageContents;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$imgContent): $mod = ($i % 2 );++$i;?><option value="<?php echo ($imgContent["id"]); ?>"><?php echo ($imgContent["type_desc"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
											</select>
										</div>
									</div>
								</div>
							</div>
							<br />
							
							<div class="row">					
								<div class="col-md-12">
									<div class="form-group">
										<p>地域类型：</p><br />
										<div class="input-group col-sm-12" style="border-color: #40bbea; float:left; margin-right:3px;">
											<script type="text/javascript">
												function getMenuItem(parentObj, childObj) {
													if ($(parentObj).val() == null) {
														return false;
													}
													
													var jsonData = {
														op_type: 'find',
														data_type: 'all',
														parent_id: $(parentObj).val(),
													};
																				
													$.post('<?php echo U("menu/list");?>', jsonData, function(backData){
														if (backData.result.errno == 0) {
															$(childObj).data('selectBox-selectBoxIt').remove();
															if (backData.data != null) {
																for (var k=0; k < backData.data.length; k++) {		
																	var d = backData.data[k];													
																	$(childObj).data('selectBox-selectBoxIt').add({value:d['id'], text:d['item_desc']});
																}	
															}
														}
													});
												}
												
												var modal_image_domain_obj=null, modal_image_district_obj=null, modal_image_distination_obj=null;	
												jQuery(document).ready(function($)
												{
													modal_image_domain_obj = $('.gallery-image-selector-modal').find(".modal_img_domain").selectBoxIt().on('open', function()
													{
														// Adding Custom Scrollbar
														$(this).data('selectBoxSelectBoxIt').list.perfectScrollbar();
													});	
													
													// 初始化
													var initVal = $(modal_image_domain_obj).find('option:first').attr('value');									
													$(modal_image_domain_obj).val(initVal).trigger('change');
													
													// 选项改变
													$(modal_image_domain_obj).change(function(){	
														if (modal_image_domain_obj != null && modal_image_district_obj != null) {
															getMenuItem(modal_image_domain_obj, modal_image_district_obj);
														}									
													});
													
												});
											</script>
											<select class="form-control modal_img_domain">
												<option value="-1">不限</option>
												<?php if(is_array($ImageDomains)): $i = 0; $__LIST__ = $ImageDomains;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$imgDomain): $mod = ($i % 2 );++$i;?><option value="<?php echo ($imgDomain["id"]); ?>"><?php echo ($imgDomain["item_desc"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
											</select>
										</div>
									</div>
								</div>
							</div>
							<br />
							
							<div class="row">					
								<div class="col-md-12">
									<div class="form-group">
										<p>辖区类型：</p><br />
										<div class="input-group col-sm-12" style="border-color: #40bbea; float:left; margin-right:3px;">
											<script type="text/javascript">
												jQuery(document).ready(function($)
												{
													modal_image_district_obj = $('.gallery-image-selector-modal').find(".modal_img_district").selectBoxIt().on('open', function()
													{
														// Adding Custom Scrollbar
														$(this).data('selectBoxSelectBoxIt').list.perfectScrollbar();
													});	
													var initVal = $(modal_image_district_obj).find('option:first').attr('value');									
													$(modal_image_district_obj).val(initVal).trigger('change');
												});
													
												// 选项改变
												$(modal_image_district_obj).change(function(){	
													if (modal_image_district_obj != null && modal_image_distination_obj != null) {
														getMenuItem(modal_image_district_obj, modal_image_distination_obj);
													}									
												});
											</script>
											<select class="form-control modal_img_district">
												<option value="-1">不限</option>
											</select>
										</div>
									</div>
								</div>
							</div>
							<br />
							
							<div class="row">					
								<div class="col-md-12">
									<div class="form-group">
										<p>目的地：</p><br />
										<div class="input-group col-sm-12" style="border-color: #40bbea; float:left; margin-right:3px;">
											<script type="text/javascript">
												jQuery(document).ready(function($)
												{
													var modal_image_distination_obj = $('.gallery-image-selector-modal').find(".modal_img_distination").selectBoxIt().on('open', function()
													{
														// Adding Custom Scrollbar
														$(this).data('selectBoxSelectBoxIt').list.perfectScrollbar();
													});	
													var initVal = $(modal_image_distination_obj).find('option:first').attr('value');									
													$(modal_image_distination_obj).val(initVal).trigger('change');
												});
											</script>
											<select class="form-control modal_img_distination">
												<option value="-1">不限</option>
											</select>
										</div>
									</div>
								</div>
							</div>
							<br />
																					
						</div> <!--End Left-->
									
					</section>
					
				</div>
				
				<div class="modal-footer">
					<button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
					<button type="button" class="btn btn-secondary btn-use">上传并使用</button>
				</div>
			</div>
		</div>
	</div>
	
	<script type="text/javascript">
		// 上传成功的回调函数
		var funcModalUploadCallBack = null;
		var modalUploadCallBack = null;
		var modalDropZone = null;
		var modalImageList = null;
		var modalUploadMaxFileCount = 20;
		var modalUploadMaxFileSize = 3;
		var modalUploadInitialized = false; // 已初始化
				
		// 显示上传插件
		function showModalUploadImageDialog(obj) {
			if (modalUploadInitialized == false) {
				_modalInitDropZone();
				// 一键上传所有图片
				$('#gallery-image-upload-modal').find('.btn-use').click(_modalUploadAllImage);
			}
			modalUploadCallBack = obj;
			_modalClearAllImage();
			$("#gallery-image-upload-modal").modal('show');
		}
		
		// 初始化上传插件
//		$(document).ready(function()
//			{
//			Dropzone.autoDiscover = false;
//			Dropzone.options.myAwesomeDropzone = false;
//			_modalInitDropZone();	
//			
//			// 上传所有图片
//			$('#gallery-image-upload-modal').find('.btn-use').click(_modalUploadAllImage);
//		});	
		
		// 初始化dropzone
		function _modalInitDropZone() {
			$('#ModalImageUpload').dropzone({
				url: '<?php echo U("image/fupload");?>',
				maxFiles: modalUploadMaxFileCount,	// 允许上传的文件个数
				maxFilesize: modalUploadMaxFileSize,	// 单个文件最大上传大小，3MB
				acceptFiles:'.jpg,.jpeg,.png,.gif',
				addRemoveLinks: true,
				uploadMultiple: false,
				autoProcessQueue: false,
				dictDefaultMessage: '点击此处添加图片',
				dictRemoveFile: '删除',
				init:function(){
					modalDropZone = this;
					this.on('addedfile', _modalAddUploadImage);
					this.on('removedfile', _modalRemoveUploadImage);
					this.on('error', _modalImageError);
					this.on('processing', _modalImageProcessing);
					this.on('uploadprogress', _modalImageUploadProgress);
					this.on('sending', _modalImageSending);
					this.on('success', _modalImageSucess);
					this.on('complete', _modalImageComplete);
					this.on('canceled', _modalImagecanceled);
					this.on('maxfilesreached', _modalImageMaxFilesReached);
					this.on('maxfilesexceeded', _modalImageMaxFilesExceeded);
									
				},
			});
			modalUploadInitialized = true;
		}
		
		
		// 检测是否可以添加图片
		var modalFileCount = 0;
		function _modalCheckAllowUpload() {
			modalFileCount = modalDropZone.getAcceptedFiles().length;	
			if (modalFileCount < 1) {
				alert('请上传照片...');
				return false;
			}
			if (modalFileCount > 20) {
				alert('您一次上传的照片不应该超过20张');
				return false;
			}
			return true;
		}
		
		// 检查编辑图片的信息
		function _modalcheckImageInfo() {
			var rootObj = $('#gallery-image-upload-modal');
			var title = $(rootObj).find('.modal_img_title').val();
			if (title == '') {
				alert('图片的标题不能为空，可能的话请尽量补全其它图片信息，谢谢合作!');
				return false;
			}
			return true;
		}
		
		// 添加所有图片
		function _modalUploadAllImage(){
			// 检查是否允许上传
		    if (_modalCheckAllowUpload() == false) {
		    	return false;
		    }
		    // 检查图片描述
		    if (_modalcheckImageInfo() == false) {
		    	return false;
		    }
			
			// 加载上传等待层
			showLoading(true);
			// 开始上传
			modalDropZone.processQueue();
			
			modalImageList = new Array();
//			var fs = modalDropZone.getAcceptedFiles();
//			for (var i = 0; i < fs.length; ++ i) {
//			}
			
		}
		
		// 清除所有添加的图片
		function _modalClearAllImage(){	
			// console.log('_modalClearAllImage->清除所有图片');
			modalDropZone.removeAllFiles(true);
		}
		
		// 添加图片
		function _modalAddUploadImage(f) {	
			// console.log('_modalAddUploadImage->'+JSON.stringify(f));		
			//alert('add:' + f.name);
//			f.previewElement.addEventListener("click", function(f) {
//				alert(111);
//				modalDropZone.removeFile(f);
//			});
			
		}
		
		// 删除图片
		function _modalRemoveUploadImage(f) {
			// console.log('_modalRemoveUploadImage->'+JSON.stringify(f));	
		}
		
		// 出错时. 接受 errorMessage 作为第二个参数，并且如果错误是 XMLHttpRequest对象， 那就作为第三个参数.
		function _modalImageError(f, errMsg, xhr) {
			// console.log('_modalImageError->'+ JSON.stringify(f) + ",error:" + errMsg);	
		}
		
		// 当一个文件获取处理 （因为不是所有的文件会立即得到处理的队列）。以前，此事件被称为 processingfile
		function _modalImageProcessing(f) {
			// console.log('_modalImageProcessing->'+JSON.stringify(f));	
		}
		
		//	无论文件在什么时候被改变都会调用此函数.
		//	处理进度作为第二个参数，范围为(0-100); 发送到服务的字节数作为第三个参数
		//	当上传文件完成确保至少一次处理进度被设置为100%
		//	警告: 函数可能同时被多次调用
		function _modalImageUploadProgress(f, p, b) {
			// console.log('_modalImageUploadProgress->'+JSON.stringify(f) + ",process" + p + ",byte:" + b + "KB");
		}
		
		// 在每个文件被发送前调用. 得到 xhr 对象 和 formData 对象作为第二个和第三个参数, 所以你可以修改他们(add a CSRF token) 或者追加额外的数据.
		function _modalImageSending(f, xhr, formData) {	
			var rootObj = $('#gallery-image-upload-modal');
			formData.append('title', $(rootObj).find('.modal_img_title').val());
			formData.append('author', $(rootObj).find('.modal_img_author').val());
			formData.append('intro', $(rootObj).find('.img_intro').val());
//			formData.append('type_id', $(rootObj).find('.modal_img_type').val());
			formData.append('from_type_id', $(rootObj).find('.modal_img_from').val());
			formData.append('content_type_id', $(rootObj).find('.modal_img_content').val());
			formData.append('tags', $(rootObj).find('.modal_img_domain').val());
			formData.append('domain_type_id', $(rootObj).find('.img_domain').val());
			formData.append('district_type_id', $(rootObj).find('.modal_img_district').val());
			formData.append('distination_type_id', $(rootObj).find('.modal_img_distination').val());
			// console.log('_modalImageSending->'+JSON.stringify(f)+JSON.stringify(formData));	
		}
		
		// 文件已经成功上传，获得服务器返回信息作为第二个参数(这个时间又被称作finished)
		function _modalImageSucess(f, backData) {
			// console.log('_modalImageSucess->'+JSON.stringify(f)+JSON.stringify(backData));
			if (backData['result']['errno'] == 0) {
				// 调用上传成功图片函数
				var imageUrl = backData.ds.url;
				modalImageList.push(imageUrl);
				// 上传成功后移除该文件
				modalDropZone.removeFile(f);
				
				
			} else {
				alert('上传失败,原因如下:\n' + backData['result']['message']);
			}
		}
		
		// 当上传完成，成功或者出现错误时调用
		function _modalImageComplete(f) {
			// console.log('_modalImageComplete->'+JSON.stringify(f));
//			goBtnTop($('#gallery-image-upload-modal').find('.btn-use'));
//			console.log(123);
			modalFileCount--;
			if (modalFileCount == 0) {
				if (typeof(funcModalUploadCallBack) == 'function') {
					funcModalUploadCallBack(modalUploadCallBack, modalImageList);
					
				}
				showLoading(false);
				// 关闭窗口
				$('#gallery-image-upload-modal').modal('hide');
				
			}
			if (f.accepted != false) {
				modalDropZone.processQueue();	
			}
		}
		
		// 当取消文件上传式调用
		function _modalImagecanceled(f) {
			// console.log('_modalImagecanceled->'+JSON.stringify(f));
		}
		
		// 当文件的数量达到maxFiles限制时调用
		function _modalImageMaxFilesReached(f) {
			// console.log('_modalImageMaxFilesReached->'+JSON.stringify(f));
		}
		
		// 由于文件数量达到 maxFiles 限制数量被拒绝时调用
		function _modalImageMaxFilesExceeded(f) {
			// console.log('_modalImageMaxFilesExceeded->'+JSON.stringify(f));
			modalDropZone.removeFile(f);
		}		
		
	</script><?php endif; ?>
	
	<link rel="stylesheet" href="/source/Static/home/common/css/page.css">
	<style type="text/css">		
		.selectboxit-btn { background: #fff; border-color: #4EC83B; }
		.selectboxit-list { background-color: #fff; border: 1px solid #4EC83B; }
		.selectboxit-list .selectboxit-option-anchor { color: #979898; }
		.form-control:focus { border-color: #4EC83B; }
		a { color: #979898; }
		.dingdan_bianji { border: 1px solid #4EC83B; }
		.dingdan_bottom > p , .dingdan_bottom > span{ margin-top: 7px; }
		.dingdan_bottom { margin-bottom: 10px; }
		
		.hidden_ctrl {
			display: none;
		}
		.modal_my_pic_border{
			height: 180px;
			border:1px solid #4EC83B; 
    		overflow: hidden;
		}
		.modal_my_pic { 
   			position: relative;
		}
		#filter_button {
			background-color: #68b828;
			color: #fff;
		}
		.modal_my_pic_border i { position: absolute; bottom:0; left:0; display: block; width:100%; height: 32px; line-height:32px; text-align: center; font-style:normal; background-color:#5ca323; color:#fff; cursor: pointer; z-index: 9; }
		.gallery-env .album-images .album-image .thumb img { max-height: 146px; }
		.pagination > li { display: inline-block; margin-top:5px; }
	</style>
	<script type="text/javascript">
	// Sample Javascript code for this page
	jQuery(document).ready(function($)
	{
		// Sample Select all images
		$("#gallery-image-selector-modal").find('#select-all').on('change', function(ev)
		{
			ev.preventDefault();
			var is_checked = $(this).is(':checked');			
//			$(".album-image input[type='checkbox']").prop('checked', is_checked).trigger('change');
			if (is_checked) {
				$(".image-checkbox img").removeClass('hidden_ctrl');
			} else {
				$(".image-checkbox img").addClass('hidden_ctrl');
			}
			
		});		
	});
	</script>
	
	<!-- 选择图片确认 -->
	<div class="modal fade custom-width" id="gallery-image-selector-modal" data-backdrop="static">
		<div class="modal-dialog" style="width: 90%">
			<div class="modal-content">
				
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h1 class="modal-title">选择图片</h1>
				</div>
				
				<div class="modal-body">
	
					<section class="gallery-env">
											
						<!-- Gallery Album Optipns and Images -->
						<div class="col-sm-9 gallery-right">
							
							<!-- Album Header -->
							<div class="album-header">
								<h2>图片列表</h2>
								
								<ul class="album-options list-unstyled list-inline">
									<li>
										<input type="checkbox" class="cbr" id="select-all" />
										<label for="select-all">全选</label>
									</li>
									<li>
										<a class="modal_select_image_upload" href="javascript:;">
											<i class="fa-upload"></i>
											上传
										</a>
									</li>
								</ul>
							</div>			
								
							<!-- Template Album Image -->
							<div class="col-md-3 col-sm-4 col-xs-6 template_ablum hidden_ctrl">
								<div class="album-image" data-id="">									
									<div class="image-checkbox">
										<!--<input type="checkbox" class="cbr" />-->
										<img class="hidden_ctrl" src="/source/Static/back/images/ok.png" />
									</div>
									
									<a href="#" class="thumb modal_my_pic_border">
										<img src="" class="img-responsive modal_my_pic" />
										<i>选择并使用</i>
									</a>
									
									<a href="#" class="name">
										<span></span>
										<p></p>
									</a>
								</div>
							</div>
										
							<div class="list-page"></div>
							<!--<ul class="pagination">
							</ul>-->
							
							<!-- Album Images -->
							<div class="album-images row">					
							</div>
										
							<!--<ul class="pagination">
							</ul>-->
							
							<div class="list-page"></div>
							
						</div>
						
						<!-- Gallery Sidebar -->
						<div class="col-sm-3 gallery-left">
							
							<!-- Album Header -->
							<div class="album-header">
								<h2>筛选</h2>
							</div>		
							
							<!--<div class="gallery-sidebar">-->		
												
							<div class="row">					
								<div class="col-md-12">
									<div class="form-group">
										<p>图片标题：</p><br />
										<input type="text" style="height: 32px;" class="dingdan_bianji col-sm-12 modal_img_title">
									</div>
								</div>
							</div>
							<br />
							
							<div class="row">					
								<div class="col-md-12">
									<div class="form-group">
										<p>图片作者：</p><br />
										<input type="text" style="height: 32px;" class="dingdan_bianji col-sm-12 modal_img_author">
									</div>
								</div>
							</div>
							<br />
							
							<div class="row">					
								<div class="col-md-12">
									<div class="form-group">
										<p>图片类型：</p><br />
										<div class="input-group col-sm-12" style="border-color: #40bbea; float:left; margin-right:3px;">
											<script type="text/javascript">
												jQuery(document).ready(function($)
												{
													var modal_image_type_obj = $('.gallery-image-selector-modal').find(".modal_img_type").selectBoxIt().on('open', function()
													{
														// Adding Custom Scrollbar
														$(this).data('selectBoxSelectBoxIt').list.perfectScrollbar();
													});	
													
													// 默认选择第一个
													var initVal = $(modal_image_type_obj).find('option:first').attr('value');									
													$(modal_image_type_obj).val(initVal).trigger('change');
												});
											</script>
											<select class="form-control modal_img_type">
												<option value="-1">不限</option>
												<?php if(is_array($ImageTypes)): $i = 0; $__LIST__ = $ImageTypes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$imgType): $mod = ($i % 2 );++$i;?><option value="<?php echo ($imgType["id"]); ?>"><?php echo ($imgType["type_desc"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
											</select>
										</div>
									</div>
								</div>
							</div>
							<br />
							
							<div class="row">					
								<div class="col-md-12">
									<div class="form-group">
										<p>图片来源：</p><br />
										<div class="input-group col-sm-12" style="border-color: #40bbea; float:left; margin-right:3px;">
											<script type="text/javascript">
												jQuery(document).ready(function($)
												{
													var modal_image_from_obj = $('.gallery-image-selector-modal').find(".modal_img_from").selectBoxIt().on('open', function()
													{
														// Adding Custom Scrollbar
														$(this).data('selectBoxSelectBoxIt').list.perfectScrollbar();
													});	
													var initVal = $(modal_image_from_obj).find('option:first').attr('value');									
													$(modal_image_from_obj).val(initVal).trigger('change');
												});
											</script>
											<select class="form-control modal_img_from">
												<option value="-1">不限</option>
												<?php if(is_array($ImageFroms)): $i = 0; $__LIST__ = $ImageFroms;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$imgFrom): $mod = ($i % 2 );++$i;?><option value="<?php echo ($imgFrom["id"]); ?>"><?php echo ($imgFrom["type_desc"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
											</select>
										</div>
									</div>
								</div>
							</div>
							<br />
							
							<div class="row">					
								<div class="col-md-12">
									<div class="form-group">
										<p>内容类型：</p><br />
										<div class="input-group col-sm-12" style="border-color: #40bbea; float:left; margin-right:3px;">
											<script type="text/javascript">
												jQuery(document).ready(function($)
												{
													var modal_image_content_obj = $('.gallery-image-selector-modal').find(".modal_img_content").selectBoxIt().on('open', function()
													{
														// Adding Custom Scrollbar
														$(this).data('selectBoxSelectBoxIt').list.perfectScrollbar();
													});	
													var initVal = $(modal_image_content_obj).find('option:first').attr('value');									
													$(modal_image_content_obj).val(initVal).trigger('change');
												});
											</script>
											<select class="form-control modal_img_content">
												<option value="-1">不限</option>
												<?php if(is_array($ImageContents)): $i = 0; $__LIST__ = $ImageContents;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$imgContent): $mod = ($i % 2 );++$i;?><option value="<?php echo ($imgContent["id"]); ?>"><?php echo ($imgContent["type_desc"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
											</select>
										</div>
									</div>
								</div>
							</div>
							<br />
							
							<div class="row">					
								<div class="col-md-12">
									<div class="form-group">
										<p>地域类型：</p><br />
										<div class="input-group col-sm-12" style="border-color: #40bbea; float:left; margin-right:3px;">
											<script type="text/javascript">
												function getMenuItem(parentObj, childObj) {
													if ($(parentObj).val() == null) {
														return false;
													}
													
													var jsonData = {
														op_type: 'find',
														data_type: 'all',
														parent_id: $(parentObj).val(),
													};
																				
													$.post('<?php echo U("menu/list");?>', jsonData, function(backData){
														if (backData.result.errno == 0) {
															$(childObj).data('selectBox-selectBoxIt').remove();
															if (backData.data != null) {
																for (var k=0; k < backData.data.length; k++) {		
																	var d = backData.data[k];													
																	$(childObj).data('selectBox-selectBoxIt').add({value:d['id'], text:d['item_desc']});
																}	
															}
														}
													});
												}
												
												var modal_image_domain_obj=null, modal_image_district_obj=null, modal_image_distination_obj=null;	
												jQuery(document).ready(function($)
												{
													modal_image_domain_obj = $('.gallery-image-selector-modal').find(".modal_img_domain").selectBoxIt().on('open', function()
													{
														// Adding Custom Scrollbar
														$(this).data('selectBoxSelectBoxIt').list.perfectScrollbar();
													});	
													
													// 初始化
													var initVal = $(modal_image_domain_obj).find('option:first').attr('value');									
													$(modal_image_domain_obj).val(initVal).trigger('change');
													
													// 选项改变
													$(modal_image_domain_obj).change(function(){	
														if (modal_image_domain_obj != null && modal_image_district_obj != null) {
															getMenuItem(modal_image_domain_obj, modal_image_district_obj);
														}									
													});
													
												});
											</script>
											<select class="form-control modal_img_domain">
												<option value="-1">不限</option>
												<?php if(is_array($ImageDomains)): $i = 0; $__LIST__ = $ImageDomains;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$imgDomain): $mod = ($i % 2 );++$i;?><option value="<?php echo ($imgDomain["id"]); ?>"><?php echo ($imgDomain["item_desc"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
											</select>
										</div>
									</div>
								</div>
							</div>
							<br />
							
							<div class="row">					
								<div class="col-md-12">
									<div class="form-group">
										<p>辖区类型：</p><br />
										<div class="input-group col-sm-12" style="border-color: #40bbea; float:left; margin-right:3px;">
											<script type="text/javascript">
												jQuery(document).ready(function($)
												{
													modal_image_district_obj = $('.gallery-image-selector-modal').find(".modal_img_district").selectBoxIt().on('open', function()
													{
														// Adding Custom Scrollbar
														$(this).data('selectBoxSelectBoxIt').list.perfectScrollbar();
													});	
													var initVal = $(modal_image_district_obj).find('option:first').attr('value');									
													$(modal_image_district_obj).val(initVal).trigger('change');
												});
													
												// 选项改变
												$(modal_image_district_obj).change(function(){	
													if (modal_image_district_obj != null && modal_image_distination_obj != null) {
														getMenuItem(modal_image_district_obj, modal_image_distination_obj);
													}									
												});
											</script>
											<select class="form-control modal_img_district">
												<option value="-1">不限</option>
											</select>
										</div>
									</div>
								</div>
							</div>
							<br />
							
							<div class="row">					
								<div class="col-md-12">
									<div class="form-group">
										<p>目的地：</p><br />
										<div class="input-group col-sm-12" style="border-color: #40bbea; float:left; margin-right:3px;">
											<script type="text/javascript">
												jQuery(document).ready(function($)
												{
													var modal_image_distination_obj = $('.gallery-image-selector-modal').find(".modal_img_distination").selectBoxIt().on('open', function()
													{
														// Adding Custom Scrollbar
														$(this).data('selectBoxSelectBoxIt').list.perfectScrollbar();
													});	
													var initVal = $(modal_image_distination_obj).find('option:first').attr('value');									
													$(modal_image_distination_obj).val(initVal).trigger('change');
												});
											</script>
											<select class="form-control modal_img_distination">
												<option value="-1">不限</option>
											</select>
										</div>
									</div>
								</div>
							</div>
							<br />
							
							<div class="row">					
								<div class="col-md-12">
									<div class="form-group">
										<p>日期时间段：</p><br />
										<div class="input-group col-sm-12" style="border-color: #40bbea; float:left; margin-right:3px;">
											<div class="daterange daterange-inline add-ranges modal_img_datetime" data-time-picker="true" data-time-picker-increment="5" data-format="YYYY-MM-DD HH:mm:ss">
												<i class="fa-calendar"></i>
												<span></span>
											</div>
										</div>
									</div>
								</div>
							</div>
							<br />
							
							<div class="row">					
								<div class="col-md-12">
									<div class="form-group">
										<p id="filter_button" class="btn btn-block btn-icon btn-icon-standalone btn-icon-standalone-right">
											<i class="linecons-photo"></i>
											<span>筛选</span>
										</p>
									</div>
								</div>
							</div>
							
						</div> <!--End Left-->
									
					</section>
					
				</div>
				
				<div class="modal-footer">
					<button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
					<button type="button" class="btn btn-secondary">选择并使用</button>
				</div>
			</div>
		</div>
	</div>
	
	<script src="/source/Static/home/js/page.js"></script>
	<script type="text/javascript">
		// 页面切换回调函数
		var funcModalImageSelectorPageChanged = null;
		// 选择图片回调函数传入的对象
		var modalImageSelectorCallBackObj = null;
		// 选择图片回调函数
		var funcModalImageSelectorCallBack = null;
		$(document).ready(function(){
			// 绑定页面切换回调函数
			funcModalImageSelectorPageChanged = _modalImageSelectorAjaxImageList;
									
			// 查看当前点击的图片
			$('.modal_my_pic_border img').click(function(ev){								
//				showLookImageModal();
//				setModalLookImage($(this).find('img'));
				ev.preventDefault();
				var ckObj = $(this).parents('.album-image').find('.image-checkbox img');
				if ($(ckObj).hasClass('hidden_ctrl')) {
					$(ckObj).removeClass('hidden_ctrl');
				} else {
					$(ckObj).addClass('hidden_ctrl');
				}
			});
			
			
			// 筛选图片
			$('#filter_button').click(modalImageSelectorfilterImages);
			
			// 确认使用已选图片事件
			function modalImageSelectorSure(){
				if (typeof(funcModalImageSelectorCallBack) == 'function') {
					var idx = 0;
					var imageList = new Array();
					$(".image-checkbox img").each(function(i, el){
						if ($(el).parent().parent().parent().hasClass('hidden_ctrl') == false) {
							if ($(el).hasClass('hidden_ctrl') == false) {
								imageList[idx] = $(el).closest('.album-image').find('.modal_my_pic').attr('src');
								idx ++;
							}	
						}
					});	
					funcModalImageSelectorCallBack(modalImageSelectorCallBackObj, imageList);					
				}					
				
				// 显示模态对话框
				$("#gallery-image-selector-modal").modal('hide');
			};
			
			// 确认使用选择的图片
			$('#gallery-image-selector-modal').find('.btn-secondary').click(modalImageSelectorSure);
			
			// 选择并使用图片
			$('.modal_my_pic_border i').click(function(ev){
				ev.preventDefault();
				var ckObj = $(this).parents('.album-image').find('.image-checkbox img');
				if ($(ckObj).hasClass('hidden_ctrl')) {
					$(ckObj).removeClass('hidden_ctrl');
				}
				modalImageSelectorSure();
			});
		});
		
		// 显示图片选择
		function showModalSelectorImageDialog(obj) {
			modalImageSelectorCallBackObj = obj;
			// 初始图片列表
			_modalImageSelectorAjaxImageList(0, true);
			// 绑定显示回调函数
			funcGetImageUrl = modalSelectorLookImage;
			// 显示模态对话框
			$("#gallery-image-selector-modal").modal('show');
		}
		
		// 筛选图片
		function modalImageSelectorfilterImages(ev) {
			ev.preventDefault();
//			var pageIndex = parseInt($('.pagination').find('.active').attr('data-id'));
			
			var pageIndex = $('#gallery-image-selector-modal').find('.list-page').attr('data-page-index');
			_modalImageSelectorAjaxImageList(pageIndex, true);
		}
	
		// 获取当前点击图片的
		function modalSelectorLookImage(obj, imgIndex) {	
//			alert(obj + ',index:'+imgIndex);			
			var imageObj = obj;
			if (typeof(obj) != 'object') {
				if (parseInt(imgIndex) > 0) {
					imageObj = $('.album-image').eq(-1);
				} else {
					imageObj = $('.album-image').eq(0);
				}
			} else {
				if (parseInt(imgIndex) < 0) {
					var imgRoot = $(obj).closest('.album-image').parent().prev();
//					alert($(imgRoot).length);
					return $(imgRoot).length == 0 ? -1 : $(imgRoot).find('.modal_my_pic_border').find('img');
				} else if (parseInt(imgIndex) > 0) {			
					var imgRoot = $(obj).closest('.album-image').parent().next();
//					alert($(imgRoot).length);
					return $(imgRoot).length == 0 ? 1 : $(imgRoot).find('.modal_my_pic_border').find('img');
				} else {
					imgRoot = obj;
				}
			}
			return imageObj;
		}
		
		// 重新添加页码
		function modalImageSelectorInitPageNum(pageCount, pageIndex) {
			var rootObj = $('.pagination');
			// 清空页码
			$(rootObj).empty();			
			// 重新添加页码
			if (pageCount > 1) {
				var vhtml = '<li class="disabled" data-id="0"><a href="#"><i class="fa-angle-double-left"></i></a></li>';
					vhtml += '<li class="disabled" data-id="-1"><a href="#"><i class="fa-angle-left"></i></a></li>';
				var activeIndex = pageIndex >= 0 && pageIndex < pageCount ? pageIndex : 0;
				for (var i=0; i<pageCount; i++) {
					var showPageIndex = i+1;
					if (i == activeIndex) {
						vhtml += '<li class="active" data-id="'+i+'"><a href="#">'+showPageIndex+'</a></li>';
					} else {
						vhtml += '<li data-id="'+i+'"><a href="#">'+showPageIndex+'</a></li>';
					}
				}
				vhtml += '<li data-id="+1"><a href="#"><i class="fa-angle-right"></i></a></li>';
				vhtml += '<li data-id="'+parseInt(pageCount-1)+'"><a href="#"><i class="fa-angle-double-right"></i></a></li>';				
				$(rootObj).append(vhtml);
				
				// 绑定翻页事件
				$(rootObj).find('li').click(function(){
					if ($(this).hasClass('disabled') == false && $(this).hasClass('active') == false) {
						var tempPageIndex = 0;
						var dataId = $(this).attr('data-id');
						if (dataId == '-1') {
							var page = $(this).parent().find('.active').attr('data-id');
							tempPageIndex = parseInt(page)-1;
						} else if (dataId == '+1') {
							var page = $(this).parent().find('.active').attr('data-id');
							tempPageIndex = parseInt(page)+1;
						} else {
							tempPageIndex = parseInt(dataId);
						}
						
						if (typeof(funcModalImageSelectorPageChanged) == 'function'){
							funcModalImageSelectorPageChanged(tempPageIndex);	
						}
					}
				});
			}			
		}
		
		// 刷新页码样式
		function modalImageSelectorRefreshPageStyle(pageIndex, pageCount) {
			var pageObj = $('#gallery-image-selector-modal').find('.list-page');
			constructionPage(pageObj, pageIndex, pageCount, _modalImageSelectorAjaxImageList,false);
			return false;
			
			if (pageIndex == 0) {
				$('.pagination').find('li').eq(0).addClass('disabled');
				$('.pagination').find('li').eq(1).addClass('disabled');
				$('.pagination').find('li').eq(-1).removeClass('disabled');
				$('.pagination').find('li').eq(-2).removeClass('disabled');
			} else if (pageIndex == (pageCount - 1)){		
				$('.pagination').find('li').eq(0).removeClass('disabled');
				$('.pagination').find('li').eq(1).removeClass('disabled');
				$('.pagination').find('li').eq(-1).addClass('disabled');
				$('.pagination').find('li').eq(-2).addClass('disabled');
			} else {
				$('.pagination').find('li').eq(0).removeClass('disabled');
				$('.pagination').find('li').eq(1).removeClass('disabled');
				$('.pagination').find('li').eq(-1).removeClass('disabled');
				$('.pagination').find('li').eq(-2).removeClass('disabled');
			}
			
			$('.pagination').find('li').removeClass('active');
			$('.pagination').find('li').eq(pageIndex+2).addClass('active');	
		}
				
		// 请求图片列表
		function _modalImageSelectorAjaxImageList(pageIndex, bInitPage){
			var rootObj = $('#gallery-image-selector-modal');
			var jsonData = {
				page_index: pageIndex,
				title: $(rootObj).find('.modal_img_title').val(),
				author: $(rootObj).find('.modal_img_author').val(),
				type_id: $(rootObj).find('.modal_img_type').val(),
				from_type_id: $(rootObj).find('.modal_img_from').val(),
				content_type_id: $(rootObj).find('.modal_img_content').val(),
				domain_type_id: $(rootObj).find('.modal_img_domain').val(),
				district_type_id: $(rootObj).find('.modal_img_district').val(),
				distination_type_id: $(rootObj).find('.modal_img_distination').val(),
				data_time_range: $(rootObj).find('.modal_img_datetime').find('span').html(),
			}
			
//			console.log(JSON.stringify(jsonData));
			showLoading(true);
			$.post('<?php echo U("image/list");?>', jsonData, function(data){
				showLoading(false);
				if (data.result.errno == 0) {
					// 清空图片容器				
					var containerObj = $('.album-images');
					$(containerObj).empty();
					// 填充新图片
					if (data.ds != null && data.ds != 'undefined') {
						for (var i = 0; i < data.ds.length; i++) {
							var iData = data.ds[i];
							var rootObj = $('.template_ablum').clone(true);
							$(rootObj).removeClass('template_ablum');
							$(rootObj).removeClass('hidden_ctrl');
							
							$(rootObj).find('.album-image').attr('data-id', iData.id);
							$(rootObj).find('.modal_my_pic').attr('src', iData.path);
							
							var infoObj = $(rootObj).find('.name');
							$(infoObj).find('span').html(iData.title);
							$(infoObj).find('p').html(iData.create_time);
							$(containerObj).append(rootObj);						
						}
					}
					
					var pageObj = $('#gallery-image-selector-modal').find('.list-page');
					// 刷新页码
					if (typeof(bInitPage) != 'undefined') {
						constructionPage(pageObj, pageIndex, data.page_count, _modalImageSelectorAjaxImageList,true);
//						modalImageSelectorInitPageNum(data.page_count, pageIndex);
					} else {
						modalImageSelectorRefreshPageStyle(pageIndex, data.page_count);
					}								
				} else {
					toastr.error(data.result.message);
				}
			});
		}
		
		// 调用上传界面
		$('.modal_select_image_upload').click(function(ev){
			ev.preventDefault();
			
			// 关闭图片选择对话框
			$("#gallery-image-selector-modal").modal('hide');
			
			funcModalUploadCallBack = funcModalImageSelectorCallBack;
			showModalUploadImageDialog(modalImageSelectorCallBackObj);
		});
				
	</script><?php endif; ?>
<?php if(!empty($modal_crop_image)): ?>这是图片裁剪页面<?php endif; ?>
<?php if(!empty($modal_look_image)): ?><!--Modal-->
	<div id="modal_look_image"  class="modal fade custom-width">
		<div class="modal-dialog" style="width: 80%">
			<div class="modal-content">
				
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h3 id="modal_select_image_title" class="modal-title">图片浏览</h3>
				</div>
				
				<div class="modal-body">
					<div class="row div_container">
						<div class="div_image_show">
							<img class="image_show_block" src="" />
						</div>
						<div class="div_perview_button"></div>
						<div class="div_next_button"></div>
					</div>					
				</div>			
				<div class="modal-footer">
					<p class="modal_look_image_msg" style="color: red;"></p>
					<button type="button" class="btn btn-info" data-dismiss="modal">关闭窗口</button>
				</div>	
			</div>
		</div>
	</div>
	<style type="text/css">
		.div_container {
			width: 900px;
			height: 600px;
		}
		.div_perview_button{
			position: absolute;
			left: 0px;
			width: 50%;
			height: 95%;
		}
		.div_next_button{
			position: absolute;
			right: 0px;
			width: 50%;
			height: 95%;
		}
		.div_image_show {
			position: absolute;
			left: 0px;
			right: 0px;
			width: 100%;
			height: 95%;
		}
		.image_show_block {
			clear: both;
			display: block;
			margin: auto;			
			max-width: 100%;
			max-height: 100%;
			vertical-align: middle;
		}
		.select_border {
			border-style: dotted;
			border-width: 1px;		
			border-color: #f00;	 
		}
		.select_border1 {
			border-style: dotted;
			border-width: 1px;		
			border-color: #00f;	 
		}
	</style>
	<script type="text/javascript">
		var modalLookImageUrlList;
		var modalLookCurIndex=0;
		
		var funcGetImageUrl = null;
		var modalLookCurImageObj = null;
		
		$(document).ready(function(){
			// 初始化窗口
			_initLookImageModal();
		});
		
		// 重置选择图片Modal
		function resetLookImageModal() {	
		}
		
		// 鼠标进入
		function _modalLookImageChange(obj, addCount, selected) {
			if (selected === true) {	
				if (!$(obj).hasClass("select_border")) {
					$(obj).addClass("select_border");
				}	
			} else {	
				if ($(obj).hasClass("select_border")) {
					$(obj).removeClass("select_border");	
				}
			}
			
			modalLookCurImageObj = funcGetImageUrl(modalLookCurImageObj, addCount);			
			if (typeof(modalLookCurImageObj) != 'object') {
				if (parseInt(modalLookCurImageObj) < 0) {
					$('.modal_look_image_msg').show();
					$('.modal_look_image_msg').html('前面没有更多图片可供浏览了');
					$('.modal_look_image_msg').fadeOut(5000);					
				} else if (parseInt(modalLookCurImageObj) > 0) {
					$('.modal_look_image_msg').show();
					$('.modal_look_image_msg').html('已经是最后一张图片了');
					$('.modal_look_image_msg').fadeOut(5000);
				} else {
					alert('错误浏览对象!!!!');
				}
				return false;
			}
			
			var imageUrl = $(modalLookCurImageObj).prop('src');
			$('.image_show_block').prop('src', imageUrl);
			
//			if (modalLookImageUrlList == 'undefined') {
//				return;
//			}
//			if (addCount == 0) {
//				return;
//			}
//			modalLookCurIndex += addCount;
//			var len = modalLookImageUrlList.length;	
//			if (modalLookCurIndex < 0) {
//				modalLookCurIndex = len-1;
//			}
//			if (modalLookCurIndex >= len) {
//				modalLookCurIndex = 0;
//			}
//			_refreshModalLookImage();
		}
		
		// 初始化
		function _initLookImageModal() {
			// 窗口显示
			$('#modal_look_image').on('show.bs.modal', function () {
			});
			
			// 窗口关闭
			$('#modal_look_image').on('hide.bs.modal', function () {
				resetLookImageModal();
			});
			
			// 鼠标进入
			$('.div_perview_button').mouseenter(function(){_modalLookImageChange(this, 0, true)});
			$('.div_next_button').mouseenter(function(){_modalLookImageChange(this, 0, true)});
			// 鼠标离开
			$('.div_perview_button').mouseleave(function(){_modalLookImageChange(this, 0, false)});
			$('.div_next_button').mouseleave(function(){_modalLookImageChange(this, 0, false)});
			// 鼠标点击			
			$('.div_perview_button').click(function(){_modalLookImageChange(this, -1, true)});
			$('.div_next_button').click(function(){_modalLookImageChange(this, 1, true)});
		}
		
		// 刷新当前图片
		function _refreshModalLookImage() {
			if (modalLookImageUrlList.length == 0) {
				alert('图片列表中没有可供浏览的图片');
				return;
			}
			
			if (modalLookCurIndex < 0 || modalLookCurIndex >= modalLookImageUrlList.length) {
				alert('浏览图片的索引错误');
				return;
			}
			
			$('.image_show_block').prop('src', modalLookImageUrlList[modalLookCurIndex]);
		}
		
		// 设置浏览的图片列表
		function setModalLookImageList(imageList, curIndex) {
			modalLookImageUrlList = imageList;
			modalLookCurIndex = curIndex;
			_refreshModalLookImage();
		}
		
		// 设置当前图片对象
		function setModalLookImage(imageObj) {
			modalLookCurImageObj = imageObj;
			if ($(imageObj).get(0).tagName == 'img') {
				$('.image_show_block').prop('src', $(imageObj).prop('src'));
			}
		}
		
		// 显示窗口
		function showLookImageModal() {
			$("#modal_look_image").modal('show', {backdrop: 'static'});
		}
		
		// 隐藏窗口
		function hideLookImageModal() {
			resetLookImageModal();
			$("#modal_look_image").modal('hide');
		}
		
	</script><?php endif; ?>
<?php if(!empty($modal_delete_image)): ?><!-- 删除图片确认 -->
	<div class="modal fade" id="gallery-image-delete-modal" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content">
				
				<div class="modal-header">
					<h4 class="modal-title">图片删除确认</h4>
				</div>
				
				<div class="modal-body">
				
					您确定要删除这些图片吗?
					
				</div>
				
				<div class="modal-footer">
					<button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
					<button type="button" class="btn btn-danger">删除</button>
				</div>
			</div>
		</div>
	</div>
	
	<script type="text/javascript">
		var funcModalDeleteImageCallBack = null;			
		// 删除图片
		$('#gallery-image-delete-modal').find('.btn-danger').click(function(){
			if (typeof(funcModalDeleteImageCallBack) == 'function') {
				funcModalDeleteImageCallBack();
			}
			$('#gallery-image-delete-modal').modal('hide');
		});
		
		// 显示删除界面
		function showModalDeleteImageDialog() {
			$("#gallery-image-delete-modal").modal('show');
		}
	</script><?php endif; ?>
<?php if(!empty($modal_edit_image)): ?><!-- Gallery Modal Image -->
	<div class="modal fade" id="gallery-image-edit-modal">
		<div class="modal-dialog">
			<div class="modal-content">
				
				<div class="modal-gallery-image">
					<img src="" class="img-responsive" />
				</div>
				
				<div class="modal-body">
									
					<div class="row">
						<div class="col-md-12">							
							<div class="form-group">
								<label for="modal_img_title" class="control-label">图片标题：</label>
								<input id="modal_img_title" type="text" class="form-control" style="border-color: #4EC83B;" placeholder="图片标题不能为空">
							</div>						
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-12">							
							<div class="form-group">
								<label for="modal_img_author" class="control-label">图片作者：</label>
								<input id="modal_img_author" type="text" class="form-control" style="border-color: #4EC83B;">
							</div>							
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-12">							
							<div class="form-group">
								<label for="modal_img_tags" class="control-label">图片标签：</label>
								<input id="modal_img_tags" type="text" class="form-control" style="border-color: #4EC83B;" placeholder="多个标签之间用逗号分隔开">
							</div>							
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-12">							
							<div class="form-group">
								<label for="modal_img_intro" class="control-label">图片描述：</label>
								<textarea id="modal_img_intro" class="form-control autogrow" style="border-color: #4EC83B;" placeholder="请输出图片描述" style="min-height: 80px;"></textarea>
							</div>							
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-12">							
							<div class="form-group">
								<label for="modal_img_type" class="control-label">图片类型：</label>
								<script type="text/javascript">
									jQuery(document).ready(function($)
									{
										var image_type_obj = $("#modal_img_type").selectBoxIt().on('open', function()
										{
											// Adding Custom Scrollbar
											$(this).data('selectBoxSelectBoxIt').list.perfectScrollbar();
										});	
										// 默认选择第一个
										var initVal = $(image_type_obj).find('option:first').attr('value');									
										$(image_type_obj).val(initVal).trigger('change');
									});
								</script>
								<select id="modal_img_type" class="form-control">
									<option value="-1">不限</option>
									<?php if(is_array($ImageTypes)): $i = 0; $__LIST__ = $ImageTypes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$imgType): $mod = ($i % 2 );++$i;?><option value="<?php echo ($imgType["id"]); ?>"><?php echo ($imgType["type_desc"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
								</select>
							</div>							
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-12">							
							<div class="form-group">
								<label for="modal_img_from" class="control-label">图片来源：</label>
								<script type="text/javascript">
									jQuery(document).ready(function($)
									{
										var image_from_obj = $("#modal_img_from").selectBoxIt().on('open', function()
										{
											// Adding Custom Scrollbar
											$(this).data('selectBoxSelectBoxIt').list.perfectScrollbar();
										});	
										var initVal = $(image_from_obj).find('option:first').attr('value');									
										$(image_from_obj).val(initVal).trigger('change');
									});
								</script>
								<select id="modal_img_from" class="form-control">
									<option value="-1">不限</option>
									<?php if(is_array($ImageFroms)): $i = 0; $__LIST__ = $ImageFroms;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$imgFrom): $mod = ($i % 2 );++$i;?><option value="<?php echo ($imgFrom["id"]); ?>"><?php echo ($imgFrom["type_desc"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
								</select>
							</div>								
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-12">							
							<div class="form-group">
								<label for="modal_img_content" class="control-label">内容类型：</label>
								<script type="text/javascript">
									jQuery(document).ready(function($)
									{
										var image_content_obj = $("#modal_img_content").selectBoxIt().on('open', function()
										{
											// Adding Custom Scrollbar
											$(this).data('selectBoxSelectBoxIt').list.perfectScrollbar();
										});	
										var initVal = $(image_content_obj).find('option:first').attr('value');									
										$(image_content_obj).val(initVal).trigger('change');
									});
								</script>
								<select id="modal_img_content" class="form-control">
									<option value="-1">不限</option>
									<?php if(is_array($ImageContents)): $i = 0; $__LIST__ = $ImageContents;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$imgContent): $mod = ($i % 2 );++$i;?><option value="<?php echo ($imgContent["id"]); ?>"><?php echo ($imgContent["type_desc"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
								</select>
							</div>								
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-12">							
							<div class="form-group">
								<label for="modal_img_domain" class="control-label">地域类型：</label>
								<script type="text/javascript">
									function getMenuItem(parentObj, childObj) {
										if ($(parentObj).val() == null) {
											return false;
										}
										
										var jsonData = {
											op_type: 'find',
											data_type: 'all',
											parent_id: $(parentObj).val(),
										};
																	
										$.post('<?php echo U("menu/list");?>', jsonData, function(backData){
											if (backData.result.errno == 0) {
												$(childObj).data('selectBox-selectBoxIt').remove();
												if (backData.data != null) {
													for (var k=0; k < backData.data.length; k++) {		
														var d = backData.data[k];													
														$(childObj).data('selectBox-selectBoxIt').add({value:d['id'], text:d['item_desc']});
													}	
												}
											}
										});
									}
									
									var modal_image_domain_obj=null, modal_image_district_obj=null, modal_image_distination_obj=null;	
									jQuery(document).ready(function($)
									{
										modal_image_domain_obj = $("#modal_img_domain").selectBoxIt().on('open', function()
										{
											// Adding Custom Scrollbar
											$(this).data('selectBoxSelectBoxIt').list.perfectScrollbar();
										});	
										
										// 初始化
										var initVal = $(modal_image_domain_obj).find('option:first').attr('value');									
										$(modal_image_domain_obj).val(initVal).trigger('change');
										
										// 选项改变
										$(modal_image_domain_obj).change(function(){
											if (modal_image_domain_obj != null && modal_image_district_obj != null) {
												getMenuItem(modal_image_domain_obj, modal_image_district_obj);
												if ($.isEmptyObject(modal_image_data) == false) {
													$(modal_image_district_obj).val(modal_image_data.district_type_id).trigger('change');
												}
											}									
										});
										
									});
								</script>
								<select id="modal_img_domain" class="form-control">
									<option value="-1">不限</option>
									<?php if(is_array($ImageDomains)): $i = 0; $__LIST__ = $ImageDomains;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$imgDomain): $mod = ($i % 2 );++$i;?><option value="<?php echo ($imgDomain["id"]); ?>"><?php echo ($imgDomain["item_desc"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
								</select>
							</div>								
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-12">
							
							<div class="form-group">
								<label for="modal_img_district" class="control-label">辖区类型：</label>
								<script type="text/javascript">
									jQuery(document).ready(function($)
									{
										modal_image_district_obj = $("#modal_img_district").selectBoxIt().on('open', function()
										{
											// Adding Custom Scrollbar
											$(this).data('selectBoxSelectBoxIt').list.perfectScrollbar();
										});	
										var initVal = $(modal_image_district_obj).find('option:first').attr('value');									
										$(modal_image_district_obj).val(initVal).trigger('change');
									});
										
									// 选项改变
									$(modal_image_district_obj).change(function(){	
										if (modal_image_district_obj != null && modal_image_distination_obj != null) {
											getMenuItem(modal_image_district_obj, modal_image_distination_obj);
											if ($.isEmptyObject(modal_image_data) == false) {
												$(modal_image_distination_obj).val(modal_image_data.distination_type_id).trigger('change');	
											}
										}									
									});
								</script>
								<select id="modal_img_district" class="form-control">
									<option value="-1">不限</option>
								</select>
							</div>	
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-12">							
							<div class="form-group">
								<label for="modal_img_distination" class="control-label">目的地：</label>
								<script type="text/javascript">
									jQuery(document).ready(function($)
									{
										var modal_image_distination_obj = $("#modal_img_distination").selectBoxIt().on('open', function()
										{
											// Adding Custom Scrollbar
											$(this).data('selectBoxSelectBoxIt').list.perfectScrollbar();
										});	
									});
								</script>
								<select id="modal_img_distination" class="form-control">
									<option value="-1">不限</option>
								</select>
							</div>	
						</div>
					</div>
					
					
				</div>
				
				<div class="modal-footer modal-gallery-top-controls">
					<button type="button" class="btn btn-xs btn-white" data-dismiss="modal">关闭</button>
					<button type="button" class="btn btn-xs btn-info">图片裁减</button>
					<button type="button" class="btn btn-xs btn-secondary">保存</button>
				</div>
			</div>
		</div>
	</div>
	
	<script type="text/javascript">
		var modal_image_ids = '';
		var modal_image_data = '';
		var funcModalImageEditCallBack = null;
	
		// 查询图片信息
		function _getImageInfo(pid) {
			var rs = false;
			$.ajaxSetup('async', true);
			console.log(rs);
			return rs;
		}
	
		// 显示编辑窗口
		function showModalImageEdit(ids) {
			if (ids == '') {
				return false;
			}
			
			var firstId = 0;
			var split_index = ids.indexOf(',');
			if (split_index == -1) {
				firstId = parseInt(ids);
			} else {
				firstId = parseInt(ids.substr(0, split_index));
			}
			
			$.post('<?php echo U("image/find");?>', {id: firstId}, function(data){
				if (data.result.errno == 0) {
					modal_image_data = data.ds;
					var iData = modal_image_data;
					var rootObj = $('#gallery-image-edit-modal');
					$(rootObj).find('.modal-gallery-image img').attr('src', iData.path);
					$(rootObj).find('#modal_img_title').val(iData.title);
					$(rootObj).find('#modal_img_author').val(iData.author);
					$(rootObj).find('#modal_img_tags').val(iData.tags);
					$(rootObj).find('#modal_img_intro').val(iData.intro);
					$(rootObj).find('#modal_img_type').val(iData.type_id).trigger('change');
					$(rootObj).find('#modal_img_from').val(iData.from_type_id).trigger('change');
					$(rootObj).find('#modal_img_content').val(iData.content_type_id).trigger('change');
					$(modal_image_domain_obj).val(iData.domain_type_id).trigger('change');
//					$(rootObj).find('#modal_img_domain').val(iData.domain_type_id).trigger('change');
//					$(rootObj).find('#modal_img_district').val(iData.district_type_id).trigger('change');
//					$(rootObj).find('#modal_img_distination').val(iData.distination_type_id).trigger('change');
					$(rootObj).modal('show');
				} else {
					alert(data.result.message);					
				}
			});
		}
		
		// 保存编辑的图片
		$('#gallery-image-edit-modal').find('.btn-secondary').click(function(){
			if (typeof(funcModalImageEditCallBack) == 'function' && typeof(modal_image_data) == 'object') {
				var rootObj = $('#gallery-image-edit-modal');
				var temp = {
					'title': $(rootObj).find('#modal_img_title').val(),
					'author': $(rootObj).find('#modal_img_author').val(),
					'intro': $(rootObj).find('#modal_img_intro').val(),
					'type_id': $(rootObj).find('#modal_img_type').val(),
					'from_type_id': $(rootObj).find('#modal_img_from').val(),
					'content_type_id': $(rootObj).find('#modal_img_content').val(),
					'tags': $(rootObj).find('#modal_img_tags').val(),
					'domain_type_id': $(rootObj).find('#modal_img_domain').val(),
					'district_type_id': $(rootObj).find('#modal_img_district').val(),
					'distination_type_id': $(rootObj).find('#modal_img_distination').val(),
				};
				
				var ds = new Object();
				if (temp.title != modal_image_data.title) {
					ds['title'] = temp.title;
				}
				if (temp.author != modal_image_data.author) {
					ds['author'] = temp.author;
				}
//				if (temp.type_id != modal_image_data.type_id) {
//					ds['type_id'] = temp.type_id;
//				}
				if (temp.from_type_id != modal_image_data.from_type_id) {
					ds['from_type_id'] = temp.from_type_id;
				}
				if (temp.content_type_id != modal_image_data.content_type_id) {
					ds['content_type_id'] = temp.content_type_id;
				}
				if (temp.tags != modal_image_data.tags) {
					ds['tags'] = temp.tags;
				}
				if (temp.domain_type_id != modal_image_data.domain_type_id) {
					ds['domain_type_id'] = temp.domain_type_id;
				}
				if (temp.district_type_id != modal_image_data.district_type_id) {
					ds['district_type_id'] = temp.district_type_id;
				}
				if (temp.distination_type_id != modal_image_data.distination_type_id) {
					ds['distination_type_id'] = temp.distination_type_id;
				}
				
				if ($.isEmptyObject(ds) == false) {
					funcModalImageEditCallBack(modal_image_ids, ds);	
				} else {
					alert('数据未改变,请修改后再次保存');
				}
				modal_image_ids = null;
				$(rootObj).modal('hide');
			}
		});
		
	</script><?php endif; ?>
<?php if(!empty($modal_admin_question)): endif; ?> 
<?php if(!empty($modal_line_article)): ?><!-- css Reset -->
<link rel="stylesheet" href="/source/Static/home/common/css/cssreset.css">
<link rel="stylesheet" href="/source/Static/home/css/farticle_list.css"/>
<style>
	.article-information-img {
	    position: relative;
	    width: 1000px !important;
	    height: 210px;
	    margin: 0 auto;
	    margin-bottom: 33px;
	    background-color: #fff;
	    overflow: visible !important;
	}
	.article-information-word {
		width: 1000px !important;	
	}
	.article-information-img a , .article-information-word a { position: absolute; top:0; left:0; width: 100%; height: 100%; }
</style>

<div class="modal fade custom-width" id="modalArticleSelect">
	<div class="modal-dialog" style="width: 80%;">
		<div class="modal-content">
			
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h2 class="modal-title">文章选择</h2>
			</div>
			
			<div class="modal-body">
				<div class="modal-search">
					<input id="article_cnt" type="text" placeholder="输入您想要的文章标题"><a class="modal_farticle_search" href="javascript:;">搜索</a>
				</div>
				<div class="modal-list">
				</div>
				<!-- 翻页 -->
				<div class="modal-page" data-page-count="1" data-page-index="1"></div>
			</div>
			
			<div class="modal-footer">
				<button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
			</div>
		</div>
	</div>
</div>

<script src="/source/Static/home/js/page.js"></script>
<script>
		//打开modal
		var funcModalArticleCallBack = null;
		var modalArticleFireObject = null;
		function showModalArticleSelect(obj, func) {
			modalArticleFireObject = obj;
			funcModalArticleCallBack = func;		
			// 清空所有选项
			modalArticleSelectClear();	
			$("#modalArticleSelect").modal('show', {backdrop: 'static'});	
		}
		
		// 切换选择
		function modalArticleSelectChangeChecked (){
			$(this).toggleClass('article-choosed');
		}
		
		// 清空选中
		function modalArticleSelectClear (){
			$("#modalArticleSelect").find('.article-choosed').removeClass('article-choosed');
		}
		
		//切换选中
		$('#modalArticleSelect').find('.article-choose').click(function(){
			$(this).toggleClass('article-choosed');
		})
		
		$('#modalArticleSelect').find('.modal_farticle_search').click(function(){
			changeModalArticleSelectPage($('.modal-page').attr('data-page-index'));
		});

		// 初始化翻页
		constructionPage('.modal-page', 1, 1, changeModalArticleSelectPage, true);
	    
	    // 切换页码
	    function changeModalArticleSelectPage(p) {
	    	var cdsstr = 'cnt|' + $('#article_cnt').val();
	    	var jsonData = {
	    		op_type: 'list',
	    		cds: cdsstr,
	    		page: p - 1 ,
	    	}
	    	$.post('<?php echo U("line/article");?>', jsonData, function(data){	    		
				if (typeof(data.ds) != 'undefined' && data.ds != null) {
					$('.modal-list').empty();
					for (var i=0; i<data.ds.length; i++) {
						var d = data.ds[i];
						var include_image = typeof(d.face_image)=='undefined' ? false : true;
						var vhtml = '<div class="article-information-img">';
						if (include_image == false) {
							vhtml = '<div class="article-information-word">'
						}
						
						vhtml +='<div class="article-choose-content">'+
								'	<i class="article-choose" data-id="'+d.id+'">选中</i>'+
								'	<i class="article-choose-use">选中并使用</i>'+
								'</div>';
						if (include_image == true) {
							vhtml +='	<div class="article-information-img-left">'+
									'		<img src="'+d.face_image+'" alt="">'+
									'	</div>';
						}
						if (include_image == false) {
							vhtml +='	<div class="article-information-word-div">';
						} else {
							vhtml +='	<div class="article-information-img-right">';
						}
						vhtml +='		<h3>'+ d.title +'</h3>'+
								'		<p>'+d.send_word+'</p>'+
								'		<h6>'+d.create_time+'</h6>'+
								'		<a href="'+'<?php echo U("line/article");?>/type/show/id/'+d.id+'" target="_blank"></a>'+
								'	</div>'+
								'</div>';
						$('#modalArticleSelect').find('.modal-list').append(vhtml);
						$('#modalArticleSelect').find('.article-choose-use:last').click(modalArticleSelectComfirm);
						$('#modalArticleSelect').find('.article-choose:last').click(modalArticleSelectChangeChecked);
					}
					
					// 根据情况判断是否重构分页
					constructionPage('.modal-page', p, data.page_count, changeModalArticleSelectPage);
				} 
	    	});
	    }
	    
	    $(document).ready(function(){
	    	changeModalArticleSelectPage(1);
	    });
	    
	    function modalArticleSelectComfirm() {
	    	if ($(this).prev().hasClass('article-choosed') == false) {
	    		$(this).prev().addClass('article-choosed');
	    	}
	    	
	    	var selIds = [];	    	
	    	$('#modalArticleSelect').find('.article-choosed').each(function(i,ev){
	    		selIds.push($(this).attr('data-id'));
	    	});
	    	
			$("#modalArticleSelect").modal('hide');	
	    	funcModalArticleCallBack(modalArticleFireObject, selIds);
	    }
</script><?php endif; ?> 
<?php if(!empty($modal_line_list)): ?><link rel="stylesheet" href="/source/Static/home/common/css/cssreset.css" />

<link rel="stylesheet" href="/source/Static/home/css/fline_list.css"/>

<div class="modal fade custom-width" id="modalLineSelect">
	<div class="modal-dialog" style="width: 90%;">
		<div class="modal-content">
			
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h2 class="modal-title">线路选择</h2>
			</div>
			
			<div class="modal-body">
				<div class="modal-search">
					<input id="line_title" type="text" placeholder="输入您想要的线路标题"><a class="modal_fline_search" href="javascript:;">搜索</a>
				</div>
				<div class="modal-list">
				</div>
				<!-- 翻页 -->
				<div class="modal-page"></div>
			</div>
			
			<div class="modal-footer">
				<button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
			</div>
		</div>
	</div>
</div>

<script src="/source/Static/home/js/page.js"></script>
<script>
	//打开modal
	var funcModalLineCallBack = null;
	var modalLineFireObject = null;
	var modalLineFindConds = null;
	function showModalLineSelect(obj, func, cds, send) {
		modalLineFireObject = obj;
		funcModalLineCallBack = func;
		modalLineFindConds = cds;
		if (send != null && send != 'undefined'){
			changeModalLineSelectPage(1);
		}		
		modalLineSelectClearChecked();
		$("#modalLineSelect").modal('show', {backdrop: 'static'});	
	}
	
	// 清除所有选择
	function modalLineSelectClearChecked () {
		$("#modalLineSelect").find('.article-choosed').removeClass('article-choosed');
	}
	
	// 切换选择
	function modalLineSelectChangeChecked (){
		$(this).toggleClass('article-choosed');
	}
	
	//切换选中
	$("#modalLineSelect").find('.article-choose').click(function(){
		$(this).toggleClass('article-choosed');
	});
	
	$("#modalLineSelect").find('.modal_fline_search').click(function(){
		changeModalLineSelectPage($('.modal-page').attr('data-page-index'));
	});

	// 初始化翻页
	constructionPage($('#modalLineSelect').find('.modal-page'), 1, 1, changeModalLineSelectPage, true);
    
    // 切换页码
    function changeModalLineSelectPage(p) {
    	var conds = modalLineFindConds;
    	var title = $('#line_title').val();
    	if (title != '') {
    		conds == null || conds == '' ? conds = 'title|'+title : conds += '|title|'+title;
    	}
    	var jsonData = {
    		op_type: 'list',
    		page: p - 1 ,
    	}
    	
    	    	
    	if (conds != null) {
    		conds += '|online|1|invalid|0'
    	}
    	jsonData['cds'] = conds;
    	
    	$.post('<?php echo U("line/list");?>', jsonData, function(data){	
			$("#modalLineSelect").find('.modal-list').empty();
			if (typeof(data.ds) != 'undefined' && data.ds != null) {
//				console.log('===================================================');
				for (var i=0; i<$(data.ds).length; i++) { 
					var d = data.ds[i];   	
					var assemblyPoint = '';
					if (d.assembly_point != null && d.assembly_point != '') {
						var apData = $.parseJSON(d.assembly_point);
						for (var ap = 0; ap < apData.length; ap ++) {
							assemblyPoint += apData[ap].type_desc + ' ';
						}
					}
					var destination = '';
					if (d.destination != null && d.destination != '') {
						var apData = $.parseJSON(d.destination);
						for (var ap = 0; ap < apData.length; ap ++) {
							destination += apData[ap].type_desc + ' ';
						}
					}   	
					var batchCount = d.batchs = null ? 0 : $(d.batchs).length;
					var img_src = d.img1 == null ? '' : d.img1;
//    				console.log(d.id + ':' + d.title+',assembly:'+assemblyPoint+',dest:'+destination+',batch_count:'+batchCount+',img:'+img_src);    				
					
					var vhtml = '<div class="single-row">'+
								'	<div class="single-row-content">'+
								'		<div class="article-choose-content">'+
								'			<i class="article-choose" data-id="'+d.id+'">选中</i>'+
								'			<i class="article-choose-use">选中并使用</i>'+
								'		</div>'+
								'		<div class="single-row-img">'+
								'			<a href="'+'<?php echo U("line/preview");?>/id/'+d.id+'" target="_blank">'+
								'				<img src="'+img_src+'" alt="">'+
								'			</a>'+
								'		</div>'+
								'		<div class="single-row-describe">'+
								'			<div class="single-row-describe-top">'+
								'				<h4><a href="'+'<?php echo U("line/preview");?>/id/'+d.id+'" target="_blank">'+d.title+'</a></h4>'+
								'				<h5><a href="'+'<?php echo U("line/preview");?>/id/'+d.id+'" target="_blank">'+d.subheading+'</a></h5>'+
								'				<span><a href="'+'<?php echo U("line/preview");?>/id/'+d.id+'" target="_blank">'+d.send_word_show+'</a></span>'+
								'				<p><u>集合地点：'+assemblyPoint+'</u><u>批次：全年'+batchCount+'期</u></p>'+
								'				<p>目的地：'+destination+'</p>'+
								'				'+
								'			</div>'+
								'			<div class="single-row-describe-bottom">'+
								'				<span>旅行时间： '+d.start_time+'至'+d.end_time+'</span>'+
								'			</div>'+
								'		</div>'+
								'	</div>'+
								'</div>';
					$("#modalLineSelect").find('.modal-list').append(vhtml);
					$("#modalLineSelect").find('.article-choose-use:last').click(modalLineSelectComfirm);
					$("#modalLineSelect").find('.article-choose:last').click(modalLineSelectChangeChecked);
				}
				
				// 根据情况判断是否重构分页
				constructionPage($('#modalLineSelect').find('.modal-page'), p, data.page_count, changeModalLineSelectPage);
			} 
    	});
    }
    
    $(document).ready(function(){
    	changeModalLineSelectPage(1);
    });
    
    function modalLineSelectComfirm() {
    	if ($(this).prev().hasClass('article-choosed') == false) {
    		$(this).prev().addClass('article-choosed');
    	}
    	
    	var selIds = [];	    	
    	$("#modalLineSelect").find('.article-choosed').each(function(i,ev){
    		selIds.push($(this).attr('data-id'));
    	});
    	
		$("#modalLineSelect").modal('hide');
    	funcModalLineCallBack(modalLineFireObject, selIds);
    }	    
</script><?php endif; ?>
<?php if(!empty($modal_video_list)): ?><!-- css Reset -->
<link rel="stylesheet" href="/source/Static/home/common/css/cssreset.css">
<link rel="stylesheet" href="/source/Static/home/css/farticle_list.css"/>
<style>
	.article-information-img {
	    position: relative;
	    width: 1000px !important;
	    height: 210px;
	    margin: 0 auto;
	    margin-bottom: 33px;
	    background-color: #fff;
	    overflow: visible !important;
	}
	.article-information-word {
		width: 1000px !important;	
	}
	.article-information-img a , .article-information-word a { position: absolute; top:0; left:0; width: 100%; height: 100%; }
	
	.video-modal-list { width: 1200px; margin: 0 auto; padding-top: 22px; overflow: hidden; }
	.video-modal-product-content-describe { position: relative; padding: 16px 10px; background: #fff; border: 1px solid #e5e5e5; border-top: none; }
	.video-modal-product-content-describe h5 { padding-bottom: 9px; }
	.video-modal-product-content-describe a:hover { color: #f90; }
	.video-modal-product-content-describe { text-align: center; }
	.video-modal-product-content-describe h5 { font-size: 14px; }
	.video-modal-product-content-describe p { color: #999; }	
	.video-modal-product-content { position: relative; float: left; width:285px; height: 270px; margin: 10px 7px; overflow: hidden; }
	.video-modal-product-content .video_more { height: 270px; }
	.video-modal-product-content > a { position: relative; display: inline-block; width: 285px; height: 200px; overflow: hidden; }

	.video-img button { margin-top: 20px; }
	.video-sure { position:absolute; bottom: 10px; right: 50px; }
	.haschoosed-video-img { width: 285px; height:200px; margin-top:20px; border: 1px solid #dcdcdc; }
	.video-modal-choose { position: absolute; top:0; left:0; width: 285px; height:30px; background-color:rgba(0,0,0,.3); color:#fff; }
	.video-modal-choose i { display: inline-block; width:50%; height: 30px; line-height: 30px; text-align: center; font-style:normal; cursor: pointer; }
	.video-modal-choose .video-choose-use { background-color:rgba(0,255,0,.3); }
	.video-modal-choose .video-has-choosed { background-color:rgba(255,0,0,.7); }
</style>

<div class="modal fade custom-width" id="modalVideoSelect">
	<div class="modal-dialog" style="width: 80%;">
		<div class="modal-content">
			
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h2 class="modal-title">视频选择</h2>
			</div>
			
			<div class="modal-body">
				<div class="modal-search">
					<input id="video_title" type="text" placeholder="输入您想要的视频标题"><a class="modal_fvideo_search" href="javascript:;">搜索</a>
				</div>
				<div class="video-modal-list">
				</div>
				<!-- 翻页 -->
				<div class="modal-page" data-page-count="1" data-page-index="1"></div>
			</div>
			
			<div class="modal-footer">
				<button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
			</div>
		</div>
	</div>
</div>

<script src="/source/Static/home/js/page.js"></script>
<script>
		//打开modal
		var funcModalVideoCallBack = null;
		var modalVideoFireObject = null;
		function showModalVideoSelect(obj, func) {
			modalVideoFireObject = obj;
			funcModalVideoCallBack = func;	
			modalVideoSelectClear();		
			$("#modalVideoSelect").modal('show', {backdrop: 'static'});	
		}
		
		// 切换选择
		function modalVideoSelectChangeChecked (){
			$(this).toggleClass('video-has-choosed');
		}
		
		// 清空选中
		function modalVideoSelectClear (){
			$("#modalVideoSelect").find('.video-has-choosed').removeClass('video-has-choosed');
		}
		
		//切换选中
		$(document).on('click','.video-choose',function(){
			$(this).toggleClass('video-has-choosed');
		});
		
		$('.modal_fvideo_search').click(function(){
			changeModalVideoSelectPage($("#modalVideoSelect").find('.modal-page').attr('data-page-index'));
		});

		// 初始化翻页
		constructionPage($("#modalVideoSelect").find('.modal-page'), 1, changeModalVideoSelectPage, true);
	    
	    // 切换页码
	    function changeModalVideoSelectPage(p) {
	    	var title = $("#modalVideoSelect").find('#video_title').val();
	    	var cdsstr = 'tl|' +title+'|stl|'+title;
	    	var jsonData = {
	    		op_type: 'list',
	    		cds: cdsstr,
	    		page: p - 1 ,
	    	}
	    	$.post('<?php echo U("line/video");?>', jsonData, function(data){	    		
				if (typeof(data.ds) != 'undefined' && data.ds != null) {
					$('.video-modal-list').empty();
					for (var i=0; i<data.ds.length; i++) {
						var d = data.ds[i];
						var include_image = typeof(d.face_image)=='undefined' ? false : true;
						var vhtml = '<div class="video-modal-product-content">'
//						           +	'<a href="javascript:;" onclick="addIframe(' + d.title +',' + d.href +');">'
						           +	'<a href="javascript:;">'
								   +		'<img src="'+d.img+'" alt="">'
								   +	'</a>'
						           +	'<div class="video-modal-product-content-describe">'
//							       +    	'<h5><a href="javascript:;" onclick="addIframe('+ d.title + ',' + d.href +');">' + d.title + '</a></h5>'
							       +    	'<h5><a href="javascript:;">' + d.title + '</a></h5>'
								   +	 	'<p>' + d.subheading + '</p>'
								   +    '</div>'
								   +	'<div class="video-modal-choose">'
								   +		'<i class="video-choose" data-id="'+d.id+'">选中</i><i class="video-choose-use">选中并使用</i>'
								   +	'</div>'
								   +'</div>';
						
						
						$("#modalVideoSelect").find('.video-modal-list').append(vhtml);
						$("#modalVideoSelect").find('.video-choose-use:last').click(modalVideoSelectComfirm);
						//$("#modalVideoSelect").find('.video-choose:last').click(modalVideoSelectChangeChecked);
					
					}
					
					// 根据情况判断是否重构分页
					constructionPage($("#modalVideoSelect").find('.modal-page'), p, data.page_count, changeModalVideoSelectPage);
				} 
	    	});
	    }
	    
	    $(document).ready(function(){
	    	changeModalVideoSelectPage(1);
	    });
	    
	    function modalVideoSelectComfirm() {
	    	if ($(this).prev().hasClass('video-has-choosed') == false) {
	    		$(this).prev().addClass('video-has-choosed');
	    	}
	    	
	    	var selIds = [];	    	
	    	$("#modalVideoSelect").find('.video-has-choosed').each(function(i,ev){
	    		selIds.push($(this).attr('data-id'));
	    	});
	    	
			$("#modalVideoSelect").modal('hide');
	    	funcModalVideoCallBack(modalVideoFireObject, selIds);
	    }
</script><?php endif; ?> 
<?php if(!empty($modal_tab_data)): ?><!-- 添加数据类型 -->
	<div class="modal fade" id="gallery-tab-data-modal" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content">
				
				<div class="modal-header">
					<h4 class="modal-title">标签添加</h4>
				</div>
				
				<div class="modal-body">
					
					<div class="row">
						<div class="col-md-12">
							<label class="control-label" for="modal_data_key">标签键<span style="color: red;">（*只能由字母、数字、短线、下划线其中任意类型组合而且不能为空）</span></label>
							<input class="form-control" name="modal_data_key" id="modal_data_key" data-validate="required"/>
						</div>						
					</div>
					
					<div class="row">
						<div class="col-md-12">
							<label class="control-label" for="modal_data_desc">标签文本<span style="color: red;">（*只能由字母、数字、短线、下划线或者汉字其中任意类型组合而且不能为空）</span></label>
							<input class="form-control" name="modal_data_desc" id="modal_data_desc" data-validate="required"/>
						</div>						
					</div>
					
				</div>
				
				<div class="modal-footer">
					<button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
					<button type="button" class="btn btn-secondary">添加</button>
				</div>
			</div>
		</div>
	</div>
	
	<script type="text/javascript">	
		var modalTabDataObj = $("#gallery-tab-data-modal");
		var modalTabDataCallBack = null;		
		// 添加类型
		$(modalTabDataObj).find('.btn-secondary').click(function(){
			var jsonData = {
				'key': $(modalTabDataObj).find('#modal_data_key').val(),
				'desc': $(modalTabDataObj).find('#modal_data_desc').val(),
			}
			if (modalTabDataCallBack != null) {
				modalTabDataCallBack(jsonData);
			}
			$(modalTabDataObj).modal('hide');
		});
		
		// 显示类型数据添加界面
		function showModalTabDataDialog(backcallFunc) {
			modalTabDataCallBack = backcallFunc;
			$(modalTabDataObj).find('#modal_data_key').val('');
 			$(modalTabDataObj).find('#modal_data_desc').val('');
			$(modalTabDataObj).modal('show');
		}
	</script><?php endif; ?> 
	<div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->
		<!--菜单-->
				<!-- Add "fixed" class to make the sidebar fixed always to the browser viewport. -->
		<!-- Adding class "toggle-others" will keep only one menu item open at a time. -->
		<!-- Adding class "collapsed" collapse sidebar root elements and show only icons. -->
		<div class="sidebar-menu toggle-others collapsed">
			
			<div class="sidebar-menu-inner">	
				
				<header class="logo-env" style="z-index: -1; height: 50px;">
					
					<!-- logo -->
					<div class="logo">
						<a href="http://kllife.com/back" class="logo-expanded">
							<img src="/source/Static/assets/images/logo.png" width="80" alt="" />
						</a>
						
						<a href="http://kllife.com/back" class="logo-collapsed">
							<img src="/source/Static/assets/images/logo.png" width="40" alt="" />
						</a>
					</div>
					
					<!-- This will toggle the mobile menu and will be visible only on mobile devices -->
					<div class="mobile-menu-toggle visible-xs">
						<a href="http://kllife.com/back" data-toggle="user-info-menu">
							<i class="fa-bell-o"></i>
							<span class="badge badge-success">7</span>
						</a>
						
						<a href="http://kllife.com/back" data-toggle="mobile-menu">
							<i class="fa-bars"></i>
						</a>
					</div>
					
					<!-- This will open the popup with user profile settings, you can use for any purpose, just be creative -->
					<!--<div class="settings-icon">
						<a href="#" data-toggle="settings-pane" data-animate="true">
							<i class="linecons-cog"></i>
						</a>
					</div>-->		
								
				</header>
						
				
						
				<ul id="main-menu" class="main-menu">
					<!-- add class "multiple-expanded" to allow multiple submenus to open -->
					<!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
					<li <?php echo C('MENU_ACTIVE')=='home' ? 'class="active opened"' : '';?>><!-- class="active opened"-->
						<a href="http://kllife.com/back">
							<i class="fa-home"><!--<i class="linecons-cog">--></i>
							<span class="title">后台首页</span>
						</a>
					</li>
					<li <?php echo C('MENU_ACTIVE')=='admin' ? 'class="active opened"' : '';?>>
						<a href="#">
							<i class="el-user"></i>
							<span class="title">管理员</span>
						</a>
						<ul>
							<?php if(check_grant('list_account') == true): ?><li <?php echo C('MENU_CURRENT')=='admin_acct_list' ? 'class="active"' : '';?>>
									<a href="<?php echo U('admin/list');?>"><span class="title">账号管理</span></a>
								</li><?php endif; ?>
							<?php if($admin['account'] == 'admin'): ?><li <?php echo C('MENU_CURRENT')=='admin_station_list' ? 'class="active"' : '';?>>
									<a href="<?php echo U('admin/station');?>"><span class="title">站点管理</span></a>
								</li><?php endif; ?>
							<li <?php echo C('MENU_CURRENT')=='account_type' ? 'class="active"' : '';?>>
								<a href="<?php echo U('type/list', 'obj=account_type');?>"><span class="title">账户类型</span></a>
							</li>
							<?php if(check_grant('list_admin_type') == true): ?><li <?php echo C('MENU_CURRENT')=='admin_type' ? 'class="active"' : '';?>>
									<a href="<?php echo U('type/list', 'obj=admin_type');?>"><span class="title">管理员类型</span></a>
								</li><?php endif; ?>
							<?php if(check_grant('list_grant') == true): ?><li <?php echo C('MENU_CURRENT')=='admin_grant' ? 'class="active"' : '';?>>
									<a href="<?php echo U('grant/list');?>"><span class="title">权限管理</span></a>
								</li><?php endif; ?>
							<?php if(check_grant('list_grant_group') == true): ?><li <?php echo C('MENU_CURRENT')=='admin_grant_group' ? 'class="active"' : '';?>>
									<a href="<?php echo U('type/list', 'obj=admin_grant_group');?>"><span class="title">权限组管理</span></a>
								</li><?php endif; ?>
							<?php if(check_grant('list_grant_type') == true): ?><li <?php echo C('MENU_CURRENT')=='admin_grant_type' ? 'class="active"' : '';?>>
									<a href="<?php echo U('type/list', 'obj=admin_grant_type');?>"><span class="title">权限类型管理</span></a>
								</li><?php endif; ?>
						</ul>
					</li>
					<?php if($line_system == true or $admin['account'] == 'admin'): ?><li <?php echo C('MENU_ACTIVE')=='line' ? 'class="active opened"' : '';?>>
						<a href="#">
							<i class="fa-th"></i>
							<span class="title">产品管理</span>
						</a>
						<ul>
							<li <?php echo C('MENU_CURRENT')=='line_list' ? 'class="active"' : '';?>>
								<a href="<?php echo U('line/list');?>"><span class="title">产品列表</span></a>
							</li>
							<?php if(check_grant('line_edit') == true): ?><li <?php echo C('MENU_CURRENT')=='line_create' ? 'class="active"' : '';?>>
									<a href="<?php echo U('line/create');?>"><span class="title">产品生成</span></a>
								</li><?php endif; ?>
							<?php if(check_grant('line_subject') == true and $admin['station_id_data']['key'] == 'main'): ?><li <?php echo C('MENU_CURRENT')=='line_subject' ? 'class="active"' : '';?>>
									<a href="<?php echo U('line/subject');?>"><span class="title">产品专题</span></a>
								</li><?php endif; ?>
							<?php if(check_grant('question_system') == true and $admin['station_id_data']['key'] == 'main'): ?><li <?php echo C('MENU_CURRENT')=='line_question' ? 'class="active"' : '';?>>
									<a href="<?php echo U('line/question');?>"><span class="title">问题系统</span></a>
								</li><?php endif; ?>
							<?php if(check_grant('article_system') == true and $admin['station_id_data']['key'] == 'main'): ?><li <?php echo C('MENU_CURRENT')=='line_article' ? 'class="active"' : '';?>>
									<a href="<?php echo U('line/article');?>/type/list"><span class="title">文章系统</span></a>
								</li><?php endif; ?>
							<!--<li <?php echo C('MENU_CURRENT')=='line_leader' ? 'class="active"' : '';?>>
								<a href="<?php echo U('line/leader');?>/type/list"><span class="title">领队系统</span></a>
							</li>-->
							<?php if(check_grant('video_center') == true and $admin['station_id_data']['key'] == 'main'): ?><li <?php echo C('MENU_CURRENT')=='line_video' ? 'class="active"' : '';?>>
									<a href="<?php echo U('line/video');?>"><span class="title">视频中心</span></a>
								</li><?php endif; ?>
						</ul>
					</li><?php endif; ?>
					<?php if(check_grant('user_center') == true): ?><li <?php echo C('MENU_ACTIVE')=='user' ? 'class="active opened"' : '';?>>
						<a href="#">
							<i class="fa-users"></i>
							<span class="title">用户中心</span>
						</a>
						<ul>
							<li <?php echo C('MENU_CURRENT')=='user_center' ? 'class="active"' : '';?>>
								<a href="<?php echo U('user/center');?>"><span class="title">用户中心</span></a>
							</li>
							<li <?php echo C('MENU_CURRENT')=='user_distribute' ? 'class="active"' : '';?>>
								<a href="<?php echo U('user/distribute');?>"><span class="title">分销用户</span></a>
							</li>
							<?php if(check_grant('user_coupon') == true): ?><li <?php echo C('MENU_CURRENT')=='user_coupon' ? 'class="active"' : '';?>>
									<a href="<?php echo U('user/coupon');?>"><span class="title">优惠券</span></a>
								</li><?php endif; ?>
						</ul>
					</li><?php endif; ?>
					<li <?php echo C('MENU_ACTIVE')=='order' ? 'class="active opened"' : '';?>>
						<a href="#">
							<i class="fa-tty"></i>
							<span class="title">订单管理</span>
						</a>
						<ul>
							<?php if(check_grant('list_order') == true): ?><li <?php echo C('MENU_CURRENT')=='order_list' ? 'class="active"' : '';?>>
									<a href="<?php echo U('order/list', 'obj=order_list');?>"><span class="title">订单查询</span></a>
								</li><?php endif; ?>
							<?php if(check_grant('create_order') == true): ?><li <?php echo C('MENU_CURRENT')=='order_create' ? 'class="active"' : '';?>>
									<a href="<?php echo U('order/info', 'obj=order_create');?>"><span class="title">线下报名</span></a>
								</li><?php endif; ?>
							<?php if(check_grant('order_robot') == true and $admin['station_id_data']['attached'] === '1'): ?><li <?php echo C('MENU_CURRENT')=='order_robot' ? 'class="active"' : '';?>>
									<a href="<?php echo U('order/robot', 'obj=order_robot');?>"><span class="title">人气报名</span></a>
								</li><?php endif; ?>
							<?php if(check_grant('list_order_from') == true): ?><li <?php echo C('MENU_CURRENT')=='order_from' ? 'class="active"' : '';?>>
									<a href="<?php echo U('type/list', 'obj=order_from');?>"><span class="title">订单来源</span></a>
								</li><?php endif; ?>
							<?php if(check_grant('list_state_type') == true): ?><li <?php echo C('MENU_CURRENT')=='state_type' ? 'class="active"' : '';?>>
									<a href="<?php echo U('type/list', 'obj=state_type');?>"><span class="title">状态类型</span></a>
								</li><?php endif; ?>
							<?php if(check_grant('list_order_state') == true): ?><li <?php echo C('MENU_CURRENT')=='order_state' ? 'class="active"' : '';?>>
									<a href="<?php echo U('type/list', 'obj=order_state');?>"><span class="title">订单状态</span></a>
								</li><?php endif; ?>
							<?php if(check_grant('list_member_type') == true): ?><li <?php echo C('MENU_CURRENT')=='order_member_type' ? 'class="active"' : '';?>>
									<a href="<?php echo U('type/list', 'obj=order_member_type');?>"><span class="title">人员类型</span></a>
								</li><?php endif; ?>
							<?php if(check_grant('list_certificate_type') == true): ?><li <?php echo C('MENU_CURRENT')=='order_certificate_type' ? 'class="active"' : '';?>>
									<a href="<?php echo U('type/list', 'obj=order_certificate_type');?>"><span class="title">证件类型</span></a>
								</li><?php endif; ?>
							<?php if(check_grant('list_coupon_type') == true): ?><li <?php echo C('MENU_CURRENT')=='order_coupon_type' ? 'class="active"' : '';?>>
									<a href="<?php echo U('type/list', 'obj=order_coupon_type');?>"><span class="title">优惠券类型</span></a>
								</li><?php endif; ?>
							<!--<li <?php echo C('MENU_CURRENT')=='order_import' ? 'class="active"' : '';?>>
								<a href="#"><span class="title">订单导入</span></a>
							</li>
							<li <?php echo C('MENU_CURRENT')=='order_export' ? 'class="active"' : '';?>>
								<a href="#"><span class="title">订单导出</span></a>
							</li>-->
						</ul>
					</li>
					<script type="text/javascript">
						$(document).ready(function(){
//							$.post('<?php echo U("review/getWaitReview");?>',{},function(data){
////								console.log('getWaitReview=>'+JSON.stringify(data));
//								if (data.result.errno != 0) {
//									alert(data.result.message);
//								} else {
//									$('#review_sum').html(data.review_sum);
//									$('#review_account').html(data.review_account);
//									$('#review_change_line').html(data.change_line);
//									$('#review_member_count').html(data.member_count);
//									$('#review_exit_team').html(data.exit_team);
//								}
//							})
						});
					</script>
					<li <?php echo C('MENU_ACTIVE')=='review' ? 'class="active opened"' : '';?>>
						<a href="#">
							<i class="fa-dollar"></i>
							<span class="title">审核管理</span>
							<?php if(check_grant('list_order_review') == true and $admin['station_id_data']['attached'] === '1'): ?><span id="review_sum" class="badge badge-purple">0</span><?php endif; ?>
						</a>
						<ul>
							<?php if(check_grant('list_order_review') == true and $admin['station_id_data']['attached'] === '1'): ?><li <?php echo C('MENU_CURRENT')=='review_list' ? 'class="active"' : '';?>>
									<a href="<?php echo U('review/list');?>">
										<span class="title">审核查询</span>
										<span id="review_account" class="badge badge-purple">0</span>
									</a>
								</li><?php endif; ?>
							<!--<?php if(check_grant('submit_finance_review') == true): ?><li <?php echo C('MENU_CURRENT')=='review_request' ? 'class="active"' : '';?>>
									<a href="<?php echo U('review/request');?>"><span class="title">审核请求</span></a>
								</li><?php endif; ?>-->
							<?php if(check_grant('list_online_pay') == true): ?><li <?php echo C('MENU_CURRENT')=='pay_log_online' ? 'class="active"' : '';?>>
									<a href="<?php echo U('review/payonline');?>">
										<span class="title">线上支付</span>
									</a>
								</li><?php endif; ?>
							<?php if(check_grant('list_order_review') == true and $admin['station_id_data']['attached'] === '1'): ?><li <?php echo C('MENU_CURRENT')=='change_line' ? 'class="active"' : '';?>>
									<a href="<?php echo U('review/changeLine');?>">
										<span class="title">改团审核</span>
										<span id="review_change_line" class="badge badge-purple">0</span>
									</a>
								</li><?php endif; ?>
							<?php if(check_grant('list_order_review') == true and $admin['station_id_data']['attached'] === '1'): ?><li <?php echo C('MENU_CURRENT')=='change_count' ? 'class="active"' : '';?>>
									<a href="<?php echo U('review/changeCount');?>">
										<span class="title">人数审核</span>
										<span id="review_member_count" class="badge badge-purple">0</span>
									</a>
								</li><?php endif; ?>
							<?php if(check_grant('list_order_review') == true and $admin['station_id_data']['attached'] === '1'): ?><li <?php echo C('MENU_CURRENT')=='exit_team' ? 'class="active"' : '';?>>
									<a href="<?php echo U('review/exitTeam');?>">
										<span class="title">退团审核</span>
										<span id="review_exit_team" class="badge badge-purple">0</span>
									</a>
								</li><?php endif; ?>
							<?php if(check_grant('list_order_review') == true and $admin['station_id_data']['attached'] === '1'): ?><li <?php echo C('MENU_CURRENT')=='take_cash' ? 'class="active"' : '';?>>
									<a href="<?php echo U('review/takecash');?>">
										<span class="title">提现审核</span>
										<span id="review_take_cash" class="badge badge-purple">0</span>
									</a>
								</li><?php endif; ?>
							<?php if(check_grant('list_review_type') == true): ?><li <?php echo C('MENU_CURRENT')=='review_type' ? 'class="active"' : '';?>>
									<a href="<?php echo U('type/list', 'obj=review_type');?>"><span class="title">审核状态</span></a>
								</li><?php endif; ?>
							<?php if(check_grant('list_cash_use') == true): ?><li <?php echo C('MENU_CURRENT')=='review_cash_use' ? 'class="active"' : '';?>>
									<a href="<?php echo U('type/list', 'obj=review_cash_use');?>"><span class="title">费用用途</span></a>
								</li><?php endif; ?>
							<?php if(check_grant('list_cash_function') == true): ?><li <?php echo C('MENU_CURRENT')=='review_cash_function' ? 'class="active"' : '';?>>
									<a href="<?php echo U('type/list', 'obj=review_cash_function');?>"><span class="title">费用功能</span></a>
								</li><?php endif; ?>
						</ul>
					</li>
					<li <?php echo C('MENU_ACTIVE')=='menu' ? 'class="active opened"' : '';?>>
						<a href="#">
							<i class="el-indent-left"></i>
							<span class="title">菜单管理</span>
						</a>
						<ul>
							<?php if(check_grant('list_menu_type') == true): ?><li <?php echo C('MENU_CURRENT')=='menu_type' ? 'class="active"' : '';?>>
									<a href="<?php echo U('type/list', 'obj=menu_type');?>"><span class="title">菜单类型</span></a>
								</li><?php endif; ?>
							<?php if(check_grant('list_menu_item') == true): ?><li <?php echo C('MENU_CURRENT')=='menu_item' ? 'class="active"' : '';?>>
									<a href="<?php echo U('menu/list');?>"><span class="title">菜单项</span></a>
								</li><?php endif; ?>
						</ul>
					</li>
					<script type="text/javascript">
//						$(document).ready(function(){
//							$.post('<?php echo U("team/getWaitDispose");?>',{},function(data){
////								console.log('getWaitDispose=>'+JSON.stringify(data));
//								$('#team_assign_count').html(data.assign_count);
//								$('#team_dispose_count').html(data.dispose_count);
//							})
//						});
					</script>
					<li <?php echo C('MENU_ACTIVE')=='team_group' ? 'class="active opened"' : '';?>>
						<a href="#">
							<i class="el-flag"></i>
							<span class="title">小包团</span>
							<?php if(check_grant('list_team_group') == true and $admin['station_id_data']['key'] == 'main'): ?><span id="team_assign_count" class="badge badge-purple">0</span><?php endif; ?>
						</a>
						<ul>
							<?php if(check_grant('list_team_group') == true and $admin['station_id_data']['key'] == 'main'): ?><li <?php echo C('MENU_CURRENT')=='list' ? 'class="active"' : '';?>>
									<a href="<?php echo U('team/list');?>">
										<span class="title">包团列表</span>
										<span id="team_dispose_count" class="badge badge-green">0</span>
									</a>									
								</li><?php endif; ?>
                
			                <?php if(check_grant('create_team_group') == true and $admin['station_id_data']['key'] == 'main'): ?><li <?php echo C('MENU_CURRENT')=='create' ? 'class="active"' : '';?>>
									<a href="<?php echo U('team/create');?>"><span class="title">创建包团</span></a>									
								</li><?php endif; ?>
							<?php if(check_grant('list_need_data') == true): ?><li <?php echo C('MENU_CURRENT')=='request_data' ? 'class="active"' : '';?>>
									<a href="<?php echo U('type/list', 'obj=request_data');?>"><span class="title">需求数据</span></a>
								</li><?php endif; ?>
							<?php if(check_grant('list_data_type') == true): ?><li <?php echo C('MENU_CURRENT')=='data_type' ? 'class="active"' : '';?>>
									<a href="<?php echo U('type/list', 'obj=data_type');?>"><span class="title">数据类型</span></a>
								</li><?php endif; ?>
							<!--<li <?php echo C('MENU_CURRENT')=='view_location' ? 'class="active"' : '';?>>
								<a href="<?php echo U('type/list', 'obj=view_location');?>"><span class="title">景点地名</span></a>
							</li>
							<li <?php echo C('MENU_CURRENT')=='hotel' ? 'class="active"' : '';?>>
								<a href="<?php echo U('team/list', 'obj=data_type');?>"><span class="title">住宿酒店</span></a>
							</li>-->
						</ul>
					</li>
					<li <?php echo C('MENU_ACTIVE')=='picture_library' ? 'class="active opened"' : '';?>>
						<a href="#">
							<i class="el-picture"></i>
							<span class="title">图片库</span>
						</a>
						<ul>
							<li <?php echo C('MENU_CURRENT')=='image_list' ? 'class="active"' : '';?>>
								<a href="<?php echo U('image/list');?>"><span class="title">图片展示</span></a>
							</li>
							<li <?php echo C('MENU_CURRENT')=='image_uplaod' ? 'class="active"' : '';?>>
								<a href="<?php echo U('image/upload');?>"><span class="title">图片上传</span></a>
							</li>
							<li <?php echo C('MENU_CURRENT')=='image_type' ? 'class="active"' : '';?>>
								<a href="<?php echo U('type/list', 'obj=image_type');?>"><span class="title">图片类型</span></a>
							</li>
							<li <?php echo C('MENU_CURRENT')=='image_from' ? 'class="active"' : '';?>>
								<a href="<?php echo U('type/list', 'obj=image_from');?>"><span class="title">图片来源</span></a>
							</li>
							<li <?php echo C('MENU_CURRENT')=='image_content' ? 'class="active"' : '';?>>
								<a href="<?php echo U('type/list', 'obj=image_content');?>"><span class="title">图片内容</span></a>
							</li>
						</ul>
					</li>
					<?php if($task_alert == true or $admin['account'] == 'admin'): ?><li <?php echo C('MENU_ACTIVE')=='alert_task' ? 'class="active opened"' : '';?>>
						<a href="#">
							<i class="el-megaphone"></i>
							<span class="title">任务提醒</span>
						</a>
						<ul>
							<li <?php echo C('MENU_CURRENT')=='alert_task_activity' ? 'class="active"' : '';?>>
								<a href="<?php echo U('task/alert', 'op_type=list');?>"><span class="title">我的提醒</span></a>
							</li>
							<li <?php echo C('MENU_CURRENT')=='alert_task_line' ? 'class="active"' : '';?>>
								<a href="<?php echo U('task/archive');?>"><span class="title">线路列表</span></a>
							</li>
							<li <?php echo C('MENU_CURRENT')=='alert_task_list' ? 'class="active"' : '';?>>
								<a href="<?php echo U('task/task','op_type=list');?>"><span class="title">任务列表</span></a>
							</li>
							<li <?php echo C('MENU_CURRENT')=='alert_task_date_type' ? 'class="active"' : '';?>>
								<a href="<?php echo U('type/list', 'obj=alert_task_date_type');?>"><span class="title">日期类型</span></a>
							</li>
							<li <?php echo C('MENU_CURRENT')=='alert_task_project' ? 'class="active"' : '';?>>
								<a href="<?php echo U('type/list', 'obj=alert_task_project');?>"><span class="title">项目类型</span></a>
							</li>
						</ul>
					</li><?php endif; ?>
					<li <?php echo C('MENU_ACTIVE')=='settle' ? 'class="active opened"' : '';?>>
						<a href="#">
							<i class="el-cog-circled"></i>
							<span class="title">个人中心</span>
						</a>
						<ul>
							<?php if(check_grant('list_log_type') == true): ?><li <?php echo C('MENU_CURRENT')=='settle_log_type' ? 'class="active"' : '';?>>
									<a href="<?php echo U('type/list', 'obj=settle_log_type');?>"><span class="title">日志类型</span></a>
								</li><?php endif; ?>
							<?php if(check_grant('list_log') == true): ?><li <?php echo C('MENU_CURRENT')=='settle_log' ? 'class="active"' : '';?>>
									<a href="<?php echo U('settle/loglist');?>"><span class="title">查看日志</span></a>
								</li><?php endif; ?>
							<li <?php echo C('MENU_CURRENT')=='settle_modify_passwd' ? 'class="active"' : '';?>>
								<a href="<?php echo U('settle/modifypassword');?>"><span class="title">管理员信息</span></a>
							</li>
							<?php if(check_grant('pc_home_set') == true): ?><li <?php echo C('MENU_CURRENT')=='settle_pc_home' ? 'class="active"' : '';?>>
									<a href="<?php echo U('settle/settle');?>/type/pchome"><span class="title">PC首页设置</span></a>
								</li><?php endif; ?>
							<?php if(check_grant('pc_set') == true): ?><li <?php echo C('MENU_CURRENT')=='settle_pcset' ? 'class="active"' : '';?>>
									<a href="<?php echo U('settle/pcset');?>"><span class="title">PC主站设置</span></a>
								</li><?php endif; ?>
							<?php if(check_grant('phone_home_set') == true): ?><li <?php echo C('MENU_CURRENT')=='settle_phone_home' ? 'class="active"' : '';?>>
									<a href="<?php echo U('settle/settle');?>/type/phonehome"><span class="title">手机首页设置</span></a>
								</li><?php endif; ?>
							<?php if(check_grant('qinglvpai_home_set') == true): ?><li <?php echo C('MENU_CURRENT')=='settle_qlp_home' ? 'class="active"' : '';?>>
									<a href="<?php echo U('settle/settle');?>/type/qinglvpai"><span class="title">轻旅拍设置</span></a>
								</li><?php endif; ?>
							<?php if(check_grant('sms_set') == true): ?><li <?php echo C('MENU_CURRENT')=='settle_sms_template' ? 'class="active"' : '';?>>
									<a href="<?php echo U('settle/smstemplate');?>"><span class="title">短信模板</span></a>
								</li><?php endif; ?>
						</ul>
					</li>
					<li <?php echo C('MENU_ACTIVE')=='lock_screen' ? 'class="active opened"' : '';?>>
						<a href="<?php echo U('admin/lockscreen');?>">
							<i class="el-off"></i>
							<span class="title">锁屏</span>
						</a>
					</li>
					<li <?php echo C('MENU_ACTIVE')=='question' ? 'class="active opened"' : '';?>>
						<a href="<?php echo U('index/question');?>">
							<i class="el-help"></i>
							<span class="title">常见问题</span>
						</a>
					</li>
					<li <?php echo C('MENU_ACTIVE')=='help' ? 'class="active opened"' : '';?>>
						<a href="<?php echo U('index/help');?>">
							<i class="linecons-cloud"></i>
							<span class="title">帮助文档</span>
						</a>
					</li>
					<li <?php echo C('MENU_ACTIVE')=='update' ? 'class="active opened"' : '';?>>
						<a href="<?php echo U('index/about');?>">
							<i class="fa-refresh"></i>
							<span class="title">关于&更新</span>
						</a>
					</li>
					<?php if($admin['account'] === 'admin'): ?><li <?php echo C('MENU_ACTIVE')=='sql' ? 'class="active opened"' : '';?>>
							<a href="<?php echo U('index/sql');?>">
								<i class="fa-refresh"></i>
								<span class="title">数据库</span>
							</a>
						</li><?php endif; ?>
				</ul>
						
			</div> <!--div:sidebar-menu-inner-->						
		</div> <!--div:sidebar-menu--> 
		<!--内容页-->
		<div class="main-content">
			<!--操作员信息-->
			
			<!-- User Info, Notifications and Menu Bar -->
			<nav class="navbar user-info-navbar" role="navigation">
				
				<!-- Left links for user info navbar -->
				<ul class="user-info-menu left-links list-inline list-unstyled">
					
					<li class="hidden-sm hidden-xs">
						<a href="#" data-toggle="sidebar">
							<i class="fa-bars"></i>
						</a>
					</li>
					
					<!--<li class="dropdown hover-line">
						<a href="#" data-toggle="dropdown">
							<i class="fa-envelope-o"></i>
							<span class="badge badge-green">15</span>
						</a>
					</li>-->					
					
					<!--<?php if(check_grant('list_order_review') == true): ?><li class="dropdown hover-line">
							<a href="<?php echo U('review/list');?>">
								<i class="fa-bell-o"></i>
								<span class="badge badge-purple">0</span>
							</a>
						</li>
						<script type="text/javascript">
							$(document).ready(function(){
								$.post('<?php echo U("review/getWaitReview");?>',{},function(data){
									if (data.result.errno != 0) {
										alert(data.result.message);
									} else {
										$('.badge-purple').html(data.waitCount);
									}
								})
							});
						</script><?php endif; ?>-->
					
				</ul>
				
				<!-- Right links for user info navbar -->
				<ul class="user-info-menu right-links list-inline list-unstyled">
					
					<li class="dropdown user-profile">
						<a href="#" data-toggle="dropdown">
							<img src="/source/Static/assets/images/user-4.png" alt="user-image" class="img-circle img-inline userpic-32" width="28" />
							<span>
								欢迎~!&nbsp;[<strong><?php echo ($admin["type_id_type_desc"]); ?>][<?php echo ($admin["account"]); ?></strong>]&nbsp;登录，您的所处权限为[<strong><?php echo ($admin["group_id_type_desc"]); ?></strong>]								
							</span>
							<i class="fa-angle-down"></i>
						</a>
						
						<ul class="dropdown-menu user-profile-menu list-unstyled">
							<li>
								<a href="<?php echo U('admin/login');?>">
									<i class="fa-tty"></i>
									客服
								</a>
							</li>
							<li>
								<a href="<?php echo U('admin/login');?>">
									<i class="fa-dollar"></i>
									财务
								</a>
							</li>
							<li>
								<a href="<?php echo U('admin/login');?>">
									<i class="fa fa-spin fa-cog"></i>
									管理员
								</a>
							</li>
							<li class="last">
								<a href="<?php echo U('admin/logout');?>">
									<i class="fa-lock"></i>
									退 出
								</a>
							</li>
						</ul>
					</li>					
				</ul>
			</nav>
			<!--加载页-->
			<div class="loading">		
				<div class="dashboard">
					<img src="/source/Static/back/images/aa.gif"/>
					<span class="tips"></span>
				</div>
			</div>
	<style>
		.form-control { width: 30%; }
		.form-control:focus { border-color: #40bbea; }
		.chaxun { margin-right: 100px; margin-bottom: 30px; }
		#cash_useSelectBoxIt, #cash_funcSelectBoxIt, #review_typeSelectBoxIt { 
			border-radius: 0 15px 15px 0 ; 
			background-color: #fff; 
			border-color: #40bbea; 
			overflow: hidden; 
		}
		
		.selectboxit-options { 
			border-radius: 0 15px 15px 15px; 
			background-color: #fff; 
			border-color: #40bbea; 
		}
		
		.selectboxit-options li a { color: #000; }

		.selectboxit-option-icon-container { overflow: hidden; }
		.cx_border01 { border-radius: 15px 0 0 15px; border-color: #40bbea; }
		.cx_border02 , html .select2-container .select2-choice , #s2id_activity{ border-radius: 0 15px 15px 0 !important; border-color: #40bbea !important; }
		.tab-pane > div { margin-top: 10px; height: 35px; }
		.ctr_card_btn_num:focus { border-color: #40bbea; }
		.dropdown-menu.dropdown-info > li > a { color: #000; }
		.dropdown-menu.dropdown-info > li > a:hover { background-color: #999 !important; }
		.nav.nav-tabs > li.active > a { border: 1px solid #40bbea; border-bottom: 2px solid #fff; }
		.nav.nav-tabs > li > a { padding-left: 30px; padding-right: 30px; }
		.nav.nav-tabs > li > a:hover { background-color: #40bbea; color: #fff; }
		.hvr-curl-top-left {
		  display: inline-block;
		  vertical-align: middle;
		  -webkit-transform: translateZ(0);
		  transform: translateZ(0);
		  box-shadow: 0 0 1px rgba(0, 0, 0, 0);
		  -webkit-backface-visibility: hidden;
		  backface-visibility: hidden;
		  -moz-osx-font-smoothing: grayscale;
		  position: relative;
		}
		.hvr-curl-top-left:before {
		  pointer-events: none;
		  position: absolute;
		  content: '';
		  height: 0;
		  width: 0;
		  top: 0;
		  left: 0;
		  background: white;
		  /* IE9 */
		  background: linear-gradient(135deg, white 45%, #aaaaaa 50%, #cccccc 56%, white 80%);
		  filter: progid:DXImageTransform.Microsoft.gradient(GradientType=0,startColorstr='#ffffff', endColorstr='#000000');
		  /*For IE7-8-9*/
		  z-index: 1000;
		  box-shadow: 1px 1px 1px rgba(0, 0, 0, 0.4);
		  -webkit-transition-duration: 0.3s;
		  transition-duration: 0.3s;
		  -webkit-transition-property: width, height;
		  transition-property: width, height;
		}
		.hvr-curl-top-left:hover:before, .hvr-curl-top-left:focus:before {
		  width: 15px;
		  height: 15px;
		}
		.info-color { background-color: #40bbea !important; border-color: #40bbea !important; }
		.info-border-color { border-color: #40bbea !important; }
		.select2-arrow { color: #fff !important; }
		#select2-drop { border-color: #40bbea;  } 
		
		.background-color-first-log { background-color:#eae415 !important; }
	</style>
	<div class="row">
		<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title"><?php echo C('CONTENT_TITLE');?></h3>
			
			<div class="panel-options">
				<a href="#" data-toggle="panel">
					<span class="collapse-icon">&ndash;</span>
					<span class="expand-icon">+</span>
				</a>

			</div>
		</div>
		<div class="panel-body">
			<!-- 查询 -->
			<div class="row chaxun">
				<!-- tab标签 -->
				<div class="col-sm-12">
					<div class="tab-content"  style="border-top: 1px solid #40bbea; margin-top: -1px;">
						<div class="tab-pane active" id="order">
							<div class="col-sm-3">
								<div class="input-group">
									<span class="input-group-addon info-color text-white cx_border01">订单号码:</span>
									<input type="text" class="form-control cx_border02" id="order_id">
								</div>
							</div>
							<div class="col-sm-6">
								<div class="input-group">			
									<span class="input-group-btn">
										<button id="date_type" type="button" class="btn btn-info dropdown-toggle cx_border01" data-toggle="dropdown" data-id="request" style="background-color: #40bbea; color: #555;">
											<span class="ctr_card_btn_num" style="background-color: #40bbea; color: #fff;">提审时间</span> 
											<span class="caret text-white"></span>
										</button>
										<ul class="dropdown-menu dropdown-info ctr_card_change" style="background-color: #fff; border-color: #40bbea;">
											<li><a href="javascript:;" name="request">提审时间</a></li>
											<li><a href="javascript:;" name="review">回执时间</a></li>
										</ul>
									</span>
									<input type="text" class="form-control datepicker info-border-color" style="display: inline-block;" data-format="yyyy-mm-dd" id="start_date">
									<div class="input-group-addon info-color text-white" style="border-radius: 0 15px 15px 0;">
										<a href="#"><i class="linecons-calendar text-white"></i></a>
									</div>
									<span style="display: table-cell; vertical-align: middle;">&nbsp;到&nbsp;</span>
									<input type="text" class="form-control datepicker info-border-color" style="display: inline-block; border-radius:15px 0 0 15px;" data-format="yyyy-mm-dd" id="end_date">
									<div class="input-group-addon info-color text-white cx_border02">
										<a href="#"><i class="linecons-calendar text-white"></i></a>
									</div>
								</div>
							</div>							
						</div>					
					</div>
			
					<button class="btn btn-blue btn-icon btn-icon-standalone btn-icon-standalone-right" id="button_search" style="float: right; margin-top: 30px;">
						<i class="fa-search"></i>
						<span>查 询</span>
					</button>
					<button class="btn btn-warning btn-icon btn-icon-standalone btn-icon-standalone-right" id="button_reset" style="float: right; margin-top: 30px; margin-right: 10px;">
						<i class="fa-refresh"></i>
						<span>重 置</span>
					</button>
				</div>
			</div>

			<table class="table table-bordered table-striped" id="example-1">
				<thead>
					<tr>
						<th>订单编号</th>
						<th width="20%">线路名称</th>
						<th>费用金额</th>
						<th>银行编码</th>
						<th>付款渠道</th>
						<th>联系人</th>
						<th>联系人电话</th>
						<th>交易号</th>
						<th>申请时间</th>
						<th>审核时间</th>
					</tr>
				</thead>
			</table>					
		</div>
	</div>
</div>	
			<!-- Main Footer -->
			<!-- Choose between footer styles: "footer-type-1" or "footer-type-2" -->
			<!-- Add class "sticky" to  always stick the footer to the end of page (if page contents is small) -->
			<!-- Or class "fixed" to  always fix the footer to the end of page -->
			<footer class="main-footer sticky footer-type-1">
				
				<div class="footer-inner">
				
					<!-- Add your copyright text here -->
					<div class="footer-text">
						&copy; 版权所有&nbsp; 
						<strong>领袖户外-订单系统</strong> 
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						更多信息请关注<a href="http://kllife.com/" target="_blank" title="领袖户外">&lt;领袖户外&gt;</a>
					</div>
					
					
					<!-- Go to Top Link, just add rel="go-top" to any link to add this functionality -->
					<div class="go-up">
					
						<a href="#" rel="go-top">
							<i class="fa-angle-up">top</i>
						</a>
						
					</div>
					
				</div>
				
			</footer>
		</div>		
		
	</div> <!--div:page-container-->	
				
	<a href="#" style="position: fixed; left: 80px; bottom: 10px; display: block; width: 50px; height: 50px; z-index: 999; background-image: url(/source/Static/back/images/up.png); background-size: 100% 100%;"></a>
	<div class="page-loading-overlay">
		<div class="loader-2"></div>
	</div>
	

	<link rel="stylesheet" href="/source/Static/assets/js/select2/select2.css">
	<link rel="stylesheet" href="/source/Static/assets/js/select2/select2-bootstrap.css">
	<!--Import daterangepicker css-->
	<link rel="stylesheet" href="/source/Static/assets/js/daterangepicker/daterangepicker-bs3.css">
	<link rel="stylesheet" href="/source/Static/assets/js/datetimepicker/css/bootstrap-datetimepicker.min.css">	
	<!-- Imported styles on this page -->
	<link rel="stylesheet" href="/source/Static/assets/js/fullcalendar/fullcalendar.min.css">
	
	<!-- Imported toastr -->
	<script src="/source/Static/assets/js/toastr/toastr.min.js"></script>
	
	<!-- Bottom Scripts -->
	<script src="/source/Static/assets/js/bootstrap.min.js"></script>
	<script src="/source/Static/assets/js/TweenMax.min.js"></script>
	<script src="/source/Static/assets/js/resizeable.js"></script>
	<script src="/source/Static/assets/js/joinable.js"></script>
	<script src="/source/Static/assets/js/xenon-api.js"></script>
	<script src="/source/Static/assets/js/xenon-toggles.js"></script>
	<script src="/source/Static/assets/js/moment.min.js"></script>
	
	<!-- Imported scripts on this page -->
	<script src="/source/Static/assets/js/fullcalendar/fullcalendar.min.js"></script>
	<script src="/source/Static/assets/js/jquery-ui/jquery-ui.min.js"></script>
	
	<!-- Imported scripts on this page -->
	<script src="/source/Static/assets/js/daterangepicker/daterangepicker.js"></script>
	<script src="/source/Static/assets/js/datepicker/bootstrap-datepicker.js"></script>
	<script src="/source/Static/assets/js/timepicker/bootstrap-timepicker.min.js"></script>
	<script src="/source/Static/assets/js/datetimepicker/js/bootstrap-datetimepicker.js"></script>
	<script src="/source/Static/assets/js/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js"></script>

	<!-- Imported scripts on this page -->
	<script src="/source/Static/assets/js/jquery-validate/jquery.validate.min.js"></script>
	
	<!-- Imported dropzone scripts -->
	<script src="/source/Static/assets/js/dropzone/dropzone.min.js"></script>
	
	<!-- Imported dataTables scripts -->
	<script src="/source/Static/assets/js/datatables/js/jquery.dataTables.min.js"></script>
	<script src="/source/Static/assets/js/datatables/dataTables.bootstrap.js"></script>
	<script src="/source/Static/assets/js/datatables/yadcf/jquery.dataTables.yadcf.js"></script>
	<script src="/source/Static/assets/js/datatables/tabletools/dataTables.tableTools.min.js"></script>
		
	<!-- Imported scripts on this page -->
	<script src="/source/Static/assets/js/ckeditor/ckeditor.js"></script>
	<script src="/source/Static/assets/js/ckeditor/adapters/jquery.js"></script>
		
	<!-- Imported selectBoxIt on this page -->
	<script src="/source/Static/assets/js/select2/select2.min.js"></script>
	<script src="/source/Static/assets/js/selectboxit/jquery.selectBoxIt.min.js"></script>
	<script src="/source/Static/assets/js/multiselect/js/jquery.multi-select.js"></script>
	<script src="/source/Static/assets/js/tagsinput/bootstrap-tagsinput.min.js"></script>
	
	<!-- JavaScripts initializations and stuff -->
	<script src="/source/Static/assets/js/xenon-custom.js"></script>

	<!-- Import fileupload on this page -->
	<script src="/source/Static/assets/js/fileupload/js/jquery.fileupload.js"></script>
	<script src="/source/Static/assets/js/fileupload/js/vendor/jquery.ui.widget.js"></script>
	<script src="/source/Static/assets/js/fileupload/js/jquery.iframe-transport.js"></script>
	
	<!--自己的全局JavaScript代码-->
	<script src="/source/Static/back/js/functions.js"></script>
	<script src="/source/Static/common/js/functions.js"></script>
</body>
</html>


<script type="text/javascript">
	var myTable, pageRequestData;
	var modalDataEditData = new Object();
	$(document).ready(function(){
		
		// 初始化数据表格
		myTable = initDataTable();
		
		$(".ctr_card_change li").click(function(){
			var timeType = $(this).find('a').attr('name');
			var timeDesc = $(this).find('a').html();
			$(this).parent().prev().attr('data-id', timeType);
			$(this).parent().prev().find('.ctr_card_btn_num').html(timeDesc);
		});
		
		//搜索
		$("#button_search").click(function(){
	    	myTable.fnReloadAjax(myTable.fnSettings());
		});
		
		// 重置条件
		$("#button_reset").click(function(){
				$('#order_id').val('');
				$('#cash_use').val(-1).trigger('change');
				$('#cash_func').val(-1).trigger('change');
				$('#review_type').val(-1).trigger('change');
				$('#admin_acct').val('')
	    		myTable.fnReloadAjax(myTable.fnSettings());
		});
	});
	

	// 初始化数据列表
	function initDataTable() {	
		var vTable = $("#example-1").dataTable({
			"bSort": true,
			"bAutoWidth": true,
			"bFilter": true,
			"searching": false,
			"bInfo": true,//页脚信息
			"bPaginate": true, //翻页功能
			"bLengthChange": true, //改变每页显示数据数量
			"bStateSave": true,	//状态保存，使用了翻页或者改变了每页显示数据数量，会保存在cookie中，下回访问时会显示上一次关闭页面时的内容。
			"sPaginationType": "full_numbers", //显示数字的翻页样式"
			"aLengthMenu": [[50, 100, 200],[50, 100, 200]],	// 可分页的数量值与显示
			"isDisplayLength": 50,	// 当前每页显示数量
			"oLanguage": {
				"sLengthMenu": "每页显示 _MENU_ 条记录",
				"sZeroRecords": "抱歉， 没有找到",
				"sInfo": "从 _START_ 到 _END_ / 共 _TOTAL_ 条数据",
				"sInfoEmpty": "没有数据",
				"sInfoFiltered": "(从_MAX_条数据中检索)",
				"oPaginate": {
					"sFirst": "首页",
					"sPrevious": "前一页",
					"sNext": "后一页",
					"sLast": "尾页"
				},
				"sZeroRecords": "没有检索到数据",
				"sProcessing": "<src='/source/Static/images/loader.gif' />",
			},
			//Ajax获取信息
			"bProcessing": true,
			"bServerSide": true,
			"sAjaxSource": "<?php echo ($ajaxReqUrl); ?>",
			//如果加上下面这段内容，则使用post方式传递数据
			"fnServerData": getPageData,
			"aoColumns": [
				{"mData": "order_sn", "aTargets": [0], "fnCreatedCell": replaceContent},
				{"mData": "order_sn_data.lineid_hdid_show", "aTargets": [1], "fnCreatedCell": replaceContent},
				{"mData": "TransAmount", "aTargets": [2], "fnCreatedCell": replaceContent},
				{"mData": "InstCode", "aTargets": [3], "fnCreatedCell": replaceContent},
				{"mData": "PayChannel_data.item_desc", "aTargets": [4], "fnCreatedCell": replaceContent},
				{"mData": "order_sn_data.names", "aTargets": [5], "fnCreatedCell": replaceContent},
				{"mData": "order_sn_data.mob", "aTargets": [6], "fnCreatedCell": replaceContent},
				{"mData": "TransNo", "aTargets": [7], "fnCreatedCell": replaceContent},
				{"mData": "SendTime.show_text", "aTargets": [8], "fnCreatedCell": replaceContent},
				{"mData": "datetime.show_text", "aTargets": [9], "fnCreatedCell": replaceContent},
			],//$_GET[‘sColumns’]将接收到aoColumns传递数据
			"aoColumnDefs": [{"sDefaultContent": "", "aTargets": ["_all"]}],
		});
		return vTable;
	}
	
	function getFindData() {		
		var jsonData = [
				{'name':'order_id', 'value':$('#order_id').val()},
				{'name':'date_type', 'value':$('#date_type').attr('data-id')},
				{'name':'sdate', 'value':$('#start_date').val()},
				{'name':'edate', 'value':$('#end_date').val()},
			];
		
		return jsonData;
	}

	//Ajax获取数据
	function getPageData ( sSource, aoData, fnCallback ) {
		showLoading(true);
		var jsonData = getFindData();
		$.post('<?php echo ($ajaxReqUrl); ?>', {'op_type': 'cddata', 'cds': jsonData}, function(data){	
//			console.log('<?php echo ($ajaxReqUrl); ?>'+JSON.stringify(jsonData));		
			aoData.push({'name':'op_type','value':'list'});
			pageRequestData = aoData;
			$.post(sSource, aoData, function(data,status){
//					console.log(JSON.stringify(data.sql));
					showLoading(false);
					if (data['result']['errno'] == 0) {
						fnCallback(data);
					} else {
						alert(data['result']['message']);
					}			
				},'JSON');
		})		
	}
	
	// 内容替换
	function replaceContent(nTd, sData, oData, iRow, iCol) {
		if (iCol == 1) {
			$(nTd).html(oData['order_sn_data.lineid_hdid_show']);
		} else if (iCol == 4) {
			$(nTd).html(oData['PayChannel_data.item_desc']);
		} else if (iCol == 5) {
			$(nTd).html(oData['order_sn_data.names']);
		} else if (iCol == 6) {
			$(nTd).html(oData['order_sn_data.mob']);
		} else if (iCol == 8) {
			$(nTd).html(oData['SendTime_show_text']);
		} else if (iCol == 9) {
			$(nTd).html(oData['datetime_show_text']);	
		}
		
		if (oData['first_log'] == true) {
			if (!$(nTd).hasClass('background-color-first-log')) {				
				$(nTd).addClass('background-color-first-log');	
			}
		}
	}

	/*
	add this plug in
	// you can call the below function to reload the table with current state
	Datatables刷新方法
	oTable.fnReloadAjax(oTable.fnSettings());
	*/
	$.fn.dataTableExt.oApi.fnReloadAjax = function (oSettings) {
		//oSettings.sAjaxSource = sNewSource;
		this.fnClearTable(this);
		this.oApi._fnProcessingDisplay(oSettings, true);
		var that = this;

		$.getJSON(oSettings.sAjaxSource, null, function (json) {
		    /* Got the data - add it to the table */
		    for (var i = 0; i < json.aaData.length; i++) {
		        that.oApi._fnAddData(oSettings, json.aaData[i]);
		    }
		    oSettings.aiDisplay = oSettings.aiDisplayMaster.slice();
		    that.fnDraw(that);
		    that.oApi._fnProcessingDisplay(oSettings, false);
		});
	}

</script>