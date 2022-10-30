<p align="center">

 

 <img src="https://ivan.hanloth.cn/usr/uploads/2022/08/Easy-Send-logo-1.png" style="width:40%">  

<br><img src="https://img.shields.io/github/v/release/IvanHanloth/Easy-Send">

<img src="https://img.shields.io/badge/License-MIT-green">

</p>

## 简介

一个简易的用于跨设备、跨平台传输文件或文本的程序。

## 演示站

https://send.hanloth.cn/

https://send.o5g.top/

## 测试站

https://test.send.o5g.top/

https://test.send.o5g.top/admin

## 环境依赖

PHP 7.0+  MySQL 5.5+ 

## 推荐环境

PHP 7.3 MySQL 5.6 Nginx 

## PHP依赖

session、curl、fileinfo、ZipArchive、

## 功能

* 上传文件、文本至服务器临时保存

* 文件直传

* 通过提取码提取临时存储的文本

* 定时、定次自动删除过期数据

* 多端适用，网站自适应

## 使用方法

* 上传源码至根目录

* 配置权限755以上

* 访问install目录一键安装

* 配置伪静态

* 如需实现文件过期自动清理，需监控以下网址:域名/cron.php（频率1分钟/次-5分钟/次）

## 注意！

* 从V2升级至V3需要完全覆盖网站目录，重新配置各项设置(即完全重装)

* 使用v2.2以上版本，提取文件时只能通过"立即下载"按钮进行下载，且在部分国产浏览器中会出问题(使用app端可解决)

* v3.0以上版本需要配置伪静态方能使用，参见根目录下的安装说明

* v3.0以上版本支持文件伪直传，该功能会耗费流量及服务器资源

* v3.0以上版本支持文件伪直传，该功能需要浏览器支持localStorage和blob下载(与提取文件时状况相同，部分国产浏览器如UC、夸克、QQ等均无法正常使用)

## 演示

![](https://ivan.o5g.top/usr/uploads/2022/08/Easy-Send-preview-1.PNG)

![](https://ivan.o5g.top/usr/uploads/2022/08/Easy-Send-preview-2.PNG)

![](https://ivan.o5g.top/usr/uploads/2022/08/Easy-Send-preview-3.png)

## ToDo

 - [x] 二维码分享

 - [x] 一键安装

 - [x] APP开发

 - [x] 新增模板

 - [x] 在线更新

 - [x] 文件直传

 - [ ] 用户中心

 - [ ] 对接七牛云

## 联系作者

* QQ:1580272392

* Email:ivan@hanloth.com

* Blog:https://ivan.hanloth.cn/  （ https://ivan.o5g.top/ ）

* 交流群:390108536(QQ群)

## 引用

* 使用了layui框架中的部分模块

* 使用了localForage模块进行离线存储

* 使用了layuimini作为后台框架

* blue模板使用了shuyudao/wenchuan开源项目的视觉设计

## 文档

- Easy-Send帮助文档（http://doc.o5g.top/docs/easy-send-docs-use/ ），适合用户阅读

- Easy-Send说明文档（http://doc.o5g.top/docs/easy-send-docs-help/ ），适合网站主、管理人员阅读

- Easy-Send开发文档（http://doc.o5g.top/docs/easy-send-docs-develop/ ），适合开发者、程序员阅读

## 更新日志

#### V3.0.1（更新于2022/10/29）

- 新增后台强制修改密码

- 修复了一键安装出错的问题

- 修复了配套客户端无法加入直传的问题

#### V3.0.0（更新于2022/10/1）

- 对于项目进行了重构

- 新增文件直传功能

- 新增二维码懒加载

- 新增windows电脑端(见IvanHanloth/Easy-Send-APP-PC)

- 后台新增客户端配置

- 后台新增网站公告配置

- 后台新增SEO优化配置

- 后台新增工具箱功能

- 后台新增数据管理功能

- 后台新增在线升级功能

- 优化后台视觉设计

- 优化模板开发流程，缩短开发时间

- 修复文件继续上传不显示本地文件信息的问题

- 修复文件在提取一次后剩余时间仅有15分钟的问题

- 修复部分机型模板显示错误的问题

- 修复前端无法获取header和footer代码的问题

- 修复一键安装显示出错问题

- 修复部分接口数据类型返回错误问题

- 修复文件多重引用路径出错问题

#### V2.2.2 (更新于2022/9/7)

- 新增一套模板（blue）

- 优化提取码显示

#### V2.2.1 (更新于2022/8/28)

- 新增文件直链下载功能

- 修复利用文件链接突破下载次数限制的问题

- 优化文件下载体验

#### V2.2 (更新于2022/8/21)

- 新增自动获取域名功能

- 新增APP端(见IvanHanloth/Easy-Send-App-Mobile)

- 修复部分文件上传漏洞

- 修复剩余次数不会自动减少的问题

- 修复后台无法保存footer的问题

- 修复后台自定义header和footer显示出错的问题

- 优化提取码验证机制

- 优化安装机制(使用IvanHanloth/php-installer v1.1版本)

- 优化数据保护机制

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

