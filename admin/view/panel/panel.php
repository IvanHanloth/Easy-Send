<?php include_once dirname(__FILE__) . "/../header.php" ?>
<link rel="stylesheet" href="../../admin/css/other/console1.css" />

<body class="pear-container">
    <div>
        <div class="layui-row layui-col-space10">
            <div class="layui-col-xs6 layui-col-md3">
                <div class="layui-card top-panel">
                    <div class="layui-card-header">文件总计</div>
                    <div class="layui-card-body">
                        <div class="layui-row layui-col-space5">
                            <div class="layui-col-xs8 layui-col-md8 top-panel-number" style="color: #28333E;" id="value1">
                                0
                            </div>
                            <div class="layui-col-xs4 layui-col-md4 top-panel-tips">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 1024 1024" width="200" height="200" t="1591462258798" p-id="942" version="1.1">
                                    <path fill="#fcc66f" d="M 262.7 835 c -15.3 0 -28.1 -11.4 -29.8 -26.6 L 174.1 291 c -0.6 -5.1 1 -10.2 4.5 -14 s 8.3 -6 13.4 -6 h 640 c 5.1 0 10 2.2 13.4 6 s 5 8.9 4.5 14 l -58.8 517.4 c -1.7 15.2 -14.5 26.6 -29.8 26.6 H 262.7 Z" p-id="943" />
                                    <path fill="#ffd79c" d="M 802 289 l -58.8 517.4 c -0.7 6.1 -5.8 10.6 -11.9 10.6 h 30 c 6.1 0 11.2 -4.6 11.9 -10.6 L 832 289 h -30 Z" p-id="944" />
                                    <path fill="#f56e73" d="M 164 307 c -16.5 0 -30 -13.5 -30 -30 v -58 c 0 -16.5 13.5 -30 30 -30 h 696 c 16.5 0 30 13.5 30 30 v 58 c 0 16.5 -13.5 30 -30 30 H 164 Z" p-id="945" />
                                    <path fill="#ffa1a8" d="M 860 207 h -30 c 6.6 0 12 5.4 12 12 v 58 c 0 6.6 -5.4 12 -12 12 h 30 c 6.6 0 12 -5.4 12 -12 v -58 c 0 -6.6 -5.4 -12 -12 -12 Z" p-id="946" />
                                    <path fill="#65c8ff" d="M 190.9 651.5 c -31.4 0 -56.9 -25.5 -56.9 -56.9 V 219 c 0 -16.5 13.5 -30 30 -30 h 466.2 c 9.9 0 18 8.1 18 18 v 301.1 c 0 34.7 -28.2 62.9 -62.9 62.9 s -62.9 -28.2 -62.9 -62.9 V 393.5 c 0 -23.2 -18.8 -42 -42 -42 s -42 18.8 -42 42 v 68.1 c 0 29.4 -23.9 53.4 -53.4 53.4 s -53.4 -23.9 -53.4 -53.4 v -68.1 c 0 -23.2 -18.8 -42 -42 -42 s -42 18.8 -42 42 v 201.1 c 0.1 31.4 -25.4 56.9 -56.7 56.9 Z" p-id="947" />
                                    <path fill="#b3eaff" d="M 277.8 321.5 c -33.1 0 -60 26.9 -60 60 v 201.1 c 0 21.5 -17.4 38.9 -38.9 38.9 c -7.7 0 -14.8 -2.2 -20.8 -6.1 c 6.9 10.9 19 18.1 32.8 18.1 c 21.5 0 38.9 -17.4 38.9 -38.9 V 393.5 c 0 -33.1 26.9 -60 60 -60 c 13.5 0 25.9 4.5 36 12 c -11 -14.5 -28.4 -24 -48 -24 Z M 618.3 207 v 289.1 c 0 24.8 -20.1 44.9 -44.9 44.9 c -9.3 0 -18 -2.8 -25.2 -7.7 c 8.1 11.9 21.7 19.7 37.2 19.7 c 24.8 0 44.9 -20.1 44.9 -44.9 V 207 h -12 Z M 468.5 321.5 c -33.1 0 -60 26.9 -60 60 v 68.1 c 0 19.5 -15.8 35.4 -35.4 35.4 c -6.7 0 -12.9 -1.9 -18.3 -5.1 c 6.2 10.2 17.4 17.1 30.3 17.1 c 19.5 0 35.4 -15.8 35.4 -35.4 v -68.1 c 0 -33.1 26.9 -60 60 -60 c 13.5 0 25.9 4.5 36 12 c -11 -14.5 -28.4 -24 -48 -24 Z" p-id="948" />
                                    <path fill="#453b56" d="M 698 729.4 m -18 0 a 18 18 0 1 0 36 0 a 18 18 0 1 0 -36 0 Z" p-id="949" />
                                    <path fill="#453b56" d="M 860 171 H 632.5 v 0.1 c -0.7 0 -1.5 -0.1 -2.2 -0.1 H 164 c -26.5 0 -48 21.5 -48 48 v 375.6 c 0 41.3 33.6 74.9 74.9 74.9 c 2.7 0 5.4 -0.2 8.1 -0.5 l 16 141.4 c 2.8 24.3 23.3 42.6 47.7 42.6 h 498.6 c 24.4 0 44.9 -18.3 47.7 -42.6 l 55.2 -485.6 c 24.5 -2.1 43.8 -22.7 43.8 -47.8 v -58 c 0 -26.5 -21.5 -48 -48 -48 Z M 190.9 633.5 c -21.5 0 -38.9 -17.4 -38.9 -38.9 V 219 c 0 -6.6 5.4 -12 12 -12 h 466.3 v 301.1 c 0 24.8 -20.1 44.9 -44.9 44.9 c -24.8 0 -44.9 -20.1 -44.9 -44.9 V 393.5 c 0 -33.1 -26.9 -60 -60 -60 s -60 26.9 -60 60 v 68.1 c 0 19.5 -15.8 35.4 -35.4 35.4 c -19.5 0 -35.4 -15.8 -35.4 -35.4 v -68.1 c 0 -33.1 -26.9 -60 -60 -60 s -60 26.9 -60 60 v 201.1 c 0.1 21.5 -17.4 38.9 -38.8 38.9 Z m 582.3 172.9 c -0.7 6.1 -5.8 10.6 -11.9 10.6 H 262.7 c -6.1 0 -11.2 -4.6 -11.9 -10.6 l -6.7 -59 h 396.6 c 9.9 0 18 -8.1 18 -18 s -8.1 -18 -18 -18 H 240 l -6.3 -55.4 c 19.3 -13.6 32.1 -36 32.1 -61.3 V 393.5 c 0 -13.2 10.8 -24 24 -24 s 24 10.8 24 24 v 68.1 c 0 39.4 32 71.4 71.4 71.4 s 71.4 -32 71.4 -71.4 v -68.1 c 0 -13.2 10.8 -24 24 -24 s 24 10.8 24 24 v 114.6 c 0 44.6 36.3 80.9 80.9 80.9 c 44.6 0 80.9 -36.3 80.9 -80.9 V 325 h 161.7 l -54.9 481.4 Z M 872 277 c 0 6.6 -5.4 12 -12 12 H 666.3 v -82 H 860 c 6.6 0 12 5.4 12 12 v 58 Z" p-id="950" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="layui-col-xs6 layui-col-md3">
                <div class="layui-card top-panel">
                    <div class="layui-card-header">文本总计</div>
                    <div class="layui-card-body">
                        <div class="layui-row layui-col-space5">
                            <div class="layui-col-xs8 layui-col-md8 top-panel-number" style="color: #28333E;" id="value2">
                                0
                            </div>
                            <div class="layui-col-xs4 layui-col-md4 top-panel-tips">
                                <svg t="1591462430908" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="3170" width="200" height="200">
                                    <path d="M532 784.2c0 24.4-19.8 44.3-44.3 44.3s-44.3-19.8-44.3-44.3c0-24.4 44.3-80.3 44.3-80.3s44.3 55.8 44.3 80.3zM766 784.2c0 24.4 19.8 44.3 44.3 44.3 24.4 0 44.3-19.8 44.3-44.3 0-24.4-44.3-80.3-44.3-80.3S766 759.7 766 784.2z" fill="#97DCFF" p-id="3171"></path>
                                    <path d="M123.5 471.3c-9.9 0-18-8.1-18-18v-302c0-9.9 8.1-18 18-18h58c9.9 0 18 8.1 18 18v302c0 9.9-8.1 18-18 18h-58z" fill="#FCC66F" p-id="3172"></path>
                                    <path d="M181.5 151.3v302h-58v-302h58m0-36h-58c-19.9 0-36 16.1-36 36v302c0 19.9 16.1 36 36 36h58c19.9 0 36-16.1 36-36v-302c0-19.8-16.1-36-36-36z" fill="#453B56" p-id="3173"></path>
                                    <path d="M266.4 210.7m-18 0a18 18 0 1 0 36 0 18 18 0 1 0-36 0Z" fill="#453B56" p-id="3174"></path>
                                    <path d="M430.8 641.1c-9.9 0-18-8.1-18-18v-21.6c0-130.3 106-236.3 236.3-236.3s236.3 106 236.3 236.3v21.6c0 9.9-8.1 18-18 18H430.8z" fill="#FCC66F" p-id="3175"></path>
                                    <path d="M649 383.2c-5 0-10 0.2-15 0.6 113.5 7.7 203.3 102.2 203.3 217.7v21.6h30v-21.6c0-120.6-97.7-218.3-218.3-218.3z" fill="#FFD79C" p-id="3176"></path>
                                    <path d="M419.6 694.4c-22.1 0-40.1-18-40.1-40.1s18-40.1 40.1-40.1h458.8c22.1 0 40.1 18 40.1 40.1s-18 40.1-40.1 40.1H419.6z" fill="#F56E73" p-id="3177"></path>
                                    <path d="M878.4 632.3h-30c12.2 0 22.1 9.9 22.1 22.1s-9.9 22.1-22.1 22.1h30c12.2 0 22.1-9.9 22.1-22.1s-9.9-22.1-22.1-22.1z" fill="#FFA1A8" p-id="3178"></path>
                                    <path d="M693.3 846.4c0 24.4-19.8 44.3-44.3 44.3-24.4 0-44.3-19.8-44.3-44.3s44.3-80.3 44.3-80.3 44.3 55.9 44.3 80.3z" fill="#97DCFF" p-id="3179"></path>
                                    <path d="M649 908.7c-34.3 0-62.3-27.9-62.3-62.3 0-28.5 36.9-77.2 48.1-91.4 3.4-4.3 8.6-6.8 14.1-6.8s10.7 2.5 14.1 6.8c11.3 14.2 48.1 62.9 48.1 91.4 0.2 34.3-27.8 62.3-62.1 62.3z m0-112.3c-14.1 20.4-26.3 41.9-26.3 50 0 14.5 11.8 26.3 26.3 26.3s26.3-11.8 26.3-26.3c0-8.1-12.1-29.6-26.3-50z" fill="#453B56" p-id="3180"></path>
                                    <path d="M903.3 601.9v-0.5c0-134.1-104.4-244.3-236.3-253.6v-30.7c0-68.7-55.9-124.6-124.6-124.6H326.5c-9.9 0-18 8.1-18 18s8.1 18 18 18h215.9c48.8 0 88.6 39.7 88.6 88.6v30.7c-131.8 9.3-236.3 119.4-236.3 253.6v0.5c-19.6 9.3-33.2 29.3-33.2 52.4 0 32 26 58.1 58.1 58.1H459c-14.8 21-33.5 51.5-33.5 71.8 0 34.3 27.9 62.3 62.3 62.3 34.3 0 62.2-27.9 62.2-62.3 0-20.3-18.6-50.7-33.5-71.8h264.9c-14.8 21-33.5 51.5-33.5 71.8 0 34.3 27.9 62.3 62.3 62.3 34.3 0 62.3-27.9 62.3-62.3 0-20.3-18.6-50.7-33.5-71.8h39.4c32 0 58.1-26 58.1-58.1 0-23.1-13.6-43-33.2-52.4zM487.8 810.4c-14.5 0-26.3-11.8-26.3-26.3 0-8.1 12.1-29.6 26.3-50 14.1 20.4 26.2 41.9 26.2 50 0 14.5-11.8 26.3-26.2 26.3z m322.5 0c-14.5 0-26.3-11.8-26.3-26.3 0-8.1 12.1-29.6 26.3-50 14.1 20.4 26.3 41.9 26.3 50-0.1 14.5-11.9 26.3-26.3 26.3zM649 383.2c118.8 0 215.4 94.9 218.1 213.1H430.9c2.8-118.1 99.3-213.1 218.1-213.1z m251.5 271.1c0 12.2-9.9 22.1-22.1 22.1H419.6c-12.2 0-22.1-9.9-22.1-22.1 0-12.2 9.9-22.1 22.1-22.1h458.8c12.2 0.1 22.1 10 22.1 22.1z" fill="#453B56" p-id="3181"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="layui-col-xs6 layui-col-md3">
                <div class="layui-card top-panel">
                    <div class="layui-card-header">房间总计</div>
                    <div class="layui-card-body">
                        <div class="layui-row layui-col-space5">
                            <div class="layui-col-xs8 layui-col-md8 top-panel-number" style="color: #28333E;" id="value3">
                                0
                            </div>
                            <div class="layui-col-xs4 layui-col-md4  top-panel-tips">
                                <svg t="1591462464512" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="3311" width="200" height="200">
                                    <path d="M750.4 216.5h-130v-15.3c0-32.9-26.8-59.7-59.7-59.7h-97.3c-32.9 0-59.7 26.8-59.7 59.7v15.3h-130c-30.7 0-55.6 25-55.6 55.6v72.4c0 9.9 8.1 18 18 18h31.5v478c0 23.2 18.8 42 42 42h405c23.2 0 42-18.8 42-42v-478H788c9.9 0 18-8.1 18-18v-72.4c0-30.6-25-55.6-55.6-55.6z" fill="#FCC66F" p-id="3312"></path>
                                    <path d="M708.5 344.5v496c0 13.3-10.7 24-24 24h30c13.3 0 24-10.7 24-24v-496h-30z" fill="#FFD79C" p-id="3313"></path>
                                    <path d="M309.5 882.5c-23.2 0-42-18.8-42-42V596c0-9.9 8.1-18 18-18h36.8c30.2 0 54.8 24.6 54.8 54.8v231.7c0 9.9-8.1 18-18 18h-49.6zM664.9 882.5c-9.9 0-18-8.1-18-18V632.8c0-30.2 24.6-54.8 54.8-54.8h36.8c9.9 0 18 8.1 18 18v244.5c0 23.2-18.8 42-42 42h-49.6z" fill="#F56E73" p-id="3314"></path>
                                    <path d="M708.5 596v244.5c0 13.3-10.7 24-24 24h30c13.3 0 24-10.7 24-24V596h-30z" fill="#FFA1A8" p-id="3315"></path>
                                    <path d="M475.2 882.5c-9.9 0-18-8.1-18-18V632.8c0-30.2 24.6-54.8 54.8-54.8 30.2 0 54.8 24.6 54.8 54.8v231.7c0 9.9-8.1 18-18 18h-73.6z" fill="#F56E73" p-id="3316"></path>
                                    <path d="M560.7 159.5h-18c23 0 41.7 18.7 41.7 41.7V221h18v-19.8c-0.1-23-18.7-41.7-41.7-41.7zM750.4 234.5h-30c20.8 0 37.6 16.8 37.6 37.6v72.4h30v-72.4c0-20.8-16.8-37.6-37.6-37.6z" fill="#FFD79C" p-id="3317"></path>
                                    <path d="M750.4 198.5H638.2c-1.4-41.6-35.6-75-77.5-75h-97.3c-41.9 0-76.1 33.4-77.5 75H273.6c-40.6 0-73.6 33-73.6 73.6v72.4c0 19.9 16.1 36 36 36h13.5v460c0 33.1 26.9 60 60 60H714.7c33.1 0 60-26.9 60-60v-460H788c19.9 0 36-16.1 36-36v-72.4c0-40.6-33-73.6-73.6-73.6z m-287.1-39h97.3c22.1 0 40.2 17.2 41.5 39H421.8c1.4-21.8 19.4-39 41.5-39z m-104.2 705h-49.6c-13.3 0-24-10.7-24-24V596h36.8c20.3 0 36.8 16.5 36.8 36.8v231.7z m189.7 0h-73.6V632.8c0-20.3 16.5-36.8 36.8-36.8 20.3 0 36.8 16.5 36.8 36.8v231.7z m189.7-24c0 13.3-10.7 24-24 24h-49.6V632.8c0-20.3 16.5-36.8 36.8-36.8h36.8v244.5z m0-280.5h-36.8c-40.1 0-72.8 32.6-72.8 72.8v231.7h-44.2V632.8c0-40.1-32.6-72.8-72.8-72.8-40.1 0-72.8 32.6-72.8 72.8v231.7h-44.2V632.8c0-40.1-32.6-72.8-72.8-72.8h-36.8v-74.5h279c9.9 0 18-8.1 18-18s-8.1-18-18-18h-279v-69h453V560zM788 344.5H236v-72.4c0-20.8 16.8-37.6 37.6-37.6h476.8c20.8 0 37.6 16.8 37.6 37.6v72.4z" fill="#453B56" p-id="3318"></path>
                                    <path d="M621.8 467.5m-18 0a18 18 0 1 0 36 0 18 18 0 1 0-36 0Z" fill="#453B56" p-id="3319"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="layui-col-xs6 layui-col-md3">
                <div class="layui-card top-panel">
                    <div class="layui-card-header">用户总计</div>
                    <div class="layui-card-body">
                        <div class="layui-row layui-col-space5">
                            <div class="layui-col-xs8 layui-col-md8 top-panel-number" style="color: #28333E;" id="value4">
                                0
                            </div>
                            <div class="layui-col-xs4 layui-col-md4 top-panel-tips">
                                <svg t="1591462491887" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="3449" width="200" height="200">
                                    <path d="M363.2 807c-9.9 0-18-8.1-18-18v-75.5c0-9.9 8.1-18 18-18h108.5c9.9 0 18 8.1 18 18V789c0 9.9-8.1 18-18 18H363.2z" fill="#F56E73" p-id="3450"></path>
                                    <path d="M441.7 713.5h30V789h-30z" fill="#FFA1A8" p-id="3451"></path>
                                    <path d="M259.6 398c-9.9 0-18-8.1-18-18V178.6c0-23.8 19.3-43.1 43.1-43.1s43.1 19.3 43.1 43.1V380c0 9.9-8.1 18-18 18h-50.2zM525.1 398c-9.9 0-18-8.1-18-18V178.6c0-23.8 19.3-43.1 43.1-43.1s43.1 19.3 43.1 43.1V380c0 9.9-8.1 18-18 18h-50.2z" fill="#65C8FF" p-id="3452"></path>
                                    <path d="M550.2 153.5c-3.2 0-6.2 0.7-9 1.7 9.4 3.6 16.1 12.7 16.1 23.4V380h18V178.6c0.1-13.9-11.2-25.1-25.1-25.1z" fill="#97DCFF" p-id="3453"></path>
                                    <path d="M686 330.5H149c-9.9 0-18 8.1-18 18v63c0 9.9 8.1 18 18 18h33.2l45 225c8.7 43.4 47.1 75 91.4 75h197.6c44.3 0 82.7-31.5 91.4-75l45-225H686c9.9 0 18-8.1 18-18v-63c0-9.9-8.1-18-18-18z" fill="#FCC66F" p-id="3454"></path>
                                    <path d="M608 411.5L560.1 651c-7 35.2-37.9 60.5-73.8 60.5h30c35.9 0 66.7-25.3 73.8-60.5L638 411.5h-30zM656 348.5h30v63h-30z" fill="#FFD79C" p-id="3455"></path>
                                    <path d="M474.2 543.5m-18 0a18 18 0 1 0 36 0 18 18 0 1 0-36 0Z" fill="#453B56" p-id="3456"></path>
                                    <path d="M416.9 525.5h-125c-9.9 0-18 8.1-18 18s8.1 18 18 18h125c9.9 0 18-8.1 18-18s-8.1-18-18-18zM893 543.5h-33.4c-65.2 0-118.2 53-118.2 118.2v19.6c0 9.9 8.1 18 18 18s18-8.1 18-18v-19.6c0-45.3 36.9-82.2 82.2-82.2H893c9.9 0 18-8.1 18-18s-8-18-18-18zM772.2 744.2c7-7 7-18.4 0-25.5-7-7-18.4-7-25.5 0s-7 18.4 0 25.5 18.4 7.1 25.5 0z" fill="#453B56" p-id="3457"></path>
                                    <path d="M759.5 761.6c-9.9 0-18 8.1-18 18v11.6c0 43.7-35.6 79.3-79.3 79.3H487.3c-26.4 0-48.3-19.9-51.4-45.5h35.8c19.9 0 36-16.1 36-36v-41.5h8.6c52.8 0 98.7-37.6 109.1-89.4l42.1-210.6H686c19.9 0 36-16.1 36-36v-63c0-19.9-16.1-36-36-36h-74.6V178.6c0-33.7-27.4-61.1-61.1-61.1s-61.1 27.4-61.1 61.1v133.9H345.9V178.6c0-33.7-27.4-61.1-61.1-61.1s-61.1 27.4-61.1 61.1v133.9H149c-19.9 0-36 16.1-36 36v63c0 19.9 16.1 36 36 36h18.5l42.1 210.6c10.4 51.8 56.2 89.4 109.1 89.4h8.6V789c0 19.9 16.1 36 36 36h36.6c3.3 45.5 41.2 81.5 87.5 81.5h174.8c63.6 0 115.3-51.7 115.3-115.3v-11.6c0-10-8.1-18-18-18z m-234.4-583c0-13.9 11.2-25.1 25.1-25.1s25.1 11.2 25.1 25.1v133.9H525V178.6z m-265.5 0c0-13.9 11.2-25.1 25.1-25.1s25.1 11.2 25.1 25.1v133.9h-50.3V178.6zM149 411.5v-63h537v63H149z m169.7 300c-35.9 0-66.7-25.3-73.8-60.5l-40.7-203.5h426.6L590.1 651c-7 35.2-37.9 60.5-73.8 60.5H318.7z m44.5 77.5v-41.5h108.5V789H363.2z" fill="#453B56" p-id="3458"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="layui-row layui-col-space10">
            <div class="layui-col-md4">
                <div class="layui-card">
                    <div class="layui-card-header">系统信息</div>
                    <div class="layui-card-body">
                        <ul class="list">
                            <li class="list-item">PHP版本：<?php echo PHP_VERSION; ?></li>
                            <li class="list-item">MySQL版本：<?php echo mysqli_get_server_info($db); ?></li>
                            <li class="list-item">程序版本：<?php echo get_setting("version"); ?></li>
                            <li class="list-item">最新版本：<span id="newest_version">获取ing……</span></li>
                            <li class="list-item" style="height:92px;" id="evaluation-box">存在的问题：
                                <ul style="height:calc(72px - 1ex);overflow:auto" id="evaluation">

                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="layui-col-md4">
                <div class="layui-card">
                    <div class="layui-card-header">
                        公告
                    </div>
                    <div class="layui-card-body" style="line-height:40px;" id="announcement">
                        获取ing……
                    </div>
                </div>
            </div>
            <div class="layui-col-md4">
                <div class="layui-card">
                    <div class="layui-card-header">
                        链接
                    </div>
                    <div class="layui-card-body">
                        <a target="_blank" href="/" class="pear-btn pear-btn-primary  layui-btn-fluid" style="margin-top: 8px;height: 50px;line-height: 50px;">网站首页</a>
                        <br />
                        <a target="_blank" href="https://github.com/IvanHanloth/Easy-Send" class="pear-btn pear-btn-warming  layui-btn-fluid" style="margin-top: 8px;height: 50px;line-height: 50px;">项目地址</a>
                        <br />
                        <a target="_blank" href="http://ivan.hanloth.cn" class="pear-btn pear-btn-danger  layui-btn-fluid" style="margin-top: 8px;height: 50px;line-height: 50px;">作者博客</a>

                        <a target="_blank" href="http://doc.hanloth.cn/docs/easy-send-docs-help" class="pear-btn layui-bg-blue layui-btn-fluid" style="margin-top: 8px;height: 50px;line-height: 50px;">说明文档</a>
                        <a target="_blank" href="https://github.com/IvanHanloth/Easy-Send/issues/new" class="pear-btn layui-bg-red layui-btn-fluid" style="margin-top: 8px;height: 50px;line-height: 50px;">问题反馈</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="layui-row">
            <div class="layui-col-md12">
                <div class="layui-card">
                    <div class="layui-card-body" style="flex-direction: column;height: 160px;display: flex; align-items: center; justify-content: center;">
                        <div>
                            <svg focusable="false" class="" data-icon="smile" width="6em" height="6em" fill="#16baaa" aria-hidden="true" viewBox="64 64 896 896">
                                <path d="M512 64C264.6 64 64 264.6 64 512s200.6 448 448 448 448-200.6 448-448S759.4 64 512 64zm0 820c-205.4 0-372-166.6-372-372s166.6-372 372-372 372 166.6 372 372-166.6 372-372 372z" fill="#16baaa"></path>
                                <path d="M512 140c-205.4 0-372 166.6-372 372s166.6 372 372 372 372-166.6 372-372-166.6-372-372-372zM288 421a48.01 48.01 0 0196 0 48.01 48.01 0 01-96 0zm224 272c-85.5 0-155.6-67.3-160-151.6a8 8 0 018-8.4h48.1c4.2 0 7.8 3.2 8.1 7.4C420 589.9 461.5 629 512 629s92.1-39.1 95.8-88.6c.3-4.2 3.9-7.4 8.1-7.4H664a8 8 0 018 8.4C667.6 625.7 597.5 693 512 693zm176-224a48.01 48.01 0 010-96 48.01 48.01 0 010 96z" fill="#e6f7ff"></path>
                                <path d="M288 421a48 48 0 1096 0 48 48 0 10-96 0zm376 112h-48.1c-4.2 0-7.8 3.2-8.1 7.4-3.7 49.5-45.3 88.6-95.8 88.6s-92-39.1-95.8-88.6c-.3-4.2-3.9-7.4-8.1-7.4H360a8 8 0 00-8 8.4c4.4 84.3 74.5 151.6 160 151.6s155.6-67.3 160-151.6a8 8 0 00-8-8.4zm-24-112a48 48 0 1096 0 48 48 0 10-96 0z" fill="#16baaa"></path>
                            </svg>
                        </div>
                        <div>Happy Forever</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!--</div>-->
    <script src="../../component/layui/layui.js"></script>
    <script src="../../component/pear/pear.js"></script>
    <script>
        layui.use(['layer', 'echarts', 'element', 'count', 'loading'], function() {
            var $ = layui.jquery,
                layer = layui.layer,
                element = layui.element,
                count = layui.count,
                echarts = layui.echarts,
                loading = layui.loading;
            loading.block({
                type: 2,
                elem: '#evaluation-box'
            })
            $.getJSON("/admin/api/panel/count.php", function(data) {

                count.up("value1", {
                    time: 3000,
                    num: data.file_total,
                    bit: 0,
                    regulator: 50
                })

                count.up("value2", {
                    time: 3000,
                    num: data.text_total,
                    bit: 0,
                    regulator: 50
                })

                count.up("value3", {
                    time: 3000,
                    num: data.room_total,
                    bit: 0,
                    regulator: 50
                })

                count.up("value4", {
                    time: 3000,
                    bit: 0,
                    num: data.user_total,
                    regulator: 50
                })
            })
            $.getJSON("//ivan.hanloth.cn/api/Easy-Send/statistic.php?action=admin-index",()=>{})
            $.getJSON("/admin/api/panel/update.php", function(data) {
                if (data.code == 200) {
                    $("#announcement").html(data.announcement)
                    if (data.now_version_num < data.newest_version_num) {
                        $("#newest_version").css("color", "red");
                        $("#evaluation").append("<li>存在新版本：" + data.newest_version + "可更新</li>");
                    }
                    $("#newest_version").html(data.newest_version)
                    loading.blockRemove("#evaluation-box", 500);
                } else {
                    $("#evaluation").append("<li>" + data.tip + "</li>")
                    $.ajax({
                        url: "//ivanhanloth.github.io/Easy-Send/server.json",
                        type: "GET",
                        success: function(data2) {
                            $("#announcement").html(data2.announcement)
                            if (data.now_version_num < data2.update[0].version_num) {
                                $("#newest_version").css("color", "red");
                                $("#evaluation").append("<li>存在新版本：" + data2.update[0].version + "可更新</li>");
                            }
                            $("#newest_version").html(data2.update[0].version)
                            loading.blockRemove("#evaluation-box", 500);
                        },
                        error: function() {
                            $("#evaluation").append("<li>您当前的网络无法连接至Github，可能无法使用在线更新功能</li>")
                        }
                    });
                }

            })


        });
    </script>
</body>

</html>