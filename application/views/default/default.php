<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>{ab_theme_title}</title>
</head>
<body>
{ab_theme_content}
<a href ="#"><canvas id ="120_circle" height="190" width="190">

</canvas></a>
 <?php  $html = new ab_html(); echo $html->link('the link','test/index') ?>

<canvas id = "test"></canvas>
<script type="text/javascript">
var imgThmb = document.createElement('img');
imgThmb.src = "<?php echo BASE_PATH;?>images/usr.png";
var c = document.getElementById("120_circle");
var ctx = c.getContext("2d");
imgThmb.onload = function(){
	

ctx.beginPath();
ctx.arc(90,90,90,0,2*Math.PI);
//var img = new image();
ctx.fillStyle="#FF0000";
ctx.fill();
//ctx.drawImage(img,0,0);
ctx.closePath();

ctx.clip();
ctx.drawImage(imgThmb, 0, 0,180,180);
//ctx.arc(60,60,60,0,2*Math.PI);
//var image = c.toDataURL("<?php echo BASE_PATH;?>application/views/default/usr.png");

//ctx.stroke();

};
</script>
</body>
</html>