<!-- <?php

        include('config.php');

        $statusMsg = '';

        // File upload directory 
        $targetDir = "image/";

        if (isset($_POST["submit"])) {
            if (!empty($_FILES["file"]["name"])) {
                $fileName = basename($_FILES["file"]["name"]);
                $targetFilePath = $targetDir . $fileName;
                $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

                // Allow certain file formats 
                $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
                if (in_array($fileType, $allowTypes)) {
                    // Upload file to server 
                    if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
                        // Insert image file name into database 
                        $insert = $link->query("INSERT INTO images (file_name, uploaded_on) VALUES ('" . $fileName . "', NOW())");
                        if ($insert) {
                            $statusMsg = "The file " . $fileName . " has been uploaded successfully.";
                        } else {
                            $statusMsg = "File upload failed, please try again.";
                        }
                    } else {
                        $statusMsg = "Sorry, there was an error uploading your file.";
                    }
                } else {
                    $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.';
                }
            } else {
                $statusMsg = 'Please select a file to upload.';
            }
        }

        // Display status message 
        echo $statusMsg;

        // $query = "SELECT GambarICPelajar FROM maklumatdiripelajar WHERE username = 'test_gambar'";
        // $result = $link->query($query);
        // if ($result->num_rows > 0) {
        //     while ($row = $result->fetch_assoc()) {
        //         $IC = $row['GambarICPelajar'];
        //         //$ICDepanPelajar = $row['ICDepanPelajar'];
        //     }
        // }
        ?>

<!DOCTYPE html>
<html>

<head>
    <title>Image Upload</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
    <div id="content">
        <form method="post" enctype="multipart/form-data">
            Select Image File to Upload:
            <input type="file" name="file">
            <br>
            <input type="submit" name="submit" value="Upload">
        </form>

    </div>
    <div id="display-image">
        <?php
        $query = $link->query("SELECT * FROM images ORDER BY uploaded_on DESC");

        if ($query->num_rows > 0) {
            while ($row = $query->fetch_assoc()) {
                $imageURL = 'image/' . $row["file_name"];
        ?>
                <img src="<?php echo $imageURL; ?>" alt="" />
            <?php }
        } else { ?>
            <p>No image(s) found...</p>
        <?php } ?>
    </div>
</body>

</html> -->



<?php
/**
 * Copyright 2022 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
// [START drive_create_folder]
use Google\Client;
use Google\Service\Drive;

function createFolder()
{
    try {
        $client = new Client();
        $client->useApplicationDefaultCredentials();
        $client->addScope(Drive::DRIVE);
        $driveService = new Drive($client);
        $fileMetadata = new Drive\DriveFile(array(
            'name' => 'Invoices',
            'mimeType' => 'application/vnd.google-apps.folder'
        ));
        $file = $driveService->files->create($fileMetadata, array(
            'fields' => 'id'
        ));
        printf("Folder ID: %s\n", $file->id);
        return $file->id;
    } catch (Exception $e) {
        echo "Error Message: " . $e;
    }
}
// [END drive_create_folder]
require_once 'vendor/autoload.php';
createFolder();
