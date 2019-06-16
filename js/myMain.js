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
    //              errorFunction(xhr,statusText);
    //         }
    //     });

    //HOME SLIDER
    $.ajax({
        url: 'models/frontend/sliders.php',
        method: 'get' ,
        dataType: 'json' ,
        success: function (data) {
           // console.log(data);
            getSliders(data);
        },
        error: function (xhr,statusText,code) {
            errorFunction(xhr,statusText);
        }
    });

    //Categories - Sidebar
    $.ajax({
                url: 'models/frontend/categories.php',
                method: 'get' ,
                dataType: 'json' ,
                success: function (data) {
                getCategories(data);
                },
                error: function (xhr,statusText,code) {
                    errorFunction(xhr,statusText);
                }
            });

    //Tags-Sidebar
    $.ajax({
                url: 'models/frontend/tags.php' ,
                method: 'get' ,
                dataType: 'json' ,
                success: function (data) {
                    getTags(data);
                },
                error: function (xhr,statusText,code) {
                    errorFunction(xhr,statusText);
                }
            });

    //Posts
    $.ajax({
                url:'models/posts/latestPosts.php' ,
                method: 'get',
                dataType: 'json',
                success: function (data) {
                    showLatestPosts(data);
                },
                error: function (xhr,statusText,code) {
                     errorFunction(xhr,statusText);
                }
            });

    //PostPage-Posts

    var catId = $('#catId').val();
    console.log(catId);
    $.ajax({
        url:'models/posts/categoryPagePosts.php' ,
        method: 'post',
        data:{
            catId:catId
        },
        dataType: 'json',
        success: function (data) {
            console.log(data);
            showPostsCategory(data);
        },
        error: function (xhr,statusText,code) {
            errorFunction(xhr,statusText)
        }
    });

    //Popular Posts- Sidebar
    $.ajax({
        url: "models/posts/popularPosts.php",
        method: "get" ,
        dataType:"json" ,
        success: function (data) {
                console.log(data);
                getPopularPosts(data);
                },
        error: function (xhr,statusText,code) {
            errorFunction(xhr,statusText);
                }
    });

    //SiglePage
    var postId = $('#singleId').val();
    $.ajax({
        url: 'models/posts/singlePost.php',
        method: 'post',
        data:{
            postId:postId
        },
        dataType: 'json',
        success: function (data) {
            console.log(data);
            getSinglePost(data);
                },
        error: function (xhr,statusText,code) {
            errorFunction(xhr,statusText);
                }
    });

    //Latests Posts Footer
    $.ajax({
        url: "models/posts/latestPostsFooter.php",
        method: "get" ,
        dataType:"json" ,
        success: function (data) {
            console.log(data);
            getLatestFooter(data);
        },
        error: function (xhr,statusText,code) {
            console.log(xhr.status);
            errorFunction(xhr,statusText);
        }
    });

    //Contact
    $('#btnSubmitMessage').on('submit',function () {
        event.preventDefault();
        alert('RADIM LI!?');
        let cName = $('#contactName').val();
        let cPhone = $('#contactPhonect').val();
        let cEmail = $('#contactEmail').val();
        let cMess = $('#contactMessage').val();

        let errror = [];
        let regName = /^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+$/;
        let regPhone = /^\+3816[0-9]{8,11}$/;
        let regEmail = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/;

        if(!regName.test(cName)){
            errror.push("Wrong Name type!");
            alert("Wrong Name type!");
        }
        console.log(cPhone);
        if(!regPhone.test(cPhone)){
            errror.push("Wrong Phone Format!");
            alert("Wrong Phone Format");
        }
        if(!regEmail.test(cEmail)){
            errror.push("Wrong Email Format!");
            alert("Wrong email format!");
        }
        if(cMess.length >3000){
            errror.push("Maximum character limit exeeded!");
            alert ("Exeeded Maximum character limit. (3000 max Chars)")
        }

        let user = $('#userId').val();
        console.log(user);
        alert(errror);

        if(errror.length != 0){
                $.ajax({
                    url:"models/contact/contactMeNoUser.php",
                    method:"post",
                    data:{
                        cName:cName,
                        cPhone:cPhone,
                        cEmail:cName,
                        cMess:cMess
                    },
                    dataType:'json',
                    success: function (data) {
                        alert('Message was sent!');
                    },
                    error: function (xhr,statusText) {
                        var status = xhr.status;
                        switch (status) {
                            case 500:
                                alert("Server ERROR! Curently it is not possible to send a message.");
                                location.reload();
                                break;
                            case 404:
                                alert("Page not Found!");
                                location.reload();
                                break;
                            default:
                                alert("Error: " + status + " - " + statusTxt);
                                location.reload();
                                break;
                        }
                    }
                });



        } else alert("Zassto?!");


    });

    //LatestPostsAbout
    $.ajax({
        url:'models/posts/latestPosts.php' ,
        method: 'get',
        dataType: 'json',
        success: function (data) {
            showLatestPostsAbout(data);
        },
        error: function (xhr,statusText,code) {
            errorFunction(xhr,statusText);
        }
    });


});
function dateFormat(operator) {
    let fullDate = operator.post_date;
    let splitDate = fullDate.split('-');
    //console.log(splitDate);

    let year = splitDate[0];
    let month = splitDate[1];
    let day = splitDate[2].substr('0','2');
    //console.log(day);

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
    let date = month+' '+day+', '+year;

    return date;
}
function dateFormatComment(operator) {
    let fullDate = operator.comment_date;
    let splitDate = fullDate.split('-');
    //console.log(splitDate);

    let year = splitDate[0];
    let month = splitDate[1];

    let dayFull = splitDate[2].split(' ');
    let day = dayFull[0];
    let hours = dayFull[1].substr(0,2);
    let minutes = dayFull[1].substr(3,2);

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
    let date = month+' '+day+', '+year+' AT '+hours+':'+minutes;

    return date;
}



function errorFunction(xhr,statusText) {
    console.log(xhr.status+" "+statusText);
}
function effects() {
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
        let commentNumber = getCommentsNumber(sliders.post_id);
       let date = dateFormat(sliders);

        html +=`  <div>
                        <a href="?page=single&id=${sliders.post_id}" class="a-block d-flex align-items-center height-lg" style="background-image: url(${sliders.thumbnail}); ">
                            <div class="text half-to-full">
                                <span class="category mb-5">${sliders.cat_name}</span>
                                <div class="post-meta">

                                    <span class="author mr-2"><img src="${sliders.profile_pic}" alt="${sliders.username}"> ${sliders.username}</span>&bullet;
                                    <span class="mr-2">${date} </span> &bullet;
                                    <span class="ml-2"><span class="fa fa-comments"></span> ${commentNumber}</span>

                                </div>
                                <h3>${sliders.title}</h3>
                                <p>${sliders.subtitle}</p>
                            </div>
                        </a>
                    </div>`;
    }
    $('#sliders').html(html);
    effects();
}
function getCategories(data) {
    let html = '';
    for(let cat of data){
        html += ` <li><a href="?page=category&id=${cat.category_id}">${cat.cat_name} <span>(${cat.postCount})</span></a></li>`;
    }
    $("#categories").html(html);
}
function getTags(data) {
    let html = "";
    for(let tag of data){
        html += `<li><a href="?tag=${tag.tag_name}">${tag.tag_name}</a></li>`;
    }
    $("#tags").html(html);
}
function getPopularPosts(data) {
    let html = "";
    for (let pop of data){
        let date = dateFormat(pop);
        html += ` <li>
                    <a href="?page=single&id=${pop.post_id}">
                        <img src="${pop.thumbnail}" alt="Image placeholder" class="mr-4">
                        <div class="text">
                            <h4>${pop.title}</h4>
                            <div class="post-meta">
                                <span class="mr-2">${date} </span>
                            </div>
                        </div>
                    </a>
                </li>`;
    }
    $('#popPosts').html(html);
    effects();
}

function getComments(data) {
    let comCount = data.length;
    let html = `<h3 class="mb-5">${comCount} Comment/s</h3>`;
    console.log(data);
    for(let com of data){
        let date = dateFormatComment(com);
        if(com.parent_id != null ){
            html +=`    <ul class="children">
                                <li class="comment">
                                    <div class="vcard">
                                        <img src="${com.profile_pic}" alt="Image placeholder">
                                    </div>
                                    <div class="comment-body">
                                        <h3>${com.username}</h3>
                                        <div class="meta">${date}</div>
                                        <p>${com.comment}</p>
                                        <p><a href="#writeComment" class="reply rounded">Reply</a></p>                                     
                                        <input type="hidden" id="comRepyId${com.comment_id}" value="${com.comment_id}" name="comRepyId${com.comment_id}"/>
                                    </div>
                                    </li>
                                    </ul>
                                    </li>`;

        }else {
            html +=`
                    <ul class="comment-list">
                    
                        <li class="comment">
                            <div class="vcard">
                                <img src="${com.profile_pic}" alt="${com.username}">
                            </div>
                            <div class="comment-body">
                                <h3>${com.username}</h3>
                                <div class="meta">${date}</div>
                                <p>${com.comment}</p>
                                <p><a href="#writeComment" class="reply rounded">Reply</a></p>
                                <input type="hidden" id="comRepyId${com.comment_id}" value="${com.comment_id}" name="comRepyId${com.comment_id}"/>
                            </div>
                            </li>
                       `;
        }

        // </li>

       // html +=`
       //
       //                              <ul class="children">
       //                                  <li class="comment">
       //                                      <div class="vcard">
       //                                          <img src="assets/images/person_1.jpg" alt="Image placeholder">
       //                                      </div>
       //                                      <div class="comment-body">
       //                                          <h3>Jean Doe</h3>
       //                                          <div class="meta">January 9, 2018 at 2:21pm</div>
       //                                          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur quidem laborum necessitatibus, ipsam impedit vitae autem, eum officia, fugiat saepe enim sapiente iste iure! Quam voluptas earum impedit necessitatibus, nihil?</p>
       //                                          <p><a href="#" class="reply rounded">Reply</a></p>
       //                                      </div>
       //
       //                                      <ul class="children">
       //                                          <li class="comment">
       //                                              <div class="vcard">
       //                                                  <img src="assets/images/person_1.jpg" alt="Image placeholder">
       //                                              </div>
       //                                              <div class="comment-body">
       //                                                  <h3>Jean Doe</h3>
       //                                                  <div class="meta">January 9, 2018 at 2:21pm</div>
       //                                                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur quidem laborum necessitatibus, ipsam impedit vitae autem, eum officia, fugiat saepe enim sapiente iste iure! Quam voluptas earum impedit necessitatibus, nihil?</p>
       //                                                  <p><a href="#" class="reply rounded">Reply</a></p>
       //                                              </div>
       //                                          </li>
       //                                      </ul>
       //                                  </li>
       //                              </ul>
       //                          </li>
       //                      </ul>
       //                  </li>
       //
       //                  <li class="comment">
       //                      <div class="vcard">
       //                          <img src="assets/images/person_1.jpg" alt="Image placeholder">
       //                      </div>
       //                      <div class="comment-body">
       //                          <h3>Jean Doe</h3>
       //                          <div class="meta">January 9, 2018 at 2:21pm</div>
       //                          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur quidem laborum necessitatibus, ipsam impedit vitae autem, eum officia, fugiat saepe enim sapiente iste iure! Quam voluptas earum impedit necessitatibus, nihil?</p>
       //                          <p><a href="#" class="reply rounded">Reply</a></p>
       //                      </div>
       //                  </li>
       //              </ul>
       //              <!-- END comment-list -->`;
    }
    $('#comments').html(html);
} //Not DONE!

var numComment = ""; //Wont Work
function getCommentsNumber(postId) {

    $.ajax({
        url: 'models/posts/comments.php',
        method:'post',
        data:{
            postId: postId
        } ,
        dataType: 'json',
        success: function (data) {
            //console.log(data);
           numComment = getComment(data);
        },
        error: function (xht,statusText,code) {
            errorFunction(xht,statusText);

        }
    });

    function getComment(data) {
        numComment = data.length;
        return numComment;
    }

    return numComment;

}



function getSinglePost(data) {
    let html="";
    for(let single of data){
        let date = dateFormat(single);
        let text = single.text;
        // console.log(text);
        let splittedText = text.split('\n');
        // console.log(splittedText);
        html += ` <img src="${single.thumbnail}" alt="${single.title}" class="img-fluid mb-5">
                <div class="post-meta">
                    <span class="author mr-2"><img src="${single.profile_pic}" alt="${single.username}" class="mr-2"> ${single.username}</span>&bullet;
                    <span class="mr-2">${date} </span> &bullet;
                    <span class="ml-2"><span class="fa fa-comments"></span> 3</span>
                </div>
                <h1 class="mb-4">${single.title}</h1>
                <a class="category mb-5" href="#">Food</a> <a class="category mb-5" href="#">${single.cat_name}</a>

                <div class="post-content-body">
                    <p>${splittedText[0]}</p>
                    <div class="row mb-5">
                        <div class="col-md-12 mb-4">
                            <img src="${single.first_img_path}" alt="Image placeholder" class="img-fluid">
                        </div>
                        <div class="col-md-6 mb-4">
                            <img src="${single.second_img_path}" alt="Image placeholder" class="img-fluid">
                        </div>
                        <div class="col-md-6 mb-4">
                            <img src="${single.third_img_path}" alt="Image placeholder" class="img-fluid">
                        </div>
                    </div>
                    <p> ${splittedText[2]}</p>
                     ` ;
                if(splittedText[4]){
                    for(let i = 4; i<splittedText.length;i=i+2){
                        html +=
                            `<p>${splittedText[i]}</p>`;
                    }
                }
                html+=`
                    </div>


                <div class="pt-5">
                    <p>Categories:  <a href="?page=category&id=${single.category_id}">${single.cat_name}</a> Tags: <a href="#">#manila</a>, <a href="#">#asia</a></p>
                </div> <div class="pt-5" id="comments"> </div>
                <!-- COMMENTS -->     
                 <div class="comment-form-wrap pt-5" id="writeComment">
                        <h3 class="mb-5">Leave a comment</h3>
                        <form action="#" class="p-5 bg-light">
                            <div class="form-group">
                                <label for="name">Name *</label>
                                <input type="text" class="form-control" id="name">
                            </div>
                            <div class="form-group">
                                <label for="email">Email *</label>
                                <input type="email" class="form-control" id="email">
                            </div>
                            <div class="form-group">
                                <label for="website">Website</label>
                                <input type="url" class="form-control" id="website">
                            </div>

                            <div class="form-group">
                                <label for="message">Message</label>
                                <textarea name="" id="message" cols="30" rows="10" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Post Comment" class="btn btn-primary">
                            </div>

                        </form>
                    </div>
                </div>`;




    }
    $('#singlePage').html(html);

    let postId = $('#singleId').val();
    $.ajax({
        url: 'models/posts/comments.php',
        method:'post',
        data:{
            postId: postId
        } ,
        dataType: 'json',
        success: function (data) {
            console.log(data);
            getComments(data);
            //console.log(comment);
        },
        error: function (xht,statusText,code) {
            errorFunction(xht,statusText);

        }
    });
}

function getLatestFooter(data) {
    let html = "";
    for(let post of data){
        let date = dateFormat(post);
        html += `<li>
                                    <a href="">
                                        <img src="${post.thumbnail}" alt="Image placeholder" class="mr-4">
                                        <div class="text">
                                            <h4>${post.title}</h4>
                                            <div class="post-meta">
                                                <span class="mr-2">${date} </span> &bullet;
                                                <span class="ml-2"><span class="fa fa-comments"></span> ?</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>`;
    }
    $('#latestFooter').html(html);
}

//FOR LATEST POSTS- COMMENTS (LEFT JOIN)
function showLatestPosts(data) {
    let html = "";

    for (let post of data) {
        date = dateFormat(post);
        let commentNumber = getCommentsNumber(post.post_id);
        html += ` <div class="col-md-6">
                        <a href="?page=single&id=${post.post_id}" class="blog-entry element-animate" data-animate-effect="fadeIn">
                            <img src="${post.thumbnail}" alt="Image placeholder">
                            <div class="blog-content-body">
                                <div class="post-meta">
                                    <span class="author mr-2"><img src="${post.profile_pic}" alt="${post.username}"> ${post.username}</span>&bullet;
                                    <span class="mr-2">${date} </span> &bullet;
                                    <span class="ml-2"><span class="fa fa-comments"></span> ${commentNumber}</span>
                                </div>
                                <h2>${post.title}</h2>
                            </div>
                        </a>
                    </div>`;
    }
    $('#posts').html(html);
    effects();
}

function showPostsCategory(data) {
    let html = "";
    for(let sing of data){
        let commentNumber = getCommentsNumber(sing.post_id);
        date = dateFormat(sing);
        html += `<div class="post-entry-horzontal">
                            <a href="?page=single&id=${sing.post_id}">
                                <div class="image element-animate" data-animate-effect="fadeIn" style="background-image: url(${sing.thumbnail});"></div>
                                <span class="text">
                      <div class="post-meta">
                        <span class="author mr-2"><img src="${sing.profile_pic}" alt="${sing.username}"> ${sing.username}</span>&bullet;
                        <span class="mr-2">${date}</span> &bullet;
                        <span class="mr-2">${sing.cat_name}</span> &bullet;
                        <span class="ml-2"><span class="fa fa-comments"></span> ${commentNumber}</span>
                      </div>
                      <h2>${sing.title}</h2>
                    </span>
                            </a>
                        </div>`;
    }
    //console.log(html);
    $('#postsCat').html(html);
    effects();
}

function showLatestPostsAbout(data) {
    let html = "";
    for(let lat of data){
        let date = dateFormat(lat);
        html += `<div class="post-entry-horzontal">
                            <a href="?page=single&id=${lat.post_id}">
                                <div class="image" style="background-image: url(${lat.thumbnail});"></div>
                                <span class="text">
                      <div class="post-meta">
                        <span class="author mr-2"><img src="${lat.profile_pic}" alt="${lat.username}"> ${lat.username}</span>&bullet;
                        <span class="mr-2">${date} </span> &bullet;
                        <span class="ml-2"><span class="fa fa-comments"></span> 3</span>
                      </div>
                      <h2>${lat.title}</h2>
                    </span>
                            </a>
                        </div>`;
    }
    $('#latestPostsAbout').html(html);
}