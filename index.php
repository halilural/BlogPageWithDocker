<?php 
	
	include("includes/config.php");
	include("includes/db.php"); 
	
	if(isset($_GET['category'])){
		$category = mysqli_real_escape_string( $db , $_GET['category'] );
		$cat = $db->query("SELECT * FROM categories WHERE id='$category'");
		$c = $cat->fetch_assoc();
		
		$page_title = $c['text'] . " Posts";
		
	}
	
	include("includes/header.php");
	
	if(isset($_GET['category'])){
		$category = mysqli_real_escape_string( $db , $_GET['category']);
		$query = "SELECT * FROM posts WHERE category='$category'";
	}else{
		$query = "SELECT * FROM posts";
	}
	$posts = $db->query($query);

?>
		
		<div class="blog-header">
			<h1 class="blog-title"><?php echo $page_title; ?></h1>
			<p class="lead blog-description">The official example template of creating a blog with Bootstrap.</p>
		</div>
		  
		<?php if($posts->num_rows > 0) { 
		while($row = $posts->fetch_assoc()){
		?>
		  <div class="blog-post">
			<h2 class="blog-post-title"><a href="single.php?post=<?php echo $row['id'] ?>"><?php echo $row['title']; ?></a></h2>
			<p class="blog-post-meta"><?php echo $row['date']; ?> by <a href="#"><?php echo $row['author']; ?></a></p>
			
			<?php $body =  $row['body']; 
				echo substr(strip_tags($body) , 0 , 400) . "...";
			?>
			
			<a href="single.php?post=<?php echo $row['id'] ?>" class="btn btn-primary">Read More</a>
		  </div><!-- /.blog-post -->	
		<?php } } else {
			echo "<p>No Matching Posts</p>";
		} ?> 

        </div><!-- /.blog-main -->

     <?php include("includes/sidebar.php");?>
     <?php include("includes/footer.php");?>