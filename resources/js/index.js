function scrollFunction() {
    //this function checks if the user is scrolled to the top of the page, if so, the navbar displays in full size. When the user starts scrolling, the navbar resizes accordingly
    if (document.body.scrollTop > 80 || document.documentElement.scrollTop > 80) {
        document.getElementById("navbar").style.padding = "4px 10px";
        document.getElementById("logo").style.width = "90px";
    }
    else {
        document.getElementById("navbar").style.padding = null;
        document.getElementById("logo").style.width = " 105px";
    }
    console.log('This works!');

    console.log(document.documentElement.scrollTop)
}

window.addEventListener('scroll', () => {
    document.body.style.setProperty('--scroll',window.pageYOffset / (document.body.offsetHeight - window.innerHeight));
  }, false);

window.scrollFunction = scrollFunction
