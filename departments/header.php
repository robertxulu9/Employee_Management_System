<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SB Admin</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.html">Start Bootstrap</a>

            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>

            <!-- Department -->
            <div class="navbar-brand ps-3">
                <?php if (isset($_SESSION['username'])): ?>
                    <a class="nav-link text-white"><?php echo $_SESSION['department']; ?></a>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                <?php endif; ?>
            </div>

            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>

            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="change_password.php">Change Password</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="../logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>

        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="index.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>

                            <!-- Department Navbar Options -->
                            <?php if (isset($_SESSION['department'])): ?>
                                <?php
                                $department = $_SESSION['department'];

                                switch ($department) {
                                    case 'Registry clerks':
                                        ?>
                                        <a class="nav-link" href="employee_list.php">
                                            <div class="sb-nav-link-icon"><i class="fa fa-plus-square" aria-hidden="true"></i></div>
                                            Employee List
                                        </a>
                                        <?php
                                        break;
                                    case 'Chief Administrator':
                                        ?>
                                        <a class="nav-link" href="chief_administrator_dashboard.php">
                                            <div class="sb-nav-link-icon"><i class="fas fa-crown"></i></div>
                                            Chief Administrator Dashboard
                                        </a>
                                        <?php
                                        break;
                                    case 'Human Resource':
                                        ?>
                                        <a class="nav-link" href="chief_hrm_officer_dashboard.php">
                                            <div class="sb-nav-link-icon"><i class="fas fa-user-shield"></i></div>
                                            Chief HRM Officer Dashboard
                                        </a>

                                        <a class="nav-link" href="add_employee.php">
                                            <div class="sb-nav-link-icon"><i class="fa fa-plus-square" aria-hidden="true"></i></div>
                                            Add Employee
                                        </a>

                                        <a class="nav-link" href="employee_list.php">
                                            <div class="sb-nav-link-icon"><i class="fa fa-plus-square" aria-hidden="true"></i></div>
                                            Employee List
                                        </a>
                                        <?php
                                        break;
                                    case 'Chief accountant':
                                        ?>
                                        <a class="nav-link" href="chief_accountant_dashboard.php">
                                            <div class="sb-nav-link-icon"><i class="fas fa-calculator"></i></div>
                                            Chief Accountant Dashboard
                                        </a>
                                        <?php
                                        break;

                                    case 'Accountants':
                                        ?>
                                        <a class="nav-link" href="accountants_dashboard.php">
                                            <div class="sb-nav-link-icon"><i class="fas fa-briefcase"></i></div>
                                            Accountants Dashboard
                                        </a>
                                        <?php
                                        break;
                                    default:
                                        ?>
                                        <a class="nav-link" href="default_dashboard.php">
                                            <div class="sb-nav-link-icon"><i class="fas fa-ellipsis-h"></i></div>
                                            Default Dashboard
                                        </a>
                                        <?php
                                        break;
                                }
                                ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        <ul class="navbar-nav ml-auto">
                            <?php if (isset($_SESSION['username'])): ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="#"><?php echo $_SESSION['username']; ?></a>
                                </li>
                            <?php else: ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="login.php">Login</a>
                                </li>
                            <?php endif; ?>
                        </ul> 
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <!-- Page content goes here -->
