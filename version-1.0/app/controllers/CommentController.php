<?php
// In CommentController.php
class CommentController extends Controller
{
    public function addComment($postId)
    {
        $comment = $_POST['comment'];
        
        // Check if hooks allow this comment
        $result = $this->hooks->exec('beforeAddComment', [
            'post_id' => $postId,
            'comment' => $comment,
            'user_id' => $_SESSION['user_id']
        ]);
        
        // If any hook returns false, block the action
        if ($result === false) {
            $this->json(['error' => 'Comment not allowed']);
            return;
        }
        
        // Save comment normally
        $commentModel = new Comment();
        $commentModel->content = $comment;
        $commentModel->save();
        
        $this->json(['success' => true]);
    }
}

// In SecurityHooks.php
class SecurityHooks
{
    public function registerHooks($hooks)
    {
        $hooks->registerHook('beforeAddComment', [$this, 'checkForSpam']);
        $hooks->registerHook('beforeAddComment', [$this, 'checkUserPermissions']);
    }
    
    public function checkForSpam($params)
    {
        $bannedWords = ['spam', 'http://', 'viagra', 'casino'];
        
        foreach ($bannedWords as $word) {
            if (stripos($params['comment'], $word) !== false) {
                // This will block the comment from being saved
                return false;
            }
        }
        
        return $params;
    }
    
    public function checkUserPermissions($params)
    {
        // Check if user is banned
        $user = User::find($params['user_id']);
        if ($user && $user->is_banned) {
            return false; // Block the action
        }
        
        return $params;
    }
}