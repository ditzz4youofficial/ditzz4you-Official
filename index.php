<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $token = '7686291287:AAG30CVO6vD_4Dq715CwN7__FwoS1OjWRLQ';
  $chat_id = '7638073922';

  $nama = $_POST['nama'];
  $produk = $_POST['produk'];

  $file = $_FILES['bukti']['tmp_name'];
  $filename = $_FILES['bukti']['name'];

  $caption = "📦 Order Baru:\n👤 Nama: $nama\n🛒 Produk: $produk";

  $sendDocument = curl_init();
  curl_setopt_array($sendDocument, [
    CURLOPT_URL => "https://api.telegram.org/bot$token/sendDocument",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => [
      'chat_id' => $chat_id,
      'caption' => $caption,
      'document' => new CURLFile($file, mime_content_type($file), $filename)
    ]
  ]);

  $response = curl_exec($sendDocument);
  curl_close($sendDocument);

  echo "<script>alert('Order telah dikirim ke Telegram!');</script>";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Form Order Telegram</title>
</head>
<body>
  <h2>Form Order</h2>
  <form method="POST" enctype="multipart/form-data">
    <label>Nama</label><br>
    <input type="text" name="nama" required><br><br>

    <label>Produk</label><br>
    <select name="produk" required>
      <option value="Reseller Panel Bot">Reseller Panel Bot</option>
      <option value="Admin Panel Bot">Admin Panel Bot</option>
    </select><br><br>

    <label>Bukti Transfer</label><br>
    <input type="file" name="bukti" accept="image/*" required><br><br>

    <button type="submit">Kirim</button>
  </form>
</body>
</html>
