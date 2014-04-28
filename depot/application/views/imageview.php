<!DOCTYPE html>
<html>
	<header>
		<link rel="stylesheet" href= "/styles/image.css" type="text/css" />
	</header>
	<body>
	<div class = "main-content cf">
      <div class = "image">
        <?
            //grab our image path from the controller variable $image
        ?>
        <img src = "<?= $image['pathto'] ?>"/>
        <p><h2><?= $image['caption'] ?></h2></p>
      </div>
      <div class = "info">
      	<ul>
          <?
              //list of information on our current image
          ?>
      		<li><h1><? echo $image['creator'] ?></h1></li>
      		<li><h1><? echo $image['title'] ?></h1></li>
      		<li><h1><? echo $image['media'].' '.$image['size'] ?></h1></li>
      		<li><h1><? echo $image['price'] ?></h1></li>
        	<li><h1><?
          //add to cart button
          echo form_open('cart');
          $subarr = array('name' => 'addtocart', 'id' => 'addtocart');
          //Pass image info to cartdata array
          $cartdata = array('item' => $image['title'], 'price' => $image['price']);
          //Pass cartdata to session for cart use
          $this->session->set_userdata('cartdata',$cartdata);
          //submit the form and close it otherwise it falls through to our next form
          echo form_submit($subarr, 'Add to cart'); 
          echo form_close();
          ?></h1></li>
        </ul>
      </div>
      <div class = "close">
      	<? 
        //go back to the previous page
        echo form_open($prev);
        $submitarr = array('name' => 'close', 'id' => 'closebutton');
        echo form_submit($submitarr, 'X');
        ?>
      </div>
	</div>
	</body>
</html>
