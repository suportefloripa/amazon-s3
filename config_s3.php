<?php
// Bucket Name
$bucket="BucketName";

//AWS access info
if (!defined('awsAccessKey')) define('awsAccessKey', 'ACCESS_KEY');
if (!defined('awsSecretKey')) define('awsSecretKey', 'ACCESS_Secret_KEY');

  $client = S3Client::factory(
      array(
      'key'    => awsAccessKey,
      'secret' => awsSecretKey
       )
      );
?>
