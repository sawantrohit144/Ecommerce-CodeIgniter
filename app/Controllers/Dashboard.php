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

class Dashboard extends BaseController
{
    public function dash()
    {
        // Your dashboard logic here
        echo view('admin/header');
        echo view('admin/panel');
        echo view('admin/footer');
    }

    ###################### Categories ######################
    public function categories(){
      $model = new CategoryModel();
      $data = $model->findAll(); // Retrieve all categories

      echo view('admin/header');
      echo view('admin/categories', ['data'=>$data]);
      echo view('admin/footer');
    }

    public function addcategories()
    {
        $model = new CategoryModel();
        echo view('admin/header');
        $data = [];

        if ($this->request->getMethod() === 'post') {
            $newCategoryName = $this->request->getVar('categories');

            // Check if the new category name already exists
            $existingCategory = $model->where('categories', $newCategoryName)->first();

            if ($existingCategory) {
                // Show an error message indicating that the category already exists
                $data['error'] = 'Category already exists';
            } else {
                // Insert the new category if it doesn't exist
                $data = ['categories' => $newCategoryName];
                $model->insert($data);
                return redirect()->to('dashboard/categories');
            }
        }

        echo view('admin/addcategories', $data);
        echo view('admin/footer');
    }

    public function deletecategory($id)
    {
        $categoryModel = new CategoryModel();
        $categoryModel->delete($id);

        return redirect()->to('dashboard/categories'); // Redirect to your category list page
    }
    public function updatecategory($id)
    {
        $categoryModel = new CategoryModel();
        $data['category'] = $categoryModel->find($id);

        if ($this->request->getMethod() === 'post') {
            $updatedCategoryName = $this->request->getVar('categories');

            // Check if the updated category name already exists
            $existingCategory = $categoryModel->where('categories', $updatedCategoryName)
                                             ->where('id !=', $id) // Exclude the current category
                                             ->first();

            if ($existingCategory) {
                // Show an error message indicating that the category already exists
                $data['error'] = 'Category already exists';
            } else {
                // Update the category if it doesn't exist
                $categoryModel->update($id, ['categories' => $updatedCategoryName]);
                return redirect()->to('/dashboard/categories'); // Redirect to the dashboard or category list page
            }
        }

        echo view('admin/header');
        echo view('admin/updatecategory',$data);
        echo view('admin/footer');
    }


    ######################### Product ######################################

    public function product(){
      $model = new ProductModel();
      $data = $model
        ->select('product.*, categories.categories as category_name')
        ->join('categories', 'product.categories_id = categories.id')
        ->findAll();

      echo view('admin/header');
      echo view('admin/products', ['data'=>$data]);
      echo view('admin/footer');
    }

    public function addproduct()
    {
        $categoryModel = new CategoryModel();
        $data = $categoryModel->findAll();
        $fileerror = "";
        $error = " ";

        if ($this->request->getMethod() === 'post') {
            // Handle form submission
            $productModel = new ProductModel();

            $productData = [
                'categories_id' => $this->request->getPost('categories_id'),
                'name' => $this->request->getPost('name'),
                'mrp' => $this->request->getPost('mrp'),
                'price' => $this->request->getPost('price'),
                'qty' => $this->request->getPost('qty'),
                'short_desc' => $this->request->getPost('short_desc'),
                'description' => $this->request->getPost('description'),
                'meta_title' => $this->request->getPost('meta_title'),
                'meta_desc' => $this->request->getPost('meta_desc'),
                'meta_keyword' => $this->request->getPost('meta_keyword'),
            ];

            // Check if a product with the same name already exists in the selected category
            $existingProduct = $productModel->where('categories_id', $productData['categories_id'])
                ->where('name', $productData['name'])
                ->first();

            if ($existingProduct) {
                // Product with the same name already exists in the category
                $error = "A product with the same name already exists in the selected category.";
            } else {
                // Handle image upload
                if ($this->validate([
                    'image' => 'uploaded[image]|is_image[image]',
                ])) {
                    $image = $this->request->getFile('image');

                    if ($image->getSize() > 1024 * 1024) {
                        // Image size exceeds 1 MB
                        $fileerror = "The uploaded image exceeds the maximum allowed size of 1 MB.";
                    } else {
                      $imageName = $image->getRandomName();
                      $image->move(ROOTPATH . 'public/uploads', $imageName);

                      $productData['image'] = $imageName;

                      if ($productModel->insert($productData)) {
                          // Data saved successfully
                          return redirect()->to('dashboard/product');
                      } else {
                          // Data saving failed
                          $error = "Failed to save the product data.";
                      }
                    }
                } else {
                    // If no image was provided, set a default or placeholder image
                    $productData['image'] = 'default_image.jpg'; // Replace with your default image filename
                }
            }
        }

        echo view('admin/header');
        echo view('admin/addproduct', ['data' => $data, 'error' => $error, 'fileerror' => $fileerror]);
        echo view('admin/footer');
   }




    public function deleteproduct($id){
      $model = new ProductModel();
      $model->delete($id);

      return redirect()->to('dashboard/product'); // R
    }

    public function updateProduct($id)
    {
        // Load your ProductModel
        $productModel = new ProductModel();
        $categorymodel = new CategoryModel();
        $datacategory = $categorymodel->findAll();
        $error = " ";

        // Retrieve the existing product data
        $dataproduct = $productModel->find($id);

        if ($this->request->getMethod() === 'post') {

            // Check if the product name already exists in the same category
            $existingProduct = $productModel->where('name', $this->request->getVar('name'))
                ->where('categories_id', $this->request->getVar('categories_id'))
                ->where('id !=', $id) // Exclude the current product being updated
                ->first();

            if ($existingProduct) {
                $error = "Product with the same name in the same category already exists.";
            } else {
                // Prepare the data to be updated
                $productData = [
                    'categories_id' => $this->request->getVar('categories_id'),
                    'name' => $this->request->getVar('name'),
                    'mrp' => $this->request->getVar('mrp'),
                    'price' => $this->request->getVar('price'),
                    'qty' => $this->request->getVar('qty'),
                    'short_desc' => $this->request->getVar('short_desc'),
                    'description' => $this->request->getVar('description'),
                    'meta_title' => $this->request->getVar('meta_title'),
                    'meta_desc' => $this->request->getVar('meta_desc'),
                    'meta_keyword' => $this->request->getVar('meta_keyword'),
                ];

                // Handle image upload
                $imageFile = $this->request->getFile('image');

                if ($imageFile && $imageFile->isValid() && !$imageFile->hasMoved()) {
                    // Generate a new file name or use the existing one
                    $newImageName = $imageFile->getRandomName();
                    $imageFile->move(ROOTPATH . 'public/uploads', $newImageName);

                    // Update the product data with the new image name
                    $productData['image'] = $newImageName;
                }

                // Update the product
                $productModel->update($id, $productData);

                return redirect()->to('dashboard/product');
            }
        }

        echo view('admin/header');
        echo view('admin/updateproduct', ['datacategory'=>$datacategory,'error'=>$error, 'dataproduct' => $dataproduct] );
        echo view('admin/footer');
    }

    ###################### users ######################
    public function users(){
      $model = new UsersModel();
      $data = $model->findAll(); // Retrieve all users

      echo view('admin/header');
      echo view('admin/users', ['data'=>$data]);
      echo view('admin/footer');
    }

    public function deleteuser($id){
      $model = new UsersModel();
      $model->delete($id);

      return redirect()->to('dashboard/users');
    }

    ###################### contact us ######################
    public function contactus(){
      $model = new ContactModel();
      $data = $model->findAll(); // Retrieve all users

      echo view('admin/header');
      echo view('admin/contactus', ['data'=>$data]);
      echo view('admin/footer');
    }

    public function deletecomment($id){
      $model = new ContactModel();
      $model->delete($id);

      return redirect()->to('dashboard/contactus');
    }

    public function order()
    {
        $orderModel = new OrderModel();
        $orderdetailModel = new OrderDetailModel();
        $orderStatusModel = new OrderStatusModel();

        // Fetch all orders along with their order_status names
        $orders = $orderModel->findAll();
        $data['orders'] = [];

        foreach ($orders as $order) {
            $orderStatus = $orderStatusModel->find($order['order_status']);
            if ($orderStatus) {
                $order['order_status'] = $orderStatus['name'];
            }

            $data['orders'][] = $order;
        }

        echo view('admin/header');
        echo view('admin/order', $data); // Pass the $data array to the view
        echo view('admin/footer');
    }

    public function orderdetail($orderId)
    {
        $orderModel = new OrderModel();
        $orderdetailModel = new OrderDetailModel();
        $productModel = new ProductModel();
        $orderStatusModel = new OrderStatusModel(); // Replace 'OrderStatusModel' with the actual model name for your order status table

        // Fetch the order details by ID
        $order = $orderModel->find($orderId);

        if ($order) {
          // Check if the form is submitted
          if ($this->request->getPost('update_order_status')) {
              $newStatusId = $this->request->getPost('update_order_status');

              // Update the order status
            $orderModel->update($order['id'], ['order_status' => $newStatusId]);

              // Optional: You can add a success message or redirect the user to a different page
              return redirect()->to('dashboard/order');
          }

          // Fetch the order status name
        $orderStatusId = $order['order_status'];
        $orderStatus = $orderStatusModel->find($orderStatusId)['name'];


        // Fetch the order details associated with this order
        $orderDetails = $orderdetailModel->where('order_id', $orderId)->findAll();
        // Initialize the total price
        $totalPrice = 0;

        // Fetch product data for each order detail
        foreach ($orderDetails as &$orderDetail) {
            $product = $productModel->find($orderDetail['product_id']);
            if ($product) {
                $orderDetail['product_name'] = $product['name'];
                $orderDetail['product_image'] = $product['image'];
                $totalPrice += $orderDetail['price'] * $orderDetail['qty'];
            } else {
                // Handle the case where the product is not found
                $orderDetail['product_name'] = 'Product Not Found';
                $orderDetail['product_image'] = 'image_not_found.jpg';
            }
        }

        // Fetch address and order status
        $address = $order['address']; // Change 'address' to the actual field in your database
        $orderStatusId = $order['order_status']; // Change 'status' to the actual field in your database
        $pincode = $order['pincode']; // Change 'status' to the actual field in your database

        // Fetch the order status name
        $orderStatus = $orderStatusModel->find($orderStatusId)['name'];
        // Fetch the order status options
        $orderStatusOptions = $orderStatusModel->findAll(); // Fetch all order status options

        // Pass the data to the view
        $data = [
            'order' => $order,
            'orderDetails' => $orderDetails,
            'totalPrice' => $totalPrice,
            'address' => $address,
            'orderStatus' => $orderStatus,
            'orderStatusOptions' => $orderStatusOptions,
            'pincode' => $pincode
        ];

        echo view('admin/header');
        echo view('admin/orderdetail', $data); // Pass the $data array to the view
        echo view('admin/footer');
        } else {
            // Handle the case where the order is not found
            return "Order not found!";
        }
    }

    public function updateorderstatus(){
      $orderModel = new OrderModel();
      $orderStatusModel = new OrderStatusModel();


      echo view('admin/header');
      echo view('admin/orderdetail',);
      echo view('admin/footer');
    }

}
