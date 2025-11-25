<!DOCTYPE html>
<html>
<head>
    <title>{$title|default:'Contact'}</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        .container { max-width: 800px; margin: 0 auto; }
    </style>
</head>
<body>
    <div class="container">
        <h1>{$title|default:'Contact Us'}</h1>
        <p>Contact form would go here.</p>
        <a href="/">← Back to Home</a>
        
        <footer>
            &copy; {$current_year|default:2024} {$base_url|default:'http://localhost'}
        </footer>
    </div>
</body>
</html>