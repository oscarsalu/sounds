(function($) {
    $(window).load(function() {
        $("#sendmail .modal-body").mCustomScrollbar();
        $("#preview .modal-body").mCustomScrollbar();
        $("#choose-tpl .modal-body").mCustomScrollbar();
        $("#preview-tpl .modal-body").mCustomScrollbar();
    });
})(jQuery);

var disableInput = "disabled";
$(document).on('change', '#background_image_upload', function() {
    var progressBar1 = $('.progressBar1'),
        bar1 = $('.progressBar1 .bar1'),
        percent1 = $('.progressBar1 .percent1');

    $('#background1').ajaxForm({

        beforeSend: function() {
            progressBar1.fadeIn();
            var percentVal = '0%';
            bar1.width(percentVal)
            percent1.html(percentVal);

        },
        uploadProgress: function(event, position, total, percentComplete) {
            var percentVal = percentComplete + '%';
            bar1.width(percentVal)
            percent1.html(percentVal);

        },
        success: function(html, statusText, xhr, $form) {
            obj = $.parseJSON(html);

            if (obj.status) {
                var percentVal = '100%';
                bar1.width(percentVal)
                percent1.html(percentVal);
                $("#img1>img").prop('src', obj.image_medium);
                $("#img2>img").prop('src', obj.image_medium);
                //$("#profilepic").prop('value',obj.image_medium);
                showdiv('backgrounds');
            } else {
                alert(obj.error);

            }
        },
        complete: function(xhr) {
            progressBar1.fadeOut();
        }
    }).submit();

});

$(function() {
    update_image();
});

function displayEpk(url) {
    var win = window.open(url, '_blank');
    win.focus();
}

//Function to set bios for EPk
function setBios() {
    user_id = $('#user_id').val();
    bios = CKEDITOR.instances['bios'].getData();
    $.ajax({
        url: base_url+"artist/presskit/update_bios",
        type: "POST",
        data: { 
        	user_id: user_id,
         	bios: bios, 
    		crsf_token_name :  crst_token_value},
        dataType: "json",
        success: function(msg) {
            $('#message').html('<div class="alert alert-success">Bios Updated Successfully.</div>');
            $('#SetBios').modal('hide');
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert(errorThrown);
        }
    });
}

//Function to update EPK Image
function update_image() {
    $.getJSON("<?php echo base_url();?>artist/presskit/get_image", function(data1) {
        $("div#backgrounds").empty();

        $.each(data1.json, function() {

            $("div#backgrounds").append('<div class="col-md-3 col-md-offset-0 col-xs-offset-2 col-xs-8 portfolio-item"><a href="#" onclick=changeimg("' + this['imgN'] + '");><img style="width:750px;height:250px" class="img-responsive img-thumbnail" src="' + this['image'] + '" alt="' + this['caption'] + '"></a></div>');
        });

    });
}

//Function to display div
function showdiv(id) {
    if (id == 'backgrounds') {
        $("#backgrounds").show();
        $("#uploadnewphoto").hide();
    } else {
        $("#uploadnewphoto").show();
        $("#backgrounds").hide();
    }
}

function imgfun(id) {
    $('.rmv').removeClass('imgdesgin');
    $('#ism' + id).addClass('imgdesgin');
    $('#btnsave').attr("onclick", "changeimg(" + id + ")");
}
//Function to change EPK image 
function changeimg(nid) {
    $.ajax({
        url: "<?php echo base_url();?>artist/presskit/update_img/" + nid,
        success: function(msg) {

            $.ajax({
                url: "<?php echo base_url();?>artist/presskit/get_epk_photo",
                dataType: 'json',
                success: function(msg) {
                    $('#adddiv').empty();

                    $.each(msg, function() {
                        $('#adddiv').append("<div class='col-md-3 col-md-offset-0 col-xs-offset-2 col-xs-8 portfolio-item' id='photo_" + this['id'] + "'><img class='img-responsive' style='width:750px;height:250px' src='<?php echo base_url(); ?>uploads/" + this['user_id'] + "/photo/" + this['filename'] + "' alt='" + this['caption'] + "' ><a onclick='delete_epk_photo(" + this['id'] + ")'><span class='close'></span></a></div>");
                    });
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert(errorThrown);
                }
            });
            swal(
                'Good job!',
                'Profile Image Update succesfully!',
                'success'
            );
            // alert("Profile Image Update succesfully");
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert(errorThrown);
        }
    });
}
//Function to select Event for EPK
function selectShowEvent(event_id) {
    $.ajax({
        type: "POST",
        url: '<?php echo base_url();?>artist/presskit/set_show',
        dataType: "text",
        data: {
            'event_id': event_id,
            '<?=$this->security->get_csrf_token_name();?>': '<?=$this->security->get_csrf_hash();?>'
        },
        success: function(datatest) {
            $.ajax({
                url: "<?php echo base_url();?>artist/presskit/get_shows",
                dataType: 'json',
                success: function(msg) {
                    $('#addEvent').empty();
                    swal(
                        'Good job!',
                        'Show selected succesfully!',
                        'success'
                    );
                    $.each(msg, function() {
                        var url_image = "";
                        if (this['event_banner'] !== null || this['event_banner'] !== "") {
                            url_image = "<?php echo base_url()?>" + 'uploads/' + this['user_id'] + '/photo/banner_events/' + this['event_banner'];
                        } else {
                            url_image = "<?php echo base_url()?>assets/images/icon/manager_git_event.png";
                        }

                        $('#addEvent').append("<div class='col-md-6 col-sm-6 col-xs-12 well' id='show_" + this['event_id'] + "'><div class='col-md-4 col-sm-4 col-xs-3'><img class='img-responsive img-thumbnail' src='" + url_image + "'></div><div class='col-md-8 col-sm-8 col-xs-9'><h2><strong><a href='<?=base_url()?>'gigs_events/read/'" + this['event_title'] + "'-'" + this['event_id'] + "'>" + this['event_title'] + "</a></strong></h2><table class='table'><tr><td><strong>Location:</strong></td><td>" + this['location'] + "</td></tr><tr><td><strong>Start:</strong></td><td>" + this['event_start_date'] + "</td></tr><tr><td><strong>To:</strong></td><td>" + this['event_end_date'] + "</td></tr><tr><td><strong>Capacity:</strong><td><td>" + this['capacity'] + "<td></tr><tr><td><strong> Star:</strong></td><td>" + this['sum_star'] + "</td></tr></table><button class='btn btn-primary' onclick='delete_epk_event(" + this['event_id'] + ");'>Delete Event</button></div></div>")

                    });

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert(errorThrown);
                }
            });

        }
    });
}
//Function to Select blog for EPk
function selectBlog(blog_id) {
    $.ajax({
        type: "POST",
        url: '<?php echo base_url();?>artist/presskit/set_blog',
        dataType: "text",
        data: {
            'blog_id': blog_id,
            '<?=$this->security->get_csrf_token_name();?>': '<?=$this->security->get_csrf_hash();?>'
        },
        success: function(datatest) {
            $.ajax({
                url: "<?php echo base_url();?>artist/presskit/get_blogs",
                dataType: 'json',
                success: function(msg) {
                    $('#addBlog').empty();
                    swal(
                        'Good job!',
                        'Blog selected succesfully!',
                        'success'
                    );
                    $.each(msg, function() {
                        var utcSeconds = this['time'];
                        var d = new Date(); // The 0 there is the key, which sets the date to the epoch

                        $('#addBlog').append("<div class='col-md-6 col-sm-6' id='blog_" + this['id'] + "'><article class='articleblog'><header ><img src='<?php echo base_url()?>uploads/" + this['user_id'] + "/photo/blogs/" + this['image_rep'] + "' ><h3><a href='<?php echo base_url()?>artist/blogs/" + this['user_id'] + "'>'" + this['title'] + "</a></h3><span>" + d.setUTCSeconds(utcSeconds) + "</span><hr></header><div>" + this['introduction'] + "</div><div class='clearfix'><a href='<?php echo base_url()?>'artist/allblogs/'" + this['user_id'] + "'/'" + this['id'] + "''><button class='btn btn-primary pull-right'>Read More</button></a><button onclick='delete_epk_blog(" + this['id'] + ")' class='btn btn-primary pull-right'>Delete Blog</button></div></article></div>");
                    });

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert(errorThrown);
                }
            });
        }
    });
}
//Function to select blog
function select_epk_press(press_id) {
    $.ajax({
        type: "POST",
        url: '<?php echo base_url();?>artist/presskit/select_epk_press',
        dataType: "text",
        data: {
            'press_id': press_id,
            '<?=$this->security->get_csrf_token_name();?>': '<?=$this->security->get_csrf_hash();?>'
        },
        success: function(datatest) {
            $.ajax({
                url: "<?php echo base_url();?>artist/presskit/get_press",
                dataType: 'json',
                success: function(msg) {
                    $('#addPress').empty();
                    swal(
                        'Good job!',
                        'Press selected succesfully!',
                        'success'
                    );
                    $.each(msg, function() {
                        $('#addPress').append("<div class='col-md-6 col-sm-6 col-xs-12' id='press_" + this['id'] + "'><div class='card'><div class='card-header'>" + this['name'] + "</div><div class='card-block'><blockquote class='card-blockquote'><p>" + this['quote'] + "</p><span>By :- <cite title='Source Title'>" + this['author'] + "</cite></span></blockquote></div><div class='card-footer text-muted'>Published On " + this['date_on'] + "<button onclick='delete_epk_press(" + this['id'] + ")' class='btn btn-primary pull-right'>Delete Press</button></div></div></div>");
                    });

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert(errorThrown);
                }
            });
        }
    });
}

function delete_epk_press(press_id) {
    var divId = '#press_' + press_id;
    $(divId).remove();
    $.ajax({
        url: "<?php echo base_url();?>artist/presskit/delete_epk_press",
        type: "POST",
        data: {
            'press_id': press_id,
            '<?=$this->security->get_csrf_token_name();?>': '<?=$this->security->get_csrf_hash();?>'
        },
        dataType: "text",
        success: function(msg) {},
        error: function(jqXHR, textStatus, errorThrown) {
            alert(errorThrown);
        }
    });
}

function delete_epk_photo(photo_id) {
    var divId = '#photo_' + photo_id;
    $(divId).remove();
    $.ajax({
        url: "<?php echo base_url();?>artist/presskit/delete_epk_photo",
        type: "POST",
        data: {
            'photo_id': photo_id,
            '<?=$this->security->get_csrf_token_name();?>': '<?=$this->security->get_csrf_hash();?>'
        },
        dataType: "text",
        success: function(msg) {},
        error: function(jqXHR, textStatus, errorThrown) {
            alert(errorThrown);
        }
    });
}

function save_content_limit() {
    $.ajax({
        url: "<?php echo base_url();?>artist/presskit/save_content_limit",
        type: "POST",
        data: {
            'photo_limit': $("#photo_limit").val(),
            'video_limit': $("#video_limit").val(),
            'show_limit': $("#show_limit").val(),
            'download_song_limit': $("#download_song_limit").val(),
            'song_limit': $("#song_limit").val(),
            'press_limit': $("#press_limit").val(),
            '<?=$this->security->get_csrf_token_name();?>': '<?=$this->security->get_csrf_hash();?>'
        },
        dataType: "text",
        success: function(msg) {
            $("#saveDisplay").hide();
            $("#editButton").show();
            $("#limitform input").attr('disabled', 'disabled');
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert(errorThrown);
        }
    });
}

function showButton(id) {
    var Id = '#' + id;
    $("#limitform input").removeAttr('disabled');
    $(Id).show();
    $("#editButton").hide();
}

function fetch_video() {
    $.ajax({
        url: "<?php echo base_url();?>artist/Presskit/video_list",
        success: function(data) {
            $('#video').html(data);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert(errorThrown);
        }
    });
}

function setvideo(nid) {
    $.ajax({
        url: "<?php echo base_url();?>artist/presskit/update_video/" + nid,
        success: function(msg) {
            swal(
                'Good job!',
                'Profile Video Update succesfully!',
                'success'
            );
            $.ajax({
                url: "<?php echo base_url();?>artist/presskit/get_epk_video",
                dataType: 'json',
                success: function(msg) {
                    $('#addVideoDiv').empty();

                    $.each(msg, function() {
                        if (this['type'] == 'file') {
                            $('#addVideoDiv').append("<div class='col-md-4 col-sm-6 col-xs-12 portfolio-item' id='video_" + this['id'] + "'><div class='embed-responsive embed-responsive-16by9'><iframe class='embed-responsive-item' src='<?php echo base_url()?>/uploads/" + this['user_id'] + "/video/" + this['name_file'] + "'></iframe></div><a onclick='delete_epk_video(" + this['id'] + ")'><span class='close'></span></a></div>");
                        } else {

                            var str = this['link_video'];
                            var n = str.indexOf("youtube.com");
                            var videoId = "";
                            if (n) {
                                var videoArr = str.split("v=");

                                if (videoArr[1].indexOf("&")) {
                                    var temp = videoArr[1].split("&");
                                    videoId = temp[0];
                                } else {
                                    videoId = videoArr[1];
                                }
                            }
                            $('#addVideoDiv').append("<div class='col-md-4 col-sm-6 col-xs-12 portfolio-item' id='video_" + this['id'] + "'><div class='embed-responsive embed-responsive-16by9'><iframe class='embed-responsive-item' src='https://www.youtube.com/embed/" + videoId + "'></iframe></div><a onclick='delete_epk_video(" + this['id'] + ")'><span class='close'></span></a></div>");
                        }

                    });

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert(errorThrown);
                }
            });


            // alert("Profile Video Update succesfully");
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert(errorThrown);
        }
    });
}

function delete_epk_video(video_id) {

    var divId = '#video_' + video_id;
    $(divId).remove();
    $.ajax({
        url: "<?php echo base_url();?>artist/presskit/delete_epk_video",
        type: "POST",
        data: {
            'video_id': video_id,
            '<?=$this->security->get_csrf_token_name();?>': '<?=$this->security->get_csrf_hash();?>'
        },
        dataType: "text",
        success: function(msg) {
            swal(
                'Success!',
                'Video deleted succesfully!',
                'success'
            );
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert(errorThrown);
        }
    });
}

function delete_epk_event(event_id) {
    var divId = '#show_' + event_id;
    $(divId).remove();
    $.ajax({
        url: "<?php echo base_url();?>artist/presskit/delete_epk_event",
        type: "POST",
        data: {
            'event_id': event_id,
            '<?=$this->security->get_csrf_token_name();?>': '<?=$this->security->get_csrf_hash();?>'
        },
        dataType: "text",
        success: function(msg) {
            swal(
                'Success!',
                'Show deleted succesfully!',
                'success'
            );
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert(errorThrown);
        }
    });
}

function delete_epk_blog(blog_id) {
    var divId = '#blog_' + blog_id;
    $(divId).remove();
    $.ajax({
        url: "<?php echo base_url();?>artist/presskit/delete_epk_blog",
        type: "POST",
        data: {
            'blog_id': blog_id,
            '<?=$this->security->get_csrf_token_name();?>': '<?=$this->security->get_csrf_hash();?>'
        },
        dataType: "text",
        success: function(msg) {},
        error: function(jqXHR, textStatus, errorThrown) {
            alert(errorThrown);
        }
    });
}
$('#form_edit').on('click', '#publish_save', function() {
    $('#form_edit').submit();
});
$('#display_edit').on('click', '#save_epk_display', function() {
    $('#display_edit').submit();
});

function fetch_song() {
    $.ajax({
        url: "<?php echo base_url();?>artist/audio/album_list",
        success: function(data) {
            $('#myModal3').modal('show');
            $('#song').html(data);
            console.log(data);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert(errorThrown);
        }

    });
}

function get_song_list(id) {
    $.ajax({
        url: "audio/test/" + id,

        success: function(data) {
            $('#song').html(data);
            //alert(data);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert(errorThrown);
        }
    });
}

function get_song_choose(albumid) {
    console.log(albumid);
    $.ajax({
        url: "audio/update_primary_song_user/" + albumid,

        success: function(data) {
            $('#myModal3').modal('hide');
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert(errorThrown);
        }
    });

}

function get_song_select(id) {
    console.log(id);
    $('.rmvsong').removeClass('songdesgin');
    $('#song' + id).addClass('songdesgin');

    $('#songsave').attr("onclick", "get_song_choose(" + id + ")");

}

$(document).ready(function() {
    $('#wrapper-banner').hide();
    $('.banner-save').hide();
    $('.banner-input').change(function() {
        $('#wrapper-banner').show();
        $('.banner-save').show();
    });

});


(function($) {

    $(".changeimages").click(function() {
        var value = $(this).parent().find(".hidden-img").val();
        $("#preview-tpl").find("#alp-pre-img").attr("src", value);
    });
    $(".image-banner .banner-input").css("display", "none");
    $(".button_changebanner").click(function() {
        $(".image-banner .banner-input").click();
        return false;
    })
})(jQuery);

$(document).ready(function() {
    $('#choose-tpl').on('click', 'ul li', function() {
        $("#choose-tpl ul li").each(function() {
            $(this).removeClass("selected");
            $(this).addClass("");
        });
        $(this).addClass("selected");
        var tpl_vl = $(this).find('.hidden-val').val();
        $("#template_epk").val(tpl_vl);
    });

    $('#choose-tpl').on('click', '.btn-preview', function() {
        var parent = $(this).parent();
        var src = parent.find('.hidden-img').val();
        $("#pre-img").attr("src", src);
    });

});

function saveArtistEmail() {
    $("#editemail").modal('hide');
    $.ajax({
        url: "<?php echo base_url()?>artist/presskit/email_contact",
        type: "POST",
        data: {
            'artist_email': $('#m_artist_email').val(),
            'booking_email': $('#m_booking_email').val(),
            'manager_email': $('#m_manager_email').val(),
            '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
        },
        dataType: "text",
        success: function(msg) {
            swal(
                'Good job!',
                'Email Updated Successfully!',
                'success'
            );

        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert(errorThrown);
        }
    });
}

function update_epk_display_info() {
    $.ajax({
        url: "<?php echo base_url()?>artist/presskit/update_epk_display_info",
        type: "POST",
        data: {
            'comments_counts': $('#m_artist_email').val(),
            'video_counts': $('#m_booking_email').val(),
            'fan_counts': $('#m_artist_email').val(),
            'song_counts': $('#m_booking_email').val(),
            'blog_counts': $('#m_artist_email').val(),
            'show_counts': $('#m_booking_email').val(),
            '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
        },
        dataType: "text",
        success: function(msg) {
            swal(
                'Good job!',
                'Email Updated Successfully!',
                'success'
            );

        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert(errorThrown);
        }
    });
}
