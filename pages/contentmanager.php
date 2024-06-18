<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);


include_once '../php/sql_connect.php'; 
include_once '../php/user.class.php'; 

$seriesManager = new SeriesManager($conn); 


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_Serie'])) {
    $update_data = [
        'SerieID' => $_POST['SerieID'],
        'SerieTitel' => htmlspecialchars($_POST['SerieTitel']),
        'actief' => isset($_POST['actief']) ? 1 : 0
    ];

    $result = $seriesManager->updateSerie($update_data); 

    if ($result) {
        $_SESSION['success_message'] = "Series updated successfully.";
    } else {
        $_SESSION['error_message'] = "Failed to update the series.";
    }

    header('Location: contentmanager.php');
    exit();
}

if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $result = $seriesManager->deleteSerie($delete_id); 
    
    if ($result) {
        $_SESSION['success_message'] = "Series deleted successfully.";
    } else {
        $_SESSION['error_message'] = "Failed to delete the series.";
    }

    header('Location: contentmanager.php');
    exit();
}


$series = $seriesManager->getAllSeries(); 
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Content Manager - Series</title>
    <link rel="stylesheet" href="/css/style.css"> 
    <link rel="stylesheet" href="/css/custom.css"> 
    <?php include_once '../php/navTop.php'; ?>
    <?php include_once '../php/navLeft.php'; ?> 

</head>
<body>

<div class="content-manager">
    <h1 class="page-title">Serie Management</h1>

    <?php if (isset($_SESSION['success_message'])): ?>
        <div class="message success-message"><?php echo $_SESSION['success_message']; ?></div>
        <?php unset($_SESSION['success_message']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['error_message'])): ?>
        <div class="message error-message"><?php echo $_SESSION['error_message']; ?></div>
        <?php unset($_SESSION['error_message']); ?>
    <?php endif; ?>

    <table class="serie-table-content-manager">
     
        <tbody>
            <?php foreach ($series as $serie): ?>
                <tr>
                    <td><?php echo htmlspecialchars($serie['SerieID']); ?></td>
                    <td>
                        <form method="post" action="contentmanager.php">
                            <input type="hidden" name="SerieID" value="<?php echo $serie['SerieID']; ?>">
                            <input type="text" name="SerieTitel" value="<?php echo htmlspecialchars($serie['SerieTitel']); ?>">
                    </td>
                    <td>
                        <input type="checkbox" name="Actief" value="1" <?php echo $serie['Actief'] == 1 ? 'checked' : ''; ?>>
                    </td>
                    <td class="serie-actions">
                        <button class="updatebuttonadmin" type="submit" name="update_Serie">Update</button>
                        </form>
                        <a class="delete-link" href="contentmanager.php?delete_id=<?php echo $serie['SerieID']; ?>" onclick="return confirm('Are you sure you want to delete this series?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <?php if (empty($series)): ?>
        <p>No series found.</p>
    <?php endif; ?>
</div>

</body>
</html>
