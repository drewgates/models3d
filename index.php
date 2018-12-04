<?php
$password = "whatever";
$dir = "/var/www/html/models/models/";

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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/index.style.css">
  </head>
  <body>
  <div class="container">
    <div id="viewer-container">
      <iframe  id="model-viewer" name="model" frameborder="0" scrolling="no" src="./webgl.php?file="></iframe>
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
    
    <?php
      $files1 = scandir($dir);
      $files2 = scandir($dir, 1);
    ?>

    <div id="info-text">
      <h1>Model Repository</h1>
      <p>This collection is comprised primarily of models designed by Miguel Zavala (mz4250), and are provided here for easy access for 3D printing. Most models were originally distributed through Shapeways, which does not provide for easy downloading of files.</p>
      <p>There are a total of <?php echo count($files1) ?> files in this directory.</p>
    </div>

      <div id="models">
            <input class="search" placeholder="Search" />
    <button class="sort" data-sort="name">Sort</button>
          <ul class="list" id="model-list">
              <?php
              foreach ($files1 as &$value) {
          if(preg_match('([a-zA-Z])', $value)) {
                    echo "<li>";
                    echo "<a class='name' href=\"/models/$value\">" . substr($value, 0, -4) . "</a> - <a href=\"webgl.php?file=$value\" target=\"model\">(Preview)</a>";
                    echo "</li>";
          }
              }
              // $arr is now array(2, 4, 6, 8)
              unset($value); // break the reference with the last element
              ?>

                        <li class='name'>seth</li>
            <li class='name'>seth</li>
              <li class='name'>seth</li>
                <li class='name'>seth</li>

                  <li class='name'>seth</li>
                    <li class='name'>seth</li>
                      <li class='name'>seth</li>
                        <li class='name'>seth</li>
                          <li class='name'>seth</li>

                            <li class='name'>seth</li>

                              <li class='name'>seth</li>
                                <li class='name'>seth</li>
                                  <li class='name'>seth</li>
                                    <li class='name'>seth</li>
                                    <li class="name">mike poop</li>
          </ul>
      </div>

      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
      <script>
        const onResize = function() {
          const mList = $('#model-list');
          const otherHeight = $('#viewer-container').outerHeight(true) + $('#info-text').outerHeight(true);
          const mListHeight = $('body').height() - otherHeight - 70;
          mList.css('max-height', `${mListHeight}px`);
          mList.css('height', `${mListHeight}px`);
        }

        onResize();
        $(window).on('resize', () => {
          onResize();
        });
      </script>
    </div>
  </body>
</html>
