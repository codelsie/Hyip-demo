var btns = document.querySelectorAll(".menu");
btns.forEach(function(btn) {
    btn.addEventListener("click", function() {
        var sidebar = document.querySelector(".sidebar");
        sidebar.classList.toggle('show');
    });
});
