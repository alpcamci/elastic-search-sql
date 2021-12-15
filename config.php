<?php 
    /* elasticsearch dosyalarını projeye dahil ediyoruz */
    require 'vendor/autoload.php';
    use Elasticsearch\ClientBuilder;

    $hosts = [
        '',
		//ElasticSearch kurulu olan hosting bilgisi
    ];

    /* elasticsearch bağlantısı */
    $clientBuilder = ClientBuilder::create();
    $clientBuilder->setHosts($hosts); 
    $client = $clientBuilder->build(); 

    /* bağlantı var mı, yok mu kontrol ediyoruz */
    if(!$client){
        exit("Veritabanı Bağlantısı Başarısız");
    }
?>