layui.define(['table', 'jquery', 'element'], function (exports) {
	"use strict";

	var MOD_NAME = 'menu',
		$ = layui.jquery,
		element = layui.element;

	var pearMenu = function (opt) {
		this.option = opt;
	};

	pearMenu.prototype.render = function (opt) {

		var option = {
			elem: opt.elem,
			async: opt.async,
			parseData: opt.parseData,
			url: opt.url,
			method: opt.method ? opt.method : "GET",
			defaultOpen: opt.defaultOpen,
			defaultSelect: opt.defaultSelect,
			control: opt.control,
			defaultMenu: opt.defaultMenu,
			accordion: opt.accordion,
			height: opt.height,
			theme: opt.theme,
			data: opt.data ? opt.data : [],
			change: opt.change ? opt.change : function () { },
			done: opt.done ? opt.done : function () { }
		}
		var tempDone = option.done;
		option.done = function(){
			if (option.control) {
				rationalizeHeaderControlWidthAuto(option);
			}
			tempDone();
		}

		if (option.async) {
			if (option.method === "GET") {
				getData(option.url).then(function (data) {
					option.data = data;
					renderMenu(option);
				});
			} else {
				postData(option.url).then(function (data) {
					option.data = data;
					renderMenu(option);
				});
			}
		} else {
			// 延时返回，和 javascript 执行时序关联
			window.setTimeout(function () { renderMenu(option); }, 500);
		}

		// 处理高度
		$("#" + opt.elem).height(option.height)


    return new pearMenu(option);
	}

	pearMenu.prototype.click = function (clickEvent) {
		var _this = this;
		$("body").on("click", "#" + _this.option.elem + " .site-demo-active", function () {
			var dom = $(this);
			var data = {
				menuId: dom.attr("menu-id"),
				menuTitle: dom.attr("menu-title"),
				menuPath: dom.attr("menu-title"),
				menuIcon: dom.attr("menu-icon"),
				menuUrl: dom.attr("menu-url"),
				openType: dom.attr("open-type")
			};
			var doms = hash(dom);
			if (doms != null) {
				if (doms.text() != '') {
					data['menuPath'] = doms.find("span").text() + " / " + data['menuPath'];
				}
			}
			if (doms != null) {
				var domss = hash(doms);
				if (domss != null) {
					if (domss.text() != '') {
						data['menuPath'] = domss.find("span").text() + " / " + data['menuPath'];
					}
				}
			}
			if (domss != null) {
				var domsss = hash(domss);
				if (domsss != null) {
					if (domsss.text() != '') {
						data['menuPath'] = domsss.find("span").text() + " / " + data['menuPath'];
					}
				}
			}
			if ($("#" + _this.option.elem).is(".pear-nav-mini")) {
				if (_this.option.accordion) {
					activeMenus = $(this).parent().parent().parent().children("a");
				} else {
					activeMenus.push($(this).parent().parent().parent().children("a"));
				}
			}
			clickEvent(dom, data);
		})
	}

	function hash(dom) {
		var d = dom.parent().parent().prev();
		if (d.prop("tagName") === "UL") {
			return null;
		}
		return d;
	}

	pearMenu.prototype.skin = function (skin) {
		var menu = $(".pear-nav-tree[lay-filter='" + this.option.elem + "']").parent();
		menu.removeClass("dark-theme");
		menu.removeClass("light-theme");
		menu.addClass(skin);
	}

	pearMenu.prototype.selectItem = function (pearId) {
		if (this.option.control != false) {
			$("#" + this.option.elem + " a[menu-id='" + pearId + "']").parents(".layui-side-scroll ").find("ul").css({
				display: "none"
			});
			$("#" + this.option.elem + " a[menu-id='" + pearId + "']").parents(".layui-side-scroll ").find(".layui-this").removeClass(
				"layui-this");
			$("#" + this.option.elem + " a[menu-id='" + pearId + "']").parents("ul").css({
				display: "block"
			});
			var controlId = $("#" + this.option.elem + " a[menu-id='" + pearId + "']").parents("ul").attr("pear-id");
			if (controlId != undefined) {
				$("#" + this.option.control).find(".layui-this").removeClass("layui-this");
				$("#" + this.option.control).find("[pear-id='" + controlId + "']").addClass("layui-this");
			}
		}

		$("#" + this.option.elem + " a[menu-id='" + pearId + "']").parents(".pear-nav-tree").find(".layui-this").removeClass(
			"layui-this");
		if (!$("#" + this.option.elem).is(".pear-nav-mini")) {
			var openEle = null;
			var openEleHeight = 0;
			$($("#" + this.option.elem + " a[menu-id='" + pearId + "']").parents('.layui-nav-child').get().reverse()).each(function () {
				if (!$(this).parent().is('.layui-nav-itemed')) {
					if (openEleHeight == 0) {
						openEle = $(this);
					} else {
						$(this).parent().addClass('layui-nav-itemed');
						$(this).css({
							height: 'auto',
						});
					}
					openEleHeight += $(this).children("dd").length * 48;
				}
			});
			if (this.option.accordion) {
				if (openEleHeight > 0) {
					var currentDom = openEle.parent().siblings('.layui-nav-itemed').children(".layui-nav-child");
					currentDom.animate({
						height: "0px"
					}, 240, function () {
						currentDom.css({
							height: "auto"
						});
						$(this).parent().removeClass("layui-nav-itemed");
						$(this).find('.layui-nav-itemed').removeClass("layui-nav-itemed");
					});
				}
			}
			if (openEleHeight > 0) {
				openEle.parent().addClass("layui-nav-itemed");
				openEle.height(0);
				openEle.animate({
					height: openEleHeight + "px"
				}, 240, function () {
					$(this).css({ height: 'auto' });
				});
			}
		}
		$("#" + this.option.elem + " a[menu-id='" + pearId + "']").parent().addClass("layui-this");
	}

	var activeMenus;
	pearMenu.prototype.collapse = function (time) {
		var elem = this.option.elem;
		var config = this.option;
		if ($("#" + this.option.elem).is(".pear-nav-mini")) {
			$.each(activeMenus, function (i, item) {
				$("#" + elem + " a[menu-id='" + $(this).attr("menu-id") + "']").parent().addClass("layui-nav-itemed");
			})
			$("#" + this.option.elem).removeClass("pear-nav-mini");
			$("#" + this.option.elem).animate({
				width: "220px"
			}, 180);
			isHoverMenu(false, config);
			var that = this;
			$("#" + this.option.elem)
			.promise()
			.done(function () {
				if (that.option.control) {
					rationalizeHeaderControlWidth(that.option);
				}
			})
		} else {
			activeMenus = $("#" + this.option.elem).find(".layui-nav-itemed>a");
			$("#" + this.option.elem).find(".layui-nav-itemed").removeClass("layui-nav-itemed");
			$("#" + this.option.elem).addClass("pear-nav-mini");
			$("#" + this.option.elem).animate({
				width: "60px"
			}, 400);
			var that = this;
			$("#" + this.option.elem)
			.promise()
			.done(function () {
				isHoverMenu(true, config);
				if (that.option.control) {
					rationalizeHeaderControlWidth(that.option);
				}
			})		
		}
	}

	function getData(url) {
		var defer = $.Deferred();
		var symbol = url.indexOf('?') !== -1 ? '&' : '?';
		$.get(url + symbol + "fresh=" + Math.random(), function (result) {
			defer.resolve(result)
		});
		return defer.promise();
	}

	function postData(url) {
		var defer = $.Deferred();
		var symbol = url.indexOf('?') !== -1 ? '&' : '?';
		$.post(url + symbol + "fresh=" + Math.random(), function (result) {
			defer.resolve(result)
		}, "json");
		return defer.promise();
	}

	function renderMenu(option) {
		if (option.parseData != false) {
			option.parseData(option.data);
		}
		if (option.data.length > 0) {
			if (option.control != false) {
				createMenuAndControl(option);
			} else {
				createMenu(option);
			}
		}
		element.init();
		downShow(option);
		option.done();
	}

	function createMenu(option) {
		var menuHtml = '<div style="height:100%!important;" class="pear-side-scroll layui-side-scroll ' + option.theme + '"><ul lay-filter="' + option.elem +
			'" class="layui-nav arrow   pear-menu layui-nav-tree pear-nav-tree">'
		$.each(option.data, function (i, item) {
			var content = '<li class="layui-nav-item" >';
			if (i == option.defaultOpen) {
				content = '<li class="layui-nav-item layui-nav-itemed" >';
			}
			var href = "javascript:;";
			var target = "";
			var className = "site-demo-active"
			if (item.openType == "_blank" && item.type == 1) {
				href = item.href;
				target = "target='_blank'";
				className = "";
			}
			if (item.type == 0) {
				// 创 建 目 录 结 构
				content += '<a  href="javascript:;" menu-type="' + item.type + '" menu-id="' + item.id + '" href="' + href +
					'" ' + target + '><i class="' + item.icon + '"></i><span>' + item.title +
					'</span></a>';
			} else if (item.type == 1) {
				content += '<a class="' + className + '" menu-type="' + item.type + '" menu-url="' + item.href + '" menu-id="' +
					item.id +
					'" menu-title="' + item.title + '"  href="' + href + '"  ' + target + '><i class="' + item.icon +
					'"></i><span>' + item.title + '</span></a>';
			}
			// 调 用 递 归 方 法 加 载 无 限 层 级 的 子 菜 单 
			content += loadchild(item);
			// 结 束 一 个 根 菜 单 项
			content += '</li>';
			menuHtml += content;
		});
		// 结 束 菜 单 结 构 的 初 始 化
		menuHtml += "</ul></div>";
		// 将 菜 单 拼 接 到 初 始 化 容 器 中
		$("#" + option.elem).html(menuHtml);
	}

	function createMenuAndControl(option) {
		var control = '<div class="control"><ul class="layui-nav pear-nav-control pc layui-hide-xs" style="width: fit-content;">';
		control+= '<li class="layui-nav-item tabdrop layui-hide" style="float:right !important;"><a href="javascript:;"><i class="layui-icon layui-icon-more layui-font-20"></i></a><dl class="layui-nav-child"></dl></li>';
		var controlPe = '<ul class="layui-nav pear-nav-control layui-hide-sm">';
		// 声 明 头 部
		var menu = '<div class="layui-side-scroll ' + option.theme + '">'
		// 开 启 同 步 操 作
		var index = 0;
		var controlItemPe = '<dl class="layui-nav-child">';
		$.each(option.data, function (i, item) {
			var menuItem = '';
			var controlItem = '';
			if (i === option.defaultMenu) {
				controlItem = '<li pear-href="' + item.href + '" pear-title="' + item.title + '" pear-id="' + item.id +
					'" class="layui-this layui-nav-item"><a href="#">' + item.title + '</a></li>';
				menuItem = '<ul  pear-id="' + item.id + '" lay-filter="' + option.elem +
					'" class="layui-nav arrow layui-nav-tree pear-nav-tree">';

				controlPe += '<li class="layui-nav-item"><a class="pe-title" href="javascript:;" >' + item.title + '</a>';

				controlItemPe += '<dd  pear-href="' + item.href + '" pear-title="' + item.title + '" pear-id="' + item.id +
					'"><a href="javascript:void(0);">' + item.title + '</a></dd>';
			} else {

				controlItem = '<li  pear-href="' + item.href + '" pear-title="' + item.title + '" pear-id="' + item.id +
					'" class="layui-nav-item"><a href="#">' + item.title + '</a></li>';

				menuItem = '<ul style="display:none" pear-id="' + item.id + '" lay-filter="' + option.elem +
					'" class="layui-nav arrow layui-nav-tree pear-nav-tree">';

				controlItemPe += '<dd pear-href="' + item.href + '" pear-title="' + item.title + '" pear-id="' + item.id +
					'"><a href="javascript:void(0);">' + item.title + '</a></dd>';

			}
			index++;
			$.each(item.children, function (i, note) {
				// 创 建 每 一 个 菜 单 项
				var content = '<li class="layui-nav-item" >';
				var href = "javascript:;";
				var target = "";
				var className = "site-demo-active";
				if (note.openType == "_blank" && note.type == 1) {
					href = note.href;
					target = "target='_blank'";
					className = "";
				}
				// 判 断 菜 单 类 型 0 是 不可跳转的目录 1 是 可 点 击 跳 转 的 菜 单
				if (note.type == 0) {
					// 创 建 目 录 结 构
					content += '<a  href="' + href + '" ' + target + ' menu-type="' + note.type + '" menu-id="' + note.id +
						'" ><i class="' + note.icon + '"></i><span>' + note.title +
						'</span></a>';
				} else if (note.type == 1) {
					// 创 建 菜 单 结 构
					content += '<a ' + target + ' class="' + className + '" menu-type="' + note.type + '" menu-url="' + note.href +
						'" menu-id="' + note.id +
						'" menu-title="' + note.title + '" href="' + href + '"><i class="' + note.icon +
						'"></i><span>' + note.title + '</span></a>';
				}
				content += loadchild(note);
				content += '</li>';
				menuItem += content;
			})
			menu += menuItem + '</ul>';
			control += controlItem;
		})
		controlItemPe += "</li></dl></ul>"
		controlPe += controlItemPe;
		$("#" + option.control).html(control + "</div>");
		$("#" + option.control).append(controlPe);
		$("#" + option.elem).html(menu);
		$("#" + option.control + " .pear-nav-control").on("click", "[pear-id]", function () {
			$("#" + option.elem).find(".pear-nav-tree").css({
				display: 'none'
			});
			$("#" + option.elem).find(".pear-nav-tree[pear-id='" + $(this).attr("pear-id") + "']").css({
				display: 'block'
			});
			$("#" + option.control).find(".pe-title").html($(this).attr("pear-title"));
			$("#" + option.control).find("")
			option.change($(this).attr("pear-id"), $(this).attr("pear-title"), $(this).attr("pear-href"))
		})
	}

	/** 加载子菜单 (递归)*/
	function loadchild(obj) {
		// 判 单 是 否 是 菜 单， 如 果 是 菜 单 直 接 返 回
		if (obj.type == 1) {
			return "";
		}
		// 创 建 子 菜 单 结 构
		var content = '<dl class="layui-nav-child">';
		// 如 果 嵌 套 不 等 于 空 
		if (obj.children != null && obj.children.length > 0) {
			// 遍 历 子 项 目
			$.each(obj.children, function (i, note) {
				// 创 建 子 项 结 构
				content += '<dd>';
				var href = "javascript:;";
				var target = "";
				var className = "site-demo-active";
				if (note.openType == "_blank" && note.type == 1) {
					href = note.href;
					target = "target='_blank'";
					className = "";
				}
				// 判 断 子 项 类 型
				if (note.type == 0) {
					// 创 建 目 录 结 构
					content += '<a ' + target + '  href="' + href + '" menu-type="' + note.type + '" menu-id="' + note.id +
						'"><i class="' + note.icon + '"></i><span>' + note.title + '</span></a>';
				} else if (note.type == 1) {
					// 创 建 菜 单 结 构
					content += '<a ' + target + ' class="' + className + '" menu-type="' + note.type + '" menu-url="' + note.href +
						'" menu-id="' + note.id + '" menu-title="' + note.title + '" menu-icon="' + note.icon + '" href="' + href +
						'" ><i class="' + note.icon + '"></i><span>' + note.title + '</span></a>';
				}
				// 加 载 子 项 目 录
				content += loadchild(note);
				// 结 束 当 前 子 菜 单
				content += '</dd>';
			});
			// 封 装
		} else {
			content += '<dd style="background-color: transparent!important;"><a style="background-color: transparent!important;margin-left: 26px">目录为空</a></dd>';
		}
		content += '</dl>';
		return content;
	}

	function downShow(option) {
		$("body #" + option.elem).on("click", "a[menu-type='0']", function () {
			if (!$("#" + option.elem).is(".pear-nav-mini")) {
				var superEle = $(this).parent();
				var ele = $(this).next('.layui-nav-child');
				var heights = ele.children("dd").length * 48;

				if ($(this).parent().is(".layui-nav-itemed")) {
					if (option.accordion) {
						var currentDom = $(this).parent().siblings('.layui-nav-itemed').children('.layui-nav-child');
						currentDom.animate({
							height: '0px'
						}, 240, function () {
							currentDom.css({
								height: "auto",
							});
							$(this).parent().removeClass("layui-nav-itemed");
							$(this).find('.layui-nav-itemed').removeClass("layui-nav-itemed");
						});
					}
					ele.height(0);
					ele.animate({
						height: heights + "px"
					}, 240, function () {
						ele.css({
							height: "auto"
						});
					});
				} else {
					ele.animate({
						height: "0px"
					}, 240, function () {
						ele.css({
							height: "auto"
						});
						$(this).parent().removeClass("layui-nav-itemed");
					});
				}
			}
		})
	}

	/** 二 级 悬 浮 菜 单*/
	function isHoverMenu(b, option) {
		if (b) {
			var navItem = "#" + option.elem + ".pear-nav-mini .layui-nav-item";
			var navChildDl = navItem + " .layui-nav-child>dl";
			var navChildDd = navItem + " .layui-nav-child>dd";

			$(navItem + "," + navChildDd).mouseenter(function () {
				var _this = $(this);
				_this.siblings().find(".layui-nav-child")
					.removeClass("layui-nav-hover").css({
						left: 0,
						top: 0
					});
				_this.children(".layui-nav-child").addClass("layui-nav-hover");
				var height = $(window).height();
				var topLength = _this.offset().top;
				var thisHeight = _this.children(".layui-nav-child").height();
				if ((thisHeight + topLength) > height) {
					topLength = height - thisHeight - 10;
				}
				var left = _this.offset().left + 60;
				if (!_this.hasClass("layui-nav-item")) {
					left = _this.offset().left + _this.width();
				}
				_this.children(".layui-nav-child").offset({
					top: topLength,
					left: left
				});
			});

			$(navItem + "," + navChildDl).mouseleave(function () {
				var _this = $(this);
				_this.closest('.layui-nav-item')
					.find(".layui-nav-child")
					.removeClass("layui-nav-hover")
					.css({
						left: 0,
						top: 0
					});
			});

		} else {
			$("#" + option.elem + " .layui-nav-item").off('mouseenter').unbind('mouseleave');
			$("#" + option.elem + " dd").off('mouseenter').unbind('mouseleave');
		}
	}

	function rationalizeHeaderControlWidth(option) {
		var $headerControl = $("#" + option.control);
		var $nextEl = $headerControl.next();
		var rationalizeWidth;
		if ($nextEl.length) {
			rationalizeWidth = $nextEl.position().left - $headerControl.position().left;
		} else {
			rationalizeWidth = $headerControl.parent().innerWidth() - $headerControl.position().left;
		}

		$("#" + option.control + " .control").css({"width": rationalizeWidth});

		var navobj = $("#" + option.control+' ul.pear-nav-control.pc');
		var dropdown = $(".tabdrop", navobj);

        var collection = 0;
        var maxwidth = rationalizeWidth - 60;

        var liwidth = 0;
        //检查超过一行的标签页
        $('.tabdrop').find('dd').each(function(){
        	var newLI = $('<li></li>').html($(this).html());
        	newLI.addClass('layui-nav-item');
            newLI.attr('pear-href', $(this).attr('pear-href'));
            newLI.attr('pear-title', $(this).attr('pear-title'));
            newLI.attr('pear-id', $(this).attr('pear-id'));
        	navobj.append(newLI);
        	$(this).remove();

        })
        var litabs = navobj.find('>li').not('.tabdrop');

        var totalwidth = 0;
        litabs.each(function () {
            totalwidth += $(this).outerWidth(true);
        });

        if (rationalizeWidth < totalwidth) {
            litabs.each(function () {
                liwidth += $(this).outerWidth(true);
                if (liwidth > maxwidth) {
                    var newDD = $('<dd></dd>').html($(this).html());
                    newDD.attr('pear-href', $(this).attr('pear-href'));
                    newDD.attr('pear-title', $(this).attr('pear-title'));
                    newDD.attr('pear-id', $(this).attr('pear-id'));
                    dropdown.find('dl').append(newDD);
                    collection++;
                    $(this).remove();
                }
            });
            if (collection > 0) {
                dropdown.removeClass('layui-hide');
                if (dropdown.find('.active').length === 1) {
                    dropdown.addClass('active');
                } else {
                    dropdown.removeClass('active');
                }
            }
        }else {
            dropdown.addClass('layui-hide');
        }
	}

	function rationalizeHeaderControlWidthAuto(option){
		$(window).on('resize', function () {
			rationalizeHeaderControlWidth(option);
		})

		$(document).ready(function () {
			rationalizeHeaderControlWidth(option);
		});
	}

	exports(MOD_NAME, new pearMenu());
})
