<head meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>UP Load Your Picture!</title>
</head>

<h1>您可以在这里上传并显示图片！</h1>
<br>
<!-- 上传文件的代码-->
<form action="pic_upload_processor.php" method ="post" enctype="multipart/form-data"/>
<div>
	<!--   1MB -->
	<input type="hidden" name="MAX_FILE_SIZE" value ="1000000" />
	<label for="userfile">Upload a File:</label>
	<input type="file" name="userfile" id ="userfile" />
	<br>
	<input type="submit" value="Send File" />
</div>
</form>
<!-- 上传文件的代码-->
<br>
<h2>This is your uploaded images:</h2>
<ol start="1">

<?php
  $dir = dir("F://WEBSITE_2015//bit//apache2//htdocs//weixin//img//");

  //echo "<p>Handle is $dir->handle</p>";
  //echo "<p>Upload directory is $dir->path</p>";
  //echo '<p>Directory Listing:</p><ul>';
  
  while(false !== ($file = $dir->read()))
    //strip out the two entries of . and ..
  	if($file != "." && $file != "..")
  	{
		echo '<li><img src="img/'.iconv('CP936','UTF-8',$file).'" height="200"><br>'.iconv('CP936','UTF-8',$file).'</img></li><br>';
  	}
  echo '<br>';
  $dir->close();
?>
</ol>

<body>
<h1>Browsing</h1>
<?php
  $dir = dir("F://WEBSITE_2015//bit//apache2//htdocs//weixin//img//");

  echo "<p>Handle is $dir->handle</p>";
  //echo "<p>Upload directory is $dir->path</p>";
  echo '<p>Directory Listing:</p><ul>';
  
  while(false !== ($file = $dir->read()))
    //strip out the two entries of . and ..
  	if($file != "." && $file != "..")
  	{
		echo '<b>'.$file.'</b><br>';
		echo mb_detect_encoding($file, 'UTF-8,GBK,gb2312');
  	}
  echo '</ul>';
  $dir->close();
?>
</body>

