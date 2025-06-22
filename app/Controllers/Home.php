<?php

namespace App\Controllers;

use App\Libraries\Page;

class Home extends BaseController
{
    public function index(): string
    {
        return view('landing');
    }

    public function dashboard(): string
    {
        $page = new Page;
        $page->setTitle('Dashboard');
        $page->setBreadcrumbs([
            [
                'label' => 'Dashboard',
                'url' => false
            ]
        ]);
        
        return $page->render('home/dashboard');
    }
}
