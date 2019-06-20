    <!--Footer Copyrights-->
    <footer id="footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <p>&copy;&nbsp;2019 Hench Capital</p>
                </div>
            </div>
        </div>
    </footer>

    <!--All Script-->
    <script src="js/jquery-1.12.4.min.js" type="text/javascript"></script>
    <script src="js/bootstrap.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/appear.js"></script>
    <script src="js/smoothscroll.js" type="text/javascript"></script>
    <script src="js/odometer.min.js" type="text/javascript"></script>
    <script src="js/script.js" type="text/javascript"></script>
    <script>
        $(window).load(function() {
            // Animate loader off screen
            $(".se-pre-con").fadeOut("slow");;
        });
    </script>
    <script>
        // Control about navigation fixed scrolling mechanism
        window.onscroll = function () { navfixedScroll() };
        // Get the navbar
        var navbar = document.getElementById("breadcrumb");
        // Get the offset position of the navbar
        var sticky = navbar.offsetTop;
        // Add the sticky class to the navbar when you reach its scroll position. Remove "sticky" when you leave the scroll position
        function navfixedScroll() {
            if (window.pageYOffset >= sticky) {
                navbar.classList.add("sticky")
            } else {
                navbar.classList.remove("sticky");
            }
        }
    </script>
</body>
</html>