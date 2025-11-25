<?php
class Comment extends Entity
{
    protected $table = 'comments';
    
    public $id;
    public $post_id;
    public $user_id;
    public $content;
    public $created_at;
    
    public function getPost()
    {
        return Post::find($this->post_id);
    }
    
    public function getUser()
    {
        return User::find($this->user_id);
    }
}