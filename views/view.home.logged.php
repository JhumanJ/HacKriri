<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 29/01/16
 * Time: 12:40
 */
global $snippets;
global $userLists;
global $userManager;
global $snippetManager;
?>


<div class="col-sm-8 col-sm-offset-2 col-xs-12">


        <?php
        Alert::displayMessage();
        ?>

        <h1>Home</h1>

        <div>
                <A href="snippet.php"><button <?php if(!user()->canPublish()){echo 'disabled';}?> class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Create Snippet</button></A>
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
                                <td class="text-center"><?php echo $snippet->getTitle(); ?></td>
                                <td class="text-center"><?php echo $snippet->getPublishDate(); ?></td>
                                <td class="text-center">
                                        <form method="GET" action="snippet.php">
                                                <input name="id" type="hidden" value="<?php echo $snippet->getId(); ?>" />
                                                <button class="btn btn-xs btn-primary" type="submit"><span class="glyphicon glyphicon-align-justify" aria-hidden="true"></span></button>
                                        </form>
                                </td>
                                <td class="text-center">
                                        <form method="post" action="snippet">
                                                <input name="_method" type="hidden" value="delete" />
                                                <input name="_id" type="hidden" value="<?php echo $snippet->getId(); ?>" />
                                                <button class="btn btn-xs btn-danger" type="submit"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
                                        </form>
                                </td>
                        </tr>
                        <?php

                }
                ?>
        </table>

        <h1>Most Recent snippets</h1>

        <table class="table table-hover">
                <tr>
                        <th class="text-center">UserName</th>
                        <th class="text-center">Last Snippet Created</th>
                        <th class="text-center">Link to Profile</th>
                </tr>
                <?php
                foreach ($userManager->getAll() as $item){
                        ?>

                        <tr>
                                <td class="text-center"><?php echo $item->getUserName(); ?></td>
                                <td class="text-center"><a href="snippet?id=<?php echo $snippetManager->lastSnippet($item)->getId(); ?>"><?php echo $snippetManager->lastSnippet($item)->getTitle(); ?></a></td>
                                <td class="text-center">
                                        <form method="GET" action="profile.php">
                                                <input name="user" type="hidden" value="<?php echo $item->getUserName(); ?>" />
                                                <button class="btn btn-xs btn-primary" type="submit"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></button>
                                        </form>
                                </td>
                        </tr>
                <?php
                }
                ?>
        </table>

</div>
