<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Track Delivery</title>
  <style>
    .progress-bar {
      width: 60%;
      background-color: #ddd;
      border-radius: 20px;
      overflow: hidden;
      margin-bottom: 20px;
    }
    .progress {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: #4CAF50;
      color: white;
      padding: 10px;
      width: 100%; /* Set width to 100% for correct progress */
      transition: width 0.5s ease;
    }
    .step {
      flex: 1;
      text-align: center;
    }
    .step-text {
      margin-top: 10px;
      font-size: 14px;
    }
    .content {
      width: 60%;
      background-color: #fff;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      padding: 20px;
      text-align: center;
    }
    label {
      display: block;
      margin-bottom: 10px;
    }
    input[type="text"] {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    input[type="submit"] {
      display: block;
      width: 100%;
      padding: 10px;
      background-color: #333;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    .active {
      color: yellow;
    }
    .current {
      color: red;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="progress-bar">
      <div class="progress">
        <div class="step <?php if ($progress == 0) echo 'active current'; ?>">Not Shipped</div> <div class="step <?php if ($progress >= 25 && $progress < 50) echo 'active'; ?>">Shipping Soon</div>
        <div class="step <?php if ($progress >= 50 && $progress < 75) echo 'active'; ?>">Shipping</div>
        <div class="step <?php if ($progress >= 75 && $progress < 100) echo 'active'; ?>">Out of Delivery</div>
        <div class="step <?php if ($progress == 100) echo 'active current'; ?>">Delivered</div>
      </div>
    </div>
    <div class="content">
      <h1>Track Delivery</h1>
      <?php
        // ... (rest of the PHP code remains the same)
       
// Initialize $progress variable
$progress = 0;

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // ... (rest of the PHP code remains the same)

  // Update $progress based on retrieved ship_status
  switch ($row['ship_status']) {
    case "Not Shipped":
      $progress = 0;
      break;
    case "Shipping Soon":
      $progress = 25;
      break;
    case "Shipping":
      $progress = 50;
      break;
    case "Out for Delivery":
      $progress = 75;
      break;
    case "Delivered":
      $progress = 100;
      break;
    default:
      $progress = 0;
  }
}
      ?>
    </div>
  </div>
</body>
</html>
