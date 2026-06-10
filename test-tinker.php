<?php
$cj = '/tmp/cj23.txt';
@unlink($cj);
echo "Getting login page...\n";
$ch = curl_init('http://127.0.0.1/login');
curl_setopt_array($ch, array(
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_COOKIEJAR => $cj,
  CURLOPT_COOKIEFILE => $cj,
  CURLOPT_TIMEOUT => 10,
));
$html = curl_exec($ch);
curl_close($ch);
echo "HTML length: " . strlen($html) . "\n";
preg_match('/name="_token".*?value="([^"]+)"/', $html, $m);
$token = $m[1] ?? 'NOT FOUND';
echo "Token: $token\n";
if (!isset($m[1])) { echo "RAW:" . substr($html, 0, 500) . "\n"; exit; }

echo "Logging in...\n";
$ch = curl_init('http://127.0.0.1/login');
curl_setopt_array($ch, array(
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_POST => true,
  CURLOPT_POSTFIELDS => '_token=' . urlencode($token) . '&nik=1234567890123456&password=admin123',
  CURLOPT_COOKIEJAR => $cj,
  CURLOPT_COOKIEFILE => $cj,
  CURLOPT_TIMEOUT => 10,
  CURLOPT_FOLLOWLOCATION => true,
));
$body = curl_exec($ch);
$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
echo "Login final code: $code\n";

echo "Testing dashboard...\n";
$ch = curl_init('http://127.0.0.1/dashboard');
curl_setopt_array($ch, array(
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_COOKIEFILE => $cj,
  CURLOPT_TIMEOUT => 5,
));
curl_exec($ch);
echo "Dashboard: " . curl_getinfo($ch, CURLINFO_HTTP_CODE) . "\n";
curl_close($ch);

echo "\n--- TESTING ALL ADMIN PAGES ---\n";
$pages = array('/admin/home','/admin/surat','/admin/aparatur','/admin/news','/admin/users','/admin/stores','/admin/products','/admin/villagedata','/admin/refmaster','/admin/roles','/admin/permissions','/admin/templatesurat');
$ok = 0; $fail = 0;
foreach ($pages as $i => $p) {
  $ch = curl_init('http://127.0.0.1' . $p);
  curl_setopt_array($ch, array(
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_COOKIEFILE => $cj,
    CURLOPT_TIMEOUT => 8,
  ));
  curl_exec($ch);
  $c = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  curl_close($ch);
  $s = ($c == 200) ? 'PASS' : 'FAIL';
  if ($c == 200) $ok++; else $fail++;
  echo ($i+1) . ". " . substr($p,1) . ": $c $s\n";
}
echo "\n=== TOTAL: ${ok} PASS, ${fail} FAIL ===\n";
