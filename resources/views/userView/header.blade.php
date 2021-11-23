<html>
<head>
    <title>Facebook-log in or sign up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
          crossorigin="anonymous">
    <link rel="shortcut icon" href="<?php echo asset('images/logo.png'); ?>" />
    <link rel="stylesheet" href="<?php echo asset('css/font-awesome.min.css')?>">
    <link rel="stylesheet" href="<?php echo asset('css/user_view/index.css') ?>">
</head>

<body>



<nav class="navbar navbar-expand-lg navbar-light bg-light" style="position: fixed; width: 100%;">
    <div class="iconAndName">
        <table>
            <tr>
                <th> <i class="fa fa-facebook"></i> </th>
            </tr>
        </table>
    </div>
    <button style="outline: none" class="navbar-toggler" type="button" data-toggle="collapse"
            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse text-center" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto text-center">
            <li class="nav-item active text-center">
                <a style="color: #1877f2" class="nav-link" href="/home"> <i class="fa fa-home"></i> <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item other" data-toggle="modal" data-target="#exampleModal">
                <a style="cursor:pointer;" class="nav-link" data-toggle="modal" data-target="#exampleModalCenter">
                    <i class="fa fa-plus"></i>
                </a>
            </li>
            <li class="nav-item other">
                <a class="nav-link" href="/signOut"> <i class="fa fa-sign-out"></i> </a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <div class="imageAndPhoto">
                <table width="100%">
                    <tr style="width: 100%">
                            <th>
                                @foreach( $isExists as $obj )
                                    <p> <a href="profile/{{ $obj->uId }}">{{ $obj->fullname }}</a> </p>
                                @endforeach
                            </th>
                    </tr>
                </table>
            </div>
        </form>
    </div>
</nav>
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add Post</h5>
                <button style="outline: none" type="button" class="close" data-dismiss="modal" aria-label="Close">
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
<br><br><br>
<div class="left-section text-center" style="position:fixed;">
    <div class="img1">
        <a href="/messenger"> <img src="{{ 'images/massenger.png' }}"/> </a>
    </div>
    <br>
    <div class="img1">
        <a href="/friends"> <img src="{{ 'images/friends2.png' }}"/> </a>
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


