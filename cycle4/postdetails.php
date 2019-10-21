<?php
/**
 * Created by PhpStorm
 * User: jbedw
 * Date: 10/21/2019
 * Time: 2:58 PM
 */
$pagetitle = "Post Details";
require_once "head.php";

$showform = 1;

try{
    //query the data
    $sql = "SELECT * FROM forumposts WHERE postid = :postid";
    //prepares a statement for execution
    $stmt = $pdo->prepare($sql);
    //binds the actual value of $_GET['ID'] to
    $stmt->bindValue(':postid', $_GET['ID']);
    //executes a prepared statement
    $stmt->execute();
    //fetches the next row from a result set / returns an array
    //default:  array indexed by both column name and 0-indexed column number
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    //display to the screen
    echo "<table>
                <tr><th>Author:</th><td>{$row['posttitle']}</td></tr>
                <tr><th>Title:</th><td>{$row['posttitle']}</td></tr>
                <tr><th>Content:</th><td>{$row['content']}</td></tr>
                <tr><th>Date Created:</th><td>";
    echo date("l, F j, Y", $row['postdate']);
    echo "</td></tr>
</table>
<h2>Replies</h2>"
    ;
}
catch (PDOException $e)
{
    die( $e->getMessage() );
}
try{
    //query the data
    $sql = "SELECT * FROM forumreply";
    //executes a query.
    $result = $pdo->query($sql);

    echo "<table>
            <tr><th>Author</th><th>Content</th></tr>";
    //loop through the results and display to the screen
    foreach ($result as $row){
        echo "<td> ". $row['replyauthor']. "</td><td> " . $row['content'] . "</td></tr>\n";
    }
    echo "</table>";
}
catch (PDOException $e)
{
    die( $e->getMessage() );
}
if($showform = 1) {
    ?>
    <form name="reply" id="reply" method="post" action="reply.php">
        <table>
            <tr>
                <th><label for="content">Reply</label></th>
                <td><span class="error"><?php if (isset($errcontent)) {
                            echo $errcontent;
                        } ?></span>
                    <textarea name="content" id="content"></textarea>
                </td>
            </tr>
        </table>
        <input type="submit" name="submit" id="submit" value="submit"/></td>

    </form>
    <?php
}
require_once "foot.php";