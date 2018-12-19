<html>
<head>
<script src="js/three.min.js"></script>
<script src="js/STLLoader.js"></script>
<script src="js/OrbitControls.js"></script>
</head>
<body>

<script>
var container, camera, scene, renderer;
var orbitControls;

init();
animate();

function init(){
    container=document.createElement('div');
    document.body.appendChild(container);

    camera=new THREE.PerspectiveCamera(35, window.innerWidth / window.innerHeight, 1, 10000);
    camera.position.set(3, 0.5, 3);

    scene=new THREE.Scene();

    // object
    var loader=new THREE.STLLoader();
    loader.addEventListener('load', function (event){
        var geometry=event.content;
        var material=new THREE.MeshLambertMaterial({ ambient: 0xFBB917,color: 0xfdd017 });
        var mesh=new THREE.Mesh(geometry, material);
        scene.add(mesh);});

    //http://10.11.12.146/models/Aarakocra_body.stl

    // STL file to be loaded
    loader.load('models/Arakocra_body.stl');

    controls = new THREE.OrbitControls(camera, container);
    controls.autoRotate = true;

    // lights
    scene.add(new THREE.AmbientLight(0x736F6E));

    var directionalLight=new THREE.DirectionalLight(0xffffff, 1);
    directionalLight.position=camera.position;
    scene.add(directionalLight);

    // renderer

    renderer=new THREE.WebGLRenderer({ antialias: true });
    renderer.setSize(window.innerWidth, window.innerHeight);

    container.appendChild(renderer.domElement);

    window.addEventListener('resize', onWindowResize, false);}

function addLight(x, y, z, color, intensity){
    var directionalLight=new THREE.DirectionalLight(color, intensity);
    directionalLight.position.set(x, y, z)
    scene.add(directionalLight);}

function onWindowResize(){
    camera.aspect=window.innerWidth / window.innerHeight;
    camera.updateProjectionMatrix();
    renderer.setSize(window.innerWidth, window.innerHeight);}

  function animate(){
      requestAnimationFrame(animate);
      render();
  }

  function render(){
      var timer=Date.now() * 0.0005;

      renderer.render(scene, camera);
      renderer.setClearColor(0xf5f5f5, 1);
  }
</script>

</body>
</html>
