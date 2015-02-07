/**
 * 
 */

//lert("ya");
document.addEventListener("DOMContentLoaded", function() {
	var movx = new anim("box", 0.01, 0, 1);

	var el = document.getElementById('in');
	var bx = document.getElementById('box');
	el.addEventListener("click", function(){
		st = new style();
		st.left = '0';
		//alert(st.left);
       movx.move('image', 10, 10, 200, 200,'#fffccc');
		//movx.slide(0,100);
		
	
	//	movx.fadein(0.01, 0.01, 1, 20);
	//	movx.fillin(0, 10, 800, 'leftright', 1);
	//	movx.explode(0, 800, 500, 10, 1);
	  //  alert(bx)
	//ctx =  bx.getContext("2d");
//  testDrayImg(200,200,10,10,ctx);
		
		
	    
		});
	
	
	//var movx = new anim("box", 5, 1, 300);
	//movx.move;
	//var el = document.getElementById('txtarea');
	//animate("box", 1, 5, 300);
});
//alert(document.body.clientWidth);
//var el = document.getElementById('in');
//el.oncontextmenu = RightMouseDown; 
//el.onmousedown = doathing; // = showContextMenu;
//el.onclick=doathing;


//setInterval(doathing,300)
 
//window.onload = showContextMenu;
//var i=0;
function doathing()
{
	alert("ya");
    //movx.move(ma, my)
  
	//if(e.which == 40)
		//animate('box', 1, 0, 1);
}

function showContextMenu(e)
{
	
	if(e.which==3)
		{
		  var el1= document.getElementById('context');
		  
		  el1.style.visibility='visible';
		  el1.oncontextmenu = RightMouseDown;
		  el1.style.zIndex='1';

		}
	//document.getElementByID('context')
}

function RightMouseDown() { return false; }

function animate(element, x, y,delay)
{
 setInterval(doanimate, delay,element, x, y)	
}

function doanimate(element, x, y)
{
  
  el = document.getElementById(element);
  width = Number(el.style.width.slice(0,-2));
  height = Number(el.style.height.slice(0,-2));
  number = el.style.left.slice(0, -2);
  numbery = el.style.top.slice(0, -2);
  if(el.parentNode.nodeName ==="BODY"){
     if((Number(number)+width >= Number(el.parentNode.clientWidth)) || (Number(numbeyr)+ height>= Number(el.parentNode.clientHeight)))
		  {
	         
	        return;
		  }
  }
  else{
	  if((Number(number)+width >= Number(el.parentNode.style.width.slice(0,-2))) ||(Number(numbery)+height >= Number(el.parentNode.style.height.slice(0,-2))))
		  return ;
	  }
	  
  tmpx =  Number(number) +x;
  tmpy = Number(numbery)+y;
  if(typeof(x)!= 'undifined')
	  el.style.left = tmpx+'px';
  if(typeof(y)!= 'undifined')
	 el.style.top =tmpy+'px';
   
}

function anim ( elem ,cx, cy,del)
{   
  	this.element = elem;
  	this.x = cx;
  	this.y = cy;
  	this.delayvar = 1;
  	this.delay = del;
	this.elementobj  = document.getElementById(this.element);
	this.clientRect = this.elementobj.getBoundingClientRect();
    this.lastx =0;
    this.lasty = 0;
	this.canvasleft = Number(this.clientRect.left);
	this.canvastop = Number(this.clientRect.top);
	this.canvaswidth = Number(this.clientRect.width);
	this.canvasheight = Number(this.clientRect.height);
	this.setdelay = function(d){this.delay = d;}
	this.setx = function(cx){this.x=cx;}
  	this.move = function(objType,x,y, width,height,color){
  		imgd = null;
  		ele=this;
  		left = Number(ele.elementobj.style.left.slice(0,-2));
  		top = Number(ele.elementobj.style.top.slice(0,-2));
  		if(objType =='image')
  			{
  			img = new image('http://localhost/abricot/images/earth.png', 'this is our home',width,height, x,y);
		   imgd = img.createElement();
  			}
  		setInterval(function(){
  			//alert(dd);
  	//	alert(ele.elementobj);
  			prevx =0;
  			prevy=0;
  		ctx = ele.elementobj.getContext("2d");
  		if(ele.lastx==0 && ele.x !=0)
  			{
  		     movx = Number(left+ele.x)
  		     ele.lastx = movx;
  			}
  		else
  			{
  			  if(ele.x!=0)
  				  {
  		         movx = +ele.lastx+ele.x;
  		         prevx = ele.lastx;
  		         ele.lastx=movx;
  				  }
  			  else
  				  {ele.lastx=0}
  			}
  		if(ele.lasy==0 && ele.y!=0)
  			{
  			   movy = Number(ele.canvastop)+ele.y;
  			   ele.lasty = movy;
  			}
  		else
  			{
  			    if(ele.y!=0)
  			    	{
  			         movy = Number(ele.canvastop)+ele.lasty;
  			         prevy=ele.lasty;
		             ele.lasty+=movy;
  			    	}
  			    else ele.lasty=0;
  			}
  		
  		//alert(color);
  	
  		ctx.fillStyle = color;
  	//	alert(left);
  		ctx.clearRect(prevx,prevy,ele.canvaswidth,ele.canvasheight);
        //alert(ele.lastx);
  		
  		ctx.transform(1,0,0,1,ele.lastx, ele.lasty);
  	//	ctx.fillRect(0, 10,80,80); 
  	
  		if(objType =='image')
  			img.displayElement(ctx);
  		   //testDrayImg(imgd, x ,y,  ctx);
  		if(objType == 'rect')
  			{
  			ctx.fillRect(x, y,width,height); 
  			ctx.fillStyle = color;
  			}
  		
  		}, ele.delay);
  		
  		
  		
  	}
  	this. slide = function(start, ends)
  	{
  		//ele = document.getElementById(elem);
  		if (this.elementobj instanceof HTMLCanvasElement)
  			{
  			
  			   ctx = this.elementobj.getContext('2d');
  			   
  			   
  			}
  		else
  			{
  			
  		 bodyLeft = document.body.getBoundingClientRect();
  		// alert(bodyLeft.left);
  			 ele=this;
  			//ele.elementobj.style.left =  '500px'
  		//	alert(ele.canvasleft);
  		   ele.elementobj.style.visibility='visible';  
  			ele.elementobj.style.left = start;
  			var time = setInterval(function(){
  			//	alert();
  				 left = ele.canvasleft
  				 //alert(left);
  				 if(left ==0)
  					left+= bodyLeft.left;
  				  //  alert(left);
  				   newleft = left+ele.x;
  				   
  		  
  			ele.elementobj.style.left =  newleft+'px';
  			if( left == ends)
  	  			 clearInterval(time);
  		}, ele.delay);
  			
  	
  	}
  	}
  	
  	this.fadein = function(opbegin, scfactor, endop, int)
  	{
  		ele = this;
  		ele.elementobj.style.visibility='visible';
  		ele.elementobj.style.opacity=opbegin;
  	tm=	setInterval(function(){
  			p =ele.elementobj.style.opacity;
  			//alert(p);
  			p = Number(p)+scfactor;
  			ele.elementobj.style.opacity = p;
  			if(p >= endop)
  				clearInterval(tm);
  		}, int);
  		
  	}
  	
  	this.fillin = function(begin, factor, endf, fdir, intr)
  	{ 
  		 //alert(fdir);
  		ele = this;
  	
  	   if(fdir =='topdown'){
  		   ele.elementobj.style.height=begin+'px'
  		
  	   }
  		// alert("hey");
  	   if(fdir =='leftright')
  		   {
  		 ele.elementobj.style.width=begin+'px'
  		
  		   }
  		ele.elementobj.style.visibility = 'visible';
  		// alert( ele.elementobj.style.width);
  		tmr = setInterval(function(){
  	      if(fdir =='topdown')
  	    	  {
  		        	h =Number( ele.elementobj.style.height.slice(0,-2));
  			         h = h+factor;
  			if(h>=endf)
  				clearInterval(tmr);  	
  	    	
  			ele.elementobj.style.height = h+'px';
  	    	  }
  	    if(fdir =='leftright')
    	  {
	        	w =Number( ele.elementobj.style.width.slice(0,-2));
		         w= w+factor;
		if(w>=endf)
			clearInterval(tmr);  	
    	
		ele.elementobj.style.width = w+'px';
    	  }
  		}, intr);
  	}
  	
  	this.explode = function(exstart, xend,yend, exfactor,intex)
  	{
  		ele=this;
  		ele.elementobj.style.height = exstart+'px';
  		ele.elementobj.style.width = exstart+'px';
  		ele.elementobj.style.visibility = 'visible';
  		tmrex = setInterval(function(){
  		ht =Number( ele.elementobj.style.height.slice(0,-2));
  		wt =Number( ele.elementobj.style.width.slice(0,-2));
  		if(ht < yend)
  	       ht = ht+exfactor;
  		if(wt < xend)
    	     wt= wt+exfactor;
  		
  		ele.elementobj.style.height = ht+'px';
  		ele.elementobj.style.width = wt+'px';
  		if(wt>=xend && wt>=yend)
			clearInterval(tmrex);  	
  		}, intex);
  	}
  	
  	this.fillCanvas = function(ctx)
  	{
  		
  	}
  	
}

function siteElement()
{//this array is to be appended with new types as theey become known
	this.typesArray = ['img', 'div','canvas','link', 'para', 'span'];
	this.element = "";
	this.type = "";
	this.width;
	this.height;
	this.left =0;
	this.top=0;
  	this.elementName = function(name){
  		this.element = name;
  	}
  	this.elementType = function(eleType)
  	{
  		this.type = eleType;
  	}
  	
}

siteElement.prototype.createElement= function()
{
	alert ("no call");
	/*  var returnElement;
	  for(i = 0; i < this.typesArray.length; i++)
		  {
		     if(this.typesArray[i] === type)
		    	 {
		    	   if(type==='img')
		    		   {
		    		      returnElement = new Image();
		    		   }
		    	 }
		  }*/
}
siteElement.prototype.displayElement = function(ctx)
{
	
}

siteElement.prototype.getElement = function()
{
	
	return this.element;
}


image.prototype = new siteElement();
{
}

image.prototype.constructor = image;
function image(asrc, aalt, w, h, l,t)
{

  	if(this.src !="")
  		this.src = "";
  	this.src = asrc;
  	this.alt = aalt;
  	this.width = w;
  	this.height=h;
  	this.top = t;
  	this.left = l;
}

image.prototype.createElement =function()
{
	this.element = new Image();
	this.element.src="";
	this.element.src= this.src;
	//alert(this.element.src);
	this.element.alt=this.alt;
	this.element.width = this.width;
	this.element.height = this.height;	
	this.element.top=this.top;
	this.element.left = this.left;
	//alert(this.element.width);
	return this.element;
	
}
image.prototype.displayElement =function(ctx)
{

	if(ctx !='undifined')
		{
	//	alert(this.x);
		ctx.drawImage(this.element, this.left, this.top,this.width, this.height);
		}
}





function style()
{
  this.color;
  this.heigth;
  this.width;
  this.left;
  this.top;
  this.border;
  this.bordersz;
  this.float;
  
}


function testDrayImg(imgdd, x,y,ctx)
{
	//alert("yeah");
	//alert(ele);
	      // ctx = ele.getContext("2d");
	  	// alert("dd");
	    //ctx.clearRect(left-10,ele.canvastop,ele.canvaswidth,ele.canvasheight);
    //alert(ele.lastx);
	
		//alert(img.src);
	//	alert(img.src);
		//ctx.fillStyle ='#ffffff'
	//alert(imgd);
		//imgdd.onload =  function(){
	
			//alert(img.height);
		//	alert(imgdd);
			ctx.drawImage(imgdd, x,y,img.width, img.height);
			//ctx.fillStyle ='#ffffff';
	//	}
}


//check this out update it for use 
/*
function getSupportedPropertyName(properties) {
    for (var i = 0; i < properties.length; i++) {
        if (typeof document.body.style[properties[i]] != "undefined") {
            return properties[i];
        }
    }
    return null;
}
  
  
var transform = ["transform", "msTransform", "webkitTransform", "mozTransform", "oTransform"];
  
*/		
