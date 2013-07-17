$(document).ready(function() {
	$('.navbar li').removeClass('active');
	$('ul.nav > li > a[href="' + document.location.pathname + '"]').parent().addClass('active');

    $('#saveBtnAddBook').on("click", function(){
        var myBookTitle = $('#bookTitleInput').val();
        var myBookAuthor = $('#bookAuthorInput').val();
        $.post("/mySqlTests.php", { bTitle: myBookTitle, bAuthor: myBookAuthor }).done(function () {
            window.location = "/mySqlTests.php";
        });
    });

    $(document).on("click","#deleteBookRow",function(){
        var bookTitleField = $(this).parent().parent().find('#bookTitleField').text();
        var bookAuthorField = $(this).parent().parent().find('#bookAuthorField').text();
        $.post("/mySqlTests.php", { removeTitle: myBookTitle, removeAuthor: myBookAuthor }).done(function () {
            window.location = "/mySqlTests.php";
        });
    });
});