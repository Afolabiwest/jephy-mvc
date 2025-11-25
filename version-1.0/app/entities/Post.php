<?php
class Post extends Entity
{
    protected $table = 'posts';
    
    public $id;
    public $title;
    public $content;
    public $user_id;
    public $status;
    public $created_at;
    public $updated_at;
    
    public function getUser()
    {
        return User::find($this->user_id);
    }
    
    public function getComments()
    {
        return Comment::where('post_id', $this->id)->orderBy('created_at', 'DESC')->get();
    }
    
    public function publish()
    {
        $this->status = 'published';
        return $this->save();
    }
}