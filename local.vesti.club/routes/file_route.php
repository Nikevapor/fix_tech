<?php

$app->post('/filepost', function () use ($app) {
    $req = $app->request();
    $filename = $req->post('filename');
    $filedesc = $req->post('filedesc');
    $upload = ($_FILES['file']);
    $app->render("filepost.php", ['filename' => $filename, 'filedesc' => $filedesc, 'file' => $upload]);
    $app->redirect('/f-thanks');
});
$app->get('/filesupload', function () use ($app) {
    $registered = (new User())->check();
    if ($registered) {
        $app->render('template.phtml', ['app' => $app, 'content' => 'filesupload.phtml', 'registered' => $registered]);
    } else {
        $app->redirect('/login');
    }
});

$app->get('/f-thanks', function () use ($app) {
    $registered = (new User())->check();
    if ($registered) {
        $app->render('template.phtml', ['app' => $app, 'content' => 'f-thanks.phtml', 'registered' => $registered]);
    } else {
        $app->redirect('/login');
    }
});
