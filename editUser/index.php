<!DOCTYPE html>
<html>
    <head>
        <title>EduConnect</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Boostrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
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
        
            /* Nav bar styling */
            .navbar{
                justify-content:center;
                font-size: 25px;
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
            .logo img{
                width: 85px;
            }
            .fa-user-circle{
                position: absolute;
                color: #497df2;
                right: 10px;
                width: 85px;
                font-size:35px;
                cursor:pointer;
            }
            .vButton{
                padding: 5px 30px;
                background-color: #497df2;
                color: white;
                border: none;
                border-radius: 5px;
            }
            input{
                padding:5px;
            }
            #vProfileImage{
                width: 100px;
                border-radius: 100%;
            }
            
        </style>
    </head>
    <body>
        
        <!-- Navbar -->
        <div class="navbar fixed-top"><a class="logo" href="/educonnect"><img src="../content/images/educlogo.jpg" href="http://c9.noah.kim/educonn"></a><text style="font-family: 'Oswald', sans-serif;">edu</text><text style="color:#497df2; font-family: 'Oswald', sans-serif;">Connect</text><i onclick="vEditProfile()" class="fas fa-user-circle"></i></div>
        <div class="navbar-spacer"></div>
        
        <div class="vContainer">
            
            <!-- Edit Profile Header -->
            <h1>
                Edit Profile
            </h1>
            
            <!-- Edit Profile form -->
            <form onsubmit="event.preventDefault(); vEdit()">
                <input id="vName" placeholder="Name" style="margin-top: 10px; width:250px;" required/><br><br>
                <img id="vProfileImage" src=""/>
                <p>Select profile image to upload: </p>
                <input type="file" name="image-file" id="image-file"><br>
                <textarea id="vBio" placeholder="Bio" style="margin-top: 10px; padding:10px; width:250px;"></textarea><br>
                <textarea id="vClasses" placeholder="Classes" style="margin-top: 10px; padding:10px; width:250px;"></textarea><br>
                <input id="vMajor" placeholder="Major" style="margin-top: 10px; width:250px;" required/><br>
                <input id="vPhone" type="tel" placeholder="Phone Number" style="margin-top: 10px; width:250px;"/><br>
                <input id="vInstaUsername" placeholder="Instagram username" style="margin-top: 10px; width:250px;"/><br>
                <input id="vLinkedinUrl" placeholder="LinkedIn URL" style="margin-top: 10px; width:250px;"/><br>
                <button class="vButton" style="margin-top:10px;" value="Update">Update</button>
            </form>
        </div>
        
    </body>
    <script>
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
        //send the email address to the editUser.php to edit user data
        function vEdit(){
            
            var xhttp = new XMLHttpRequest();
            
            xhttp.onload = function() {
                //console.log(this.responseText);
                //alert("updated!");
                window.location.reload();
                
            };
            
            //get the form data
            let image = document.getElementById("image-file").files[0];  // file from input
            let formData = new FormData();
            formData.append("image", image);   
            let postData = {};
            postData["name"] = document.getElementById("vName").value;
            postData["bio"] = document.getElementById("vBio").value;
            postData["major"] = document.getElementById("vMajor").value;
            postData["classes"] = document.getElementById("vClasses").value;
            postData["phone"] = document.getElementById("vPhone").value;
            postData["instagram"] = document.getElementById("vInstaUsername").value;
            postData["linkedIn"] = document.getElementById("vLinkedinUrl").value;
            postData["email"] = email;
            formData.append("user", JSON.stringify(postData));
            
            xhttp.open("POST", "http://c9.noah.kim/educonnect/editUser/editUser.php", true);
            xhttp.send(formData);
            
        }
        
        // get data from database and display on edit form
        function getData(){
            var xhttp = new XMLHttpRequest();
            
            xhttp.onload = function() {
                var data  = JSON.parse(this.responseText);
                document.getElementById("vName").value = data["name"];
                document.getElementById("vBio").value = data["bio"];
                document.getElementById("vMajor").value = data["major"];
                document.getElementById("vClasses").value = data["classes"];
                document.getElementById("vPhone").value = data["phone_number"];
                document.getElementById("vInstaUsername").value = data["instagram_username"];
                document.getElementById("vLinkedinUrl").value = data["linkedin_url"];
                document.getElementById("vProfileImage").src = data["img_url"];
                
            };
            xhttp.open("POST", "http://c9.noah.kim/educonnect/calls/getUserData.php", true);
            xhttp.send(JSON.stringify(email));
        }
        
        getData();
        
    </script>
</html>