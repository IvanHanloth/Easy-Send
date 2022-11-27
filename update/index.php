<?php 
session_start();
error_reporting(0);
$check_num=6;//定义检查的项目数
$php_version="7.0.0";//定义php需要的版本
$sql_version="5.5";//定义sql需要的版本
if(file_exists('update.lock')){
	exit('您已经升级过，如需重新升级请删除<font color=red> update/update.lock </font>文件后再升级！');
}
function checkversion($f){
    if(version_compare(PHP_VERSION,$f, '>')==true){
        return true;
    }else{
        return false;
    };
}

function checksession(){
    $_SESSION['checksession']=1;
    if($_SESSION['checksession']==1){
        return true;
    }else{
        return false;
    }; 
}
function check($f=false){
    global $check;
    if($f){
        $check=$check+1;
        echo '<font color="green">可用</font>';
    }else{
        echo '<font color="red">不支持</font>';
    }; 
}
$check=0;//初始化检查项目
?>
<!Doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Easy-Send升级程序</title>
        <link rel="stylesheet" type="text/css" href="./style.css">
        <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no">
    <script src="/public/lib/jquery/jquery.js"></script>
    </head>
    <body>
        <h2 style="text-align:center">Easy-Send升级程序</h2>
        <?php if(isset($_REQUEST['step'])==FALSE or $_REQUEST['step']==1 or $_REQUEST['step']==null ){?>
        <div class="check-pack">
            <h3 style="text-align:center">用户协议</h3>
            <p><?php require "./license.html";?></p>
            <div class="button">
                <a href="./?step=2"><button>下一步</button></a>
            </div>
        </div>
        <?php
        }elseif($_REQUEST['step']==2){
            require_once "../config.php";?>
            <div class="check-pack">
                <table class="table">
                	<thead>
                		<tr>
                			<th style="width:20%">环境检测</th>
                			<th style="width:15%">需求</th>
                			<th style="width:15%">当前</th>
                		</tr>
                	</thead>
                	<tbody>
                		<tr>
                			<td>php 7.0+</td>
                			<td>必须</td>
                			<td><?php check(checkversion($php_version)) ?></td>
                		</tr>
                		<tr>
                			<td>session</td>
                			<td>必须</td>
                			<td><?php check(checksession()) ?></td>
                		</tr>
                		<tr>
                			<td>file_get_contents()</td>
                			<td>必须</td>
                			<td><?php echo check(function_exists('file_get_contents')); ?></td>
                		</tr>
                		<tr>
                			<td>Mysqli</td>
                			<td>必须</td>
                			<td><?php echo check(class_exists('Mysqli')); ?></td>
                		</tr>
                		<tr>
                			<td>fileinfo</td>
                			<td>必须</td>
                			<td><?php echo check(extension_loaded("fileinfo")); ?></td>
                		</tr>
                		<tr>
                			<td>ZipArchive</td>
                			<td>必须</td>
                			<td><?php echo check(class_exists('ZipArchive')); ?></td>
                		</tr>
                	</tbody>
                </table>
            </div>
            
            <?php if($check==$check_num){?>
            <div class="input-pack" id="unzip-div">
                <button id="unzip-confirm">解压文件</button>
            </div>
            <script>
            $("#unzip-confirm").click(function(){
                $("#unzip-div").append('<Br>正在解压必要文件……')
                $.ajax({
                    url:"/update/unzip.php",
                    type: "POST",
                    success:function(res){
                        if(res.code==200){
                            $("#unzip-div").append('<br><a href="./?step=3"><button>下一步</button>')
                        }else{
                            $("#unzip-div").append('<br>解压失败')
                        }
                    },
                    error:function(res){
                        $("#unzip-div").append('<br>'+res.tip)
                    }
                })
                
            })
                
            </script>
            <?php
        }else{echo '<div class="input-pack">环境检测未通过，配置完成后才能继续</div>';};
        }elseif($_REQUEST['step']==3){?>
            <div class="input-pack">
            <a href="./?step=4"><button>下一步</button>
            </div>
            <?php }elseif($_REQUEST['step']==4){?>
            <div class="input-pack">
                <?php
                    include_once dirname(__FILE__).'/../config.php';
                    if(!$dbconfig['account']||!$dbconfig['password']||!$dbconfig['name']) {
                    	echo '请先填写好数据库并保存后再升级！<br><br><div class="button"><a href="javascript:history.back(-1)"><button>返回</button></a></div>';
                    } else {
                        $db=mysqli_connect($dbconfig['host'],$dbconfig['account'],$dbconfig['password'],$dbconfig['name'],$dbconfig['port']);
                        $sql = file_get_contents('update.sql');
                        $sql = explode(';', $sql);
                    	$success_num=0;
                    	$fail_num=0;
                    	foreach ($sql as $value){
                    		if (trim($value)==''){
                    		    continue;
                    		}
                    		if(mysqli_query($db, $value)){
                    			$success_num++;
                    		} else {
                    			$fail_num++;
                    			$error.=mysqli_error($db).'<br/>';
                    		}
                    	}
                    };
                    if($e==0) {
                    	echo '升级成功！<br>SQL成功'.$success_num.'句/失败'.$fail_num.'句<br><br><div class="button"><a href="./?step=5"><button>下一步</button></a></div>';
                    } else {
                    	echo '升级失败！<br>SQL成功'.$success_num.'句/失败'.$fail_num.'句<br><br><div class="button"><a href="./?step=2"><button>重新配置</button></a></div>';
                    };?>
            </div>
            <?php
            }elseif($_REQUEST['step']==5){ ?>
                <div class="input-pack">
            <?php
                include_once dirname(__FILE__)."/../common.php";
                save_setting("update",0);
                $e=file_put_contents("update.lock",'升级锁，防止重复升级，删除后即可继续使用升级程序');
                include_once dirname(__FILE__)."/./end.html";
                if(!$e){
	                echo "<h2>无法正常创建update/update.lock，为保证数据的安全，请在升级程序所在目录下手动创建update.lock</h2>";
            	};?>
                </div>
                <?php
            }else{
                echo "出现未知错误，请刷新重试";
            };?>
    </body>
</html>
