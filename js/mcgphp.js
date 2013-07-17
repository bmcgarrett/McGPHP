$(document).ready(function() {
    var rowIDNum;

	$('.navbar li').removeClass('active');
	$('ul.nav > li > a[href="' + document.location.pathname + '"]').parent().addClass('active');

    //Add Book Function
    $('#saveBtnAddBook').on('click', function(){
        var myBookTitle = $('#bookTitleInput').val();
        var myBookAuthor = $('#bookAuthorInput').val();
        $.post("/mySqlTests.php", { bTitle: myBookTitle, bAuthor: myBookAuthor }).done(function () {
            window.location = "/mySqlTests.php";
        });
    });

    //Delete Book Function
    $(document).on('click','#deleteBookRow',function(){
        var bookTitleField = $(this).parent().parent().find('#bookTitleField').text();
        var bookAuthorField = $(this).parent().parent().find('#bookAuthorField').text();
        $.post("/mySqlTests.php", { removeTitle: bookTitleField, removeAuthor: bookAuthorField }).done(function () {
            window.location = "/mySqlTests.php";
        });
    });

    //Edit Book Functions
    $(document).on('click','#editBookBtn',function(){
        rowIDNum = $(this).parent().parent().attr('rowID');

    });

    $(document).on('click','#saveBtnEditBook',function(){
        var bookTitleField = $('#bookTitleInputEdit').val();
        var bookAuthorField = $('#bookAuthorInputEdit').val();
        $.post("/mySqlTests.php", { editTitleNew: bookTitleField, editAuthorNew: bookAuthorField, rowIDToChange: rowIDNum }).done(function () {
            alert(bookTitleField + bookAuthorField + rowIDNum);
            window.location = "/mySqlTests.php";
        });
    });
});
