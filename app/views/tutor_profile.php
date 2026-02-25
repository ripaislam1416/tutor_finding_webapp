<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - Tutor Finder</title>
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
            <a href="index.php?page=tutor_dashboard">Dashboard</a>
            <a href="index.php?page=tutor_profile" class="active">My Profile</a>
            <div class="user-menu">
                <span>Hi, <?php echo htmlspecialchars($_SESSION['user']['name']); ?></span>
                <a href="index.php?page=logout">Logout</a>
            </div>
        </nav>
    </div>
</header>

<section class="hero" style="padding: 3rem 1.5rem;">
    <div class="hero-content">
        <h2>My Tutor Profile</h2>
        <p>Manage your profile information and settings</p>
    </div>
</section>

<div class="container">
    <?php if (!empty($success)): ?>
        <div class="alert alert-success" style="margin-bottom: 1.5rem;"><?php echo htmlspecialchars($success); ?></div>
    <?php endif; ?>
    
    <?php if (!empty($error)): ?>
        <div class="alert alert-error" style="margin-bottom: 1.5rem;"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 2rem;">
        <!-- Profile Preview Card -->
        <div>
            <div style="background: var(--white); border-radius: var(--radius-lg); box-shadow: var(--shadow); padding: 2rem; text-align: center;">
                <div style="width: 120px; height: 120px; border-radius: 50%; background: linear-gradient(135deg, var(--primary-light) 0%, var(--secondary) 100%); display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem; font-size: 3rem; color: var(--white); font-weight: 700;">
                    <?php echo strtoupper(substr($_SESSION['user']['name'], 0, 1)); ?>
                </div>
                <h3 style="font-size: 1.25rem; font-weight: 700; color: var(--gray-900); margin-bottom: 0.5rem;">
                    <?php echo htmlspecialchars($_SESSION['user']['name']); ?>
                </h3>
                <p style="color: var(--primary); font-weight: 500; margin-bottom: 1rem;">Tutor</p>
                
                <?php if ($profile): ?>
                    <div style="text-align: left; padding-top: 1rem; border-top: 1px solid var(--gray-200);">
                        <p style="color: var(--gray-600); margin-bottom: 0.5rem;">
                            <strong>Location:</strong> <?php echo htmlspecialchars($profile['location'] ?? 'Not set'); ?>
                        </p>
                        <p style="color: var(--gray-600); margin-bottom: 0.5rem;">
                            <strong>Rate:</strong> $<?php echo htmlspecialchars($profile['hourly_rate'] ?? '0'); ?>/hour
                        </p>
                        <p style="color: var(--gray-600); margin-bottom: 0.5rem;">
                            <strong>Experience:</strong> <?php echo htmlspecialchars($profile['experience_years'] ?? '0'); ?> years
                        </p>
                    </div>
                <?php else: ?>
                    <p style="color: var(--gray-500); padding-top: 1rem; border-top: 1px solid var(--gray-200);">
                        Complete your profile to attract more students!
                    </p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Profile Form -->
        <div>
            <div style="background: var(--white); border-radius: var(--radius-lg); box-shadow: var(--shadow); padding: 2rem;">
                <h3 style="font-size: 1.25rem; font-weight: 700; color: var(--gray-900); margin-bottom: 1.5rem;">
                    <?php echo $profile ? 'Edit Profile' : 'Complete Your Profile'; ?>
                </h3>
                
                <form method="post" action="" enctype="multipart/form-data">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                        <div class="form-group">
                            <label for="qualification">Qualification</label>
                            <input type="text" id="qualification" name="qualification" 
                                   value="<?php echo htmlspecialchars($profile['qualification'] ?? ''); ?>"
                                   placeholder="e.g., Master's in Mathematics" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="experience_years">Years of Experience</label>
                            <input type="number" id="experience_years" name="experience_years" min="0"
                                   value="<?php echo htmlspecialchars($profile['experience_years'] ?? ''); ?>"
                                   placeholder="e.g., 5" required>
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-top: 1rem;">
                        <div class="form-group">
                            <label for="hourly_rate">Hourly Rate ($)</label>
                            <input type="number" id="hourly_rate" name="hourly_rate" min="0" step="0.01"
                                   value="<?php echo htmlspecialchars($profile['hourly_rate'] ?? ''); ?>"
                                   placeholder="e.g., 50.00" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="location">Location</label>
                            <input type="text" id="location" name="location"
                                   value="<?php echo htmlspecialchars($profile['location'] ?? ''); ?>"
                                   placeholder="e.g., New York, NY" required>
                        </div>
                    </div>

                    <div class="form-group" style="margin-top: 1rem;">
                        <label for="bio">Bio / About Me</label>
                        <textarea id="bio" name="bio" rows="5" placeholder="Tell students about yourself, your teaching style, and what subjects you specialize in..." 
                                  style="width: 100%; padding: 0.875rem 1rem; border: 2px solid var(--gray-200); border-radius: var(--radius); font-size: 1rem; font-family: inherit; resize: vertical;"><?php echo htmlspecialchars($profile['bio'] ?? ''); ?></textarea>
                    </div>

                    <div class="form-group" style="margin-top: 1rem;">
                        <label for="profile_image">Profile Image</label>
                        <input type="file" id="profile_image" name="profile_image" accept="image/*"
                               style="width: 100%; padding: 0.5rem; border: 2px dashed var(--gray-300); border-radius: var(--radius); cursor: pointer;">
                        <p style="color: var(--gray-500); font-size: 0.85rem; margin-top: 0.5rem;">Upload a professional photo (JPG, PNG, max 2MB)</p>
                        <?php if (!empty($profile['profile_image'])): ?>
                            <p style="color: var(--gray-600); font-size: 0.9rem; margin-top: 0.5rem;">
                                Current image: <?php echo htmlspecialchars($profile['profile_image']); ?>
                            </p>
                        <?php endif; ?>
                    </div>

                    <div style="margin-top: 1.5rem; display: flex; gap: 1rem;">
                        <button type="submit" class="btn-submit" style="flex: 1;">
                            <?php echo $profile ? 'Update Profile' : 'Create Profile'; ?>
                        </button>
                        <a href="index.php?page=tutor_dashboard" class="btn" style="flex: 1; text-align: center; text-decoration: none; padding: 1rem; background: var(--gray-200); color: var(--gray-700);">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<footer>
    <p>&copy; <?php echo date('Y'); ?> Tutor Finder. All rights reserved.</p>
</footer>

</body>
</html>
