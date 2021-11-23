<html>
<head>
    <title>Facebook-log in or sign up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
          crossorigin="anonymous">
    <link rel="shortcut icon" href="<?php echo asset('images/logo.png'); ?>" />
    <link rel="stylesheet" href="<?php echo asset('css/user_view/friendsSection.css') ?>">
    <link rel="stylesheet" href="<?php echo asset('css/user_view/comments.css') ?>">
    <link rel="stylesheet" href="<?php echo asset('css/user_view/index.css') ?>">
    <link rel="stylesheet" href="<?php echo asset('css/font-awesome.min.css')?>">
    <link rel="stylesheet" href="<?php echo asset('css/user_view/messenger.css') ?>">
</head>

<body>

<div class="chatContent">
<br><br><br>
    <div class="chatWindow">
        <div class="messages" style="overflow:scroll; overflow: auto;">
            <br>
            <div class="messageDetails" id="messageDetails">
                @foreach( $isExists as $obj )
                            <div class="iSend" >
                                {{ $obj->msg }}
                            </div>
                    <hr>
                @endforeach
            </div>
        </div>
        <div class="actions">
            <br>
            <table width="100%">
                <tr>
                    <th width="90%"><input class="form-control" type="text" id="msgContent"></th>
                    <th width="10%;" style="text-align: center" onclick="sendMsg( $('#msgContent').val() )"><span> <i class="fa fa-paper-plane"></i> </span></th>
                </tr>
            </table>
        </div>
        <br>
        <div class="back" style="padding: 0px!important;">
            <a href="/home"> <i class="fa fa-home"></i> </a>
        </div>
    </div>
</div>




<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    function sendMsg ( $msg ){

        let data = {
            'message' : $msg ,
            'friendId' : $('#userId').val() ,
            _token: '{{ csrf_token() }}'
        }

        $.ajax({
            method: 'post',
            url: '{{ route('sendMsg') }}',
            data: data,
            success(response){
                if(response.msg == 1){
                    $('#msgContent').val('');
                    $('#messageDetails').append('<div class="iSend">' + $msg + '</div><br/>');
                }
            }
        })
    }
</script>

</body>

</html>
