<?php
  include("includes/config.php");
  include("includes/db.php");
  include("includes/header.php");
  include("includes/sidebar.php");

  if(isset($_GET['entity']) && isset($_GET['action']) && isset($_GET['id']) ){
      $entity = mysqli_real_escape_string( $db , $_GET['entity'] );
      $action = mysqli_real_escape_string( $db , $_GET['action'] );
      $id = mysqli_real_escape_string( $db , $_GET['id'] );

      switch($action){
        case "delete":
        switch($entity){
          case "post":
            $query = "DELETE FROM posts WHERE id = '$id'";
            break;
            case "comment":
            $query = "DELETE FROM comments WHERE id = '$id'";
            break;
            case "category":
            $query = "DELETE FROM categories WHERE id = '$id'";
            $q = "UPDATE posts SET category='0' WHERE category='$id'";
            break;
        }
        break;
        case "approve":
        switch($entity){
          case "comment":
            $query = "UPDATE comments set status = '1' WHERE id = '$id'";
            break;
        }
        break;
      }

      $db->query($query);
      if(isset($q)){
        $db->query($q);
      }
  }
  $query = "SELECT * FROM posts ORDER BY id DESC";
  $posts = $db->query($query);
  $query = "SELECT * FROM comments WHERE status='0' ORDER BY id DESC";
  $comments = $db->query($query);
  $query = "SELECT * FROM categories ORDER BY id DESC";
  $categories = $db->query($query);

?>

<h1 class="page-header">Dashboard</h1>

<h2 class="sub-header">Recent Posts</h2>
<div class="table-responsive">
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Date Posted</th>
        <th>Title</th>
        <th>Author</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php while($row = $posts->fetch_assoc()) { ?>
      <tr>
        <td>
          <?php echo $row['date']; ?>
        </td>
        <td>
          <?php echo $row['title']; ?>
        </td>
        <td>
          <?php echo $row['author']; ?>
        </td>
        <td><a href="new_post.php?post=<?php echo $row['id']; ?>" class="btn btn-warning">Edit</a>
          <a href="index.php?entity=post&action=delete&id=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
        </td>
      </tr>
      <?php }?>
    </tbody>
  </table>

  <h2 class="sub-header">Recent Comments</h2>
  <div class="table-responsive">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Name</th>
          <th>Comment</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php while($row = $comments->fetch_assoc()) { ?>
        <tr>
          <td>
            <?php echo $row['name']; ?>
          </td>
          <td>
            <?php echo $row['comment']; ?>
          </td>
          <td><a href="index.php?entity=comment&action=approve&id=<?php echo $row['id']; ?>" class="btn btn-success">Approve</a>
            <a href="index.php?entity=comment&action=delete&id=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
          </td>
        </tr>
        <?php } ?>
      </tbody>
    </table>

    <h2 class="sub-header">Recent Categories</h2>
    <div class="table-responsive">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Id</th>
            <th>Title</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php while($row = $categories->fetch_assoc()) { ?>
          <tr>
            <td>
              <?php echo $row['id']; ?>
            </td>
            <td>
              <?php echo $row['text']; ?>
            </td>
            <td><a href="new_category.php?category=<?php echo $row['id']; ?>" class="btn btn-success">Approve</a>
              <a href="index.php?entity=category&action=delete&id=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>

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