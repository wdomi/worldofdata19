<!DOCTYPE html>
<html>

    <?php
        //* connection to DB
        include('conf/config.php');
        $php_self = $_SERVER['PHP_SELF']; //This is the filename of the currently executing script, relative to the document root providing path information.

        //? message for removed record
        if ($_GET['del_id']){
            $did=$_GET['del_id'];
            $d_sql_indiv = "SELECT * FROM individual WHERE id=:del_id";
            $d_select_indiv = $conn->prepare($d_sql_indiv);
            $d_select_indiv->execute(['del_id' => $did]);
            $d_indiv = $d_select_indiv->fetch();
            $d_id = $d_indiv['id'];
            $d_name = $d_indiv['name'];

            $remove = "UPDATE individual SET deleted = 1 WHERE id=:id";
            $remove_indiv = $conn->prepare($remove);
            $remove_indiv->execute(['id' => $did]);
            echo "<em>$d_name (ID $d_id) has been removed!</em><br><br>";
        }

        //* Show all records
        // Define & Execute query, fetch data from DB for all table rows
        $d_sql = 'SELECT individual.id, individual.name as iname, individual.sex, individual.birthyear, individual.age, population.name as pname, individual.deleted
                FROM individual
                LEFT JOIN population ON individual.id_population = population.id 
                WHERE individual.deleted=0
                LIMIT 15';
        $d_query = $conn->prepare($d_sql);
        $d_query->execute();

        //Error message MySQL 
        if ( $d_query->errorCode() > 0 ){
            $d_fehler=$d_query->errorInfo();
            echo "$d_fehler[2]";
            exit;
        }


        //* Heading of table, plot data
        echo "Extract of individuals table: <br>";
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

        while($row=$d_query->fetch()){
        $d_id		= $row['id'];
        $d_name     = $row['iname'];
        $d_sex      = $row['sex'];
        $d_year     = $row['birthyear'];
        $d_age      = date("Y") - $d_year;
        $d_pop      = $row['pname'];
        $d_del      = $row['deleted'];
        echo "<tr>
                <td>$d_id</td>
                <td>$d_name</td>
                <td>$d_sex</td>
                <td>$d_year</td>
                <td>$d_age</td>
                <td>$d_pop</td>
                <td>$d_del</td>
                <td>
                    <a href='$php_self?del_id=$d_id'> remove </a>
                </td>
                </tr>";
        }	
        echo "</table><br>";	
    ?>

</html>