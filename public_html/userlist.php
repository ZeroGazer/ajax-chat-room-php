<?php

print "<?xml version=\"1.0\" encoding=\"utf-8\"?>";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Online User List</title>
        <link rel="stylesheet" type="text/css" href="style.css" />
        <script language="javascript" type="text/javascript">
        //<![CDATA[
        var loadTimer = null;
        var request;
        var datasize;

        function load() {
            loadTimer = null;
            datasize = 0;
            getUpdate();
        }

        function unload() {
            if (loadTimer != null) {
                loadTimer = null;
                clearTimeout("load()", 100);
            }
        }

        function getUpdate() {
            request = new ActiveXObject("Microsoft.XMLHTTP");
            request.onreadystatechange = stateChange;
            request.open("POST", "server.php", true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send("datasize=" + datasize);
        }

        function stateChange() {
            if (request.readyState == 4 && request.status == 200 && request.responseText) {
                var xmlDoc;
                try {
                    xmlDoc = new ActiveXObject("Microsoft.XMLDOM");
                    xmlDoc.loadXML(request.responseText);
                } catch (e) {
                    var parser = new DOMParser();
                    xmlDoc = parser.parseFromString(request.responseText, "text/xml");
                }
                datasize = request.responseText.length;
                updateNameList(xmlDoc);
                getUpdate();
            }
        }

        function updateNameList(xmlDoc) {
            var current_node;
            var previous_list = document.getElementById("name_table");
            current_node = previous_list.firstChild;
            while (current_node != null) {
                var next_node = current_node.nextSibling;
                previous_list.removeChild(current_node);
                current_node = next_node;
            }
            var names = xmlDoc.getElementsByTagName("user");
            for (var i = 0; i < names.length; i++) {
                var name = names.item(i);
                var nameList = document.getElementById("name_table");
                var tr = document.createElement("tr");
                var td1 = document.createElement("td");
                var td2 = document.createElement("td");
                tr.style.setAttribute("width", "450px");
                td1.style.setAttribute("width", "100px");
                td2.style.setAttribute("width", "350px");
                td2.style.setAttribute("text-align", "center");
                nameList.appendChild(tr);
                nameList.lastChild.appendChild(td1);
                nameList.lastChild.appendChild(td2);
                var img = document.createElement("img");
                img.setAttribute("src", name.getAttribute("picture"));
                img.setAttribute("width", "100");
                img.setAttribute("height", "100");
                var nameText = document.createTextNode(name.getAttribute("name"));
                nameList.lastChild.firstChild.appendChild(img);
                nameList.lastChild.lastChild.appendChild(nameText);
            }
        }
        //]]>
        </script>
        <style>
            td {
                margin-left: auto;
                margin-right: auto;
            }
        </style>
    </head>
    <body onload="load()" onunload="unload()">
        <div style="font-size:24px; width:450px; height:50px">Online List</div>
        <table id="name_table" />
    </body>
</html>
