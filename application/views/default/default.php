<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
 <?php  $html = new ab_html(); 
 global $template;
 $template['regions']['bottom']="lower content";
 ?>
<title><?php echo $title ?></title>
<?php  echo $html->includeCss("main"); ?>
<!-- <script type="text/javascript">
var imgThmb = document.createElement('img');
imgThmb.src = "<?php //echo BASE_PATH;?>images/usr.png";
var c = document.getElementById("120_circle");
var ctx = c.getContext("2d");
imgThmb.onload = function(){
	

ctx.beginPath();
ctx.arc(90,90,90,0,2*Math.PI);
//var img = new image();
ctx.fillStyle="#FFFFFF";
ctx.fill();
//ctx.drawImage(img,0,0);
ctx.closePath();

ctx.clip();
//ctx.drawImage(imgThmb, 0, 0,180,180);
//ctx.arc(60,60,60,0,2*Math.PI);
var image = c.toDataURL("<?php // echo BASE_PATH;?>application/views/default/usr.png");

ctx.stroke();

};

</script>
-->
</head>

<body>


<div id="header"><div id="headcent"><h3>KIDSFUNREADSPACE</h3> 
<div id="whteffect">
<div class="canvHoldHd"> <canvas  id ="arc5" width="80" height="80"></canvas></div>
<div class="canvHoldHdf"> <canvas  id ="arc4" width="80" height="80"></canvas></div>
<div class="canvHoldHdf"> <canvas  id ="arc6" width="80" height="80"></canvas></div>
<div class="canvHoldHdf"> <canvas  id ="arc1" width="80" height="80"></canvas></div>
<div class="canvHoldHdf"> <canvas  id ="arc2" width="80" height="80"></canvas></div>
<div class="canvHoldHdf"> <canvas  id ="arc3" width="80" height="80"></canvas></div>

</div>
<div id =search>
<input class= "csearch" type="search" name ="search" placeholder="search" />
</div>
</div>

</div>
<div id="content">

<div id=snipetgroup>
<div class="center-box">
<div id="featured">
<div id =search></div>
<h2>Featured Stories</h2> 
<p>Here you will find all stories for your children help you self {ab_theme_content}</p>

</div>
<div class="snippet">
<a href ="#"><img src="<?php echo BASE_PATH.'/images/img1.jpg';?>" width="300" height="200" /></a>
<?php  //echo $html->link('','test/index') ?>
<?php// echo password_hash("key",PASSWORD_DEFAULT);?>
<canvas id = "test"></canvas>

</div>
<div class ="snippetg">
<a href ="#"><img src="<?php echo BASE_PATH.'/images/img2.jpg';?>" width="300" height="200" /></a>
</div>

<div class ="snippet_last">
<a href ="#"><img src="<?php echo BASE_PATH.'/images/img3.jpg';?>" width="304" height="200" /></a>
</div>
</div>
</div>
<div class="holder">
<div class="mediabox"> <textarea rows="20" cols="100"></textarea></div>
</div>
</div>

<div id="footer">
<div id="footer_center">

<span>kidsfunread.com {bottom} &copy; 2014</span> &nbsp; &nbsp; <span>Home | Srories| Animated Movies| Folk tales</span>
</div>
</div>


<script type="text/javascript">
var c=document.getElementById("arc4");
var ctx=c.getContext("2d");
ctx.beginPath();
ctx.arc(40,40,38,0,2*Math.PI);
ctx.fillStyle=" #FFC107";
ctx.webkitImageSmoothingEnabled=true;
ctx.strokeStyle="#FFC107";
ctx.lineWidth = 2; 
ctx.stroke();
ctx.fill();
ctx.clip();
ctx.font="10pt Georgia";
ctx.fillStyle="#ffffff";

ctx.fillText("Contact",15,45);
</script>


<script type="text/javascript">
var c=document.getElementById("arc6");
var ctx=c.getContext("2d");
ctx.beginPath();
ctx.arc(40,40,38,0,2*Math.PI);
ctx.fillStyle=" #03A9F4";
ctx.webkitImageSmoothingEnabled=true;
ctx.strokeStyle="#03A9F4";
ctx.lineWidth = 2; 
ctx.stroke();
ctx.fill();
ctx.clip();
ctx.font="10pt Georgia";
ctx.fillStyle="#ffffff";

ctx.fillText("Videos",20,45);
</script>
<script type="text/javascript">
var c=document.getElementById("arc5");
var ctx=c.getContext("2d");
ctx.beginPath();
ctx.arc(40,40,38,0,2*Math.PI);
ctx.fillStyle=" #8BC34A";
ctx.webkitImageSmoothingEnabled=true;
ctx.strokeStyle="#8BC34A";
ctx.lineWidth = 2; 
ctx.stroke();
ctx.fill();
ctx.clip();
ctx.font="10pt Georgia";
ctx.fillStyle="#ffffff";

ctx.fillText("About",21,45);
</script>


<script type="text/javascript">
var c=document.getElementById("arc1");
var ctx=c.getContext("2d");
ctx.beginPath();
ctx.arc(40,40,38,0,2*Math.PI);
ctx.fillStyle=" #FF5722";
ctx.webkitImageSmoothingEnabled=true;
ctx.strokeStyle="#FF5722";
ctx.lineWidth = 2; 
ctx.stroke();
ctx.fill();
ctx.clip();
ctx.font="10pt Georgia";
ctx.fillStyle="#ffffff";

ctx.fillText("Bed Time",10,45);
</script>
<script type="text/javascript">
var c=document.getElementById("arc2");
var ctx=c.getContext("2d");
ctx.beginPath();
ctx.arc(40,40,38,0,2*Math.PI);
ctx.fillStyle="#CDDC39"
ctx.webkitImageSmoothingEnabled=true;
ctx.strokeStyle="#CDDC39";
ctx.lineWidth = 2; 
ctx.stroke();
ctx.fill();
ctx.clip();
ctx.font="10pt Georgia";
ctx.fillStyle="#ffffff";

ctx.fillText("Games",19,45);
</script>
<script type="text/javascript">
var c=document.getElementById("arc3");
var ctx=c.getContext("2d");
ctx.beginPath();
ctx.arc(40,40,38,0,2*Math.PI);
ctx.webkitImageSmoothingEnabled=true;
ctx.fillStyle="#E91E63";
ctx.fill();
ctx.strokeStyle="#E91E63";
ctx.lineWidth = 2; 
ctx.stroke();
ctx.clip();
ctx.font="10pt Georgia";
ctx.fillStyle="#ffffff";

ctx.fillText("Folk Tales",10,45);
</script>
</body>
</html>