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
    }

    switch ($request['type']) {
        case 'ru-de': {
            $words = get_words_to_test($request['id'], 10);

            $response = [];
            foreach ($words as $key=>$word) {
                $response[$key] = $words[$key];
                $response[$key]['vars'] = get_words_to_test($request['id'], 3, $word['id']);
                $response[$key]['vars'][] = $words[$key];
                shuffle($response[$key]['vars']);
            }

            $status_code = "HTTP/1.0 200 OK";
            $status = [
                "words" => $response
            ];

            header('Content-Type: application/json');
            header($status_code);
            mysqli_close($connect);
            $jsonResult = json_encode($status);
            echo $jsonResult;
        } break;
        case 'de-ru': {
            $words = get_words_to_test($request['id'], 10);

            $response = [];
            foreach ($words as $key=>$word) {
                $response[$key] = $words[$key];
                $response[$key]['vars'] = get_words_to_test($request['id'], 3, $word['id']);
                $response[$key]['vars'][] = $words[$key];
                shuffle($response[$key]['vars']);
            }

            $status_code = "HTTP/1.0 200 OK";
            $status = [
                "words" => $words
            ];

            header('Content-Type: application/json');
            header($status_code);
            mysqli_close($connect);
            $jsonResult = json_encode($status);
            echo $jsonResult;
        } break;
        case 'construct': {
            $words = get_words_to_test($request['id'], 10);

            $status_code = "HTTP/1.0 200 OK";
            $status = [
                "words" => $words
            ];

            header('Content-Type: application/json');
            header($status_code);
            mysqli_close($connect);
            $jsonResult = json_encode($status);
            echo $jsonResult;
        } break;
        case 'add': {
            $status_code = "HTTP/1.0 200 OK";
            $status = [
                "words" => $request
            ];

            header('Content-Type: application/json');
            header($status_code);
            mysqli_close($connect);
            $jsonResult = json_encode($status);
            echo $jsonResult;
        }
        case 'answer': {  $status_code = "HTTP/1.0 200 OK";

            if(store_user_answers($request['dictionary_id'], $request['user_id'], $request['answers'])) {
                $status = [
                    "status"=>"success"
                ];
            }

            header('Content-Type: application/json');
            header($status_code);
            mysqli_close($connect);
            $jsonResult = json_encode($status);
            echo $jsonResult;
        } break;
    }