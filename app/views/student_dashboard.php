<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard - Tutor Finder</title>
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
            <a href="index.php?page=student_dashboard" class="active">Dashboard</a>
            <div class="user-menu">
                <span>Hi, <?php echo htmlspecialchars($_SESSION['user']['name']); ?></span>
                <a href="index.php?page=logout">Logout</a>
            </div>
        </nav>
    </div>
</header>

<section class="hero" style="padding: 3rem 1.5rem;">
    <div class="hero-content">
        <h2>Student Dashboard</h2>
        <p>Find tutors, manage your sessions, and track your progress</p>
    </div>
</section>

<div class="container">
    <!-- Quick Actions -->
    <div class="section-header">
        <h2>Quick Actions</h2>
    </div>
    <div class="quick-actions" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1rem; margin-bottom: 2rem;">
        <a href="index.php?page=tutors" class="action-card" style="background: var(--white); padding: 1.5rem; border-radius: var(--radius-lg); box-shadow: var(--shadow); text-decoration: none; display: flex; align-items: center; gap: 1rem; transition: all 0.2s ease;">
            <div style="width: 50px; height: 50px; background: var(--primary-light); border-radius: var(--radius); display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">🔍</div>
            <div>
                <h3 style="color: var(--gray-900); margin-bottom: 0.25rem;">Find a Tutor</h3>
                <p style="color: var(--gray-500); font-size: 0.9rem;">Search for tutors by subject</p>
            </div>
        </a>
        <a href="index.php?page=my_sessions" class="action-card" style="background: var(--white); padding: 1.5rem; border-radius: var(--radius-lg); box-shadow: var(--shadow); text-decoration: none; display: flex; align-items: center; gap: 1rem; transition: all 0.2s ease;">
            <div style="width: 50px; height: 50px; background: var(--secondary); border-radius: var(--radius); display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">📅</div>
            <div>
                <h3 style="color: var(--gray-900); margin-bottom: 0.25rem;">My Sessions</h3>
                <p style="color: var(--gray-500); font-size: 0.9rem;">View upcoming and past sessions</p>
            </div>
        </a>
        <a href="index.php?page=my_tutors" class="action-card" style="background: var(--white); padding: 1.5rem; border-radius: var(--radius-lg); box-shadow: var(--shadow); text-decoration: none; display: flex; align-items: center; gap: 1rem; transition: all 0.2s ease;">
            <div style="width: 50px; height: 50px; background: var(--success); border-radius: var(--radius); display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">👨‍🏫</div>
            <div>
                <h3 style="color: var(--gray-900); margin-bottom: 0.25rem;">My Tutors</h3>
                <p style="color: var(--gray-500); font-size: 0.9rem;">See tutors you've worked with</p>
            </div>
        </a>
    </div>

    <!-- Upcoming Sessions -->
    <div class="section-header">
        <h2>Upcoming Sessions</h2>
        <a href="index.php?page=my_sessions" style="color: var(--primary); font-weight: 600; text-decoration: none;">View All →</a>
    </div>
    <div class="sessions-list" style="background: var(--white); border-radius: var(--radius-lg); box-shadow: var(--shadow); padding: 1.5rem; margin-bottom: 2rem;">
        <div class="empty-state" style="padding: 2rem;">
            <div class="empty-state-icon">📅</div>
            <h3>No upcoming sessions</h3>
            <p>Book a session with a tutor to get started!</p>
            <a href="index.php?page=tutors" class="btn-primary" style="display: inline-block; margin-top: 1rem; padding: 0.75rem 1.5rem; text-decoration: none;">Find a Tutor</a>
        </div>
    </div>

    <!-- Recommended Tutors -->
    <div class="section-header">
        <h2>Recommended Tutors</h2>
        <a href="index.php?page=tutors" style="color: var(--primary); font-weight: 600; text-decoration: none;">Browse All →</a>
    </div>
    
    <?php if (isset($tutors) && $tutors instanceof mysqli_result && $tutors->num_rows > 0): ?>
        <div class="tutors-grid">
            <?php $count = 0; while($row = $tutors->fetch_assoc() && $count < 3): $count++; ?>
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
                    <button class="btn">Book Session</button>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <div class="empty-state" style="background: var(--white); border-radius: var(--radius-lg); box-shadow: var(--shadow); padding: 2rem;">
            <div class="empty-state-icon">👨‍🏫</div>
            <h3>No tutors available</h3>
            <p>Check back later for available tutors in your area.</p>
        </div>
    <?php endif; ?>
</div>

<footer>
    <p>&copy; <?php echo date('Y'); ?> Tutor Finder. All rights reserved.</p>
</footer>

</body>
</html>
