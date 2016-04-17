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

if (isset($_POST['userid']) && isset($_POST['email']) && isset($_POST['address']) && isset($_POST['oldpassword']) && isset($_POST['newpassword'])) {
    //Variables are set
    $userId = $_POST['userid'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $oldPassword = $_POST['oldpassword'];
    $newPassword = $_POST['newpassword'];

    $address=ucwords($address);

    $passwordChanged = false;

    if (empty($userId)) {
        showJson(0, "User ID should not be empty");
    }
    if (empty($oldPassword)) {
        showJson(0, "Password should not be empty");
    }
    if (empty($email)) {
        $email = "-";
    }
    if (empty($address)) {
        $address = "-";
    }
    if (!($oldPassword == $newPassword)) {
        $passwordChanged = true;
    }
    $oldPassword = hash("sha256", $oldPassword);
    if (!$passwordChanged) {
        $newPassword = $oldPassword;
    } else {
        $newPassword = hash("sha256", $newPassword);
    }
    //Checking whether node exists for user_id
    $userIdExists = false;
    $passwordVerified = false;

    $selectUser = 'match(user:User) where id(user)=' . $userId . ' return user';
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
            $selectUser = 'match(user:User) where id(user)=' . $userId . ' and user.password="' . $oldPassword . '" return user';
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
        $selectUser = 'match(user:User) where id(user)=' . $userId . ' set user.email="' . $email . '",user.address="' . $address . '",user.password="' . $newPassword . '" return user';
        try {
            $result = $client->sendCypherQuery($selectUser)->getResult();
            if ($result->getNodesCount() > 0) {
                if ($passwordChanged) {
                    //Tell user to login again in Android Application
                    showJson(20, "Details added to Database");
                } else {
                    showJson(1, "Details added to Database");
                }
            } else {
                //Tell user to login again in Android App
                showJson(0, "Cannot Add details\nTry again");
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

<form action="editdetails.php" method="post">
    <fieldset>
        <legend>Edit Details</legend>
        <label for="userid">User ID</label><br><input type="text" name="userid" maxlength="40"><br><br>
        <label for="email">Email</label><br><input type="email" name="email" maxlength="40"><br><br>
        <label for="address">Address</label><br><input type="text" name="address" maxlength="255"><br><br>
        <label for="oldpassword">Old Password</label><br><input type="password" name="oldpassword"
                                                                maxlength="40"><br><br>
        <label for="newpassword">New Password</label><br><input type="password" name="newpassword"
                                                                maxlength="40"><br><br>
        <input type="Submit" name="submit" value="Submit">
    </fieldset>
</form>
