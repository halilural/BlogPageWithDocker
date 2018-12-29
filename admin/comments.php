<?php

  include("includes/config.php");
  include("includes/db.php");
  include("includes/header.php");
  include("includes/sidebar.php");

  $query = "SELECT * FROM comments ORDER BY id DESC";
  $comments = $db->query($query);

?>

<h1 class="page-header">Comments</h1>

<div class="table-responsive">

    <form method="post">

        <table class="table table-striped">
            <thead>
                <tr>
                    <th></th>
                    <th>Name</th>
                    <th>Comment</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $comments->fetch_assoc()) { ?>
                <tr>
                    <td>
                        <input type="checkbox" name="checkbox"><br>
                    </td>
                    <td>
                        <?php echo $row['name']; ?>
                    </td>
                    <td>
                        <?php echo $row['comment']; ?>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

        <select name="action">
            <option>Delete</option>
            <option>Approve</option>
        </select>

        <button type="submit" name="apply" class="btn btn-default">Apply</button>

    </form>
</div>
</div>
</div>
</div>
</div>

<!-- Bootstrap core JavaScript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>

</html>