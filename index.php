<!DOCTYPE html>
<html>
    <head>
        <title>EduConnect</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Boostrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <!-- fontawesome import -->
        <script src="https://kit.fontawesome.com/a583abe2ed.js" crossorigin="anonymous"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Oswald&display=swap" rel="stylesheet">
        <!-- CSS -->
        <style>
        
            /* general */
            .vContainer{
                padding: 0px 10px;
            }
            
            body{
                background-color: #fafafa;
            }
            
            .infoHeader{
                font-size: 16px;
                 background-color: #eee;
                color: #497df2;
                padding: 5px;
            }
        
            /* Nav bar styling */
            .navbar{
                justify-content:center;
                font-size: 30px;
                position: fixed;
                border-bottom: 1px solid #eee;
                background-color: white;
                width: 100%;
                top:0；  
            }
            .navbar-spacer{
                height: 100px;
            }
            .logo{
                position: absolute;
                left: 10px;
                width: 85px;
            }
            
            /* Nearby friend accordion styling */
            .profileImage{
                width: 50px;
                border-radius: 100%;
            }
            
            .profileInfo{
                padding-left:10px;
            }
            .major{
                font-size: 14px;
                color: grey;
            }
            .accordion-button{
                font-weight:bold;
            }
            .accordion-button:not(.collapsed){
                background-color: #497df2;
                color: white;
            }
            .accordion-button:not(.collapsed) .major{
                color: white;
            }
            .fa-user-circle{
                text-align:right;
                position: absolute;
                color: #497df2;
                right: 10px;
                width: 85px;
                font-size:35px;
                cursor:pointer;
            }
            
            #loadingBar{
                background-color: #497df2;
                margin: 10px;
                height: 5px;
                max-width:0%;
            }
            
            .vIcons{
                cursor:pointer;
                padding-right:10px;
                color:#497df2;
                font-size: 40px;
            }
            
            hr{
                margin-top: 0px;
                margin-bottom:10px;
            }
        </style>
    </head>
    <body>
        <!-- Navbar -->
        <div class="navbar fixed-top"><img class="logo" src="content/images/educlogo.jpg" href="http://c9.noah.kim/educonn"><text style="font-family: 'Oswald', sans-serif;">edu</text><text style="color:#497df2; font-family: 'Oswald', sans-serif;">Connect</text><i onclick="vEditProfile()" class="fas fa-user-circle"></i></div>
        <div class="navbar-spacer"></div>
        
        <!-- -->
        
        <!-- Accordion Headers -->
        <div class="vContainer" id="headertemp">
            <h2>Nearby Students</h2>
        </div>
        
        <!-- Loading Bar -->
        <div id="loadingBar"></div>
        
        <!-- will be dynamically created with JS -->
        <div class="vContainer" id="vNearbyStudents">
        </div>
        
    </body>
    <script>
    
        //build out the accordion
        function buildAccordion(usersJSON){
            var htmlString = '';
            htmlString += '<div class="accordion" id="vAccordion">';
            var users = JSON.parse(usersJSON);
            for(var i = 0; i < users.length; i++){
                if(users[i][0] == email){
                    continue;
                }
                htmlString += '<div class="accordion-item">';
                    htmlString += '<h2 class="accordion-header" id="heading' + i + '">';
                        htmlString += '<button onclick="vToggleStatus()" class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse' + i + '" aria-expanded="false" aria-controls="collapse' + i + '">';
                            htmlString += '<img class="profileImage" src="' + users[i][5] + '" />';
                            htmlString += '<div class="profileInfo">' + users[i][2] + '<br><text class="major">' + users[i][7] + '</text></div>';
                        htmlString += '</button>';
                    htmlString += '</h2>';
                    htmlString += '<div id="collapse' + i + '" class="accordion-collapse collapse" aria-labelledby="heading' + i + '" data-bs-parent="#vAccordion">';
                        htmlString += '<div class="accordion-body">';
                            htmlString += '<div class="infoHeader">Bio:</div>';
                            htmlString += '<div><p>' + users[i][6] + '</p></div>';
                            htmlString += '<div class="infoHeader">Classes:</div>';
                            htmlString += '<div style="white-space:pre-wrap"><p>' + users[i][8] + '</p></div>';
                            htmlString += '<div class="infoHeader">Socials:</div>';
                            htmlString += '<div>';
                                htmlString += '<a href="https://www.instagram.com/' + users[i][10] + '"><i class="vIcons fab fa-instagram"></i></a>';
                                htmlString += '<a href="' + users[i][11] + '"><i class="vIcons fab fa-linkedin"></i></a>';
                            htmlString += '</div>';
                        htmlString += '</div>';
                    htmlString += '</div>';
                htmlString += '</div>';
            }
            htmlString += '</div>';
            document.getElementById("vNearbyStudents").innerHTML = htmlString;
        }
    
        //gets the cookie value by name
        function getCookie(cname) {
            let name = cname + "=";
            let decodedCookie = decodeURIComponent(document.cookie);
            let ca = decodedCookie.split(';');
            for(let i = 0; i <ca.length; i++) {
                let c = ca[i];
                while (c.charAt(0) == ' ') {
                    c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                    return c.substring(name.length, c.length);
                }
            }
            return "";
        }
        
        
        //get the user email
        var email = getCookie("email");
        
        //gets the location and passes it into a callback function - updateLocation
        function getLocation() {
            if (navigator.geolocation) {
                console.log("updating location");
                navigator.geolocation.getCurrentPosition(vUpdateLocation);
            } else {
                document.getElementById("vNearbyStudents").innerHTML = "Geolocation is not supported by this browser.";
            }
            clearTimeout(locationTimer);
            locationTimer = setTimeout(function(){
                getLocation();
            }, 10000);
        }
        
        //callback function from getLocation
        function vUpdateLocation(position) {
            
            //get the longitude and latitude
            var latitude = position.coords.latitude;
            var longitude = position.coords.longitude;
            console.log("Latitude: " + latitude + " Longitude: " + position.coords.longitude);
            
            //send it to the database
            var xhttp = new XMLHttpRequest();
            
            //get the form data
            var postData = {};
            postData["email"] = email;
            postData["latitude"] = latitude;
            postData["longitude"] = longitude;
            
            xhttp.onload = function() {
                console.log(this.responseText);
            };
            
            xhttp.open("POST", "http://c9.noah.kim/educonnect/calls/updateLocation.php", true);
            xhttp.send(JSON.stringify(postData));
            
        }
        
        //get nearby users
        function vGetNearbyUsers(){
         
            console.log("get nearby users");
            
            //send it to the database
            var xhttp = new XMLHttpRequest();
            
            //get the form data
            var postData = {};
            postData["email"] = email;
            
            xhttp.onload = function() {
                console.log(this.responseText);
                buildAccordion(this.responseText);
            };
            
            xhttp.open("POST", "http://c9.noah.kim/educonnect/calls/getNearbyUsers.php", true);
            xhttp.send(JSON.stringify(postData));
            
            clearTimeout(getNearbyTimer);
            getNearbyTimer = setTimeout(function() {
                vGetNearbyUsers();
            }, 10000);
            
        }
        
        function vEditProfile(){
            window.location.href = "/educonnect/editUser";
        }
        
        //tracks the recursive calls
        var locationTimer;
        var getNearbyTimer;
        
        //track if accordion is open or closed
        var open = false;
        
    
        function vToggleStatus(){
            if(!open){
                //stop getting nearby users
                clearTimeout(getNearbyTimer);
                open = true;
            } else {
                //resume getting nearby users
                vGetNearbyUsers();
                open = false;
            }
        }
        
        
        //recursive calls to keep updating data
        function vInit(){
            getLocation();
            vGetNearbyUsers(); 
        }
        
        $(document).ready(function() {
            vInit();
        });
        
        document.addEventListener('visibilitychange', e=>{
             if (document.visibilityState === 'visible') {
                getLocation();
            } else {
                console.log("stop sharing location, wipe it");
                clearTimeout(locationTimer);
                var xhttp = new XMLHttpRequest();
                xhttp.onload = function() {
                    console.log(this.responseText);
                };
                xhttp.open("POST", "calls/eraseLocation.php", true);
                xhttp.send(JSON.stringify(email));
            }  
        })
    </script>
</html>