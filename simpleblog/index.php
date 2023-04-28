<?php
include 'config/db.php';

// Get Articles
$a_query = "
	SELECT * FROM articles 
	INNER JOIN Categories 
	ON articles.category_id = categories.id";
	
$a_result = pg_query($con,$a_query) or die("Cannot execute query: $a_query\n");

// Get Categories
$c_query = "SELECT * FROM categories";
$c_result = pg_query($con,$c_query) or die("Cannot execute query: $c_query\n");

pg_close($con);

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Simple Blog</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.4.3/css/foundation.min.css">
</head>
<body>
        <!-- Start Top Bar -->
        <div class="top-bar">
          <div class="top-bar-left">
            <ul class="menu">
              <li class="menu-text">SimpleBlog</li>
            </ul>
          </div>
          <div class="top-bar-right">
            <ul class="menu">
              <li><a href="index.php">Home</a></li>
              <li><a href="new.php">New Post</a></li>
            </ul>
          </div>
        </div>
        <!-- End Top Bar -->
        <div class="callout large primary">
          <div class="text-center">
            <h1>Our Blog</h1>
          </div>
        </div>
    
    <article class="grid-container">
        <div class="grid-x grid-margin-x" id="content">
          <div class="medium-9 cell">
    
			<?php while($row = pg_fetch_assoc($a_result)): ?>
				<div class="blog-post">
					<h3><?php echo $row['title']; ?></h3>
					<p><?php echo $row['body']; ?></p>
					<div class="callout">
						<ul class="menu simple">
							<li><a href="category.php?id=<?php echo $row['id']; ?>"><?php echo $row['name']; ?></a></li>
						</ul>
					</div>
				</div>
			<?php endwhile; ?>
    
          </div>
          <div class="medium-3 cell" data-sticky-container>
            <div class="sticky" data-sticky data-anchor="content">
              <h4>Categories</h4>
              <ul>
              	<?php while($row = pg_fetch_assoc($c_result)): ?>
                <li><a href="category.php?id=<?php echo $row['id']; ?>"><?php echo $row['name']; ?></a></li>
              	<?php endwhile; ?>
              </ul>
            </div>
          </div>
        </div>
</body>
</html>

