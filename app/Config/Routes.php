<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::products');
$routes->post('/add_to_cart', 'Home::add_to_cart');
$routes->get('/carts', 'Home::carts');
$routes->get('/checkout-view', 'Home::checkout_view');
$routes->post('/checkout', 'Home::checkout');
$routes->post('/stripe/create-charge', 'Home::createCharge');

$routes->post('/checkout/createPaymentIntent', 'Home::createPaymentIntent');

$routes->get('/payment-status', 'Home::payment_status');

$routes->get('/success', 'Home::success');
$routes->get('/cancel', 'Home::cancel');



