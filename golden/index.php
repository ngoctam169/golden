<?php require_once('./session.php'); ?>
<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <title>GOLDEN OWL</title>
  <link rel="stylesheet" type="text/css" href="./public/css/style.css">
  <link rel="icon" href="/favicon.ico">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://code.jquery.com/jquery-latest.pack.js"></script>
  
</head>
<?php  
	$products = file_get_contents("./shoes.json");
	$products = json_decode($products);
    $cart = $_SESSION['cart'];
    $money = $_SESSION['total'];
 ?>


<body>
    <div class="flex-container">
        <div class="row">
            <div class="col-6">
                <div class="card12">
                    <div class="card-top">
                        <img src="./public/image/nike.png" class="card-top-logo">
                    </div>
                    <div class="card-title">Our Products</div>
                    <div class="card-body">
             	        <div class="shop-items">
             		        <?php foreach ($products->shoes as $value): ?>
                                <?php $check = false; ?>
	                        <div class="shop-item">
	                            <div class="shop-item-image" style="background-color: <?php echo $value->color; ?>">
	                               <img src="<?php echo $value->image; ?>" >
	                            </div>
	                            <div class="shop-item-name"><?php echo $value->name; ?></div>
	                            <div class="shop-item-description"><?php echo $value->description; ?></div>
	                            <div class="shop-item-bottom">
	                                <div class="shop-item-price">$<?php echo $value->price; ?></div>
                                    <?php 
                                        foreach ($cart as $cartitem) {
                                            if ($value->id == $cartitem->id) {
                                                $check = true;
                                                break; //dung de thoat khoi vong lap
                                            }
                                        }
                                    ?>
                                    <div class="shop-item-button inactive <?php if (!$check) echo 'd-none'; ?>" data-id="<?php echo $value->id; ?>">
                                        <div class="shop-item-button-cover">
                                            <img src="./public/image/check.png" class="img-check">
                                        </div>
                                    </div>
                                    <button class="button1 <?php if ($check) echo 'd-none'; ?>" style="border-radius: 100px; border: none; font-size: 14px; background-color: white;" data-id="<?php echo $value->id; ?>" onclick="button2(this)">
                                        <div class="shop-item-button"><p class="as"> ADD TO CART</p></div>
                                    </button>
	                            </div>
	                        </div>
	                        <?php endforeach ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6">
                <div class="card12">
                    <div class="card-top">
                        <img src="./public/image/nike.png" class="card-top-logo">
                    </div>
                    <div class="card-title">Your Cart
                        <?php if(!empty($money)): ?>
                        <span class="card-title-amount"><?php echo $money; ?></span>
                        <?php else: ?>
                        <span class="card-title-amount">$0.00</span>
                        <?php endif ?>
                    </div>
                    <div class="card-body">
                        <?php if(empty($cart)): ?>
                            <div class="card-empty">
                                <p class="card-empty-text">Your cart is empty.</p>
                            </div>
                        <?php endif ?>
                        <div class="card-items">
                            <?php if(!empty($cart)): ?>
                                <?php foreach($cart as $value): ?>
                                    <div class="card-item">
                                        <div class="card-item-left">
                                            <div class="card-item-image" style="background-color:<?php echo $value->color; ?>">
                                                <div class="card-item-image-block"><img class="image" src="<?php echo $value->image;?>"></div>
                                            </div>
                                        </div>
                                        <div class="card-item-right">
                                            <div class="card-item-name"><?php echo $value->name; ?></div>
                                            <div class="card-item-price">$<?php echo $value->price; ?></div>
                                            <div class="card-item-actions">
                                                <div class="card-item-count"> 
                                                    <div class="card-item-count-button">
                                                        <button class="button-minus" data-id="<?php echo $value->id; ?>" data-quality="<?php echo $value->quality; ?>"><img src="./public/image/minus.png" class="minus"></button>
                                                    </div>
                                                    <?php if(isset($value->quality)): ?>
                                                        <div class="card-item-count-number"><?php echo $value->quality; ?></div>
                                                    <?php else: ?>
                                                        <div class="card-item-count-number">1</div>
                                                    <?php endif ?>

                                                    <div class="card-item-count-button">
                                                        <button class="button-plus" data-id="<?php echo $value->id; ?>" ><img src="./public/image/plus.png" class="plus"></button>
                                                    </div>
                                                </div>
                                                <div class="card-item-remove">
                                                    <button class="button-trash" data-id="<?php echo $value->id; ?>"><img src="./public/image/trash.png" class="cart-item-remove-icon"></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                            <?php endif ?>
                            
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script src="./public/js/app.js"></script>
</body>
