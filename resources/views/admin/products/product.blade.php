@extends('admin.index')
@section('content')
<h2>Products</h2>
          <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Description</th>
                  <th>Price</th>
				  <th>Options</th>
                </tr>
              </thead>
              <tbody>
			   <?php $i =1; ?>
			  <?php foreach($products as $product){ ?>
                <tr product-id="<?php echo $product->id; ?>">
                  <td><?php echo $i++; ?>.</td>
                  <td><?php echo $product->name; ?></td>
                  <td><?php echo substr($product->description, 0, 100); ?>...</td>
                  <td><?php echo $product->price; ?></td>
				   <td><button class="btn btn-sm btn-block btn-info manage-product">View</button></td>
                </tr>
			  <?php } ?>
              </tbody>
            </table>
          </div>
@endsection