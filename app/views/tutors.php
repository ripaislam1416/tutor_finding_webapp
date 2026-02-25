<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find Tutors - Tutor Finder</title>
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
            <?php if (isset($_SESSION['user'])): ?>
                <div class="user-menu">
                    <span>Hi, <?php echo htmlspecialchars($_SESSION['user']['name']); ?></span>
                    <?php if ($_SESSION['user']['role'] === 'tutor'): ?>
                        <a href="index.php?page=tutor_dashboard">Dashboard</a>
                    <?php else: ?>
                        <a href="index.php?page=student_dashboard">Dashboard</a>
                    <?php endif; ?>
                    <a href="index.php?page=logout">Logout</a>
                </div>
            <?php else: ?>
                <a href="index.php?page=login">Login</a>
                <a href="index.php?page=register" class="btn-primary">Get Started</a>
            <?php endif; ?>
        </nav>
    </div>
</header>

<section class="hero" style="padding: 3rem 1.5rem;">
    <div class="hero-content">
        <h2>Find Your Perfect Tutor</h2>
        <p>Browse our network of qualified tutors</p>
    </div>
</section>

<div class="search-container">
    <form class="search-form" action="index.php" method="GET">
        <input type="hidden" name="page" value="tutors">
        <input type="text" name="subject" placeholder="Subject (e.g., Math, Physics)" value="<?php echo isset($_GET['subject']) ? htmlspecialchars($_GET['subject']) : ''; ?>">
        <input type="text" name="location" placeholder="Location" value="<?php echo isset($_GET['location']) ? htmlspecialchars($_GET['location']) : ''; ?>">
        <button type="submit">Search</button>
    </form>
</div>

<div class="container">
    <div class="section-header">
        <h2>Available Tutors</h2>
        <?php if (isset($tutors) && $tutors instanceof mysqli_result): ?>
            <span style="color: var(--gray-500);"><?php echo $tutors->num_rows; ?> tutor(s) found</span>
        <?php endif; ?>
    </div>
    
    <?php if (isset($tutors) && $tutors instanceof mysqli_result && $tutors->num_rows > 0): ?>
        <div class="tutors-grid">
            <?php while($row = $tutors->fetch_assoc()): ?>
                <div class="tutor-card">
                    <div class="tutor-header">
                        <div class="tutor-avatar">
                            <?php echo strtoupper(substr($row['name'], 0, 1)); ?>
                        </div>
                        <div class="tutor-info">
                            <h3><?php echo htmlspecialchars($row['name']); ?></h3>
                            <span class="subject"><?php echo htmlspecialchars($row['subject']); ?></span>
                        </div>
                    </div>
                    <div class="tutor-details">
                        <p><span class="icon">📍</span> <?php echo htmlspecialchars($row['location']); ?></p>
                        <p class="tutor-rate">$<?php echo htmlspecialchars($row['hourly_rate']); ?> <span>/ hour</span></p>
                    </div>
                    <button class="btn">Contact Tutor</button>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <div class="empty-state">
            <div class="empty-state-icon">🔍</div>
            <h3>No tutors found</h3>
            <p>Try adjusting your search criteria or check back later.</p>
        </div>
    <?php endif; ?>
</div>

<footer>
    <p>&copy; <?php echo date('Y'); ?> Tutor Finder. All rights reserved.</p>
</footer>

</body>
</html>
