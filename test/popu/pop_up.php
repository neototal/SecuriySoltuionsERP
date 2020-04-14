<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script type="text/javascript">
            function setup() {
                var newWin = window.open("test.php","about:blank","width=500,height=100");

//                newWin.document.write("Hello, world!");
            }
        </script>
    </head>
    <body>
        <button onclick="setup()">test</button>
    </body>
</html>
