{!! Form::open(['route' => 'user.posts','method' => 'GET','class' => 'mdl-typography--text-center']) !!}
<!-- Search Input -->
<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label reveal reveal-left">
    {!! Form::label('q','What are you searching for?',['class'=>'mdl-textfield__label']) !!}
    {!! Form::text('q',(isset($query)?$query:''),['class' => 'mdl-textfield__input']) !!}
</div>

<input class="mdl-button mdl-js-button mdl-button--raised mdl-button--primary mdl-js-ripple-effect reveal reveal-right"
       value="Find me that!"
       type="submit" />
{!! Form::close() !!}