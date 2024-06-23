<?php

namespace App\Controllers;

use App\Models\OrderModel;
use App\Models\ProductModel;
use App\Models\UserModel;
use Stripe\Stripe;
use Stripe\PaymentIntent;

class Home extends BaseController
{
    public function products()
    {
        $productModel = new ProductModel();

        $data['products'] = $productModel->paginate(10);

        $data['pagination_link'] = $productModel->pager;

        return view('products', $data);
    }

    public function add_to_cart()
    {
        $session = \Config\Services::session();

        $id = $this->request->getVar('id');

        if ($session->get('carts')) {
            $carts = $session->get('carts');

            if (in_array($id, $carts)) {
                $valueToRemove = $id;
                $carts = array_filter($carts, function ($value) use ($valueToRemove) {
                    return $value !== $valueToRemove;
                });
                $session->set('carts', $carts);
                echo 0;
            } else {
                array_push($carts, $id);
                $session->set('carts', $carts);
                echo 2;
            }
        } else {
            $carts = [];
            array_push($carts, $id);
            $session->set('carts', $carts);
            echo 1;
        }
    }
    public function carts()
    {
        $session = \Config\Services::session();

        $carts = $session->get('carts');
        if ($carts) {
            $productModel = new ProductModel();
            $data['products'] = $productModel->whereIn('id', $carts)->paginate(10);
            $data['pagination_link'] = $productModel->pager;
        } else {
            $data['products'] = '';
        }
        return view('carts', $data);
    }

    public function checkout_view()
    {
        $session = \Config\Services::session();

        $carts = $session->get('carts');

        if ($carts) {

            $productModel = new ProductModel();
            $data['products'] = $productModel->whereIn('id', $carts)->paginate(10);
            $data['pagination_link'] = $productModel->pager;
            return view('checkout-view', $data);
        } else {
            return $this->response->redirect(base_url('/carts'));
        }
    }

    public function checkout()
    {
        helper(['form', 'url']);

        $error = $this->validate([
            'name'    =>    'required|min_length[3]',
            'email'    =>    'required|valid_email',
        ]);

        if (!$error) {
            echo view('add_data', [
                'error'     => $this->validator
            ]);
        } else {

            $session = \Config\Services::session();

            $carts = $session->get('carts');
            $userModel = new UserModel();

            $userModel->save([
                'name'    =>    $this->request->getVar('name'),
                'email'    =>    $this->request->getVar('email'),
            ]);

            $orderModel = new OrderModel();
            $today = date("Ymd");
            $rand = sprintf("%04d", rand(0, 9999));
            $unique = $today . $rand;
            $orderModel->save([
                'order_code'    =>    $unique,
                'user_id'    =>    $userModel->getInsertID(),
                'cart_total' => $session->get('cart_total'),
                'product_ids' => json_encode($carts),
            ]);

            $session->set('order_id', $orderModel->getInsertID());

            // unset($_SESSION['carts']);

            if ($carts) {

                $productModel = new ProductModel();
                $data['products'] = $productModel->whereIn('id', $carts)->paginate(10);
                $data['pagination_link'] = $productModel->pager;


                // $products = $productModel->whereIn('id', $carts)->get()->getResult();
                // $product_array = [];
                // foreach ($products as $product) {
                //     array_push($product_array, ['name'=>$product->title,'description'=>$product->description,'images'=>$product->image,'amount' => $product->price, 'quantity' => 1]);
                // }

                // // echo "<pre>";
                // // print_r($product_array);
                // // die();

                // \Stripe\Stripe::setApiKey(getenv('stripe.secret'));


                // $session = \Stripe\Checkout\Session::create([
                //     'payment_method_types' => ['card'],
                //     'line_items' => [[
                //         'name' => 'T-shirt',
                //         'description' => 'Comfortable cotton t-shirt',
                //         'images' => ['https://example.com/t-shirt.png'],
                //         'amount' => 2000,
                //         'currency' => 'usd',
                //         'price_data' => [
                //             'currency' => 'usd',
                //             'unit_amount' => 2000,
                //             'product_data' => [
                //                 'name' => 'T-shirt',
                //                 'description' => 'Comfortable cotton t-shirt',
                //                 'images' => ['https://example.com/t-shirt.png'],
                //             ],
                //         ],
                //         'quantity' => 1,
                //     ]],
                //     'mode' => 'subscription',
                //     'success_url' => base_url('/success') . '?session_id={' . $orderModel->getInsertID() . '}',
                //     'cancel_url' => base_url('cancel'),
                // ]);

                return view('checkout-intent', $data);
            } else {
                return $this->response->redirect(base_url('/carts'));
            }
        }

        return $this->response->redirect(base_url('/carts'));
    }

    public function createPaymentIntent()
    {
        Stripe::setApiKey(getenv('stripe.secret'));

        $session = \Config\Services::session();
        $amount = $session->get('cart_total') * 100; // Convert to cents

        $paymentIntent = PaymentIntent::create([
            'amount' => $amount,
            'currency' => 'usd',
        ]);

        return $this->response->setJSON(['clientSecret' => $paymentIntent->client_secret]);
    }

    public function createCharge()
    {

        $session = \Config\Services::session();
        Stripe\Stripe::setApiKey(getenv('stripe.secret'));
        $charge = Stripe\Charge::create([
            "amount" => $session->get('cart_total') * 100,
            "currency" => "usd",
            "source" => $this->request->getVar('stripeToken'),
            "description" => "Binaryboxtuts Payment Test"
        ]);

        unset($_SESSION['cart_total']);

        $orderModel = new OrderModel();
        $data = [
            'trans_id' => $charge->balance_transaction,
            'payment_status'  => 'Paid',
        ];
        $id = $session->get('order_id');
        $orderModel->update($id, $data);

        // unset($_SESSION['order_id']);


        return redirect('payment-status')->with('success', 'Payment Successful!');
    }

    public function success()
    {

        return view('success');
    }

    public function cancel()
    {

        return view('cancel');
    }


    public function payment_status()
    {
        $session = \Config\Services::session();
        $orderModel = new OrderModel();
        $data['order'] = $orderModel->where('id', $session->get('order_id'))->first();

        return view('payment_status', $data);
    }
}
