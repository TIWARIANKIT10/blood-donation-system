<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Donation System</title>
    <link rel="stylesheet" href="style.css">
    <script defer src="script.js"></script>

    <style>
        /* Google Font */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap');

/* Reset and Body */
body {
    font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    text-align: center;
    background: linear-gradient(45deg, #ff4b5c, #ff6b6b, #ff9a8b);
    background-size: 400% 400%;
    animation: gradientAnimation 10s infinite alternate;
    transition: background 0.5s ease-in-out;
}

/* Light and Dark Mode */
.dark-mode {
    background: linear-gradient(45deg, #222, #333, #555);
}

/* Gradient Animation */
@keyframes gradientAnimation {
    0% { background-position: 0% 50%; }
    100% { background-position: 100% 50%; }
}

/* Container */
.container {
    background: rgba(255, 255, 255, 0.15);
    padding: 30px;
    border-radius: 15px;
    backdrop-filter: blur(10px);
    color: white;
    width: 80%;
    max-width: 700px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
}

/* Title Animation */
.system-title {
    font-size: 2.5em;
    font-weight: bold;
    text-transform: uppercase;
    animation: textGlow 1.5s infinite alternate;
}

/* Text Glow Animation */
@keyframes textGlow {
    0% { text-shadow: 0px 0px 10px rgba(255, 255, 255, 0.5); }
    100% { text-shadow: 0px 0px 20px rgba(255, 255, 255, 0.9); }
}

/* Description */
.description {
    font-size: 1.2em;
    margin: 15px 0;
}

/* Features */
.features {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 15px;
    margin: 20px 0;
}

.feature {
    background: rgba(255, 255, 255, 0.2);
    padding: 15px;
    border-radius: 10px;
    width: 45%;
    min-width: 150px;
    transition: transform 0.3s;
}

.feature:hover {
    transform: scale(1.05);
}

/* Advantages */
.advantages {
    text-align: left;
    margin-top: 20px;
}

.advantages ul {
    list-style: none;
    padding: 0;
}

.advantages li {
    margin: 5px 0;
}

/* Button */
.btn {
    display: inline-block;
    margin-top: 20px;
    padding: 10px 20px;
    background: #ff4b5c;
    color: white;
    font-size: 1.2em;
    text-decoration: none;
    border-radius: 10px;
    transition: background 0.3s;
}

.btn:hover {
    background: #ff1e3b;
}

/* Light/Dark Mode Button */
.mode-toggle {
    position: absolute;
    top: 15px;
    right: 15px;
}

#toggleMode {
    background: transparent;
    border: none;
    font-size: 1.5em;
    cursor: pointer;
    transition: transform 0.2s;
}

#toggleMode:hover {
    transform: scale(1.2);
}

    </style>
</head>
<body style="width:1000% height:70% padding:30px">

    <!-- Light/Dark Mode Toggle -->
    <div class="mode-toggle">
        <button id="toggleMode">🌙</button>
    </div>

    <div class="container">
        <h1 class="system-title">Blood Donation System</h1>
        <p class="description">A digital platform to connect blood donors with those in need.</p>

        <div class="features">
            <div class="feature">
                <h3>🔍 Search Donors</h3>
                <p>Find blood donors based on location and blood group.</p>
            </div>
            <div class="feature">
                <h3>📢 Request Blood</h3>
                <p>Post emergency blood requests and notify potential donors.</p>
            </div>
            <div class="feature">
                <h3>📊 Manage Stock</h3>
                <p>Admins can manage blood bank inventory efficiently.</p>
            </div>
            <div class="feature">
                <h3>📜 Donation History</h3>
                <p>Track previous donations and maintain medical records.</p>
            </div>
        </div>

        <div class="advantages">
            <h2>🚀 Advantages of the System</h2>
            <ul>
                <li>🔹 Faster access to blood donors</li>
                <li>🔹 Reduces time in emergencies</li>
                <li>🔹 Digital record management</li>
                <li>🔹 Encourages regular donations</li>
            </ul>
        </div>

        <a href="dashboard.php" class="btn">Get Started 🚀</a>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
    const toggleModeButton = document.getElementById("toggleMode");
    const body = document.body;

    // Check if dark mode was previously selected
    if (localStorage.getItem("dark-mode") === "enabled") {
        body.classList.add("dark-mode");
        toggleModeButton.textContent = "☀️";
    }

    toggleModeButton.addEventListener("click", function () {
        body.classList.toggle("dark-mode");

        if (body.classList.contains("dark-mode")) {
            localStorage.setItem("dark-mode", "enabled");
            toggleModeButton.textContent = "☀️";
        } else {
            localStorage.setItem("dark-mode", "disabled");
            toggleModeButton.textContent = "🌙";
        }
    });
});

    </script>

</body>
</html>
