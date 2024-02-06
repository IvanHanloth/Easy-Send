layui.define(['table', 'jquery', 'element'], function (exports) {
	"use strict";

	var MOD_NAME = 'message',
		$ = layui.jquery,
		element = layui.element;

	var message = function (opt) {
		this.option = opt;
	};

	message.prototype.render = function (opt) {
		//默认配置值
		var option = {
			elem: opt.elem,
			url: opt.url ? opt.url : false,
			height: opt.height,
			data: opt.data
		}
		if (option.url != false) {
			option.data = getData(option.url);
			var notice = createHtml(option);
			$(option.elem).html(notice);
			var targetNode = document.querySelector(option.elem + ' .pear-notice')
			var mutationObserver = new MutationObserver(function (mutationsList, observer) {
				if (getComputedStyle(targetNode).display !== 'none') {
					var rect = targetNode.getBoundingClientRect();
					//是否超出右侧屏幕
					if (rect.right > $(window).width()) {
						var elemRight = document.querySelector(option.elem).getBoundingClientRect().right;
						var offsetRight = 20;
						targetNode.style.right = elemRight - $(window).width() + offsetRight + 'px';
						targetNode.style.left = 'unset';
					}
				}
			});
			mutationObserver.observe(targetNode, {
				attributes: true,
				childList: false,
				subtree: false,
				attributeOldValue: false,
				attributeFilter: ['class']
			});
		}
		setTimeout(function () {
			element.init();
			$(opt.elem + " li").click(function (e) {
				$(this).siblings().removeClass('pear-this');
				$(this).addClass('pear-this');
			})
		}, 300);
		return new message(option);
	}

	message.prototype.click = function (callback) {
		$("*[notice-id]").click(function (event) {
			event.preventDefault();
			var id = $(this).attr("notice-id");
			var title = $(this).attr("notice-title");
			var context = $(this).attr("notice-context");
			var form = $(this).attr("notice-form");
			callback(id, title, context, form);
		})
	}

	/** 刷 新 消 息 */
	message.prototype.reload = function () {

	}

	/** 同 步 请 求 获 取 数 据 */
	function getData(url) {
		$.ajaxSettings.async = false;
		var data = null;
		$.get(url, function (result) {
			data = result;
		});
		$.ajaxSettings.async = true;
		return data;
	}

	function createHtml(option) {

		var count = 0;
		var noticeTitle = '<ul class="layui-tab-title">';
		var noticeContent = '<div class="layui-tab-content" style="height:' + option.height + ';overflow-x: hidden;padding:0px;">';


		// 根据 data 便利数据
		$.each(option.data, function (i, item) {

			if (i === 0) {
				noticeTitle += '<li class="pear-this">' + item.title + '</li>';
				noticeContent += '<div class="layui-tab-item layui-show">';
			} else {
				noticeTitle += '<li>' + item.title + '</li>';
				noticeContent += '<div class="layui-tab-item">';
			}

			$.each(item.children, function (i, note) {
				count++;
				noticeContent += '<div class="pear-notice-item" notice-form="' + note.form + '" notice-context="' + note.context +
					'" notice-title="' + note.title + '" notice-id="' + note.id + '">' ;
                    
                if (note.avatar)
					noticeContent +='<img src="' + note.avatar + '"/>';

				noticeContent +='<div style="display:inline-block;">' + note.title + '</div>' +
					'<div class="pear-notice-end">' + note.time + '</div>' +
					'</div>';
			})
			
			// 空内容
			if(item.children.length==0){
				noticeContent +='<div class="pear-empty"><div class="pear-empty-image"><svg class="pear-empty-img-default" width="184" height="152" viewBox="0 0 184 152"><g fill="none" fill-rule="evenodd"><g transform="translate(24 31.67)"><ellipse class="pear-empty-img-default-ellipse" cx="67.797" cy="106.89" rx="67.797" ry="12.668"></ellipse><path class="pear-empty-img-default-path-1" d="M122.034 69.674L98.109 40.229c-1.148-1.386-2.826-2.225-4.593-2.225h-51.44c-1.766 0-3.444.839-4.592 2.225L13.56 69.674v15.383h108.475V69.674z"></path><path class="pear-empty-img-default-path-2" d="M101.537 86.214L80.63 61.102c-1.001-1.207-2.507-1.867-4.048-1.867H31.724c-1.54 0-3.047.66-4.048 1.867L6.769 86.214v13.792h94.768V86.214z" transform="translate(13.56)"></path><path class="pear-empty-img-default-path-3" d="M33.83 0h67.933a4 4 0 0 1 4 4v93.344a4 4 0 0 1-4 4H33.83a4 4 0 0 1-4-4V4a4 4 0 0 1 4-4z"></path><path class="pear-empty-img-default-path-4" d="M42.678 9.953h50.237a2 2 0 0 1 2 2V36.91a2 2 0 0 1-2 2H42.678a2 2 0 0 1-2-2V11.953a2 2 0 0 1 2-2zM42.94 49.767h49.713a2.262 2.262 0 1 1 0 4.524H42.94a2.262 2.262 0 0 1 0-4.524zM42.94 61.53h49.713a2.262 2.262 0 1 1 0 4.525H42.94a2.262 2.262 0 0 1 0-4.525zM121.813 105.032c-.775 3.071-3.497 5.36-6.735 5.36H20.515c-3.238 0-5.96-2.29-6.734-5.36a7.309 7.309 0 0 1-.222-1.79V69.675h26.318c2.907 0 5.25 2.448 5.25 5.42v.04c0 2.971 2.37 5.37 5.277 5.37h34.785c2.907 0 5.277-2.421 5.277-5.393V75.1c0-2.972 2.343-5.426 5.25-5.426h26.318v33.569c0 .617-.077 1.216-.221 1.789z"></path></g><path class="pear-empty-img-default-path-5" d="M149.121 33.292l-6.83 2.65a1 1 0 0 1-1.317-1.23l1.937-6.207c-2.589-2.944-4.109-6.534-4.109-10.408C138.802 8.102 148.92 0 161.402 0 173.881 0 184 8.102 184 18.097c0 9.995-10.118 18.097-22.599 18.097-4.528 0-8.744-1.066-12.28-2.902z"></path><g class="pear-empty-img-default-g" transform="translate(149.65 15.383)"><ellipse cx="20.654" cy="3.167" rx="2.849" ry="2.815"></ellipse><path d="M5.698 5.63H0L2.898.704zM9.259.704h4.985V5.63H9.259z"></path></g></g></svg></div><p class="pear-empty-description">暂无数据</p></div>';
			}			
			noticeContent += '</div>';
		})

		var notice;
		if (count > 0){
			notice = '<li class="layui-nav-item" lay-unselect="">' +
				'<a href="#" class="notice layui-icon layui-icon-notice"><span class="layui-badge-dot"></span></a>' +
				'<div class="layui-nav-child layui-tab pear-notice" style="margin-top: 0px;left: -200px;padding:0px;">';
		}else {
			notice = '<li class="layui-nav-item" lay-unselect="">' +
				'<a href="#" class="notice layui-icon layui-icon-notice"></a>' +
				'<div class="layui-nav-child layui-tab pear-notice" style="margin-top: 0px;left: -200px;padding:0px;">';
		}

		noticeTitle += '</ul>';
		noticeContent += '</div>';
		notice += noticeTitle;
		notice += noticeContent;
		notice += '</div></li>';
		return notice;
	}

	exports(MOD_NAME, new message());
})
