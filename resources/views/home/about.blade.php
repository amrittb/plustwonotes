@extends('_layouts.app')

@section('title')
    About Us - Plus Two Notes
@stop

@section('content')
    <h2 class="text--thin mdl-typography--text-center">About Us</h2>

    <h6>What motivated us?</h6>
    <p>
        Telling about us, we are a group of students who were just high school students just a few years ago. Truth to be told, we had this idea of creating a platform for student's just like us for them to get all the necessary help from a place in the internet. Hence, the idea of <b>Plus Two Notes</b> was formed. (Claps Claps Claps). We first deployed this application in 17<sup>th</sup> May, 2014. (Phew, it has been more than {{ \Carbon\Carbon::now()->diffInYears(\Carbon\Carbon::parse('May 17,2014')) }} years now.)
    </p>
    <br/>

    <h6>Problems that we face</h6>
    <p>
        As we are also just a group of <em>students</em> (Emphasis on the 'student' part), we lack funding to keep this application running. Up until now, we are running this service by getting some funds from various organizations, mainly educational institutes.
    </p>
    <br/>

    <h6>Whom do I refer to when I say 'we'?</h6>
    <p>
        Our Team started with five members - <b>Saroj Duwal</b>, <b>Julsan Magaju</b>, <b>Yashwant Pandit</b>, <b>Suzeet Twanabasu</b> and me (Drum rolls please!)
        <a href="http://amrittwanabasu.com.np">Amrit Twanabasu</a>.

        I am the core developer of this application and others provide content to the website (cuz that's how we roll! You can laugh now).
    </p>
@stop