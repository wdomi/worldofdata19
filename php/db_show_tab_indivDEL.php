<!DOCTYPE html>
<html>

    <?php
        //* connection to DB   
        include('conf/config.php');
        $php_self = $_SERVER['PHP_SELF']; //This is the filename of the currently executing script, relative to the document root providing path information.

        //? message for restored record
        if ($_GET['res_id']){
            $rid=$_GET['res_id'];
            $r_sql_indiv = "SELECT * FROM individual WHERE id=:res_id";
            $r_select_indiv = $conn->prepare($r_sql_indiv);
            $r_select_indiv->execute(['res_id' => $rid]);
            $r_indiv = $r_select_indiv->fetch();
            $r_id = $r_indiv['id'];
            $r_name = $r_indiv['name'];

            $restore = "UPDATE individual SET deleted = 0 WHERE id=:id";
            $restore_indiv = $conn->prepare($restore);
            $restore_indiv->execute(['id' => $rid]);
            echo "<em>$r_name (ID $r_id) has been restored.</em><br><br>";
        }        

        //* Show all records
        // Define & Execute query, fetch data from DB for all table rows
        $r_sql = 'SELECT individual.id, individual.name as iname, individual.sex, individual.birthyear, individual.age, population.name as pname, individual.deleted
            FROM individual
            LEFT JOIN population ON individual.id_population = population.id 
            WHERE individual.deleted=1
            LIMIT 15';	
        $r_query = $conn->prepare($r_sql);
        $r_query->execute();

        //Error message MySQL 
        if ( $r_query->errorCode() > 0 ){
            $r_fehler=$r_query->errorInfo();
            echo "$r_fehler[2]";
            exit;
        }
    
        //* Heading of table, plot data 
        echo "Extract of <strong>removed</strong> records in the individuals table: <br>";  
        echo "<table border='1'>	
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Sex</th>
            <th>Year of birth</th>
            <th>Age</th>
            <th>Population</th>
            <th>Deleted</th>
            <th>Edit</th>
        </tr>";

        while($row=$r_query->fetch()){
        $r_id		= $row['id'];
        $r_name     = $row['iname'];
        $r_sex      = $row['sex'];
        $r_year     = $row['birthyear'];
        $r_age      = date("Y") - $r_year;
        $r_pop      = $row['pname'];
        $r_del      = $row['deleted'];

        echo "<tr>
                <td>$r_id</td>
                <td>$r_name</td>
                <td>$r_sex</td>
                <td>$r_year</td>
                <td>$r_age</td>
                <td>$r_pop</td>
                <td>$r_del</td>
                <td>
                    <a href='$php_self?res_id=$r_id'> restore</a> 
                </td>
                </tr>";
        }	
        echo "</table><br>";	
    ?>

    <a href="populations.php">See populations table</a><br>
    <a href="samples.php">See samples table</a><br>
</html>