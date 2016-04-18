<!-- Post Title Input -->
<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    {!! Form::label('post_title','Post Title',['class'=>'mdl-textfield__label']) !!}
    {!! Form::text('post_title',null,['class' => 'mdl-textfield__input']) !!}
</div>

<br />

<!-- Post Slug Input -->
<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    {!! Form::label('post_slug','Post Slug',['class'=>'mdl-textfield__label']) !!}
    {!! Form::text('post_slug',null,['class' => 'mdl-textfield__input']) !!}
</div>

<br />

<!-- Published At Input -->
<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    {!! Form::label('published_at','Published At',['class'=>'mdl-textfield__label']) !!}
    {!! Form::input('date','published_at',null,['class' => 'mdl-textfield__input']) !!}
</div>

<br />

<!-- Category Input -->
<div>
    {!! Form::label('category_id','Category',['class' =>'mdl-textfield__label']) !!}
    {!! Form::select('category_id',$categories) !!}
</div>

<br />

<!-- Subject Input -->
<div>
    {!! Form::label('subject_id','Subject',['class' =>'mdl-textfield__label']) !!}
    {!! Form::select('subject_id',$subjects) !!}
</div>

<br />

<!-- Imp Input -->
<label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="imp-checkbox">
    {!! Form::checkbox('imp',0,null,['class' => 'mdl-checkbox__input','id' => 'imp-checkbox']) !!}
    <span class="mdl-checkbox__label">Important?</span>
</label>

<br />

<!-- Featured Input -->
<label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="featured-checkbox">
    {!! Form::checkbox('featured',0,null,['class' => 'mdl-checkbox__input','id' => 'featured-checkbox']) !!}
    <span class="mdl-checkbox__label">Featured?</span>
</label>

<br />

<!-- Post Body Input -->
<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    {!! Form::label('post_body','Post Body',['class'=>'mdl-textfield__label']) !!}
    {!! Form::textarea('post_body',null,['class' => 'mdl-textfield__input']) !!}
</div>

<br />

<!-- Save Input -->
{!! Form::button('Save',['type' => 'submit','class' => 'mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent']) !!}