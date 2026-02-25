<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Tutor Finder</title>
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
            <a href="index.php?page=login">Login</a>
        </nav>
    </div>
</header>

<div class="form-container">
    <h2>Create Account</h2>
    <p class="form-subtitle">Join our community of learners and tutors</p>
    
    <?php if (!empty($error)): ?>
        <div class="alert alert-error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>
    
    <form method="post" action="">
        <div class="form-group">
            <label for="name">Full Name</label>
            <input type="text" id="name" name="name" placeholder="John Doe" required>
        </div>
        
        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" placeholder="you@example.com" required>
        </div>
        
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Create a strong password" required>
        </div>
        
        <div class="form-group">
            <label for="phone">Phone Number (Optional)</label>
            <input type="tel" id="phone" name="phone" placeholder="+1 (555) 123-4567">
        </div>
        
        <div class="form-group">
            <label for="role">I want to</label>
            <select id="role" name="role" required>
                <option value="student">Find a Tutor (Student)</option>
                <option value="tutor">Become a Tutor</option>
            </select>
        </div>
        
        <button type="submit" class="btn-submit">Create Account</button>
    </form>
    
    <div class="form-footer">
        <p>Already have an account? <a href="index.php?page=login">Sign in</a></p>
    </div>
</div>

<footer>
    <p>&copy; <?php echo date('Y'); ?> Tutor Finder. All rights reserved.</p>
</footer>

</body>
</html>
