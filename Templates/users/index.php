<!-- users/index.php -->
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
                <td><?php echo $user->getUsername(); ?></td>
                <td><?php echo $user->getRole(); ?></td>
                <td>
                    <form action="/users/delete/<?php echo $user->getId(); ?>" method="post">
                        <button type="submit">Delete</button>
                    </form>
                    <a href="/users/edit/<?php echo $user->getId(); ?>">Edit</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
