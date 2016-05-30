jQuery(document).ready(function() {
    // Initialize Normal Fancybox for a class .fancybox
    jQuery('.fancybox').fancybox();

    // THIS IS FOR THE MAIN NAVIGATION
    jQuery('.toggle-nav').click(function(e) {
        jQuery(this).toggleClass('active');
        jQuery('.navigation ul').toggleClass('active');
        e.preventDefault();
    });

    // BANNER CODE WILL BE MOVED INTO DIFFERENT JS FILE
    jQuery(document).on('click','.csi-banner .prev',function(){
        var next = parseInt(jQuery(this).siblings('ul').children('.current').index());
        jQuery(this).siblings('ul').children('.current').removeClass('current');

        jQuery(this).siblings('ul').children(':nth-child('+next+1+')').addClass('current');
        next = next+1*100;

        jQuery(this).siblings('ul').css('margin-left',next+'%');
        jQuery('.spacer').children().removeClass('current');
        //jQuery('.spacer').children().index(parseInt(jQuery(this).siblings('ul').css('marginLeft')) / 100).addClass('current');
    });

    jQuery(document).on('click','.csi-banner .next',function(){
        var next = parseInt(jQuery(this).siblings('ul').children('.current').index());
        jQuery(this).siblings('ul').children('.current').removeClass('current');

        jQuery(this).siblings('ul').children(':nth-child('+next-1+')').addClass('current');
        next = next-1*100;

        jQuery(this).siblings('ul').css('margin-left',next+'%');
        jQuery('.spacer').children().removeClass('current');
    });

    jQuery(document).on('click','.spacer span',function() {
        console.log(jQuery(this).index());
        jQuery(this).parent().parent().siblings('ul').css('marginLeft',jQuery(this).index()*-100+'%');
        jQuery(this).siblings().removeClass('current');
        jQuery(this).addClass('current');
        jQuery(this).parent().parent().siblings('ul').children().removeClass('current');
        jQuery(this).parent().parent().siblings('ul').children(':nth-child('+jQuery(this).index()+')');
    });
});