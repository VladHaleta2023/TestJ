<?php 
    try {
        include 'connect.php';

        if (isset($_POST["searchText"]))
            $searchText = $_POST["searchText"];

        // file_get_contents($folderSQL . "getTable.sql")
        $result['table'] = [];
        $table = $conn->query("select * from `tablej` where Country like '" . $searchText ."%' order by Country ASC");
        $json = array();
        $index = 0;

        while ($row = mysqli_fetch_assoc($table)) {
            $json['id'] = $row['id'];
            $json['Country'] = $row['Country'];
            $json['Capital'] = $row['Capital'];
            $json['Ruler'] = $row['Ruler'];
            $json['Population'] = $row['Population'];

            $json['Image Country'] = base64_encode($row['Image Country']);
            $json['Image Ruler'] = base64_encode($row['Image Ruler']);
            $json['Image Capital'] = base64_encode($row['Image Capital']);

            $json['Area'] = $row['Area'];
            $json['Religion'] = $row['Religion'];
            $json['Continent'] = $row['Continent'];
            $json['Short History'] = $row['Short History'];
            $json['GMT'] = $row['GMT'];
            $json['Currency'] = $row['Currency'];

            $result['table'][] = $json;
        }

        $result['status'] = true;
        $result['Exception'] = "None";

        $conn->close();
    }
    catch (Exception $e) {
        $result['table'] = [];
        $result['Exception'] = $e;
        $result['status'] = false;
    }
    finally {
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
    }
?>