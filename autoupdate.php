<?php
    include 'config.php';
    $result2 = mysqli_query($conn,"SELECT * FROM bid inner join produk on bid.id_products = id_produk join kategori on produk.idcat = kategori.id_kat ");
    $nowtime = [];
    while($row = mysqli_fetch_assoc($result2)){
    $nowtime[] = $row;
    }
    foreach($nowtime as $now){
        $timezone = new DateTimeZone('Asia/Singapore');
        $today = new DateTime();
        
    $today = $today->setTimezone($timezone);
    $datebegin = new DateTime($now['tanggal_dimulai']);
    $datelast = new DateTime($now['tanggal_berakhir']);
    if($today > $datelast){
        mysqli_query($conn,"UPDATE bid set status = 'ditutup' where CURRENT_TIMESTAMP > tanggal_berakhir");

    }else if($today > $datebegin){
        mysqli_query($conn,"UPDATE bid set status = 'dibuka' where CURRENT_TIMESTAMP < tanggal_dimulai ");
    }

    }

?>