<?php
// proxy.php
// อนุญาตให้เข้าถึงจากทุกโดเมน (CORS)
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$url = 'https://data.hii.or.th/en/api/3/action/datastore_search?resource_id=bdacca62-c465-411b-a135-617995eba967&limit=10000';

$options = [
    "http" => [
        "method" => "GET",
        "header" => "User-Agent: PHP-Proxy\r\n",
        "timeout" => 60
    ],
    "ssl" => [
        "verify_peer" => false,
        "verify_peer_name" => false
    ]
];
$context = stream_context_create($options);

$response = @file_get_contents($url, false, $context);

if ($response === FALSE) {
    http_response_code(500);
    echo json_encode(["success" => false, "message" => "เกิดข้อผิดพลาดในการดึงข้อมูลจาก HII API"]);
    exit;
}

echo $response;
?>
