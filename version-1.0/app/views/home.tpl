<!DOCTYPE html>
<html>
<head>
    <title>{$title|default:'Welcome'}</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        .container { max-width: 800px; margin: 0 auto; }
    </style>
</head>
<body>
    <div class="container">
        <h1>{$title|default:'Welcome to Our Framework'}</h1>
        <p>{$message|default:'Hello from our custom MVC framework!'}</p>
        
        {* Safe variable access with defaults *}
        <p>Welcome message: {$welcome_message|default:'Default welcome message'}</p>
        <p>Current time: {$current_time|default:'Time not available'}</p>
        
        <nav>
            <a href="/">Home</a> | 
            <a href="/about">About</a> | 
            <a href="/contact">Contact</a> |
            <a href="/products">Products</a> |
            <a href="/register">Register</a> |
            <a href="/login">Login</a>
        </nav>
        
        <footer>
            &copy; {$current_year|default:2024} {$base_url|default:'http://localhost'}
        </footer>
    </div>
</body>
</html>