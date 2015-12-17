<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <link rel="stylesheet" href=".style_loginpage.css">
</head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $(".btn1").click(function(){
            $("login-form").hide();
        });
        $(".btn2").click(function(){
            $("login-form").show();
        });
    });
</script>
<script type="text/javascript">
    function foo() {
        alert("Submit button clicked!");
        return true;
    }//TODO: Tesztfunkció kiszedése
</script>
<script type="text/javascript">
    <!--
    function hide_login(id) {
        var e = document.getElementById(id);
        e.style.display = 'none';
        e.parentNode.removeChild(e);
        return true;
    }
    //-->
</script>
<body>

<div class="container">
   <?php
  session_start();
  ///mindenképpen kiechózza




  include_once(".passwords.php");
  if ($_POST["ac"]=="log") { /// do after login form is submitted
      if ($USERS[$_POST["username"]]==$_POST["password"]) {
              $_SESSION["logged"]=$_POST["username"];
     }
      else {
          echo '<p> <span class="mesg" >Rossz felhasználónév/jelszó, próbáld újra.</span> </p>';
      }
  }
  if (array_key_exists($_SESSION["logged"],$USERS)) {
      echo "Be vagy jelentkezve.";
    // header('Refresh: 5; URL=.index.php');

      echo <<<EOT
     <p class="mesg">Átirányítás <span id="counter">5</span> másodperc múlva.</p>
<script type="text/javascript">
function countdown() {
    var i = document.getElementById('counter');
    if (parseInt(i.innerHTML)==1) {
        location.href = '.index.php';
    }
    i.innerHTML = parseInt(i.innerHTML - 1);
}
setInterval(function(){ countdown(); },700);
</script>



EOT;
      }

       else {
    echo <<<EOT
     <div id="login-form">

        <h3>Bejelentkezés</h3>
        <fieldset>

     <form method="post"><input type="hidden" name="ac" value="log">


<input type="email" name="username" value="Felhasználónév@no.pe.hu" onBlur="if(this.value=='')this.value='Felhasználónév@no.pe.hu'" onFocus="if(this.value=='Felhasználónév@no.pe.hu')this.value='' ">
      <input type="password" name="password" required value="Jelszó" onBlur="if(this.value=='')this.value='Jelszó'" onFocus="if(this.value=='Jelszó')this.value='' ">
      <input type="submit" name="belep" value="Login" action="header("Location: admin_panel.php")" />
      <footer class="clearfix">
      <a href="login.php?register" name="register"  ><span class="info">!</span>regisztráció (nem üzemel)</a>

      </footer>
      </form> 
      </fieldset> 
      </div>

EOT;

  }

if(isset($_GET['register']))
{
    include('sqlconn.php');
echo <<<EOT
        <script language="javascript">
            document.getElementById("login-form").style.display = "none";
        </script>
    <div id="register-form">

        <h3>Regisztráció</h3>
        <fieldset>
      <form method="post"><input type="hidden" name="ac" value="log">
      <input type="text" name="name" value="Milyen néven üdvözölhetünk?" onBlur="if(this.value=='')this.value='Milyen néven üdvözölhetünk?'" onFocus="if(this.value=='Milyen néven üdvözölhetünk?')this.value='' ">
      <input type="email" name="username" required value="Email" onBlur="if(this.value=='')this.value='Email'" onFocus="if(this.value=='Email')this.value='' ">
      <input type="password" name="password" required value="Jelszó" onBlur="if(this.value=='')this.value='Jelszó'" onFocus="if(this.value=='Jelszó')this.value='' ">
      <input type="submit" name="belep" value="Login"  />
      <footer class="clearfix">
    </footer>
      </form>
      </fieldset>
    </div>
EOT;
    If(isset($_REQUEST['belep'])!='')
    {
        If($_REQUEST['name']=='' || $_REQUEST['username']=='' || $_REQUEST['password']=='')
        {
            Echo "please fill the empty field.";
        }
        Else
        {
            $sql="insert into site_users(name,email,password) values('".$_REQUEST['name']."', '".$_REQUEST['email']."', '".$_REQUEST['password']."')";
            $res=mysql_query($sql);
            If($res)
            {
                MainLogger::log(time()."Record successfully inserted @ sqlconn.php, register");
                echo "Record successfully inserted";
                echo <<<EOT
                        <script language="javascript">
                         alert('regisztráció sikeres, jelentkezz be!');
                         //location.href='.login.php';
                        </script>
EOT;
            }
            Else
            {
                MainLogger::log(time()."There is some problem in inserting record @ sqlconn.php, reg");
                Echo "There is some problem in inserting record";
            }

        } //else


  } //isset $_post




    }//isset get register
?>



  </div>
<div id="#codeboxdiv">
    <p class="codebox">

        session_start();
        include(".passwords.php");
        check_logged();

    </p>
</div>

</body>
</html>
