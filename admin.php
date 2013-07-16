<?php 
/*
 * Admin App
 */

include_once "common.php";

$login_required = function ($app) {
    return function () use ($app) {
        if (!isset($_SESSION['user'])) {
            $_SESSION['urlRedirect'] = $app->request()->getPathInfo();
            $app->flash('error', 'Login required');
            $app->redirect('/login');
        }
    };
};

$app->hook('slim.before.dispatch', function() use ($app) { 
   $user = null;
   if (isset($_SESSION['user'])) {
      $user = $_SESSION['user'];
   }
   $app->view()->setData('user', $user);
});


$app->get('/login', function() {
   $flash = $app->view()->getData('flash');

   $error = '';
   if (isset($flash['error'])) {
      $error = $flash['error'];
   }

   $urlRedirect = '/';

   if ($app->request()->get('r') && $app->request()->get('r') != '/logout' && $app->request()->get('r') != '/login') {
      $_SESSION['urlRedirect'] = $app->request()->get('r');
   }

   if (isset($_SESSION['urlRedirect'])) {
      $urlRedirect = $_SESSION['urlRedirect'];
   }

   $username_value = $username_error = $password_error = '';

   if (isset($flash['username'])) {
      $username_value = $flash['username'];
   }

   if (isset($flash['errors']['username'])) {
      $username_error = $flash['errors']['username'];
   }

   if (isset($flash['errors']['password'])) {
      $password_error = $flash['errors']['password'];
   }

   $app->render('login.php', array('error' => $error, 'username_value' => $username_value, 'username_error' => $username_error, 'password_error' => $password_error, 'urlRedirect' => $urlRedirect));

});

$app->post('/login', function() {
	echo "post login.....";

	$username = $app->request()->post('username');
    $password = $app->request()->post('password');

    $errors = array();

    if ($username != "brian@nesbot.com") {
        $errors['username'] = "Email is not found.";
    } else if ($password != "aaaa") {
        $app->flash('username', $username);
        $errors['password'] = "Password does not match.";
    }

    if (count($errors) > 0) {
        $app->flash('errors', $errors);
        $app->redirect('/login');
    }

    $_SESSION['user'] = $username;

    if (isset($_SESSION['urlRedirect'])) {
       $tmp = $_SESSION['urlRedirect'];
       unset($_SESSION['urlRedirect']);
       $app->redirect($tmp);
    }

    $app->redirect('/');
});

$app->get('/logout', function() {
	unset($_SESSION['user']);
	$app->view()->setData('user', null);
	$app->render('login.html');
});

$app->get("/", $login_required($app), function () use ($app) {
    $app->render('index.html');
});

$app->get('/users', $login_required($app), function() use（$app) {
	$users = array();
	$app->render('users.html', array('users' => $users));
});

$app->get('/chats', $login_required($app), function() use($app) {
	$app->render('chats.html');
	echo "chats...";
});

$app->get('/robots', $login_required($app), function()  use($app) {

});

$app->get('/setting', $login_required($app), function()  use($app) {
	echo "setting...";
});

$app->run();

