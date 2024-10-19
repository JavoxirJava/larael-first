@extends('bases.base')
@section('context')
<script>
    function postVar(id) {
        sessionStorage.setItem('postId', id);
        document.getElementById('editForm').action = `/posts/update/${id}`;
    }

    function deletePost() {
        fetch(`/posts/delete/${sessionStorage.getItem('postId')}`)
            .then(() => location.reload())
            .catch(() => alert('Something went wrong!'));
    }
    @if(isset($name))
        localStorage.setItem('name', '{{ $name }}');
    @endif
</script>
<section class="container">
    <div class="mt-3 d-flex justify-content-between">
        <button class="btn btn-success px-4" data-bs-toggle="modal" data-bs-target="#addPost">Add Post</button>
        <h4 class="text-center mt-3" id="title_text"></h4>
    </div>
    <div class="mt-4 d-flex justify-content-evenly flex-wrap">
        @if(isset($posts) && count($posts) > 0)
            @foreach ($posts as $post)
                <div class="card mb-4" style="width: 18rem;">
                    <img src="https://img.gta5-mods.com/q95/images/bmw-m5-e60-crazy-exterior-add-on-tuning/6cb218-6.png" class="card-img-top" alt="BMW E60 Tuning">
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p class="card-text">{{ $post->short_content }}</p>
                        <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editPost" onclick="postVar({{ $post->id }})">Edit Post</button>
                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deletePost" onclick="postVar({{ $post->id }})">Delete Post</button>
                    </div>
                </div>
            @endforeach
        @else
            <h1 class="d-flex justify-content-center">No posts</h1>
        @endif
    </div>
    <script>
        document.getElementById('title_text').innerHTML = localStorage.getItem('name');
    </script>
</section>
<!-- Add Modal -->
<div class="modal fade" id="addPost" tabindex="-1" aria-labelledby="addPost" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form action="/posts/create" method="POST" class="w-100">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addPost">Add Post</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-3">
                    <label for="#title">Title</label>
                    <input id="title" class="form-control mb-3" name="title" placeholder="Title">
                    <label for="#short_content">Short content</label>
                    <input id="short_content" class="form-control mb-3" name="short_content" placeholder="Short content">
                    <label for="#content">Content</label>
                    <textarea id="content" class="form-control mb-3" name="content" placeholder="Content"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <input class="btn btn-warning" type="submit" value="Add Posts">
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editPost" tabindex="-1" aria-labelledby="editPost" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form action="/posts/update/" id="editForm" method="POST" class="w-100">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editPost">Edit Post</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-3">
                    <label for="#title">Title</label>
                    <input id="title" class="form-control mb-3" name="title" placeholder="Title">
                    <label for="#short_content">Short content</label>
                    <input id="short_content" class="form-control mb-3" name="short_content" placeholder="Short content">
                    <label for="#content">Content</label>
                    <textarea id="content" class="form-control mb-3" name="content" placeholder="Content"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <input class="btn btn-warning" type="submit" value="Edit Posts">
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deletePost" tabindex="-1" aria-labelledby="deletePostLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deletePost">Delete Post</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-3">
                <h3> Are you sure you want to delete this post? </h3>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <input class="btn btn-danger" type="submit" value="Ok" onclick="deletePost()">
            </div>
        </div>
    </div>
</div>
@endsection
