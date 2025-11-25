<?php
class UserController extends Controller
{
    public function registerForm()
    {
        $data = [
            'title' => 'Create Account'
        ];
        echo $this->render('users/register.tpl', $data);
    }
    
    public function register()
    {
        if ($_POST) {
            // Simple registration logic
            $this->json([
                'success' => true, 
                'message' => 'Registration successful!',
                'redirect' => '/'
            ]);
        } else {
            $this->redirect('/register');
        }
    }
    
    public function loginForm()
    {
        $data = [
            'title' => 'Login'
        ];
        echo $this->render('users/login.tpl', $data);
    }
    
    public function login()
    {
        if ($_POST) {
            // Simple login logic
            $this->json([
                'success' => true, 
                'message' => 'Login successful!',
                'redirect' => '/'
            ]);
        } else {
            $this->redirect('/login');
        }
    }
}