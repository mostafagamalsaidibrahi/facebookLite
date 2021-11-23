@include('userView.header')

@yield('content')
<br>
@foreach( $timeLine as $obj )
<div class="changable">
    <div class="posts">
        <div class="data">
            @if( $obj->profileImage == "NULL" )
                <img src="<?php echo asset('images/empty_user.png') ?>" />
            @elseif( $obj->profileImage != "NULL")
                <img src="<?php echo asset('uploads/' .  $obj->profileImage ) ?>" alt="" />
            @endif
            <span class="name"> <a href="/friendProfile/{{ $obj->uId }}">{{ $obj->fullname }}</a> </span>
            <span class="time">{{ $obj->time }}</span>
        </div>
        <div class="postContent">
            <p>{{ $obj->postContent }}</p>
        </div>
        <div class="actions">
            <div class="container">
                <div class="row text-center">
                    <div class="like col-3">
                        <a onclick="likePostFun({{$obj->postId}})" style="cursor: pointer"> <p><i class="fa fa-thumbs-o-up"></i></p> </a>
                    </div>
                    <div class="comment col-3">
                        <a style="cursor: pointer"> <p><i class="fa fa-comment-o" data-toggle="modal" data-target="#createComment"></i></p> </a>
                    </div>
                    <div class="share col-3">
                        <a href="/showCommentOfPost/{{ $obj->postId }}" style="cursor:pointer;"> <p><i class="fa fa-eye"></i></p> </a>
                    </div>
                    <div class="share col-3">
                        <a style="cursor: pointer"> <p><i class="fa fa-share" onclick="makeShare( '{{ $obj->postContent }}' )"></i></p> </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
</div>
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

@include('userView.footer')
