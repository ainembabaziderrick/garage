<?php
session_start();
include 'db.php';

// Fetch roles and permissions
$rolesQuery = "SELECT * FROM roles";
$rolesResult = $connection->query($rolesQuery);

$permissionsQuery = "SELECT * FROM permissions";
$permissionsResult = $connection->query($permissionsQuery);

// Handle role and permission assignment
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id'];
    $role_id = $_POST['role_id'];
    $permissions = $_POST['permissions'] ?? [];

    // Assign role to user
    $assignRoleQuery = "INSERT INTO user_roles (user_id, role_id) VALUES ('$user_id', '$role_id')
                        ON DUPLICATE KEY UPDATE role_id = '$role_id'";
    $connection->query($assignRoleQuery);

    // Assign permissions to role
    $deletePermissionsQuery = "DELETE FROM role_permissions WHERE role_id = '$role_id'";
    $connection->query($deletePermissionsQuery);

    foreach ($permissions as $permission_id) {
        $assignPermissionQuery = "INSERT INTO role_permissions (role_id, permission_id) VALUES ('$role_id', '$permission_id')";
        $connection->query($assignPermissionQuery);
    }

    $_SESSION['success'] = "Roles and permissions updated successfully.";
    header('Location: roles_permissions.php');
    exit();
}
?>

<?php include 'includes/head.php'; ?>

<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <?php include 'includes/header.php'; ?>
    <?php include 'includes/sidebar.php'; ?>

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Assign Roles & Permissions</h1>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <?php if (isset($_SESSION['success'])) : ?>
                    <div class="alert alert-success">
                        <?= $_SESSION['success']; unset($_SESSION['success']); ?>
                    </div>
                <?php endif; ?>

                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Assign Role and Permissions</h3>
                            </div>
                            <div class="card-body">
                                <form method="POST">
                                    <div class="form-group">
                                        <label for="user_id">Select User:</label>
                                        <select name="user_id" id="user_id" class="form-control" required>
                                            <option value="">Select a User</option>
                                            <?php
                                            $usersQuery = "SELECT id, first_name FROM users";
                                            $usersResult = $connection->query($usersQuery);
                                            while ($user = $usersResult->fetch_assoc()) {
                                                echo "<option value='{$user['id']}'>{$user['first_name']}</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="role_id">Select Role:</label>
                                        <select name="role_id" id="role_id" class="form-control" required>
                                            <option value="">Select a Role</option>
                                            <?php while ($role = $rolesResult->fetch_assoc()) : ?>
                                                <option value="<?= $role['id'] ?>"><?= $role['role_name'] ?></option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="permissions">Select Permissions:</label>
                                        <div>
                                            <?php while ($permission = $permissionsResult->fetch_assoc()) : ?>
                                                <label>
                                                    <input type="checkbox" name="permissions[]" value="<?= $permission['id'] ?>">
                                                    <?= $permission['permission_name'] ?>
                                                </label><br>
                                            <?php endwhile; ?>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Assign</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Assigned Roles & Permissions</h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>User</th>
                                            <th>Role</th>
                                            <th>Permissions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $assignedQuery = "SELECT u.username, r.role_name, GROUP_CONCAT(p.permission_name) as permissions
                                                          FROM user_roles ur
                                                          JOIN users u ON ur.user_id = u.id
                                                          JOIN roles r ON ur.role_id = r.id
                                                          LEFT JOIN role_permissions rp ON r.id = rp.role_id
                                                          LEFT JOIN permissions p ON rp.permission_id = p.id
                                                          GROUP BY u.id";
                                        $assignedResult = $connection->query($assignedQuery);

                                        while ($row = $assignedResult->fetch_assoc()) : ?>
                                            <tr>
                                                <td><?= htmlspecialchars($row['username']) ?></td>
                                                <td><?= htmlspecialchars($row['role_name']) ?></td>
                                                <td><?= htmlspecialchars($row['permissions']) ?></td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>

    <?php include 'includes/footer.php'; ?>
</div>

<?php include 'includes/scripts.php'; ?>
</body>
</html>
