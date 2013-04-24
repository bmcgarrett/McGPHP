<?php include_once('header.php'); ?>
    <body>
    <div class='container'>
        <h1>PHP Test Page with Bootstrap</h1>
        <div class='navbar navbar-inverse'>
            <div class='navbar-inner nav-collapse' style="height: auto;">
                <ul class="nav">
                    <li class="active"><a href="index.php"><i class='icon-home icon-white'></i> Home</a></li>
                    <li><a href="forms.php"><i class='icon-list-alt icon-white'></i> Forms Test</a></li>
                    <li><a href="mySqlTests.php"><i class='icon-hdd icon-white'></i> MySQL</a></li>
                    <li><a href="mongo.php"><i class='icon-book icon-white'></i> MongoDB</a></li>
                </ul>
            </div>
        </div>
        <div id='content' class='row-fluid'>
            <div id='newFormDiv'>
                <form action="mySqlTests.php" method="post">
                    <span>Book Title: <input type="text" name="bTitle"></span>
                    </br>
                    <span>Author: <input type="text" name="bAuthor"></span>
                    </br>
                    <input type="submit" value="Add Book">
                </form>
            </div>
        </div>
    </div>
    </body>
<?php include_once('footer.php'); ?>