<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
 <?php  $html = new ab_html(); ?>
<title>{ab_theme_title}</title>
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
{ab_theme_content}

<div id="header"><div id="headcent"><h3>KIDSFUNREADSPACE</h3> 
<div id="whteffect">
<div class="canvHoldHd"> <canvas  id ="arc5" width="80" height="80"></canvas></div>
<div class="canvHoldHdf"> <canvas  id ="arc4" width="80" height="80"></canvas></div>
<div class="canvHoldHdf"> <canvas  id ="arc6" width="80" height="80"></canvas></div>
<div class="canvHoldHdf"> <canvas  id ="arc1" width="80" height="80"></canvas></div>
<div class="canvHoldHdf"> <canvas  id ="arc2" width="80" height="80"></canvas></div>
<div class="canvHoldHdf"> <canvas  id ="arc3" width="80" height="80"></canvas></div>

</div>
</div>

</div>
<div id="content">
<div id=snipetgroup>
<div id="featured">
<h2>Featured Stories</h2>
<p>Here you will find all stories for your children help you self</p>

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
<div class="holder">
<div class="mediabox"><?php echo $html->embed("http://www.youtube.com/watch?v=7RCGKZ6g2CE");?></div>

</div>
</div>
<div id="footer">
<div id="footer_center">
<span>kidsfunread.com &copy; 2014</span> &nbsp; &nbsp; <span>Home | Srories| Animated Movies| Folk tales</span>
</div>
</div>


<script type="text/javascript">
var c=document.getElementById("arc4");
var ctx=c.getContext("2d");
ctx.beginPath();
ctx.arc(40,40,38,0,2*Math.PI);
ctx.fillStyle=" #ffffff";
ctx.webkitImageSmoothingEnabled=true;
ctx.strokeStyle="#ef1f6d";
ctx.lineWidth = 2; 
ctx.stroke();
ctx.fill();
ctx.clip();
ctx.font="10pt Georgia";
ctx.fillStyle="#7fb112";

ctx.fillText("Contact",15,45);
</script>


<script type="text/javascript">
var c=document.getElementById("arc6");
var ctx=c.getContext("2d");
ctx.beginPath();
ctx.arc(40,40,38,0,2*Math.PI);
ctx.fillStyle=" #009acd";
ctx.webkitImageSmoothingEnabled=true;
ctx.strokeStyle="#009acd";
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
ctx.fillStyle=" #7fb112";
ctx.webkitImageSmoothingEnabled=true;
ctx.strokeStyle="#7fb112";
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
ctx.fillStyle=" #ff751a";
ctx.webkitImageSmoothingEnabled=true;
ctx.strokeStyle="#ff751a";
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
ctx.fillStyle="#9ecd64"
ctx.webkitImageSmoothingEnabled=true;
ctx.strokeStyle="#9ecd64";
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
ctx.fillStyle="#f0449a";
ctx.fill();
ctx.strokeStyle="#f0449a";
ctx.lineWidth = 2; 
ctx.stroke();
ctx.clip();
ctx.font="10pt Georgia";
ctx.fillStyle="#ffffff";

ctx.fillText("Folk Tales",10,45);
</script>
</body>
</html>