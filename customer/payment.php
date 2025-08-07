<?php
session_start();
require_once 'config.php';
require '../vendor/autoload.php';

use Razorpay\Api\Api;

// Get the total amount from the session
$totalAmount = $_SESSION['total'];
$name=$_SESSION['fname'];
// Get contact number and email address from the session or your database
$contactNumber = $_POST['no']; // Add logic to get the contact number
$emailAddress = $_POST['email']; // Add logic to get the email address

// Initialize Razorpay API
$api = new Api(API_KEY, API_SECRET);

// Create a Razorpay order
$orderData = [
    'receipt' => 'order_receipt_' . time(),
    'amount' => $totalAmount * 100, // Amount in paisa
    'currency' => 'INR',
    'payment_capture' => 1
];

$order = $api->order->create($orderData);
$razorpayOrderID = $order->id;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment</title>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <style>
        body{
            background-image:url('colorful-wallpaper-background-multicolored-generative-ai.jpg'); 
            background-size:cover;
            background-position:cover;           
        }
    </style>
</head>
<body>


<script>
var options = {
    "key": "<?php echo API_KEY; ?>",
    "amount": "<?php echo $totalAmount * 100; ?>",
    "currency": "INR",
    "name": "<?php echo COMPANY_NAME; ?>",
    "description": "",
    "image": "<?php echo COMPANY_LOGO_URL; ?>",
    "order_id": "<?php echo $razorpayOrderID; ?>",
    "handler": function(response) {
        alert('Payment successful. Payment ID: ' + response.razorpay_payment_id);
        var payment_id = response.razorpay_payment_id;
        var order_id = response.razorpay_order_id;
        window.location.href = 'success.php?payment_id=' + payment_id + '&order_id=' + order_id;
    },
    "prefill": {
        "name": "<?php echo $name; ?>",
        "email": "<?php echo $emailAddress; ?>",
        "contact": "<?php echo $contactNumber; ?>"
    },
    "notes": {
        "address": "Razorpay Corporate Office"
    },
    "theme": {
        "color": "#3399cc"
    },
    "modal": {
        "ondismiss": function(){
            window.location.href = 'cart.php'; // Redirect to checkout page if payment modal is dismissed
        }
    },
    "external": {
        "wallets": ["gpay", "paypal", "upi"],
        "netbanking": 1,
        "card": 1,
        "upi": {
            "vpa": "devpanchal2610@oksbi"
        },
        "wallet": {
            "amazonpay": 1,
            "freecharge": 1,
            "paytm": 1
        },
        "bank_transfer": {
            "method": "bank"
        },
        "qr": {
            "amount": "<?php echo $totalAmount * 100; ?>",
            "description": "Purchase Description",
            "merchantname": "Chandresh Thakkar"
        }
    }
};

var rzp1 = new Razorpay(options);
rzp1.open();
</script>
</body>
</html>
