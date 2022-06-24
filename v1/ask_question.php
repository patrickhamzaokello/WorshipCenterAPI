<?php
//getting the database connection
include_once '../Includes/config/Database.php';

$database = new Database();
$conn = $database->getConnection();

//an array to display response
$response = array();
//if it is an api call
//that means a get parameter named api call is set in the URL 
//and with this parameter we are concluding that it is an api call 
if (isset($_GET['apicall'])) {

    switch ($_GET['apicall']) {

        case 'askquestion':

            //for login we need the username and password
            if (isTheseParametersAvailable(array('name', 'question'))) {
                //getting values
                $username = $_POST['name'];
                $question = $_POST['question'];


                //if user is new creating an insert query
                $stmt = $conn->prepare("INSERT INTO question (name,question) VALUES (?, ?)");
                $stmt->bind_param("ss", $username,$question);

                //if the user is successfully added to the database
                if ($stmt->execute()) {

                    $stmt->close();

                    //adding the user data in response
                    $response['error'] = false;
                    $response['message'] = 'Question Sent successfully';
                }

            }
            break;

        default:
            $response['error'] = true;
            $response['message'] = 'Invalid Operation Called';
    }
} else {
    //if it is not api call
    //pushing appropriate values to response array
    $response['error'] = true;
    $response['message'] = 'Invalid API Call';
}

//displaying the response in json structure 
echo json_encode($response);

//function validating all the paramters are available
//we will pass the required parameters to this function 
function isTheseParametersAvailable($params)
{

    //traversing through all the parameters
    foreach ($params as $param) {
        //if the paramter is not available
        if (!isset($_POST[$param])) {
            //return false
            return false;
        }
    }
    //return true if every param is available
    return true;
}

