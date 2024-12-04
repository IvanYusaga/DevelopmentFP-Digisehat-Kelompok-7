<?php

define('DB_HOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'medipulse');

define('GOOGLE_CLIENT_ID', '1023747700187-ahioe5ln6gffe69ebaa6904hmgilor49.apps.googleusercontent.com');
define('GOOGLE_CLIENT_SECRET', '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');
define('GOOGLE_OAUTH_SCOPE', 'https://www.googleapis.com/auth/calendar');
define('REDIRECT_URI', 'http://localhost:8000/schedule/google_calender_event_sync.php');

$googleOauthURL = 'https://account.google.com/o/oauth2/auth'.urlencode(GOOGLE_OAUTH_SCOPE). '&redirect_url='.REDIRECT_URI.'&response_type=code&client_id='.GOOGLE_CLIENT_ID. '&access_type=online';

if(!session_id()) session_start();

// Google OAuth URL 
$googleOauthURL = 'https://accounts.google.com/o/oauth2/auth?scope=' . urlencode(GOOGLE_OAUTH_SCOPE) . '&redirect_uri=' . REDIRECT_URI . '&response_type=code&client_id=' .GOOGLE_CLIENT_ID . '&access_type=online'; 
 
?>
