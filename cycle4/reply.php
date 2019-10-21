<?php
/**
 * Created by PhpStorm
 * User: jbedw
 * Date: 10/21/2019
 * Time: 2:34 PM
 */
$pagetitle = "Reply to a Post";
include_once "head.php";

$showform = 1;
$errmsg = 0;
$errcontent = "";

if($_SERVER['REQUEST_METHOD'] != 'POST')
{
    //this means someone is trying to edit the post
    echo 'This file cannot be called directly.';
}
else
{
    //make sure user is logged in
    checkLogin();
    //Sanitize user data
    $formdata['content'] = trim($_POST['content']);


    //Check for empty fields
    if (empty($formdata['content'])) {$errcontent = "You cannot make a blank reply."; $errmsg = 1; }

    //Error handling
    if($errmsg == 1)
    {
        echo "<p class='error'>There are errors.  Please make corrections and resubmit.</p>";
    }

    try {
        $sql = "INSERT INTO forumreply (content, replydate, replyauthor)
                    VALUES (:content, :replydate, :replyauthor) ";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':content', $formdata['content']);
        $stmt->bindValue(':replydate', $rightnow);
        $stmt->bindValue(':replyauthor', $_SESSION['username']);
        $stmt->execute();
        $showform = 0;
        echo "<p class='awesome'>Your reply was uploaded!</p>";
    }
    catch (PDOException $e)
    {
        die( $e->getMessage() );
    }
}
include 'foot.php';
?>