<!DOCTYPE html>
<html lang="en">
	<head>
		<title>three.js webgl - STL</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
		<style>
			body {
				font-family: Monospace;
				background-color: #000000;
				margin: 0px;
				overflow: hidden;
			}

			#info {
				color: #fff;
				position: absolute;
				top: 10px;
				width: 100%;
				text-align: center;
				z-index: 100;
				display:block;

			}

			a { color: skyblue }
			.button { background:#999; color:#eee; padding:0.2em 0.5em; cursor:pointer }
			.highlight { background:orange; color:#fff; }

			span {
				display: inline-block;
				width: 60px;
				float: left;
				text-align: center;
			}

		</style>
	</head>
	<body>

		<?php
		$file = htmlspecialchars($_GET["file"]);
		?>


		<div id="info">
			This model is <a href="./models/<?php echo $file; ?>"><?php echo $file; ?></a>.
		</div>

		<script src="./js/three.min.js"></script>
		<script src="js/STLLoader.js"></script>
		<script src="js/Detector.js"></script>
		<script src="js/stats.min.js"></script>
		<script src="./js/OrbitControls.js"></script>

		<script>
			if ( ! Detector.webgl ) Detector.addGetWebGLMessage();
			var container, stats;
			var camera, cameraTarget, scene, renderer;
			var orbitControls;
			init();
			animate();
			function init() {
				container = document.createElement( 'div' );
				document.body.appendChild( container );
				camera = new THREE.PerspectiveCamera( 35, window.innerWidth / window.innerHeight, 1, 15 );
				camera.position.set( 3, 0.15, 3 );
				cameraTarget = new THREE.Vector3( 0, -0.25, 0 );
				scene = new THREE.Scene();
				scene.background = new THREE.Color( 0x72645b );
				scene.fog = new THREE.Fog( 0x72645b, 2, 15 );

				// Ground - uncomment the next eight lines if you want a ground plane below the models.
				// var plane = new THREE.Mesh(
				//	new THREE.PlaneBufferGeometry( 40, 40 ),
				//	new THREE.MeshPhongMaterial( { color: 0x999999, specular: 0x101010 } )
				//);
				//plane.rotation.x = -Math.PI/2;
				//plane.position.y = -0.5;
				//scene.add( plane );
				//plane.receiveShadow = true;


				// ASCII file

				var loader = new THREE.STLLoader();

				// Binary files

				var material = new THREE.MeshPhongMaterial( { color: 0xAAAAAA, specular: 0x111111, shininess: 200 } );

				loader.load( "./models/<?php echo $file; ?>", function ( geometry ) {

					var mesh = new THREE.Mesh( geometry, material );

					//mesh.position.set( 0, - 0.37, - 0.6 );
					mesh.position.set( 0, -0.4, 0 );
					mesh.rotation.set( - Math.PI / 2, 0, 0 );
					mesh.scale.set( 0.02, 0.02, 0.02 );

					mesh.castShadow = true;
					mesh.receiveShadow = true;

					scene.add( mesh );

				} );

				// Lights

				scene.add( new THREE.HemisphereLight( 0x443333, 0x111122 ) );

				addShadowedLight( 1, 1, 1, 0xffffff, 1.35 );
				addShadowedLight( 0.5, 1, -1, 0xffaa00, 1 );
				// renderer

				renderer = new THREE.WebGLRenderer( { antialias: true } );
				renderer.setPixelRatio( window.devicePixelRatio );
				renderer.setSize( window.innerWidth, window.innerHeight );

				renderer.gammaInput = true;
				renderer.gammaOutput = true;

				renderer.shadowMap.enabled = true;

				container.appendChild( renderer.domElement );

				// stats

				stats = new Stats();
				container.appendChild( stats.dom );

				//

				orbitControls = new THREE.OrbitControls(camera, renderer.domElement);
				orbitControls.autoRotate = true;

				window.addEventListener( 'resize', onWindowResize, false );

			}

			function addShadowedLight( x, y, z, color, intensity ) {

				var directionalLight = new THREE.DirectionalLight( color, intensity );
				directionalLight.position.set( x, y, z );
				scene.add( directionalLight );

				directionalLight.castShadow = true;

				var d = 1;
				directionalLight.shadow.camera.left = -d;
				directionalLight.shadow.camera.right = d;
				directionalLight.shadow.camera.top = d;
				directionalLight.shadow.camera.bottom = -d;

				directionalLight.shadow.camera.near = 1;
				directionalLight.shadow.camera.far = 4;

				directionalLight.shadow.mapSize.width = 1024;
				directionalLight.shadow.mapSize.height = 1024;

				directionalLight.shadow.bias = -0.002;

			}

			function onWindowResize() {

				camera.aspect = window.innerWidth / window.innerHeight;
				camera.updateProjectionMatrix();

				renderer.setSize( window.innerWidth, window.innerHeight );

			}

			function animate() {

				requestAnimationFrame( animate );

				render();
				stats.update();

			}

			function render() {

				var timer = Date.now() * 0.0005;
				orbitControls.update();
				renderer.render( scene, camera );

			}

		</script>
	</body>
</html>
