<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddCommentRequest;
use App\Http\Requests\addFriendRequest;
use App\Http\Requests\addNewPost;
use App\Http\Requests\UpdateProfilePictureRequest;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function getHome (Request $request){
        // getting user name
        $uId = $request->session()->get('uId');
        // query
        $isExists = DB::table('accounts')->where(['uId' => $uId])->get();
        $arr = Array('isExists'=>$isExists);
        // Getting time line posts
        $timeLine = DB::table('posts')
            ->join('accounts' , 'posts.uId', '=', 'accounts.uId')
            ->join('friendrequest' , 'posts.uId', '=', 'friendrequest.secondSide')
            ->orderBy('posts.postId', 'DESC')
            ->where([ ['posts.uId' , '!=' ,  $uId] , 'friendrequest.firstSide' => $uId , 'friendrequest.status' => 2 ])
            ->get();

        $arr2 = Array('timeLine'=>$timeLine);
        return view('userView.index' , compact('isExists' , 'timeLine'));
    }

    public function getProfile (Request $request , $uId){
        // getting user name
        $uId = $request->session()->get('uId');
        // query
        $isExists = DB::table('posts')
            ->join('accounts' , 'posts.uId', '=', 'accounts.uId')
            ->orderBy('posts.postId', 'DESC')
            ->where(['posts.uId' => $uId ])
            ->get();

        $arr = Array('isExists'=>$isExists);
        return view('userView.profile' , compact('isExists'));
    }

    public function addPost (addNewPost $request){
        // getting user name
        $uId = $request->session()->get('uId');
        //query to add post
        DB::table('posts')->insert(
            ['uId' => $uId ,'postContent' => $request->postContent]
        );
        return response()->json(['msg' => 1]);
    }

    public function deletePost (Request $request){
        DB::table('posts')->where('postId', '=', $request->postIdValue)->delete();
        return response()->json(['msg' => 1]);
    }

    public function likePost (Request $request){
        // getting user name
        $uId = $request->session()->get('uId');
        // query for check if exist or not
        $isExists = DB::table('likes')
            ->where(['postId' => $request->postIdValue , 'uId' => $uId])
            ->get();
        if( count($isExists) > 0 ){
            return response()->json(['msg' => 0]);
        }else{
            //query to like post
            DB::table('likes')->insert(
                ['postId' => $request->postIdValue ,'uId' => $uId]
            );
            return response()->json(['msg' => 1]);
        }

    }

    public function commentOnPost (AddCommentRequest $request){
        // getting user name
        $uId = $request->session()->get('uId');
        // query for check if exist or not
            //query to like post
            DB::table('comments')->insert(
                [ 'uId' => $uId , 'pId' => $request->postId , 'commentContent' => $request->commentContent ]
            );
            return response()->json(['msg' => 1]);
    }

    public function showCommentOfPost (Request $request , $pId){

        // getting user name
        $uId = $request->session()->get('uId');

        $postContent = DB::table('accounts')
            ->join('comments' , 'comments.uId', '=', 'accounts.uId')
            ->join('posts' , 'comments.pId', '=', 'posts.postId')
            ->orderBy('comments.commentId', 'DESC')
            ->where(['comments.pId' => $pId])
            ->get();

        $arr = Array('postContent'=>$postContent);

        return view('userView.comments' , compact('postContent')) ;

    }

    public function sharePost (Request $request){
        // getting user name
        $uId = $request->session()->get('uId');
        //query to add post
        DB::table('posts')->insert(
            ['uId' => $uId ,'postContent' => $request->postContent]
        );
        return response()->json(['msg' => 1]);
    }

    public function updateProfilePicture (Request $req){
//

        if($req->isMethod('post')){
            // getting user id
            $uId = $req->session()->get('uId');

            $img_name = time() . '.' . $req->picture->getClientOriginalExtension();
                // update here
                $affected = DB::table('accounts')
                    ->where('uId', $uId)
                    ->update(['profileImage' => $img_name]);
                if( count($affected) > 0 ){
                    $req->picture->move(public_path('uploads') , $img_name);
                    $req->session()->forget('profileImage');
                    $gettingData = DB::table('accounts')->where('uId', $uId)->get();
                    foreach ($gettingData as $key) {
                        $uProfileValue = $req->session()->put('profileImage' , $key->profileImage);
                        return redirect('profile/' . $uId);
                    }
                }
        }

    }

    public function gettingFriendsSectionData (Request $request){

        // getting All Users From System For [ Add Friend ]
        $uId = $request->session()->get('uId');
        // query for getting all users to send friend request
        $Users1 = DB::table('friendrequest')
            ->where([ 'firstSide' => $uId ])->orWhere([ 'secondSide' => $uId ])
            ->select('firstSide' , 'secondSide')
            ->get();

        $arr = array() ;

        $counter = 0 ;

        foreach ( $Users1 as $obj ){
            if( $obj->firstSide != $uId || $obj->secondSide != $uId ){
                array_push( $arr , $obj->firstSide , $obj->secondSide) ;
                $counter++;
            }
        }

        $Users = DB::table('accounts')->whereNotIn('uId', $arr)->where('uId' , '!=' , $uId)->get();
        // putting data in array
        $arr = Array('Users'=>$Users);

        // query for getting my friends
        $myFriends = DB::table('friendrequest')
            ->join('accounts' , 'accounts.uId', '=', 'friendrequest.secondSide')
            ->where(['friendrequest.firstSide' => $uId , 'friendrequest.status' => 2 ])
            ->get();

        // putting data in array
        $arr2 = Array('myFriends'=>$myFriends);

        // query for getting my friend Requestes Status
        $myFriendsRequestStatus = DB::table('friendrequest')
            ->join('accounts' , 'accounts.uId', '=', 'friendrequest.secondSide')
            ->where([ ['friendrequest.firstSide' , '=' , $uId]  ])
            ->get();

        // putting data in array
        $arr3 = Array('myFriendsRequestStatus'=>$myFriendsRequestStatus);

        //  query for getting friend Requestes
        $myFriendsRequests = DB::table('friendrequest')
            ->join('accounts' , 'accounts.uId', '=', 'friendrequest.firstSide')
            ->where([ ['friendrequest.secondSide' , '=' , $uId] , [ 'friendrequest.status' , '=' , 0 ]  ])
            ->get();

        // putting data in array
        $arr4 = Array('myFriendsRequests'=>$myFriendsRequests);

        return view('userView.friendsSection' , compact('Users' , 'myFriends' , 'myFriendsRequestStatus' , 'myFriendsRequests'));
    }

    public function addFriend (addFriendRequest $request){
        // getting id
        $uId = $request->session()->get('uId'); // 4
        // check if exists or not
        $isExists = DB::table('friendRequest')
            ->where(['firstSide' => $uId , 'secondSide' => $request->secondSideId])
            ->get();
        if( count($isExists) > 0 ){
            return response()->json(['msg' => 0]);
        }else{
            // query
        DB::table('friendRequest')->insert(
            ['firstSide' => $uId ,'secondSide' => $request->secondSideId]
        );
        return response()->json(['msg' => 1]);
        }
//
    }

    public function acceptFriend (Request $request , $fId){
        // getting id of all users
        $uId = $request->session()->get('uId');

        $affected = DB::table('friendrequest')
            ->where([ 'secondSide'=> $uId ] , [ 'firstSide'=> $fId ])
            ->update(['status' => 2]);

        if( count($affected) > 0 ){
            DB::table('friendrequest')->insert(
                ['firstSide' => $uId, 'secondSide' => $fId , 'status' => 2]
            );

            return redirect('/friends');
        }

    }

    public function rejectFriend (Request $request , $fId){
        // getting id of all users
        $uId = $request->session()->get('uId');

        $affected = DB::table('friendrequest')
            ->where([ 'secondSide'=> $uId ] , [ 'firstSide'=> $fId ])
            ->update(['status' => 3]);

        if( count($affected) > 0 ){
            DB::table('friendrequest')->insert(
                ['firstSide' => $uId, 'secondSide' => $fId , 'status' => 3]
            );

            return redirect('/friends');
        }
    }

    public function friendProfile (Request $request , $fId){


        // query for getting data of this friend
        $request->session()->forget('friendProfile');

        $friendData = DB::table('accounts')->where(['uId' => $fId])->get();
        $arr1 = Array('friendData'=>$friendData);

        $friendContentData = DB::table('posts')
            ->join('accounts' , 'posts.uId', '=', 'accounts.uId')
            ->orderBy('posts.postId', 'DESC')
            ->where(['posts.uId' => $fId])
            ->get();
        $arr2 = Array('friendContentData'=>$friendContentData);
            // saving friend profile image in session
        foreach ($friendData as $obj){
            $uProfileValue = $request->session()->put('friendProfile' , $obj->profileImage);
        }

        return view('userView.friendProfile' , compact('friendData' , 'friendContentData'));
    }

    public function sendMsg (Request $request){
        // getting user name
        $uId = $request->session()->get('uId');
        // getting friendID
        $fId = $request->session()->get('fId');
        //query to add post
        DB::table('messenger')->insert(
            ['uId' => $uId ,'fId' => $fId , 'msg' => $request->message]
        );
        return response()->json(['msg' => 1]);
    }

    public function messenger (Request $request){

        // getting user name
        $uId = $request->session()->get('uId');
        // query
        $isExists = DB::table('accounts')
            ->where([ ['uId' , '!=' , $uId] , ['active' , '=' , 1] ])
            ->get();

        $arr = Array('isExists'=>$isExists);

        return view('userView.messenger' , compact('isExists'));
    }

    public function goToFriendChat (Request $request , $fId){
            // getting my Id
            $uId = $request->session()->get('uId');

            $fIdValue = $request->session()->put('fId' , $fId);

        $friendId = $request->session()->get('fId');

            $isExists = DB::table('messenger')
                ->join('accounts' , 'accounts.uId', '=', 'messenger.uId')
                ->where([ [ 'messenger.uId' , '=' , $uId ] , [ 'messenger.fId' , '=' , $fId ] ])
                ->orWhere([ [ 'messenger.uId' , '=' , $fId ] , [ 'messenger.fId' , '=' , $uId ] ])
                ->select('messenger.msg')
                ->get();

            $arr2 = Array('isExists'=>$isExists);

            return view('userView.chatContent' , compact('isExists'));



//        $list = json_encode($isExists);
//
//        print_r($list);
    }

}
