<?php
require_once 'vendor/autoload.php';
use Neoxygen\NeoClient\ClientBuilder;

$host = 'localhost';
$port = 7474;
$dbUsername = 'neo4j';
$dbPassword = 'jaihanuman';

$client = ClientBuilder::create()
    ->addConnection('default', 'http', $host, $port, true, $dbUsername, $dbPassword)
    ->setAutoFormatResponse(true)
    ->setDefaultTimeout(20)
    ->build();

if (isset($_POST['stopname'])) {
    $stopName = $_POST['stopname'];
    $selectBusDetail = 'match(s1:Stop)-[r]-() where s1.name="' . $stopName . '" return distinct(r.BusName) AS bus';
    $response = array();

    try {
        $client->sendCypherQuery($selectBusDetail);
        $result = $client->getRows();
        $name = array();
        if (!count($result) > 0) {
            showJson(0, "No Rows to Display");
        }
        for ($i = 0; $i < count($result['bus']); $i++) {
            $name[$i] = $result['bus'][$i];
        }
        $response['status'] = 1;
        $response['list'] = $name;
        echo json_encode($response);
        die();

    } catch (Exception $e) {
        showJson(0, "Error:" . $e->getMessage());
    }
}


function showJson($status, $message)
{
    $response = array();
    $response['status'] = $status;
    $response['message'] = $message;
    echo json_encode($response);
    die();
}

?>

<form action="stopdetails.php" method="post">
    <fieldset>
        <legend>Stop Details</legend>
        <label for="stopname">Stop Name</label><br><input type="text" name="stopname" maxlength="100"><br><br>
        <input type="Submit" name="submit" value="Submit">
    </fieldset>
</form>
