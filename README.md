<p align="center">
 
 <img src="https://ivan.hanloth.cn/usr/uploads/2022/08/Easy-Send-logo-1.png" style="width:30%">  
<br><img src="https://img.shields.io/github/v/release/IvanHanloth/Easy-Send">
<img src="https://img.shields.io/badge/License-MIT-green">
</p>


## 简介
一个简易的用于跨设备、跨平台传输文件或文本的程序。
## 演示站
https://send.hanloth.cn/
https://send.o5g.top/
## 环境依赖
PHP 5.6+  MySQL 5.5+
## 功能
* 上传文件、文本至服务器临时保存
* 通过提取码提取临时存储的文本
* 定时、定次自动删除过期数据
* 多端适用，网站自适应
## 使用方法
* 上传源码至根目录
* 访问install目录一键安装
* 如需实现文件过期自动清理，需监控以下网址:域名/cron.php（频率1分钟/次-5分钟/次）
## 注意！
* 升级请先删除install/install.lock文件，备份好数据再进行
* 使用v2.2以上版本，提取文件时只能通过"立即下载"按钮进行下载，且在部分国产浏览器中会出问题(使用app端可解决)
## 演示
![](https://ivan.o5g.top/usr/uploads/2022/08/Easy-Send-preview-1.PNG)
![](https://ivan.o5g.top/usr/uploads/2022/08/Easy-Send-preview-2.PNG)
![](https://ivan.hanloth.cn/usr/uploads/2022/08/Easy-Send-preview-3.png)
## ToDo
 - [x] 自定义文件大小限制
 - [x] 提取时禁止输入空格
 - [x] 自动识别提取码
 - [x] 二维码分享
 - [x] 一键安装
 - [x] 优化文本存储机制
 - [x] APP开发
 - [ ] 新增模板
## 联系作者
* QQ:1580272392
* Email:ivan@hanloth.com
* Blog:https://ivan.hanloth.cn/（https://ivan.o5g.top/）
## 引用
程序中使用了layui框架中的部分模块
## 更新日志
#### V2.2 (更新于2022/8/21)
- 新增自动获取域名功能
- 新增APP端(见IvanHanloth/Easy-Send-App-Mobile)
- 修复部分文件上传漏洞
- 修复剩余次数不会自动减少的问题
- 优化提取码验证机制
#### V2.1 (更新于2022/5/3)
- 新增后台管理功能
- 修复网站设置难以更改问题
#### V2.0（更新于2022/5/1）
- 新增一键安装功能
- 新增文本文件化存储功能
- 新增环境依赖检测功能
- 优化文件及文本存储机制
- 配置文件改为数据库存储
#### V1.3（更新于2022/4/23）
- 新增提取页面二维码功能
- 新增直接传入key功能
- 新增robot.txt
- 新增自定义文件上传大小限制、文本上传大小限制
- 新增提取码输入框禁止输入空格功能
- 新增过期文件延缓删除功能
- 修复文件达到查看次数时，最后一次无法访问的Bug
- 优化部分代码命名
#### V1.2（更新于2022/4/16）
- 全面重构目录结构，便于后续开发
- 新增模板设置功能
- 新增对于多平台客户端的适配
- 新增自定义文件过期时间
- 修复sql不区分大小写查询的问题
- 合并原按功能分类的js
#### V1.1（更新于2022/4/11）
- 修复监控无效问题
- 修复上传失败返回状态码“200”导致提示出错问题
- 新增自定义文件可查看次数功能
- 新增文件分月存储功能


<p align="center">
<img src="https://ivan.hanloth.cn/usr/uploads/2022/08/Easy-Send-logo-2.png" style="width:30%">  
</p>
