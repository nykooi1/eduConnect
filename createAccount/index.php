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
        </style>
    </head>
    <body>
        
        <!-- Navbar -->
        <div class="navbar fixed-top"><img class="logo" href="http://c9.noah.kim/educonnect" src="http://c9.noah.kim/educonnect/content/images/educlogo.jpg">EduConnect<i class="fas fa-user-circle"></i></div>
        <div class="navbar-spacer"></div>
        
        <div class="vContainer">
            
            <!-- Create an Account Header -->
            <h1>
                Create an Account!
            </h1>
            
            <!-- Create an Account form -->
            <form onsubmit="event.preventDefault(); vCreate()">
                <input id="vName" placeholder="Name" style="margin-top: 10px; width:250px;" required/><br>
                <input id="vEmail" type="Email" placeholder=".edu email" style="margin-top: 10px; width:250px;" required/><br>
                <input id="vPassword" placeholder="Password" style="margin-top: 10px; width:250px;" required/><br>
                <textarea id="vBio" placeholder="Bio" style="margin-top: 10px; padding:10px; width:250px;"></textarea><br>
                <textarea id="vClasses" placeholder="Classes" style="margin-top: 10px; padding:10px; width:250px;"></textarea><br>
                <input id="vMajor" placeholder="Major" style="margin-top: 10px; width:250px;" required/><br>
                <input id="vPhone" type="tel" placeholder="Phone Number" style="margin-top: 10px; width:250px;"/><br>
                <input id="vInstaUsername" placeholder="Instagram username" style="margin-top: 10px; width:250px;"/><br>
                <input id="vLinkedinUrl" placeholder="LinkedIn URL" style="margin-top: 10px; width:250px;"/><br>
                <button class="vButton" style="margin-top:10px;" value="Login">Create Account</button>
            </form>
        </div>
        
    </body>
    <script>
        //send the email address to the login.php script, attempt to login
        function vCreate(){
            
            var xhttp = new XMLHttpRequest();
            
            xhttp.onload = function() {
                //if(this.responseText == ){
                    window.location.href = "http://c9.noah.kim/educonnect/login";
                //}
            };
            
            //get the form data
            var postData = {};
            postData["email"] = document.getElementById("vEmail").value;
            postData["password"] = document.getElementById("vPassword").value;
            postData["name"] = document.getElementById("vName").value;
            postData["bio"] = document.getElementById("vBio").value;
            postData["major"] = document.getElementById("vMajor").value;
            postData["classes"] = document.getElementById("vClasses").value;
            postData["phone"] = document.getElementById("vPhone").value;
            postData["instagram"] = document.getElementById("vInstaUsername").value;
            postData["linkedIn"] = document.getElementById("vLinkedinUrl").value;
            
            xhttp.open("POST", "http://c9.noah.kim/educonnect/createAccount/createAccount.php", true);
            xhttp.send(JSON.stringify(postData));
            
        }
    </script>
</html>