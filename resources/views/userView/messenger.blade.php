<html>
<head>
    <title>Facebook-log in or sign up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
          crossorigin="anonymous">
    <link rel="shortcut icon" href="<?php echo asset('images/logo.png'); ?>" />
    <link rel="stylesheet" href="<?php echo asset('css/font-awesome.min.css')?>">
    <link rel="stylesheet" href="<?php echo asset('css/user_view/messenger.css') ?>">
</head>

<body>
<br><br><br><br><br><br>
<div class="onlineFriends" style="overflow:scroll; overflow: auto;">
    <div class="friends">
        @foreach( $isExists as $obj )

            <div class="content" style="cursor: pointer">
                @if( $obj->profileImage == "NULL" )
                    <img src="<?php echo asset('images/empty_user.png') ?>" />
                @else
                    <img src="<?php echo asset('uploads/' .  $obj->profileImage ) ?>" id="activeFriendImage" />
                @endif
                <span class="name"><a href="/face_Messenger/{{ $obj->uId }}"> {{ $obj->fullname }}  </a> </span>
                <span> <i class="fa fa-circle"></i> </span>
            </div>
            <hr>
        @endforeach
    </div>
</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</body>

</html>
