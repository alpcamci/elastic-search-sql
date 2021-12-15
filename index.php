<!doctype html>

<html lang="en">

<head>
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  <meta charset="utf-8">
  <title></title>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
  <script type="text/javascript">
    $(function() {
      function api(postData) {
        $.post("api.php", postData, function(sonuc) {
          sonuc = JSON.parse(sonuc);

          $("table tbody,.arama_suresi,.arama_sonucu").text('')
          sonuc.elasticsearch.hits.hits.forEach(function(item) {
            var cevapspan = document.getElementById('cevap');
            var title = item._source.title;
            var question = item._source.question;
            var answer = item._source.answer;
            var tr = '<tr>';
            tr += '<tr>';
            tr += '<td>' + title + '</td>';
            tr += '<td>' + question + '</td>';
            tr += '<td>' + answer + '</td>';
            tr += '</tr>';
            $('tbody').append(tr);
            /*	$("table tbody").append('<tr><td>'+title+'</td><td>'+question+'</td><td>'+answer+'</td><td></td></tr>') */
            $("table tbody tr td:nth-child(3)").addClass("cevap");
            $("table tbody tr td:nth-child(2)").addClass("soru");
          });
        });
      }

      $("#wildcard_sorgusu").keyup(function() {
        var str = $("#wildcard_sorgusu").val().length;
        if (str > 3 || str == 0) {
          var postData = {};
          postData['islem'] = "wildcard_sorgusu";
          postData['adet'] = $(".adet").val();
          postData['wildcard'] = $(".wildcard").val();
          api(postData);
        }

      });
    });
  </script>

  <style type="text/css">
    .arama {
      width: 400px;
      margin: 0 auto;
      background: #f9f9f9;
      text-align: center;
      padding: 30px;
    }

    .arama_item {
      width: 200px;
      float: left;
    }

    .arama_adet {
      text-align: left;
      margin-bottom: 30px;
    }

    input {
      padding: 5px;
    }

    table {
      font-family: arial, sans-serif;
      border-collapse: collapse;
      width: 100%;
      font-size: 16px;
    }

    td,
    th {
      border: 1px solid #dddddd;
      text-align: left;
      padding: 8px;
    }

    tbody tr:nth-child(even) {
      background-color: #dddddd;
    }

    .cevap {
      font-style: italic;
    }

    .soru {
      font-weight: bold;
    }
  </style>
</head>

<body>

  <div class="arama">
    <div class="arama_item">
      <input id="wildcard_sorgusu" type="text" placeholder="ara" class="wildcard"> <br><br>
    </div>
    <div style="clear: both;"></div>
  </div>

  <div class="istatislik">
    <h2>ARAMA SONUCU</h2>
    <table>
      <thead>
        <tr>
          <th>Title</th>
          <th>Question</th>
          <th>Answer</th>
        </tr>
      </thead>
      <tbody> </tbody>
    </table>
  </div>
</body>
</html>