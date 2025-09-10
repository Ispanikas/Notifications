<?php
$url = $_GET['url'];
$referer = $_GET['referer'];
$reason = $_GET['reason'];
$reason_code = $_GET['reasoncode'];
$timebound = $_GET['timebound'];
$action = $_GET['action'];
$kind = $_GET['kind'];
$rule = $_GET['rule'];
$cat = $_GET['cat'];
$user = $_GET['user'];
$lang = $_GET['lang'];
$zsq = explode("zsq", $_GET['zsq']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Restricted – PDF Editing</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #242424; /* slightly lighter */
            color: #f0f0f0;
            margin: 0;
            padding: 20px;
        }
        .logo img { 
            display: block; 
            margin: 0 auto 16px; 
            max-width: 360px; 
            width: 100%; 
            height: auto; 
        }        
        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #2b2b2b;
            padding: 20px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
        }
        h1 { color: #5bc0de; }
        p { font-size: 16px; }
        a { color: #ffcc00; text-decoration: none; }
        a:hover { text-decoration: underline; }
        .useful-links { margin-top: 20px; }
        .details {
            margin-top: 20px;
            background-color: #333333;
            padding: 10px;
            border: 1px solid #444444;
        }
        .details p { font-size: 14px; margin: 5px 0; }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="CCHBC_2D_Color_Horizontal.png" alt="Coca-Cola HBC logo">
        </div>        
        <h1>Access Restricted</h1>
        <p>It appears you're trying to access an online PDF editing service that isn't permitted by our policies. Using such services can pose security risks, including the potential exposure of sensitive data to third-party platforms that may not meet our security standards.</p>
        <p>To ensure your data remains protected and complies with our Acceptable Use Policy, please use trusted and secure tools like Adobe Acrobat or Microsoft Word for PDF editing. These tools work locally and help minimize the risk of unauthorized access or data leakage.</p>
        <p>By using approved applications, you help safeguard both your personal information and company data.</p>

        <div class="useful-links">
            <h2>Recommended Links:</h2>
            <ul>
                <li><a href="https://support.microsoft.com/en-us/office/edit-a-pdf-b2d1d729-6b79-499a-bcdb-233379c2f63a" target="_blank">Edit a PDF with MS Word</a></li>
                <li><a href="https://support.microsoft.com/en-us/office/convert-or-save-to-pdf-7d88593b-d509-4225-a05a-076723a40beb" target="_blank">Convert or Save to PDF with MS Word</a></li>
            </ul>
        </div>

       <form id="continue_action" method="GET" action="https://gateway.zscaler.net:443/_sm_ctn">
                <input type="hidden" name="_sm_url" value="<?php $_GET['url'];?>">
                <input type="hidden" name="_sm_rid" value="<?php split('zsq', $_GET['zsq']);?>">
                <input type="hidden" name="_sm_cat" value="<?php $_GET['cat'];?>">
                <input class="btn" type="submit" value="Continue to previous destination" id="submitButton">
       </form> 

        <div class="details">
            <h2>Support Information:</h2>
            <p><strong>Attempted URL:</strong> <?php echo htmlspecialchars($url); ?></p>
            <p><strong>Reason:</strong> <?php echo htmlspecialchars($reason); ?> (<?php echo htmlspecialchars($reason_code); ?>)</p>
            <p><strong>Action Taken:</strong> <?php echo htmlspecialchars($action); ?></p>
            <p><strong>Category:</strong> <?php echo htmlspecialchars($cat); ?></p>
            <p><strong>Rule:</strong> <?php echo htmlspecialchars($rule); ?></p>
            <p><strong>User:</strong> <?php echo htmlspecialchars($user); ?></p>
            <p><strong>Referer:</strong> <?php echo htmlspecialchars($referer); ?></p>
            <p><strong>Time-bound:</strong> <?php echo htmlspecialchars($timebound); ?></p>
        </div>
    </div>
</body>

</html>

