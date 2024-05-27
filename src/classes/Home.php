<?php

class Home
{
    public function index()
    {
        global $smarty;

        // Örnek oyunlar
        $games = [
            1 => 'Game 1',
            2 => 'Game 2',
            3 => 'Game 3',
        ];

        // Varsayılan olarak oyun değeri 0 (Tüm oyunlar) olarak ayarlanır
        $selected_game = isset($_GET['game']) ? (int)$_GET['game'] : 0;

        // Seçilen oyun 0 ise ürünler boş bırakılır, aksi halde ürünler doldurulur
        $products = [];
        if ($selected_game !== 0) {
            // Örnek ürünler
            $products = [
                1 => [
                    [
                        'id' => 1,
                        'name' => 'Product 1',
                        'stock' => 10,
                        'min_order' => 1,
                        'max_order' => 5,
                        'price' => 100
                    ],
                    
                    [
                        'id' => 3,
                        'name' => 'Product 3',
                        'stock' => 30,
                        'min_order' => 1,
                        'max_order' => 5,
                        'price' => 300
                    ],
                ],
                2 => [
                    
                    [
                        'id' => 6,
                        'name' => 'Product 6',
                        'stock' => 60,
                        'min_order' => 1,
                        'max_order' => 5,
                        'price' => 600
                    ],
                ],
                3 => [
                    [
                        'id' => 7,
                        'name' => 'Product 7',
                        'stock' => 70,
                        'min_order' => 1,
                        'max_order' => 5,
                        'price' => 700
                    ],
                    [
                        'id' => 8,
                        'name' => 'Product 8',
                        'stock' => 80,
                        'min_order' => 1,
                        'max_order' => 5,
                        'price' => 800
                    ],
                    [
                        'id' => 9,
                        'name' => 'Product 9',
                        'stock' => 90,
                        'min_order' => 1,
                        'max_order' => 5,
                        'price' => 900
                    ],
                ],
            ];
        }
        $selectedProducts = [];

        // $products[$selected_game] dizisinin varlığını kontrol edin
        if (isset($products[$selected_game]) && is_array($products[$selected_game])) {
            foreach ($products[$selected_game] as $product) {
                $productId = 'quantity_' . $product['id'];
                $quantity = isset($_GET[$productId]) ? $_GET[$productId] : 0; // Eğer anahtar tanımlıysa miktarı al, değilse 0 varsay
                $total = $quantity * $product['price']; // Toplam fiyatı hesapla
        
                $selectedProducts[] = [
                    'name' => $product['name'],
                    'quantity' => $quantity,
                    'price' => $product['price'],
                    'total' => $total,
                ];
            }
        } else {
            // Eğer ürün yoksa veya geçersiz bir anahtar varsa, bir uyarı mesajı ekleyin veya loglama yapın
            error_log("No products found for selected game or products array is not set.");
        }
        
        $smarty->assign('selectedProducts', $selectedProducts);
        $smarty->assign('games', $games);
        $smarty->assign('products', $products);
        $smarty->assign('selected_game', $selected_game); // Seçilen oyunu şablona geçiyoruz
        $smarty->assign('template', 'home.html');
    }
}
