<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create User</title>
</head>
<body>
    <h1>Create New User</h1>
    <form action="/user-create" method="POST">
        @csrf
        <input name="name">
        <input type="email" name="email">
        <button type="submit">Submit</button>
    </form>
</body>
</html>
