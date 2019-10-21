<?php
/**
 * Created by PhpStorm
 * User: jbedw
 * Date: 10/21/2019
 * Time: 2:00 PM
 */
$pagetitle = "Create New Post";
include_once "head.php";
checkLogin();

//initiate variables
$showform = 1;
$errmsg = 0;
$errtitle = "";
$errcontent = "";


if($_SERVER['REQUEST_METHOD'] == "POST")
{
    //Sanitize user data
    $formdata['posttitle'] = trim($_POST['posttitle']);
    $formdata['content'] = trim($_POST['content']);


    //Check for empty fields
    if (empty($formdata['posttitle'])) {$errtitle = "There must be a title for your post."; $errmsg = 1; }
    if (empty($formdata['content'])) {$errcontent = "You cannot make a blank forum post."; $errmsg = 1; }

    //Error handling
    if($errmsg == 1)
    {
        echo "<p class='error'>There are errors.  Please make corrections and resubmit.</p>";
    }
    else{

        try{
            $sql = "INSERT INTO forumposts (posttitle, content, postdate, postauthor)
                    VALUES (:posttitle, :content, :postdate, :postauthor) ";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':posttitle', $formdata['posttitle']);
            $stmt->bindValue(':content', $formdata['content']);
            $stmt->bindValue(':postdate', $rightnow);
            $stmt->bindValue(':postauthor', $_SESSION['ID']);
            $stmt->execute();

            $showform =0;
            echo "<p class='awesome'>Your post has been uploaded!</p>";
        }
        catch (PDOException $e)
        {
            die( $e->getMessage() );
        }
    }
}

if($showform == 1)
{
    ?>
    <form name="createpost" id="createpost" method="post" action="createpost.php">
        <table>
            <tr><th><label for="posttitle">Title:</label><span class="important">*</span></th>
                <td><input name="posttitle" id="posttitle" type="text" size="20" placeholder="Title"
                    <span class="important"><?php if(isset($errtitle)){echo $errtitle;}?></span></td>
            </tr>
            <tr>
                <th><label for="content">Content</label></th>
                <td><span class="important"><?php if (isset($errcontent)) {echo $errcontent;} ?></span>
                    <textarea name="content" id="content"></textarea>
                </td>
            </tr>
        </table>
        <input type="submit" name="submit" id="submit" value="submit"/></td>
    </form>
    <p class="important">* Indicates required field</p>
    <?php
}
include_once "foot.php";
?>