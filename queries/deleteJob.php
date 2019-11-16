<?php

include("./jobQueries.php");

$requestInformationJSON = file_get_contents('php://input');
$requestInformation = json_decode($requestInformationJSON, true);
$requestErrors;

if (!isset($requestInformation['functionName'])) {
    $requestErrors['error'] = 'No function name!';
    var_dump($requestErrors);
}

if (!isset($requestInformation['arguments'])) {
    $requestErrors['error'] = 'No function arguments!';
    var_dump($requestErrors);
}

if (!isset($requestErrors['error'])) {

    switch ($requestInformation['functionName']) {
        case 'deleteJob':
            if (!is_int($requestInformation['arguments'])) {
                $requestErrors['error'] = 'Error in arguments!';
                var_dump($requestErrors);
            } else {
                deleteJob($requestInformation['arguments']);
            }
            break;
        default:
            $requestErrors['error'] = 'Not found function ' . $requestInformation['functionName'] . '!';
            var_dump($requestErrors);
            break;
    }
} else {
    var_dump($requestErrors);
}
