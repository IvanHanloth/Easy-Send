   //是否成功调用getUserMedia标识
   var gUM = false;
   //画布getContext对象
   var gCtx = null;
   // 数据流对象
   var imageData = null;
   //视频展示对象
   var v = document.getElementById("qr-video");
   var n = navigator;
   // 画布元素
   var gCanvas = document.getElementById("qr-canvas");
   gCtx = gCanvas.getContext('2d');
   qrcode.callback = function(e) {
           //结果回调
           alert(e);
       }
       //不同getUserMedia处理
   if (n.getUserMedia) {
       // 移动设备打开后置摄像头【 facingMode: "environment"】 
       n.getUserMedia({ video: { facingMode: "environment" } }, success, error);
   } else
   if (n.mediaDevices.getUserMedia) {
       n.mediaDevices.getUserMedia({ video: { facingMode: "environment" }, audio: false })
           .then(success)
           .catch(error);
   } else
   if (n.webkitGetUserMedia) {
       webkit = true;
       n.webkitGetUserMedia({ video: { facingMode: "environment" } }, success, error);
   } else
   if (n.mozGetUserMedia) {
       moz = true;
       n.mozGetUserMedia({ video: { facingMode: "environment" } }, success, error);
   }
   //getUserMedia调用成功
   function success(stream) {
       v = document.getElementById("qr-video");
       try {
           v.srcObject = stream;
       } catch {
           //这里是兼容写法
           let compatibleURL = window.URL || window.webkitURL;
           v.src = compatibleURL.createObjectURL(stream);
       }
       gUM = true;
       scan_timmer=setTimeout(captureToCanvas, 700);
   }
   //getUserMedia调用失败
   function error(error) {
       gUM = false;
       return;
   }

   //将视频流放到画布
   function captureToCanvas() {
       if (gUM) {
           gCtx.drawImage(v, 0, 0);

           scan_timmer=setTimeout(captureToCanvas, 700);

           imageData = gCtx.getImageData(0, 0, 800, 800);

           const code = jsQR(imageData.data, imageData.width, imageData.height, {
               inversionAttempts: "dontInvert",
           });
           if(code!=null){
               if(/^http+(?:s?)+:\/\//.test(code.data)){
                    clearTimeout(scan_timmer); 
                    window.location.href=code.data;
               }else{
                   alert(code.data);
               }
           }
       }

   }