<?php $html = new ab_html(); 
// global $template;

 
 ?>  
 <!-- 
 <html>
 <head>

 </head>
 <body>
 
 <div class="wcontainer"> 
 <div id="context">
 <ul id=contextlist>
 <li>Copy</li>
 <li>Paste</li>
 <li>Bold</li>
 <li>Italic</li>
 </ul>
 </div>
 <textarea id="txtarea"  rows="20" cols="100"></textarea></div>
   <div id="cc" style="width:800px; height:500px; position:relative; margin: 0 auto; border: 1px solid #000;"> 
 <canvas id="box" width="800" height="500"></canvas>
 <input type="submit" id="in" />
 </div> 
 
 <script type="text/javascript">
//alert(document.body.clientWidth);
 var el = document.getElementById('in');
 //el.oncontextmenu = RightMouseDown; 
 //el.onmousedown = doathing; // = showContextMenu;
 el.onclick=doathing;
 </script>
 </body>
 </html>
 -->
 
 <!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width" />
<?php echo $html->includeCss("wisiwigmobile", "only screen and (max-device-width:766px)"); ?> 
<?php echo $html->includeCss("wisiwig", "screen  and (min-device-width: 1024px)"); ?> 
<?php echo $html->includeCss("wisiwigtab", "only screen and (min-device-width: 768px) and (max-device-width: 1024px)"); ?> 
<!--[if (lt IE 9)&(!IEMobile)]>
 <?php echo $html->includeCss("wisiwig", "screen");  ?> 
<![endif]-->
</head>
<body>
<p>I have a date on <time datetime="2015-02-12T08:00:00+00:00">Valentines day</time>10:00.</p>
<input type="submit" id="in" class="inc" />
<div id = "side"></div>
{title}
<canvas id="box" width="800" height="400"  style="border:1px solid #d3d3d3;">
Your browser does not support the HTML5 canvas tag.
</canvas>

<?php echo $html->includeJavascript("abricot"); ?>
<script>
/* i=0;
function doit()
{
	i+10;
var c = document.getElementById("cc");
var ctx = c.getContext("2d");
t=i+10;
ctx.clearRect(0,0,430,280);
ctx.transform(1,0,0,1,t,t);
ctx.fillStyle='lightblue';
ctx.fillRect(50,50,80,80);


}*/
</script>
<script type="text/javascript">redystate(); </script>
</body>
</html>
 
 