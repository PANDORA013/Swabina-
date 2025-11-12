<?php
// Simple route test
$url = "http://localhost/project_magang/public/sertifikat-penghargaan";
$headers = @get_headers($url);
if($headers && strpos($headers[0], '200') !== false) {
    echo "✓ Route /sertifikat-penghargaan is accessible (HTTP 200)\n";
} else if($headers && strpos($headers[0], '500') !== false) {
    echo "✗ Route /sertifikat-penghargaan has error (HTTP 500)\n";
} else {
    echo "? Could not determine route status\n";
    print_r($headers);
}
?>
