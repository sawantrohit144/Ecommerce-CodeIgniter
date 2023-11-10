<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\CategoryModel;
use App\Models\ProductModel;
use App\Models\UsersModel;
use App\Models\ContactModel;
use App\Models\OrderModel;
use App\Models\OrderDetailModel;
use App\Models\OrderStatusModel;

class CustomerDash extends BaseController
{
    public function dash()
    {
        $categorymodel = new CategoryModel();
        $categorydata = $categorymodel->findAll();

        $productmodel = new ProductModel();
        $productdata = $productmodel
          ->select('product.*, categories.categories as category_name')
          ->join('categories', 'product.categories_id = categories.id')
          ->findAll();

        echo view('customer/header', ['categorydata'=>$categorydata, 'productdata'=>$productdata]);
        echo view('customer/index', ['categorydata'=>$categorydata, 'productdata'=>$productdata]);
        echo view('customer/footer', ['categorydata'=>$categorydata, 'productdata'=>$productdata]);
    }

    public function categories(){
      $categorymodel = new CategoryModel();
      $categorydata = $categorymodel->findAll();

      $productmodel = new ProductModel();
      $productdata = $productmodel
        ->select('product.*, categories.categories as category_name')
        ->join('categories', 'product.categories_id = categories.id')
        ->findAll();

      echo view('customer/header', ['categorydata'=>$categorydata, 'productdata'=>$productdata]);
      echo view('customer/categories', ['categorydata'=>$categorydata, 'productdata'=>$productdata]);
      echo view('customer/footer', ['categorydata'=>$categorydata, 'productdata'=>$productdata]);
    }

    public function productbycategory($categoryId){
    $categorymodel = new CategoryModel();
    $categorydata = $categorymodel->findAll();

    $productmodel = new ProductModel();
    $productdata = $productmodel
        ->select('product.*, categories.categories as category_name')
        ->join('categories', 'product.categories_id = categories.id')
        ->where('categories_id', $categoryId) // Filter products by category
        ->findAll();

        $sortingOption = $this->request->getGet('sorting'); // Get the selected sorting option from the URL query string

        switch ($sortingOption) {
            case 'price_high':
                $productdata = $productmodel
                    ->where('categories_id', $categoryId)
                    ->orderBy('price', 'ASC')
                    ->findAll();

                break;
            case 'price_low':
                $productdata = $productmodel
                    ->where('categories_id', $categoryId)
                    ->orderBy('price', 'DESC')
                    ->findAll();
                break;
            case 'new':
                $productdata = $productmodel
                    ->where('categories_id', $categoryId)
                    ->orderBy('id', 'DESC')
                    ->findAll();
                break;
            case 'old':
                $productdata = $productmodel
                    ->where('categories_id', $categoryId)
                    ->orderBy('id', 'ASC')
                    ->findAll();
                break;
            default: // Default sorting
                $productdata = $productmodel
                    ->where('categories_id', $categoryId)
                    ->findAll();
                break;
        }

    echo view('customer/header', ['categorydata'=>$categorydata, 'productdata'=>$productdata]);
    echo view('customer/categories', ['categorydata'=>$categorydata, 'productdata'=>$productdata]);
    echo view('customer/footer', ['categorydata'=>$categorydata, 'productdata'=>$productdata]);
    }

    public function productdetail($productId){
      $categoryModel = new CategoryModel();
      $categorydata = $categoryModel->findAll();

      $productModel = new ProductModel();
      $productdata = $productModel
          ->select('product.*, categories.categories as category_name')
          ->join('categories', 'product.categories_id = categories.id')
          ->where('product.id', $productId)
          ->first();  // Fetch a single product by its ID

      echo view('customer/header', ['categorydata'=>$categorydata, 'productdata'=>$productdata]);
      echo view('customer/productdetail', ['categorydata'=>$categorydata, 'productdata'=>$productdata]);
      echo view('customer/footer', ['categorydata'=>$categorydata, 'productdata'=>$productdata]);
    }

    public function contactus(){
      $categoryModel = new CategoryModel();
      $categorydata = $categoryModel->findAll();

      $validationRules = [
        'name' => 'required',
        'email' => 'required|valid_email',
        'mobile' => 'required',
        'comment' => 'required',
      ];
      if ($this->validate($validationRules)) {
          $contactModel = new ContactModel();
          $contactdata = [
            'name'    => $this->request->getPost('name'),
            'email'   => $this->request->getPost('email'),
            'mobile'  => $this->request->getPost('mobile'),
            'comment' => $this->request->getPost('comment'),
            'added_on' => date('Y-m-d H:i:s')
          ];

          if ($contactModel->save($contactdata)) {
             session()->setFlashdata('success', 'Message sent successfully.');
             return redirect()->to('CustomerDash/contactus');
          } else {
             session()->setFlashdata('error', 'Failed to send message. Please try again.');
             return redirect()->to('CustomerDash/contactus');
          }
      }
      echo view('customer/header', ['categorydata'=>$categorydata]);
      echo view('customer/contactus');
      echo view('customer/footer');
    }

    public function addtocart($product_id, $selectedQuantity){
      $productmodel = new ProductModel();
      $product = $productmodel->find($product_id);
      $cartCount = session()->get('cart_count', 0);
      // Initialize the cart if not already set in the session
      $cart = session()->get('cart') ?? [];

      // Check if the product is already in the cart
      $found = false;
      foreach ($cart as &$cartItem) {
          if ($cartItem['id'] == $product_id) {
              // $cartItem['qty'] += $selectedQuantity;
              $found = true;
              break;
          }
      }

      // If the product is not found in the cart, add it
      if (!$found) {
          $product['qty'] = $selectedQuantity;
          $cart[] = $product;
          $cartCount++;
      }

      // Store the updated cart in the session
      session()->set('cart', $cart);
      session()->set('cart_count', $cartCount);

      return redirect()->to('CustomerDash/dash');
    }

    public function cart(){
      $categoryModel = new CategoryModel();
      $categorydata = $categoryModel->findAll();

      $cart = session()->get('cart');

      if (empty($cart)) {
        return redirect()->to('CustomerDash/emptycart');
      }
      echo view('customer/header', ['categorydata'=>$categorydata]);
      echo view('customer/cart', ['cart' => $cart]);
      echo view('customer/footer');
    }

    public function emptycart(){
      $categoryModel = new CategoryModel();
      $categorydata = $categoryModel->findAll();

      echo view('customer/header', ['categorydata'=>$categorydata]);
      echo view('customer/emptycart');
      echo view('customer/footer');
    }

    public function updateproduct($product_id, $newQuantity){

      // Fetch the cart from the session
      $cart = session()->get('cart') ?? [];

      // Find the product in the cart
      $found = false;
      foreach ($cart as &$cartItem) {
          if ($cartItem['id'] == $product_id) {
              $cartItem['qty'] = $newQuantity; // Update the quantity
              $found = true;
              break;
          }
      }

      session()->set('cart', $cart); // Update the cart in the session
      // Redirect back to the cart page or wherever you want
      return redirect()->to('customerdash/cart'); // Change 'cart' to your cart page's URL
      // return $this->response->setJSON(['cart' => $cart]);
    }

    public function removeproduct($product_id){
      $cartCount = session()->get('cart_count', 0);
      // Get the current cart data from the session
      $cart = session()->get('cart') ?? [];

      // Loop through the cart to find and remove the product by ID
      foreach ($cart as $key => $product) {
          if ($product['id'] == $product_id) {
              unset($cart[$key]); // Remove the product from the cart
              if ($cartCount > 0) {
                $cartCount--; // Decrement the cart count if it's greater than 0
              }
              break; // Exit the loop once the product is removed
          }
      }

      // Update the cart count in the session
      session()->set('cart_count', $cartCount);

      // Update the cart in the session
      session()->set('cart', $cart);

      return redirect()->to('CustomerDash/cart'); // Redirect back to the cart page or any other appropriate page
    }

    public function checkout(){
      $categoryModel = new CategoryModel();
      $categorydata = $categoryModel->findAll();

      $cart = session()->get('cart');

      // Check if the cart is empty
      if (empty($cart)) {
          // Redirect or display an error message indicating that the cart is empty
          return redirect()->to('customerdash/cart')->with('error', 'Your cart is empty.'); // Replace 'path_to_empty_cart_page' with the appropriate URL
      }

      $total = 0; // Initialize the total amount

      // Calculate the total by summing up the prices of items in the cart
      foreach ($cart as $product) {
          $total += $product['price']* $product['qty'];
      }

      echo view('customer/header', ['categorydata'=>$categorydata]);
      echo view('customer/checkout', ['cart' => $cart, 'total' => $total]);
      echo view('customer/footer');
    }

    public function login()
    {
        $categoryModel = new CategoryModel();
        $categorydata = $categoryModel->findAll();
        $loggedIn = false;
        $cart = session()->get('cart');

        $total = 0; // Initialize the total amount

        // Calculate the total by summing up the prices of items in the cart
        foreach ($cart as $product) {
            $total += $product['price']* $product['qty'];
        }

        if ($this->request->getMethod() === 'post') {
            // Validate the user's input here (e.g., username and password).

            $usermodel = new UsersModel();
            $userdata = $usermodel->where('email', $this->request->getVar('email'))
                          ->first();

            if ($userdata!=null) {
                if ($userdata['password'] == $this->request->getVar('password')) {
                   session()->set('user_id', $userdata['id']);
                   $loggedIn = true;
                 } else {
                   session()->setFlashdata('usererror', 'Invalid email or password');
                   return redirect()->to('customerdash/login');
                 }
            } else {
                session()->setFlashdata('usererror', 'Invalid email or password');
                return redirect()->to('customerdash/login');
            }
        }
        echo view('customer/header', ['categorydata'=>$categorydata]);
        echo view('customer/checkout', ['cart' => $cart, 'total' => $total, 'loggedIn' => $loggedIn]);
        echo view('customer/footer');
    }

    public function register(){
      $categoryModel = new CategoryModel();
      $categorydata = $categoryModel->findAll();
      $loggedIn = false;
      $cart = session()->get('cart');

      $total = 0; // Initialize the total amount

      // Calculate the total by summing up the prices of items in the cart
      foreach ($cart as $product) {
          $total += $product['price']* $product['qty'];
      }

      if ($this->request->getMethod() === 'post') {
        $usermodel = new UsersModel();

        $userdata = [
              'name'    => $this->request->getPost('name'),
              'email'   => $this->request->getPost('email'),
              'mobile'  => $this->request->getPost('mobile'),
              'password' => $this->request->getPost('password'),
              'added_on' => date('Y-m-d H:i:s')
            ];

        if ($usermodel->save($userdata)) {
            $loggedIn = true;
        } else {
            session()->setFlashdata('error', 'Failed to register. Please try again.');
            return redirect()->to('customeruser/login');
        }
      }

      echo view('customer/header', ['categorydata'=>$categorydata]);
      echo view('customer/checkout', ['cart' => $cart, 'total' => $total, 'loggedIn' => $loggedIn]);
      echo view('customer/footer');
    }

    public function info(){
      $categoryModel = new CategoryModel();
      $categorydata = $categoryModel->findAll();
      $user_id = session()->get('user_id');
      $cart = session()->get('cart');
      $loggedIn = false;

      $total = 0; // Initialize the total amount
      // Calculate the total by summing up the prices of items in the cart
      foreach ($cart as $product) {
          $total += $product['price']* $product['qty'];
      }

      if ($this->request->getMethod() === 'post') {
            // Form submitted, process order data and store in the database
            $orderModel = new OrderModel();
            $orderdetailModel = new OrderDetailModel();
            $orderStatusModel = new OrderStatusModel();

            $data = [
                'user_id' => $user_id,
                'address' => $this->request->getPost('address'),
                'city' => $this->request->getPost('city'),
                'pincode' => $this->request->getPost('pincode'),
                'payment_type' => $this->request->getPost('payment_type'),
                'total_price' => $total,
                'payment_status'=> 'success',
                'order_status'=> 1,
                'added_on' => date('Y-m-d H:i:s')
                // You may also need to add the user ID or other relevant data here
            ];

            // Insert order data into the database
            $orderModel->insert($data);

            // Retrieve the last inserted order ID
            $order_id = $orderModel->getInsertID();

            // Create and insert order detail records for each product in the cart
            foreach ($cart as $product) {
                $orderDetailData = [
                    'order_id' => $order_id,
                    'product_id' => $product['id'],
                    'qty' => $product['qty'],
                    'price' => $product['price'],
                    'added_on' => date('Y-m-d H:i:s')
                ];
                $orderdetailModel->insert($orderDetailData);
            }

            // You can also clear the cart data if needed
            session()->remove('cart');

            // Optionally, redirect to a thank you page or any other page
            return redirect()->to('CustomerDash/thankyou');
        }

      echo view('customer/header', ['categorydata'=>$categorydata]);
      echo view('customer/checkout', ['cart' => $cart, 'total' => $total, 'loggedIn' => $loggedIn]);
      echo view('customer/footer');
    }

    public function thankyou(){
      $categoryModel = new CategoryModel();
      $categorydata = $categoryModel->findAll();

      echo view('customer/header', ['categorydata'=>$categorydata]);
      echo view('customer/thankyou');
      echo view('customer/footer');
    }

    public function order()
    {
        $categoryModel = new CategoryModel();
        $categorydata = $categoryModel->findAll();
        $user_id = session()->get('user_id');

        $orderModel = new OrderModel();
        $orderdetailModel = new OrderDetailModel();
        $orderStatusModel = new OrderStatusModel();

        // Retrieve orders for the user
        $orderHistory = $orderModel->where('user_id', $user_id)->findAll();

        // Create a mapping array for order status IDs to their corresponding names
        $orderStatusMapping = [];

        // Retrieve all order statuses from the database
        $orderStatuses = $orderStatusModel->findAll();

        // Populate the mapping array
        foreach ($orderStatuses as $status) {
            $orderStatusMapping[$status['id']] = $status['name'];
        }

        // For each order, retrieve the associated order details
        foreach ($orderHistory as &$order) {
            $order_id = $order['id']; // Assuming the 'id' field in the 'order' table is the primary key
            $order_details = $orderdetailModel->where('order_id', $order_id)->findAll();
            // Create an array to store the product_ids
            $product_ids = [];

            // Retrieve product_ids from order details
            foreach ($order_details as $order_detail) {
                $product_ids[] = $order_detail['product_id'];
            }
            // Assign the product_ids to the order
            $order['product_ids'] = $product_ids;

            // Check if the order status ID exists in the mapping array before accessing it
            if (isset($orderStatusMapping[$order['order_status']])) {
                $order['order_status'] = $orderStatusMapping[$order['order_status']];
            } else {
                // Handle the case where the order status ID is not found
                $order['order_status'] = 'Unknown Status';
            }
        }

        echo view('customer/header', ['categorydata' => $categorydata]);
        echo view('customer/order', ['orderHistory' => $orderHistory]);
        echo view('customer/footer');
    }

    public function orderdetail($order_id, $product_id){
      $categoryModel = new CategoryModel();
      $categorydata = $categoryModel->findAll();

      $orderdetailModel = new OrderDetailModel();
      // Retrieve the specific order detail for the given order_id and product_id
      $orderDetail = $orderdetailModel->where('order_id', $order_id)->where('product_id', $product_id)->first();

      // Now, for each order detail, retrieve the associated product information
      $productModel = new ProductModel();
      $product = $productModel->find($product_id);

      // Add product information to the order detail
      $orderDetail['name'] = $product['name'];
      $orderDetail['image'] = $product['image'];
      // Calculate the total price for this order detail
      $orderDetail['total_price'] = $orderDetail['qty'] * $orderDetail['price'];


      echo view('customer/header', ['categorydata'=>$categorydata]);
      echo view('customer/orderdetail', ['orderDetail' => $orderDetail]);
      echo view('customer/footer');
    }

    public function search(){
      $categoryModel = new CategoryModel();
      $categorydata = $categoryModel->findAll();

      // Get the user's search input from the GET request
      $search = $this->request->getPost('search');
      // Load the ProductModel
      $productModel = new ProductModel();
      // Fetch products based on the search input
      $productdata = $productModel->like('name', $search)->findAll();

      echo view('customer/header', ['categorydata'=>$categorydata]);
      echo view('customer/search', ['productdata' => $productdata, 'search'=>$search]);
      echo view('customer/footer');
    }
}
