<?php
require __DIR__ . '/vendor/autoload.php';

use Aws\SecretsManager\SecretsManagerClient;
use Aws\Exception\AwsException;

$secretName = 'project/db/credentials-v2';
$region = 'ap-southeast-1';

$client = new SecretsManagerClient([
    'version' => 'latest',
    'region'  => $region,
]);

try {
    $result = $client->getSecretValue(['SecretId' => $secretName]);
} catch (AwsException $e) {
    error_log($e->getMessage());
    die("Failed to retrieve database credentials.");
}

if (isset($result['SecretString'])) {
    $secret = json_decode($result['SecretString'], true);
} else {
    die("SecretString not found.");
}

$servername = $secret['host'];
$username   = $secret['username'];
$password   = $secret['password'];
$dbname     = 'project_management_db';

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>