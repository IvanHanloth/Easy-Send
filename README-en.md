<p align="center">
 
 <img src="https://ivan.hanloth.cn/usr/uploads/2022/08/Easy-Send-logo-1.png" style="width:40%">
<br><img src="https://img.shields.io/github/v/release/IvanHanloth/Easy-Send">
<img src="https://img.shields.io/badge/License-MIT-green">
</p>


## Language selection (语言选择)
[简体中文](https://ivanhanloth.github.io/Easy-Send/)
[English](https://github.com/IvanHanloth/Easy-Send/blob/main/README-en.md)
## Introduction
A simple program for transferring files or text across devices and platforms.
## About this README
We mainly maintain the Simplified Chinese version of README, other languages ​​are translated by Google, please understand if the translation is not in place
## Demo Station
https://send.hanloth.cn/
https://send.o5g.top/
## Test Station
https://test.send.o5g.top/
https://test.send.o5g.top/admin
## Environment dependencies
PHP 7.0+ MySQL 5.5+
## Recommended environment
PHP 7.3 MySQL 5.6 Nginx
## PHP dependencies
session, curl, fileinfo, ZipArchive
## Function
* Upload files and texts to the server for temporary storage
* File direct upload
* Extract the temporarily stored text by extracting the code
* Automatically delete expired data regularly and regularly
* Multi-terminal application, website adaptive
## Instructions
* Upload the source code to the root directory
* Configuration permissions above 755
* Visit the install directory for one-click installation
* Configure pseudo-static
* If you need to automatically clean up expired files and destroy rooms, you need to monitor the following URL: domain name/cron.php (frequency 1 minute/time-5 minutes/time)
* For detailed usage, please refer to the Easy-Send documentation (http://doc.o5g.top/docs/easy-send-docs-help/)
## Notice!
* Upgrading from V2 to V3 needs to completely overwrite the website directory and reconfigure various settings (that is, completely reinstall)
* When using v2.2 or above, you can only download the file through the "Download Now" button, and there will be problems in some domestic browsers (use the app to solve it, and provide browser compatibility detection)
* Versions above v3.0 need to configure pseudo-static to use, see the installation instructions in the root directory
* Versions above v3.0 support pseudo-direct file transfer, which will consume traffic and server resources
* Versions above v3.0 support pseudo-direct file transfer. This function requires the browser to support localStorage and blob download (the situation is the same as when extracting files, and some domestic browsers such as UC, Quark, QQ, etc. cannot work normally)
## Demo
![](https://ivan.o5g.top/usr/uploads/2022/08/Easy-Send-preview-1.PNG)
![](https://ivan.o5g.top/usr/uploads/2022/08/Easy-Send-preview-2.PNG)
![](https://ivan.o5g.top/usr/uploads/2022/08/Easy-Send-preview-3.png)
## ToDo
 - [x] QR code sharing
 - [x] One-click installation
 - [x] APP Development
 - [x] Added templates
 - [x] Online update
 - [x] File direct transfer
 - [ ] User Center
 - [ ] Connect with Qiniuyun
## Contact the author
* QQ:1580272392
* Email:ivan@hanloth.com
* Blog: https://ivan.hanloth.cn/ ( https://ivan.o5g.top/ )
* Communication group: 390108536 (QQ group)
## quoting
* Some modules in the layui framework are used
* Use the localForage module for offline storage
* Use layuimini as the background framework
* The blue template uses the visual design of the shuyudao/wenchuan open source project
## Documentation
- Easy-Send help document (http://doc.o5g.top/docs/easy-send-docs-use/), suitable for users to read
- Easy-Send documentation (http://doc.o5g.top/docs/easy-send-docs-help/ ), suitable for website owners and managers to read
- Easy-Send development documentation (http://doc.o5g.top/docs/easy-send-docs-develop/ ), suitable for developers and programmers to read
## Update log
#### V3.1.3 (updated on 2022/11/23)
- Fix the problem of online update error reporting in the background
- Fixed the problem that the upgrade program could not decompress files
#### V3.1.2 (updated on 2022/11/22)
- Added file direct transfer room destruction mechanism (depends on monitoring file cron.php)
- Added the function of directly transferring files and exiting the room
- Added a new theme (Orange) although it only changed the color
- Added instructions for direct file transfer
- Added "File Upload" function in the background
- Optimize the visual design of the default theme and add Tab icons
- Fixed the problem that the direct file transfer was successful but it was displayed as a failure
- Fixed some button color errors
#### V3.1.1 (updated on 2022/11/12)
- Fix the problem that the upgrade will not automatically delete the original upgrade file
- Fix the problem that the previously generated extraction code becomes invalid after the length of the extraction code is modified
- Fixed the problem that files could not be downloaded normally after updating
- Fixed the problem that the "Check Compatibility" button jumps incorrectly
- Optimize the display of the selection button for direct file transfer type
#### V3.1.0 (updated on 2022/11/12)
- Added extraction code length and type customization
- Added client download page
- Added multiple client promotion positions
- Added browser compatibility check
- Fix the problem that the monitoring file is invalid
- Fix the problem that deleting data in the background will not delete files
- Fixed the problem that the online update could not be used normally
- Fixed the problem that the upgrade page could not decompress the file, etc.
- Optimize error feedback mechanism
- Optimize the display of the extraction code to avoid the appearance of characters that are not easy to distinguish
#### V3.0.1 (updated on 2022/10/29)
- Added the background to force the password to be changed
- Fixed the problem of one-click installation error
- Fixed the problem that the supporting client could not join the direct transfer
#### V3.0.0 (updated on 2022/10/1)
- Refactored the project
- Added file direct upload function
- Added QR code lazy loading
- Added windows computer terminal (see IvanHanloth/Easy-Send-APP-PC)
- New client configuration in the background
- Added website announcement configuration in the background
- Added SEO optimization configuration in the background
- Added toolbox function in background
- New data management function in the background
- Added online upgrade function in the background
- Optimize background visual design
- Optimize template development process and shorten development time
- Fix the problem that the file continues to upload without displaying the local file information
- Fix the problem that the remaining time of the file is only 15 minutes after extraction once
- Fixed the problem that the templates of some models were displayed incorrectly
- Fixed the problem that the front end could not obtain the header and footer code
- Fixed one-click installation display error problem
- Fixed the problem that some interface data types return errors
- Fix file multiple reference path error problem
#### V2.2.2 (updated on 2022/9/7)
- Added a set of templates (blue)
- Optimized extraction code display
#### V2.2.1 (updated on 2022/8/28)
- Added file direct link download function
- Fixed the problem of using file links to break through the download limit
- Optimize file download experience
#### V2.2 (updated on 2022/8/21)
- Added automatic domain name acquisition function
- New APP (see IvanHanloth/Easy-Send-App-Mobile)
- Fixed some file upload vulnerabilities
- Fix the problem that the remaining times will not be automatically reduced
- Fixed the problem that the footer could not be saved in the background
- Fix the problem that the custom header and footer display errors in the background
- Optimize the extraction code verification mechanism
- Optimized installation mechanism (using IvanHanloth/php-installer v1.1 version)
- Optimize data protection mechanism
#### V2.1 (Updated on 5/3/2022)
- Add background management function
- Fix the problem that the website settings are difficult to change
#### V2.0 (updated on 5/1/2022)
- Added one-click installation function
- Added text file storage function
- Added environment dependency detection function
- Optimize file and text storage mechanism
- Configuration files changed to database storage
#### V1.3 (updated on 2022/4/23)
- Added the function of extracting the page QR code
- Added the function of directly passing in the key
- Added robot.txt
- Add custom file upload size limit, text upload size limit
- Added the function of prohibiting the entry of spaces in the extraction code input box
- Added delayed deletion of expired files
- Fixed the bug that the last time the file could not be accessed when the number of views reached
- Optimize part of the code naming
#### V1.2 (updated on 2022/4/16)
- Fully restructure the directory structure to facilitate subsequent development
- Added template setting function
- Added adaptation for multi-platform clients
- Add custom file expiration time
- Fix the problem of sql insensitive query
- Merge the original js classified by function
#### V1.1 (updated on 2022/4/11)
- Fix the problem of invalid monitoring
- Fix the problem that the upload failed to return the status code "200", causing an error message
- Added the function of viewing the number of custom files
- Added file storage function by month


<p align="center">
<img src="https://ivan.hanloth.cn/usr/uploads/2022/08/Easy-Send-logo-2.png" style="width:30%">
</p>
