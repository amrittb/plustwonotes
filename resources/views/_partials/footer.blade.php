<footer class="mdl-mega-footer">
    <div class="mdl-mega-footer__middle-section">
        <h6 class="mdl-typography--text-center reveal-top">
            Copyright &copy; Plus Two Notes<br/> {{ \Carbon\Carbon::now()->format('Y') }}
        </h6>
        <h6 class="mdl-typography--text-center reveal-bottom">
            Designed & Developed with &heartsuit; by <a href="http://amrittwanabasu.com.np" target="_blank" class="text--color-white text--decoration-none">Amrit Twanabasu</a>
        </h6>

        <br />

        <p class="mdl-typography--text-center reveal-bottom-delay-250">
            &compfn; <a href="{{ route('sitemap') }}" class="text--color-light text--decoration-none">Site Map</a> &compfn;
        </p>
    </div>
    <div class="mdl-mega-footer__bottom-section mdl-typography--text-center">
        <h6 class="reveal-right-delay-500">
            Yes, of course we are on social sites. Who isn't these days?
        </h6>
        <a href="https://facebook.com/plustwonotes" class="text--decoration-none reveal-bottom-delay-750" target="_blank">
            <img src="{{ asset('img/facebook-logo-button.png') }}" alt="Plus Two Notes's Facebook page">
        </a>
        <a href="https://plus.google.com/+Plustwonotespage" class="text--decoration-none reveal-bottom-delay-750" target="_blank">
            <img src="{{ asset('img/google-plus-logo-button.png') }}" alt="Plus Two Notes's Google Plus page">
        </a>
        <a href="https://www.youtube.com/c/Plustwonotespage" class="text--decoration-none reveal-bottom-delay-750" target="_blank">
            <img src="{{ asset('img/youtube-logo-button.png') }}" alt="Plus Two Notes's Youtube Channel page">
        </a>
    </div>
</footer>
