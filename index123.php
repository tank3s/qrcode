<?php
error_reporting(0); 
//scope=snsapi_userinfo实例
//$appid='wxd7219ec917fba980';
//$redirect_uri = urlencode ( 'http://smilet.cn/getUserInfo.php' );
//$url ="https://open.weixin.qq.com/connect/oauth2/authorize?appid=$appid&redirect_uri=$redirect_uri&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect";
//header("Location:".$url);
//include ('getUserInfo.php');

$mysql_server="localhost";
$mysql_username="root";
$mysql_password="root";
$mysql_database="qrcode";
//建立数据库链接
$conn = mysql_connect($mysql_server,$mysql_username,$mysql_password) or die("数据库链接错误");
//选择某个数据库
mysql_select_db($mysql_database,$conn);
mysql_query("set names 'utf8'");
//执行MySQL语句
if(!empty($_GET['pic'])){
				if(preg_match('/^(data:\s*image\/(\w+);base64,)/', $_REQUEST['file'], $result)){
           
            	 $file_name = date('YmdHis') . rand(10000, 99999);
                $new_file = 'uploads/' .$file_name.'.jpg';
                //print_r($new_file);
                file_put_contents($new_file, base64_decode(str_replace($result[1], '', $_REQUEST['file'])));
                
         	 exit(json_encode($new_file));
         	//$new_file));
          	 }   
         }
         
         
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/> 
<title>321国际设计师节</title>
<link type="text/css" rel="stylesheet" href="frozen.css" />
<style>
body{color:#a6a6a6; font-size:16px; max-width: 750px; margin: 0 auto; height:100%}
body b{color: #00A5E3}
body>a{display:none;}
h2.title {line-height: 45px;font-size: 20px;color: #FF0000;position: fixed;top: 0;height: 45px;-webkit-box-sizing: border-box;width: 100%;z-index: 99;background-color: #f8f9fa;text-align:center;}
.pr5{padding-bottom:45px;}
.pr5 p{margin-bottom:5px;}
.ui-list{background-color:#f8f9fa;padding-bottom:5px}
#mcover{position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0, 0, 0, 0.7);display:none;z-index:20000;}
#mcover img{position:fixed;right: 18px;top:5px;width:260px;height:180px;z-index:20001;}
.a-upload {
    height: 160px;
    width: 160px!important;
    line-height: 70px;
    position: relative;
    cursor: pointer;
    color: #888;
    background: url(image/png.png) no-repeat;
    background-size: 100%!important;
    background-position: left;
    /* border: 1px solid #ddd; */
    border-radius: 4px;
    overflow: hidden;
    display: inline-block;
    margin-top: 15%;
    margin-left: 30%!important;
}
.a-upload input {
    position: absolute;
    font-size: 100px;
    right: 0;
    top: 0;
    opacity: 0;
    filter: alpha(opacity=0);
    cursor: pointer;
}
.mui-btn-floating, .mui-btn-raised, .mui-btn[data-mui-style=fab], .mui-btn[data-mui-style=raised] {
    box-shadow: 0 0 2px rgba(0,0,0,.12), 0 2px 2px rgba(0,0,0,.2);
}
.mui-btn {
    -webkit-animation-duration: .0001s;
    animation-duration: .0001s;
    -webkit-animation-name: mui-node-inserted;
    animation-name: mui-node-inserted;
    font-weight: 500;
    font-size: 14px;
    line-height: 18px;
    color: rgba(0,0,0,.87);
    text-transform: uppercase;
    color: rgba(0,0,0,.87);
    background-color: #FFF;
    transition: all .2s ease-in-out;
    display: inline-block;
    height: 36px;
    padding: 0 26px;
    margin-top: 6px;
    margin-bottom: 6px;
    border: none;
    border-radius: 2px;
    cursor: pointer;
    -ms-touch-action: manipulation;
    touch-action: manipulation;
    background-image: none;
    text-align: center;
    line-height: 36px;
    vertical-align: middle;
    white-space: nowrap;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    font-size: 14px;
    position: relative;
    overflow: hidden;
}
.mui-btn-primary, .mui-btn[data-mui-color=primary] {
    color: #FFF;
    background-color: #2196F3;
}
.mui-btn-floating, .mui-btn[data-mui-style=fab] {
    position: relative;
    padding: 0;
    width: 55px;
    height: 55px;
    line-height: 55px;
    border-radius: 50%;
    z-index: 1;
}
</style>
</head>
<body ontouchstart="">
<?php if(!empty($_REQUEST['name'])){?>
<?php 
$name = $_REQUEST['name'];
$profession = $_REQUEST['profession'];
$manifesto = $_REQUEST['xuanyan'];
$photo = $_REQUEST['file'];



//print_r($image);exit;
//print_r($_REQUEST);exit;
//执行MySQL语句
mysql_query("INSERT INTO user (name,profession,manifesto,photo,openid) VALUES('$name','$profession','$manifesto','$image','$openid')");
	
?>
<div class="wrapper">
	<img  src="submit.php?name=<?=$name?>&id=<?=$profession?>&xuanyan=<?=$manifesto?>&photo=<?=$photo?>" width="100%"/>
</div>
	
	
<?php }elseif(!empty($_GET['action'])){ 
	
			
	?>
	
<form action="" name="form" id="form" enctype="multipart/form-data">
	<div class="wrapper">
		<img src="image/action.jpg" width="100%" style=""/>
		<div class="png">
			<a href="javascript:;" class="a-upload">				
			<input type="file" id="targetImg">
			</a>						
		</div>
		<div class="selects">
			<div class="ui-form-item ui-border-b">
            	<input type="text" name="name" id="name" placeholder="姓名"/>
        </div>
			<div class="ui-form-item ui-border-b " style="margin-left: 10%;">
            	<div class="ui-select">
                	<select name="profession" id="profession">
                    	<option value ="身份">身份</option>
                    	<option value ="设计师">催乳师</option>
                	</select>
            	</div>
        	</div>
			<div style="clear: both;"></div>
			<div class="ui-form-item ui-border-b setwt">
            	<div class="ui-select">
                	<select name="xuanyan" id="xuanyan">
						<option value ="宣言(10字以内)">宣言(10字以内)</option>
						<option value ="敢玩！敢想！敢造">敢玩！敢想！敢造！</option>
						<option value ="厉害了我的设计稿">厉害了我的设计稿</option>
                	</select>
                	<div style="clear: both;"></div>
            	</div>
            	
        	</div>
		</div>
		
			<input type="hidden" name="file" class="file" value="<?=$new_file?>" />	
		<div class="ui-form ">
				<div class="ui-btn-wrap buttom">
	    			<a id="submit" href="javascript:;"><img src="image/10.png" /></a>
				</div>
		</div>
	</div>
</form>
 <div id="showEdit" style="display: none;width:100%;height: 100%;position: absolute;top:0;left: 0;z-index: 9;">
        <div style="width:100%;position: absolute;top:10px;left:0px;">
            <button class="mui-btn" data-mui-style="fab" id='cancleBtn' style="margin-left: 10px;">取消</button>
            <button class="mui-btn" data-mui-style="fab" data-mui-color="primary" id='confirmBtn' style="float:right;margin-right: 10px;">确定</button>
        </div>
        <div id="report">
          <img src="image/default.jpg" style="width: 300px;height:300px"> 
      </div>
        
    </div>
    <link rel="stylesheet" type="text/css" href="css/cropper.min.css">
    <script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
     <script type="text/javascript" src="js/lrz6.mobile.min.js"></script> 
    <script type="text/javascript" src="js/lrz.all.bundle.js"></script>
    <script type="text/javascript" src="js/cropper.min.js"></script>
<script type="text/javascript">
	$(function(){
		$('#submit').click(function(){
			var name = $('#name').val;
			var profession = $('#profession').val;
			var manifesto = $('#xuanyan').val;
			var photo = $('.file').val;
			
			
					
					// data.append('name', name);
					 //data.append('manifesto', manifesto);
					// data.append('profession', profession);
					 //data.append('file', photo[0]);
			 $("form").submit();
           
			
			
			//location.href = "index.php?name="+name+"&id="+profession+"&xuanyan="+manifesto+"&photo="+photo;
					
			
		})
	})
		
		
		
		
	
	function toFixed2(num) {
            return parseFloat(+num.toFixed(2));
       }		
        $('#cancleBtn').on('click', function() {
            $("#showEdit").fadeOut();
            $('#showResult').fadeIn();
        });

        $('#confirmBtn').on('click', function() {
            $("#showEdit").fadeOut();

            var $image = $('#report > img');
            var dataURL = $image.cropper("getCroppedCanvas");
            var imgurl = dataURL.toDataURL("image/jpeg", 0.5);
            $("#changeAvatar > img").attr("src", imgurl);
            $(".a-upload").css("background","url("+imgurl+") no-repeat");
            
            
             $.ajax({
			            type: "post",
			            url: "?pic=pic",
			            data: {
			                file: imgurl
			            },
			            cache:false,
			     		ifModified :true ,
			            dataType: "json",
			            success: function(a) {
			                
			             //alert(a);
			               $(".file").val(a);
			                
			            }
			        });	
            
            
            
            $('#showResult').fadeIn();

        });
			
        function cutImg() {
            $('#showResult').fadeOut();
            $("#showEdit").fadeIn();
            var $image = $('#report > img');
            $image.cropper({
                aspectRatio: 1 / 1,
                autoCropArea: 0.7,
                strict: true,
                guides: false,
                center: true,
                highlight: false,
                dragCrop: false,
                cropBoxMovable: false,
                cropBoxResizable: false,
                zoom: -0.2,
                checkImageOrigin: true,
                background: false,
                minContainerHeight: 400,
                minContainerWidth: 400
            });
        }

        function doFinish(startTimestamp, sSize, rst) {
            var finishTimestamp = (new Date()).valueOf();
            var elapsedTime = (finishTimestamp - startTimestamp);
            //$('#elapsedTime').text('压缩耗时： ' + elapsedTime + 'ms');

            var sourceSize = toFixed2(sSize / 1024),
                resultSize = toFixed2(rst.base64Len / 1024),
                scale = parseInt(100 - (resultSize / sourceSize * 100));
            $("#report").html('<img src="' + rst.base64 + '" style="width: 100%;height:100%">');
            cutImg();
        }
	
	 $('#targetImg').on('change', function() {
            var startTimestamp = (new Date()).valueOf();
            var that = this;
            lrz(this.files[0], {
                    width: 800,
                    height: 800,
                    quality: 0.7
                })
                .then(function(rst) {
                    //console.log(rst);
                    doFinish(startTimestamp, that.files[0].size, rst);
                    return rst;
                })
                .then(function(rst) {
                    // 这里该上传给后端啦
                    // 伪代码：ajax(rst.base64)..

                    return rst;
                })
                .then(function(rst) {
                    // 如果您需要，一直then下去都行
                    // 因为是Promise对象，可以很方便组织代码 \(^o^)/~
                })
                .catch(function(err) {
                    // 万一出错了，这里可以捕捉到错误信息
                    // 而且以上的then都不会执行

                    alert(err);
                })
                .always(function() {
                    // 不管是成功失败，这里都会执行
                });
        });
</script>

<?php }else{ ?>
<div class="wrapper">
	<img src="image/bg.jpg" width="100%" style=""/>
	<div class="ui-form buttom">
    	<a href="?action=action"><img src="image/12.1.png" /></a>
    	<a href="#"><img src="image/12.2.png" /></a>
	</div>	
</div>
<script type="text/javascript">	
</script>
<?php } ?>
</body>
</html>