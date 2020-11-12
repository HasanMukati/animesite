<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title><?php echo $title; ?></title>
        <link rel="stylesheet" type="text/css" href="Styles/Stylesheet.css" />
    </head>
    <body>
        <div id="wrapper">
            <div id="banner">             
            </div>
            
            <nav id="navigation">
                <ul id="nav">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="#">Browse Anime</a></li>
                    <li><a href="#">Profile</a></li>
                    <li><a href="register.php">Login</a></li>
                </ul>
            </nav>
            
            <div id="content_area">
                <?php echo $content; ?>
            </div>
           
           <?php /* 
            <div id="sidebar">
                
            </div>
           */ ?> 
            <footer>
                <p>WEEB NATION. All rights reserved 2020</p>
            </footer>
        </div>
    </body>
</html>
