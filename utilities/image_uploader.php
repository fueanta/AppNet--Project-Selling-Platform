<?php
  function upload_image($file, $folder)
  {
    $id = uniqid();
    $target_dir = "../../images/" . $folder;
    if (strpos($folder, 'screenshots') !== false) {
      if (!file_exists($target_dir . "/")) {
        mkdir($target_dir);
      }
    }
    $target_dir = $target_dir . "/";
    $imageFileType = strtolower(pathinfo(basename($file["name"]),PATHINFO_EXTENSION));
    $imageFileName = $id . "." . $imageFileType;
  	$target_file = $target_dir . $imageFileName;

  	$uploadOk = true;

    // Checking if the image file is an actual image or a fake image
    $check = getimagesize($file["tmp_name"]);
    if (!($check !== false)) {
      echo "<br/><b style='color:red;'>File is not an image.</b>";
      $uploadOk = false;
    }

	  // Checking if the file already exists
		if (file_exists($target_file)) {
		    echo "<br/><b style='color:red;'>Generated filename already exists.</b>";
		    $uploadOk = false;
		}

		// Checking file size
		if ($file["size"] > 50000000) {
		    echo "<br/><b style='color:red;'>Sorry, your file is too large.</b>";
		    $uploadOk = false;
		}

		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
		    echo "<br/><b style='color:red;'>Sorry, only JPG, JPEG, PNG & GIF files are allowed.</b>";
		    $uploadOk = false;
		}

		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == false) {
		    echo "<br/><b style='color:red;'>Sorry, your file was not uploaded.</b>";
		// if everything is ok, try to upload file
		} else {
		    if (move_uploaded_file($file["tmp_name"], $target_file)) {
		        echo "<br/><b style='color:green;'>The file ". basename($file["name"]) . " has been uploaded.</b>";
		    } else {
		        echo "<br/><b style='color:red;'>Sorry, there was an error uploading your file.</b>";
		    }
		}
    return $arr = array($id, $imageFileName);
  }
 ?>
