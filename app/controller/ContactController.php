<?php

namespace App\Controller;

use App\Helpers\Mailer;

class ContactController extends Controller
{
    public function index()
    {
        $result = null;

        // hp_check = honey pot check
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['hp_check']) && empty($_POST['hp_check'])) {
            $result = Mailer::send($_POST);
        }

        $this->render('/contact/index.php', [
            'result' => $result
        ]);
    }
}