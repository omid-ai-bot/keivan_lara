<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
</head>
<body>
    <h1>Welcome to {{ config('app.name') }}</h1>
    <h2>Menu</h2>
    <ul>
        <li>Espresso - $2.50</li>
        <li>Latte - $3.00</li>
        <li>Cappuccino - $3.50</li>
        <li>Mocha - $3.75</li>
    </ul>
</body>
</html>
