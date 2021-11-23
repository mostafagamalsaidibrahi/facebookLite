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
</head>

<body>
    <div class="main-profile">
        <div class="cover">
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
            <div class="profileImage">
                @if( Session::get('profileImage') == "NULL" )
                    <img src="<?php echo asset('images/empty_user.png') ?>" alt=""> </th>
                @elseif( Session::get('profileImage') != "" )
                    <img src="<?php echo asset('uploads/' . Session::get('profileImage') ) ?>" alt="">
                @endif
            </div>
        </div>
    </div>

    <br><br><br><br>
    <div class="updateProfileImageAction text-center">
        <!-- Button trigger modal -->
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary showModel" data-toggle="modal" data-target="#exampleModalCenter">
            Update Profile Image
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form method="post" action="/updateProfilePicture" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="modal-body">
                            <div id="errorUpdateProfileImage"></div>
                            <input type="file" name="picture" accept="image/x-png,image/gif,image/jpeg">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" id="btnUploadImage">Change Profile Image</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <div class="left-section addNav text-center" style="position:fixed;">
        <div class="img1" data-toggle="modal" data-target="#exampleModal2">
            <a> <img src="<?php echo asset( "images/add.png") ?>" /> </a>
        </div>
        <div class="img1">
            <a href="/home"> <img src="<?php echo asset( "images/home.png") ?>" /> </a>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Post</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form>
                    <div id="errors"></div>
                    <div class="modal-body">
                        <textarea id="postContent" name="postContent"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary add" id="savePost">Save Post</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <br>
    @foreach( $isExists as $obj )
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
                        <a onclick="deletePostFun({{$obj->postId}})" style="cursor: pointer">
                            <span class="iconAction" style="margin-left: 20px;"> <i class="fa fa-trash-o"></i> </span>
                        </a>
                    </form>
                </div>
            </div>
            <div class="postContent">
                <p>{{ $obj->postContent }}</p>
            </div>
            <div class="actions">
                <div class="container">
                    <div class="row text-center">
                        <div class="like col-4">
                            <form>
                                <a  onclick="likePostFun({{$obj->postId}})" style="cursor: pointer"> <p><i class="fa fa-thumbs-o-up"></i></p> </a>
                            </form>
                        </div>
                        <div class="comment col-4">
                            <a style="cursor:pointer;"> <p><i class="fa fa-comment-o" data-toggle="modal" data-target="#createComment"></i></p> </a>
                        </div>
                        <div class="comment col-4">
                            <a href="/showCommentOfPost/{{ $obj->postId }}" style="cursor:pointer;"> <p><i class="fa fa-eye"></i></p> </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
    </div>
    <br>

    <!-- Modal for adding comment -->
    <div class="modal fade" id="createComment" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Create Comment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form>
                    <br>
                    <div id="commentErrors"></div>
                    <div class="modal-body">
                        <textarea id="commentContent" name="postContent"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary add" onclick="addComment( {{ $obj->postId }} )">Save Comment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        $('#savePost').on('click', function (event) {
            event.preventDefault();
            let data = {
                postContent: $('#postContent').val(),
                _token: '{{ csrf_token() }}'
            }
            $.ajax({
                method: 'post',
                url: '{{ route('addPost') }}',
                data: data,
                success(response){
                    if(response.msg == 1){
                        alert('Post is added');
                        $('#postContent').val('');
                        $('#errors').hide();
                        location.reload(true);
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
        })
        function deletePostFun ($postId){
            let data = {
                postIdValue: $postId,
                _token: '{{ csrf_token() }}'
            }
            $.ajax({
                method: 'post',
                url: '{{ route('deletePost') }}',
                data: data,
                success(response){
                    if(response.msg == 1){
                        alert('Deleted');
                        location.reload(true);
                    }
                }
            })
        }
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
        function addComment($postId){
            let data = {
                commentContent: $('#commentContent').val(),
                postId: $postId,
                _token: '{{ csrf_token() }}'
            }

            $.ajax({
                method: 'post',
                url: '{{ route('commentOnPost') }}',
                data: data,
                success(response){
                    if(response.msg == 1){
                        alert('Comment is added');
                        $('#commentContent').val('');
                        $('#commentErrors').hide();
                    }
                },
                error(response){
                    let errors = response.responseJSON.errors;
                    for (const [key, value] of Object.entries(errors)) {
                        let errorLi = `<div class="alert alert-danger" role="alert">${value[0]}</div>`;
                        $('#commentErrors').append(errorLi);
                    }
                }
            })
        }

    </script>

</body>

</html>
