<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="../../node_modules/exif-js/exif.js"></script>
    <title>Document</title>
</head>
<body>

<img src="upload/IMG_5402.jpg" id="img1" style="width: 100%;">
<span id="makeAndModel"></span>
<span id="makeAndModel1"></span>


<script>
    window.onload=getExif;

    function getExif() {
        var img1 = document.getElementById("img1");
        EXIF.getData(img1, function() {
            var data_e = EXIF.getTag(this, "DateTime");
            document.getElementById("makeAndModel").innerHTML = data_e;

        });

        EXIF.getData(img1, function() {
            var loc = EXIF.getTag(this, "GPSLatitude");
            document.getElementById("makeAndModel1").innerHTML = loc;

            var loc_l = EXIF.getTag(this, "GPSLongitudeRef");
            document.getElementById("makeAndModel1").innerHTML += '  ' + loc_l;

            ParseDMS(parseInt(loc_l));

            function ParseDMS(input) {
                var parts = input.split(/[^\d\w]+/);
                var lat = ConvertDMSToDD(parts[0], parts[1], parts[2], parts[3]);
              // var lng = ConvertDMSToDD(parts[4], parts[5], parts[6], parts[7]);
                console.log(lat);
               // console.log(lng);
            }
        });
    }


  //  dd = d + m/60 + s/3600



</script>

<?php

?>



</body>
</html>
