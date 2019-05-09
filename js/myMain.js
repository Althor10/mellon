$(document).ready(function () {

    //ajax template
    //$.ajax({
    //         url: ,
    //         method: ,
    //         dataType: ,
    //         success: function (data) {
    //
    //         },
    //         error: function (xhr,statusText,code) {
    //
    //         }
    //     });

    //HOME SLIDER
    $.ajax({
        url: 'models/frontend/sliders.php',
        method: 'get' ,
        dataType: 'json' ,
        success: function (data) {
            console.log(data);
            getSliders(data);
        },
        error: function (xhr,statusText,code) {
            console.log(xhr.status+' '+statusText);
        }
    });

    //Categories
    $.ajax({
                url: 'models/frontend/categories.php',
                method: 'get' ,
                dataType: 'json' ,
                success: function (data) {
                getCategories(data);
                },
                error: function (xhr,statusText,code) {

                }
            });
});

function slidersEffects() {
    // home slider
    $('.home-slider').owlCarousel({
        loop:true,
        autoplay: true,
        margin:10,
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        nav:true,
        autoplayHoverPause: true,
        items: 1,
        navText : ["<span class='ion-chevron-left'></span>","<span class='ion-chevron-right'></span>"],
        responsive:{
            0:{
                items:1,
                nav:false
            },
            600:{
                items:1,
                nav:false
            },
            1000:{
                items:1,
                nav:true
            }
        }
    });

    // owl carousel
    var majorCarousel = $('.js-carousel-1');
    majorCarousel.owlCarousel({
        loop:true,
        autoplay: false,
        stagePadding: 0,
        margin: 10,
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        nav: false,
        dots: false,
        autoplayHoverPause: false,
        items: 3,
        responsive:{
            0:{
                items:1,
                nav:false
            },
            600:{
                items:2,
                nav:false
            },
            1000:{
                items:3,
                nav:true,
                loop:false
            }
        }
    });

    // cusotm owl navigation events
    $('.custom-next').click(function(event){
        event.preventDefault();
        // majorCarousel.trigger('owl.next');
        majorCarousel.trigger('next.owl.carousel');

    })
    $('.custom-prev').click(function(event){
        event.preventDefault();
        // majorCarousel.trigger('owl.prev');
        majorCarousel.trigger('prev.owl.carousel');
    })

    // owl carousel
    var major2Carousel = $('.js-carousel-2');
    major2Carousel.owlCarousel({
        loop:true,
        autoplay: true,
        stagePadding: 7,
        margin: 20,
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        nav: false,
        autoplayHoverPause: true,
        items: 4,
        navText : ["<span class='ion-chevron-left'></span>","<span class='ion-chevron-right'></span>"],
        responsive:{
            0:{
                items:1,
                nav:false
            },
            600:{
                items:3,
                nav:false
            },
            1000:{
                items:4,
                nav:true,
                loop:false
            }
        }
    });




    var contentWayPoint = function() {
        var i = 0;
        $('.element-animate').waypoint( function( direction ) {

            if( direction === 'down' && !$(this.element).hasClass('element-animated') ) {

                i++;

                $(this.element).addClass('item-animate');
                setTimeout(function(){

                    $('body .element-animate.item-animate').each(function(k){
                        var el = $(this);
                        setTimeout( function () {
                            var effect = el.data('animate-effect');
                            if ( effect === 'fadeIn') {
                                el.addClass('fadeIn element-animated');
                            } else if ( effect === 'fadeInLeft') {
                                el.addClass('fadeInLeft element-animated');
                            } else if ( effect === 'fadeInRight') {
                                el.addClass('fadeInRight element-animated');
                            } else {
                                el.addClass('fadeInUp element-animated');
                            }
                            el.removeClass('item-animate');
                        },  k * 100);
                    });

                }, 100);

            }

        } , { offset: '95%' } );
    };
    contentWayPoint();

}
function getSliders(data) {
    let html = '';

    for(let sliders of data){

        let fullDate = sliders.post_date;
        let splitDate = fullDate.split('-');
        console.log(splitDate);

        let year = splitDate[0];
        let month = splitDate[1];
        let day = splitDate[2].substr('0','2');
        console.log(day);

        if(month == '01'){
            month = "January";
        }else if( month == '02' ){
            month = "February";
        }else if( month == '03' ){
            month = "March";
        }else if( month == '04'){
            month = "April";
        }else if( month == '05' ){
            month = "May";
        }else if( month == '06' ){
            month = "June";
        }
        else if( month == '07' ){
            month = "July";

        }else if( month == '08' ){
            month = "August";

        }else if( month == '09' ){
            month = "September";

        }else if( month == '10'){
            month = "October";

        }else if( month == '11'){
            month = "November";

        }else {
            month = "December";
        }

        html +=`  <div>
                        <a href="?page=single" class="a-block d-flex align-items-center height-lg" style="background-image: url(${sliders.thumbnail}); ">
                            <div class="text half-to-full">
                                <span class="category mb-5">${sliders.cat_name}</span>
                                <div class="post-meta">

                                    <span class="author mr-2"><img src="${sliders.profile_pic}" alt="Colorlib"> ${sliders.username}</span>&bullet;
                                    <span class="mr-2">${month+' '+day+', '+year} </span> &bullet;
                                    <span class="ml-2"><span class="fa fa-comments"></span> 3</span>

                                </div>
                                <h3>${sliders.title}</h3>
                                <p>${sliders.subtitle}</p>
                            </div>
                        </a>
                    </div>`;
    }
    $('#sliders').html(html);
    slidersEffects();
}
function getCategories(data) {
    let html = '';
    for(let cat of data){
        html += ` <li><a href="#">${cat.cat_name} <span>(${cat.postCount})</span></a></li>`;
    }
    $("#categories").html(html);
}
