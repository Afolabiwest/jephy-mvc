<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mailer
{
    private $mailer;
    private $config;
    private $hooks;
    
    public function __construct()
    {
        $this->config = require_once CONFIG_PATH . '/mail.php';
        $this->hooks = Framework::getHooks();
        $this->initialize();
    }
    
    private function initialize()
    {
        $this->mailer = new PHPMailer(true);
        
        // Server settings
        $this->mailer->isSMTP();
        $this->mailer->Host = $this->config['host'];
        $this->mailer->SMTPAuth = $this->config['smtp_auth'];
        $this->mailer->Username = $this->config['username'];
        $this->mailer->Password = $this->config['password'];
        $this->mailer->SMTPSecure = $this->config['encryption'];
        $this->mailer->Port = $this->config['port'];
        
        // Default from
        $this->mailer->setFrom($this->config['from']['address'], $this->config['from']['name']);
        
        // Default settings
        $this->mailer->isHTML($this->config['is_html']);
        $this->mailer->CharSet = $this->config['charset'];
    }
    
    public function send($to, $subject, $body, $attachments = [])
    {
        try {
            // Execute before send hook
            $mailData = $this->hooks->exec('beforeSendMail', [
                'to' => $to,
                'subject' => $subject,
                'body' => $body,
                'attachments' => $attachments
            ]);
            
            if ($mailData === false) {
                return false; // Hook prevented sending
            }
            
            // Extract modified data
            extract($mailData);
            
            // Clear previous recipients and attachments
            $this->mailer->clearAddresses();
            $this->mailer->clearAttachments();
            
            // Set recipients
            if (is_array($to)) {
                foreach ($to as $email => $name) {
                    if (is_numeric($email)) {
                        $this->mailer->addAddress($name);
                    } else {
                        $this->mailer->addAddress($email, $name);
                    }
                }
            } else {
                $this->mailer->addAddress($to);
            }
            
            // Set subject and body
            $this->mailer->Subject = $subject;
            $this->mailer->Body = $body;
            $this->mailer->AltBody = strip_tags($body);
            
            // Add attachments
            foreach ($attachments as $attachment) {
                if (is_array($attachment)) {
                    $this->mailer->addAttachment($attachment['path'], $attachment['name'] ?? '');
                } else {
                    $this->mailer->addAttachment($attachment);
                }
            }
            
            // Execute before final send hook
            $this->hooks->exec('onMailSend', [
                'mailer' => $this->mailer,
                'subject' => $subject
            ]);
            
            $result = $this->mailer->send();
            
            // Execute after send hook
            $this->hooks->exec('afterSendMail', [
                'to' => $to,
                'subject' => $subject,
                'success' => $result
            ]);
            
            return $result;
            
        } catch (Exception $e) {
            // Execute error hook
            $this->hooks->exec('onMailError', [
                'error' => $e->getMessage(),
                'to' => $to,
                'subject' => $subject
            ]);
            
            throw new Exception("Mailer Error: " . $e->getMessage());
        }
    }
    
    public function setFrom($email, $name = '')
    {
        $this->mailer->setFrom($email, $name);
        return $this;
    }
    
    public function addReplyTo($email, $name = '')
    {
        $this->mailer->addReplyTo($email, $name);
        return $this;
    }
    
    public function addCC($email, $name = '')
    {
        $this->mailer->addCC($email, $name);
        return $this;
    }
    
    public function addBCC($email, $name = '')
    {
        $this->mailer->addBCC($email, $name);
        return $this;
    }
    
    public function template($template, $data = [])
    {
        $smarty = Framework::getSmarty();
        
        // Assign data to template
        foreach ($data as $key => $value) {
            $smarty->assign($key, $value);
        }
        
        $templatePath = APP_PATH . "/views/emails/{$template}.tpl";
        
        if (!file_exists($templatePath)) {
            throw new Exception("Email template not found: {$templatePath}");
        }
        
        return $smarty->fetch($templatePath);
    }
    
    // Proxy method calls to PHPMailer
    public function __call($method, $args)
    {
        if (method_exists($this->mailer, $method)) {
            return call_user_func_array([$this->mailer, $method], $args);
        }
        
        throw new Exception("Method {$method} not found in Mailer");
    }
}