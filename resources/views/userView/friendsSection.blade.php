<!DOCTYPE html>
<html lang="en">
<head>
    <title>Facebook</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="<?php echo asset('css/font-awesome.min.css')?>">
    <link rel="stylesheet" href="<?php echo asset('css/user_view/friendsSection.css') ?>">
</head>
<body>
<div class="container">
    <h2>Friends Section</h2>
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#myFriends">My Friends</a></li>
        <li><a data-toggle="tab" href="#addFriend">Add Friend</a></li>
        <li><a data-toggle="tab" href="#friendRequestsStatus">My Friend Requests Status</a></li>
        <li><a data-toggle="tab" href="#friendRequests">Friend Requests</a></li>
    </ul>

    <div class="tab-content">
        <div id="myFriends" class="tab-pane fade in active myFriends">
            <h3>My Friends</h3>
            <div class="container">
                <div class="row">
                    <div class="friendZone">
                        @foreach( $myFriends as $objFriends )
                            <div class="friend col-lg-4 col-md-4 col-sm-3 col-xs-12">
                                <div class="profileImage">
                                    @if($objFriends->profileImage == "NULL")
                                        <img src="<?php echo asset("images/empty_user.png") ?>" />
                                    @elseif($objFriends->profileImage != "NULL")
                                        <img src=" {{ 'uploads/' .  $objFriends->profileImage  }} " alt="" />
                                    @endif
                                </div>
                                <div class="fullname">
                                    <a href="friendProfile/{{ $objFriends->uId }}"><span>{{ $objFriends->fullname }}</span></a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div id="addFriend" class="tab-pane fade addFriend">
            <h3>Add Friend</h3>
            <div class="container">
                <div class="row">
                    <div class="friendZone">
                            @foreach( $Users as $objUsers )
                                <div class="friend col-lg-4 col-md-4 col-sm-3 col-xs-12">
                                    <div class="profileImage">
                                        @if($objUsers->profileImage == "NULL")
                                            <img src="<?php echo asset("images/empty_user.png") ?>" />
                                        @elseif($objUsers->profileImage != "NULL")
                                            <img src=" {{ 'uploads/' .  $objUsers->profileImage  }} " alt="" />
                                        @endif
                                    </div>
                                    <div class="fullname">
                                        <a href="friendProfile/{{ $objUsers->uId }}"><span>{{ $objUsers->fullname }}</span></a>
                                    </div>
                                    <div class="btnAdd">
                                        <input type="button" id="btnAdd" onclick="addFriendFun( {{ $objUsers->uId }} )" value="Add Friend" class="btn">
                                    </div>
                                </div>
                            @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div id="friendRequestsStatus" class="tab-pane fade friendRequestsStatus">
            <h3>Friend Requests Status</h3>
            <div class="container">
                <div class="row">
                    <div class="friendZone">
                        @foreach( $myFriendsRequestStatus as $objUsers )
                            @if( $objUsers->status == "3" )
                            <div class="friend col-lg-4 col-md-4 col-sm-3 col-xs-12">
                                <div class="profileImage">
                                    @if($objUsers->profileImage == "NULL")
                                        <img src="<?php echo asset("images/empty_user.png") ?>" />
                                    @elseif($objUsers->profileImage != "NULL")
                                        <img src=" {{ 'uploads/' .  $objUsers->profileImage  }} " alt="" />
                                    @endif
                                </div>
                                <div class="fullname">
                                    <a href="friendProfile/{{ $objUsers->uId }}"><span>{{ $objUsers->fullname }}</span></a>
                                </div>
                                <div class="btnAdd">
                                    <span style="color: red">Rejected</span>
                                </div>
                            </div>
                            @elseif( $objUsers->status == "0" )
                                <div class="friend col-lg-4 col-md-4 col-sm-3 col-xs-12">
                                    <div class="profileImage">
                                        @if($objUsers->profileImage == "NULL")
                                            <img src="<?php echo asset("images/empty_user.png") ?>" />
                                        @elseif($objUsers->profileImage != "NULL")
                                            <img src=" {{ 'uploads/' .  $objUsers->profileImage  }} " alt="" />
                                        @endif
                                    </div>
                                    <div class="fullname">
                                        <a href="friendProfile/{{ $objUsers->uId }}"><span>{{ $objUsers->fullname }}</span></a>
                                    </div>
                                    <div class="btnAdd">
                                        <span style="color: blue">Waiting</span>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div id="friendRequests" class="tab-pane fade friendRequests">
            <h3>Friend Requests</h3>
            <div class="container">
                <div class="row">
                    <div class="friendZone">
                        @foreach( $myFriendsRequests as $objUsers )
                            <div class="friend col-lg-4 col-md-4 col-sm-3 col-xs-12">
                                <div class="profileImage">
                                    @if($objUsers->profileImage == "NULL")
                                        <img src="<?php echo asset("images/empty_user.png") ?>" />
                                    @elseif($objUsers->profileImage != "NULL")
                                        <img src=" {{ 'uploads/' .  $objUsers->profileImage  }} " alt="" />
                                    @endif
                                </div>
                                <div class="fullname">
                                    <a href="friendProfile/{{ $objUsers->uId }}"><span>{{ $objUsers->fullname }}</span></a>
                                </div>
                                <div class="btnAdd">
                                        <a style="color: green; font-weight: bold; margin-right: 5px;" href="/acceptFriend/{{ $objUsers->firstSide }}">Accept</a>
                                        <a style="color: red; font-weight: bold" href="/rejectFriend/{{ $objUsers->firstSide }}">Reject</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br><br><br><br>
<div class="back">
    <a href="/home"> <i class="fa fa-home"></i> </a>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    function addFriendFun( $secondSideId ){
        let data = {
            secondSideId : $secondSideId ,
            _token: '{{ csrf_token() }}'
        }
        $.ajax({
            method: 'post',
            url: '{{ route('addFriend') }}',
            data: data,
            success(response){
                if(response.msg == 1){
                    alert('Requested');
                    location.reload(true);
                }else {
                    alert('Requested Before Or In Friend Request Section');
                }
            },
            error(response){
                let errors = response.responseJSON.errors;
                for (const [key, value] of Object.entries(errors)) {
                    let errorLi = `<div class="alert alert-danger" role="alert">${value[0]}</div>`;
                    $('#errors').append(errorLi);
                }
            }
        })
    }

</script>

</body>

</html>

