document.querySelectorAll('.menu-link').forEach(link => {
    link.addEventListener('click', function (e) {
        e.preventDefault(); // important

        let parent = this.parentElement;
        parent.classList.toggle('active');
    });
});