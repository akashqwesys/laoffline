<?php

namespace App\Http\Controllers\settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConnectionController extends Controller
{
    public function index(Request $request) {
        $servername = "localhost";
        $username = "akashs_laoffline123";
        $password = "laoffline123";
        $database = "akashs_laoffline";

        // Create connection
        $conn = mysqli_connect($servername, $username, $password, $database);

        // Check connection
        if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
        }
        echo "Connected successfully";


        $sql = "SELECT * FROM employe";
        $result = mysqli_fetch_assoc($sql, $conn);

        echo "<pre>";
        echo $sql;
        print_r($result);
    }
}
