<?php
// Social Auth (OAuth2) sketch
// For production: use league/oauth2-client or similar
$client_id = 'YOUR_CLIENT_ID';
$client_secret = 'YOUR_CLIENT_SECRET';
$redirect_uri = 'http://localhost/project_074/index.php';
$scope = 'email profile';
$auth_url = 'https://accounts.google.com/o/oauth2/auth?'.http_build_query([
    'client_id'=>$client_id,
    'redirect_uri'=>$redirect_uri,
    'response_type'=>'code',
    'scope'=>$scope
]);
if (isset($_GET['code'])) {
    echo 'OAuth callback received! (Exchange code for token here)';
} else {
    echo '<a href="'.$auth_url.'">Login with Google</a>';
}
