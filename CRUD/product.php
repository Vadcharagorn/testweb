<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body onload="loadDoc()">
    <h1>Create</h1>
    <pre>
    Product name:   <input type="text" id="name"><br>
    Price:          <input type="number" id="price"><br>
    Quantity:       <input type="number" id="quantity"><br>
    Picture:        <input type="file" id="pic"><br>
    </pre>
    <div>
        <img id="output" width="100px" height="100px">
    </div>
    <button onclick="add_new()">Add Product</button><br>
    <hr>
    <section style="display: flex;">
        <div id="shit" style="float: left;width: 50%;">
        </div>

        <div style="float: right;width: 50%;">
            <center>
                <h1>Update</h1>
                <pre>
Product ID:         <input type="text" id="uid" readonly><br>
Product name:       <input type="text" id="uname"><br>
Price:              <input type="number" id="uprice"><br>
Quantity:           <input type="number" id="uquantity"><br>
                </pre>
                <button onclick="update()">Update Product</button><br>
            </center>
        </div>
    </section>
    <hr>
    <section style="display: flex;">
        <div id="shit2" style="float: left;width: 50%;">
        </div>
        <div style="float: right;width: 50%;">
            <center>
                <h1>Read Order Detail</h1>
                <pre>
Order ID:           <input type="text" id="oid" readonly><br>
Quantity:           <input type="text" id="oq" readonly><br>
Total:              <input type="number" id="ot" readonly><br>
                </pre>
            </center>
        </div>
    </section>


    <script>
        const output = document.getElementById('output');
        const reader = new FileReader();
        var imgData;
        function loadDoc(){
            let xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function(){
                //console.log(this.readyState + "," + this.status);
                if(this.readyState==4 && this.status == 200){
                    var Obj = JSON.parse(this.responseText);
                    text = "<h1>Read Product</h1><br><table style='width:100%;text-align:center;' border='1'><tr><th>p_id</th><th>p_name</th><th>price</th><th>quantity</th><th>pic</th><th>Buy</th><th>Operation</th></tr>";
                    for(var i=0;i < Obj.length;i++){
                        text += "<tr><td>" + Obj[i]["p_id"] + "</td>" +
                                "<td>" + Obj[i]["p_name"] + "</td>" +
                                "<td>" + Obj[i]["price"] + "</td>" +
                                "<td>" + Obj[i]["quantity"] + "</td>" +
                                "<td><img src='" + (Obj[i]["pic"].split(' ').join('+')) + "' width='100px' height='100px'></td>" +
                                "<td><input type='number' id='bq" + i + "' style='width: 50px;' min='0' max='" + Obj[i]["quantity"] + "'><button onclick='add_order(" + Obj[i]["p_id"] + "," +  Obj[i]["price"] + "," + Obj[i]["quantity"] + "," + i + ")'>BUY</button></td>" +
                                "<td><center><button onclick='update_prep(" + Obj[i]["p_id"] + ")'>Update</button> <button onclick='delete_data(" + Obj[i]["p_id"] + ")'>Delete</button></center></td>" +
                                "</tr>";
                    }
                    text += "</table>";
                    document.getElementById("shit").innerHTML = text;
                }
            };
            xhttp.open("GET", "rest.php");
            xhttp.send();

            let xghttp = new XMLHttpRequest();
            xghttp.onreadystatechange = function(){
                if(this.readyState==4 && this.status == 200){
                    var Obj = JSON.parse(this.responseText);
                    text = "<h1>Read Order</h1><br><table style='width:100%;text-align:center;' border='1'><tr><th>order_id</th><th>order_date</th><th>Operation</th></tr>";
                    for(var i=0;i < Obj.length;i++){
                        text += "<tr><td>" + Obj[i]["order_id"] + "</td>" +
                                "<td>" + Obj[i]["order_date"] + "</td>" +
                                "<td><center><button onclick='view_detail(" + Obj[i]["order_id"] + ")'>View</button></center></td>" +
                                "</tr>";
                    }
                    text += "</table>";
                    document.getElementById("shit2").innerHTML = text;
                }
            };
            xghttp.open("GET", "rest.php?oid=1");
            xghttp.send();
        }

        function add_new(){
            let xhttp = new XMLHttpRequest();
            n = document.getElementById("name");
            p = document.getElementById("price");
            q = document.getElementById("quantity");
            xhttp.open("POST", "rest.php",true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("name=" + n.value + "&price=" + p.value + "&quantity=" + q.value + "&pic=" + imgData);
            location.reload();
        }

        function add_order(pid,price,quantity,i){
            let q = document.getElementById("bq"+i).value;
            let total = price * q;
            let xhttp = new XMLHttpRequest();
            xhttp.open("POST", "rest.php",true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("pid=" + pid + "&quantity=" + quantity + "&q=" + q + "&total=" + total);
            location.reload();
        }

        function view_detail(id){
            let xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function(){
                if(this.readyState==4 && this.status == 200){
                    var Obj = JSON.parse(this.responseText);
                    oid = document.getElementById("oid");
                    oq = document.getElementById("oq");
                    ot = document.getElementById("ot");

                    oid.value = Obj[0]["order_id"];
                    oq.value = Obj[0]["quantity"];
                    ot.value = Obj[0]["total"];
                }
            };
            xhttp.open("GET", "rest.php?odid=" + id);
            xhttp.send();
        }

        function update(){
            let xhttp = new XMLHttpRequest();
            uid = document.getElementById("uid");
            uname = document.getElementById("uname");
            uprice = document.getElementById("uprice");
            uquantity = document.getElementById("uquantity");
            xhttp.open("POST", "rest.php",true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("id=" + uid.value + "&name=" + uname.value + "&price=" + uprice.value + "&quantity=" + uquantity.value);
            location.reload();
        }

        function delete_data(id){
            let xhttp = new XMLHttpRequest();
            xhttp.open("POST", "rest.php",true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("did=" + id);
            location.reload();
        }

        function update_prep(id){
            let xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function(){
                //console.log(this.readyState + "," + this.status);
                if(this.readyState==4 && this.status == 200){
                    var Obj = JSON.parse(this.responseText);
                    uid = document.getElementById("uid");
                    uname = document.getElementById("uname");
                    uprice = document.getElementById("uprice");
                    uquantity = document.getElementById("uquantity");
                    uid.value = Obj[0]["p_id"];
                    uname.value = Obj[0]["p_name"];
                    uprice.value = Obj[0]["price"];
                    uquantity.value = Obj[0]["quantity"];
                }
            };
            xhttp.open("GET", "rest.php?id=" + id);
            xhttp.send();
        }

        if (window.FileList && window.File && window.FileReader) {
            document.getElementById('pic').addEventListener('change', event => {
                output.src = '';
                const file = event.target.files[0];
                if (!file.type) {
                    return;
                }
                if (!file.type.match('image.*')) {
                    return;
                }
                reader.addEventListener('load', event => {
                    imgData = event.target.result;
                    output.src = imgData;
                });
                reader.readAsDataURL(file);
            }); 
          }   
    </script>
</body>
</html>