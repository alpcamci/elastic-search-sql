### Elasticsearch

Elasticsearch ve SQL arasında bağlantı oluşturmayı, ayrıca arama ve kaydetme işlemlerinin nasıl bağlantılı şekilde yapıldığına dair örnek gösterilmiştir.

- ES(ElasticSearch), Java diliyle yazılmıştır. Bu yüzden kuruluma başlamadan önce bilgisayarınızda JAVA’nın latest version ve bilgisayarınıza uyumlu olan bit(32/64) sürümü olduğundan emin olun. Emin değilseniz tüm Java kurulumlarını bilgisayarınızdan kaldırarak şuradan indirip kurabilirsiniz.
- Elasticsearch son versiyonunu [bu link](https://www.elastic.co/downloads/elasticsearch "bu link") üzerinden sunucuya indirebiliriz. İndirdiğimiz dosyayı C ye çıkartıyoruz ardından konfigürasyon için “C:\elasticsearch-7.10.2\config” dizinindeki “elasticsearch.yml” dosyasını editliyoruz.

# Elasticsearh.yml

```javascript
# Use a descriptive name for your cluster:
#
cluster.name: elastic_alp_test
#
# ------------------------------------ Node ------------------------------------
#
# Use a descriptive name for the node:
#
node.name: alp_test_01
#

```

**Node :** Elasticsearch’in tek bir çalışan örneğini ifade eder. Tek fiziksel ve sanal Sunucu; RAM, depolama ve işleme gücü gibi fiziksel kaynaklarının yeteneklerine bağlı olarak birden çok düğüm barındırır.
**Cluster : **Bir veya daha fazla düğümün bir koleksiyonudur. Cluster , tüm veriler için toplu dizin oluşturma ve arama yetenekleri sağlar. Yani tüm elastic search instancelarini bir arada tutan yapı.

*Sunucudan bağlantıyı açabilmek için network alanında da yapılan ayarlar.*

```javascript
# ---------------------------------- Network -----------------------------------
#
# Set the bind address to a specific IP (IPv4 or IPv6):
#
network.host: xxx.xx.x.xx (sunucu adresi)
discovery.seed_hosts: []
````
Browser üzerinden yapınızı yönetmek için **ElasticSearch Head** isimli eklentiyi kullanabilirsiniz.

![](https://i.hizliresim.com/bew6bhv.png)

![](https://i.hizliresim.com/nogkur6.png)

![](https://i.hizliresim.com/bklqfch.png)

Elasticsearch bağlantısı için config.php dosyamız;

```javascript
<?php
  /* elasticsearch dosyalarını projeye dahil ediyoruz */
    require 'vendor/autoload.php';
    use Elasticsearch\ClientBuilder;
    $hosts = [
        'xxx.xxx.xxxx',
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
```
