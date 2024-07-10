<?php 
$conn = mysqli_connect("localhost", "root", "", "labpadata"); 
function query($query){
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows =[];
    while($row = mysqli_fetch_assoc($result)){
        $rows[]  = $row;
    }
    return $rows;
}
function update($query){
    global $conn;
    $result = mysqli_query($conn, $query);
    return $result;
}
function cari_norm($cari_norm){ 
    $conn = mysqli_connect("localhost", "root", "", "labpadata");
    $query = mysqli_query($conn,"SELECT * FROM pasien
            WHERE
            norm_pasien = '$cari_norm'");
    $result = mysqli_fetch_assoc($query);

    if (mysqli_affected_rows($conn) > 0 ){
   
        return $result;
    }   else {
        echo
        "<script>
         alert('Nomer Rekamedis Belum Ada!');
         document.location.href = 'tambah_pasien.php';
         </script>";
    }
    
}

function tambah_pasien($TAMBAH_DATA_PASIEN){
    global $conn;
    $norm_pasien = htmlspecialchars($TAMBAH_DATA_PASIEN["norm_pasien"]);
    $nama_pasien = htmlspecialchars($TAMBAH_DATA_PASIEN["nama_pasien"]);
    $jk_pasien = htmlspecialchars($TAMBAH_DATA_PASIEN["jk_pasien"]);
    $tgl_lahir_pasien = htmlspecialchars($TAMBAH_DATA_PASIEN["tgl_lahir_pasien"]);
    $alamat_pasien = htmlspecialchars($TAMBAH_DATA_PASIEN["alamat_pasien"]);
    $status_pasien = htmlspecialchars($TAMBAH_DATA_PASIEN["status_pasien"]);

    mysqli_query($conn,"INSERT INTO pasien
            VALUES ('','$norm_pasien','$nama_pasien','$alamat_pasien','$jk_pasien','$tgl_lahir_pasien','$status_pasien')");
            if (mysqli_affected_rows($conn) > 0 ){
                "<script>
                 alert('Data Pasien Berhasi Ditambahkan');
                 </script>";
                return $TAMBAH_DATA_PASIEN;
            }   else {
                echo
                "<script>
                 alert('Gagal Ditambahkan!');
                 document.location.href = 'tambah_pasien.php';
                 </script>";
            }
}
function tambah_hpa($TAMBAH_DATA_HPA){
    global $conn;
    $kode_hpa = $TAMBAH_DATA_HPA["kode_hpa"];
    $diagnosis_hpa = $TAMBAH_DATA_HPA["diagnosis_hpa"];
    // $makroskopis_hpa = "";
    // $mikroskopis_hpa = "";
    // $foto_hpa = "no_photo.jpg";
    // $jumlah_kaset = 1;
    $tgl_hpa = $TAMBAH_DATA_HPA["tgl_hpa"];
    $tgl_hasil_hpa = $TAMBAH_DATA_HPA["tgl_hasil_hpa"];
    // $hasil_hpa = "";
    $id_pasien = $TAMBAH_DATA_HPA["id_pasien"];
    // $id_dokter = 1;
    $id_pengirim = $TAMBAH_DATA_HPA["id_pengirim"];
    // INSERT DATA HPA
    
    mysqli_query($conn,"INSERT INTO hpa 
                        VALUES ('', '$kode_hpa', NULL, NULL, 'no_photo.jpg', NULL, '$tgl_hpa', '$tgl_hasil_hpa','$diagnosis_hpa', NULL, '$id_pasien', NULL, '$id_pengirim', 0)");      
    // INSERT DATA PEMERIKSAAN
    $id_hpa = $conn->insert_id;
    $id_analis = $TAMBAH_DATA_HPA["id_analis"];
    $tgl_mengerjakan = date('Y-m-d H:i:s');
    
    mysqli_query($conn,"INSERT INTO proses
                        VALUES ('','$id_hpa',NULL,NULL,NULL,'samples accepted','not checked','$tgl_mengerjakan',NULL,'$id_analis')");
            if (mysqli_affected_rows($conn) > 0 ){
                echo
                "<script>
                alert('Sampels accepted!');
                document.location.href = 'samples_accepted.php';
                </script>";
            }   else {
                echo
                "<script>
                alert('Gagal Ditambahkan!');
                </script>";
                var_dump(mysqli_error($conn)); die;
                "<script>                
                document.location.href = 'tambah_pemeriksaan.php';
                </script>";                
            }
}
function register($data){
    global $conn;
    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn,$data["password"]);
    $password2 = mysqli_real_escape_string($conn,$data["password2"]);
    $status_user = $data["status_user"];
    $id_analis = $data["id_analis"];
    $id_dokter = $data["id_dokter"];

    // cek username sudah ada atau belum
    $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");
    if (mysqli_fetch_assoc($result)){
        echo
        "<script>
        alert('Username Sudah Terdaftar!');
        </script>";
        return false;
    }
    if($password !== $password2){
        echo
        "<script>
        alert('Konfirmasi Password Tidak Sesuai!');
        </script>";
        return false;
    } 

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);
    // Masukan dalam database
    if ($id_analis == "NULL") {
        mysqli_query($conn, "INSERT INTO user VALUES ('', '$username', '$password', '$status_user', NULL, '$id_dokter')");
        return mysqli_affected_rows($conn);
    }
    if ($id_dokter == "NULL") {
        mysqli_query($conn, "INSERT INTO user VALUES ('', '$username', '$password', '$status_user', '$id_analis', NULL)");
        return mysqli_affected_rows($conn);
    }  
    mysqli_query($conn, "INSERT INTO user VALUES ('', '$username', '$password', '$status_user', '$id_analis', '$id_dokter')");
        return mysqli_affected_rows($conn);
}


function tambah($data){
    global $conn;
    $norm = htmlspecialchars($data["norm"]);
    $nama = htmlspecialchars($data["nama"]);
    $tgllahir = htmlspecialchars($data["tgllahir"]);
    $alamat = htmlspecialchars($data["alamat"]);

    $foto = upload();
    if (!$foto){
        return false;
    }

    $query = "INSERT INTO histopadata
                VALUES ('','$norm','$nama','$tgllahir','$alamat','$foto')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function upload() {
    $namafile = $_FILES['foto']['name'];
    $ukuranfile = $_FILES['foto']['size'];
    $error = $_FILES['foto']['error'];
    $tmpname = $_FILES['foto']['tmp_name'];

    if ( $error === 4){
        echo "<script>
                alert ('Pilih gambar terlebih dahulu');
              </script>";
              return false;
    }

    $cekjenisgambar = ['jpg','jpeg','png','svg'];
    $ekstensigambar = explode('.',$namafile);
    $ekstensigambar = strtolower(end($ekstensigambar));
    if ( !in_array($ekstensigambar,$cekjenisgambar)){
        echo "<script>
                alert ('format harus jpg.jpeg,png');
              </script>";
              return false;
    }
    if($ukuranfile > 100000){
        echo "<script>
                alert ('ukuran foto terlalu besar');
              </script>";
              return false;
    }

    $namafilebaru = uniqid();
    $namafilebaru .='.';
    $namafilebaru .= $ekstensigambar;

    move_uploaded_file($tmpname,'img/'.$namafilebaru);
    return $namafilebaru;

}

function delete($id){
    global $conn;
    mysqli_query($conn, "DELETE FROM histopadata WHERE id = $id");
    return mysqli_affected_rows($conn);
}

function edit($data){
    global $conn;
    
    $id = $data["id"];
    $norm = htmlspecialchars($data["norm"]);
    $nama = htmlspecialchars($data["nama"]);
    $tgllahir = htmlspecialchars($data["tgllahir"]);
    $alamat = htmlspecialchars($data["alamat"]);
    $fotolama = ($data["fotolama"]);
    if( $_FILES['foto']['error'] === 4){
        $$foto = $fotolama;
    } else {
        $foto = upload();
    }

    $query = "UPDATE histopadata SET norm = '$norm', nama = '$nama', tgllahir ='$tgllahir', alamat ='$alamat', foto ='$foto' WHERE id = $id";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);

}
?>