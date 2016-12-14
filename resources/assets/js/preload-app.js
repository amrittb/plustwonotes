import ScrollReveal from "scrollreveal";

window.scrollReveal = new ScrollReveal({
    duration: 750,
});

if(window.scrollReveal.isSupported()) {
    document.documentElement.classList.add('scroll-reveal');
}