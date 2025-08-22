<?php
// Get flag from environment variable or use default
$flag = getenv('FLAG') ?: 'flag{YummyC00k13s}';

if(array_key_exists("Red_Guy's_name", $_COOKIE) && preg_match('/([Ee])lmo+/', $_COOKIE["Red_Guy's_name"])){
    $output = '<div class="success-message">
                    <h2>You got it!</h2>
                    <div class="flag-display">' . htmlspecialchars($flag) . '</div>
                    <p>Cookie Monster is happy to share his cookies with Elmo!</p>
                </div>';
    $showElmo = true;
    $cookieMonsterImage = 'images/cookie-monster-2.webp';
    $cookieValue = $_COOKIE["Red_Guy's_name"];
} else {
    $output = '<div class="challenge-message">
                    <h2>Cookie Monster Challenge</h2>
                    <p>Cookie Monster is looking for his favorite red friend!</p>
                </div>';
    $showElmo = false;
    $cookieMonsterImage = 'images/cookie-monster-1.webp';
    if(!array_key_exists("Red_Guy's_name", $_COOKIE)) {
        setcookie("Red_Guy's_name", 'NameGoesHere', time()+300);
        $cookieValue = 'NameGoesHere';
    } else {
        $cookieValue = $_COOKIE["Red_Guy's_name"];
    }
}

$elmoElement = '';
if ($showElmo) {
    $elmoElement = '<div class="elmo show">
                        <img src="images/elmo-1.webp" alt="Elmo" class="character-image">
                    </div>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cookie Monster Challenge</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Comic Sans MS', cursive, sans-serif;
            background-color: #00BFFF;
            width: 100%;
            height: 100vh;
            overflow: hidden;
            position: relative;
        }

        /* Hill Background */
        .hill {
            position: absolute;
            bottom: 0;
            right: 0;
            width: 100%;
            height: 55%;
            border-top-right-radius: 0;
            border-top-left-radius: 100%;
            background-color: #7ba428;
            z-index: 1;
        }

        .hill:before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0; 
            width: 120%;
            height: 110%;
            border-top-right-radius: 100%;
            border-top-left-radius: 0%;
            background-color: #9acd32;
        }

        /* Cloud Animation Background */
        #background-wrap {
            bottom: 0;
            left: 0;
            padding-top: 50px;
            position: fixed;
            right: 0;
            top: 0;
            z-index: 0;
        }

        /* Cloud Keyframes */
        @-webkit-keyframes animateCloud {
            0% {
                margin-left: -1000px;
            }
            100% {
                margin-left: 100%;
            }
        }

        @-moz-keyframes animateCloud {
            0% {
                margin-left: -1000px;
            }
            100% {
                margin-left: 100%;
            }
        }

        @keyframes animateCloud {
            0% {
                margin-left: -1000px;
            }
            100% {
                margin-left: 100%;
            }
        }

        /* Cloud Animations */
        .x1 {
            -webkit-animation: animateCloud 35s linear infinite;
            -moz-animation: animateCloud 35s linear infinite;
            animation: animateCloud 35s linear infinite;
            
            -webkit-transform: scale(0.65);
            -moz-transform: scale(0.65);
            transform: scale(0.65);
        }

        .x2 {
            -webkit-animation: animateCloud 20s linear infinite;
            -moz-animation: animateCloud 20s linear infinite;
            animation: animateCloud 20s linear infinite;
            
            -webkit-transform: scale(0.3);
            -moz-transform: scale(0.3);
            transform: scale(0.3);
        }

        .x3 {
            -webkit-animation: animateCloud 30s linear infinite;
            -moz-animation: animateCloud 30s linear infinite;
            animation: animateCloud 30s linear infinite;
            
            -webkit-transform: scale(0.5);
            -moz-transform: scale(0.5);
            transform: scale(0.5);
        }

        .x4 {
            -webkit-animation: animateCloud 18s linear infinite;
            -moz-animation: animateCloud 18s linear infinite;
            animation: animateCloud 18s linear infinite;
            
            -webkit-transform: scale(0.4);
            -moz-transform: scale(0.4);
            transform: scale(0.4);
        }

        .x5 {
            -webkit-animation: animateCloud 25s linear infinite;
            -moz-animation: animateCloud 25s linear infinite;
            animation: animateCloud 25s linear infinite;
            
            -webkit-transform: scale(0.55);
            -moz-transform: scale(0.55);
            transform: scale(0.55);
        }

        /* Cloud Objects */
        .cloud {
            background: #fff;
            background: -moz-linear-gradient(top,  #fff 5%, #f1f1f1 100%);
            background: -webkit-gradient(linear, left top, left bottom, color-stop(5%,#fff), color-stop(100%,#f1f1f1));
            background: -webkit-linear-gradient(top,  #fff 5%,#f1f1f1 100%);
            background: -o-linear-gradient(top,  #fff 5%,#f1f1f1 100%);
            background: -ms-linear-gradient(top,  #fff 5%,#f1f1f1 100%);
            background: linear-gradient(top,  #fff 5%,#f1f1f1 100%);
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fff', endColorstr='#f1f1f1',GradientType=0 );
            
            -webkit-border-radius: 100px;
            -moz-border-radius: 100px;
            border-radius: 100px;
            
            -webkit-box-shadow: 0 8px 5px rgba(0, 0, 0, 0.1);
            -moz-box-shadow: 0 8px 5px rgba(0, 0, 0, 0.1);
            box-shadow: 0 8px 5px rgba(0, 0, 0, 0.1);

            height: 120px;
            position: relative;
            width: 350px;
        }

        .cloud:after, .cloud:before {
            background: #fff;
            content: '';
            position: absolute;
            z-index: -1;
        }

        .cloud:after {
            -webkit-border-radius: 100px;
            -moz-border-radius: 100px;
            border-radius: 100px;

            height: 100px;
            left: 50px;
            top: -50px;
            width: 100px;
        }

        .cloud:before {
            -webkit-border-radius: 200px;
            -moz-border-radius: 200px;
            border-radius: 200px;

            width: 180px;
            height: 180px;
            right: 50px;
            top: -90px;
        }

        .container {
            position: relative;
            z-index: 10;
            padding: 2rem;
            text-align: center;
            max-width: 800px;
            margin: 0 auto;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .challenge-message, .success-message {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 2rem;
            margin: 2rem 0;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            border: 3px solid #FF6B35;
        }

        h1 {
            color: #FF6B35;
            font-size: 3rem;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        h2 {
            color: #FF6B35;
            font-size: 2rem;
            margin-bottom: 1rem;
        }

        p {
            font-size: 1.2rem;
            margin-bottom: 1rem;
            color: #333;
        }

        code {
            background: #f4f4f4;
            padding: 0.2rem 0.5rem;
            border-radius: 5px;
            font-family: 'Courier New', monospace;
            color: #FF6B35;
            font-weight: bold;
        }

        .hint {
            background: #FFF3CD;
            border: 2px solid #FFEAA7;
            border-radius: 10px;
            padding: 1rem;
            margin: 1rem 0;
        }

        .flag-display {
            background: linear-gradient(45deg, #FF6B35, #F7931E);
            color: white;
            padding: 1.5rem;
            border-radius: 15px;
            font-family: 'Courier New', monospace;
            font-size: 1.5rem;
            font-weight: bold;
            margin: 1rem 0;
            box-shadow: 0 5px 15px rgba(255, 107, 53, 0.4);
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
        }

        /* Character Images */
        .cookie-monster {
            position: fixed;
            bottom: 15vh;
            left: 10%;
            width: 200px;
            height: 200px;
            z-index: 5;
        }

        .elmo {
            position: fixed;
            bottom: 15vh;
            right: 10%;
            width: 200px;
            height: 200px;
            z-index: 5;
            opacity: 0;
            transition: opacity 1s ease-in-out;
        }

        .elmo.show {
            opacity: 1;
        }

        .character-image {
            width: 100%;
            height: 100%;
            object-fit: contain;
            filter: drop-shadow(0 10px 20px rgba(0, 0, 0, 0.3));
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .cookie-monster, .elmo {
                transform: scale(0.7);
            }
            
            .cookie-monster {
                left: 5%;
            }
            
            .elmo {
                right: 5%;
            }
            
            h1 {
                font-size: 2rem;
            }
            
            h2 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <!-- Hill Background -->
    <div class="hill"></div>

    <!-- Cloud Animation Background -->
    <div id="background-wrap">
        <div class="x1">
            <div class="cloud"></div>
        </div>

        <div class="x2">
            <div class="cloud"></div>
        </div>

        <div class="x3">
            <div class="cloud"></div>
        </div>

        <div class="x4">
            <div class="cloud"></div>
        </div>

        <div class="x5">
            <div class="cloud"></div>
        </div>
    </div>

    <div class="cookie-monster">
        <img src="<?php echo $cookieMonsterImage; ?>" alt="Cookie Monster" class="character-image">
    </div>

    <!-- Elmo (only appears when challenge is solved) -->
    <?php echo $elmoElement; ?>

    <div class="container">
        <h1>Cookie Monster Challenge</h1>
        
        <?php echo $output; ?>
        
        <div style="margin-top: 2rem;">
            <p><strong>Current cookie value:</strong> 
                <code><?php echo isset($cookieValue) ? htmlspecialchars($cookieValue) : 'Not set'; ?></code>
            </p>
        </div>
    </div>

    <!-- Have you heard of an HTTP cookie? -->
</body>
</html>
