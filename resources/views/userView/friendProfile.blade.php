<html>
<head>
    <title>Facebook-log in or sign up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
          crossorigin="anonymous">
    <link rel="shortcut icon" href="<?php echo asset('images/logo.png'); ?>" />
    <link rel="stylesheet" href="<?php echo asset('css/font-awesome.min.css')?>">
    <link rel="stylesheet" href="<?php echo asset('css/user_view/index.css') ?>">
    <link rel="stylesheet" href="<?php echo asset('css/user_view/profile.css') ?>">
    <link rel="stylesheet" href="<?php echo asset('css/user_view/friendProfile.css') ?>">
</head>

<body>

<div class="main-profile">
    <div class="cover">
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        <div class="profileImage">
            @if( Session::get('friendProfile') == "NULL" )
                <img src="<?php echo asset('images/empty_user.png') ?>" alt=""> </th>
            @elseif( Session::get('friendProfile') != "NULL" )
                <img src="<?php echo asset('uploads/' . Session::get('friendProfile') ) ?>" alt="">
            @endif
        </div>
    </div>
</div>

<div class="left-section addNav text-center" style="position:fixed; height: 100px;">
    <div class="img1">
        <a href="/home"> <img src="<?php echo asset( "images/home.png") ?>" style="width: 95%;" /> </a>
    </div>
</div>


@foreach( $friendContentData as $obj )
    <br><br><br><br><br><br>
    <div class="firendName"> <span> {{ $obj->fullname }} </span> </div>
    <br><br>
    <div class="changable" id="changeableDiv" style="height: 74% !important;">
        <div class="posts">
            <div class="data">
                @if( $obj->profileImage == "NULL" )
                    <img src="<?php echo asset('images/empty_user.png') ?>" />
                @elseif( $obj->profileImage != "NULL")
                    <img src="<?php echo asset('uploads/' .  $obj->profileImage ) ?>" alt="" />
                @endif
                <span class="name"> {{ $obj->fullname }} </span>
                <span class="time">{{ $obj->time }}</span>
                <br/>
                <div class="icons text-center">
                    <form>
                        <input type="text" value="{{ $obj->postId }}"  hidden />
                    </form>
                </div>
            </div>
            <div class="postContent">
                <p>{{ $obj->postContent }}</p>
            </div>
            <div class="actions">
                <div class="container">
                    <div class="row text-center">
                        <div class="like col-6">
                            <form>
                                <a onclick="likePostFun({{$obj->postId}})" style="cursor: pointer"> <p><i class="fa fa-thumbs-o-up"></i></p> </a>
                            </form>
                        </div>
                        <div class="comment col-6">
                            <a href=""> <p><i class="fa fa-comment-o"></i></p> </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
    </div>
@endforeach

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    function likePostFun ($postId){
        let data = {
            postIdValue: $postId,
            _token: '{{ csrf_token() }}'
        }
        $.ajax({
            method: 'post',
            url: '{{ route('likePost') }}',
            data: data,
            success(response){
                if(response.msg == 1){
                    alert('Liked');
                }else{
                    alert('Liked Before');
                }
            }
        })
    }
</script>
</body>

</html>
