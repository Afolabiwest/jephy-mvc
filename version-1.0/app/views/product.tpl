<!DOCTYPE html>
<html>
<head>
    <title>{$product.name}</title>
</head>
<body>
    <h1>{$product.name}</h1>
    <p>Price: {$product.formatted_price}</p>
    <p>Price with VAT: ${$product.price_with_vat|number_format:2}</p>
    <p>{$product.description}</p>
    
    {hook name='productAdditionalInfo'}
    
    <form method="POST" action="{$base_url}/product/{$product.id}/comment">
        <textarea name="comment" placeholder="Add a comment"></textarea>
        <button type="submit">Submit Comment</button>
    </form>
</body>
</html>