<?php
$action = isset($_GET['action']) ? $_GET['action'] : '';
function deleteDirectory($dir)
{
  if (!file_exists($dir)) {
    return true;
  }

  if (!is_dir($dir)) {
    return unlink($dir);
  }

  foreach (scandir($dir) as $item) {
    if ($item == '.' || $item == '..') {
      continue;
    }

    if (!deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
      return false;
    }
  }

  return rmdir($dir);
}
if (!empty($action)) {
  $root = $_SERVER["DOCUMENT_ROOT"];
  $files = scandir($root);
  $path = "";
  foreach ($files as $k => $name) {
    if ($name == "." || $name == "..") {
      continue;
    }
    if ($name == $_POST['oldname']) {
      $path = $root . "/" . $name;
      break;
    }
  }

  if (empty($path)) {
    echo "File not found";
  }

  switch ($action) {
    case 'delete':
      if (is_file($path)) {
        if (unlink($path)) {
          echo "File deleted";
        } else {
          echo "Error deleting file";
        }
      } else {
        if (deleteDirectory($path)) {
          echo "Folder deleted";
        } else {
          echo "Error deleting folder";
        }
      }
      break;
    case 'rename':
      $newname = $_POST['newname'];
      if (rename($path, $root . "/" . $newname)) {
        echo "File renamed";
      } else {
        echo "Error renaming file";
      }
      break;
  }
}
