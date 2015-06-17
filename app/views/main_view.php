<!DOCTYPE html>
<html ng-app="top-news">
    <head>
        <title>Top-News</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Common resources -->
        <?php include 'templates/common_resources.php'; ?>

    </head>
    <body>
        <div id="main-wrapper" class="container-fluid">
            <?php include 'templates/header.php'; ?>
            <br/>
            <div class="row">
                <section id="content-wrapper" class="col-sm-8">
                    <div id="currency-exchange">
                        <?php include 'templates/currencies_ticker.php'; ?>
                    </div>
                    <div id="top-ad">

                    </div>
                    <div ng-view="">                        
                        
                    </div>
                </section>
                <?php include 'templates/aside.php'; ?>
            </div>
        </div>
    </body>
</html>
