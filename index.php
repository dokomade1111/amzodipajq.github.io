<?php
// Mendapatkan IP address dari pengguna
$ipAddress = $_SERVER['REMOTE_ADDR'];

// Gunakan API pihak ketiga untuk mengekstrak info lokasi
// Contohnya menggunakan http://ip-api.com
// Catatan: Gunakan dengan bijak dan sesuai dengan ketentuan layanan dari API penyedia
$url = "http://ip-api.com/json/" . $ipAddress;
$ch = curl_init($url);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

// Decode response
$locationData = json_decode($response, true);

if ($locationData && $locationData['status'] !== 'fail') {
    // Mengatur header untuk menunjukkan bahwa output adalah dalam format teks
    header('Content-Type: text/plain');

    // Menampilkan hasil
    echo "IP Address: " . $ipAddress . "\n";
    echo "Country: " . $locationData['country'] . "\n";
    echo "Region: " . $locationData['regionName'] . "\n";
    echo "City: " . $locationData['city'] . "\n";
    echo "ISP: " . $locationData['org'] . "\n";
} else {
    echo "Tidak dapat mendapatkan lokasi untuk IP Address: " . $ipAddress;
}
?>
