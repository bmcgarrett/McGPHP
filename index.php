<?php include_once('header.php'); ?>
<body>
<div class='container'>
    <h1>PHP Test Page with Bootstrap</h1>
    <div class='navbar navbar-inverse'>
        <div class='navbar-inner nav-collapse' style="height: auto;">
            <ul class="nav">
                <li class="active"><a href="#"><i class='icon-home icon-white'></i> Home</a></li>
                <li><a href="forms.php"><i class='icon-list-alt icon-white'></i> Forms Test</a></li>
                <li><a href="mongo.php"><i class='icon-book icon-white'></i> MongoDB</a></li>
            </ul>
        </div>
    </div>
    <div id='content' class='row-fluid'>
        <div class='span9 main'>
            <h2>Change Log</h2>
        </div>
        <div class='span3 sidebar'>
            <h2>Sidebar</h2>
            <ul class="nav nav-tabs nav-stacked">
                <li><a href='#'>Test Link 1</a></li>
                <li><a href='#'>Test Link 2</a></li>
                <li><a href='#'>Test Link 3</a></li>
            </ul>
        </div>
    </div>
</div>
</body>
<?php include_once('footer.php'); ?>

