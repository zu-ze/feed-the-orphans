<?php

class AdminController extends Controller 
{
    public function __construct()
    {

        $this->setLayout('layout/admin');
    }

    public function index()
    {
        $params = array(
            'usersCount' => Application::$app->database->getRow('
                SELECT COUNT(*) as count FROM user;')['count'],
            'orphanagesCount' => Application::$app->database->getRow('
                SELECT COUNT(*) as count FROM orphanage;')['count'],
        );

        return $this->renderView('admin/dashboard', $params);
    }

    public function report()
    {
        return $this->renderView('admin/report');
    }

    public function users($request)
    {
        $result = $request->get('http://localhost/fto_api/user/read.php', []);

        return $this->renderView('admin/users', [
            'result' => $result
        ]);
    }

    public function orphanages($request)
    {
        $result = $request->get('http://localhost/fto_api/orphanage/read.php', []);
        $users = $request->post('http://localhost/fto_api/user/readwhere.php', array(
            'role' => 'orphanage'
        ));

        return $this->renderView('admin/orphanage', [
            'result' => $result,
            'users' => $users
        ]);
    }

    public function addUser($request)
    {
        $result = $request->post(
            'http://localhost/fto_api/user/register.php',
            $request->getData()
        );

        if ($result->status) {
            Application::$app->session->setFlash('success', $result->message);
            $this->redirect('/admin/users');
            exit;
        }

        Application::$app->session->setFlash('failed', $result->message);
        $this->redirect('/admin/users');
        exit;

    }

    public function addOrphanage($request)
    {
        $result = $request->post(
            'http://localhost/fto_api/orphanage/create.php',
            $request->getData()
        );

        if ($result->status) {
            Application::$app->session->setFlash('success', $result->message );
            $this->redirect('/admin/orphanages');
            exit;
        }

        Application::$app->session->setFlash('failed', $result->message );
        $this->redirect('/admin/orphanages');
        exit;
    }
}