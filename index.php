<?php
error_reporting(0); 
//scope=snsapi_userinfo实例
//$appid='wx8ee5a78c212504fb';
//$redirect_uri = urlencode ( 'http://code.8lai.club/getUserInfo.php' );
//$url="https://open.weixin.qq.com/connect/oauth2/authorize?appid=$appid&redirect_uri=$redirect_uri&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect";
//header("Location:".$url);
//include ('getUserInfo.php');

$mysql_server="localhost";
$mysql_username="root";
$mysql_password="root";//
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
<link type="text/css" rel="stylesheet" href="css/jquery.editable-select.min.css" />

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
    
    line-height: 70px;
    position: relative;
    cursor: pointer;
    color: #888;
	width: 160px;	
    /* border: 1px solid #ddd; */
    overflow: hidden;
    display: inline-block;
    margin-left: 30%!important;
}
.a-upload img{ padding:3%;width: 160px; border-radius: 50%;}
.a-upload input {
    position: absolute;
    font-size: 100px;
    right: 0;
    top: 0;
    opacity: 0;
    filter: alpha(opacity=0);
    cursor: pointer;
}

.toBar{
				width: 100%;
				padding: 15px;
				-webkit-box-sizing: border-box;
				box-sizing: border-box;
				position: absolute;
				left: 0;
				top: 0;
				z-index: 1;
			}
			.toBar label input{
				display: none;
			}
			.toBar label,.toBar button{
				display: inline-block;
				width: 100px;
				text-align: center;
				padding: 10px 0;
				font-size: 12px;
				color: #fff;
				background: #8080ca;
				border-radius: 6px;
				cursor: pointer;
			}
			.toBar button{
				border: none;
				float: right;
			}
			.img_content{display: none;}
			
.img_content,canvas{
				position: absolute;
				top: 50%;
				left: 50%;
				-webkit-transform: translate(-50%,-50%);
				transform: translate(-50%,-50%);
				border-radius: 50%;
				
			}
			canvas{
				display: none;
				border: 1px solid #333;
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
	<!--<div style="margin: 0 auto; width: 100%; text-align: center; position: absolute; top:45%;"><img src="image/end.gif" width="50%" height="100%" /></div>-->
</div>
	
	
<?php }elseif(!empty($_GET['action'])){ ?>
	
		<link rel="stylesheet" type="text/css" href="css/mdialog.css">
<form action="" name="form" id="form" enctype="multipart/form-data">
	<div class="wrapper">
		<img src="image/action.jpg" width="100%" style=""/>
		<div class="png">
			<a href="javascript:;" class="a-upload">				
			<img src="image/png.png" id="imgs"/>
			</a>
			<input type="file" id="targetImg" style="display: none;">						
		</div>
		<div class="selects" >
			<div class="ui-form-item ui-border-b" style="border: none;">
            	<input type="text" name="name" id="username" placeholder="姓名"/>
        </div>
			<div class="ui-form-item ui-border-b " style="margin-left: 10%; border: none; ">
            	<div class="ui-select" style="">
                	<select name="profession" id="profession" style="background:#ffffff;">
                    	<option value ="身份">身份</option>
                    	<option value ="设计师">设计师</option>
                    	<option value ="创造者">创造者</option>
                	</select>
            	</div>
        	</div>
			<div style="clear: both;"></div>
			<div class="ui-form-item ui-border-b setwt" style=" border: none; ">
            	<div class="ui-select">
                	<select name="xuanyan" id="xuanyan" style="background:#ffffff;" class="manifesto">
						<option value ="敢玩！敢想！敢造">敢玩！敢想！敢造！</option>
						<option value ="厉害了我的设计稿">厉害了我的设计稿</option>
                	</select>
                	<div style="clear: both;"></div>
            	</div>
            	
        	</div>
		</div>
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/jquery.editable-select.min.js"></script>
		<script type="text/javascript">
		$('.manifesto').editableSelect({
			effects: 'slide'
		});
		</script>
			<input type="hidden" name="file" class="file" value="<?=$new_file?>" />	
		<div class="ui-form ">
				<div class="ui-btn-wrap buttom">
	    			<a id="submit" href="javascript:;"><img src="image/10.png" /></a>
				</div>
		</div>
	</div>
</form>
		<div class="toBar" style="display: none;">
			
			<button type="button">使用</button>
		</div>
		<div class="img_content" >
			<img src="" id="img"/>
		</div>
		<!--裁剪图片框。宽高为定义裁剪出的图片大小-->
		<canvas width="450" height="450"></canvas>
		
		<script src="js/img.js"></script>
		<script src="js/require.js"></script>
		<script src="js/main.js"></script>
		<script src="js/zepto.min.js"></script>	
		<script type="text/javascript" src="js/mdialog.js"></script>

<script type="text/javascript">
	$("#imgs").click(function(){
		$("#targetImg").click();
		
					$(".img_content").show();
					$("canvas").show();
					$(".toBar").show();
					$("#form").hide();
		
	})
		$('#submit').click(function(){
			
			//check();
			if(check()){
			$("form").submit();
			}
			//location.href = "index.php?name="+name+"&id="+profession+"&xuanyan="+manifesto+"&photo="+photo;
					
			
		})
		function check(){
			var name = $('#username').val();
			var profession = $('#profession').val();
			var manifesto = $('#xuanyan').val();
			var photo = $('.file').val();
			//alert(name);
			
			
			if (name == ''){
				//Console.log('请输入名称');
				new TipBox({
					type: 'error',
					str: '请输入名称!',
					hasBtn: true
				});
				return false;
				//alert('请输入名称');
			}
			if (profession == "身份"){
				new TipBox({
					type: 'error',
					str: '请选择身份职业!',
					hasBtn: true
				});
				return false;
			}
			if (manifesto == ''){
				new TipBox({
					type: 'error',
					str: '请选择或者输入宣言!',
					hasBtn: true
				});
				return false;
			}
			if (photo == ''){
				new TipBox({
					type: 'error',
					str: '请上传图片!',
					hasBtn: true
				});
				return false;
			} 
			return true;
		}
	
			
			window.addEventListener("load",function(){
				var $input = document.querySelector("#targetImg");
				var $img = document.querySelector("#img");
				var $canvas = document.querySelector("canvas");
				//选择图片
				$input.addEventListener("change",function(){
					$img.src = getFileUrl(this);
					//alert($img.src);
					//$canvas.show();
					//alert($img.src);
				},false);
				
				
				
				var myCrop;
				require(["jquery", 'hammer', 'tomPlugin', "tomLib", 'hammer.fake', 'hammer.showtouch'], function($, hammer, plugin, T) {
					document.addEventListener("touchmove", function(e) {
							e.preventDefault();
					});
					var opts = {
							cropWidth: $canvas.width,
							cropHeight: $canvas.height
					},
					previewStyle = {
						x: 0,
						y: 0,
						scale: 1,
						rotate: 0,
						ratio: 1
					},
					transform = T.prefixStyle("transform"),
					myCrop = T.cropImage({
						bindFile: $("#targetImg"),
						enableRatio: false, //是否启用高清,高清得到的图片会比较大
						canvas: $canvas, //放一个canvas对象
						cropWidth: opts.cropWidth, //剪切大小
						cropHeight: opts.cropHeight,
						bindPreview: $("#img"), //绑定一个预览的img标签
						useHammer: true, //是否使用hammer手势，否的话将不支持缩放
						oninit: function() {
		
						},
						onLoad: function(data) {
							//用户每次选择图片后执行回调
							resetUserOpts();
							previewStyle.ratio = data.ratio;
							$("#img").attr("src", data.originSrc).css({
								width: data.width,
								height: data.height
							}).css(transform, 'scale(' + 1 / previewStyle.ratio + ')');
							myCrop.setCropStyle(previewStyle)
						}
					});
		
					function resetUserOpts() {
						$("canvas").hammer('reset');
						previewStyle = {
							scale: 1,
							x: 0,
							y: 0,
							rotate: 0
						};
						$("#img").attr("src", '');
					};
					$("canvas").hammer({
						gestureCb: function(o) {
							//每次缩放拖拽的回调
							$.extend(previewStyle, o);
							console.log("用户修改图片", previewStyle)
							$("#img").css(transform, "translate3d(" + previewStyle.x + 'px,' + previewStyle.y + "px,0) rotate(" + previewStyle.rotate + "deg) scale(" + (previewStyle.scale / previewStyle.ratio) + ")")
						}
					});
					
					$("button").on("click", function() {
						
						myCrop.setCropStyle(previewStyle)
						var src = myCrop.getCropFile({});
						//window.location.href = src;
						
						
						 $.ajax({
				            type: "post",
				            url: "?pic=pic",
				            data: {
				                file: src
				            },
				            cache:false,
				     		ifModified :true ,
				            dataType: "json",
				            success: function(a) {
				                
				             //alert(a);
				               $(".file").val(a);
				               
            				$("#imgs").attr("src",a);
						$(".img_content").hide();
						$("canvas").hide();
						$(".toBar").hide();
						$("#form").show();
				                
				            }
				        });	
						
						
						
						
						
						
						
						
					});
				});
				
				
			},false);
		</script>

<?php }else{ ?>
<div class="wrapper">
	<img src="image/bg.jpg" width="100%" style=""/>
	<div class="ui-form buttom">
    	<a href="?action=action" ><img src="image/12.1.png" /></a>
    	<a href="http://m.lkker.com/topic/321sz" style="margin-top: 5px;"><img src="image/12.2.png" /></a>
	</div>	
</div>
<script type="text/javascript">	
</script>
<?php } ?>
</body>
</html>