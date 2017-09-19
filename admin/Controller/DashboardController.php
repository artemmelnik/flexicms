<?php

namespace Admin\Controller;

class DashboardController extends AdminController
{
    public function index()
    {
        // Load models
        $this->load->model('User');

        // Load language
        $this->load->language('dashboard/main');

        // Render this template
        $this->view->render('dashboard');
    }
}