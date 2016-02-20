<div class="post-breadcrumb breadcrumb">
    @if(isset($category) || isset($post->category))
        <?php if(!isset($category)){ $category = $post->category; } ?>
        <a class="breadcrumb__link" href="{{ route('posts.index') }}">Posts</a>
        / <a class="breadcrumb__link" href="{{ route('posts.index.category',['category' => $category->category_slug]) }}">{{ $category->category_name }}</a>

        @if(isset($post))
            @if($post->isNotBlog())
                / <a href="#" class="breadcrumb__link">{{ $post->grade_subject }}</a>
            @endif
            
            / <a class="breadcrumb__link" href="{{ route('posts.show',['posts' => $post->post_slug]) }}">{{ $post->post_title }}</a>
        @endif
    @endif
</div>