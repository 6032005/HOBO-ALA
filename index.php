<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
    <?php include './scripts/fetch.php' ?>
</head>
<body>
    <nav class="navbar">
        <img src="images/HOBO_logo.png"  alt="">
        <ul class="nav-links">
            <li class="nav-items"><a href="#">  <img src="images/free-search-icon-2911-thumb.png"  alt=""></a></li></ul>
            <ul class="nav-links">
            <li class="nav-items"><a href="#">  <img src="images/Home_icon_blue-1.png"  alt=""></a></li></ul>
            <ul class="nav-links">
            <li class="nav-items"><a href="#">  <img src="images/profile-icon-9.png"  alt=""></a></li></ul>
            <ul class="nav-links">
            <li class="nav-items"><a href="#">  <img src="images/purepng.com-settings-icon-android-kitkatsymbolsiconsapp-iconsandroid-kitkatandroid-44-721522597677p9lc8.png"  alt=""></a></li>
        </ul>
    </nav>

    <div class="movies-list">
        <button class="pre-btn"><img src="images/pre.png" alt=""></button>
        <button class="nxt-btn"><img src="images/nxt.png" alt=""></button>
        <div class="card-container">
            <div class="card">
                <img src="images/00001.jpg" class="card-img" alt="">
                <div class="card-body">
                    <h2 class="name"> <?php echo $serietitel; ?></h2>
                    <h6 class="des"></h6>
                </div>
            </div> 
            <div class="card">
                <img src="images/00002.jpg" class="card-img" alt="">
                <div class="card-body">
                    <h2 class="name"></h2>
                    <h6 class="des"></h6>
                </div>
            </div> 
            <div class="card">
                <img src="images/00003.jpg" class="card-img" alt="">
                <div class="card-body">
                    <h2 class="name"></h2>
                    <h6 class="des"></h6>
                </div>
            </div> 
            <div class="card">
                <img src="images/00004.jpg" class="card-img" alt="">
                <div class="card-body">
                    <h2 class="name"></h2>
                    <h6 class="des"></h6>
                </div>
            </div> 
            <div class="card">
                <img src="images/00005.jpg" class="card-img" alt="">
                <div class="card-body">
                    <h2 class="name"></h2>
                    <h6 class="des"></h6>
                </div>
            </div> 
            <div class="card">
                <img src="images/00006.jpg" class="card-img" alt="">
                <div class="card-body">
                    <h2 class="name"></h2>
                    <h6 class="des"></h6>
                </div>
            </div> 
       
        </div>
   </div>
  
</body>
</html>


