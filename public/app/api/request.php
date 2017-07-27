<?php

//fetch all building records
$app->get('/api/building/', function () {

    //echo "i love food";

    require_once('config.php');

    $query = "Select * from building";

    $result = $mysqli->query($query);

    while ($row = $result->fetch_assoc()) {

        $data[] = $row;
    }

    if (isset($data)) {

        header('Content-Type: application/json');

        echo json_encode($data);

    }


});


//display single building record

$app->get('/api/building/{id}', function ($request) {

    require_once('config.php');
    $id = $request->getAttribute('id');

    //echo"The id is ".$id;

    $query = "select * from building where Building_ID=$id";

    $result = $mysqli->query($query);

    while ($row = $result->fetch_assoc()) {

        $data[] = $row;
    }

    if (isset($data)) {

        header('Content-Type: application/json');

        echo json_encode($data);

    } else {


        echo "Building does not exist";


    }


});

//get post data and insert a new record

$app->post('/building/add', function ($request) {

    require_once('config.php');

    $query = "INSERT INTO `building` ( `Name`, `Units`, `Location`, `Description`, `Care_Taker`, `Care_taker_Contact`) VALUES (?, ?, ?, ?, ?, ?);";
    //get post data
    $name = $request->getParsedBody()['name'];
    $units = $request->getParsedBody()['units'];
    $location = $request->getParsedBody()['location'];
    $desc = $request->getParsedBody()['desc'];
    $ct = $request->getParsedBody()['ct'];
    $ctno = $request->getParsedBody()['ctno'];


    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("ssssss", $name, $units, $location, $desc, $ct, $ctno);
    $stmt->execute();

    echo "Success!!";


});


//update database records

$app->put('/api/building/{id}', function ($request) {

    require_once('config.php');

    $get_id = $request->getAttribute('id');
    $name = $request->getParsedBody()['name'];
    // echo $name;
    //echo $get_id;

    $query = "UPDATE `building` SET `Name` = ? WHERE `building`.`Building_ID` = $get_id;";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("s", $name);
    $stmt->execute();

    echo "Done!!";


});

$app->delete('/api/building/delete',function(&request){


});


