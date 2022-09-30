/*
全局变量定义区
*/
room_info = 0;
all_blob = [];
save_lock = 1;
layui.use(function () {
	var form = layui.form,
		$ = layui.jquery,
		element = layui.element,
		layer = layui.layer;
	//监听提交
	form.on('submit(roombtn)', function (data) {
		$.ajax({
			//定义提交的方式
			type: "POST",
			//定义要提交的URL
			url: '/public/api/room_attend.php',
			//定义提交的数据类型
			dataType: 'json',
			async: true,
			//要传递的数据
			data: {
				"data": JSON.stringify(data.field),
				"step": "input"
			},
			//服务器处理成功后传送回来的json格式的数据
			success: function (res) {
				if(res.code == 200) {
					$("#room_input").addClass("layui-hide");
					$("#room_choose").removeClass("layui-hide");
					$("#room_info").removeClass("layui-hide");
					$("#room_roomid").html(res.roomid);
					if(res.type == "send") {
						mytype = "发送端"
					} else if(res.type == "receive") {
						mytype = "接收端"
					} else {
						mytype = "神秘人"
					}
					$("#room_type").html(mytype);
					$("#room_state").html(res.state)
					layer.msg(res.tip, {
						icon: 1
					});
					data_check()
				} else {
					if(res.code == 100) {
						layer.msg(res.tip, {
							icon: 2
						});
					} else {
						layer.msg("出现异常", {
							icon: 2
						})
					}
				}
			},
			error: function () {
				layer.msg('出现异常，请重试', {
					icon: 2
				});
			}
		});
		return false;
	});
	$("#room_choose_send").click(function () {
		$.ajax({
			//定义提交的方式
			type: "POST",
			//定义要提交的URL
			url: '/public/api/room_attend.php',
			//定义提交的数据类型
			dataType: 'json',
			async: true,
			//要传递的数据
			data: {
				"type": "send",
				"step": "choose"
			},
			//服务器处理成功后传送回来的json格式的数据
			success: function (res) {
				if(res.code == 200) {
					$("#room_choose").addClass("layui-hide");
					$("#room_send").removeClass("layui-hide");
					layer.msg(res.tip, {
						icon: 1
					})
				} else {
					layer.msg(res.tip, {
						icon: 2
					})
				}
			},
			error: function () {
				layer.msg('出现异常，请重试', {
					icon: 2
				});
			}
		});
	})
	$("#room_choose_receive").click(function () {
		$.ajax({
			type: "POST",
			url: '/public/api/room_attend.php',
			dataType: 'json',
			async: true,
			//要传递的数据
			data: {
				"type": "receive",
				"step": "choose"
			},
			//服务器处理成功后传送回来的json格式的数据
			success: function (res) {
				if(res.code == 200) {
					$("#room_choose").addClass("layui-hide");
					$("#room_receive").removeClass("layui-hide");
					room_receive()
					layer.msg(res.tip, {
						icon: 1
					})
				} else {
					layer.msg(res.tip, {
						icon: 2
					})
				}
			},
			error: function () {
				layer.msg('出现异常，请重试', {
					icon: 2
				});
			}
		});
	})
	$("#room_send_button_continue").click(function () {
		$("#room_choose").removeClass("layui-hide");
		$("#room_send").addClass("layui-hide");
	})
	$("#room_send_button").click(function () {
		$("#room_send_file").click();
		Send_Select()
	})
})

function Send_Select() {
	Send_Select_time = setTimeout(function () {
		if($("#room_send_file").val() == "") {
			Send_Select()
		} else {
			$("#room_send_button_confirm").removeClass("layui-hide")
			$("#room_send_file_info").removeClass("layui-hide")
			file = $("#room_send_file")[0].files[0]
			name = file.name
			if(name.length > 11) {
				name = name.substr(0, 11) + "…"
			}
			size = (file.size / (1024 * 1024)).toFixed(2)
			$("#room_send_file_name").html(name)
			$("#room_send_file_size").html(size)
			clearTimeout(Send_Select_time)
		}
	}, 100)
}

function room_upload(index) {
	layui.use(function () {
		layer = layui.layer
		element = layui.element
		if(index == 0) {
			layer.msg("正在发送…", {
				icon: 21,
				time: 2000
			})
			clearTimeout(statetime)
			data_check()
			$("#room_send_sending").removeClass("layui-hide")
			$("#room_send_connected").addClass("layui-hide")
		}
		sliceSize = (1024 * 1024) * 0.5; //切片0.5M
		xhr = new XMLHttpRequest();
		const file = $("#room_send_file")[0].files[0]
		const name = file.name
		const size = file.size
		const total = Math.ceil(size / sliceSize)
		start = index * sliceSize
		end = start + sliceSize
		if(start >= size) {
			clearTimeout(statetime)
			data_check()
			$("#room_send_connected").addClass("layui-hide")
			$("#room_send_sending").addClass("layui-hide")
			$("#room_send_finish").removeClass("layui-hide")
			layer.msg("直传成功", {
				icon: 1,
				shade: 0.3,
				time: 2000
			})
			return true
		}
		if(end >= size) {
			end = size
		}
		progress = Number((end / size).toFixed(2)) * 100 + "%"
		blob = file.slice(start, end)
		sliced = new File([blob], index + name)
		form = new FormData()
		form.append("file", sliced)
		form.append("index", index + 1)
		form.append("total", total)
		form.append("size", size)
		form.append("origin", name)
		xhr.open("post", "/public/api/room_upload.php", true) //发送请求
		xhr.send(form) //携带集合    
		xhr.onreadystatechange = function () {
			if(this.readyState === 4 && this.status === 200) {
				element.progress("room_progress", progress)
				room_upload(index + 1);
			}
		};
	})
}

function data_check() {
	statetime = setTimeout(function () {
		$.getJSON("/public/api/room_info.php", function (data) {
			$("#room_roomid").html(data.roomid);
			if(data.type == "send") {
				mytype = "发送端"
			} else if(data.type == "receive") {
				mytype = "接收端"
			} else {
				mytype = "神秘人"
			}
			$("#room_type").html(mytype);
			$("#room_state").html(data.state)
			if($("#room_qrcode").attr("src")!=data.qrcode){
				$("#room_qrcode").attr("src",data.qrcode)
			}
			if(data.type == "send") {
				if(data.state == "connected" && $("#room_send_file").val() == "") {
					$("#room_send_connected").removeClass("layui-hide")
					$("#room_send_finish").addClass("layui-hide")
					$("#room_send_sending").addClass("layui-hide")
				} else if(data.state == "sending") {
					$("#room_send_finish").addClass("layui-hide")
					$("#room_send_connected").addClass("layui-hide")
					$("#room_send_sending").removeClass("layui-hide")
				} else if(data.state == "send-finish" || data.state == "finish") {
					$("#room_send_connected").addClass("layui-hide")
					$("#room_send_sending").addClass("layui-hide")
					$("#room_send_finish").removeClass("layui-hide")
				}
			} else if(data.type == "receive") {
				if(data.state == "connected") {
					$("#room_receive_connected").removeClass("layui-hide")
					$("#room_receive_finish").addClass("layui-hide")
					$("#room_receive_sending").addClass("layui-hide")
					localforage.clear()
				} else if(data.state == "sending") {
					$("#room_receive_finish").addClass("layui-hide")
					$("#room_receive_connected").addClass("layui-hide")
					$("#room_receive_sending").removeClass("layui-hide")
				} else if(data.state == "finish") {
					$("#room_receive_connected").addClass("layui-hide")
					$("#room_receive_sending").addClass("layui-hide")
					$("#room_receive_finish").removeClass("layui-hide")
				} else if(data.state == "send-finish") {
					$("#room_receive_connected").addClass("layui-hide")
					$("#room_receive_sending").addClass("layui-hide")
					$("#room_receive_finish").removeClass("layui-hide")
				}
			}
			room_info = data;
		})
		data_check()
	}, 3000);
}
    function update(version_num){
        layui.use(function(){
            var layer=layui.layer
            layer.prompt({title:"请输入后台密码以确认升级",formType: 1},function(value, index, elem){
                layer.close(index);
                layer.msg("正在提交……",{icon:22,time:2000,shade:0.3})
                $.ajax({
                    type:"POST",
                    url:"/admin/api/update_action.php",
                    data:{"password":value,"version_num":version_num},
                    success:function(res){
                        if(res.code==200){
                            layer.msg(res.tip,{icon:1,shade:0.3,time:0})
                        }else{
                            layer.msg(res.tip,{icon:2,shade:0.3,time:2000})
                        }
                    },
                    error:function(){
                        layer.msg("服务器出现错误，请检查/admin/api/update_action.php",{icon:2,shade:0.3,time:2000})
                    }
                })
                });
        })
    }
    $("#total-reinstall").click(function(){
        console.log("a")
            $.getJSON("/admin/api/update_info.php/?type=info",function(res){
                update(res.newest_version_num)
            })
        })
    layui.use(function () {
        var form = layui.form
            , layer = layui.layer
            , element = layui.element;
            $("#update_get_btn").click(function(){
                layer.msg("正在获取更新信息",{icon:22,time:2000,shade:0.3})
                $.getJSON("/admin/api/update_info.php/?type=info",function(res){
                    $("#update_info").removeClass("layui-hide")
                    $("#now_version").html(res.now_version)
                    $("#newest_version").html(res.newest_version)
                    if(res.info.length!=0){
                        res.info.forEach(function(value){
                            $("#version_info").append('<div class="layui-colla-item"><h2 class="layui-colla-title">'+value.version+'</h2><div class="layui-colla-content layui-show"><p><span>更新时间：</span>'+value.time+'</p><p><span>更新内容：</span>'+value.description+'</p><button class="layui-btn layui-btn-normal" onclick="update('+value.version_num+'")>更新至此版本</button></div></div>')
                        })
                    }else{
                        $("#version_info").append('<div class="layui-colla-content layui-show"><strong>恭喜，您的程序处于最新版本，并不需要更新</strong></div>')
                    }
                    
                    $("#version_info").append('<div class="layui-colla-content layui-show">您也可以选择重装本程序<br><button class="layui-btn layui-btn-danger" id="total-reinstall" type="button">完全重装</button></div>')
                })
            })
            

            $("#update_log_get").click(function(){
                layer.msg("正在获取日志信息",{icon:22,time:2000,shade:0.3})
                $.getJSON("/admin/api/update_info.php/?type=log",function(res){
                    $("#update_log").removeClass("layui-hide")
                    if(res.log.length!=0){
                        res.log.forEach(function(value){
                            $("#version_log").append('<div class="layui-colla-item"><h2 class="layui-colla-title">'+value.version+'</h2><div class="layui-colla-content layui-show"><p><span>更新时间：</span>'+value.time+'</p><p><span>更新内容：</span>'+value.description+'</p></div></div>')
                        })
                    }else{
                        $("#version_log").append('<div class="layui-colla-content layui-show">获取失败！</div>')
                    }
                })
            })

    });
function room_receive() {
	room_receive_time = setTimeout(function () {
		$.getJSON("/public/api/room_download.php", function (data) {
			if(room_info.state == "waiting" || room_info.state == "connected") {
				all_blob = [];
				localforage.clear().then(function () {
					save_lock = 1;
				}).catch(function (err) {
					console.log(err)
				})
			} else {
				if(data.code != 100) {
					data.forEach(function (content, index) {
						localforage.getItem(String(content.num), function (err, value) {
							if(value == null) {
								var xhr = new XMLHttpRequest();
								xhr.open("GET", content.url, true); //open false 是同步请求，不会异步触发
								xhr.responseType = 'blob';
								xhr.onload = function () {
									localforage.setItem(String(content.num), xhr.response)
								};
								xhr.send();
							} else {
								localforage.length().then(function (length) {
									if(length == room_info.total) {
										function blob_save(index) {
											layui.use(function () {
												var layer = layui.layer
												if(index == "lock") {} else {
													if(index > room_info.total) {
														save_blob = new Blob(all_blob);
														if(window.navigator.msSaveOrOpenBlob) {
															navigator.msSaveBlob(save_blob, room_info.origin);
														} else {
															var link = document.createElement('a');
															var body = document.querySelector('body');
															link.href = window.URL.createObjectURL(save_blob);
															link.download = room_info.origin;
															// fix Firefox 
															link.style.display = 'none';
															body.appendChild(link);
															link.click();
															body.removeChild(link);
															window.URL.revokeObjectURL(link.href);
														};
														$.ajax({
															type: "POST",
															url: "/public/api/room_download.php",
															data: {
																"state": "finish"
															},
															success: function (res) {
																layer.msg("直传完成", {
																	icon: 1,
																	time: 2000,
																	shade: 0.3
																})
																localforage.clear()
																clearTimeout(statetime)
																data_check()
															},
															error: function () {
																layer.msg("直传出错", {
																	icon: 2,
																	time: 2000,
																	shade: 0.3
																})
																clearTimeout(statetime)
																data_check()
															}
														})
													} else {
														localforage.getItem(String(index)).then(function (value) {
															//all_blob.push(value);
															all_blob[Number(index)] = value
															blob_save(index + 1);
														}).catch(function (err) {
															// 当出错时，此处代码运行
															console.log(err)
														});
													}
												}
											})
										}
										blob_save(save_lock)
										save_lock = "lock"
									}
								})
							}
						})
					})
				}
			}
		})
		room_receive()
	}, 1500)
}
