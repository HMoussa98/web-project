<!-- users/index.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table th, table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        table td {
            vertical-align: middle;
        }
        .actions {
            white-space: nowrap;
        }
        .actions form,
        .actions a {
            margin-right: 10px;
            margin-bottom: 4px; /* Added 4px spacing */
        }
        .actions button,
        .actions a {
            padding: 5px 10px;
            text-decoration: none;
            border: none;
            background-color: #007bff;
            color: #fff;
            border-radius: 3px;
            cursor: pointer;
        }
        .actions button:hover,
        .actions a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>User List</h1>

    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo $user->getId(); ?></td>
                <td><?php echo htmlspecialchars($user->getUsername()); ?></td>
                <td><?php echo $user->getRole(); ?></td>
                <td class="actions">
                    <form onsubmit="return confirm('Are you sure you want to delete this User?');" action="/users/delete/<?php echo $user->getId(); ?>" method="post">
                        <button type="submit">Delete</button>
                    </form>
                    <a href="/users/edit/<?php echo $user->getId(); ?>">Edit</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
