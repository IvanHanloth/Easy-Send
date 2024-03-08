<p align="center">
 
  <img src="https://ivan.hanloth.cn/usr/uploads/2022/08/Easy-Send-logo-1.png" style="width:40%">
<br><img src="https://img.shields.io/github/v/release/IvanHanloth/Easy-Send">
<img src="https://img.shields.io/badge/License-MIT-green">
</p>


## Language selection (选择其他语言)
[简体中文](https://ivanhanloth.github.io/Easy-Send/)
[English](https://github.com/IvanHanloth/Easy-Send/blob/main/README-en.md)

## Introduction

A simple program for transferring files or text across devices and platforms.

## About this README

We mainly maintain the Simplified Chinese version of the README. Other languages are translated by Google. If there are any inaccuracies in translation, please understand.

## Demo site

https://send.hanloth.cn/

https://send.o5g.top/

## Test Station

https://test.send.hanloth.cn/

https://test.send.hanloth.cn/admin

## Environment dependencies

PHP 7.0+ MySQL 5.5+

## Recommended environment

PHP 7.3 MySQL 5.6 Nginx

## PHP dependencies

session, curl, fileinfo, ZipArchive, MySQL Native Driver

## Function

* Upload files and texts to the server for temporary storage
* Direct file transfer
* Extract temporarily stored text through extraction code
* Automatically delete expired data at regular intervals and at regular intervals
* Applicable to multiple terminals, website adaptive

## Instructions

* Upload the source code to the root directory
* Configuration permissions above 755
* Visit the install directory to install with one click
* Configure pseudo-static
* If you want to realize automatic cleaning of expired files and room destruction, you need to monitor the following URL: domain name/cron.php (frequency 1 minute/time-5 minutes/time) (it is recommended to use https://yrw.hanloth.cn/ URL monitoring function )
* For detailed usage, please view the Easy-Send documentation (http://doc.hanloth.cn/docs/easy-send-docs-help/)

## Notice!

* Upgrading from V2 to V3 requires complete coverage of the website directory and reconfiguration of various settings (i.e. complete reinstallation)
* When using version v2.2 or above, you can only download files through the "Download Now" button, and there will be problems in some domestic browsers (this can be solved by using the app, which provides browser compatibility detection. Use a third party This problem does not occur with cloud storage)
* Versions v3.0 and above need to configure pseudo-static before they can be used. Please refer to the installation instructions in the root directory.
*v3.0 or above supports pseudo-direct file transfer. This function will consume traffic and server resources.
* v3.0 or above supports pseudo-direct file transfer. This function requires the browser to support localStorage and blob download (the same situation as when extracting files, some domestic browsers such as UC, Quark, QQ, etc. cannot be used normally)

## Demo

![image.png](https://ivan.hanloth.cn/usr/uploads/2022/12/3241990972.png)

![](https://ivan.hanloth.cn/usr/uploads/2023/01/940968649.png)
![image.png](https://ivan.hanloth.cn/usr/uploads/2022/12/1407648030.png)
![image.png](https://ivan.hanloth.cn/usr/uploads/2022/12/1878165295.png)
![image.png](https://ivan.hanloth.cn/usr/uploads/2022/12/3474609757.png)
![image.png](https://ivan.hanloth.cn/usr/uploads/2022/12/618709812.png)
![image.png](https://ivan.hanloth.cn/usr/uploads/2023/01/2167890129.png)

## ToDo

  - [x] Online updates
  - [x] Direct file transfer
  - [x] User Center
  - [x] Connect with Qiniuyun
  - [x] Click to copy the extraction code
  - [ ] Optimization of direct file transfer
  - [ ] Add email verification


## Contact the author

QQ:1580272392

Email:ivan@hanloth.com

Blog:https://ivan.hanloth.cn/（https://ivan.o5g.top/）

Communication group: 390108536 (QQ group)

TG group: https://t.me/IHopensource

## Quote

* Uses some modules in the layui framework
* Used the localForage module for offline storage
* Used pear Admin as the background framework
* Used php-captcha as the verification code generator
* Used jquery.qrcode.js as the front-end QR code generator
* Use clipboard.js as a foreground text copy auxiliary
* The blue template uses the visual design of the shuyudao/wenchuan open source project

## document

- Easy-Send help document (http://doc.hanloth.cn/docs/easy-send-docs-use/), suitable for users to read
- Easy-Send documentation (http://doc.hanloth.cn/docs/easy-send-docs-help/), suitable for website owners and managers to read
- Easy-Send development documentation (http://doc.hanloth.cn/docs/easy-send-docs-develop/), suitable for developers and programmers to read

## Update log

**V3.4.1 (updated 2024/3/9)**

- [Fix] the issue that monitoring files could not delete expired room data
- [Fix] the issue of direct join error
- [Fix] the issue of saving file header error in direct receiver
- [Fix] file server storage database error issue
- [Fix] Error problem of uploads text and files after opening custom time

**V3.4.0 (updated on 2024/2/10)**

Spring is here again, and Ivan Hanloth is here to wish everyone a happy New Year! This update will greatly improve the security and compatibility of the program. It is recommended to update as soon as possible!
- [New] Full screen upload function
- [New] Backstage verification code
- [New] Front desk global translation
- [New] theme quarter
- [New] Background offline update function
- [Fix] Announcement cannot contain carriage returns, etc.
- [Fix] The problem that files cannot be searched in the background
- [Fix] File download compatibility issue
- [Fix] The problem that the upload method cannot be switched after selecting Qiniu Cloud
- [Fix] The problem of delayed file selection in direct transfer
- [Fix] The problem of position offset of mouse hover text in user center
- [Fix] The problem of incorrect data acquisition through direct transmission from the user center
- [Fix] The problem that the Blue theme code scanning switch fails
- [Optimization] When the front desk announcement pops up
- [Optimization] Direct transfer room exit time
- [Optimization] Use prepared statements for database connections to prevent SQL injection
- [Optimization] Backend home page access speed
- [Optimization] Backend style, migrated to Pear Admin
- [Change] The QR code generation method is changed to front-end direct generation.

**V3.3.1 (updated on 2023/1/20)**

The new year is coming, Ivan Hanloth brings a new theme to wish everyone a happy new year.

- [New] Added New Year theme and new mimic theme
- [New] Added user center loading animation
- [Optimization] The main and secondary colors of the theme are changed to variable calls

**V3.3.0 (updated on 2023/1/1)**

New year new life. On New Year's Day, Ivan Hanloth wishes everyone a happy New Year, good health, all the best, and smooth work!

- [New] Connect to Qiniu Cloud Object Storage
- [New] Customized extraction times and expiration time functions
- [New] Website grayscale function
- [New] Background data monitoring page
- [New] Extract code click and copy function
- [New] Direct transmission status change reminder function
- [Optimization] Background theme modification process
- [Optimization] Shorten the display time of some prompts
- [Optimization] Direct transmission room exit speed
- [Optimization] Details of each theme and template have been adjusted
- [Optimization] Adjust the style name in the template to prevent conflicts with the theme
- [Fix] File upload status reset error issue
- [Fix] There may be an issue where the user center border is wrong
- [Fix] The problem that some prompt icons display incorrectly

**V3.2.0 (updated on 2022/11/27)**

- Added user functions
- Added QR code scanning function
- Fixed the problem of background text data statistics error
-Fixed the problem of background error reporting
- Fixed the problem of error in modifying the extraction code length in the background
- Fixed the issue where some functions cannot be turned off due to invalid background switch
- Optimized error prompts
- Optimized the reference of static resources
- Optimize the visual design of default theme (default) and orange theme

**V3.1.3 (updated on 2022/11/23)**

-Fixed the problem of error reporting in background online update
-Fixed the problem that the upgrade program could not decompress files

**V3.1.2 (updated on 2022/11/22)**

- Added new file direct transfer room destruction mechanism (depends on monitoring file cron.php)
- Added the function of direct file transfer to exit the room
- Added a new theme (Orange), although it just changed the color
- Added instructions for direct file transfer
- Added "File Upload" function in the background
- Optimize the visual design of default theme and add Tab icon
- Fixed the issue where direct file transfer was successful but displayed as failed
- Fixed some button color errors
**V3.1.1 (updated on 2022/11/12)**

- Fixed an issue where the upgrade would not automatically delete the original upgrade files
- Fixed the problem that the previously generated extraction code becomes invalid after the extraction code length is modified.
- Fixed the problem of unable to download files normally after update
- Fixed the problem of "Check Compatibility" button jumping error
- Optimize the display of file direct transfer type selection button

**V3.1.0 (updated on 2022/11/12)**

- Added extraction code length and type customization
- Added client download page
- Added multiple client promotion positions
- Added browser compatibility check
- Fixed the problem of invalid monitoring files
- Fixed the problem that deleting data in the background would not delete files
- Fixed the problem that online updates could not work properly
- Fixed issues such as being unable to decompress files on the upgrade page.
- Optimize error feedback mechanism
- Optimize the display of extraction codes to avoid the appearance of characters that are difficult to distinguish

**V3.0.1 (updated on 2022/10/29)**

- Added background forced password change
- Fixed the problem of one-click installation error
- Fixed the problem that the supporting client cannot join the direct transmission

**V3.0.0 (updated on 2022/10/1)**

- Refactored the project
- Added file direct transfer function
- Added QR code lazy loading
- Added Windows computer version (see IvanHanloth/Easy-Send-APP-PC)
- Added client configuration in the background
- Added website announcement configuration in the background
- Added SEO optimization configuration in the background
- Added toolbox function in the background
- Added new data management functions in the background
- Added online upgrade function in the background
- Optimize background visual design
- Optimize template development process and shorten development time
- Fixed the issue where local file information is not displayed when files continue to be uploaded
- Fixed the issue where the remaining time after extracting a file is only 15 minutes
- Fixed the problem of template display error for some models
- Fixed the problem that the front end cannot obtain header and footer codes
- Fixed one-click installation display error issue
- Fixed the problem of some interface data types returning errors
- Fixed the problem of multiple file reference paths error

**V2.2.2 (updated on 2022/9/7)**

- Added a new set of templates (blue)
- Optimize extraction code display

**V2.2.1 (updated on 2022/8/28)**

- Added file direct link download function
- Fixed the problem of using file links to exceed the download limit
- Optimize file download experience

**V2.2 (updated on 2022/8/21)**

- Added the function of automatically obtaining domain names
- Added APP (see IvanHanloth/Easy-Send-App-Mobile)
- Fixed some file upload bugs
- Fixed the problem that the remaining times would not be automatically reduced
- Fixed the problem of unable to save footer in the background
- Fixed the issue of background custom header and footer display errors
- Optimize the extraction code verification mechanism
- Optimize the installation mechanism (using IvanHanloth/php-installer v1.1 version)
- Optimize dataprotection mechanism

**V2.1 (updated on 2022/5/3)**

- Added backend management function
- Fixed the problem that website settings are difficult to change

**V2.0 (updated on 2022/5/1)**

- Added one-click installation function
- Added text file storage function
- Added environment dependency detection function
- Optimize file and text storage mechanism
- Configuration file changed to database storage

**V1.3 (updated on 2022/4/23)**

- Added the function of extracting page QR code
- Added the function of directly passing in the key
- Added robot.txt
- Added custom file upload size limit and text upload size limit
- Added the function of prohibiting the input of spaces in the extraction code input box
- Added function to delay deletion of expired files
- Fixed the bug that the file cannot be accessed for the last time when the number of views has been reached.
- Optimize some code naming

**V1.2 (updated on 2022/4/16)**

- Comprehensive reconstruction of the directory structure to facilitate subsequent development
- Added template setting function
- Added adaptation for multi-platform clients
- Added custom file expiration time
- Fixed the problem of sql case-insensitive query
- Merge js originally classified by function

**V1.1 (updated on 2022/4/11)**

- Fixed the problem of invalid monitoring
- Fixed the problem of error prompt when upload failed and returned status code "200"
- Added the function of customizing the number of times a file can be viewed
- Added file storage function by month


<p align="center">
<img src="https://ivan.hanloth.cn/usr/uploads/2022/08/Easy-Send-logo-2.png" style="width:30%">
</p>
