<style>
    h6.unseen {
        font-size: 10px;
        background: green;
        border-radius: 50%;
        padding: 5px;
        line-height: 5px;
    }
</style>

{{-- Chat with Friends --}}
@auth
    <div class="user-head">
        <h2>Chat with Friends</h2>
        <div class="user-box" id="friends_list">
            {{-- List Chatting with Channel Users --}}
        </div>
    </div>
@endauth

{{-- Modal for purchase private videos --}}
<div class="modal fade" id="privateModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">
                    This is a private video
                </h4>
                <button type="button" class="privateModalClose" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @guest('web')
                    <p class="text-center">
                        Login to Jumcert account with your credentials
                    </p>
                    <button class="btn btn-primary" id="loginJumcertBtn" style="display: table;margin: 0 auto;">
                        Login to Jumcert
                    </button>
                @endguest

                @auth('web')
                    <p class="text-center" style="margin-bottom: 15px;">
                        This is a private video, you need to purchase this video
                    </p>
                    <form action="{{ route('private_video_cart') }}" method="POST">
                        @csrf
                        <input type="hidden" class="form-control" name="vId" id="vId" />
                        <input type="submit" class="btn btn-primary" value="Purchase this video"
                            style="display: table;margin: 0 auto;" />
                    </form>
                @endauth

            </div>
        </div>
    </div>
</div>

{{-- Modal for 1:Many Chatting Users->Channel && Channel->Users --}}
<div class="modal user-chat" id="eachFriendChatModal" tabindex="-1" role="dialog" aria-modal="true">

    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                {{-- Modal Close --}}
                <a href="#" data-toggle="modal" data-target="#chatModalClose" data-backdrop="false">
                    <span>A</span>
                    <h4 class="modal-title" id="chatModalClose"></h4>
                </a>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body p-0">
                <div class="user">

                    {{-- Message Body --}}
                    <div id="messageBody"></div>

                    {{-- Chat Form --}}
                    <form id="msgSendFrm">
                        @csrf
                        <div class="chat-box__input">
                            <input type="hidden" name="receiveID" id="receiveID" />
                            <input type="hidden" name="videoID" id="videoID" />
                            <input type="hidden" name="videoOwnerID" id="videoOwnerID" />
                            <input type="text" name="msg" placeholder="send message" />
                            <input type="submit"
                                style="background-image: url({{ asset('frontend/img/chatreq.svg') }});" />
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

@auth
    {{-- Modal for chat request with Channel Owner --}}
    <div class="modal fade popup-modal" id="chatModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Chat box</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form id="sendChatReq">
                    @csrf
                    <input type="hidden" id="vid" name="vid" />
                    <div class="chat-box__input">
                        <input type="text" name="msg" placeholder="send message" />
                        <input type="submit"
                            style="background-image: url({{ asset('frontend/img/chatreq.svg') }}); font-size: 0;" />
                    </div>
                </form>
            </div>
        </div>
    </div>
@endauth
