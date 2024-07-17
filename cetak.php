<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table A4 Size</title>
    <style>
        @page {
            size: A4;
            margin: 20mm;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            table-layout: fixed;
            height: calc(100vh - 40mm);
        }

        th, td {
            border: 1px solid #000;
            
            text-align: left;
            height: 50px;
        }

        thead th {
            background-color: #f2f2f2;
        }

        tfoot td {
            border: 1px solid #000;
        }

        .no-border {
            border: 1px solid #000;
        }

        /* Ensuring the table fills the full height of the page */
        tbody, tfoot {
            display: table-row-group;
        }

        tbody tr, tfoot tr {
            height: auto;
        }

        tbody tr {
            height: calc((100vh - 40mm) / 10); /* Assuming roughly 10 rows */
        }
    </style>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th colspan="2">Kode HPA :</th>
                <th colspan="2">Tanggal Mengerjakan :</th>
                <th colspan="2">APD :</th>
                <th colspan="2">Analis Mengerjakan :</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="8">Makroskopis</td>
            </tr>
            <tr>
                <td colspan="8"></td>
            </tr>
            <tr>
                <td colspan="8">Mikroskopis</td>
            </tr>
            <tr>
                <td colspan="8"></td>
            </tr>
            <tr>
                <td colspan="4">Traking Spesimen</td>
                <td colspan="4">kualitas_sediaan</td>
            </tr>
            <tr>
                <td colspan="4" >1. Bahan Diterima tgl...</td>
                <td colspan="4">1. Volume cairan fiksasi sesuai...</td>
            </tr>
            <tr>
                <td colspan="4">2. Makroskopis tgl...</td>
                <td colspan="4">2. Jaringan terfiksasi merata...</td>
            </tr>
            <tr>
                <td colspan="4">3. Prosessong tgl...</td>
                <td colspan="4">3. Blok parafin tidak ada fragmentasi...</td>
            </tr>
            <tr>
                <td colspan="4">4. Embeding (HPA) tgl...</td>
                <td colspan="4">4. Sediaan tanpa lipatan...</td>
            </tr>
            <tr>
                <td colspan="4">5. Mikrotomi (HPA) tgl...</td>
                <td colspan="4">5. sediaan tanpa goresan mata pisau...</td>
            </tr>
            <tr>
                <td colspan="4">6. Pewarnaan tgl...</td>
                <td colspan="4">6. Kontras warna sediaan cukup jelas...</td>
            </tr>
            <tr>
                <td colspan="4">7. Entelan tgl...</td>
                <td colspan="4">7. Sediaan tanpa gelembung...</td>
            </tr>
            <tr>
                <td colspan="4"></td>
                <td colspan="4">8. Sediaan tanpa bercak/sidik jari...</td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="8">Gambar</td>
            </tr>
            <tr>
                <td colspan="1"></td>
                <td colspan="1"></td>
                <td colspan="1"></td>
                <td colspan="1"></td>
                <td colspan="1"></td>
                <td colspan="1"></td>
                <td colspan="1"></td>
                <td colspan="1"></td>
            </tr>
            <tr>
                <td colspan="1"></td>
                <td colspan="1"></td>
                <td colspan="1"></td>
                <td colspan="1"></td>
                <td colspan="1"></td>
                <td colspan="1"></td>
                <td colspan="1"></td>
                <td colspan="1"></td>
            </tr>
        </tfoot>
    </table>
</body>
</html>
