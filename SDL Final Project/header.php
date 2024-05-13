<header>
    <h1>Zion Colors</h1>
</header>
<nav>
    <ul>
        <li><a id="homepage" onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'">Home</a></li>
        <li><a id="about" onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'">About</a></li>
        <li><a id="faqs" onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'">FAQs</a></li>
        <li><a id="services" onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'">Services</a></li>
        <li><a id="booknow" onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'">Book Now</a></li>
    </ul>
</nav>


<script>
$(document).ready(function(){
    // Function to remove the "active" class from all links
    function removeActiveClass() {
        $("nav ul li a").removeClass("active");
    }

    // Click event handlers for navigation links
    $("#homepage").click(function(){
        removeActiveClass(); // Remove active class from all links
        $(this).addClass("active"); // Add active class to clicked link
        document.location = "./?page=homepage";
    });

    $("#about").click(function(){
        removeActiveClass(); // Remove active class from all links
        $(this).addClass("active"); // Add active class to clicked link
        document.location = "./?page=about";
    });

    $("#faqs").click(function(){
        removeActiveClass(); // Remove active class from all links
        $(this).addClass("active"); // Add active class to clicked link
        document.location = "./?page=faqs";
    });

    $("#services").click(function(){
        removeActiveClass(); // Remove active class from all links
        $(this).addClass("active"); // Add active class to clicked link
        document.location = "./?page=services";
    });

    $("#booknow").click(function(){
        removeActiveClass(); // Remove active class from all links
        $(this).addClass("active"); // Add active class to clicked link
        document.location = "./?page=booknow";
    });

    // Set initial active class based on the current page
    var currentPage = "<?php echo isset($_GET['page']) ? $_GET['page'] : ''; ?>";
    $("#" + currentPage).addClass("active");
});
</script>