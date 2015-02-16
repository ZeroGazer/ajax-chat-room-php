<?php

if (!isset($_COOKIE["name"])) {
    header("Location: error.html");
    return;
}

// get the name from cookie
$name = $_COOKIE["name"];

print "<?xml version=\"1.0\" encoding=\"utf-8\"?>";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Add Message Page</title>
        <link rel="stylesheet" type="text/css" href="style.css" />
        <script type="text/javascript">
        //<![CDATA[
        function load() {
            var name = "<?php print $name; ?>";
            window.parent.frames["message"].document.getElementById("username").setAttribute("value", name)
            setTimeout("document.getElementById('msg').focus()",100);
        }
        function select(color) { 
            document.getElementById("color").value=color;
        }
        //]]>
        </script>
    </head>
    <body style="text-align: left" onload="load()">
        <form action="add_message.php" method="post">
            <table border="0" cellspacing="5" cellpadding="0">
                <tr>
                    <td>What is your message?</td>
                </tr>
                <tr>
                    <td><input class="text" type="text" name="message" id="msg" style= "width: 780px" /></td>
                </tr>
                <tr>
                    <td>Choose your color:</td>
                </tr>
                    <td>
                        <div style="width:180px; height:30px">
                            <div style="position:relative;background-color:black; width:30px; height:30px; left:0px; top:0px" onclick="select('0x000000')"></div>
                            <div style="position:relative;background-color:red; width:30px; height:30px; left:30px; top:-30px" onclick="select('0xff0000')"></div>
                            <div style="position:relative;background-color:orange; width:30px; height:30px; left:60px; top:-60px" onclick="select('0xff8000')"></div>
                            <div style="position:relative;background-color:yellow; width:30px; height:30px; left:90px; top:-90px" onclick="select('0xffff00')"></div>
                            <div style="position:relative;background-color:green; width:30px; height:30px; left:120px; top:-120px" onclick="select('0x00ff00')"></div>
                            <div style="position:relative;background-color:white; width:30px; height:30px; left:150px; top:-150px" onclick="select('0xffffff')"></div>
                        </div>
                        <input type="hidden" name="color" id="color" value="0x000000" />
                    </td>
                <tr>
                    <td><input class="button" type="submit" value="Send Your Message" style="width: 200px" /></td>
                </tr>
            </table>
        </form>
        <hr />
        <form onsubmit="window.open('userlist.php','newWindow','width=450,height=550,toolbar=0');">
            <table border="0" cellspacing="5" cellpadding="0">
                <tr style="border-top: 1px solid gray">
                    <td><input class="button" type="submit" value="Show Online User List" style="width: 200px" /></td>
                </tr>
            </table>
        </form>
        <form action="logout.php" method="post" onsubmit="alert('Goodbye!')">
            <table border="0" cellspacing="5" cellpadding="0">
                <tr style="border-top: 1px solid gray">
                    <td><input class="button" type="submit" value="Logout" style="width: 200px" /></td>
                </tr>
            </table>
        </form>
    </body>
</html>
