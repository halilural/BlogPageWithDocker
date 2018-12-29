	<div class="col-sm-3 col-sm-offset-1 blog-sidebar" style="margin-top:150px;">
		
		  <div class="sidebar-module">
            <h4>Search</h4>
			<hr>
				<form method = "get" action="results.php"  class="form-inline">
				  <div class="form-group">
					<input type="text" name="search" class="form-control" id="exampleInputName2" placeholder="Search...">
				  </div>
				</form>
          </div>
		
          <div class="sidebar-module sidebar-module-inset">
            <h4>About</h4>
			<hr>
            <p><?php echo $about_text; ?></p>
          </div>
		 
		  <div class="sidebar-module">
            <h4>Subscribe</h4>
			<hr>
			<?php if(isset($_POST['subscribe'])) { 
				$name = mysqli_real_escape_string($db , $_POST['name']);
				$email = mysqli_real_escape_string($db , $_POST['email']);
				
				$query = "INSERT INTO subscribers (name,email) VALUES('$name','$email')";
				
				$db->query($query);
				header('Location: '.$_SERVER['PHP_SELF']);
				die;
			
			} ?>
			   <form method="post">
				  <div class="form-group">
					<input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Name">
				  </div>
				  <div class="form-group">
					<input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
				  </div>
				  <button type="submit" name="subscribe" class="btn btn-primary">Subscribe</button>
			   </form>
          </div>
		  
		  
          <div class="sidebar-module">
            <h4>Categories</h4>
			<hr>
			<?php $q = "SELECT * FROM categories";
				  $categories = $db->query($q);
			?>
            <ul class="list-unstyled">
			  <?php while( $c = $categories->fetch_assoc() ) { ?>
              <li><a href="index.php?category=<?php echo $c['id']; ?>"><?php echo $c['text']; ?></a></li>
			  <?php } ?>
            </ul>
          </div>
          <div class="sidebar-module">
            <h4>Elsewhere</h4>
			<hr>
            <ol class="list-unstyled">
              <li><a href="#">GitHub</a></li>
              <li><a href="#">Twitter</a></li>
              <li><a href="#">Facebook</a></li>
            </ol>
          </div>
    </div><!-- /.blog-sidebar -->
