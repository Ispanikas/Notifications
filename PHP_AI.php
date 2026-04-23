<!DOCTYPE html>https://github.com/Ispanikas/Notifications/blob/main/PHP_AI.php
<html>
<head>
   <title>Continue to Zscaler</title>
</head>
<body>
   <h2>Click the button below to continue: ANOTHER CHANGE HERE AGAIN AND AGAIN AND AGAINNNNN</h2>
   <a id="continue_link" href="#">Continue</a>
   <script>
       // Read URL parameters
       const params = new URLSearchParams(window.location.search);
       const url = encodeURIComponent(params.get('url') || '');
       const z = params.get('zsq') || '';
       const cat = encodeURIComponent(params.get('cat') || '');
       // Extraction logic: Remove trailing 'zsq' if it exists at the end
       const rid = z.endsWith('zsq') ? z.slice(0, -3) : z;
       // Construct and set the href for the continue link
       document.getElementById('continue_link').href = 
           `https://gateway.zscloud.net:443/_sm_ctn?_sm_url=${url}&_sm_rid=${rid}&_sm_cat=${cat}`;
   </script>
</body>
</html>
<!-- TEST -->
