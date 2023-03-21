<?php
$target_dir = "upload/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]); 
$uploadOk = 1;

// Check if file already exists
if (file_exists($target_file)) {
  echo "file already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 5 * 1024 * 1024) { 
  echo "your file is too large.";
  $uploadOk = 0;
}

$allowed_extensions = array("jpg", "mp3", "mp4");
$file_extension = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
if (!in_array($file_extension, $allowed_extensions)) {
  echo "only JPG, MP3, and MP4 files are allowed.";
  $uploadOk = 0;
}

if ($uploadOk == 0) {
  echo "your file was not uploaded.";
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
  } else {
    echo "there was an error uploading your file.";
  }
}
