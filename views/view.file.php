<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 13/01/17
 * Time: 14:59
 */?>


    <div class="col-sm-8 col-sm-offset-2 col-xs-12">


        <?php
            Alert::displayMessage();
        ?>

        <h1>File Upload</h1>

        <form action="file.php" method="post" enctype="multipart/form-data">
            Select <b>image</b> to upload:
            <input class="form-control" type="file" name="fileToUpload" id="fileToUpload" required>
            <input type="hidden" name="_method" value="upload">
            <input type="hidden" name="csrf" value="<?php echo $_SESSION["token"]; ?>">
            <button type="submit" name="submit" class="btn btn-primary">Upload File</button>
        </form>

        <?php
            if (file_exists ( 'storage/'.user()->getId() )) {
                ?><h1>My Files</h1><ul><?php
                $files = scandir('storage/' . user()->getId());
                $count = count($files);
                for ($i = 2; $i < $count; $i++) {
                    ?>
                    <li><a target="_blank"
                           href="<?php echo 'storage/' . user()->getId() . '/' . $files[$i]; ?>"><?php echo $files[$i]; ?></a>
                    </li><?php
                }
                ?> </ul><?php
            }
        ?>



    </div>
