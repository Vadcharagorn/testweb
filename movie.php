<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $jsonfile = file_get_contents("movies.json");
    ?>
    <select id="year_movie" onchange="show()">
    
    <script type="text/javascript">
        var jsonEx = <?php echo $jsonfile; ?>;
        for(var n = 0; n < jsonEx.length; n++){
            document.write("<option value=" + n + ">" + jsonEx[n].title + "</option>");
        }

        function show() {
            var str = "";
            var title = document.getElementById("year_movie");
            var titleValue = title.options[title.selectedIndex].value;

            document.getElementById("year").value = jsonEx[titleValue].year;
            for(var n = 0; n < jsonEx[titleValue].cast.length; n++){
                str += jsonEx[titleValue].cast[n] + "\n";
                document.getElementById("cast").value = str;
            }
            document.getElementById("genres").value = jsonEx[titleValue].genres;
        }
    </script>
    </select> 
    <div id="output">
        <pre>
        Year   : <input type="text" id="year"><br>
        Cast   : <textarea id="cast" rows="15"></textarea><br>
        Genres : <input type="text" id="genres"><br>
    </pre>
    </div>
</body>
</html>