(function($) {
    console.log("jchannel");
    $.fn.extend({

        // Chat Plugin 
        Chat: function(options) {

                // Default Configurations
                var chat = {}

                var defaults = {
                    ajaxMessage: 'ajax_messages/' + $('#with_id').val(),
                    ajaxDelete: 'ajax_del_messages/' + $('#with_id').val(),
                    ajaxSendMessage: 'ajax_send/' + $('#with_id').val(),
                    ajaxUpdate: 'ajax_update/' + $('#with_id').val(),
                    chat: '',
                    chatRefresh: 2000,
                    emoticonsModal: '#emoticons'
                }
                var csrfName = $("#csrf").attr('name');
                var csrfVal = $("#csrf").val();
                var options = $.extend(defaults, options);
                var opt = options;
                console.log(opt.ajaxUpdate);
                chat.renderChat = function() {

                    $(opt.chat).html(chat.messages());
                    $("ul.messages-layout").on('dblclick', 'span.time', function() {
                        var message_id = $(this).attr("id");
                        var csrfName = $("#csrf").attr('name');
                        var csrfVal = $("#csrf").val();
                        var construct = {
                            "messageID": message_id,
                            "csrf_test_name": csrfVal
                        }

                        $.post(opt.ajaxDelete, construct, function(response) {});

                        var client_or_server = $(this).parent().parent().parent().attr("class");
                        var client_or_server_id = $(this).parent().parent().parent().attr("id");

                        $("li." + client_or_server + '#' + client_or_server_id).remove();
                        $("ul.messages-layout").html(chat.messages());

                    });

                    // Handle Emoticons
                    $(".send-group").delegate('[data-option="emotions"]', 'click', function(e) {
                        $("#emoticons .modal-body").html(
                            '<img class="emoticons" src="../../assets/emoticons/Angry.png" id="angry" data-value=":@">' +
                            '<img class="emoticons" src="../../assets/emoticons/Balloon.png" id="balloon" data-value="[balloon]">' +
                            '<img class="emoticons" src="../../assets/emoticons/Big-Grin.png" id="big-grin" data-value="[big-grin]">' +
                            '<img class="emoticons" src="../../assets/emoticons/Bomb.png" id="bomb" data-value="[bomb]">' +
                            '<img class="emoticons" src="../../assets/emoticons/Broken-Heart.png" id="broken-heart" data-value="[broken-heart]">' +
                            '<img class="emoticons" src="../../assets/emoticons/Cake.png" id="cake" data-value="[cake]">' +
                            '<img class="emoticons" src="../../assets/emoticons/Cat.png" id="cat" data-value="[cat]">' +
                            '<img class="emoticons" src="../../assets/emoticons/Clock.png" id="clock" data-value="[clock]">' +
                            '<img class="emoticons" src="../../assets/emoticons/Clown.png" id="clown" data-value="[clown]">' +
                            '<img class="emoticons" src="../../assets/emoticons/Cold.png" id="cold" data-value="[cold]">' +
                            '<img class="emoticons" src="../../assets/emoticons/Confused.png" id="confused" data-value="[confused]">' +
                            '<img class="emoticons" src="../../assets/emoticons/Cool.png" id="cool" data-value="[cool]">' +
                            '<img class="emoticons" src="../../assets/emoticons/Crying.png" id="crying" data-value="[crying]">' +
                            '<img class="emoticons" src="../../assets/emoticons/Crying2.png" id="crying2" data-value="[crying2]">' +
                            '<img class="emoticons" src="../../assets/emoticons/Dead.png" id="dead" data-value="[dead]">' +
                            '<img class="emoticons" src="../../assets/emoticons/Devil.png" id="devil" data-value="[devil]">' +
                            '<img class="emoticons" src="../../assets/emoticons/Dizzy.png" id="dizzy" data-value="[dizzy]">' +
                            '<img class="emoticons" src="../../assets/emoticons/Dog.png" id="dog" data-value="[dog]">' +
                            '<img class="emoticons" src="../../assets/emoticons/Don\'t-tell-Anyone.png" id="dont-tell-anyone" data-value="[dont-tell-anyone]">' +
                            '<img class="emoticons" src="../../assets/emoticons/Drinks.png" id="drinks" data-value="[drinks]">' +
                            '<img class="emoticons" src="../../assets/emoticons/Drooling.png" id="drooling" data-value="[drooling]">' +
                            '<img class="emoticons" src="../../assets/emoticons/Flower.png" id="flower" data-value="[flower]">' +
                            '<img class="emoticons" src="../../assets/emoticons/Ghost.png" id="ghost" data-value="[ghost]">' +
                            '<img class="emoticons" src="../../assets/emoticons/Gift.png" id="gift" data-value="[gift]">' +
                            '<img class="emoticons" src="../../assets/emoticons/Girl.png" id="girl" data-value="[girl]">' +
                            '<img class="emoticons" src="../../assets/emoticons/Goodbye.png" id="goodbye" data-value="[goodbye]">' +
                            '<img class="emoticons" src="../../assets/emoticons/Heart.png" id="heart" data-value="[heart]">' +
                            '<img class="emoticons" src="../../assets/emoticons/Hug.png" id="hug" data-value="[hug]">' +
                            '<img class="emoticons" src="../../assets/emoticons/Kiss.png" id="kiss" data-value="[kiss]">' +
                            '<img class="emoticons" src="../../assets/emoticons/Laughing.png" id="laughing" data-value="[laughing]">' +
                            '<img class="emoticons" src="../../assets/emoticons/Ligthbulb.png" id="lightbulb" data-value="[lightbulb]">' +
                            '<img class="emoticons" src="../../assets/emoticons/Loser.png" id="loser" data-value="[loser]">' +
                            '<img class="emoticons" src="../../assets/emoticons/Love.png" id="love" data-value="[love]">' +
                            '<img class="emoticons" src="../../assets/emoticons/Mail.png" id="mail" data-value="[mail]">' +
                            '<img class="emoticons" src="../../assets/emoticons/Music.png" id="music" data-value="[music]">' +
                            '<img class="emoticons" src="../../assets/emoticons/Nerd.png" id="nerd" data-value="[nerd]">' +
                            '<img class="emoticons" src="../../assets/emoticons/Night.png" id="night" data-value="[night]">' +
                            '<img class="emoticons" src="../../assets/emoticons/Ninja.png" id="ninja" data-value="[ninja]">' +
                            '<img class="emoticons" src="../../assets/emoticons/Not-Talking.png" id="not-talking" data-value="[not-talking]">' +
                            '<img class="emoticons" src="../../assets/emoticons/on-the-Phone.png" id="on-the-phone" data-value="[on-the-phone]">' +
                            '<img class="emoticons" src="../../assets/emoticons/Party.png" id="party" data-value="[party]">' +
                            '<img class="emoticons" src="../../assets/emoticons/Pig.png" id="pig" data-value="[pig]">' +
                            '<img class="emoticons" src="../../assets/emoticons/Poo.png" id="poo" data-value="[poo]">' +
                            '<img class="emoticons" src="../../assets/emoticons/Rainbow.png" id="rainbow" data-value="[rainbow]">' +
                            '<img class="emoticons" src="../../assets/emoticons/Rainning.png" id="rainning" data-value="[rainning]">' +
                            '<img class="emoticons" src="../../assets/emoticons/Sacred.png" id="sacred" data-value="[sacred]">' +
                            '<img class="emoticons" src="../../assets/emoticons/Sad.png" id="sad" data-value=":(">' +
                            '<img class="emoticons" src="../../assets/emoticons/Scared.png" id="scared" data-value="[scared]">' +
                            '<img class="emoticons" src="../../assets/emoticons/Sick.png" id="sick" data-value="[sick]">' +
                            '<img class="emoticons" src="../../assets/emoticons/Sick2.png" id="sick2" data-value="[sick2]">' +
                            '<img class="emoticons" src="../../assets/emoticons/Silly.png" id="silly" data-value="[silly]">' +
                            '<img class="emoticons" src="../../assets/emoticons/Sleeping.png" id="sleeping" data-value="[sleeping]">' +
                            '<img class="emoticons" src="../../assets/emoticons/Sleeping2.png" id="sleeping2" data-value="[sleeping2]">' +
                            '<img class="emoticons" src="../../assets/emoticons/Sleepy.png" id="sleepy" data-value="[sleepy]">' +
                            '<img class="emoticons" src="../../assets/emoticons/Sleepy2.png" id="sleepy2" data-value="[sleepy2]">' +
                            '<img class="emoticons" src="../../assets/emoticons/smile.png" id="smile" data-value=":)">' +
                            '<img class="emoticons" src="../../assets/emoticons/Smoking.png" id="smoking" data-value="[smoking]">' +
                            '<img class="emoticons" src="../../assets/emoticons/Smug.png" id="smug" data-value="[smug]">' +
                            '<img class="emoticons" src="../../assets/emoticons/Stars.png" id="stars" data-value="[stars]">' +
                            '<img class="emoticons" src="../../assets/emoticons/Straight-Face.png" id="straight-face" data-value="[straight-face]">' +
                            '<img class="emoticons" src="../../assets/emoticons/Sun.png" id="sun" data-value="[sun]">' +
                            '<img class="emoticons" src="../../assets/emoticons/Sweating.png" id="sweating" data-value="[sweating]">' +
                            '<img class="emoticons" src="../../assets/emoticons/Thinking.png" id="thinking" data-value="[thinking]">' +
                            '<img class="emoticons" src="../../assets/emoticons/Tongue.png" id="tongue" data-value="[tongue]">' +
                            '<img class="emoticons" src="../../assets/emoticons/Vomit.png" id="vomit" data-value="[vomit]">' +
                            '<img class="emoticons" src="../../assets/emoticons/Wave.png" id="wave" data-value="[wave]">' +
                            '<img class="emoticons" src="../../assets/emoticons/Whew.png" id="whew" data-value="[whew]">' +
                            '<img class="emoticons" src="../../assets/emoticons/Win.png" id="win" data-value="[win]">' +
                            '<img class="emoticons" src="../../assets/emoticons/Winking.png" id="winking" data-value="[winking]">' +
                            '<img class="emoticons" src="../../assets/emoticons/Yawn.png" id="yawn" data-value="[yawn]">' +
                            '<img class="emoticons" src="../../assets/emoticons/Yawn2.png" id="yawn2" data-value="[yawn2]">' +
                            '<img class="emoticons" src="../../assets/emoticons/Zombie.png" id="zombie" data-value="[zoombie]">'
                        );

                        $(".emoticons").on('click', function() {
                            var id = $(this).attr('id');
                            var image_url = $(this).data('value');
                            var current_value = $("input#text-input-field").val();

                            $("input#text-input-field").val(current_value + image_url);
                            $(opt.emoticonsModal).modal('hide');

                            // clean stuff to avoid duplication
                            image_url = $(this).data('value').val('');
                        })
                    });

                }

                chat.messages = function() {
                    var construct = {
                        "clientID": 'set',
                        "csrf_test_name": csrfVal

                    };

                    $.post(opt.ajaxMessage, construct, function(response) {
                        if (response) {
                            $("li.messages").replaceWith(response);
                        } else {
                            $("li.messages").remove();
                        }
                    });

                }

                chat.sendOnPress = function() {
                    $('#text-input-field').keypress(function(e) {
                        if (e.which == 13) {
                            chat.sendMessage();
                        }
                    });
                }

                chat.sendOnClick = function() {
                    $("#sendMessage").on('click', function(e) {
                        chat.sendMessage();
                    });
                }

                chat.inputHandler = function() {
                    chat.sendOnPress();
                    chat.sendOnClick();
                }

                chat.update = function() {
                    var construct = {
                        'csrf_test_name': csrfVal,
                        'update': true

                    };
                    $.post(opt.ajaxUpdate, construct, function(response) {
                        $("ul.messages-layout").append(response);
                        $("ul.messages-layout").scroll(function() {
                            $(this).getNiceScroll().resize();
                            clearTimeout(chat.interval);
                        });

                        $("ul.messages-layout").on('scroll', function() {
                            $(this).getNiceScroll().resize();
                            chat.interval = setTimeout(function() {
                                chat.update();
                            }, opt.chatRefresh);
                        });
                        if (response != '') {
                            $("ul.messages-layout").animate({ scrollTop: 999999 }, 'fast');
                        }
                    });

                    chat.interval = setTimeout(function() {
                        chat.update();
                    }, opt.chatRefresh);

                }

                chat.sendMessage = function() {

                    var message_entry = $('#text-input-field').val();
                    var construct = {
                        'csrf_test_name': csrfVal,
                        'message': message_entry,

                    };
                    if (message_entry) {
                        console.log(opt.ajaxSendMessage);
                        $.post(opt.ajaxSendMessage, construct, function(response) {
                            // just send the message chat.update will do the work of getting the message
                            //$("ul.messages-layout").append(response);
                            $("ul.messages-layout").scroll(function() {
                                $(this).getNiceScroll().resize();
                            });

                            $("ul.messages-layout").animate({ scrollTop: 999999 }, 'fast');
                            $('#text-input-field').val('');
                        });
                    }

                }

                chat.renderChat();

                chat.inputHandler();

                chat.update();

                //setInterval(chat.update, opt.chatRefresh);
            } // end chat

    }); // end extend



})(jQuery);
var searchRequest1 = null;
$(function() {
    var minlength = 3;

    $("input#text-input-field").keypress(function(e) {
        var that = this,
            value = $("input#text-input-field").val();
        if (e.keyCode === 0 || e.keyCode === 32) {
            var word = value.split(" ").pop();
            console.log(word.length);
            if (word.length >= minlength) {
                if (searchRequest1 != null)
                    searchRequest1.abort();
                searchRequest1 = $.ajax({
                    type: "GET",
                    url: link + "chat/spam_word/" + word,
                    dataType: "json",
                    success: function(msg) {
                        console.log(msg);
                        if (msg !== "success") {
                            alert(msg);
                            var avoid = word;
                            var lastIndex = value.lastIndexOf(" ");
                            // var abc=value.replace(avoid, '');
                            value = value.substring(0, lastIndex);
                            $("input#text-input-field").val(value);
                        }
                        //we need to check if the value is the same
                        if (value == $(that).val()) {
                            //Receiving the result of search here
                        }
                    }
                });
            }
        }
    });
});
