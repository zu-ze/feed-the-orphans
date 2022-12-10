<?php

class OrphanageController extends Controller
{
    public function __construct()
    {
        $this->setLayout('layout/orphanage');
    }
    public function index()
    {
        $params = array(
            'donationsCount' => Application::$app->database->getRow('
                SELECT COUNT(*) as count FROM receivedDonation WHERE orphanageId='.Application::$app->session->getOrphanage()->id.'
            ')['count'],
            'donarsCount' => Application::$app->database->getRow('
                SELECT COUNT(userId) as count FROM sentDonation WHERE orphanageId='.Application::$app->session->getOrphanage()->id.'
                ')['count'],
            'chart' => Application::$app->database->getRow("
                SELECT 
                (
                    SELECT COUNT(*) FROM receivedDonation WHERE createdAt > DATE(NOW()) - INTERVAL 4 WEEK 
                        AND createdAt <= DATE(NOW()) - INTERVAL 3 WEEK 
                        AND orphanageId=".Application::$app->session->getOrphanage()->id."
                ) as '4 weeks ago'
                ,
                (
                    SELECT COUNT(*) FROM receivedDonation WHERE createdAt > DATE(NOW()) - INTERVAL 3 WEEK 
                        AND createdAt <= DATE(NOW()) - INTERVAL 2 WEEK
                        AND orphanageId=".Application::$app->session->getOrphanage()->id."
                ) as '3 weeks ago'
                ,
                (
                    SELECT COUNT(*) FROM receivedDonation WHERE createdAt > DATE(NOW()) - INTERVAL 2 WEEK 
                        AND createdAt <= DATE(NOW()) - INTERVAL 1 WEEK
                        AND orphanageId=".Application::$app->session->getOrphanage()->id."
                ) as '2 weeks ago'
                ,
                (
                    SELECT COUNT(*) FROM receivedDonation WHERE createdAt > DATE(NOW()) - INTERVAL 1 WEEK 
                        AND createdAt <= NOW()
                        AND orphanageId=".Application::$app->session->getOrphanage()->id."
                ) as '1 week ago'
                FROM receivedDonation LIMIT 0,1;
            ")
        );

        // echo '<pre>';
        // var_dump($params);
        // exit;
        return $this->renderView('orphanage/dashboard', $params);
    }

    public function report()
    {
        return $this->renderView('orphanage/report');
    }

    public function donation($request)
    {
        $orphanage = Application::$app->session->getOrphanage();
        $result = $request->get(
            'http://localhost/fto_api/donation/read_received.php',
            array(
                'id' => $orphanage->id
            )
        );

        return $this->renderView('orphanage/donation', [
            'result' => $result
        ]);
    }

    public function calendar()
    {
        return $this->renderView('orphanage/calendar');
    }

    public function map()
    {
        return $this->renderView('orphanage/map');
    }

    public function addEvent($request)
    {
        $result = $request->post(
            'http://localhost/fto_api/event/create.php',
            array(
                'orphanageId' => $request->getData()['orphanageId'],
                'eventDate' => $request->getData()['evt-date'],
                'title' => $request->getData()['title'],
                'description' => trim($request->getData()['evt-details'])
            )
        );

        if($result->status) {
            Application::$app->session->setFlash('success', $result->message);
            $this->redirect('/orphanage/calendar');
            exit;
        }

        Application::$app->session->setFlash('failed', $result->message);
        $this->redirect('/orphanage/calendar');
        exit;
    }

    public function receiveDonation($request)
    {
        $transId = $request->getData()['transId'];
        $result = $request->post(
            'http://localhost/fto_api/donation/receive.php',
            $request->getData()
        );

        if ($result->status) {
            Application::$app->session->setFlash('success', $result->message);

            $approved = $request->post(
                'http://localhost/fto_api/donation/approve.php',
                array (
                    'transId' => $transId
                )
            );

            if ($approved->status) {
                if($approved->record->senderId != 1) {
                    $orphanage = $request->post(
                        'http://localhost/fto_api/orphanage/read_where.php',
                        array(
                            "type" => "id",
                            "id" => $approved->record->orphanageId
                        )
                    );

                    $notify = $request->post(
                        'http://localhost/fto_api/notification/create.php',
                        array(
                            'userId' => $approved->record->senderId,
                            'status' => 1,
                            'message' => "Donation ".$approved->record->transId." made to "
                                .$orphanage->record->name." has been received."
                        )
                    );
                    
                }
            }
            $this->redirect('/orphanage/donation');
            exit;
        }

        Application::$app->session->setFlash('failed', $result->message);
        $this->redirect('/orphanage/donation');
        exit;
    }

    public function profile($request)
    {
        $contact = $request->post(
            'http://localhost/fto_api/contact/read.php',
            array(
                'orphanageId' => Application::$app->session->getOrphanage()->id
            )
            );

        return $this->renderView('orphanage/profile', [
            'contact' => $contact 
        ]);
    }

    public function addContact($request)
    {
        $result = $request->post(
            'http://localhost/fto_api/contact/create.php',
            $request->getData()
        );


        if ($result->status) {
            Application::$app->session->setFlash('success', $result->message);
            $this->redirect('/orphanage/profile');
            exit;
        }

        Application::$app->session->setFlash('failed', $result->message);
        $this->redirect('/orphanage/profile');
        exit;
    }

    public function edit($request)
    {

        // var_dump($request->getData());
        // exit;

        $result = $request->post(
            'http://localhost/fto_api/orphanage/edit.php',
            $request->getData()
        );

        if ($result->status) {

            $orphanage = $request->get(
                'http://localhost/fto_api/orphanage/read_one.php',
                array(
                    'adminId' => Application::$app->session->getUser()->id
                )
            );
            
            Application::$app->session->setOrphanage($orphanage->orphanage);
    
            Application::$app->session->setFlash('success', $result->message);
            $this->redirect('/orphanage/profile');
            exit;
        }

        Application::$app->session->setFlash('failed', $result->message);
        $this->redirect('/orphanage/profile');
        exit;
    }

    public function addLocation($request)
    {
        $data = $request->getData();
        $result = $request->post(
            'http://localhost/fto_api/orphanage/edit.php',
            array(
                'type' => 'latitude',
                'latitude' => $data['latitude'],
                'orphanageId' => Application::$app->session->getOrphanage()->id
            )
        );

        if ($result->status) {
            $result = $request->post(
                'http://localhost/fto_api/orphanage/edit.php',
                array(
                    'type' => 'longitude',
                    'longitude' => $data['longitude'],
                    'orphanageId' => Application::$app->session->getOrphanage()->id
                )
            );

            if ($result->status) {
                $orphanage = $request->get(
                    'http://localhost/fto_api/orphanage/read_one.php',
                    array(
                        'adminId' => Application::$app->session->getUser()->id
                    )
                );
                
                Application::$app->session->setOrphanage($orphanage->orphanage);
        
                Application::$app->session->setFlash('success', "Location set successfully.");
                $this->redirect('/orphanage/map');
                exit;
            }
        }

        Application::$app->session->setFlash('failed', "failed to set Location.");
        $this->redirect('/orphanage/map');
        exit;
    }

    public function generateMonthly()
    {
        return $this->renderView('orphanage/report/monthly', [
            'test' => 'Feed The Orphans',
            'approved' => Application::$app->database->getRow("
                SELECT COUNT(*) as count, SUM(amount) as amount 
                FROM receivedDonation WHERE orphanageId=".Application::$app->session->getOrphanage()->id."
            "),
            'sent' => Application::$app->database->getRow("
                SELECT COUNT(*) as count, SUM(amount) as amount 
                FROM sentDonation WHERE orphanageId=".Application::$app->session->getOrphanage()->id."
            "),
            'result' => array(
                'status' => false,
                'message' => 'No reports found'
            )
        ]);
    }

    public function generateAnnual() 
    {
        $months = array();

        for( $i = 1; $i <= 12; $i++) {
            $months[$i] = array(
                    'approved' => Application::$app->database->getRow("
                        SELECT COUNT(*) as count, SUM(amount) as amount 
                        FROM receivedDonation WHERE orphanageId=".Application::$app->session->getOrphanage()->id."
                         AND MONTH(createdAt)=".$i." AND YEAR(createdAt)=YEAR(CURDATE()) 
                    "),
                    'sent' => Application::$app->database->getRow("
                        SELECT COUNT(*) as count, SUM(amount) as amount 
                        FROM sentDonation WHERE orphanageId=".Application::$app->session->getOrphanage()->id."
                         AND MONTH(createdAt)=".$i." AND YEAR(createdAt)=YEAR(CURDATE())
                    "),
            );
        }
        

        return $this->renderView('orphanage/report/annual', [
            'test' => 'Feed The Orphans',
            'months' => $months,
            'result' => array(
                'status' => false,
                'message' => 'No reports found'
            )
        ]);
    }
}