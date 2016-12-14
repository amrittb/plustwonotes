@section('assets')
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">
    <script type="text/javascript" async
            src="https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML">
    </script>
@endsection
<!-- Post Title Input -->
<div class="form-group--large">
    <div class="form-group__info">
        <i class="material-icons">info</i>
        This post's title goes here.
    </div>
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        {!! Form::label('post_title','Post Title',['class'=>'mdl-textfield__label']) !!}
        {!! Form::text('post_title',null,['class' => 'mdl-textfield__input']) !!}
    </div>
</div>

<!-- Post Slug Input -->
<div class="form-group--large">
    <div class="form-group__info">
        <i class="material-icons">info</i>
        This post's slug goes here. Eg:
        <span class="text--color-primary">
            http://plustwonotes.com/posts/this-part-is-the-slug
        </span>
    </div>
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        {!! Form::label('post_slug','Post Slug',['class'=>'mdl-textfield__label']) !!}
        {!! Form::text('post_slug',null,['class' => 'mdl-textfield__input']) !!}
    </div>
</div>

<!-- Published At Input -->
<div class="form-group--large">
    <div class="form-group__info">
        <i class="material-icons">info</i>
        You can schedule this post for later or leave it as it is for default publish time.
        It is Kathmandu's time (UTC+5:45)
    </div>
    <form-date-picker @if(isset($post)) date-time="{{ $post->published_at->format('M d, Y H:i') }}" @endif name="published_at" id="published_at" label="Published At"></form-date-picker>
</div>

<!-- Category Input -->
<div class="form-group--large">
    <div class="form-group__info">
        <i class="material-icons">info</i>
        Is this post a {{ join(" or ",array_values($categories)) }}? Select your category here.
    </div>
    <div class="mdl-textfield">
        {!! Form::label('category_id','Category',['class' =>'mdl-textfield__label textfield__label--non-floating']) !!}
        {!! Form::select('category_id',$categories) !!}
    </div>
</div>

<!-- Subject Input -->
<div class="form-group--large">
    <div class="form-group__info">
        <i class="material-icons">info</i>
        Does this post category needs an association with subject? Choose from this list. <br />
        Note: Currently `Blog` category of post does not require post category. Other categories require a subject to be associated to.
    </div>
    <div class="mdl-textfield">
        {!! Form::label('subject_id','Subject',['class' =>'mdl-textfield__label textfield__label--non-floating']) !!}
        {!! Form::select('subject_id',$subjects) !!}
    </div>
</div>

<!-- Imp Input -->
<div class="form-group--large">
    <div class="form-group__info">
        <i class="material-icons">info</i>
        Is this post important? Check this box and this post will be listed above in post lists.
    </div>
    <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="imp-checkbox">
        {!! Form::checkbox('imp',0,null,['class' => 'mdl-checkbox__input','id' => 'imp-checkbox']) !!}
        <span class="mdl-checkbox__label">Important?</span>
    </label>
</div>

<!-- Featured Input -->
<div class="form-group--large">
    <div class="form-group__info">
        <i class="material-icons">info</i>
        Do you wish to feature this post? Check this box and this post will be shown in home page until other newer posts are featured.
    </div>
    <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="featured-checkbox">
        {!! Form::checkbox('featured',0,null,['class' => 'mdl-checkbox__input','id' => 'featured-checkbox']) !!}
        <span class="mdl-checkbox__label">Featured?</span>
    </label>
</div>

<div class="form-group--large">
    <div class="form-group__info">
        <i class="material-icons">info</i>
        Pick a image to describe this post and it will be shown as thumbnail in post list and as featured image on top of post view page.
    </div>
    <featured-image-editor name="{{ (isset($post))?$post->featured_img:"" }}"></featured-image-editor>
</div>

<!-- Post Body Input -->
<div class="form-group--large">
    <div class="form-group__info">
        <i class="material-icons">info</i>
        This is the section where you edit a post. Write the post and save to draft. When the post is ready to be published check the tick mark from the post list and this post will be sent to verification. After verification, any publisher can publish the post.
    </div>
    <post-editor content="@if(isset($post)) {{ $post->post_body }} @endif"></post-editor>
</div>

<media-attacher image-resource-url="{{ route('api.v1.media.images.index') }}" image-upload-url="{{ route('api.v1.media.images.upload') }}"></media-attacher>

<!-- Save Input -->
{!!
    Form::button('<i class="material-icons">save</i>'.(isset($post)?'Save':'Save to Drafts'),[
        'type' => 'submit',
        'class' => 'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent'
    ])
!!}


@if(isset($post) and $post->isPublished())
    <!-- View Post -->
    <a href="{{ route('posts.show',['posts' => $post->post_slug]) }}"
       target="_blank"
       class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent mdl-js-ripple-effect">
        <i class="material-icons">visibility</i> View Post
    </a>
@endif

<!-- Cancel Button -->
<a href="{{ route('user.posts') }}"
   class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent mdl-js-ripple-effect">
    <i class="material-icons">cancel</i> Cancel
</a>

@section('scripts')
    <script type="text/javascript" src="{{ elixir('js/post-editor.js') }}"></script>
@endsection