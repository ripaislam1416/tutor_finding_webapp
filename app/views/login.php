<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Tutor Finder</title>
    <link rel="stylesheet" href="app/assets/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
<header>
    <div class="header-content">
        <h1>Tutor Finder</h1>
        <nav>
            <a href="index.php">Home</a>
            <a href="index.php?page=tutors">Find Tutors</a>
            <a href="index.php?page=register">Register</a>
        </nav>
    </div>
</header>

<div class="form-container">
    <h2>Welcome Back</h2>
    <p class="form-subtitle">Sign in to your account to continue</p>
    
    <?php if (!empty($error)): ?>
        <div class="alert alert-error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>
    
    <form method="post" action="">
        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" placeholder="you@example.com" required>
        </div>
        
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>
        </div>
        
        <button type="submit" class="btn-submit">Sign In</button>
    </form>
    
    <div class="form-footer">
        <p>Don't have an account? <a href="index.php?page=register">Create one</a></p>
    </div>
</div>

<footer>
    <p>&copy; <?php echo date('Y'); ?> Tutor Finder. All rights reserved.</p>
</footer>

</body>
</html>
