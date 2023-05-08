<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-purple layout-top-nav">
<div class="wrapper">

	<?php include 'includes/navbar.php'; ?>
	 
	  <div class="content-wrapper">
	    <div class="container">

	      <!-- Main content -->
	      <section class="content">
	        <div class="row">
	        	<div class="col-sm-9">
	        		<?php
	        			if(isset($_SESSION['error'])){
	        				echo "
	        					<div class='alert alert-danger'>
	        						".$_SESSION['error']."
	        					</div>
	        				";
	        				unset($_SESSION['error']);
	        			}
	        		?>
	        		<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
		               <!--  <ol class="carousel-indicators">
		                  <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
		                  <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
		                  <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
		                </ol> -->
		                <div class="carousel-inner">
		                  <div class="item active">
		                    <img src="images/about.png" alt="First slide">
		                  </div>
		                  <!-- <div class="item">
		                    <img src="images/poster2.png" alt="Second slide">
		                  </div> -->
		                  <!-- <div class="item">
		                    <img src="images/poster3.png" alt="Third slide">
		                  </div> -->
		                </div>
		               <!--  <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
		                  <span class="fa fa-angle-left"></span>
		                </a> -->
		                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
<!-- 		                  <span class="fa fa-angle-right"></span>
 -->		                </a>
		            </div>
		            <h2>About HomeGallery</h2>
		       		 <div class="modal-content">
            
            <div class="modal-body">
HomeGallery E-Commerce System is an online-based system that allows shoppers to effortlessly search for products for home and living using their cellphones or laptops connected to the internet. This is an easy-to-use system with a responsive design that matches user’s device. For this system, its contains product for home and living such as furniture, tools for cooking, home decoration, kitchen and dining, stationary and many more. Customers can add to cart the product that they want to purchased and submit their orders through online.            </div>
        </div>


	        	</div>
	        	<div class="col-sm-3">
	        		<?php include 'includes/sidebar.php'; ?>
	        	</div>
	        </div>
	      </section>
	     
	    </div>
	  </div>
  
  	<?php include 'includes/footer.php'; ?>
</div>

<?php include 'includes/scripts.php'; ?>
</body>
</html>