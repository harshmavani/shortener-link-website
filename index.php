<?php 
session_start(); 
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'admin_panel');

/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check connection
if($link === false){    
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

if(isset($_POST['submit_link'])){

    $Product_Link = $_POST['Product_Link'];
    $rand = date('ymdhs');
    $insertqurey =" INSERT INTO shortaner_data (link,uniq_ext) VALUES ('$Product_Link','$rand') ";

    
    if ($_POST['Product_Link'] == "") {
        $_SESSION['empty_error'] = "Please Enter Link";
        $sql = "SELECT * FROM shortaner_data WHERE link ='".$_POST['Product_Link'].$_POST['array_product(array)']."'";
        header("Location:index");
        exit();
    }else{
        if (mysqli_query($link, $insertqurey)) {

            $sql = "SELECT * FROM shortaner_data WHERE link ='".$_POST['Product_Link']."'";
            $query = mysqli_query($link,$sql);
            if (!$query){
                die('Invalid query: '.mysqli_error($link));
            }
            $row=mysqli_fetch_assoc($query);    

            $_SESSION['link']= "maft.ml/s/".$rand;
            $_SESSION['copy_button']  = "<button type='button' class='btn' onclick='copyfunction(); myFunction2();'>Copy</button>";
            $_SESSION['success_message'] = "Link Generated Successfully";
            header("Location:index");
            exit(); 
        } else {           
            $_SESSION['error_message'] = mysqli_error($link);
            header("Location:index");
            exit();
        }
    }


}    

?>  

<!DOCTYPE html>
<html lang="en-us">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="utf-8">
    <title>URL Shortener</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style type="text/css">

    body{margin:0;background:#f5f2f2;font:14px arial,tahoma}h1{margin:0 0 -10px 0;font:bold 36px asap,arial;color:#505050;letter-spacing:-1px}h2{margin:0 0 -10px 0;font:bold 26px asap,arial;color:#505050;letter-spacing:0}h3{margin:0 0 -10px 0;font:bold 20px asap,arial;color:#505050;letter-spacing:0}p{font:16px "source sans pro",arial;color:#484848;line-height:1.5;text-align:left}a{color:#006cff;text-decoration:none}a:hover{text-decoration:underline}b{opacity:.95}ul{font:16px "source sans pro",arial;color:#484848;line-height:1.5;text-align:left;list-style:none;margin:0;padding:0}li{font:16px "source sans pro",arial;color:#484848;line-height:1.5;text-align:left}img{max-width:100%;height:auto;vertical-align:middle}br{clear:both}.h5{clear:both;display:block;content:"";height:5px}.h10{clear:both;display:block;content:"";height:10px}.h15{clear:both;display:block;content:"";height:15px}.h20{clear:both;display:block;content:"";height:20px}input[type=text],textarea{vertical-align:middle;border-radius:3px;border:1px solid #dfdfdf;color:#444}input[type=submit]{font:16px arial,tahoma;height:36px;vertical-align:middle}.logo{font:bold 40px arial,tahoma;color:#222;word-wrap:break-word}.textsmall{font-size:13px;color:#999}.textmedium{font-size:14px}.textbig{font-size:15px}.alignleft{text-align:left}.aligncenter{text-align:center}.alignright{text-align:right}.alignmiddle{vertical-align:middle}.colorbutton{display:inline-block;background:#2c87c5;font:bold 17px lato,arial;color:#fff;padding:16px 26px;border:0;border-radius:3px;text-decoration:none;margin:0 0 5px 0}.list{line-height:1.5;background:url(img/icon-tick.png) no-repeat left;padding:0 0 0 35px}.colorbutton:hover{text-decoration:none}header{text-align:center}header #top{background:#fff;box-shadow:0 1px 4px #ccc}header #logo{padding:40px 20px 25px}header a.logo{font:900 49px asap,arial;color:#c52c2c;letter-spacing:-1px;text-shadow:0 2px 2px #ddd;word-wrap:break-word}header a.logo:hover{text-decoration:none}header a .logoext{font-size:31px}nav ul{list-style:none;margin:0;padding:0 20px;background:#444}nav ul li{display:inline-block;padding:16px 20px}nav ul li a{color:#fff}main{display:block;margin:0 auto 0 auto;padding:0 20px;max-width:1000px}section#urlbox{margin:0 auto 20px auto;max-width:758px;box-shadow:0 1px 4px #ccc;border-radius:2px;padding:10px 30px 5px;background:#fff;text-align:center}section#urlbox h1{margin:25px auto 30px auto}section .boxtextcenter{margin:10px auto 20px;text-align:center;max-width:620px}section .boxtextleft{padding:0 50px;word-wrap:break-word}section#content{max-width:720px;margin:30px auto 20px}section .squarebox{display:inline-block;background:#fff;padding:15px 20px;border-radius:3px;font:55px lato,arial;color:#444}#formurl{display:table;max-width:600px;margin:0 auto}#formurl input[type=text]{display:table-cell;width:100%;height:56px;padding:10px 16px;font:17px lato,arial;color:#000;background:#fff;border:1px solid #bbb;border-right:0;border-radius:3px;border-bottom-right-radius:0;border-top-right-radius:0;box-sizing:border-box}#formurl #formbutton{display:table-cell;width:1%;box-sizing:border-box;vertical-align:middle}#formurl input[type=button],#formurl input[type=submit]{height:56px;padding:10px 16px;font:bold 17px lato,arial;color:#fff;background-color:#c52c2c;text-align:center;vertical-align:middle;cursor:pointer;white-space:nowrap;border:0;border-radius:3px;border-top-left-radius:0;border-bottom-left-radius:0;margin-left:-1px;-webkit-appearance:button;margin:0}#balloon{background:#333;font:13px asap,arial;color:#fff;padding:8px;text-align:center;border-radius:3px;white-space:nowrap;float:right;margin:4px 0}section#emailbox{margin:0 auto 20px auto;max-width:758px;box-shadow:0 1px 4px #ccc;border-radius:2px;padding:10px 30px 5px;background:#fff;text-align:center}section#emailbox h2{margin:15px auto 20px auto}#formemail{display:table;max-width:400px;margin:0 auto}#formemail input[type=email]{display:table-cell;width:100%;height:56px;padding:10px 16px;font:17px lato,arial;color:#000;background:#fff;border:1px solid #bbb;border-right:0;border-radius:3px;border-bottom-right-radius:0;border-top-right-radius:0;box-sizing:border-box}#formemail #formbutton{display:table-cell;width:1%;box-sizing:border-box;vertical-align:middle}#formemail input[type=button],#formemail input[type=submit]{height:56px;padding:10px 16px;font:bold 17px lato,arial;color:#fff;background-color:#2c87c5;text-align:center;vertical-align:middle;cursor:pointer;white-space:nowrap;border:0;border-radius:3px;border-top-left-radius:0;border-bottom-left-radius:0;margin-left:-1px;-webkit-appearance:button;margin:0}footer{text-align:center;font:16px asap,arial,tahoma;color:#eee;background:#541717;width:100%;border-top:5px solid #c52c2c;padding:20px 0 100px;line-height:1.5}footer #footerbox{padding:0 10px}footer ul{display:inline-block;list-style:none}footer ul li{display:inline;padding:4px}footer ul li a{color:#0089ff}html{position:relative;min-height:100%}body{margin-bottom:200px}footer{position:absolute;bottom:0;height:40px}@media all and (max-width:499px){main{padding:0 10px}section .boxtextleft{padding:0 10px;word-wrap:break-word}}#formbox{max-width:400px;margin:20px 0;padding:10px 40px 10px 20px;font:17px lato,arial;color:#222;background-color:#fff;text-align:left;border-radius:6px;box-shadow:0 1px 4px #ccc}input[type=email],input[type=text],textarea{font:16px lato,arial;padding:8px;vertical-align:middle;border-radius:1px;border:1px solid #b6b6b6;box-shadow:inset 0 1px 2px rgba(0,0,0,.1),0 -1px 1px #fff,0 1px 0 #fff}input[name=submit]{height:36px;padding:0 16px;font:normal 16px lato,arial;color:#fff;background-color:#2c87c5;text-align:center;vertical-align:middle;cursor:pointer;white-space:nowrap;border:0;border-radius:3px}#button{text-align:right}.formtext{font:18px lato,arial;color:#222}*{box-sizing:border-box;-webkit-box-sizing:border-box;-moz-box-sizing:border-box}#row:after{display:table;content:"";clear:both}#column{float:left;width:33.33%;min-height:210px;padding:0 10px;text-align:center}.socialnetworkbox{display:block;margin:2px}.snb{padding:8px 10px;margin:0 1px 0 0;font:14px lato,arial;color:#fff;text-align:center;background-color:#3b5998;cursor:pointer;border-radius:2px;display:inline-block;margin-bottom:4px}.snb:hover{text-decoration:none}.snbfacebook{background:#3b5998}.snbtwitter{background:#55acee}.snbpinterest{background:#d4374f}.snbtumblr{background:#243a4f}.snbwhatsapp{background:#16b75b}.mg_addad948616 a img{display:none!important}.mctitle a{font-weight:700!important;font-family:roboto,sans-serif!important;line-height:18px!important}div.mcimg{max-height:205px!important;margin-bottom:5px!important}div.mg_addad1059121 img{display:none!important}.mcdomain a{display:none!important}@media all and (min-width:768px){.snbwhatsapp{display:none}}#adbox{height:auto;margin:10px auto 15px;text-align:center}#adbox300x50{width:300px;height:auto;margin:20px auto;text-align:center}#adbox160x600{width:160px;height:auto;margin:20px auto;text-align:center}#adbox300x250{width:300px;height:auto;margin:20px auto;text-align:center}#adbox300x600{width:300px;height:auto;margin:20px auto;text-align:center}#adbox728x90{width:728px;height:auto;margin:20px auto;text-align:center}.inarticle{margin:0 auto 20px auto;max-width:720px}@media all and (max-width:499px){.ad{width:320px;height:100px}}@media all and (min-width:500px) and (max-width:769px){.ad{width:468px;height:60px}}@media all and (min-width:770px) and (max-width:999px){.ad{width:728px;height:90px}}@media all and (min-width:1000px){.ad{width:970px;height:90px}}</style>
    <style type="text/css"> 
        .btn{
            height: 56px;
            padding: 10px 16px;
            font: bold 17px lato,arial;
            color: #fff;
            background-color: #c52c2c;
            text-align: center;
            vertical-align: middle;
            cursor: pointer;
            white-space: nowrap;
            border: 0;
            border-radius: 3px;
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
            margin-left: -1px;
            -webkit-appearance: button;
            margin: 0;
        } 
        .input{
            display: table-cell;
            width: 40%;
            height: 56px;
            padding: 10px 16px;
            font: 17px lato,arial;
            color: #000;
            background: #fff;
            border: 1px solid #bbb;
            border-right: 0;
            border-radius: 3px;
            border-bottom-right-radius: 0;
            border-top-right-radius: 0;
            box-sizing: border-box;
        }

        select{
            border: 1px solid #d1d3e2;
            border-radius: 5px;
        }
        select:focus{
            outline: none;
        }
        .modal input{
            height: 43px;
        }


        #snackbar {
            visibility: hidden;
            min-width: 250px;
            margin-left: -125px;
            background-color: #333;
            color: #fff;
            text-align: center;
            border-radius: 2px;
            padding: 16px;
            position: fixed;
            z-index: 1;
            left: 50%;
            bottom: 30px;
            font-size: 17px;
        }

        #snackbar.show {
            visibility: visible;
            -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
            animation: fadein 0.5s, fadeout 0.5s 2.5s;
        }
        #snackbar2 {
            visibility: hidden;
            min-width: 250px;
            margin-left: -125px;
            background-color: #333;
            color: #fff;
            text-align: center;
            border-radius: 2px;
            padding: 16px;
            position: fixed;
            z-index: 1;
            left: 50%;
            bottom: 30px;
            font-size: 17px;
        }

        #snackbar2.show {
            visibility: visible;
            -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
            animation: fadein 0.5s, fadeout 0.5s 2.5s;
        }
        @-webkit-keyframes fadein {
            from {bottom: 0; opacity: 0;} 
            to {bottom: 30px; opacity: 1;}
        }

        @keyframes fadein {
            from {bottom: 0; opacity: 0;}
            to {bottom: 30px; opacity: 1;}
        }

        @-webkit-keyframes fadeout {
            from {bottom: 30px; opacity: 1;} 
            to {bottom: 0; opacity: 0;}
        }

        @keyframes fadeout {
            from {bottom: 30px; opacity: 1;}
            to {bottom: 0; opacity: 0;}
        }
    </style>
    <link rel="shortcut icon" href="favicon.png">
    <meta property="og:title" content="ShortURL - URL Shortener">
    <meta property="og:type" content="website">
</head>
<body id="page-top" onload="myFunction();">
    <?php
    if (isset($_SESSION['empty_error'])) {
        echo "<div id='snackbar' style='background-color:red!important'>".$_SESSION['empty_error']."</div>";
        unset($_SESSION['empty_error']);
    } 

    if (isset($_SESSION['success_message'])) {
        echo "<div id='snackbar' style='background-color:green!important';>".$_SESSION['success_message']."</div>";
        unset($_SESSION['success_message']);
    } 

    if (isset($_SESSION['error_message'])) {
        echo "<div id='snackbar' style='background-color:red!important';>".$_SESSION['error_message']."</div>";
        unset($_SESSION['error_message']);
    }
    ?>
    <header>
        <div id="logo"><a href="index" class="logo">maft URL</a></div>
    </header>
    <main>
        <section id="urlbox">
            <h1>Paste the URL to be shortened</h1>
            <form method="post">
                <div id="formurl">
                    <input type="text" name="Product_Link" placeholder="Enter the link here">
                    <div id="formbutton">
                        <input type="submit" value="Shorten URL" name="submit_link" id="submit_link">
                    </div>
                </div>
                <div class="form-group" style="padding: 20px">
                    <label style="font-size: 20px;">Generated Link:</label>
                    <input type="text" class="input" value="<?php if(isset($_SESSION['link'])){ echo $_SESSION['link'];} ?>" id="myInput" readonly> <?php if(isset($_SESSION['link'])) {
                        echo $_SESSION['copy_button'];
                        unset($_SESSION['copy_button']);
                        unset($_SESSION['link']);
                    } ?>
                    <div id='snackbar2' style='background-color:green!important'></div>
                </div>
            </form>
        </section>
        <section id="urlbox">
            <div id="box">
                <div id="row">
                    <div id="column">
                        <div class="icon"><img src="img/icon-like.png"></div>
                        <h3 class="aligncenter">Easy</h3>
                        <p class="aligncenter">ShortURL is easy and fast, enter the long link to get your shortened link</p>
                    </div>

                    <div id="column">
                        <div class="icon"><img src="img/icon-unique.png"></div>
                        <h3 class="aligncenter">Reliable</h3>
                        <p class="aligncenter">All links that try to disseminate spam, viruses and malware are deleted</p>
                    </div>
                    <div id="column">
                        <div class="icon"><img src="img/icon-responsive.png"></div>
                        <h3 class="aligncenter">Devices</h3>
                        <p class="aligncenter">Compatible with smartphones, tablets and desktop</p>
                    </div>
                </div>
            </div>
        </section>
                    
        </main>
        <footer>
            <div id="footerbox">
                <div>© 2020 maft.ml</div>

            </div>
        </footer>
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-31391210-44" type="640451ef45f43cfa8da3d08b-text/javascript"></script>
        <script type="640451ef45f43cfa8da3d08b-text/javascript">
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'UA-31391210-44');
        </script>
        <script data-cfasync="false" async src="sw.js"></script>
        <script src="../ajax.cloudflare.com/cdn-cgi/scripts/7089c43e/cloudflare-static/rocket-loader.min.js" data-cf-settings="640451ef45f43cfa8da3d08b-|49" defer=""></script>
        <script>

            function myFunction() {
                var x = document.getElementById("snackbar");
                x.className = "show";
                setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
            }

            function myFunction2() {
                var x = document.getElementById("snackbar2");
                x.className = "show";
                setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
            }

        </script>

        <script>
            function copyfunction() {
                var copyText = document.getElementById("myInput");
                copyText.select();
                copyText.setSelectionRange(0, 99999)
                document.execCommand("copy");
                document.getElementById("snackbar2").innerHTML ="Copied : "+copyText.value;
            }
        </script>
    </body>

    </html>