<script>
    jQuery(document).ready(function($) {

        function notification(resp, status) {
            new Noty({
                theme: 'sunset',
                type: status,
                layout: 'topRight',
                text: resp,
                timeout: 3000,
                closeWith: ['click', 'button']
            }).show();
        }

        // Popup login Modal
        $('.showLogin').click(function() {

            $('#privateModal').addClass('show').css('display', 'block');
        });

        @auth

        $('body').on('click', '.eachReqModal', function(e) {

            var vid = $(this).data('vid');
            $('#vid').val(vid);
            $("#chatModal").addClass('show').css('display', 'block');
        });

        // Send chat request to the channel owner
        $('body').on('submit', '#sendChatReq', function(e) {
            e.preventDefault();

            var form = $("#sendChatReq");

            $.ajax({
                url: "{{ route('send_chat_req') }}",
                type: "POST",
                dataType: "json",
                data: form.serialize(),
                success: function(resp) {
                    // console.log(resp);
                    if (resp.status == 'error') {
                        $("#sendChatReq")[0].reset();
                        $("#chatModal").removeClass('show').css('display', 'none');

                        var statusparam = resp.status;
                        var msgparam = resp.msg;
                        notification(msgparam, statusparam)
                    } else {
                        $("#chatModal").removeClass('show').css('display', 'none');
                        $("#sendChatReq")[0].reset();

                        var statusparam = resp.status;
                        var msgparam = resp.msg;
                        notification(msgparam, statusparam)
                    }
                }
            });
        });

        // Click On Friend Name || Receiver Name
        $("body").on('click', '.chatM', function(e) {
            e.preventDefault();

            var id = $(this).data('rid');
            var sid = $(this).data('sid');
            var vid = $(this).data('vid');
            var vownerid = $(this).data('vownerid');

            $.ajax({
                url: "{{ route('get_all_msg') }}",
                type: "POST",
                dataType: "json",
                data: {
                    "_token": "{{ csrf_token() }}",
                    friendId: id,
                    senderId: sid,
                    videoId: vid,
                    vownerid: vownerid
                },
                success: function(resp) {
                    // ***List User Chat
                    // console.log(resp);
                    $('#chatModalClose').text(resp[0].name);
                    $('#receiveID').val(id);
                    $('#videoID').val(vid);
                    $('#videoOwnerID').val(vownerid);
                    $('#messageBody').html(resp[0].msg);
                    $("#eachFriendChatModal").addClass('show').css('display', 'block');

                    // ***Load Message Instant
                    loadMsg(id, vid, vownerid);
                    setInterval(function() {
                        loadMsg(id, vid, vownerid);
                    }, 15000);

                    // Maintain message body function
                    msgBodyMaintain();
                }
            })
        });

        //List All Frinds chat List
        setInterval(function() {
            getFrindsList()
        }, 5000);
        getFrindsList();

        function getFrindsList() {
            $.ajax({
                url: "{{ route('frinds_list') }}",
                type: "GET",
                dataType: "json",
                success: function(resp) {
                    // console.log(resp);
                    $('#friends_list').html(resp.myFriends);
                }
            })
        }

        // Message send and appear in the body
        $('body').on('submit', '#msgSendFrm', function(e) {
            e.preventDefault();

            var form = $("#msgSendFrm");

            var receiveID = $('#receiveID').val();
            var videoID = $('#videoID').val();
            var videoOwnerID = $('#videoOwnerID').val();

            $.ajax({
                url: "{{ route('ins_chat_msg') }}",
                type: "POST",
                data: form.serialize(),
                dataType: "json",
                success: function(resp) {
                    // console.log(resp);
                    $("#msgSendFrm")[0].reset()
                    $("#messageBody").append(resp.msg);

                    // Maintain message body function
                    msgBodyMaintain();
                }
            });
        });

        // Load Message Every 5 second for each friends
        function loadMsg(receiveID, videoID, videoOwnerID) {
            $.ajax({
                url: "{{ route('load_auth_user_msg') }}",
                type: "GET",
                dataType: "json",
                data: {
                    receiveID: receiveID,
                    videoID: videoID,
                    videoOwnerID: videoOwnerID
                },
                success: function(resp) {
                    // console.log(resp);
                    $('#messageBody').html(resp[0].msg);

                    // Maintain message body function
                    msgBodyMaintain();
                }
            })
        }

        // Main Message Body
        function msgBodyMaintain() {
            let messageBody = document.querySelector('#messageBody');
            messageBody.scrollTop = messageBody.scrollHeight;
        }

        // Unseen msg count function call every 15sec
        setInterval(function() {
            unseenCountFun();
        }, 10000);

        // Unseen msg count function call just one time
        setTimeout(function() {
            unseenCountFun();
        }, 6000);

        // Unseen msg count function
        function unseenCountFun() {
            $(".unseen").each(function(index) {

                var idTag = $(this).attr('id');
                var chatId = idTag.slice(6, 12);

                $.ajax({
                    url: "{{ route('unseen_count') }}",
                    type: "POST",
                    dataType: "json",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        id: chatId,
                    },
                    success: function(resp) {
                        // console.log(resp);
                        $("#unseen" + chatId).text(resp);
                    }
                })
            });
        };
    @endauth

    // Popup Modal for those who are the owner of the video
    $('.videoOwner').click(function() {

        $('#videoOwnerModal').addClass('show').css('display', 'block');
    });

    // Close videoOwner Modal
    $(".videoOwnerModalClose").click(function(event) {

        $('#videoOwnerModal').removeClass('show').css('display', 'none');
    });

    });
</script>
