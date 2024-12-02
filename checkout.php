<?php 

// Include configuration file 
include_once 'include/config.php'; 

$title = "Ahmad logs - JazzCash Payment Gateway Part ";


date_default_timezone_set('Asia/Karachi');
ini_set('max_execution_time', 60);

$product_id = $_GET['product_id'];

// Static product data (default data)
$products = [
    1 => [
        'name' => 'Product One Shoes',
        'price' => 10.00,
    ],
    2 => [
        'name' => 'Product Two Dress',
        'price' => 20.00,
    ],
    3 => [
        'name' => 'Product Three Bag',
        'price' => 30.00,
    ],
    4 => [
        'name' => 'Product Four LCD',
        'price' => 50.00,
    ],
];

// Check if product ID exists in static data
if (!array_key_exists($product_id, $products)) {
    die("Invalid product ID");
}

$product_name = $products[$product_id]['name'];
$product_price = $products[$product_id]['price'];

// Get formatted price (remove period from price)
$temp_amount = $product_price * 100;
$amount_array = explode('.', $temp_amount);
$pp_Amount = $amount_array[0];

// Get current date and time
$DateTime = new DateTime();
$pp_TxnDateTime = $DateTime->format('YmdHis');

// Set expiry date (1 hour later)
$ExpiryDateTime = $DateTime;
$ExpiryDateTime->modify('+1 hours');
$pp_TxnExpiryDateTime = $ExpiryDateTime->format('YmdHis');

// Make unique transaction ID
$pp_TxnRefNo = 'T' . $pp_TxnDateTime;

// Prepare post data
$post_data = [
    "pp_Version" => JAZZCASH_API_VERSION_1,
    "pp_TxnType" => "MWALLET",
    "pp_Language" => JAZZCASH_LANGUAGE,
    "pp_MerchantID" => JAZZCASH_MERCHANT_ID,
    "pp_SubMerchantID" => "",
    "pp_Password" => JAZZCASH_PASSWORD,
    "pp_BankID" => "TBANK",
    "pp_ProductID" => "RETL",
    "pp_TxnRefNo" => $pp_TxnRefNo,
    "pp_Amount" => $pp_Amount,
    "pp_TxnCurrency" => JAZZCASH_CURRENCY_CODE,
    "pp_TxnDateTime" => $pp_TxnDateTime,
    "pp_BillReference" => "billRef",
    "pp_Description" => "renew package of 10 MB",
    "pp_TxnExpiryDateTime" => $pp_TxnExpiryDateTime,
    "pp_ReturnURL" => JAZZCASH_RETURN_URL,
    "pp_SecureHash" => "",
    "ppmpf_1" => "1",
    "ppmpf_2" => "2",
    "ppmpf_3" => "3",
    "ppmpf_4" => "4",
    "ppmpf_5" => "5",
];

// Generate secure hash
$sorted_string = JAZZCASH_INTEGERITY_SALT . '&' .
                 $post_data['pp_Amount'] . '&' .
                 $post_data['pp_BankID'] . '&' .
                 $post_data['pp_BillReference'] . '&' .
                 $post_data['pp_Description'] . '&' .
                 $post_data['pp_Language'] . '&' .
                 $post_data['pp_MerchantID'] . '&' .
                 $post_data['pp_Password'] . '&' .
                 $post_data['pp_ProductID'] . '&' .
                 $post_data['pp_ReturnURL'] . '&' .
                 $post_data['pp_TxnCurrency'] . '&' .
                 $post_data['pp_TxnDateTime'] . '&' .
                 $post_data['pp_TxnExpiryDateTime'] . '&' .
                 $post_data['pp_TxnRefNo'] . '&' .
                 $post_data['pp_TxnType'] . '&' .
                 $post_data['pp_Version'] . '&' .
                 $post_data['ppmpf_1'] . '&' .
                 $post_data['ppmpf_2'] . '&' .
                 $post_data['ppmpf_3'] . '&' .
                 $post_data['ppmpf_4'] . '&' .
                 $post_data['ppmpf_5'];

$pp_SecureHash = hash_hmac('sha256', $sorted_string, JAZZCASH_INTEGERITY_SALT);
$post_data['pp_SecureHash'] = $pp_SecureHash;

// The $post_data array is now ready to be submitted to JazzCash
?>




<!-- container --> 
  <section class="showcase">
    <div class="container">
      <div class="pb-2 mt-4 mb-2 border-bottom">
        <h2>Part : JAZZCASH Payment Gateway Integration in PHP  - Checkout</h2>
      </div>      
      <span id="success-msg" class="payment-errors"></span>   
      
	  
	  <!-- JAZZCASH payment form -->
    <form action="<?php echo JAZZCASH_HTTP_POST_URL;?>" method="POST" id="myCCForm">
    <div class="row justify-content-center">
    <div class="col-12 col-md-8 col-lg-6 pb-5">
    <div class="row"></div>
        <!--Form with header-->
            <div class="card border-gray rounded-0">
                <div class="card-header p-0">
                    <div class="bg-gray text-left py-2">
                        <h5 class="pl-2"><strong>Product Name: </strong><?php echo $product_name;?></h5> 
                        <h6 class="pl-2"><strong>Product Price: </strong> <?php echo $product_price;?> PKR</h6>
                    </div>
                </div>

				<input type="hidden" name="amount" value="<?php echo $product_price;?>">
				<input type="hidden" name="product_name" value="<?php echo $product_name;?>">
				<input type="hidden" name="product_id" value="<?php echo $product_id;?>">

				<input type="hidden" name="pp_Version" value="<?php echo $post_data['pp_Version'];?>">
				<input type="hidden" name="pp_TxnType" value="<?php echo $post_data['pp_TxnType'];?>">
				<input type="hidden" name="pp_Language" value="<?php echo $post_data['pp_Language'];?>">
				<input type="hidden" name="pp_MerchantID" value="<?php echo $post_data['pp_MerchantID'];?>">
				<input type="hidden" name="pp_SubMerchantID" value="<?php echo $post_data['pp_SubMerchantID'];?>">
				<input type="hidden" name="pp_Password" value="<?php echo $post_data['pp_Password'];?>">
				<input type="hidden" name="pp_BankID" value="<?php echo $post_data['pp_BankID'];?>">
				<input type="hidden" name="pp_ProductID" value="<?php echo $post_data['pp_ProductID'];?>">
				
				<input type="hidden" name="pp_TxnRefNo" value="<?php echo $post_data['pp_TxnRefNo'];?>">
				<input type="hidden" name="pp_Amount" value="<?php echo $post_data['pp_Amount'];?>">
				<input type="hidden" name="pp_TxnCurrency" value="<?php echo $post_data['pp_TxnCurrency'];?>">
				<input type="hidden" name="pp_TxnDateTime" value="<?php echo $post_data['pp_TxnDateTime'];?>">
				<input type="hidden" name="pp_BillReference" value="<?php echo $post_data['pp_BillReference'];?>">
				<input type="hidden" name="pp_Description" value="<?php echo $post_data['pp_Description'];?>">
				<input type="hidden" name="pp_TxnExpiryDateTime" value="<?php echo $post_data['pp_TxnExpiryDateTime'];?>">
				<input type="hidden" name="pp_ReturnURL" value="<?php echo $post_data['pp_ReturnURL'];?>">
				<input type="hidden" name="pp_SecureHash" value="<?php echo $post_data['pp_SecureHash'];?>">
				<input type="hidden" name="ppmpf_1" value="<?php echo $post_data['ppmpf_1'];?>">
				<input type="hidden" name="ppmpf_2" value="<?php echo $post_data['ppmpf_2'];?>">
				<input type="hidden" name="ppmpf_3" value="<?php echo $post_data['ppmpf_3'];?>">
				<input type="hidden" name="ppmpf_4" value="<?php echo $post_data['ppmpf_4'];?>">
				<input type="hidden" name="ppmpf_5" value="<?php echo $post_data['ppmpf_5'];?>">


                <div class="card-body p-3">   
									<div class="input-group-text">Pay With <img src="<?php echo BASE_URL?>images/logo_JazzCash.png"></div>
									<p>JazzCash Mobile Account can be registered on any Jazz or Warid number</p>
									<p>Biometric-verified Jazz and Warid customers can self-register their Mobile Account simply by dialing *786#.</p>                              
									
									<div class="text-right">
											<button type="buttom" id="payBtn" class="btn btn-info py-2">Pay</button>
                        <a href="index.php" id="payBtn" class="btn btn-primary py-2">Back</a> 
                        
                    </div>
                    
                </div>
                
            </div> 
              <div>                
                </div>
          </div>
        </div>    
    </form>
    </div>
  </section>


