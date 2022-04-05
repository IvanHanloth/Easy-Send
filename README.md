# 在线剪贴板
Online-ClipBoard
## 简介
一个简易的用于跨设备、跨平台传输文件或文本的程序。
## 演示站
https://send.hanloth.cn/
## 环境依赖
PHP 5.6+、MySQL 5.5+
#演示
![](https://img.hanloth.cn/?/images/2022/04/05/1bRPxMEqYW/Screenshot_2022_0405_163158.png)
![](https://img.hanloth.cn/?/images/2022/04/05/HrjBW6rSOD/Screenshot_2022_0405_163231.png)
![](https://img.hanloth.cn/?/images/2022/04/05/YMyWWon3Hu/Screenshot_2022_0405_163247.png)
![](https://img.hanloth.cn/?/images/2022/04/05/fai11szkt6/Screenshot_2022_0405_172041.png)
![](https://img.hanloth.cn/?/images/2022/04/05/YAaLQcHSiK/Screenshot_2022_0405_163449.png)
## 使用方法
上传源码至根目录，导入install目录下data.sql至数据库并填写config.php即可。
如需实现文件过期自动清理，需监控以下网址:
域名/cron.php
推荐监控网站:https://yrw.hanloth.cn
## 引用
程序中使用了layui框架中的部分模块
