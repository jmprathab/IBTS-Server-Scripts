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

if (isset($_POST['userid']) && isset($_POST['password'])) {
    //Variables are set
    $user_id = $_POST['userid'];
    $password = $_POST['password'];

    if (empty($user_id)) {
        showJson(0, "User ID should not be empty");
    }
    if (empty($password)) {
        showJson(0, "Password should not be empty");
    }

    $password = hash("sha256", $password);
    //Checking whether node exists for user_id
    $userIdExists = false;
    $passwordVerified = false;

    $selectUser = 'match(user:User) where id(user)=' . $user_id . ' return user';
    try {
        $result = $client->sendCypherQuery($selectUser)->getResult();
        if ($result->getNodesCount() > 0) {
            $userIdExists = true;
        } else {
            //Tell user to login again in Android App
            showJson(0, "Cannot Verify User\nLogin Again");
        }
    } catch (Exception $e) {
        showJson(0, "Error:" . $e->getMessage());
    }

    if ($userIdExists) {
        //Evaluate Password
        try {
            $selectUser = 'match(user:User) where id(user)=' . $user_id . ' and user.password="' . $password . '" return user';
            $result = $client->sendCypherQuery($selectUser)->getResult();
            if ($result->getNodesCount() > 0) {
                //Password Verified
                $passwordVerified = true;
            } else {
                showJson(0, "Incorrect Password");
            }
        } catch (Exception $e) {
            showJson(0, "Error:" . $e->getMessage());
        }
    }

    if ($passwordVerified) {
        $selectUser = 'match(user:User) where id(user)=' . $user_id . ' and user.password="'.$password.'" return user';
        try {
            $result = $client->sendCypherQuery($selectUser)->getResult();
            if ($result->getNodesCount() > 0) {
                $user = $result->getSingleNode();
                $response = array();
                $response['status'] = 1;
                $response['message'] = "Data Fetched";
                $response['user_id']=$user->getId();
                $response['name']=$user->getProperty("name","-");
                $response['mobile']=$user->getProperty("mobile","-");
                $response['email']=$user->getProperty("email","-");
                $response['balance']=$user->getProperty("balance","0.00");
                $response['address']=$user->getProperty("address","-");
                echo json_encode($response);
                die();
            } else {
                //Tell user to login again in Android App
                showJson(0, "Cannot Fetch details\nTry again");
            }
        } catch (Exception $e) {
            showJson(0, "Error:" . $e->getMessage());
        }

    }

    $response = array();
    $response['status'] = 1;
    $response['message'] = "Something serious happened";
    echo json_encode($response);
    die();
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

<form action="fetchdetails.php" method="post">
    <fieldset>
        <legend>Display User Details</legend>
        <label for="userid">User ID</label><br><input type="text" name="userid" maxlength="40"><br><br>
        <label for="password">Password</label><br><input type="password" name="password" maxlength="40"><br><br>
        <input type="Submit" name="submit" value="Submit">
    </fieldset>
</form>
