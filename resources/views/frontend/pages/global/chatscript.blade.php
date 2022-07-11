<script>
    jQuery(document).ready(function($) {

        @auth
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
    @endauth

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

    // Load Message Every 5 second
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

    // Main Message Body
    function msgBodyMaintain() {
        let messageBody = document.querySelector('#messageBody');
        messageBody.scrollTop = messageBody.scrollHeight;
    }

    });
</script>
