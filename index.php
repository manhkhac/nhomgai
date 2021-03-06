﻿<!DOCTYPE HTML>
<!DOCTYPE html PUBLIC "" "">
<HTML>
<HEAD>
<META content="IE=11.0000" 
http-equiv="X-UA-Compatible">
		 
<META charset="utf-8">		 
<META name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
<TITLE>Nhòm gái</TITLE>		 
<link rel="shortcut icon" href="img/bg.ico">
<STYLE>
			html, body {
				height: 100%;
			}

			body {
				background-color: #000000;
				margin: 0;
				font-family: Arial;
				overflow: hidden;
			}

			a {
				color: #ffffff;
			}

			#info {
				position: absolute;
				width: 100%;
				color: #ffffff;
				padding: 5px;
				font-family: Monospace;
				font-size: 13px;
				font-weight: bold;
				text-align: center;
			}

			#menu {
				position: absolute;
				bottom: 20px;
				width: 100%;
				text-align: center;
			}

			.element {
				width: 120px;
				height: 160px;
				box-shadow: 0px 0px 12px rgba(0,255,255,0.5);
				border: 1px solid rgba(127,255,255,0.25);

				cursor: default;
			}

			.element:hover {
				box-shadow: 0px 0px 12px rgba(0,255,255,0.75);
				border: 1px solid rgba(127,255,255,0.75);
			}
				
				.element img {
					position: absolute;
					border:none;
				}
				
				.element .number {
					position: absolute;
					top: 20px;
					right: 20px;
					font-size: 12px;
					color: rgba(127,255,255,0.75);
				}

				.element .symbol {
					position: absolute;
					top: 40px;
					left: 0px;
					right: 0px;
					font-size: 60px;
					font-weight: bold;
					color: rgba(255,255,255,0.75);
					text-shadow: 0 0 10px rgba(0,255,255,0.95);
				}

				.element .details {
					position: absolute;
					bottom: 15px;
					left: 0px;
					right: 0px;
					font-size: 12px;
					color: rgba(127,255,255,0.75);
				}
				
			button {
				color: rgba(127,255,255,0.75);
				background: transparent;
				outline: 1px solid rgba(127,255,255,0.75);
				border: 0px;
				padding: 5px 10px;
				cursor: pointer;
			}
			button:hover {
				background-color: rgba(0,255,255,0.5);
			}
			button:active {
				color: #000000;
				background-color: rgba(0,255,255,0.75);
			}
			
			@media screen and (max-width: 800px) { 
				#rj {
					display: none;
				}
				
				#demo {
					display: none;
				}
				#info {
					display: none;
				}
			}
		</STYLE>
	 
	<META name="GENERATOR" content="MSHTML 11.00.9600.16476">

	<link href="css/lightbox.css" rel="stylesheet" />

	<?php 
		include 'config.php';
	?>
	
</HEAD>	 
<BODY>
	
<script src="js/jquery-1.10.2.min.js"></script>

<script src="js/lightbox-2.6.min.js"></script>
	
<SCRIPT src="js/three.min.js"></SCRIPT>
		 
<SCRIPT src="js/tween.min.js"></SCRIPT>
		 
<SCRIPT src="js/TrackballControls.js"></SCRIPT>
		 
<SCRIPT src="js/CSS3DRenderer.js"></SCRIPT>
		 
<DIV id="container"></DIV>
<DIV id="info">
	
	<A href="" target="_blank">Ruanyu Jian</A>
</DIV>
<DIV id="rj" >
	<img src='img/rj.jpg' width = '130px',height = '130px'></br>
	
</DIV>

<div id="demo" >
	<h3>3D</h3></br>
	<img src='img/3.gif' width = '80px',height = '80px'></br>
	<img src='img/1.gif'  width = '80px',height = '80px'></br>	
	<img src='img/2.gif'  width = '80px',height = '80px'></br>
	<img src='img/4.gif'  width = '80px',height = '80px'></br>
</div>

<DIV id="menu">
	<BUTTON id="table">hình xếp</BUTTON>
	<BUTTON id="sphere">cầu</BUTTON>
	<BUTTON id="helix">trụ</BUTTON>
	<BUTTON id="grid">Lập phương</BUTTON>

<SCRIPT>	
		
		var Sys={};
		  var ua=navigator.userAgent.toLowerCase();
		  var s;
		  (s=ua.match(/msie ([\d.]+)/))?Sys.ie=s[1]:
		  (s=ua.match(/firefox\/([\d.]+)/))?Sys.firefox=s[1]:
		  (s=ua.match(/chrome\/([\d.]+)/))?Sys.chrome=s[1]:
		  (s=ua.match(/opera.([\d.]+)/))?Sys.opera=s[1]:
		  (s=ua.match(/version\/([\d.]+).*safari/))?Sys.safari=s[1]:0;
		  if(!(Sys.chrome || Sys.firefox)){//chrome、firefox
			  document.write('</br><font size="1" color="white">3D：hrome、firefox</font>');
		  }
</SCRIPT>	
	
<SCRIPT>
			
			var table = [];
			
			var camera, scene, renderer;
			var controls;

			var objects = [];
			var targets = { table: [], sphere: [], helix: [], grid: [] };


//		    isBrowser();

			
			getImgs();
			init();
			animate();
			
			function init() {

				camera = new THREE.PerspectiveCamera( 40, window.innerWidth / window.innerHeight, 1, 10000 );
				camera.position.z = 3000;

				scene = new THREE.Scene();
				
				
				for ( var i = 0; i < table.length ; i ++ ) {

					var element = document.createElement( 'div' );
					element.className = 'element';
					element.style.backgroundColor = 'rgba(0,127,127,' + ( Math.random() * 0.5 + 0.25 ) + ')';

					var a = document.createElement('a');
					a.href =  'photo/' + table[ i ][0];
					a.setAttribute('data-lightbox','roadtrip');
					a.setAttribute('title',a.href.substr(a.href.lastIndexOf('/')+1));
//					a.setAttribute('text-align','center');
					
					var image=new Image();
					image.src='photoResize/'+table[ i ][0];
					a.appendChild(image)
					
					element.appendChild( a );

					var object = new THREE.CSS3DObject( element );
					object.position.x = Math.random() * 4000 - 2000;
					object.position.y = Math.random() * 4000 - 2000;
					object.position.z = Math.random() * 4000 - 2000;
					scene.add( object );

					objects.push( object );

					var object = new THREE.Object3D();
					object.position.x = ( table[ i ] [1] * 140 ) - 1330;
					object.position.y = - ( table[ i ] [2]* 180 ) + 990;
					targets.table.push( object );					

					image.addEventListener('load',function(event)
					{
						resizeImg(this,120,160);
					},false);

				}

				// sphere

				var vector = new THREE.Vector3();

				for ( var i = 0, l = objects.length; i < l; i ++ ) {

					var phi = Math.acos( -1 + ( 2 * i ) / l );
					var theta = Math.sqrt( l * Math.PI ) * phi;

					var object = new THREE.Object3D();

					object.position.x = 800 * Math.cos( theta ) * Math.sin( phi );
					object.position.y = 800 * Math.sin( theta ) * Math.sin( phi );
					object.position.z = 800 * Math.cos( phi );

					vector.copy( object.position ).multiplyScalar( 2 );

					object.lookAt( vector );

					targets.sphere.push( object );

				}

				// helix

				var vector = new THREE.Vector3();

				for ( var i = 0, l = objects.length; i < l; i ++ ) {

					var phi = i * 0.175 + Math.PI;

					var object = new THREE.Object3D();

					object.position.x = 900 * Math.sin( phi );
					object.position.y = - ( i * 8 ) + 450;
					object.position.z = 900 * Math.cos( phi );

					vector.x = object.position.x * 2;
					vector.y = object.position.y;
					vector.z = object.position.z * 2;

					object.lookAt( vector );

					targets.helix.push( object );

				}

				// grid

				for ( var i = 0; i < objects.length; i ++ ) {

					var object = new THREE.Object3D();

					object.position.x = ( ( i % 5 ) * 400 ) - 800;
					object.position.y = ( - ( Math.floor( i / 5 ) % 5 ) * 400 ) + 800;
					object.position.z = ( Math.floor( i / 25 ) ) * 1000 - 2000;

					targets.grid.push( object );

				}

				//

				renderer = new THREE.CSS3DRenderer();
				renderer.setSize( window.innerWidth, window.innerHeight );
				renderer.domElement.style.position = 'absolute';
				document.getElementById( 'container' ).appendChild( renderer.domElement );

				//

				controls = new THREE.TrackballControls( camera, renderer.domElement );
				controls.rotateSpeed = 0.5;
				controls.minDistance = 500;
				controls.maxDistance = 6000;
				controls.addEventListener( 'change', render );

				var button = document.getElementById( 'table' );
				button.addEventListener( 'click', function ( event ) {

					transform( targets.table, 2000 );

				}, false );

				var button = document.getElementById( 'sphere' );
				button.addEventListener( 'click', function ( event ) {

					transform( targets.sphere, 2000 );

				}, false );

				var button = document.getElementById( 'helix' );
				button.addEventListener( 'click', function ( event ) {

					transform( targets.helix, 2000 );

				}, false );

				var button = document.getElementById( 'grid' );
				button.addEventListener( 'click', function ( event ) {

					transform( targets.grid, 2000 );

				}, false );

				transform( targets.table, 5000 );
				//transform( targets.helix, 2000 );
				//

				window.addEventListener( 'resize', onWindowResize, false );

			}

			function transform( targets, duration ) {

				TWEEN.removeAll();

				for ( var i = 0; i < objects.length; i ++ ) {

					var object = objects[ i ];
					var target = targets[ i ];

					new TWEEN.Tween( object.position )
						.to( { x: target.position.x, y: target.position.y, z: target.position.z }, Math.random() * duration + duration )
						.easing( TWEEN.Easing.Exponential.InOut )
						.start();

					new TWEEN.Tween( object.rotation )
						.to( { x: target.rotation.x, y: target.rotation.y, z: target.rotation.z }, Math.random() * duration + duration )
						.easing( TWEEN.Easing.Exponential.InOut )
						.start();

				}

				new TWEEN.Tween( this )
					.to( {}, duration * 2 )
					.onUpdate( render )
					.start();

			}

			function onWindowResize() {

				camera.aspect = window.innerWidth / window.innerHeight;
				camera.updateProjectionMatrix();

				renderer.setSize( window.innerWidth, window.innerHeight );

			}

			function animate() {

				requestAnimationFrame( animate );

				TWEEN.update();
				controls.update();

			}

			function render() {

				renderer.render( scene, camera );

			}

			
			function resizeImg(image,distWidth,distHeight) 
			{ 
				srcWidth = image.width;
				srcHeight = image.height;
				var ratio = 1;
				if(srcWidth>0 && srcHeight>0) 
				{ 
					if(srcWidth/srcHeight>= distWidth/distHeight) 
					{ 
						if(srcWidth>distWidth) 
						{ 
							ratio = distWidth/srcWidth; 
						} 
					} 
					else 
					{ 
						if(srcHeight>distHeight) 
						{ 
							ratio = distHeight/srcHeight; 
						} 
					} 
				} 
				var width = srcWidth*ratio;
				var heigh = srcHeight*ratio;
				
				image.style.width = width.toString() + 'px';
				image.style.height = heigh.toString() + 'px';

				if(width < distWidth)
					image.style.paddingLeft = ((distWidth - width)/2).toString() + 'px';
					
				if(heigh < distHeight)
					image.style.paddingTop = ((distHeight - heigh)/2).toString() + 'px';
			} 	
			
			
			function getImgs (){
				var arrfiles = <?php
									echo json_encode($photoObj -> getPhotos(PHOTORZ_DN,PHOTORZ_MAX));
								?>;
				var row =1;
				var col = 1;
				for(var i = 0; i < arrfiles.length;i++)
				{
					var file = [];
					file[0] = arrfiles[i]['name'];
					file[1] = col++;
					file[2] = row;
					table[i] = file;
					if(col > 18)
					{
						col = 1;
						row++;
					}
				}	
			}

			
		function isBrowser(){
		  var Sys={};
		  var ua=navigator.userAgent.toLowerCase();
		  var s;
		  (s=ua.match(/msie ([\d.]+)/))?Sys.ie=s[1]:
		  (s=ua.match(/firefox\/([\d.]+)/))?Sys.firefox=s[1]:
		  (s=ua.match(/chrome\/([\d.]+)/))?Sys.chrome=s[1]:
		  (s=ua.match(/chrome\/([\d.]+)/))?Sys.vivaldi=s[1]:
		  (s=ua.match(/opera.([\d.]+)/))?Sys.opera=s[1]:
		  (s=ua.match(/version\/([\d.]+).*safari/))?Sys.safari=s[1]:0;
		  if(!(Sys.chrome || Sys.firefox)){//vivaldi
			  alert('3D：chrome、firefox');
		  }
		}

		</SCRIPT>
	 </DIV>
	<audio id="bgmMusic" src="img/8.mp3" preload="auto" type="audio/mp3" autoplay="" loop=""></audio>
 </BODY>
</HTML>
