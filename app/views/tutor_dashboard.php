<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tutor Dashboard - Tutor Finder</title>
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
            <a href="index.php?page=tutor_dashboard" class="active">Dashboard</a>
            <a href="index.php?page=tutor_profile">My Profile</a>
            <div class="user-menu">
                <span>Hi, <?php echo htmlspecialchars($_SESSION['user']['name']); ?></span>
                <a href="index.php?page=logout">Logout</a>
            </div>
        </nav>
    </div>
</header>

<section class="hero" style="padding: 3rem 1.5rem;">
    <div class="hero-content">
        <h2>Tutor Dashboard</h2>
        <p>Manage your profile, availability, and connect with students</p>
    </div>
</section>

<div class="container">
    <!-- Stats Overview -->
    <div class="dashboard-stats" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
        <div class="stat-card" style="background: var(--white); padding: 1.5rem; border-radius: var(--radius-lg); box-shadow: var(--shadow); text-align: center;">
            <div style="font-size: 2rem; margin-bottom: 0.5rem;">👥</div>
            <h3 style="font-size: 2rem; font-weight: 700; color: var(--primary);">0</h3>
            <p style="color: var(--gray-600);">Total Students</p>
        </div>
        <div class="stat-card" style="background: var(--white); padding: 1.5rem; border-radius: var(--radius-lg); box-shadow: var(--shadow); text-align: center;">
            <div style="font-size: 2rem; margin-bottom: 0.5rem;">⭐</div>
            <h3 style="font-size: 2rem; font-weight: 700; color: var(--warning);">0</h3>
            <p style="color: var(--gray-600);">Reviews</p>
        </div>
        <div class="stat-card" style="background: var(--white); padding: 1.5rem; border-radius: var(--radius-lg); box-shadow: var(--shadow); text-align: center;">
            <div style="font-size: 2rem; margin-bottom: 0.5rem;">💰</div>
            <h3 style="font-size: 2rem; font-weight: 700; color: var(--success);">$0</h3>
            <p style="color: var(--gray-600);">This Month</p>
        </div>
        <div class="stat-card" style="background: var(--white); padding: 1.5rem; border-radius: var(--radius-lg); box-shadow: var(--shadow); text-align: center;">
            <div style="font-size: 2rem; margin-bottom: 0.5rem;">📅</div>
            <h3 style="font-size: 2rem; font-weight: 700; color: var(--secondary);">0</h3>
            <p style="color: var(--gray-600);">Upcoming Sessions</p>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="section-header">
        <h2>Quick Actions</h2>
    </div>
    <div class="quick-actions" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1rem; margin-bottom: 2rem;">
        <a href="index.php?page=tutor_profile" class="action-card" style="background: var(--white); padding: 1.5rem; border-radius: var(--radius-lg); box-shadow: var(--shadow); text-decoration: none; display: flex; align-items: center; gap: 1rem; transition: all 0.2s ease;">
            <div style="width: 50px; height: 50px; background: var(--primary-light); border-radius: var(--radius); display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">👤</div>
            <div>
                <h3 style="color: var(--gray-900); margin-bottom: 0.25rem;">Edit Profile</h3>
                <p style="color: var(--gray-500); font-size: 0.9rem;">Update your info and subjects</p>
            </div>
        </a>
        <a href="index.php?page=tutor_availability" class="action-card" style="background: var(--white); padding: 1.5rem; border-radius: var(--radius-lg); box-shadow: var(--shadow); text-decoration: none; display: flex; align-items: center; gap: 1rem; transition: all 0.2s ease;">
            <div style="width: 50px; height: 50px; background: var(--secondary); border-radius: var(--radius); display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">📅</div>
            <div>
                <h3 style="color: var(--gray-900); margin-bottom: 0.25rem;">Set Availability</h3>
                <p style="color: var(--gray-500); font-size: 0.9rem;">Manage your schedule</p>
            </div>
        </a>
        <a href="index.php?page=tutor_subjects" class="action-card" style="background: var(--white); padding: 1.5rem; border-radius: var(--radius-lg); box-shadow: var(--shadow); text-decoration: none; display: flex; align-items: center; gap: 1rem; transition: all 0.2s ease;">
            <div style="width: 50px; height: 50px; background: var(--success); border-radius: var(--radius); display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">📚</div>
            <div>
                <h3 style="color: var(--gray-900); margin-bottom: 0.25rem;">My Subjects</h3>
                <p style="color: var(--gray-500); font-size: 0.9rem;">Add or remove subjects</p>
            </div>
        </a>
    </div>

    <!-- Recent Activity -->
    <div class="section-header">
        <h2>Recent Activity</h2>
    </div>
    <div class="activity-list" style="background: var(--white); border-radius: var(--radius-lg); box-shadow: var(--shadow); padding: 1.5rem;">
        <div class="empty-state" style="padding: 2rem;">
            <div class="empty-state-icon">📋</div>
            <h3>No recent activity</h3>
            <p>Your recent student requests and messages will appear here.</p>
        </div>
    </div>
</div>

<footer>
    <p>&copy; <?php echo date('Y'); ?> Tutor Finder. All rights reserved.</p>
</footer>

</body>
</html>
