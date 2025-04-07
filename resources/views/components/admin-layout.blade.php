<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    @vite(['resources/css/app.css'])
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>

<nav>
    <x-nav-link href="/admin" :active="request()->is('admin')">Users</x-nav-link>
    <x-nav-link href="/admin/products" :active="request()->is('admin/products')">Products</x-nav-link>
    <x-nav-link href="/admin/reviews" :active="request()->is('admin/reviews')">Reviews</x-nav-link>
    <x-nav-link href="/admin/orders" :active="request()->is('admin/orders')">Orders</x-nav-link>

    @if(Auth::user()->role->name === 'admin')
        <x-nav-link href="/admin/categories" :active="request()->is('admin/categories')">Categories</x-nav-link>
        <x-nav-link href="/admin/roles" :active="request()->is('admin/roles')">Roles</x-nav-link>
        <x-nav-link href="/admin/user/roles" :active="request()->is('admin/user/roles')">User Roles</x-nav-link>
        <x-nav-link href="/admin/coupons" :active="request()->is('admin/coupons')">Coupons</x-nav-link>
    @endif



</nav>

<body>
<main>
    {{$slot}}
</main>
</body>

</html>
