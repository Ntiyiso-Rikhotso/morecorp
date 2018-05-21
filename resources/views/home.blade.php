<!doctype html>
<html lang="en">
  
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
	<meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="https://getbootstrap.com/favicon.ico">

    <title>Home</title>

   
    
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
  </head>

  <body>
	<nav class="navbar navbar-expand-lg navbar-light bg-dark">
  <a class="navbar-brand" href="#"><img width="110px" src="http://morecorp.co.za/wp-content/themes/morecorp/public/img/logo.png" alt="Bringing South Africans Together Through Sport and Leisure"> Dev</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
	<?php if($isLoggedIn && Auth::user()->is_admin){?>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Menu
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="/dashboard">Admin Dashboard</a>
        </div>
      </li>
	  <?php } ?>
    </ul>
	<?php if($isLoggedIn){?>
      <a href="/sign_out" class="btn btn-outline-danger my-2 my-sm-0" >Logout</a>
    <?php }else{ ?>
		<a href="/login" class="btn btn-outline-success my-2 my-sm-0" >Login</a>
	<?php } ?>
  </div>
</nav>

    <main role="main">
	<!--
      <section class="jumbotron text-center">
        <div class="container">
          <h1 class="jumbotron-heading">Register to bid</h1>
          <p class="lead text-muted">Something short and leading about the collection below—its contents, the creator, etc. Make it short and sweet, but not too short so folks don't simply skip over it entirely.</p>
          <p>
            <a href="#" class="btn btn-primary my-2">Sign up</a>
            <a href="#" class="btn btn-secondary my-2">Login</a>
          </p>
        </div>
      </section> -->

      <div class="album py-5 bg-light">
        <div class="container">

          <div class="row">
		  <?php foreach($products as $product){?>
            <div data-product-id="<?php echo $product->id; ?>" class="product-info col-md-4 view-product">
              <div class="card mb-4 box-shadow">
                <img class="card-img-top" src="<?php echo asset('images/' . $product->id . '.jpg'); ?>" alt="Card image cap">
                <div class="card-body">
                  <h4 class="card-text"><?php echo $product->name; ?></h4>
				  <p class="card-text">Price : <strong>R <?php echo $product->price; ?></strong></p>
				   <small class="card-text"><?php echo $product->description; ?></small>
                  <div class="d-flex justify-content-between align-items-center">
                
                   
                  </div>
                </div>
              </div>
            </div>
		  <?php } ?>
          </div>
        </div>
      </div>

    </main>
	  <!-- Modal -->
  <div class="modal fade view-product-modal " role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
		<div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="card modal-body">
			
        </div>
      </div>
      
    </div>
  </div>

    <footer class="text-muted">
      <div class="container">
        <p class="float-right">
          <a href="#">Back to top</a>
        </p>
        <p>Album example is &copy; Bootstrap, but please download and customize it for yourself!</p>
        <p>New to Bootstrap? <a href="https://getbootstrap.com/docs/4.1/">Visit the homepage</a> or read our <a href="https://getbootstrap.com/docs/4.1/getting-started/">getting started guide</a>.</p>
      </div>
    </footer>

  
    <script src="{{asset('js/app.js')}}"></script>
	
  </body>

</html>
