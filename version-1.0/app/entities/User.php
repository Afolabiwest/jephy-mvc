<?php
class User extends Entity
{
    protected $table = 'users';
    protected $primaryKey = 'user_id';
    
    public $user_id;
    public $username;
    public $email;
    public $password;
    public $created_at;
    public $updated_at;
    
    public function setPassword($password)
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }
    
    public function verifyPassword($password)
    {
        return password_verify($password, $this->password);
    }
    
    public function getPosts()
    {
        return Post::where('user_id', $this->user_id)->get();
    }
}