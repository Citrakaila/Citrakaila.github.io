<?php
// Koneksi Database
$conn = mysqli_connect("localhost", "root", "", "gallery");

// Fungsi untuk query
function query($query){
  global $conn;

  $result = mysqli_query($conn,$query);
  $rows = [];
  while($row = mysqli_fetch_assoc($result)){
    $rows[] = $row;
  }
  return $rows;

}

function registrasi($data){
  global $conn;

  $nama = $data["nama"];
  $email = $data["email"];
  $username = strtolower($data["username"]);

  // Cek username
  $result = mysqli_query($conn, "SELECT * FROM user WHERE username='$username'");

  if(mysqli_fetch_assoc($result)){
    echo "<script>
    alert('username sudah terdaftar');
    </script>";
    return false;
  }
  $password = mysqli_real_escape_string($conn, $data['password']);
  $password2 = mysqli_real_escape_string($conn, $data['password2']);
  $alamat = $data['alamat'];
  $no_telp = $data['no_telp'];

  // cek password
  if ($password !== $password2){
    echo "<script>
    alert('konfirmasi password tidak sesuai');
    </script>";
    return false;
  }

  //enskripsi password
  $password = password_hash($password, PASSWORD_DEFAULT);

  // tambah ke database 
  mysqli_query( $conn,"INSERT INTO user VALUES ('', '$username','$password','$email','$nama','$alamat','$no_telp')");

  return mysqli_affected_rows($conn);

}

?>