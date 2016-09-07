<nav class="mdl-navigation">
    <a class="mdl-navigation__link" href="{{ route('home') }}">
        <i class="material-icons">home</i> Home
    </a>

    @foreach($postCategories as $category)
        <a href="{{ route('posts.index.category',['category' => $category->category_slug]) }}" class="mdl-navigation__link">
            <i class="material-icons">
                @if($category->category_name == "Note")
                   description
                @elseif($category->category_name == "Syllabus")
                    assignment
                @else
                    web
                @endif
            </i>
            {{ $category->category_name }}
        </a>
    @endforeach

    <div class="extra-navigation @if(Auth::check() && !Auth::user()->isStudentOnly()) divider--top divider--bottom @endif">
        @can('create',App\Models\Post::class)
            <a href="{{ route('posts.create') }}" class="mdl-navigation__link">
                <i class="material-icons">create</i> Create Post
            </a>
        @endcan

        @can('viewListInBackend',App\Models\Post::class)
            <a href="{{ route('user.posts') }}" class="mdl-navigation__link">
                <i class="material-icons">list</i> Posts
            </a>
        @endcan

        @can('viewDeletedList',App\Models\Post::class)
            <a href="{{ route('posts.trashed') }}" class="mdl-navigation__link">
                <i class="material-icons">delete</i> Trashed Post
            </a>
        @endcan

        @can('viewList',App\Models\User::class)
            <a href="{{ route('users.index') }}" class="mdl-navigation__link">
                <i class="material-icons">people</i> Users
            </a>
        @endcan
    </div>

    <a class="mdl-navigation__link" href="{{ route('about') }}">
        <i class="material-icons">help</i> About
    </a>
</nav>