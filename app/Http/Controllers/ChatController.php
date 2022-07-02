<?php

namespace App\Http\Controllers;

use App\Models\Frontend\Chat;
use App\Models\Frontend\VideoUpload;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        $authUserId = auth()->user()->id;
        $chatRequests = Chat::where('owner_id', $authUserId)->where('status', 'Inactive')->with('userinfo', 'userProfile')->get();
        return view('frontend.pages.chat.list', ['chatRequests' => $chatRequests]);
    }

    public function send_chat_req(Request $r)
    {
        $vid = $r->vid; // Video Id
        $msg = $r->msg; //

        $videoQuery = VideoUpload::find($vid);
        $ownerID = $videoQuery->user_id; // Owner Id && Receiver Id
        $senderID = auth()->user()->id; // Sender Id

        //Check if already chat request exist
        $check = Chat::where('sender_id', $senderID)->where('receiver_id', $ownerID)
            ->where('status', 'Active')->orWhere('status', 'Inactive')
            ->get();

        if (count($check) > 0) {
            echo json_encode([
                'status' => 'error',
                'msg' => 'You are already sent request please wait'
            ]);
        } else {
            $obj = new Chat();
            $obj->video_id = $vid;
            $obj->channel_id = 0;
            $obj->owner_id = $ownerID;
            $obj->sender_id = $senderID;
            $obj->receiver_id = $ownerID;
            $obj->msg = $msg;
            $obj->chat_id = rand(100000, 999999);
            $obj->save();

            echo json_encode([
                'status' => 'success',
                'msg' => 'Your chat request has sent to the channel'
            ]);
        }
    }

    public function update_chat_req(Request $r)
    {
        $chatid = $r->cid;
        $status = $r->status;

        $obj = Chat::find($chatid);
        $obj->status = $status;
        $obj->update();

        if ($status == "Active") {
            $msg = "Your are created a connection";
            return redirect()->route('home')->with('success', $msg);
        } else {
            $msg = "You are declined this user";
            return redirect()->route('view_chat_requests')->with('success', $msg);
        }
    }

    public function get_all_msg(Request $r)
    {
        $authUserId = auth()->user()->id;

        $receiverId = $r->friendId;
        $senderId = $r->senderId; // Not Need
        $videoId = $r->videoId;
        $vownerid = $r->vownerid;

        // Fetch receiver info || Receiver Name
        $userInfo = User::find($receiverId);
        $name = $userInfo->name;
        $html['name'] = $name;
        $html['msg'] = '';

        // Find Auth Sender Msg && Friendly Receiver Msg
        $query = Chat::where('owner_id', $vownerid)->where('video_id', $videoId)
            ->where(function ($q) use ($authUserId, $receiverId) {
                $q->where("sender_id", $authUserId)->where("receiver_id", $receiverId);
            })->orwhere(function ($q) use ($authUserId, $receiverId) {
                $q->where("receiver_id", $authUserId)->where("sender_id", $receiverId);
            })->get();


        foreach ($query as $chat) {
            if ($chat->sender_id == auth()->user()->id) {
                $html['msg'] .= '<div class="user-outgoing"> <p>' . $chat->msg . '</p> </div>';
            } else {
                $html['msg'] .= '<div class="user-incoming"> <p>' . $chat->msg . '</p> </div>';
            }
        }

        echo json_encode([$html]);
    }

    public function ins_chat_msg(Request $r)
    {
        $receiveID = $r->receiveID;
        $videoID = $r->videoID;
        $msg = $r->msg;
        $videoOwnerID = $r->videoOwnerID;

        $html['msg'] = '';

        $obj = new Chat();
        $obj->video_id = $videoID;
        $obj->owner_id = $videoOwnerID;
        $obj->sender_id = auth()->user()->id;
        $obj->receiver_id = $receiveID;
        $obj->msg = $msg;
        $obj->chat_id = rand(100000, 999999);
        $obj->save();

        if ($obj->sender_id == auth()->user()->id) {
            $html['msg'] .= '<div class="user-outgoing"> <p>' . $obj->msg . '</p> </div>';
        } else {
            $html['msg'] .= '<div class="user-incoming"> <p>' . $obj->msg . '</p> </div>';
        }

        echo json_encode($html);
    }

    public function load_auth_user_msg(Request $r)
    {
        $authUserId = auth()->user()->id;

        $receiverId = $_GET['receiveID'];
        $videoId = $_GET['videoID'];
        $vownerid = $_GET['videoOwnerID'];

        // Set Unseen Msg => Seen Msg || 0 => 1
        $obj = Chat::where('video_id', $videoId)->first();
        $sid = $obj->sender_id;
        $rid = $obj->receiver_id;

        if ($authUserId == $rid) {
            $unSeenQuery = Chat::where('receiver_id', $authUserId)->where('sender_id', $sid)->update(['seen' => 1]);
        } else {
            $unSeenQuery = Chat::where('receiver_id', $authUserId)->where('sender_id', $rid)->update(['seen' => 1]);
        }

        $html['msg'] = '';

        // Find Auth Sender Msg && Friendly Receiver Msg
        $query = Chat::where('owner_id', $vownerid)->where('video_id', $videoId)->where(function ($q) use ($authUserId, $receiverId) {
            $q->where("sender_id", $authUserId)->where("receiver_id", $receiverId);
        })->orwhere(function ($q) use ($authUserId, $receiverId) {
            $q->where("receiver_id", $authUserId)->where("sender_id", $receiverId);
        })->get();

        // Return HTML
        foreach ($query as $chat) {
            if ($chat->sender_id == auth()->user()->id) {
                $html['msg'] .= '<div class="user-outgoing"> <p>' . $chat->msg . '</p> </div>';
            } else {
                $html['msg'] .= '<div class="user-incoming"> <p>' . $chat->msg . '</p> </div>';
            }
        }

        echo json_encode([$html, $unSeenQuery]);
    }

    public function frinds_list()
    {
        $authUserID = auth()->user()->id;

        $friends = Chat::where('status', 'Active')->where('sender_id', '=', $authUserID)
            ->orwhere('owner_id', '=', $authUserID)->where('status', 'Active')
            ->with('receiverInfo', 'userinfo')->get();

        $html['myFriends'] = '';

        foreach ($friends as $user) {
            if (Auth::user()->id == $user->sender_id) {

                $html['myFriends'] .= ' <a href="javascript:void()" class="chatM receive" data-rid=' . $user->receiver_id . '
                            data-sid=' . $user->sender_id . ' data-vid=' . $user->video_id . '
                            data-vownerid=' . $user->owner_id . ' >
                            <span class="text-uppercase">' . substr($user->receiverInfo->name, 0, 1) . '</span>
                            <h4>' . $user->receiverInfo->name . '</h4>
                            <h6 class="unseen" id="unseen' . $user->chat_id . '"> </h6>
                        </a>';
            } else {

                $html['myFriends'] .= ' <a href="javascript:void()" class="chatM send" data-rid=' . $user->sender_id . '
                    data-sid=' . $user->sender_id . ' data-vid=' . $user->video_id . '
                    data-vownerid=' . $user->owner_id . ' >
                    <span class="text-uppercase">' . substr($user->userinfo->name, 0, 1) . '</span>
                    <h4>' . $user->userinfo->name . '</h4>
                    <h6 class="unseen" id="unseen' . $user->chat_id . '"> </h6>
                </a>';
            }
        }
        echo json_encode($html);
    }

    // Unseen Count
    public function unseen_count(Request $r)
    {
        $authUserID = auth()->user()->id;

        $id = $r->id;
        $chat = Chat::where('chat_id', $id)->first();
        $receiverId = $chat->receiver_id;
        $senderId = $chat->sender_id;

        if ($authUserID == $receiverId) {
            $query = Chat::where('receiver_id', $authUserID)
                ->where('sender_id', $senderId)
                ->where('seen', 0)->count();
        } else {
            $query = Chat::where('receiver_id', $authUserID)
                ->where('sender_id', $receiverId)
                ->where('seen', 0)->count();
        }

        echo json_encode($query);
    }
}
