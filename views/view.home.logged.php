<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 29/01/16
 * Time: 12:40
 */
global $snippets;
?>


<div class="col-sm-8 col-sm-offset-2 col-xs-12">


        <?php
        Alert::displayMessage();
        ?>

        <h1>Home</h1>

        <div>
                <A href="snippet.php"><button class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Create Snippet</button></A>
        </div>

        <br>

        <table class="table table-hover">
                <tr>
                        <th class="text-center">Title</th>
                        <th class="text-center">Date</th>
                        <th class="text-center">See Snippet</th>
                        <th class="text-center">Delete</th>
                </tr>
                <?php
                foreach ($snippets as $snippet){
                        ?>
                        <tr>
                                <th class="text-center"><?php echo $snippet->getTitle(); ?></th>
                                <th class="text-center"><?php echo $snippet->getPublishDate(); ?></th>
                                <th class="text-center">
                                        <form method="GET" action="snippet.php">
                                                <input name="id" type="hidden" value="<?php echo $snippet->getId(); ?>" />
                                                <button class="btn btn-xs btn-primary" type="submit"><span class="glyphicon glyphicon-align-justify" aria-hidden="true"></span></button>
                                        </form>
                                </th>
                                <th class="text-center">
                                        <form method="post" action="snippet">
                                                <input name="_method" type="hidden" value="delete" />
                                                <input name="_id" type="hidden" value="<?php echo $snippet->getId(); ?>" />
                                                <button class="btn btn-xs btn-danger" type="submit"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
                                        </form>
                                </th>
                        </tr>
                        <?php
                }
                ?>
        </table>


</div>
