<?php

class HomeController
{
    private function render($view)
    {
        require __DIR__ . '/../views/layout/header.php';
        require __DIR__ . '/../views/' . $view . '.php';
        require __DIR__ . '/../views/layout/footer.php';
    }

    public function index()
    {
        $this->render('home/index');
    }

    public function shop()
    {
        $this->render('home/shop');
    }

    public function cart()
    {
        $this->render('home/cart');
    }
}
