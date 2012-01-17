<?php
include('img-upload-watermark.php');
$uploaddir = 'uploads/';
$unique_tag='Food_Sustainability';

$filename = $unique_tag.time().'-'. basename($_FILES['uploadfile']['name']);//this is the file name
$file = $uploaddir . $filename;// this is the full path of the uploaded file

//createThumb($_FILES['uploadfile']['tmp_name'],$uploaddir.'thumbs/'.$filename,150,100);
//createThumb($_FILES['uploadfile']['tmp_name'],$uploaddir.'re/'.$filename,244,162);

if (createThumb($_FILES['uploadfile']['tmp_name'], $uploaddir.$filename,675,525)) {
  //echo "success";
  echo $filename;//return the file name
} else {
	echo "Error";
}

?>