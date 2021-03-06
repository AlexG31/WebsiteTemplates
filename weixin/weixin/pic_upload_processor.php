<html>
<head meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>Uploading...</title>
</head>
<body>
<h1>Uploading file...</h1>
<!-- picture upload process -->

<?php

//Check to see if an error code was generated on the upload attempt
  if ($_FILES['userfile']['error'] > 0)
  {
    echo 'Problem: ';
    switch ($_FILES['userfile']['error'])
    {
      case 1:	echo 'File exceeded upload_max_filesize';
	  			break;
      case 2:	echo 'File exceeded max_file_size';
	  			break;
      case 3:	echo 'File only partially uploaded';
	  			break;
      case 4:	echo 'No file uploaded';
	  			break;
	  case 6:   echo 'Cannot upload file: No temp directory specified.';
	  			break;
	  case 7:   echo 'Upload failed: Cannot write to disk.';
	  			break;
    }
    exit;
  }

  // Does the file have the right MIME type?
if ((($_FILES["userfile"]["type"] == "image/gif")
|| ($_FILES["userfile"]["type"] == "image/jpeg")
|| ($_FILES["userfile"]["type"] == "image/jpg")
|| ($_FILES["userfile"]["type"] == "image/png"))){
;
}else{
    echo 'Problem: file is not plain text';
    exit;
  }

  // put the file where we'd like it
  $upfile = 'img/'.$_FILES['userfile']['name'];
  $e=mb_detect_encoding($_FILES['userfile']['name'], 'UTF-8,GBK,gb2312');

  echo 'Encoding:'.$e;

  $upfile=iconv("UTF-8","CP936", $upfile);

  if (is_uploaded_file($_FILES['userfile']['tmp_name'])) 
  {
     if (!move_uploaded_file($_FILES['userfile']['tmp_name'], $upfile))
     {
        echo 'Problem: Could not move file to destination directory';
		echo '<title>Upload Error</title>';
        exit;
     }
  } 
  else 
  {
    echo 'Problem: Possible file upload attack. Filename: ';
    echo $_FILES['userfile']['name'];
    exit;
  }


  echo 'File uploaded successfully<br><br>'; 
  echo '<script type="text/javascript">window.location.href= "pic_uploader.php"','</script>';

/*
  // reformat the file contents
  $fp = fopen($upfile, 'r');
  $contents = fread ($fp, filesize ($upfile));
  fclose ($fp);
 
  $contents = strip_tags($contents);
  $fp = fopen($upfile, 'w');
  fwrite($fp, $contents);
  fclose($fp);

  // show what was uploaded
  echo 'Preview of uploaded file contents:<br><hr>';
  echo $contents;
  echo '<br><hr>';
 */
?>
</body>
</html>
