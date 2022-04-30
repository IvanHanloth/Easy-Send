<?php 
session_start();
error_reporting(0);
$check_num=4;//定义检查的项目数
$php_version="5.6.0";//定义php需要的版本
$sql_version="5.5";//定义sql需要的版本
if(file_exists('install.lock')){
	exit('您已经安装过，如需重新安装请删除<font color=red> install/install.lock </font>文件后再安装！');
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
        <title>安装程序</title>
        <link rel="stylesheet" type="text/css" href="./style.css">
        <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no">
    </head>
    <body>
        <h2 style="text-align:center">安装程序</h2>
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
                			<td>php 5.6+</td>
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
                	</tbody>
                </table>
            </div>
            
            <?php if($check==$check_num){?>
            <div class="input-pack">
                <form method="POST" action="?step=3">
                    <label for="dbhost">数据库地址</label>
                    <input name="dbhost" type="text" placeholder="请输入数据库地址" value="<?php echo $dbconfig['host']?>" required>
                    <label for="dbport">数据库端口</label>
                    <input name="dbport" type="text" placeholder="请输入数据库端口" value="<?php echo $dbconfig['port']?>" required>
                    <label for="dbaccount">数据库用户名</label>
                    <input name="dbaccount" type="text" placeholder="请输入数据库用户名" value="<?php echo $dbconfig['account']?>" required>
                    <label for="dbpassword">数据库密码</label>
                    <input name="dbpassword" type="text" placeholder="请输入数据库密码" value="<?php echo $dbconfig['password']?>" required>
                    <label for="dbname">数据库名称</label>
                    <input name="dbname" type="text" placeholder="请输入数据库名称" value="<?php echo $dbconfig['name']?>" required>
                    <div class="button">
                    <button type="submit">保存</button></div>
                </form>
            </div>
            <?php }else{echo '<div class="input-pack">环境检测未通过，配置完成后才能继续</div>';};
        }elseif($_REQUEST['step']==3){?>
            <div class="input-pack">
            <?php
                $db_host=isset($_POST['dbhost'])?$_POST['dbhost']:NULL;
            	$db_port=isset($_POST['dbport'])?$_POST['dbport']:NULL;
            	$db_account=isset($_POST['dbaccount'])?$_POST['dbaccount']:NULL;
            	$db_password=isset($_POST['dbpassword'])?$_POST['dbpassword']:NULL;
            	$db_name=isset($_POST['dbname'])?$_POST['dbname']:NULL;
            
            	if($db_host==null or $db_port==null or $db_account==null or $db_password==null or $db_name==null){
            		echo '保存失败，确保每一项不能为空<br><br><div class="button"><a href="javascript:history.back(-1)"><button>返回</button></a></div>';
            	} else {
            		$config='
<?php
/*数据库配置*/
$dbconfig=array(
    "host" => "'.$db_host.'", //数据库服务器
    "port" => '.$db_port.', //数据库端口
    "account" => "'.$db_account.'", //数据库用户名
    "password" => "'.$db_password.'", //数据库密码
    "name" => "'.$db_name.'", //数据库名
);
?>';
            		if(!$db=mysqli_connect($db_host,$db_account,$db_password,$db_name,$db_port)){
            			if(mysqli_connect_errno()==2002)
            				echo '连接数据库失败，数据库地址填写错误！';
            			elseif(mysqli_connect_errno()==1045)
            				echo '连接数据库失败，数据库用户名或密码填写错误！';
            			elseif(mysqli_connect_errno()==1044)
            				echo '连接数据库失败，数据库名填写错误！';
            			elseif(mysqli_connect_errno()==1049)
            				echo '连接数据库失败，数据库名不存在！';
            			else
            				echo '连接数据库失败，['.mysqli_connect_errno().']'.mysqli_connect_error().'';
            		}elseif(version_compare(mysqli_get_server_info($db), $sql_version, '<')){
            			echo 'MySQL数据库版本太低，需要MySQL '.$sql_version.'或以上版本！';
            		}elseif(file_put_contents('../config.php',$config)){
            			if(function_exists("opcache_reset"))@opcache_reset();
            			echo '数据库配置文件保存成功！<br><br><a href="./?step=4"><button>继续</button></a>';
            		}else
            			echo '保存失败，请确保网站根目录有写入权限<br><br><div class="button"><a href="javascript:history.back(-1)"><button>返回</button></a></div>';
            	};
            ?>
            </div>
            <?php }elseif($_REQUEST['step']==4){?>
            <div class="input-pack">
                <?php
                    include_once '../config.php';
                    if(!$dbconfig['account']||!$dbconfig['password']||!$dbconfig['name']) {
                    	echo '请先填写好数据库并保存后再安装！<br><br><div class="button"><a href="javascript:history.back(-1)"><button>返回</button></a></div>';
                    } else {
                        $db=mysqli_connect($dbconfig['host'],$dbconfig['account'],$dbconfig['password'],$dbconfig['name'],$dbconfig['port']);
                        $sql = file_get_contents('install.sql');
                        $sql = explode(';', $sql);
                    	$success_num=0;
                    	$fail_num=0;
                    	for($i=0;$i<count($sql);$i++) {
                    		if (trim($sql[$i])=='')continue;
                    		if(mysqli_query($db, $sql[$i])) {
                    			++$success_num;
                    		} else {
                    			++$fail_num;
                    			$error.=mysqli_error($db).'<br/>';
                    		}
                    	};
                        };
                    if($e==0) {
                    	echo '安装成功！<br>SQL成功'.$success_num.'句/失败'.$fail_num.'句<br><br><div class="button"><a href="./?step=5"><button>下一步</button></a></div>';
                    } else {
                    	echo '安装失败！<br>SQL成功'.$success_num.'句/失败'.$fail_num.'句<br><br><div class="button"><a href="./?step=2"><button>重新配置</button></a></div>';
                    };?>
            </div>
            <?php
            }elseif($_REQUEST['step']==5){ 
	            @file_put_contents("install.lock",'安装锁，防止重复安装，删除后即可继续使用安装程序');
            ?>
                <div class="input-pack">
                    <?php require "./end.html";?>
                </div>
                <?php
            }else{
                echo "出现未知错误，请刷新重试";
            };?>
    </body>
</html>