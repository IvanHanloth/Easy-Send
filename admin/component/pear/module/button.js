layui.define(['jquery'], function(exports) {
	"use strict";

	/**
	 * Button component
	 * */
	var MOD_NAME = 'button',
		$ = layui.jquery;

	var button = function(opt) {
		this.option = opt;
	};

    /**
	 * Button start loading
	 * */
	button.prototype.load = function(opt) {
		
		var option = {
			elem: opt.elem,
			time: opt.time ? opt.time : false,
			done: opt.done ? opt.done : function(){}
		}
		var text = $(option.elem).html();
		
		$(option.elem).html("<i class='layui-anim layui-anim-rotate layui-icon layui-anim-loop layui-icon-loading'/>");
		
		$(option.elem).attr("disabled", "disabled");
		
		var buttons = $(option.elem);
		
		if (option.time != "" || option.time !=false) {
			setTimeout(function() {
				$(option.elem).attr("disabled", false);
				buttons.html(text);
				option.done();
			}, option.time);
		}
		option.text = text;
		return new button(option);
	}
	
	/**
	 * Button stop loaded
	 * */
	button.prototype.stop = function(success) {
		$(this.option.elem).attr("disabled", false);
		$(this.option.elem).html(this.option.text);
		success && success();
	} 

	exports(MOD_NAME, new button());
});
