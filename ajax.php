<!DOCTYPE html>
<html>
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
            var xhttp = new XMLHttpRequest();
            xhttp.onload = function() {
                document.getElementById("content").innerHTML = this.responseText;
            };
            xhttp.open("GET", "https://www.foxnews.com/search-results/search?q=climate%20change", true);
            xhttp.send();
        </script>
    </head>
    <body>
        <div id="content"></div>
    </body>
</html>