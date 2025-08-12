</main>

<footer class="site-footer section-padding">
    <div class="container">
        <div class="row">

            <div class="col-lg-3 col-12 mb-4 pb-2">
                <a class="navbar-brand mb-2" href="index.php">
                    <img src="./images/main-logo.png" style="width: 250px;" alt="">
                </a>
            </div>

            <div class="col-lg-3 col-md-4 col-6">
                <h6 class="site-footer-title mb-3">Resources</h6>

                <ul class="site-footer-links">
                    <li class="site-footer-link-item">
                        <a href="#" class="site-footer-link">Home</a>
                    </li>

                    <li class="site-footer-link-item">
                        <a href="#" class="site-footer-link">How it works</a>
                    </li>

                    <li class="site-footer-link-item">
                        <a href="#" class="site-footer-link">FAQs</a>
                    </li>

                    <li class="site-footer-link-item">
                        <a href="#" class="site-footer-link">Contact</a>
                    </li>
                </ul>
            </div>

            <div class="col-lg-3 col-md-4 col-6 mb-4 mb-lg-0">
                <h6 class="site-footer-title mb-3">Information</h6>

                <p class="text-white d-flex mb-1">
                    <a href="tel: 305-240-9671" class="site-footer-link">
                        +216 97054079
                    </a>
                </p>

                <p class="text-white d-flex">
                    <a href="mailto:info@company.com" class="site-footer-link">
                        mbctrainingsite72@outlook.com
                    </a>
                </p>
            </div>

            <div class="col-lg-3 col-md-4 col-12 mt-4 mt-lg-0 ms-auto">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        English</button>

                    <ul class="dropdown-menu">
                        <li><button class="dropdown-item" type="button">Thai</button></li>

                        <li><button class="dropdown-item" type="button">Myanmar</button></li>

                        <li><button class="dropdown-item" type="button">Arabic</button></li>
                    </ul>
                </div>

                <p class="copyright-text mt-lg-5 mt-4">Copyright © 2048 Topic Listing Center. All rights reserved.
                    <br><br>Design: <a rel="nofollow" href="https://templatemo.com" target="_blank">TemplateMo</a>
                </p>

            </div>

        </div>
    </div>
</footer>

<!-- Add this at the end of your body tag in index.html -->
<!-- Chatbot Button -->
<button id="chatbot-btn" aria-label="Open chatbot">
💬
</button>
<div id="chatbot-window" style="display: none;">
    <div class="chatbot-header" style="font-weight: bold; margin-bottom: 8px;">
        Chatbot
        <button id="chatbot-close" aria-label="Close chatbot" style="float: right; background: none; border: none; font-size: 18px;color:white;">&times;</button>
    </div>
    <div class="chat-messages" style="height: 300px; overflow-y: auto; margin-bottom: 8px; padding: 5px; background-color: #fff;">
        <!-- Bot and user messages will be appended here -->
        <div class="bot-message" style="display: flex; width: 75%; border: none; border-radius: 12px; margin-bottom: 8px; align-items: center; padding: 8px;">
            <i class="fas fa-robot me-2" style="background-color: #13547a; color: white; border-radius: 50px; padding: 8px; height: 32px; width: 32px; display: flex; align-items: center; justify-content: center;"></i>
            <p class="chatbot-message" style="font-size: 14px; margin-bottom: 0;background-color: #eee;padding: 10px;border-radius: 12px;">Hello! How can I help you?</p>
        </div>
        <!-- <div class="user-message" style="margin-top: 8px; display: flex; width: 75%; border: none; justify-content: flex-end; margin-left: auto; border-radius: 12px; align-items: center; padding: 8px;">
            <p class="user-message" style="font-size: 14px; margin-bottom: 0; margin-right: 2px;background-color: #13547a;padding: 10px;border-radius: 12px;color: white;">Hello!!</p>
            <i class="fas fa-user ms-2" style="background-color: #13547a; color: white; border-radius: 50px; padding: 8px; height: 32px; width: 32px; display: flex; align-items: center; justify-content: center;"></i>
        </div> -->
    </div>
    <div class="chatbot-input-area" style="display: flex; justify-content: center; align-items: center;">
        <input type="text" id="chatbot-input" placeholder="Type your message..." 
            style="width: 75%; margin-right: 8px; border-radius: 25px; padding: 6px 10px;">
        <button id="chatbot-send"
            style="background-color: #13547a; color: white; border: none; border-radius: 25px; padding: 0 16px; height: 38px; display: flex; align-items: center; justify-content: center;">
            <i class="fas fa-paper-plane"></i>
        </button>
    </div>
</div>


<!-- JAVASCRIPT FILES -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/jquery.sticky.js"></script>
<script src="js/click-scroll.js"></script>
<!-- owl carousel cdn -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<!-- jquery isotype cdn -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.min.js"
    integrity="sha512-Zq2BOxyhvnRFXu0+WE6ojpZLOU2jdnqbrM1hmVdGzyeCa1DgM3X5Q4A/Is9xA1IkbUeDd7755dNNI/PzSf2Pew=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
window.addEventListener('DOMContentLoaded', function() {
    var alertBox = document.getElementById('newsletter-alert');
    if (alertBox) {
        setTimeout(function() {
            alertBox.classList.add('show');
        }, 100); // slight delay for effect
    }
});
</script>
<!-- intl-tel-input JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.1.1/js/intlTelInput.min.js"></script>
<script>
    // Initialize intl-tel-input when DOM is ready
    document.addEventListener('DOMContentLoaded', function() {
        var input = document.querySelector("#phone");
        if (input && window.intlTelInput) {
            window.intlTelInput(input, {
                initialCountry: "auto",
                geoIpLookup: function (callback) {
                    fetch('https://ipinfo.io/json')
                        .then(resp => resp.json())
                        .then(resp => callback(resp.country))
                        .catch(() => callback('us'));
                },
                utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.1.1/js/utils.js"
            });
        }
    });
</script>

<script>
    // Initialize file input functionality when DOM is ready
    document.addEventListener('DOMContentLoaded', function() {
        var fileInput = document.querySelector('input[type="file"][name="resume"]');
        if (fileInput) {
            fileInput.addEventListener('change', function (e) {
                const fileName = e.target.files[0] ? e.target.files[0].name : 'Choose a file';
                this.parentNode.querySelector('.file-placeholder').textContent = fileName;
            });
        }
    });
</script>
<script src="js/carousel.js"></script>
<script src="js/chatbot.js"></script>
<script src="js/custom.js"></script>
<script src="js/search.js"></script>

</body>

</html>