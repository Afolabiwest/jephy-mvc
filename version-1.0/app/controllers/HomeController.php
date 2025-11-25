<?php
class HomeController extends Controller
{
    public function index()
    {
        // Basic data
        $data = [
            'title' => 'Welcome to Our Store',
            'message' => 'Hello from our custom MVC framework!'
        ];
        
        // Let hooks modify the data
        $data = $this->hooks->exec('homepageData', $data);
        
        echo $this->render('home.tpl', $data);
    }
    
    public function about()
    {
        $data = [
            'title' => 'About Us',
            'content' => 'This is the about page.'
        ];
        
        echo $this->render('about.tpl', $data);
    }
    
    public function contact()
    {
        $data = [
            'title' => 'Contact Us'
        ];
        
        echo $this->render('contact.tpl', $data);
    }
}