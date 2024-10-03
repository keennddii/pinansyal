<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.min.css">
    <link rel="stylesheet" href="prac.css">
    <title>BCP-Admission</title>
</head>
<body>
    <nav>
        <div class="nav-logo">
            <a href="BCP-Admission.php">
                <img src="img/logoooo.png">
            </a>
        </div>

        <ul class="nav-links">
        <li class="link"><a href="BCP-Admission.php">Home</a></li>
            <li id="link1" class="link"><a href="#">Guides</a></li>
            <li id="link2" class="link"><a href="#">Programs</a></li>
            <li id="link3" class="link"><a href="#">About</a></li>
        </ul>
    </nav>
    <header class="container">
        <div class="content">
            <span class="blur"></span>
            <span class="blur"></span>
            <h1><span>BCP</span> Admission</h1>
            <p>
            Bestlink College of the Philippines offers a streamlined admission system designed to facilitate a 
            smooth application process. Prospective students can easily submit their requirements online, including transcripts, 
            recommendation letters, and personal statements. The college emphasizes inclusivity and support, guiding applicants through 
            each step to ensure they have the ultimate chance of success in their academic journey. For more details, visit their official
             website or contact the admissions office directly.
            </p>
        </div>
        <div class="image">
            <img src="">
        </div>
    </header>
    <section class="container">
        <h2 class="header">Application Process</h2>
        <p class="sub-header">
           <!--lagyan-->
        </p>
        <div class="pricing">
            <div class="card">
                <div class="content">
                    <h4>College</h4>
                    <h3></h3>
                    <p>
                        <i class="ri-checkbox-circle-line"></i> 
                        Form 138 (Report Card)
                    </p>
                    <p>
                        <i class="ri-checkbox-circle-line"></i>
                        Form 137
                    </p>
                    <p>
                        <i class="ri-checkbox-circle-line"></i>
                        Certificate of Good Moral
                    </p>
                    <p>
                        <i class="ri-checkbox-circle-line"></i>
                        PSA Authenticated Birth Certificate
                    </p>
                    <p>
                        <i class="ri-checkbox-circle-line"></i>
                        Passport Size ID Picture (White Background, Formal Attire) - 2pcs.
                    </p>
                    <p>
                        <i class="ri-checkbox-circle-line"></i>
                        Barangay Clearance
                    </p>
                    <br>
                    
                    <h4>College Transferee Requirements</h4>
                    <h3></h3>
                    <p>
                        <i class="ri-checkbox-circle-line"></i> 
                        Transcript of Records from Previous School 
                    </p>
                    <p>
                        <i class="ri-checkbox-circle-line"></i>
                        Honorable Dismissal
                    </p>
                    <p>
                        <i class="ri-checkbox-circle-line"></i>
                        Certificate of Good Moral
                    </p>
                    <p>
                        <i class="ri-checkbox-circle-line"></i>
                        PSA Authenticated Birth Certificate
                    </p>
                    <p>
                        <i class="ri-checkbox-circle-line"></i>
                        Passport Size ID Picture (White Background, Formal Attire) - 2pcs.
                    </p>
                    <p>
                        <i class="ri-checkbox-circle-line"></i>
                        Barangay Clearance
                    </p>
                    
                </div>
                <a href="applicationprocess.php" class="btn">Enroll</a>
            </div>
            <div class="card">
                <div class="content">
                    <h4>Senior HighSchool</h4>
                    <h3></h3>
                    <p>
                        <i class="ri-checkbox-circle-line"></i>
                        Form 138 (Report Card)
                    </p>
                    <p>
                        <i class="ri-checkbox-circle-line"></i>
                        Form 137
                    </p>
                    <p>
                        <i class="ri-checkbox-circle-line"></i>
                        Certificate of Good Moral
                    </p>
                    <p>
                        <i class="ri-checkbox-circle-line"></i>
                        2"x2" ID Picture (White Background) - 2pcs.
                    </p>
                    <p>
                        <i class="ri-checkbox-circle-line"></i>
                        Photocopy of NCAE Result
                    </p><p>
                        <i class="ri-checkbox-circle-line"></i>
                        ESC Certificate, if a graduate of a private Junior High School.
                    </p><p>
                        <i class="ri-checkbox-circle-line"></i>
                        PSA Authenticated Birth Certificate
                    </p><p>
                        <i class="ri-checkbox-circle-line"></i>
                        Barangay Clearance
                    </p><p>
                        <i class="ri-checkbox-circle-line"></i>
                        Photocopy of Diploma
                    </p>
                </div>
                <a href="applicationprocess.php" class="btn2">Enroll</a>
            </div>
        </div>
    </section>

    <footer class="container">
    <span class="blur"></span>
    <span class="blur"></span>
        <div class="column">
            <div class="logo">
                <img src="img/logoooo.png">
            </div>
            <p>
            BESTLINK COLLEGE OF THE PHILIPPINES
            </p>
            <div class="socials">
                <a href="https://bcp.edu.ph"><i class="ri-facebook-line"></i></a>
                <a href="#"><i class="ri-instagram-line"></i></a>
                <a href="#"><i class="ri-twitter-line"></i></a>
            </div>
        </div>
        <div class="column">
            <h4>About Us</h4>
            <a href="#">Blogs</a>
            <a href="#">Channels</a>
            <a href="#">Sponsors</a>
        </div>
        <div class="column">
            <h4>Contact</h4>
            <a href="#">Contact Us</a>
            <a href="#">Privicy Policy</a>
            <a href="#">Terms & Conditions</a>
        </div>
        <div class="column">
            <h4>Contact</h4>
            <a href="#">Contact Us</a>
            <a href="#">Privicy Policy</a>
            <a href="#">Terms & Conditions</a>
        </div>
    </footer>

    <div class="copyright">
       <!-- lagyan -->
    </div>


    <script>
        function scrollToElement(elementSelector, instance = 0) {
    // Select all elements that match the given selector
    const elements = document.querySelectorAll(elementSelector);
    // Check if there are elements matching the selector and if the requested instance exists
    if (elements.length > instance) {
        // Scroll to the specified instance of the element
        elements[instance].scrollIntoView({ behavior: 'smooth' });
    }
}

const link1 = document.getElementById("link1");
const link2 = document.getElementById("link2");
const link3 = document.getElementById("link3");

link1.addEventListener('click', () => {
    scrollToElement('.header');
});

link2.addEventListener('click', () => {
    // Scroll to the second element with "header" class
    scrollToElement('.header', 1);
});

link3.addEventListener('click', () => {
    scrollToElement('.column');
});
    </script>
</body>

</html>