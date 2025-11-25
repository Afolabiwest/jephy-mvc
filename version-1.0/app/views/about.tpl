<!DOCTYPE html>
<html>
<head>
    <title>{$title|default:'About'}</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        .container { max-width: 800px; margin: 0 auto; }
    </style>
</head>
<body>
    <div class="container">
        <h1>{$title|default:'About Us'}</h1>
        <p>{$content|default:'This is the about page.'}</p>
        <a href="/">← Back to Home</a>
        
        <footer>
            &copy; {$current_year|default:2024} {$base_url|default:'http://localhost'}
        </footer>
    </div>
</body>
</html>