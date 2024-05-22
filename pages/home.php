<?php
include_once '../php/sql_connect.php';
include_once '../php/sql_utils.php';
include_once '../php/tools.php';


$head = [
    "title" => "HoBo - Home",
    "description" => "Home page van HoBo",
    "stylesheets" => ["/style.css"],
    "scripts" => []
];
include_once '../php/head.php';



$history = getUserHistory(10003); //TODO: change to actual user id

?>
<nav class="navbar-2">
    <ul class="nav-links-2">
        <img src="/img/HOBO_logo.png" alt="">
    </ul>

    <div class="right-container">
        <input type="text" class="search-box" placeholder="search">
        <button class="login-btn">Login</button>
        <button class="login-btn">Register</button>
    </div>
</nav>
<nav class="navbar">

    <ul class="nav-links">
        <li class="nav-items"><a href="Search.php"> <img src="/img/free-search-icon-2911-thumb.png" alt=""></a></li>
    </ul>
    <ul class="nav-links">
        <li class="nav-items"><a href="index.php"> <img src="/img/Home_icon_blue-1.png" alt=""></a></li>
    </ul>
    <ul class="nav-links">
        <li class="nav-items"><a href="Account.php"> <img src="/img/profile-icon-9.png" alt=""></a></li>
    </ul>
    <ul class="nav-links">
        <li class="nav-items"><a href="Settings.php"> <img
                    src="/img/purepng.com-settings-icon-android-kitkatsymbolsiconsapp-iconsandroid-kitkatandroid-44-721522597677p9lc8.png"
                    alt=""></a></li>
    </ul>
</nav>



<main>
    <div class="carousel-container">
        <div class="carousel">
            <div class="slider">
                <div class="slide-content">
                    <h1 class="movie-title">Test</h1>
                    <p class="movie-des">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Suscipit saepe eius
                        ratione nostrum mollitia explicabo quae nam pariatur. Sint, odit?</p>
                </div>
                <img src="/img/seriesCards/00602.jpg" alt="">
            </div>

        </div>
    </div>
    <div class="movies-list">
        <button class="pre-btn"><img src="/img/pre.png" alt=""></button>
        <button class="nxt-btn"><img src="/img/nxt.png" alt=""></button>
        <div class="card-container">

        <?php

            foreach ($history as $item) {
                $imgPath = getImgPathFromID($item["SerieID"]);

                $SerieTitel = $item["SerieTitel"];

                $description = "description"

                ?>

                <div class="card">
                    <img src="<?php echo $imgPath ?>" class="card-img" alt="<?php echo $SerieTitel . 'titel' ?>">
                    <div class="card-body">
                        <h2 class="name"><?php echo $SerieTitel ?></h2>
                        <h6 class="des"><?php echo $description ?></h6>
                    </div>
                </div>

            <?php
            }
            ?>

        </div>
    </div>
        <div class="movies-list">
            <button class="pre-btn"><img src="/img/pre.png" alt=""></button>
            <button class="nxt-btn"><img src="/img/nxt.png" alt=""></button>
            <div class="card-container">
                <div class="card">
                    <img src="/img/seriesCards/00001.jpg" class="card-img" alt="">
                    <div class="card-body">
                        <h2 class="name">movie name</h2>
                        <h6 class="des">Lorem ipsum dolor sit amet consectetur.</h6>
                    </div>
                </div>
                <div class="card">
                    <img src="/img/seriesCards/00002.jpg" class="card-img" alt="">
                    <div class="card-body">
                        <h2 class="name">movie name</h2>
                        <h6 class="des">Lorem ipsum dolor sit amet consectetur.</h6>
                    </div>
                </div>
                <div class="card">
                    <img src="/img/seriesCards/00003.jpg" class="card-img" alt="">
                    <div class="card-body">
                        <h2 class="name">movie name</h2>
                        <h6 class="des">Lorem ipsum dolor sit amet consectetur.</h6>
                    </div>
                </div>
                <div class="card">
                    <img src="/img/seriesCards/00001.jpg" class="card-img" alt="">
                    <div class="card-body">
                        <h2 class="name">movie name</h2>
                        <h6 class="des">Lorem ipsum dolor sit amet consectetur.</h6>
                    </div>
                </div>
                <div class="card">
                    <img src="/img/seriesCards/00001.jpg" class="card-img" alt="">
                    <div class="card-body">
                        <h2 class="name">movie name</h2>
                        <h6 class="des">Lorem ipsum dolor sit amet consectetur.</h6>
                    </div>
                </div>
                <div class="card">
                    <img src="/img/seriesCards/00001.jpg" class="card-img" alt="">
                    <div class="card-body">
                        <h2 class="name">movie name</h2>
                        <h6 class="des">Lorem ipsum dolor sit amet consectetur.</h6>
                    </div>
                </div>
                <div class="card">
                    <img src="/img/seriesCards/00001.jpg" class="card-img" alt="">
                    <div class="card-body">
                        <h2 class="name">movie name</h2>
                        <h6 class="des">Lorem ipsum dolor sit amet consectetur.</h6>
                    </div>
                </div>
                <div class="card">
                    <img src="/img/seriesCards/00001.jpg" class="card-img" alt="">
                    <div class="card-body">
                        <h2 class="name">movie name</h2>
                        <h6 class="des">Lorem ipsum dolor sit amet consectetur.</h6>
                    </div>
                </div>




            </div>

        </div>
            <div class="movies-list">
                <button class="pre-btn"><img src="/img/pre.png" alt=""></button>
                <button class="nxt-btn"><img src="/img/nxt.png" alt=""></button>
                <div class="card-container">
                    <div class="card">
                        <img src="/img/seriesCards/00001.jpg" class="card-img" alt="">
                        <div class="card-body">
                            <h2 class="name">movie name</h2>
                            <h6 class="des">Lorem ipsum dolor sit amet consectetur.</h6>
                        </div>
                    </div>
                    <div class="card">
                        <img src="/img/seriesCards/00002.jpg" class="card-img" alt="">
                        <div class="card-body">
                            <h2 class="name">movie name</h2>
                            <h6 class="des">Lorem ipsum dolor sit amet consectetur.</h6>
                        </div>
                    </div>
                    <div class="card">
                        <img src="/img/seriesCards/00003.jpg" class="card-img" alt="">
                        <div class="card-body">
                            <h2 class="name">movie name</h2>
                            <h6 class="des">Lorem ipsum dolor sit amet consectetur.</h6>
                        </div>
                    </div>
                    <div class="card">
                        <img src="/img/seriesCards/00001.jpg" class="card-img" alt="">
                        <div class="card-body">
                            <h2 class="name">movie name</h2>
                            <h6 class="des">Lorem ipsum dolor sit amet consectetur.</h6>
                        </div>
                    </div>
                    <div class="card">
                        <img src="/img/seriesCards/00001.jpg" class="card-img" alt="">
                        <div class="card-body">
                            <h2 class="name">movie name</h2>
                            <h6 class="des">Lorem ipsum dolor sit amet consectetur.</h6>
                        </div>
                    </div>
                    <div class="card">
                        <img src="/img/seriesCards/00001.jpg" class="card-img" alt="">
                        <div class="card-body">
                            <h2 class="name">movie name</h2>
                            <h6 class="des">Lorem ipsum dolor sit amet consectetur.</h6>
                        </div>
                    </div>
                    <div class="card">
                        <img src="/img/seriesCards/00001.jpg" class="card-img" alt="">
                        <div class="card-body">
                            <h2 class="name">movie name</h2>
                            <h6 class="des">Lorem ipsum dolor sit amet consectetur.</h6>
                        </div>
                    </div>
                    <div class="card">
                        <img src="/img/seriesCards/00001.jpg" class="card-img" alt="">
                        <div class="card-body">
                            <h2 class="name">movie name</h2>
                            <h6 class="des">Lorem ipsum dolor sit amet consectetur.</h6>
                        </div>
                    </div>


                </div>
            </div>

                <div class="movies-list">
                    <button class="pre-btn"><img src="/img/pre.png" alt=""></button>
                    <button class="nxt-btn"><img src="/img/nxt.png" alt=""></button>
                    <div class="card-container">
                        <div class="card">
                            <img src="/img/seriesCards/00001.jpg" class="card-img" alt="">
                            <div class="card-body">
                                <h2 class="name">movie name</h2>
                                <h6 class="des">Lorem ipsum dolor sit amet consectetur.</h6>
                            </div>
                        </div>
                        <div class="card">
                            <img src="/img/seriesCards/00002.jpg" class="card-img" alt="">
                            <div class="card-body">
                                <h2 class="name">movie name</h2>
                                <h6 class="des">Lorem ipsum dolor sit amet consectetur.</h6>
                            </div>
                        </div>
                        <div class="card">
                            <img src="/img/seriesCards/00003.jpg" class="card-img" alt="">
                            <div class="card-body">
                                <h2 class="name">movie name</h2>
                                <h6 class="des">Lorem ipsum dolor sit amet consectetur.</h6>
                            </div>
                        </div>
                        <div class="card">
                            <img src="/img/seriesCards/00001.jpg" class="card-img" alt="">
                            <div class="card-body">
                                <h2 class="name">movie name</h2>
                                <h6 class="des">Lorem ipsum dolor sit amet consectetur.</h6>
                            </div>
                        </div>
                        <div class="card">
                            <img src="/img/seriesCards/00001.jpg" class="card-img" alt="">
                            <div class="card-body">
                                <h2 class="name">movie name</h2>
                                <h6 class="des">Lorem ipsum dolor sit amet consectetur.</h6>
                            </div>
                        </div>
                        <div class="card">
                            <img src="/img/seriesCards/00001.jpg" class="card-img" alt="">
                            <div class="card-body">
                                <h2 class="name">movie name</h2>
                                <h6 class="des">Lorem ipsum dolor sit amet consectetur.</h6>
                            </div>
                        </div>
                        <div class="card">
                            <img src="/img/seriesCards/00001.jpg" class="card-img" alt="">
                            <div class="card-body">
                                <h2 class="name">movie name</h2>
                                <h6 class="des">Lorem ipsum dolor sit amet consectetur.</h6>
                            </div>
                        </div>
                        <div class="card">
                            <img src="/img/seriesCards/00001.jpg" class="card-img" alt="">
                            <div class="card-body">
                                <h2 class="name">movie name</h2>
                                <h6 class="des">Lorem ipsum dolor sit amet consectetur.</h6>
                            </div>
                        </div>


                    </div>
                </div>
</main>

</body>

</html>



<script>

    let cardContainers = [...document.querySelectorAll('.card-container')];
    let preBtns = [...document.querySelectorAll('.pre-btn')];
    let nxtBtns = [...document.querySelectorAll('.nxt-btn')];

    cardContainers.forEach((item, i) => {
        let containerDimensions = item.getBoundingClientRect();
        let containerWidth = containerDimensions.width;

        nxtBtns[i].addEventListener('click', () => {
            item.scrollLeft += containerWidth - 200;
        })

        preBtns[i].addEventListener('click', () => {
            item.scrollLeft -= containerWidth + 200;
        })
    })
</script>