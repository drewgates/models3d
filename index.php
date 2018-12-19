<?php
$password = "whatever";
$dir = "/var/www/html/models/models";

header("Content-type: text/html; charset=utf-8");
if(empty($_SERVER['PHP_AUTH_PW']) || $_SERVER['PHP_AUTH_PW'] != $password) {
    header('WWW-Authenticate: Basic realm=""');
    header('HTTP/1.0 401 Unauthorized');
    echo 'Password Required';
    exit;
} else {
  echo "<title>".(isset($title)?$title:"Models.")."</title>\n";
}

?>

<html>
  <head>
    <title>Models.</title>
    <script src="//cdnjs.cloudflare.com/ajax/libs/list.js/1.5.0/list.min.js"></script>
    <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./index.style.css">
    <script src="./js/jquery.js"></script>
    <script src="./bootstrap/js/bootstrap.min.js"></script>
  </head>
  <body>
  <div class="container">
  <div class="text-center" id="model-viewer">
    <iframe name="model" frameborder="0" scrolling="no" src="./webgl.php?file="></iframe>
  </div>

    <script type="text/javascript">
    function listinit(){
        var options = {
            valueNames: [ 'name' ]
        };
        var userList = new List('models', options);
    }
    if(window.addEventListener) {
        window.addEventListener('load',listinit,false); //W3C
    } else {
        window.attachEvent('onload',listinit); //IE
    }
    </script>

    <div id="description">
      <h1>Model Repository</h1>
      <p>This collection is comprised primarily of models designed by Miguel Zavala (mz4250), and are provided here for easy access for 3D printing. Most models were originally distributed through Shapeways, which does not provide for easy downloading of files.</p>

    <?php
    $files1 = scandir($dir);
    $files2 = scandir($dir, 1);
    ?>

      <p>There are a total of <?php echo count($files1) ?> files in this directory.</p>
    </div>



      <div id="models">
        <div class="model-search">
          <input class="search" placeholder="Search" />
          <button class="sort" data-sort="name">
              Sort
          </button>
        </div>
          <ul class="list">
              <?php
              foreach ($files1 as &$value) {
          if(preg_match('([a-zA-Z])', $value)) {
                    echo "<li>";
                    echo "<a class='name' href=\"./models/$value\">" . substr($value, 0, -4) . "</a> - <a href=\"webgl.php?file=$value\" target=\"model\">(Preview)</a>";
                    echo "</li>";
          }
              }
              // $arr is now array(2, 4, 6, 8)
              unset($value); // break the reference with the last element
              ?>
          </ul>
      </div>
    </div>

    <script>
      function resize() {
        $('.list').height(
          $('.container').outerHeight(true) 
          - $('#model-viewer').outerHeight(true)
          - $('#description').outerHeight(true)
          - $('.model-search').outerHeight(true)
          - 50
        );
      }
      
      resize();
      $(window).on('resize', () => {
        resize();
      });
    </script>
  </body>
</html>
