function getScroll() {
    for (element of document.getElementsByClassName("action-btn")) {
        element.href = element.href.split("?")[0];
        element.href = element.href + "?scroll=" + window.scrollY;
    };
}
function setScroll() {
    window.scrollTo(0, window.location.search.split("=")[1]);
}
window.addEventListener("scroll", () => getScroll());
document.addEventListener('readystatechange', event => { 

    if (event.target.readyState === "complete") {
        setScroll();
    }
    if (event.target.readyState === "interactive") {
        setScroll();
    }
});