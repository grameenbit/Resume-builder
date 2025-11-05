<?php
// main.php

$generated_key = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $app_name = $_POST['app_name'];
    $business_name = $_POST['business_name'];

    // একটি ইউনিক API কী তৈরি করুন
    $api_key = "key_" . bin2hex(random_bytes(16)); // যেমন: key_a1b2c3d4e5f6...

    // কী-টি একটি ফাইলে সংরক্ষণ করুন (বাস্তব ক্ষেত্রে ডাটাবেস ব্যবহার করুন)
    // FILE_APPEND flag নতুন কী ফাইলের শেষে যোগ করবে
    file_put_contents('api_keys.txt', $api_key . PHP_EOL, FILE_APPEND);

    $generated_key = $api_key;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>API Key Generator</title>
    <style>
        body { font-family: sans-serif; max-width: 500px; margin: 50px auto; padding: 20px; border: 1px solid #ccc; border-radius: 8px; }
        input { width: 100%; padding: 8px; margin-bottom: 10px; box-sizing: border-box; }
        button { padding: 10px 15px; background-color: #007bff; color: white; border: none; cursor: pointer; }
        .key { background-color: #f0f0f0; padding: 10px; font-weight: bold; margin-top: 20px; }
    </style>
</head>
<body>

    <h2>Create Your API Key</h2>
    <form action="main.php" method="POST">
        <label for="app_name">App Name:</label>
        <input type="text" id="app_name" name="app_name" required>

        <label for="business_name">Business Name:</label>
        <input type="text" id="business_name" name="business_name" required>

        <button type="submit">Generate Key</button>
    </form>

    <?php if ($generated_key): ?>
        <div class="key">
            <p>Your API Key (Save this securely):</p>
            <code><?php echo htmlspecialchars($generated_key); ?></code>
            <p><small>Use this key in your website's API settings.</small></p>
        </div>
    <?php endif; ?>

</body>
</html>