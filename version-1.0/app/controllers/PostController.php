<?php
class PostController extends Controller
{
    public function index()
    {
        $posts = Post::where('status', 'published')
            ->orderBy('created_at', 'DESC')
            ->limit(10)
            ->get();
        
        echo $this->render('posts/index.tpl', [
            'posts' => $posts
        ]);
    }
    
    public function show($id)
    {
        $post = Post::find($id);
        
        if (!$post) {
            throw new Exception('Post not found');
        }
        
        $comments = $post->getComments();
        
        echo $this->render('posts/show.tpl', [
            'post' => $post,
            'comments' => $comments
        ]);
    }
    
    public function create()
    {
        if ($_POST) {
            $post = new Post();
            $post->title = $_POST['title'];
            $post->content = $_POST['content'];
            $post->user_id = $_SESSION['user_id'] ?? 1;
            $post->status = 'draft';
            
            if ($post->save()) {
                // Execute after post creation hook
                $this->hooks->exec('afterPostCreate', [
                    'post' => $post,
                    'post_id' => $post->id
                ]);
                
                header('Location: /post/' . $post->id);
            }
        }
        
        echo $this->render('posts/create.tpl');
    }
}