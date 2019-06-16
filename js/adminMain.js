$(document).ready(function () {

    //Post Table
    $.ajax({
        url:'models/admin/postsTable.php',
        method:'post',
        dataType:'json',
        success: function (data) {
            console.log(data);
            getPostsInfo(data);
        },
        error: function (xhr, statusText) {
            console.log(xhr.status+' '+statusText);
        }
    });

    //User Table
    $.ajax({
        url:'models/admin/usersTable.php',
        method:'post',
        dataType:'json',
        success: function (data) {
            console.log(data);
            getUsersInfo(data);
        },
        error: function (xhr, statusText) {
            console.log(xhr.status+' '+statusText);
        }
    });

    // Adding POST
    // $('#btnSubmit').onclick(function () {
    //     e.preventDefault();
    //     let title = $("#postTitle").val();
    //     let subtitle = $("#postSubtitle").val();
    //     let category = $("#category").val();
    //
    //     let
    //
    //     $.ajax({
    //         url:'models/admin/newPost.php',
    //         method:'post',
    //         dataType:'json',
    //         success: function (data) {
    //             console.log(data);
    //             alert('Inserted a new Post!');
    //             },
    //         error: function (xhr, statusText) {
    //             console.log(xhr.status+' '+statusText);
    //             //Switch->case za errore!!!!
    //             let status = xhr.status;
    //             switch(status){
    //                 case 404:
    //                     alert('Error: '+status+' Page Not Found');
    //                     break;
    //                 case 500:
    //                     alert('Error: '+status+'Internal Server Error');
    //                     break;
    //             }
    //         }
    //     });
    // });

    //Delete Post
    $('.delete-post').click(function () {
        var id = $(this).data('id');
        //alert(id);
        $.ajax({
            method: 'POST',
            url: "models/admin/ajax_delete_post.php",
            dataType: 'json',
            data: {
                id: id
            },
            success: function (data) {
                alert("Post is deleted.");
                location.reload();
            },
            error: function (xhr, statusTxt, error) {
                var status = xhr.status;
                switch (status) {
                    case 500:
                        alert("Server ERROR! Curently it is not possible to delete the post.");
                        break;
                    case 404:
                        alert("Page not Found!");
                        break;
                    default:
                        alert("Error: " + status + " - " + statusTxt);
                        break;
                }
            }
        });
    });

});

function getPostsInfo(data) {
    let html ="";
    for(let post of data){
        html +=`
                                <tr>
                                    <td>${post.title}</td>
                                    <td>${post.subtitle}
                                    </td>
                                    <td>${post.numCom}</td>
                                    <td> ${post.cat_name}</td>
                                    <td>${post.post_date}</td>
                                    <td><a href="?page=admin&content=edit&id=${post.post_id}" class="btn-block">UPDATE</a></td>
                                    <td><button type="button" class="btn btn-danger delete-post" data-id="${post.post_id}">DELETE</button></td>
                                </tr>`;
    }
    $('#daBody').html(html);
}
function getUsersInfo(data) {
    let html ="";
    for(let usr of data){
        html +=`
                                <tr>
                                    <td>${usr.username}</td>
                                    <td>${usr.first_name+' '+usr.last_name}
                                    </td>
                                    <td>${usr.date_made}</td>
                                    <td> ${usr.numCom}</td>
                                    <td><a href="?page=edit&id=${usr.post_id}" class="btn-block">UPDATE</a></td>
                                    <input type="hidden" id="roleCheck" value="${usr.role_name}"/>
                                    `;
        if(!usr.role_name == 'bloguser(admin)'){
            html +=`
                                    <td><button type="button" class="btn btn-danger" id="delete-post">BAN</button></td>
                                </tr>`;
        }
            else {
                html += `</tr>`;
        }
    }
    $('#daBodyUser').html(html);
}