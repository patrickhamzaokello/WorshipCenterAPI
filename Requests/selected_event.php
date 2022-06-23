<?php
// http://localhost/projects/KakebeAPI/Requests/category/sectionedCategory.php?page=2


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include_once '../Includes/config/Database.php';
include_once '../Includes/TableClasses/Event.php';
include_once '../Includes/TableClasses/Sermon.php';
include_once '../Includes/TableClasses/Slider.php';
include_once '../Includes/TableClasses/User.php';
include_once '../Includes/TableClasses/News.php';
include_once '../Includes/TableFunctions/EventPage.php';

$database = new Database();
$db = $database->getConnection();


$cat_page = (isset($_GET['page']) && $_GET['page']) ? $_GET['page'] : '1';
$category = new EventPage($db,$cat_page);


$result = $category->selectedEvent();

if($result){
    http_response_code(200);
    echo json_encode($result);
}else{
    http_response_code(404);
    echo json_encode(
        array("message" => "No item found.")
    );
}
?>
