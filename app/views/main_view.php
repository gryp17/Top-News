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
				<?php include 'templates/aside.php'; ?>
                <section id="content-wrapper" class="col-sm-8 col-sm-pull-4">
                    <div id="currency-exchange">
						<?php include 'templates/currencies_ticker.php'; ?>
                    </div>
                    <div id="top-ad">

                    </div>
					<?php include 'templates/search_bar.php'; ?>
                    <div ng-view="">                        

                    </div>
                </section>
            </div>
			
			<div class="scroll-top"></div>
			
			<?php include 'templates/footer.php'; ?>
        </div>
    </body>
</html>
