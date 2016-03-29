<nav class="mdl-navigation">
    <a class="mdl-navigation__link" href="{{ route('home') }}">Home</a>

    @foreach($postCategories as $category)
        <a href="{{ route('posts.index.category',['category' => $category->category_slug]) }}" class="mdl-navigation__link">{{ $category->category_name }}</a>
    @endforeach

    <a class="mdl-navigation__link" href="{{ route('about') }}">About</a>
</nav>