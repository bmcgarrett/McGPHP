$(document).ready(function() {
	$('.navbar li').removeClass('active');
	$('ul.nav > li > a[href="' + document.location.pathname + '"]').parent().addClass('active');

    $('#saveBtnAddBook').on("click", function(){
        var myBookTitle = $('#bookTitleInput').val();
        var myBookAuthor = $('#bookAuthorInput').val();
        alert(myBookTitle + myBookAuthor);
        $.post("/mySqlTests.php", { bTitle: myBookTitle, bAuthor: myBookAuthor })
        $('#saveBtnAddBook').hide();
        location.href = location.href;
    });
});