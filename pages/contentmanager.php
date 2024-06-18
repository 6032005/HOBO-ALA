<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once '../php/sql_connect.php';
include_once '../php/user.php';

$seriesManager = new SeriesManager($conn);

// Handle series update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_Serie'])) {
    $update_data = [
        'SerieID' => $_POST['SerieID'],
        'SerieTitel' => isset($_POST['SerieTitel']) ? htmlspecialchars($_POST['SerieTitel']) : '',
        'IMDBLink' => isset($_POST['IMDBLink']) ? htmlspecialchars($_POST['IMDBLink']) : null,
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

// Handle series deletion
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

// Handle series insertion
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['insert_Serie'])) {
    $insert_data = [
        'SerieTitel' => isset($_POST['SerieTitel']) ? htmlspecialchars($_POST['SerieTitel']) : '',
        'IMDBLink' => isset($_POST['IMDBLink']) ? htmlspecialchars($_POST['IMDBLink']) : null,
        'Actief' => isset($_POST['actief']) ? 1 : 0
    ];

    $result = $seriesManager->insertSerie($insert_data);

    if ($result) {
        $_SESSION['success_message'] = "Series inserted successfully.";
    } else {
        $_SESSION['error_message'] = "Failed to insert the series.";
    }

    header('Location: contentmanager.php');
    exit();
}

// Fetch all series
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
    <style> </style>
    <?php include_once '../php/navTop.php'; ?>
    <?php include_once '../php/navLeft.php'; ?>
    <script>
        function confirmDelete(serieID) {
            if (confirm('Are you sure you want to delete this series?')) {
                window.location.href = 'contentmanager.php?delete_id=' + serieID;
            }
        }
    </script>
</head>
<body>

<div class="content-manager">
    <h1 class="page-title">Voeg Serie Toe</h1>

    <?php if (isset($_SESSION['success_message'])): ?>
        <div class="message success-message"><?php echo $_SESSION['success_message']; ?></div>
        <?php unset($_SESSION['success_message']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['error_message'])): ?>
        <div class="message error-message"><?php echo $_SESSION['error_message']; ?></div>
        <?php unset($_SESSION['error_message']); ?>
    <?php endif; ?>

    <div class="wrapper-content-inser">
        <form method="post" action="contentmanager.php" class="serie-form">
            <input type="text" name="SerieTitel" placeholder="Enter Serie Title" required class="serie-title-input">
            <input type="text" name="IMDBLink" placeholder="Enter IMDB Link" class="imdb-link-input">
            <input type="checkbox" name="actief" value="1" checked class="serie-active-checkbox">
            <button type="submit" name="insert_Serie" class="insert-button">Insert</button>
        </form>
    </div>

    <table class="serie-table-content-manager">
        <thead>
            <tr>
                <th>Serie ID</th>
                <th>SerieTitel</th>
                <th>IMDB Link</th>
                <th>Actief</th>
                <th>Acties</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($series as $serie): ?>
                <tr>
                    <td><?php echo htmlspecialchars($serie['SerieID']); ?></td>
                    <td>
                        <form method="post" action="contentmanager.php">
                            <input type="hidden" name="SerieID" value="<?php echo $serie['SerieID']; ?>">
                            <input type="text" name="SerieTitel" value="<?php echo htmlspecialchars($serie['SerieTitel']); ?>" required>
                    </td>
                    <td>
                        <input type="text" name="IMDBLink" value="<?php echo htmlspecialchars($serie['IMDBLink']); ?>">
                    </td>
                    <td>
                        <input type="checkbox" name="actief" value="1" <?php echo $serie['Actief'] == 1 ? 'checked' : ''; ?>>
                    </td>
                    <td class="serie-actions">
                        <button class="updatebuttonadmin" type="submit" name="update_Serie">Update</button>
                        </form>
                        <a class="delete-link" href="javascript:void(0);" onclick="confirmDelete(<?php echo $serie['SerieID']; ?>)">Delete</a>
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
