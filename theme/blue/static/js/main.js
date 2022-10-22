
/*
By Ivan Hanloth
Easy-Send
Github:https://github.com/IvanHanloth/Easy-Send
Gitee:https://gitee.com/IvanHanloth/Easy-Send
2022/10/16
*/function planecss(member) {
	if(document.body.clientWidth < 600) {
		member.attr("style", "margin-left:" + parseInt(document.body.clientWidth * 0.94) / 2 * -1 + "px")
	}
}
$("#send-tab").click(function () {
	$("#send-box").removeClass("layui-hide")
	$("#send-tab").addClass("layui-hide")
})
$('.close').click(function () {
	$(".panel").removeClass("layui-show")
	$("#fixed").removeClass("layui-show")
	$("#file-panel-choose").css("display", "block")
	$("#file-panel-send").addClass("layui-hide")
	$("#file-panel-room").addClass("layui-hide")
})
$("#file-tab").click(function () {
	$("#file_panel").addClass("layui-show")
	$("#fixed").addClass("layui-show")
	planecss($("#file_panel")); //校正样式
})
$("#text-tab").click(function () {
	planecss($("#text_panel")); //校正样式
	$("#text_panel").addClass("layui-show")
	$("#fixed").addClass("layui-show")
})
$("#get-tab").click(function () {
	planecss($("#get_panel")); //校正样式
	$("#get_panel").addClass("layui-show")
	$("#fixed").addClass("layui-show")
	$("#send-tab").removeClass("layui-hide")
	$("#send-box").addClass("layui-hide")
})
$("#file-panel-choose-send").click(function () {
	$("#file-panel-choose").css("display", "none")
	$("#file-panel-send").removeClass("layui-hide")
})
$("#file-panel-choose-room").click(function () {
	$("#file-panel-choose").css("display", "none")
	$("#file-panel-room").removeClass("layui-hide")
})
