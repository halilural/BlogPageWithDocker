<?php

  include("includes/config.php"); 
  include("includes/db.php");
  include("includes/header.php");
  include("includes/sidebar.php");

  $query = "SELECT * FROM posts ORDER BY id DESC";
  $posts = $db->query($query);

?>

<h1 class="page-header">Posts</h1>
<a href="new_post.php" class="btn btn-info btn-lg">Add New</a>
<div class="table-responsive">

    <form method="post">

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th></th>
                        <th>Date Posted</th>
                        <th>Title</th>
                        <th>Author</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $posts->fetch_assoc()) { ?>
                    <tr>
                        <td>
                            <input type="checkbox" name="checkbox"><br>
                        </td>
                        <td>
                            <?php echo $row['date']; ?>
                        </td>
                        <td>
                            <?php echo $row['title']; ?>
                        </td>
                        <td>
                            <?php echo $row['author']; ?>
                        </td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>

            <select name="action">
                <option>Delete</option>
                <option>Clone</option>
            </select>

            <button type="submit" name="apply" class="btn btn-default">Apply</button>

    </form>
</div>

<!-- Bootstrap core JavaScript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>

</html>