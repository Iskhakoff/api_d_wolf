<?php
    // Функции доступные повсюду
/**
 * Получаем список слов по id словаря
 * @param $dictionary_id
 * @return array
 */
    function get_words_in_dictionary($dictionary_id) {
        global $connect;
        if ($stmt = mysqli_prepare($connect, "SELECT * FROM words WHERE type_id = ?")) {
            mysqli_stmt_bind_param($stmt, "s", $dictionary_id);
            $stmt->execute();

            $meta = $stmt->result_metadata();
            while ($field = $meta->fetch_field())
            {
                $params[] = &$row[$field->name];
            }

            call_user_func_array(array($stmt, 'bind_result'), $params);

            while ($stmt->fetch()) {
                foreach($row as $key => $val)
                {
                    $c[$key] = $val;
                }
                $result[] = $c;
            }

            return $result;
        }
    }

/**
 * Получаем список словарей, если не передан id словаря
 * Получаем словарь, если передан id.
 * @param null $did
 * @return array
 */
    function get_dictionaries($did = null) {
        global $connect;

        if($did == null) {
            if ($stmt = mysqli_prepare($connect, "SELECT id, name, title FROM dictionary_list")) {
                mysqli_stmt_execute($stmt);
                $stmt->execute();

                $meta = $stmt->result_metadata();
                while ($field = $meta->fetch_field())
                {
                    $params[] = &$row[$field->name];
                }

                call_user_func_array(array($stmt, 'bind_result'), $params);

                while ($stmt->fetch()) {
                    foreach($row as $key => $val)
                    {
                        $c[$key] = $val;
                    }
                    $result[] = $c;
                }


                return $result;
            }
        } else {
            if ($stmt = mysqli_prepare($connect, "SELECT * FROM dictionary_list WHERE id = ?")) {
                mysqli_stmt_bind_param($stmt, "s", $did);
                $stmt->execute();

                $meta = $stmt->result_metadata();
                while ($field = $meta->fetch_field())
                {
                    $params[] = &$row[$field->name];
                }

                call_user_func_array(array($stmt, 'bind_result'), $params);

                while ($stmt->fetch()) {
                    foreach($row as $key => $val)
                    {
                        $c[$key] = $val;
                    }
                    $result[] = $c;
                }

                return $result;
            }
        }
    }

/**
 * Работа со словом
 * Если есть id, изменяем существующее
 * Если нет id, добавляем новое
 * Возвращает код 200 и id измененого / добавленного слова
 * @param $data
 * @return array
 */
    function manage_word($data) {
        global $connect;

        if(!isset($data['id'])) {
            $keys = implode("`,`", array_keys($data));

            $values = implode("','", $data);

            $query = "INSERT INTO words (`{$keys}`) VALUES ('{$values}')";
            $result = mysqli_query($connect, $query);

            if ($result) {
                $response['code'] = 200;
                $response['id'] = $connect->insert_id;
            } else {
                $response['code'] = 500;
                $response['message'] = $connect->error;
            }
        } else {
            $id = $data['id'];

            unset($data['id']);
            $fields = [];
            foreach ($data as $key=>$value) {
                $fields[] = "`{$key}`='{$value}'";
            }

            $fields = implode(',', $fields);

            $query = "UPDATE words SET $fields WHERE id={$id}";
            $result = mysqli_query($connect, $query);

            if ($result) {
                $response['code'] = 200;
                $response['id'] = $id;
            } else {
                $response['code'] = 500;
                $response['message'] = $connect->error;
            }
        }


        return $response;
    }

/**
 * Работа со словарем
 * Если есть id, изменяем существующее
 * Если нет id, добавляем новое
 * Возвращает код 200 и id измененого / добавленного словаря
 * @param $data
 * @return array
 */
    function manage_dictionary($data) {
        return [];
    }

/**
 * Получение данных слова
 * @param $id
 * @return array
 */
    function get_word_data($id) {
        global $connect;
        $result = [];
        if ($stmt = mysqli_prepare($connect, "SELECT * FROM words WHERE id = ?")) {
            mysqli_stmt_bind_param($stmt, "s", $id);
            $stmt->execute();

            $meta = $stmt->result_metadata();
            while ($field = $meta->fetch_field())
            {
                $params[] = &$row[$field->name];
            }

            call_user_func_array(array($stmt, 'bind_result'), $params);

            while ($stmt->fetch()) {
                foreach($row as $key => $val)
                {
                    $c[$key] = $val;
                }
                $result[] = $c;
            }

            return $result;
        }

        return $result;
    }

/**
 * Получаем рандомные слова для тестирования.
 *
 *
 * @param $did - id словаря
 * @param $limit - сколько слов нужно
 * @param null $exists - нужно ли получить то слово, которое уже есть
 * @return array
 */
    function get_words_to_test($did, $limit, $exists = null) {
        global $connect;
        if($exists == null) {
            if ($stmt = mysqli_prepare($connect, "SELECT * FROM words WHERE type_id = ? ORDER BY RAND() LIMIT ?")) {
                mysqli_stmt_bind_param($stmt, "si", $did, $limit);
                $stmt->execute();

                $meta = $stmt->result_metadata();
                while ($field = $meta->fetch_field()) {
                    $params[] = &$row[$field->name];
                }

                call_user_func_array(array($stmt, 'bind_result'), $params);

                while ($stmt->fetch()) {
                    foreach ($row as $key => $val) {
                        $c[$key] = $val;
                    }
                    $result[] = $c;
                }

                return $result;
            }
        } else {
            if ($stmt = mysqli_prepare($connect, "SELECT * FROM words WHERE type_id = ? AND id != ? ORDER BY RAND() LIMIT ?")) {
                mysqli_stmt_bind_param($stmt, "iii", $did,$exists, $limit);
                $stmt->execute();

                $meta = $stmt->result_metadata();
                while ($field = $meta->fetch_field()) {
                    $params[] = &$row[$field->name];
                }

                call_user_func_array(array($stmt, 'bind_result'), $params);

                while ($stmt->fetch()) {
                    foreach ($row as $key => $val) {
                        $c[$key] = $val;
                    }
                    $result[] = $c;
                }

                return $result;
            }
        }
    }

    function store_user_answers($did, $uid, $answers) {}

    function get_user_answers($did, $uid) {}

    function user_word_answer_exists($uid, $wid) {}