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
        <div class="navbar fixed-top"><img class="logo" src="http://c9.noah.kim/educonnect/content/images/educlogo.jpg">EduConnect<i class="fas fa-user-circle"></i></div>
        <div class="navbar-spacer"></div>
        
        <div class="vContainer">
            
            <!-- Login Header -->
            <h1>
                Login
            </h1>
            
            <!-- Login form -->
            <form onsubmit="event.preventDefault(); vLogin()">
                <input id="vEmail" placeholder=".edu email" style="width:250px;"/><br>
                <input id="vPassword" placeholder="password" style="margin-top: 10px; width:250px;"/><br>
                <button class="vButton" style="margin-top:10px" value="Login">Login</button>
            </form>
                
        </div>
        
    </body>
    <script>
        function setCookie(cname, cvalue, exdays) {
          const d = new Date();
          d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
          let expires = "expires="+d.toUTCString();
          document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
        }
        
        //send the email address to the login.php script, attempt to login
        function vLogin(){
            
            var xhttp = new XMLHttpRequest();
            
            //get the form data
            var postData = {};
            postData["email"] = document.getElementById("vEmail").value;
            postData["password"] = document.getElementById("vPassword").value;
            
            xhttp.onload = function() {
                console.log(this.responseText);
                if(this.responseText == "login"){
                    //set the cookie to store the email
                    setCookie("email", postData["email"], 100)
                    //redirect to the homepage
                    window.location.href = "http://c9.noah.kim/educonnect/";
                } 
                else if(this.responseText == "incorrect password"){
                    alert("incorrect password");
                }
                else if(this.responseText == "not found"){
                    window.location.href = "http://c9.noah.kim/educonnect/createAccount/";
                }
            };
            
            xhttp.open("POST", "http://c9.noah.kim/educonnect/login/login.php", true);
            xhttp.send(JSON.stringify(postData));
            
        }
    </script>
</html>