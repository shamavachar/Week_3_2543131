<?php
/**
 * Ultimate Student Analytics Dashboard
 * GitHub Weekly Commit Challenge - Sangameshwar College
 */

// --- Database Configuration ---
$host = "localhost";
$username = "root";
$password = "";
$dbname = "college_db";

try {
    $conn = new mysqli($host, $username, $password, $dbname);
    if ($conn->connect_error) {
        throw new Exception("Connection Failed: " . $conn->connect_error);
    }

    // Fetch Analytics Stats
    $stats_query = "SELECT 
        COUNT(*) as total_students, 
        SUM(commits_count) as total_commits,
        MAX(commits_count) as top_score,
        AVG(commits_count) as avg_commits
    FROM students";
    $stats_res = $conn->query($stats_query);
    $stats = $stats_res->fetch_assoc();

    // Fetch All Records sorted by commits
    $sql = "SELECT roll_no, name, email, class, commits_count, last_commit_date FROM students ORDER BY commits_count DESC";
    $result = $conn->query($sql);

    if (!$result) {
        throw new Exception("Query Failed: " . $conn->error);
    }

} catch (Exception $e) {
    $error_message = $e->getMessage();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commit Challenge | Sangameshwar College</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700;800&family=Bento:wght@400;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --background: oklch(1.0000 0 0);
            --foreground: oklch(0.1884 0.0128 248.5103);
            --primary: oklch(0.6723 0.1606 244.9955);
            --primary-foreground: oklch(1.0000 0 0);
            --secondary: oklch(0.1884 0.0128 248.5103);
            --accent: oklch(0.9392 0.0166 250.8453);
            --success: oklch(0.6907 0.1554 160.3454);
            --card: #ffffff;
            --border: oklch(0.9317 0.0118 231.6594);
            --radius-xl: 2rem;
            --shadow-premium: 0 20px 50px -12px rgba(0, 0, 0, 0.08);
            --mesh-1: oklch(0.6723 0.1606 244.9955 / 0.15);
            --mesh-2: oklch(0.6907 0.1554 160.3454 / 0.15);
        }

        .dark {
            --background: oklch(0.12 0.01 247);
            --foreground: oklch(0.9328 0.0025 228.7857);
            --card: oklch(0.18 0.02 247);
            --border: oklch(0.26 0.02 247);
            --accent: oklch(0.25 0.04 242);
            --mesh-1: oklch(0.6723 0.1606 244.9955 / 0.2);
            --mesh-2: oklch(0.6907 0.1554 160.3454 / 0.2);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        body {
            background-color: var(--background);
            color: var(--foreground);
            font-family: 'Outfit', sans-serif;
            min-height: 100vh;
            overflow-x: hidden;
            background-image: 
                radial-gradient(at 0% 0%, var(--mesh-1) 0px, transparent 50%),
                radial-gradient(at 100% 100%, var(--mesh-2) 0px, transparent 50%);
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 3rem 2rem;
        }

        /* Premium Header Section */
        header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 4rem;
            animation: slideDown 1s ease-out;
        }

        .college-info h1 {
            font-size: 3rem;
            font-weight: 900;
            letter-spacing: -2px;
            margin-bottom: 0.5rem;
            background: linear-gradient(135deg, var(--primary), var(--success));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .college-info p {
            font-size: 1.1rem;
            font-weight: 500;
            opacity: 0.7;
            text-transform: uppercase;
            letter-spacing: 3px;
        }

        .badge-live {
            background: var(--success);
            color: white;
            padding: 0.5rem 1.5rem;
            border-radius: 100px;
            font-weight: 700;
            font-size: 0.8rem;
            display: flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 10px 20px -5px var(--success);
        }

        .pulse-dot {
            width: 8px;
            height: 8px;
            background: white;
            border-radius: 50%;
            animation: pulse 1.5s infinite;
        }

        /* Bento Grid Stats */
        .bento-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.5rem;
            margin-bottom: 4rem;
        }

        .bento-card {
            background: var(--card);
            border: 1px solid var(--border);
            padding: 2.5rem;
            border-radius: var(--radius-xl);
            position: relative;
            overflow: hidden;
            box-shadow: var(--shadow-premium);
        }

        .bento-card:hover {
            transform: translateY(-10px) scale(1.02);
            border-color: var(--primary);
        }

        .bento-card::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255,255,255,0.1), transparent);
            transform: rotate(45deg);
            transition: 0.5s;
        }

        .bento-card:hover::after {
            left: 100%;
        }

        .stat-label {
            font-size: 0.9rem;
            font-weight: 600;
            opacity: 0.5;
            margin-bottom: 1rem;
            display: block;
        }

        .stat-value {
            font-size: 2.5rem;
            font-weight: 800;
            display: block;
            margin-bottom: 0.5rem;
        }

        .stat-trend {
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--success);
        }

        /* Leaderboard Table */
        .leaderboard-section {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: var(--radius-xl);
            padding: 2rem;
            box-shadow: var(--shadow-premium);
            animation: fadeInUp 1s ease-out;
        }

        .section-title {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding: 0 1rem;
        }

        .section-title h2 {
            font-size: 1.5rem;
            font-weight: 800;
        }

        .table-container {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 1rem;
        }

        th {
            padding: 1.5rem;
            text-align: left;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            opacity: 0.4;
            font-weight: 800;
        }

        tr {
            background: transparent;
        }

        .student-row {
            background: var(--background);
            border-radius: 1.5rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.02);
        }

        .student-row:hover {
            transform: scale(1.01);
            background: var(--accent);
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        }

        td {
            padding: 1.5rem;
            font-size: 1rem;
        }

        td:first-child { border-radius: 1.5rem 0 0 1.5rem; }
        td:last-child { border-radius: 0 1.5rem 1.5rem 0; }

        .rank {
            width: 50px;
            height: 50px;
            background: var(--primary);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            font-weight: 900;
            font-size: 1.2rem;
        }

        .student-meta {
            display: flex;
            flex-direction: column;
        }

        .student-meta .name {
            font-weight: 800;
            font-size: 1.1rem;
        }

        .student-meta .roll {
            font-size: 0.8rem;
            opacity: 0.6;
        }

        .commit-chip {
            background: var(--primary-soft, rgba(0,0,0,0.05));
            padding: 0.5rem 1.2rem;
            border-radius: 100px;
            font-weight: 700;
            color: var(--primary);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        /* Animations */
        @keyframes pulse {
            0% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.8); opacity: 0; }
            100% { transform: scale(1); opacity: 1; }
        }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-50px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(50px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Responsive Improvements */
        @media (max-width: 1200px) {
            .bento-grid { grid-template-columns: repeat(2, 1fr); }
        }

        @media (max-width: 768px) {
            header { flex-direction: column; gap: 2rem; }
            .college-info h1 { font-size: 2rem; }
            .bento-grid { grid-template-columns: 1fr; }
            .container { padding: 1.5rem; }
        }
    </style>
</head>
<body class="<?php echo (isset($_COOKIE['theme']) && $_COOKIE['theme'] == 'dark') ? 'dark' : ''; ?>">

<div class="container">
    <header>
        <div class="college-info">
            <p>Department of Computer Science</p>
            <h1>Commit Portal.</h1>
        </div>
        <div class="actions">
            <div class="badge-live">
                <div class="pulse-dot"></div>
                Challenge Live: Week 03
            </div>
        </div>
    </header>

    <?php if (isset($error_message)): ?>
        <div class="bento-card" style="border-color: #dc2626; color: #dc2626;">
            <h2>System Offline</h2>
            <p><?php echo $error_message; ?></p>
        </div>
    <?php else: ?>
        <div class="bento-grid">
            <div class="bento-card" style="animation-delay: 0.1s">
                <span class="stat-label">Total Participants</span>
                <span class="stat-value"><?php echo number_format($stats['total_students'] ?? 0); ?></span>
                <span class="stat-trend">+2 this week</span>
            </div>
            <div class="bento-card" style="animation-delay: 0.2s">
                <span class="stat-label">Global Commits</span>
                <span class="stat-value"><?php echo number_format($stats['total_commits'] ?? 0); ?></span>
                <span class="stat-trend">High Activity</span>
            </div>
            <div class="bento-card" style="animation-delay: 0.3s">
                <span class="stat-label">Average Intensity</span>
                <span class="stat-value"><?php echo round($stats['avg_commits'] ?? 0, 1); ?></span>
                <span class="stat-trend" style="color: var(--primary)">Commits / Student</span>
            </div>
            <div class="bento-card" style="animation-delay: 0.4s">
                <span class="stat-label">Top Performer</span>
                <span class="stat-value"><?php echo $stats['top_score'] ?? 0; ?></span>
                <span class="stat-trend">Peak Milestone</span>
            </div>
        </div>

        <section class="leaderboard-section">
            <div class="section-title">
                <h2>Real-time Leaderboard</h2>
                <div style="font-size: 0.9rem; opacity: 0.6; font-weight: 600;">CLASS: BCA-III (SEM-VI)</div>
            </div>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Student Identity</th>
                            <th>Email Identification</th>
                            <th>Commit Verification</th>
                            <th>Last Activity</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($result && $result->num_rows > 0): ?>
                            <?php $rank = 1; ?>
                            <?php while($row = $result->fetch_assoc()): ?>
                                <tr class="student-row">
                                    <td>
                                        <div class="rank" style="<?php echo ($rank <= 3) ? 'background: linear-gradient(135deg, var(--primary), var(--success)); transform: scale(1.1);' : ''; ?>">
                                            <?php echo $rank++; ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="student-meta">
                                            <span class="name"><?php echo htmlspecialchars($row['name']); ?></span>
                                            <span class="roll">UID: <?php echo htmlspecialchars($row['roll_no']); ?></span>
                                        </div>
                                    </td>
                                    <td>
                                        <div style="opacity: 0.8; font-weight: 500;"><?php echo htmlspecialchars($row['email']); ?></div>
                                    </td>
                                    <td>
                                        <div class="commit-chip">
                                            <span style="width: 8px; height: 8px; background: currentColor; border-radius: 50%;"></span>
                                            <?php echo $row['commits_count']; ?> Units
                                        </div>
                                    </td>
                                    <td>
                                        <div style="font-weight: 700; opacity: 0.7;">
                                            <?php echo date('d M, Y', strtotime($row['last_commit_date'])); ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" style="text-align: center; padding: 4rem; opacity: 0.5;">
                                    <h3>Empty Database</h3>
                                    <p>Initialize student table to view metrics.</p>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>
    <?php endif; ?>

    <footer style="margin-top: 6rem; text-align: center; border-top: 1px solid var(--border); padding: 3rem;">
        <p style="font-weight: 900; font-size: 1.2rem; margin-bottom: 0.5rem;">SANGAMESHWAR COLLEGE</p>
        <p style="opacity: 0.5; font-size: 0.9rem;">Placement Cell | Autonomous Institution | Solapur</p>
    </footer>
</div>

</body>
</html>
