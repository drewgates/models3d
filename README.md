# models3d

## Introduction
models3d is a simple, responsive site for listing the names of STL files in a directory, and rendering them in a preview window as they are selected.

This site should work on any web server with PHP support, though it's possible that authentiation may not function properly.

## Setup

Determine the location of your models directory (I store my models in `/srv/models`, but you may have chosen another location.)

`cd` to your web root (*mine is `/var/www/html`, but yours may vary*):
```
cd /var/www/html
```

Next, link your models folder into your web root.
```
ln -s /srv/models .
```

Using `nano` or your favorite text editor, open `index.php` and modify the `$password` and `$dir` variables to the appropriate values.


Lastly, you'll need to ensure that your web server is able to read the models directory (which probably means using `chown` or `chgrp` to ensure that the user `www-data` has read access).

If you have any questions, please let me know! If something could work better, feel free to open a pull request!
