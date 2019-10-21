<?php
/**
 * Created by PhpStorm
 * User: jbedw
 * Date: 10/21/2019
 * Time: 4:01 PM
 */
$pagetitle = "Reply Details";
require_once "head.php";
try{
    //query the data
    $sql = "SELECT * FROM forumreply WHERE replyid = :replyid";
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
                <tr><th>Author:</th><td>{$row['replyauthor']}</td></tr>
                <tr><th>Reply:</th><td>{$row['content']}</td></tr>
                <tr><th>Date Created:</th><td>";
    echo date("l, F j, Y", $row['postdate']);
    echo "</td></tr>
</table>"
    ;
}
catch (PDOException $e)
{
    die( $e->getMessage() );
}
?>