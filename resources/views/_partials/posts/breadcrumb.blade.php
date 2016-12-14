<div class="post-breadcrumb breadcrumb reveal reveal-left-delay-250">
    @if(isset($category) || isset($post->category))
        <?php if(!isset($category)){ $category = $post->category; } ?>
        <a class="breadcrumb__link" href="{{ route('posts.index') }}">Posts</a>
        / <a class="breadcrumb__link" href="{{ route('posts.index.category',['category' => $category->category_slug]) }}">{{ $category->category_name }}</a>

        @if(isset($post))
            @if($post->category->has_subject)
                / <a href="{{ route('posts.index.grade',['grade' => $post->grade]) }}" class="breadcrumb__link">{{ "Grade ".$post->grade }}</a>
                / <a href="{{ route('posts.index.subject',['grade' => $post->grade,'subject' => $post->subject->subject_slug ]) }}" class="breadcrumb__link">{{ $post->subject->subject_name }}</a>
            @endif

            / <a class="breadcrumb__link" href="{{ route('posts.show',['posts' => $post->post_slug]) }}">{{ $post->post_title }}</a>
        @endif
    @endif
</div>
