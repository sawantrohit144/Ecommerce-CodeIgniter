<?php

namespace App\Controllers;
use App\Models\CustomerUsersModel;
use App\Models\CategoryModel;
use App\Models\ProductModel;
use App\Models\UsersModel;

class CustomerUser extends BaseController
{
  public function login()
  {
      $categoryModel = new CategoryModel();
      $categorydata = $categoryModel->findAll();

      if ($this->request->getMethod() === 'post') {
          // Validate the user's input here (e.g., username and password).

          $usermodel = new UsersModel();
          $userdata = $usermodel->where('email', $this->request->getVar('email'))
                        ->first();

          if ($userdata!=null) {
              if ($userdata['password'] == $this->request->getVar('password')) {
                 session()->set('user_id', $userdata['id']);
                 return redirect()->to('CustomerDash/dash');
               } else {
                 session()->setFlashdata('usererror', 'Invalid email or password');
                 return redirect()->to('customeruser/login');
               }
          } else {
              session()->setFlashdata('usererror', 'Invalid email or password');
              return redirect()->to('customeruser/login');
          }
      }
      echo view('customer/header', ['categorydata'=>$categorydata]);
      echo view('customer/login');
      echo view('customer/footer');
  }

  public function registration(){
    $categoryModel = new CategoryModel();
    $categorydata = $categoryModel->findAll();

    $usermodel = new UsersModel();

    $userdata = [
          'name'    => $this->request->getPost('name'),
          'email'   => $this->request->getPost('email'),
          'mobile'  => $this->request->getPost('mobile'),
          'password' => $this->request->getPost('password'),
          'added_on' => date('Y-m-d H:i:s')
        ];

    if ($usermodel->save($userdata)) {
        session()->setFlashdata('success', 'Registerd successfully.');
        return redirect()->to('customeruser/login');
    } else {
        session()->setFlashdata('error', 'Failed to register. Please try again.');
        return redirect()->to('customeruser/login');
    }

    echo view('customer/header', ['categorydata'=>$categorydata]);
    echo view('customer/contactus');
    echo view('customer/footer');
  }

  public function logout()
  {
    session()->remove('user_id');
    return redirect()->to('customeruser/login');
  }
}

 ?>
