<!DOCTYPE html>

<!-- Git commands
    //* cd /Users/domiadmin/.bitnami/stackman/machines/xampp/volumes/root/htdocs/myapp
    //* git pull https://github.com/wdomi/MyApp.git
    //* git push --set-upstream https://github.com/wdomi/MyApp.git master
    cd /Users/domiadmin/.bitnami/stackman/machines/xampp/volumes/root/etc
    git pull https://github.com/wdomi/XAMPP_configFiles.git
    git push --set-upstream https://github.com/wdomi/XAMPP_configFiles.git master 
-->

<!--    //* other needed files are in folders: 
        //* php files       ==>  folder  "php"
        //* css files       ==>  folder  "css"
        //* database files  ==>  folder  "config"
-->

<html lang="en">

    <head>
        <meta charset="UTF-8">

        <title>Ibex Database</title>

        <!-- //_ ---------- Upload files (CSS, JavaScript, PHP,...) ---------- -->
        <script type="text/javascript" src="d3.min.js"></script> <!-- <script src="http://d3js.org/d3.v3.min.js" language="JavaScript"></script> -->
        <link   rel="stylesheet" type="text/css" href="css/style.css"></link>

    </head>

    <body>

        <h1> Overview Ibex Database </h1>

        <p> Here you can see some extracts of the <em>Ibex Database</em>. <br> <strong>New!</strong> Now there is data.
        </p>

        <hr> <!-- --------------- TABLES INDIVIDUALS ----------------------- -->
        
        <p1> Extract of <em>individuals</em> table: <br>
            <?php 
            include 'php/db_show_tab_indiv.php'; 
            ?>
            <br>
            Extract of <strong>removed</strong> records in the <em>individuals</em> table: <br>
            <?php 
            include 'php/db_show_tab_indivDEL.php'; 
            ?>
        </p1>

        <br>

        
        <hr> <!-- --------------- SVG VISUAL ----------------------- -->

        <p2> This is a SVG vector graphic visual
        </p2>
        <br>
    
        <svg width="720" height="120">
            <circle cx="40" cy="60" r="10"></circle>
            <circle cx="80" cy="60" r="10"></circle>
            <circle cx="120" cy="60" r="10"></circle>
        </svg>

        <script language="JavaScript">
            var circle = d3.selectAll("circle");
            circle.style("fill", "steelblue");
            circle.attr("r", 30);
            circle.attr("cx", function() {
                return Math.random() * 720;
            });
        </script>
    
        <hr> <!-- --------------- this is a line ----------------------- -->
        <br>
        <?php
            $birthyear = 5;
            echo "2018 - $birthyear";
        ?>



        <?php 
        include 'php/element_footer.php';
        ?>

    </body>

</html>