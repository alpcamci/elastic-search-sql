<?php  ?>
<?php
header('Content-type: text/html; charset=utf-8');
/* php hata loglarını açıyoruz */
ini_set('max_execution_time', 0);
error_reporting(E_ALL);
ini_set("display_errors", 1);

$durum = array();

/* bağlantı var mı, yok mu kontrol ediyoruz */
if (isset($_POST)) {
    include "config.php";
    function wildcard_sorgusu($tablo)
    {
        global $client, $durum;
        $baslangic_zamani = time();
        $sorgu = [
            'index' => 'sorular',
            'type' => '_doc',
            'size' => 1000,
            'body' => [
                'query' => [
                    'query_string' => [
                        'query' => '*' . $tablo["wildcard"] . '*',
                        'fields' => [
                            'title',
                            'question',
                            'answer'
                        ]
                    ]
                ]
            ]
        ];
        $sonuc = $client->search($sorgu);
        $durum["durum"] = true;
        $durum["mesaj"] = "Islem Basarili";
        $durum["arama_suresi"] = time() - $baslangic_zamani;
        $durum["elasticsearch"] = $sonuc;
    }


    $tablo = array();
    $tablo["adet"] = 1000;
    $tablo["terim"] = @$_POST["terim"];
    $tablo["wildcard"] = @$_POST["wildcard"];
    $tablo["terimler"] = @explode(",", $_POST["terimler"]);


    call_user_func($_POST["islem"], $tablo);
} else {
    $durum["sonuc"] = false;
    $durum["mesaj"] = "Gerçersiz Post";
}

echo json_encode($durum);

?>