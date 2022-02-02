<?php include "includes/auth-header.php"; ?>
<body class="auth-body">
    
    <section class="form-section">
        <div class="myCard">
            <div class="form-header">
                <h3>Register Your Details</h3>
            </div>
            <form action="" method="POST">
                <div class="error-text"></div>
                
                <div class="form-group">
                    <label for="">User Name</label>
                    <input class="input" type="text" name="username" id="uname" placeholder="Enter Your User Name">
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
    
    <script src="../JS/admin/register.js"></script>
</body>
</html>