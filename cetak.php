<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table F4 Size</title>
    <style>
        @page {
            size: 215mm 330mm; /* F4 size */
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }
         td {
            border: 1px solid #000;
            text-align: left;
            padding: 4px;
        }
        .judul{
            font-weight: bold;
        }
        .text {
            padding: 150px;
        }
        .gambar {
            padding: 50px;            
        }
    </style>
</head>
<body>
    <table>
        <tbody>
            <tr>
                <td colspan="1">Kode HPA :</td>
                <td colspan="1">Tanggal Mengerjakan :</td>
                <td colspan="1">Tanggal Janji Hasil :</td>
                <td colspan="1">APD :</td>
            </tr>
            <tr class="judul">
                <td colspan="2" class="judul" >Makroskopis</td>
                <td colspan="2" >Analis PA :</td>
            </tr>
            <tr>
                <td colspan="4" class="text"></td>
            </tr>
            <tr class="judul">
                <td colspan="2">Mikroskopis</td>
                <td colspan="2">Dokter PA :</td>
            </tr>
            <tr>
                <td colspan="4" class="text"></td>
            </tr>
            <tr class="judul">
                <td colspan="2">Traking Spesimen</td>
                <td colspan="2">Kualitas Sediaan</td>
            </tr>
            <tr>
                <td colspan="2">1. Bahan Diterima tgl...</td>
                <td colspan="2">1. Volume cairan fiksasi sesuai...</td>
            </tr>
            <tr>
                <td colspan="2">2. Makroskopis tgl...</td>
                <td colspan="2">2. Jaringan terfiksasi merata...</td>
            </tr>
            <tr>
                <td colspan="2">3. Prosessong tgl...</td>
                <td colspan="2">3. Blok parafin tidak ada fragmentasi...</td>
            </tr>
            <tr>
                <td colspan="2">4. Embeding (HPA) tgl...</td>
                <td colspan="2">4. Sediaan tanpa lipatan...</td>
            </tr>
            <tr>
                <td colspan="2">5. Mikrotomi (HPA) tgl...</td>
                <td colspan="2">5. sediaan tanpa goresan mata pisau...</td>
            </tr>
            <tr>
                <td colspan="2">6. Pewarnaan tgl...</td>
                <td colspan="2">6. Kontras warna sediaan cukup jelas...</td>
            </tr>
            <tr>
                <td colspan="2">7. Entelan tgl...</td>
                <td colspan="2">7. Sediaan tanpa gelembung...</td>
            </tr>
            <tr>
                <td colspan="2">8. Selesai tgl...</td>
                <td colspan="2">8. Sediaan tanpa bercak/sidik jari...</td>
            </tr>
        </tbody>
    </table>
    <table>
        <tbody>
            <tr class="judul">
                <td colspan="6">Gambar</td>
            </tr>
            <tr>
                <td colspan="1" class="gambar"></td>
                <td colspan="1" class="gambar"></td>
                <td colspan="1" class="gambar"></td>
                <td colspan="1" class="gambar"></td>
                <td colspan="1" class="gambar"></td>
                <td colspan="1" class="gambar"></td>
            </tr>
            <tr>
                <td colspan="1" class="gambar"></td>
                <td colspan="1" class="gambar"></td>
                <td colspan="1" class="gambar"></td>
                <td colspan="1" class="gambar"></td>
                <td colspan="1" class="gambar"></td>
                <td colspan="1" class="gambar"></td>
            </tr>
        </tbody>
    </table>
</body>
</html>