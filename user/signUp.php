<?php include "includes/auth-header.php"; ?>
<body class="auth-body">
    
    <section class="form-section">
        <div class="myCard">
            <div class="form-header">
                <h3>Register Your Details</h3>
            </div>
            <form action="" method="POST">
                <div class="error-text"></div>
                <div class="name-details">
                    <div class="form-group">
                        <label for="">User Name</label>
                        <input class="input" type="text" name="fname" id="fname" placeholder="Enter Your First Name">
                    </div>
                    <div class="form-group">
                        <label for="">Last Name</label>
                        <input class="input" type="text" name="lname" id="lname" placeholder="Enter Your Last Name">
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Your Contact Number</label>
                    <input type="number" class="input" onchange="checkContact()" name="contact" id="contact">
                    <div class="error cont-error">this is an error</div>
                </div>
                <div class="form-group">
                    <label for=""><input type="radio" name="gender" id="" value="male">Male</label>
                    <label for=""><input type="radio" name="gender" id="" value="female">Female</label>
                    
                </div>
                <div class="form-group">
                    <label for="">ID Number</label>
                    <input type="number" max="10" onchange="checkNumber()" name="idno" id="idno" class="input">
                </div>
                <div class="form-group">
                    <label for="">Your Email</label>
                    <input class="input" type="email" name="email" id="email" placeholder="example@gmail.com">
                </div>
                <div class="form-group">
                    <label for="">Your Password</label>
                    <input class="input" type="password" name="pwd1" id="password" placeholder="Enter Your Password">
                </div>
                <div class="form-group">
                    <label for="">Confirm Password</label>
                    <input class="input" type="password" name="pwd2" id="password2" onchange="checkValue()" placeholder="example@gmail.com">
                    <div><h6 class="matching">pass</h6></div>
                </div>
                <div class="button">
                    <input type="submit" name="submit" id="submit">
                </div>
                <div class="link">
                    <h5>Already regitered? <a href="login.php">Login</a></h5>
                </div>
            </form>
        </div>
    </section>
    
    <script src="../JS/user/register.js"></script>
</body>
</html>