<div class="main-content cf">
        <div class="cart">
	            <div class="cart-table">
	               <?
	                 $maxcols = 15;
	                 
	                 //This array will have the item names for the shopping cart
	                 $itemarray = array();
	                 //This will be the array storing item cost from $_POST data every time someone "adds to cart"
	                 $costarray = array();
	                 //This is the quantity array
	                 $quantity = array();
	
	                 $cartdata = $this->session->userdata('cartdata');

	                 //if we have data in the session push everything onto our arrays
	                 if(isset($cartdata))
	                 {
	                  array_push($itemarray, $cartdata['item']);
	                  array_push($costarray, $cartdata['price']);
	                  array_push($quantity, 1);
	                 }

	                 //Create our table, should be dynamic but the items in session aren't being pushed to the
	                 //array that is being pushed to session
	                 echo "<table><tr><th><h2>Shopping Cart</h2></th></tr>";
	     
	                 for($i = 0; $i < count($itemarray); $i++)
	                 {
	                   echo "<tr><th><td>".$itemarray[$i]."</td></th>";
	                   echo "<th><td>".$costarray[$i]."</td></th>";
	                   echo "<th><td>".$quantity[$i]."</td></th></tr>";
	                 }
	               ?>
	            </div>
                <div id="checkout">
                        <button id="submit" name="submit" type="submit">Proceed to checkout</button>
                </div>
        </div>
</div>
</div>
</body>
</html>
