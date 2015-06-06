<!DOCTYPE html>
<html>
    <head>
        <title>Home | Top-News</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Common resources -->
        <?php include 'templates/common_resources.php'; ?>

    </head>
    <body>
        <div id="main-wrapper" class="container-fluid">
            <header class="row">
                <div id="logo-wrapper" class="center-text col-lg-2">
                    <a href="<?php echo base_url(); ?>home">
                        <img src="<?php echo base_url(); ?>img/logo.png" alt="Top-News logo"/>
                    </a>
                </div>
                <div id="menu-wrapper" class="col-lg-10">
                    <div id="politics" class="center-text menu-item">
                        Politics
                    </div>
                    <div id="economy" class="center-text menu-item">
                        Economy
                    </div>
                    <div id="world" class="center-text menu-item">
                        World
                    </div>
                    <div id="technology" class="center-text menu-item">
                        Technology
                    </div>
                    <div id="sport" class="center-text menu-item">
                        Sport
                    </div>
                </div>
            </header>
        </div>
    </body>
</html>
