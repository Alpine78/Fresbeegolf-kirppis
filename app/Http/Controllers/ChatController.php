<?php

namespace App\Http\Controllers;


Use App\Events\MessagePosted;
use App\Chat;
use App\User;
use function GuzzleHttp\Psr7\copy_to_string;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use phpDocumentor\Reflection\Types\Integer;


class ChatController extends Controller
{

public function sendMessage(Request $request) {
    //katsotaan onko kirjautunut sisään.
    if(Auth::check()){
        $user1 = Auth::user();

        event(new MessagePosted("Message Posted"));
            //luodaan kokonaan uusi chat
            return Chat::create([
                'user_id' => $user1->id,
                'user_2' => $request->params["user2"],
                'content' => $request->params["message"],
            ]);
    }else{
        return response("not logged in");
    }

}

public function fetchConversations(){
    if(Auth::check()){
        $user1 = Auth::user();
        $chatsFirst = Chat::select('user_2','user_id')->where('user_2', $user1->id);
        $chatsSecond = Chat::select('user_id','user_2')->where('user_id', $user1->id)->union($chatsFirst)->distinct()->get();
    $users = [];
    foreach($chatsSecond as $value){
        $userFetched = User::select()->where('id', $value->user_2)->get();
        array_push($users, $userFetched);
    }


        return $users;

    }
}

public function fetchMessages(Request $request){
    if(Auth::check()){
        $user1 = Auth::user();
        $user2 = User::findOrFail($request->user);
        $fetch = Chat::select()->where('user_id', $user1->id)->where('user_2', $user2->id);

        $messages = Chat::select()->where('user_2', $user1->id)->where('user_id', $user2->id)->union($fetch)->orderBy('created_at','asc')->get();

        return [$messages, $user1, $user2];
    }
}



}