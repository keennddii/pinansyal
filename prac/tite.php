<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-height, height=device-height, initial-scale=1.0">
    <title>Growing Flower Animation</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #e0f7fa; /* Light blue background */
            overflow: hidden; /* Prevent scrolling */
        }

        .pot {
            position: absolute;
            bottom: 250px; /* Position the pot above the bottom */
            left: 50%; /* Center the pot */
            transform: translateX(-50%); /* Center alignment */
            width: 150px; /* Width of the pot */
            height: 100px; /* Height of the pot */
            background-color: #7B3F00; /* Pot color */
            border-radius: 20px; /* Rounded pot edges */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3); /* Shadow for depth */
            border: 3px solid #C19A6B; /* Border for the pot */
        }

        .pot:before {
            content: '';
            position: absolute;
            top: -10px; /* Position above the pot */
            left: 0;
            width: 100%;
            height: 10px; /* Height of the rim */
            background-color: #C19A6B; /* Rim color */
            border-radius: 15px; /* Rounded edges for the rim */
        }

        .message {
            position: absolute;
            top: 100px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 100px;
            color: #ff4081; /* Pink color for the message */
            display: none; /* Hidden by default */
            text-align: center; /* Center the message */
            font-family: Arial, sans-serif;
            opacity: 0; /* Start invisible for transition */
            transition: opacity 1s ease; /* Transition for opacity */
        }

        /* Fireworks styles */
        .firework {
            position: absolute;
            width: 5px;
            height: 5px;
            border-radius: 50%;
            animation: explode 1s forwards;
        }

        @keyframes explode {
            0% {
                transform: scale(1);
                opacity: 1;
            }
            100% {
                transform: scale(2);
                opacity: 0;
            }
        }

        /* Cat faces */
        .cat {
            position: absolute;
            width: 50px; /* Width of cat faces */
            height: 50px; /* Height of cat faces */
            transition: opacity 1s ; /* Transition effect for cat images */
        }
    </style>
</head>

<body>
    <div class="pot"></div> <!-- Pot element -->
    <canvas id="flowerCanvas" width="400" height="600"></canvas>
    <div class="message" id="message">I Love You Chelsea hihihihihihihi</div>

    <script>
        const canvas = document.getElementById('flowerCanvas');
        const ctx = canvas.getContext('2d');

        // Flower parameters
        let flowerCount = 1; // Number of flowers
        let petals = new Array(flowerCount).fill(0); // Petal lengths
        let stems = new Array(flowerCount).fill(0); // Stem lengths
        let flowerBlooming = new Array(flowerCount).fill(false); // Flags for blooming
        let yellowVisible = new Array(flowerCount).fill(false); // Flags for yellow visibility
        let flowerFullyBloomed = false; // Flag for flower fully bloomed

        function drawFlower(index) {
            // Draw the stem
            ctx.beginPath();
            ctx.moveTo(200, 460); // Starting point of the stem
            ctx.lineTo(200, 460 - stems[index]); // End point of the stem
            ctx.lineWidth = 10; // Stem thickness
            ctx.strokeStyle = 'brown'; // Stem color
            ctx.stroke();

            // Draw the petals
            if (flowerBlooming[index]) {
                ctx.fillStyle = 'pink';
                const petalCount = 8;
                for (let i = 0; i < petalCount; i++) {
                    ctx.beginPath();
                    const angle = (i / petalCount) * (Math.PI * 2);
                    ctx.ellipse(200, 400 - stems[index] - 20, petals[index] / 4, petals[index] / 2, angle, 0, Math.PI * 2);
                    ctx.fill();
                }
            }

            // Draw the center of the flower (yellow) after petals have bloomed
            if (yellowVisible[index]) {
                ctx.beginPath();
                ctx.arc(200, 400 - stems[index] - 20, 20, 0, Math.PI * 2); // Center radius
                ctx.fillStyle = 'yellow';
                ctx.fill();
            }
        }

        function growFlower() {
            for (let i = 0; i < flowerCount; i++) {
                // First grow the stem
                if (stems[i] < 150) { // Limit the stem growth
                    stems[i] += 2.5; // Increase the length of the stem
                } else if (!flowerBlooming[i]) { // Start blooming the petals after stem growth
                    flowerBlooming[i] = true; // Set blooming flag
                }

                // Bloom the flower petals
                if (flowerBlooming[i]) {
                    petals[i] += 1; // Increase the length of the petals
                    if (petals[i] > 150) { // Stop growing petals after a certain length
                        petals[i] = 150; // Limit petal length
                        yellowVisible[i] = true; // Show the yellow center after petals bloom
                        flowerFullyBloomed = true; // Set flag for flower fully bloomed
                    }
                }
            }

            ctx.clearRect(0, 0, canvas.width, canvas.height); // Clear the canvas
            for (let i = 0; i < flowerCount; i++) {
                drawFlower(i); // Draw each flower
            }

            // Display message and fireworks after blooming
            if (flowerFullyBloomed) {
                const messageElement = document.getElementById('message');
                messageElement.style.display = 'block';
                messageElement.style.opacity = 1; // Fade in message
                showFireworks();
                showCats(); // Show cat faces
            }

            requestAnimationFrame(growFlower); // Repeat the function
        }

        function showFireworks() {
            for (let i = 0; i < 30; i++) {
                createFirework();
            }
        }

        function createFirework() {
            const firework = document.createElement('div');
            firework.className = 'firework';
            document.body.appendChild(firework);

            // Randomize the position of the firework
            const x = Math.random() * window.innerWidth;
            const y = Math.random() * window.innerHeight;

            firework.style.left = `${x}px`;
            firework.style.top = `${y}px`;

            // Randomize the color for a rainbow effect
            const colors = ['red', 'orange', 'yellow', 'green', 'blue', 'indigo', 'violet'];
            const randomColor = colors[Math.floor(Math.random() * colors.length)];
            firework.style.backgroundColor = randomColor;

            // Remove firework after animation ends
            setTimeout(() => {
                firework.remove();
            }, 1000);
        }

        function showCats() {
            const catFaces = [
                'https://i.pinimg.com/736x/3b/37/cd/3b37cd80d4f092ed392b1453b64cf0d0.jpg', // Cat face 1
                'https://i.redd.it/funniest-cat-pictures-you-have-v0-cvk0vuc0hj5a1.jpg?width=3000&format=pjpg&auto=webp&s=73c395c63462f04c52e1550559dfb9809dd2a599', // Cat face 2
                'https://preview.redd.it/funniest-cat-pictures-you-have-v0-zkytwe5kqm5a1.jpeg?width=3024&format=pjpg&auto=webp&s=8d295f9d00b028763adde7d84b7666474fc35c21', // Cat face 3
            ];

            for (let i = 0; i < 1; i++) { // Show 5 cat faces
                const cat = document.createElement('img');
                cat.src = catFaces[Math.floor(Math.random() * catFaces.length)];
                cat.className = 'cat';
                document.body.appendChild(cat);

                // Randomize position
                const x = Math.random() * window.innerWidth;
                const y = Math.random() * (window.innerHeight - 100); // Prevent overflow
                cat.style.left = `${x}px`;
                cat.style.top = `${y}px`;

                // Add a random transformation for effect
                cat.style.transform = `scale(${Math.random() + 0.3})`;

                // Remove cat face after a short delay
                setTimeout(() => {
                    cat.remove();
                }, 3000);
            }
        }

        growFlower(); // Start the animation
    </script>
</body>

</html>
