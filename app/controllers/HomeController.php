<?php

class HomeController
{
    private function render($view, $data = [])
    {
        extract($data);

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
        $products = [
            [
                'name' => 'Fresh Apples',
                'price' => 3.99,
                'image' => '/assets/images/apples.jpeg'
            ],
            [
                'name' => 'Strawberries',
                'price' => 4.99,
                'image' => '/assets/images/strawberry.avif'
            ],
	    [
		'name' => 'Bananas',
		'price' => 1.99,
		'image' => '/assets/images/bamamas.avif'
	   ]

        ];

        $this->render('home/shop', ['products' => $products]);
    }

    public function cart()
    {
        $this->render('home/cart');
    }
}
