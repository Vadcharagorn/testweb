<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body onload="loadDoc()">
    <h1>Result</h1>
    Add Test:<input type="text" id="name"><input type="text" id="age">
    <button onclick="add_new()">Add Data</button><br>
    <div id="result">

    </div>
    <script>
        function loadDoc(){
            let xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function(){
                console.log(this.readyState + "," + this.status);
                if(this.readyState==4 && this.status == 200){
                    alert(this.responseText);
                }
            };
            xhttp.open("GET", "rest.php");
            xhttp.send();
        }

        function add_new(){
            let xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function(){
                console.log(this.readyState + "," + this.status);
                if(this.readyState==4 && this.status == 200){
                    alert(this.responseText);
                }
            };
            n = document.getElementById("name")
            a = document.getElementById("age");
            xhttp.open("POST", "rest.php",true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("name=" + n.value + "&age=" + a.value);
        }
    </script>
</body>
</html>