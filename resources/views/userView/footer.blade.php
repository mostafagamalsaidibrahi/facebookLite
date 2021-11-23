
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

    function makeShare( $postContent ){

        let data = {
            'postContent' : $postContent ,
            _token: '{{ csrf_token() }}'
        }

        $.ajax({
            method: 'post',
            url: '{{ route('sharePost') }}',
            data: data,
            success(response){
                if(response.msg == 1){
                    alert('Post is Shared');
                }
            }
        })

    }
</script>

</body>

</html>
