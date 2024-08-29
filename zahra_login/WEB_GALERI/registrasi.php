<?php
require 'fungsi.php';
if (isset($_POST['registrasi'])){

  if(registrasi($_POST) > 0) {
    echo "<script>
    alert('berhasil daftar, silahkan login!');
    </script>";
  } else {
    echo mysqli_error($conn);
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrasi | Galeri Foto</title>
</head>

<body>
  <main>
     <form action="" method="post">
      <div>
        <label for="nama">Nama Lengkap :</label>
        <input type="text" name="nama" id="nama" required>
      </div>
      <div>
        <label for="email">Email :</label>
        <input type="email" name="email" id="email" required>
      </div>
      <div>
  <label for="username">Username :</label>
  <input type="text" name="username" id="username" required>
</div>
<div>
  <label for="password">Password :</label>
  <input type="password" name="password" id="password" required>
</div>
<div>
  <label for="password2">Konfirmasi Password :</label>
  <input type="password" name="password2" id="password2" required>
</div>
<div>
  <label for="alamat">Alamat :</label>
  <textarea name="alamat" id="alamat" cols="30" rows="10"></textarea>
</div>
<div>
  <label for="no_telp">Nomor Telepon :</label>
  <input type="number" name="no_telp" id="no_telp" required>
</div>
<button type="submit" name="registrasi">Daftar</button>
     </form>
  </main>
</body>
    
</html>