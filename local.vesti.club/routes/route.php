<?php
$app->get('/category/:category', function ($category) use ($app) {
    $categories = [];
    require_once '../util/categories.php';
    if (in_array($category, $categories)) {
        $app->render('show_more_apps.phtml', [
            'content' => $page,
            'os' => $url[2],
            'app_type' => key_exists(3, $url) ? $url[3] : "",
            'games' => $games,
            'next_page' => $next_page,
            'list_template' => get_apps_template($url[2])
        ]);
    }
    else {
        $app->notFound();
    }
    die();
    $limit = 24;
    $next_page = false;
    $page = $app->request->get('data');
    $registered = (new User())->check();
    $url = explode('/', $app->request->get('url'));

    if (count($url) > 2) {
        $contents = get_content($url[2], key_exists(3, $url) ? $url[3] : "");
        $contents = utf8_encode($contents);
        $results = json_decode($contents, true);
        $length = count($results);
        $results = array_values($results);
        if (key_exists(4, $url)) {
            $length = count($results[$url[4]]);
            $games = array_slice($results[$url[4]], ($page - 1) * $limit, $limit);
        }
        else {
            $games = array_slice($results, ($page - 1) * $limit, $limit);
        }

        if (count($games) == 0) {
            $app->notFound();
        }
        if ($length - $page * $limit > 0) {
            $next_page = true;
        }
    }

    if ($registered) {
        $app->render('show_more_apps.phtml', [
            'page' => $page,
            'os' => $url[2],
            'app_type' => key_exists(3, $url) ? $url[3] : "",
            'games' => $games,
            'next_page' => $next_page,
            'list_template' => get_apps_template($url[2])
        ]);
    }

});

$app->get('/complain', function () use ($app) {
    $registered = (new User())->check();
    if ($registered) {
        $app->render('template.phtml', ['app' => $app, 'content' => 'complain.phtml', 'registered' => $registered]);
    } else {
        $app->redirect('/login');
    }
});

$app->post('/complain', function () use ($app) {
    $name = $app->request->post('name');
    $phone = $app->request->post('phone');
    $email = $app->request->post('email');
    $complain = $app->request->post('complain');
    $registered = (new User())->check();
    if ($registered) {
        $to = "help@informpartner.com"; // поменять на свой электронный адрес
        $from = 'admin@musiko.club';
        $referer = parse_url($_SERVER['HTTP_REFERER']);
        $referer = $referer['host'];
        $subject = "Жалоба с ".$referer;
        $message = "Адрес портала: ".$referer."\r\nИмя пользователя: ".$name."\r\nEmail: ".$email."\r\nНомер телефона: ".$phone."\r\n".
            "Жалоба: ".$complain."\r\n";
        $message = utf8_wordwrap($message, 70, "\r\n");
        $headers = "From: " . $from . "\r\n";
        $headers .= "Reply-To: " . $from . "\r\n";
        $headers .= "Content-type: text/plain; charset=\"utf-8\"";
        mail($to, $subject, $message, $headers);
        $app->redirect('/accept-complain');
    } else {
        $app->redirect('/login');
    }
});

$app->get('/accept-complain', function () use ($app) {
    $registered = (new User())->check();
    if ($registered) {
        $app->render('template.phtml', ['app' => $app, 'content' => 'accept-complain.phtml', 'registered' => $registered ]);
    } else {
        $app->redirect('/login');
    }
});
$app->get('/s-management', function () use ($app) {
    $registered = (new User())->check();
    $app->render('template2.phtml', [
        'app' => $app,
        'content' => 'c_management.phtml',
        'registered' => $registered
    ]);
});
$app->get('/login', function () use ($app) {
    $registered = (new User())->check();
    if ($registered) {
        $app->redirect('/');
    }
    $app->render('template2.phtml', [
        'app' => $app,
        'content' => 'c_login.phtml',
        'registered' => $registered

    ]);
});

$app->post(
    '/login',
    function () use ($app) {
        $app->getLog()->debug("SignIn params: " . print_r($app->request->post('auth'), true));
//		$auth = new User($app);
        $registered = UserFasade::check();
        if ($registered) {
            $app->redirect('/');
        }
        try {
            UserFasade::login($app->request->post('auth')['email'], $app->request->post('auth')['password']);
            $app->redirect('/');
        } catch (LoginRequiredException $e) {
            $msg = "Не указан логин";
        } catch (PasswordRequiredException $e) {
            $msg = "Не указан пароль";
        } catch (WrongCredentialsException $e) {
            $msg = "Пользователь не найден";
        }
        $app->flashNow("msg", $msg);

        $app->render('template2.phtml', ['app' => $app, 'content' => 'c_login.phtml', 'registered' => $registered]);
    }
);

$app->get('/rules', handler("c_rules.phtml"));

$app->get('/once-rules', handler("once-rules.phtml"));

