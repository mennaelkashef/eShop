<div class='products-list col-md-12'>
	<div class ='product-container'>
		<div class = 'product-img'>
			<img src='getProductImage.php?id={$product['id']}' width='175' height='100'/>
		</div>
		<div class = 'product-properties'>
			<div class='product-name'>{$product['name']}</div>
			<div class='product-price'>&#36;{$product['price']}</div>
		</div>
		<div class = 'product-options'>
			<div class = 'buy-now'> 
				<form method='get' action='confirmation.php'>
					<input type='hidden' id='product_id' name='product_id' value='{$product['id']}'>
					<input type='submit' value='Buy Now'>
				</form> 
			</div>
			<button class ='remove' onclick=removeFromCart($product_id)>Remove from cart</button>
			<button class ='add' onclick=addToCart($product_id)>Add to cart</button>
			<div class = 'add-to-cart'> 
				<form method='get' action='addToCart.php'>
					<input type='hidden' id='product_id' name='product_id' value='{$product['id']}'>
					<input type='submit' value='Add to Cart'>
				</form> 
			</div>
		</div>
	</div>
</div>