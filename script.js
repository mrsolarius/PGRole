var popup = $('#showPopup'),
    closecol = $('.close'),
    login = $('.loginButton');

login.on('click',function(event){
    event.preventDefault();
    $('#login .overlay').fadeIn('slow');
    $('#login').addClass('show');
});

popup.on('click',function(event){
    event.preventDefault();
    $('.overlay').fadeIn('slow');
    $('.modal').addClass('show');
});

closecol.on('click',function(event){
    event.preventDefault();
    $('.modal').fadeOut(function () {
        $('.overlay').fadeOut(function () {
            $('.modal').removeClass('show');
            $('.modal').fadeIn();
        });
    });
});