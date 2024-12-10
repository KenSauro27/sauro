<?php
require 'db.php';
session_start();

if (!isset($_SESSION['admin_id'])) {
    header('Location: adminLogin.php');
    exit;
}

// Fetch job postings
$stmt = $pdo->query("SELECT * FROM job_postings");
$job_postings = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FindHire | Manage Jobs</title>
    
    <!-- Load Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom CSS with Gradients -->
    <style>
        /* Gradient Background for Main Content Area */
        main {
            background: linear-gradient(to bottom, #e0eafc, #cfdef3);
            padding: 20px;
            border-radius: 8px;
        }

        /* Gradient Footer Styling */
        footer {
            background: linear-gradient(to right, #4facfe, #00f2fe);
            color: #ffffff;
            padding: 10px 0;
            border-radius: 5px;
            font-size: 14px;
            text-align: center;
        }

        /* Table Enhancement */
        .table-striped tbody tr:nth-child(odd) {
            background-color: #f2f2f2;
        }

        /* Adjust the header appearance */
        nav.navbar {
            background: linear-gradient(to right, #1d5f94, #4facfe);
        }

        /* Search box adjustments */
        #search {
            border-radius: 25px;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">𝙵𝚒𝚗𝚍𝙷𝚊𝙸𝙍𝙴</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#addJobModal">Add Job</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../adminLogout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content with Gradient -->
    <main class="container mt-4">
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="input-group mb-4">
                    <input type="text" id="search" class="form-control" placeholder="Search for jobs..." aria-label="Search for jobs">
                    <button class="btn btn-outline-secondary" type="button">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Location</th>
                            <th>Salary</th>
                            <th>Last Updated</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($job_postings as $job) { ?>
                            <tr>
                                <td><?php echo htmlspecialchars($job['job_title']); ?></td>
                                <td><?php echo htmlspecialchars($job['job_description']); ?></td>
                                <td><?php echo htmlspecialchars($job['location']); ?></td>
                                <td><?php echo htmlspecialchars($job['salary']); ?></td>
                                <td><?php echo htmlspecialchars($job['last_updated']); ?></td>
                                <td>
                                    <a href="edit.php?id=<?php echo $job['job_id']; ?>" class="btn btn-sm btn-info">Edit</a>
                                    <a href="delete.php?id=<?php echo $job['job_id']; ?>" class="btn btn-sm btn-danger">Delete</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- Footer Section with Gradient -->
    <footer>
        <p>&copy; <?php echo date("Y"); ?> FindHire® Global Inc.</p>
    </footer>

    <!-- Load Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>
