{!! Form::open(['route' => 'search','method' => 'GET','class' => 'mdl-typography--text-center']) !!}
<!-- Search Input -->
<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label reveal-left">
    {!! Form::label('q','What do you want to read about?',['class'=>'mdl-textfield__label']) !!}
    {!! Form::text('q',(isset($query)?$query:''),['class' => 'mdl-textfield__input']) !!}
</div>

<input class="mdl-button mdl-js-button mdl-button--raised mdl-button--primary mdl-js-ripple-effect reveal-right"
       value="Find me that!"
       type="submit" />
{!! Form::close() !!}