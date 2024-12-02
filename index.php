<?php
// Debugging: Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Set up title and PART constant
$title = "ajs network";
define('PART', '1'); // Define PART if not defined already


// Static product data
$products = [
    [
        'product_id' => 1,
        'name' => 'Product One Shoes',
        'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy',
        'image' => 'images/1.jpg',
        'price' => 10.00
    ],
    [
        'product_id' => 2,
        'name' => 'Product Two Dress',
        'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy',
        'image' => 'images/2.jpg',
        'price' => 20.00
    ],
    [
        'product_id' => 3,
        'name' => 'Product Three Bag',
        'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy',
        'image' => 'images/3.jpg',
        'price' => 30.00
    ],
    [
        'product_id' => 4,
        'name' => 'Product Four LCD',
        'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy',
        'image' => 'images/4.jpg',
        'price' => 50.00
    ],
];
?>

<!-- container -->
<section class="showcase">
    <div class="container">
        <div class="pb-2 mt-4 mb-2 border-bottom">
            <h2>Part <?php echo PART; ?>: JAZZCASH Payment Gateway Integration in PHP - Home Page</h2>
        </div>
        
        <div class="row">
            <?php foreach ($products as $row): ?>
                <div class="col-lg-3 col-md-3 mb-3">
                    <div class="card h-100">
                        <a href="#"><img src="<?php echo $row['image']; ?>" alt="product <?php echo $row['product_id']; ?>" title="product <?php echo $row['product_id']; ?>" class="card-img-top"></a>
                        <div class="card-body">
                            <h4 class="card-title"><a href="#"><?php echo $row['name']; ?></a></h4>
                            <h5>₹<?php echo $row['price']; ?></h5>
                            <p class="card-text"><?php echo $row['description']; ?></p>
                        </div>
                        <div class="card-footer text-right">
                            <a href="<?php echo 'checkout.php?product_id=' . $row['product_id']; ?>" class="add-to-cart btn-success btn btn-sm" title="Add to Cart"><i class="fa fa-shopping-cart fa-fw"></i> Buy Now</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>


