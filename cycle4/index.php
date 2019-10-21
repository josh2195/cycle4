<?php
/**
 * Created by PhpStorm
 * User: jbedw
 * Date: 10/21/2019
 * Time: 3:22 PM
 */
$pagetitle = "Cycle 4";
include_once "head.php";
?>
    <h2>Welcome to the Coastal Carolina Computer Science Forum! Select a forum post to view or <a href="login.php">Sign In</a> and create your own!</h2>
    <p>
        <?php
        try{
            //query the data
            $sql = "SELECT * FROM forumposts";
            //executes a query.
            $result = $pdo->query($sql);

            echo "<table>
            <tr><th>Title</th><th>Content</th></tr>";
            //loop through the results and display to the screen
            foreach ($result as $row){
                echo "<td> ". $row['posttitle']. "</td><td> " . $row['content'] . "</td><td><a href='postdetails.php?ID=" . $row['postid'] . "'>VIEW</a></td></tr>\n";
            }
            echo "</table>";
        }
        catch (PDOException $e)
        {
            die( $e->getMessage() );
        }
        ?>
    </p>

<?php
require_once "foot.php";
?>