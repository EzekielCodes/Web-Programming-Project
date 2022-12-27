<?php

require_once('includes/WebApiHelper.php');
require_once('includes/config.php');
require_once('includes/functions.php');

$db = getDatabase();

$helper = new WebApiHelper();


if ($matches = $helper->matches('GET', 'tasks')) {

    $tasks = $db->query('SELECT * FROM cordinaten ORDER BY name')->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode(['tasks' => $tasks]);
    exit();

} else if ($matches = $helper->matches('DELETE', 'tasks/([0-9]+)')) {

    $id = $matches[0];
    $stmt = $db->prepare('DELETE FROM cordianten WHERE idcordinaten = ?');
    $stmt->execute([$id]);

    if ($stmt->rowCount() > 0) {
        WebApiHelper::message(204, 'Task has been deleted.'); // 204 No Content
    } else {
        WebApiHelper::message(404, 'Task not found'); // 404 Not Found
    }
    exit();

// @TODO endpoint POST 'tasks'

} else if ($matches = $helper->matches('POST', 'tasks')) {

    $bodyParams = $helper->getHttpBody();
    $id = $matches[0];
    $name = $bodyParams['name'] ?? false;
    $latitude = $bodyParams['latitude'] ?? false;
    $longitude = $bodyParams['longitude'] ?? false;

    if (($name !== false) && ($prio !== false)) {

        // validation
        $errorList = [];
        if (strlen($name) === 0) {
            $errorList[] = 'Task name must not be empty.';
        }



        if (!$errorList) {
            $stmt = $db->prepare('INSERT INTO cordinaten (name, latitude, longitude,users_id) VALUES (?,?, ?,?)');
            $stmt->execute([$name, $prio,(new DateTime())->format('Y-m-d H:i:s')]);
            $stmt->execute([$name, $latitude,$longitude,$id]);

            if ($stmt->rowCount()  > 0) {
                WebApiHelper::message(201, 'Task has been created.'); // 201 Created
            } else {
                WebApiHelper::message(503, 'Unable to create Task.'); // 503 Service Unavailable
            }
        } else {
            WebApiHelper::message(422, implode(' ', $errorList)); // 422 Unprocessable Entity
        }
    } else {
        WebApiHelper::message(400, 'Unable to create product. Malformed request.'); // 400 Bad Request
    }
    exit();
}

// @TODO endpoint PUT  'tasks/([0-9]+)'

else if ($matches = $helper->matches('PUT', 'tasks/([0-9]+)')) {

    $id = $matches[0];
    $bodyParams = $helper->getHttpBody();
    $name = $bodyParams['name'] ?? false;
    $latitude = $bodyParams['latitude'] ?? false;
    $longitude = $bodyParams['longitude'] ?? false;

    if (($name !== false) && ($prio !== false)) {

        // validation
        $errorList = [];
        if (strlen($name) === 0) {
            $errorList[] = 'Task name must not be empty.';
        }



        if (!$errorList) {
            $stmt = $db->prepare('UPDATE cordinaten SET name = ?, latitude = ?, longitude= ?,users_id = ?, WHERE id=?');
            $stmt->execute([$name, $prio,(new DateTime())->format('Y-m-d H:i:s'),$id]);

            if ($stmt->rowCount()  > 0) {
                WebApiHelper::message(201, 'Task has been created.'); // 201 Created
            } else {
                WebApiHelper::message(503, 'Unable to create Task.'); // 503 Service Unavailable
            }
        } else {
            WebApiHelper::message(422, implode(' ', $errorList)); // 422 Unprocessable Entity
        }
    } else {
        WebApiHelper::message(400, 'Unable to create product. Malformed request.'); // 400 Bad Request
    }
    exit();
}

else {

    WebApiHelper::message(404, 'Not found.');
    exit();
}