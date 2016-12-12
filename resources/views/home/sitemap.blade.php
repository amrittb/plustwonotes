@extends('_layouts.app')

@section('title')
    Site Map - Plus Two Notes
@stop

@section('content')
    <h2 class="text--light mdl-typography--text-center">Site Map</h2>

    <div class="mdl-grid">
        <div class="mdl-cell mdl-cell--12-col">
            <h4 class="text--light">
                Home Links
            </h4>

            <?php
                $list = [
                    'home'      => 'Home',
                    'about'     => 'About Us',
                    'search'    => 'Search',
                ];
            ?>

            @foreach($list as $route => $title)
                <a href="{{ route($route) }}" class="text--color-primary text--decoration-none">
                    {{ $title }}
                </a><br />
            @endforeach
        </div>
    </div>

    <div class="mdl-grid">
        <div class="mdl-cell mdl-cell--6-col mdl-cell--12-col-tablet">
            <h4 class="text--light mdl-typography--text-center">
                Post List Links
            </h4>

            <a href="{{ route('posts.index') }}" class="text--color-primary text--decoration-none">
                All Posts
            </a><br />

            @foreach(\App\Models\Category::all() as $category)
                <a href="{{ route('posts.index.category',['category' => $category->category_slug]) }}" class="text--color-primary text--decoration-none">
                    {{ $category->category_name }} posts
                </a><br />
            @endforeach

            @foreach(\App\Models\Grade::all() as $grade)
                <a href="{{ route('posts.index.grade',['grades' => $grade->grade_name]) }}" class="text--color-primary text--decoration-none">
                    Grade {{ $grade->grade_name }} Posts
                </a><br />
            @endforeach

            @foreach(\App\Models\Subject::with('grade')->get() as $subject)
                <a href="{{ route('posts.index.subject',[
                    'grade' => $subject->grade->grade_name,
                    'subject' => $subject->subject_slug
                    ]) }}" class="text--color-primary text--decoration-none">
                    Grade {{ $subject->grade->grade_name }} {{ $subject->subject_name }} Posts
                </a><br />
            @endforeach
        </div>
        <div class="mdl-cell mdl-cell--6-col mdl-cell--12-col-tablet">
            <h4 class="text--light mdl-typography--text-center">
                Posts Links
            </h4>

            @foreach(\App\Models\Post::published()->latestPublished()->get(['post_title','post_slug']) as $post)
                <a href="{{ route('posts.show',['posts' => $post->post_slug]) }}" class="text--color-primary text--decoration-none">
                    {{ $post->post_title }}
                </a><br />
            @endforeach
        </div>
    </div>
@stop