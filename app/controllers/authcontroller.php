<?php

class AuthController extends Controller
{
    public function index()
    {
        return $this->renderView('auth/login');
    }

    public function login($request)
    {
        $result = $request->post(
            'http://localhost/fto_api/user/login.php',
            $request->getData()
        );

        // var_dump($request->getData());
        // var_dump(password_verify('password123', '$2y$10$hH4p.hE5QpVfjS8PVl97ZOm8ewTM71RFF8npeCRiCdMvUd2CIfPV2'));
        // exit;

        if ($result->status) {
            $user = $result->user;
            
            if($user->role == 'admin')
            {
                Application::$app->session->setUser($user);
                $this->redirect('admin/dashboard');
                exit;
            }

            if ($user->role == 'orphanage')
            {
                $orphanage = $request->get(
                    'http://localhost/fto_api/orphanage/read_one.php',
                    array(
                        'adminId' => $user->id
                    )
                );

                Application::$app->session->setUser($user);
                Application::$app->session->setOrphanage($orphanage->orphanage);
                $this->redirect('orphanage/dashboard');
                exit;
            }

        } 

        return $this->renderView('auth/login');
    }

    public function logout($request)
    {
        Application::$app->session->userLogout();

        $this->redirect('/');
        exit;
    }

    public function register($request)
    {

    }
}