<form>
<center>
	<h5>Product Information</h5>
</center>
<table class="table table-striped table-hover">
	<tbody>
		<tr>
			<td>Product name</td><td><p class="editable"><?php echo $productInfo->name;?></p><input hidden="true" name="name" class="hidden form-control" value="<?php echo $productInfo->name;?>"/></td>
		</tr>
		<tr>
			<td>Description</td><td><p class="editable"><?php echo $productInfo->description;?></p><input hidden="true"  name="description" class="hidden form-control" value="<?php echo $productInfo->description;?>"/></td>
		</tr>
		<tr>
			<td>SKU</td><td><p class="editable"><?php echo $productInfo->sku;?></p><input hidden="true"  name="sku" class="hidden form-control" value="<?php echo $productInfo->sku;?>"/></td>
		</tr>
		<tr>
			<td>Price</td><td><p class="editable"><?php echo $productInfo->price;?></p><input <?php //if($highestBid > 0) echo 'disabled'; ?> name="price" hidden="true" class="hidden form-control" value="<?php echo $productInfo->price;?>"/></td>
		</tr>
		<tr>
			<td>Views</td><td><p><?php echo $productInfo->views;?></p></td>
		</tr>
		<tr>
			<td>Highest bid</td><td><?php echo $highestBid;?></td>
		</tr>
		<tr>
			<td>Avarage bid</td><td><?php echo $avarageBid;?></td>
		</tr>
		<tr>
			<td>
				<button hidden class="btn btn-block remove-button btn-sm btn-warning hide-product">Hide Product</button>
			</td>
			<td>
				<button type="button" hidden class="btn btn-block display-button btn-sm btn-success save-data">Update</button>
				<button type="button" class="btn remove-button btn-block btn-sm btn-info edit-product">Edit Product</button>
			</td>
		</tr>
		<input hidden name="productId" value="<?php echo $productInfo->id;?>"/>
	</tbody>
</table>
</form>