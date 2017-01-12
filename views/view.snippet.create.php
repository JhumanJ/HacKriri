<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 12/01/17
 * Time: 17:37
 */
?>

<div class="col-sm-8 col-sm-offset-2 col-xs-12">

    <?php
    Alert::displayMessage();
    ?>

    <h1>Create Snippet</h1>

    <form action="snippet" method="post">

        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" class="form-control" placeholder="User Name" name="title" required">
        </div>

        <div class="form-group">
            <label for="content">Content:</label>
            <textarea type="text" class="form-control" placeholder="Content" name="content"></textarea>
        </div>

        <input type="hidden" name="_method" value="create">

        <button id="submitBtn" class="btn btn-primary center-block" type="submit">Update <span class="glyphicon glyphicon-floppy-saved" aria-hidden="true"></span>
        </button>
    </form>

</div>
