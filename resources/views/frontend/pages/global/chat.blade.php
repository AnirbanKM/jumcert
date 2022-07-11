{{-- Chat with Friends --}}
@auth
    <div class="user-head">
        <h2>Chat with Friends</h2>
        <div class="user-box" id="friends_list">
            {{-- List Chatting with Channel Users --}}
        </div>
    </div>
@endauth

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
