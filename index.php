<?php
include('image_validation.php'); // getExtension Method
$message='';
if($_SERVER['REQUEST_METHOD'] == "POST")
{
$name = $_FILES['file']['name'];
$size = $_FILES['file']['size'];
$tmp = $_FILES['file']['tmp_name'];
$ext = getExtension($name);

if(strlen($name) > 0)
{
// File format validation
if(in_array($ext,$valid_formats))
{
// File size validation
if($size<(1024*1024))
{
include('config_s3.php');
//Rename image name.
$image_name_actual = time().".".$ext;

if($s3->putObjectFile($tmp, $bucket , $image_name_actual, S3::ACL_PUBLIC_READ) )
{
$message = "S3 Upload Successful.";
$s3file='http://'.$bucket.'.s3.amazonaws.com/'.$actual_image_name;
echo "<img src='$s3file'/>";
echo 'S3 File URL:'.$s3file;
}
else
$message = "S3 Upload Fail.";

}
else
$message = "Image size Max 1 MB";

}
else
$message = "Invalid file, please upload image file.";

}
else
$message = "Please select image file.";

}
?>

//HTML Code
<form action="" method='post' enctype="multipart/form-data">
Upload image file here
<input type='file' name='file'/> <input type='submit' value='Upload Image'/>
<?php echo $msg; ?>
</form>