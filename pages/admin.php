<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once '../php/sql_connect.php';
include_once '../php/user.php';

$user = new User($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_User'])) {
    $update_data = [
        'id' => $_POST['user_id'],
        'username' => htmlspecialchars($_POST['username']),
        'email' => htmlspecialchars($_POST['email']),
        'admin' => isset($_POST['admin']) ? 1 : 0,
        'contentmanager' => isset($_POST['contentmanager']) ? 1 : 0
    ];

    $result = $user->updateUser($update_data);

    if ($result) {
        $_SESSION['success_message'] = "User updated successfully.";
    } else {
        $_SESSION['error_message'] = "Failed to update the user.";
    }

    header('Location: admin.php');
    exit();
}

if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $result = $user->deleteUser($delete_id);

    if ($result) {
        $_SESSION['success_message'] = "User deleted successfully.";
    } else {
        $_SESSION['error_message'] = "Failed to delete the user.";
    }

    header('Location: admin.php');
    exit();
}

$users = $user->getAllUsers();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Users</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/custom.css">
    <script>
        function confirmDelete(userId) {
            if (confirm('Are you sure you want to delete this user?')) {
                window.location.href = 'admin.php?delete_id=' + userId;
            }
        }
    </script>
</head>
<body class="bodyadminpage">
    <?php include_once '../php/navTop.php'; ?>
    <?php include_once '../php/navLeft.php'; ?>
    <main>
        <h1>User Management</h1>

        <?php if (isset($_SESSION['success_message'])): ?>
            <div class="success-message"><?php echo $_SESSION['success_message']; ?></div>
            <?php unset($_SESSION['success_message']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['error_message'])): ?>
            <div class="error-message"><?php echo $_SESSION['error_message']; ?></div>
            <?php unset($_SESSION['error_message']); ?>
        <?php endif; ?>

        <table class="user-table">
            <thead>
                <tr>
                    <th>GebruikersID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Admin</th>
                    <th>Content Manager</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($user['id']); ?></td>
                        <td>
                            <form method="post" action="admin.php">
                                <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                <input type="text" name="username" value="<?php echo htmlspecialchars($user['username']); ?>">
                        </td>
                        <td>
                                <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>">
                        </td>
                        <td>
                                <input type="checkbox" name="admin" value="1" <?php echo $user['admin'] == 1 ? 'checked' : ''; ?>>
                        </td>
                        <td>
                                <input type="checkbox" name="contentmanager" value="1" <?php echo $user['contentmanager'] == 1 ? 'checked' : ''; ?>>
                        </td>
                        <td class="serie-actions">
                            <button class="updatebuttonadmin" type="submit" name="update_User">Update</button>
                            </form>
                            <a class="delete-link" href="javascript:void(0);" onclick="confirmDelete(<?php echo $user['id']; ?>)">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <?php if (empty($users)): ?>
            <p>No users found.</p>
        <?php endif; ?>
    </main>
</body>
</html>
