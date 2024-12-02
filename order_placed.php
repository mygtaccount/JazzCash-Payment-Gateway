<?php 

// Include configuration file 
include_once 'include/config.php'; 

$title = "op";

?>

<?php
// Check if transaction data is available in the POST data
if (
    !empty($_POST['pp_Amount']) && 
    !empty($_POST['pp_AuthCode']) && 
    !empty($_POST['pp_ResponseCode']) && 
    !empty($_POST['pp_MerchantID']) && 
    !empty($_POST['pp_SecureHash']) && 
    !empty($_POST['pp_TxnRefNo']) && 
    !empty($_POST['pp_RetreivalReferenceNo'])
) {
    // Get transaction information from POST data
    $Transaction_id = $_POST['pp_TxnRefNo'];
    $Amount = $_POST['pp_Amount']; 
    $AuthCode = $_POST['pp_AuthCode']; 
    $ResponseCode = $_POST['pp_ResponseCode'];
    $ResponseMessage = isset($_POST['pp_ResponseMessage']) ? $_POST['pp_ResponseMessage'] : 'No message available';
    $MerchantID = $_POST['pp_MerchantID'];
    $SecureHash = $_POST['pp_SecureHash'];
    $RetreivalReferenceNo = $_POST['pp_RetreivalReferenceNo'];

    // Format the amount (add a period before the last two digits)
    $Amount = substr($Amount, 0, -2) . '.00';

    // Determine payment status based on the response code
    $payment_status = ($ResponseCode == '000') ? 'Success' : 'Failed';
} else {
    $ResponseCode = $_POST['pp_ResponseCode'];
    $ResponseMessage = isset($_POST['pp_ResponseMessage']) ? $_POST['pp_ResponseMessage'] : 'No message available';
    $payment_status = 'Failed';
    $Transaction_id = 'N/A';
    $Amount = '0.00';
}
?>

<div class="container">
    <div class="status">
        <?php if ($payment_status === 'Success') { ?>
            <!-- Payment successful -->
            <h1 class="success">Your Payment has been Successful</h1>
            <h4>Payment Information</h4>
            <p><b>Transaction ID:</b> <?php echo $Transaction_id; ?></p>
            <p><b>Paid Amount:</b> <?php echo $Amount; ?></p>
            <p><b>Payment Status:</b> <?php echo $payment_status; ?></p>
        <?php } else { ?>
            <!-- Payment not successful -->
            <h1 class="error">Your Payment has Failed</h1>
            <p><b>Response Code:</b> <?php echo $ResponseCode; ?></p>
            <p><b>Message:</b> <?php echo $ResponseMessage; ?></p>
        <?php } ?>
    </div>
    <a href="index.php" class="btn-link">Back to Products</a>
</div>
