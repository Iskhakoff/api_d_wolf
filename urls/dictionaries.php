<?php
    include "../includes/db.php";

    $requestBody = file_get_contents("php://input");

    $request = json_decode($requestBody, true);

    if ($request == null || !array_key_exists("type", $request)) {
        header('Content-Type: application/json');
        header("HTTP/1.0 400 Bad Request");
        $error = [
            "message" => "Bad Request",
        ];
        $jsonError = json_encode($error);
        echo $jsonError;
        exit();
    } else

    switch ($request['type']) {
        case 'list':
            {
                $dictionaries = get_dictionaries();

                if (count($dictionaries) !== 0) {
                    $status_code = "HTTP/1.0 200 OK";
                    $status = [
                        "dictionaries" => $dictionaries
                    ];

                    header('Content-Type: application/json');
                    header($status_code);
                    mysqli_close($connect);
                    $jsonResult = json_encode($status);
                    echo $jsonResult;
                } else {
                    header('Content-Type: application/json');
                    header("HTTP/1.0 400 Bad Request");
                    $error = [
                        "message" => "Bad Request",
                    ];
                    $jsonError = json_encode($error);
                    echo $jsonError;
                    exit();
                }

            }
            break;
        case 'show':
            {
                $dictionaries = get_dictionaries($request['id']);

                if (count($dictionaries) !== 0) {

                    foreach ($dictionaries as $key => $dictionary) {
                        $dictionaries[$key]['words'] = get_words_in_dictionary($dictionary['id']) ?? array();
                    }
                    $status_code = "HTTP/1.0 200 OK";
                    $status = [
                        "dictionaries" => $dictionaries
                    ];

                    header('Content-Type: application/json');
                    header($status_code);
                    mysqli_close($connect);
                    $jsonResult = json_encode($status);
                    echo $jsonResult;
                } else {
                    header('Content-Type: application/json');
                    header("HTTP/1.0 400 Bad Request");
                    $error = [
                        "message" => "Bad Request",
                    ];
                    $jsonError = json_encode($error);
                    echo $jsonError;
                    exit();
                }

            }
            break;
        default: {
            header('Content-Type: application/json');
            header("HTTP/1.0 400 Bad Request");
            $error = [
                "message" => "Bad Request",
            ];
            $jsonError = json_encode($error);
            echo $jsonError;
            exit();
        }
    }




