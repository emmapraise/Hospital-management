<!DOCTYPE html>
<html lang="en">
<?php 
session_start();
error_reporting(0);
if(!isset($_SESSION[adminid]))
{
    header('login.php');
//     echo "<script>window.location='login.php';</script>";
}
include("dbconnection.php");
include 'header.php'; 


?>
                    <!--/.span3-->
                    <div class="span9">
                        <div class="content">
                            <div class="btn-controls">
                                <div class="btn-box-row row-fluid">
                                    <a href="#" class="btn-box big span3"><i class=" icon-ambulance"></i><b><?php
    $sql = "SELECT * FROM treatment_records WHERE status='Active'";
    if(isset($_GET[date]))
    {
        $sql = $sql . " AND treatment_date  ='$_GET[date]'";
    }
    $qsql = mysqli_query($con,$sql);
    echo mysqli_num_rows($qsql);
    ?></b>
                                        <p class="text-muted">
                                            Treated</p>
                                    </a><a href="#" class="btn-box big span3"><i class="icon-user"></i><b><?php
    $sql = "SELECT * FROM patient WHERE status='Active'";
    if(isset($_GET[date]))
    {
        $sql = $sql . " AND admissiondate ='$_GET[date]'";
    }
    $qsql = mysqli_query($con,$sql);
    echo mysqli_num_rows($qsql);
    ?></b>
                                        <p class="text-muted">
                                            Patients</p>
                                    </a>
                                    <a href="#" class="btn-box big span3"><i class="icon-building"></i><b><?php
    $sql = "SELECT * FROM department WHERE status='Active'";
    $qsql = mysqli_query($con,$sql);
    echo mysqli_num_rows($qsql);
    ?></b>
                                        <p class="text-muted">
                                            Departments</p>
                                    </a>
                                    <a href="#" class="btn-box big span3"><i class="icon-money"></i><b><?php
    $sql = "SELECT * FROM billing WHERE billingid !='0'";
    if(isset($_GET[date]))
    {
        $sql = $sql . " AND billingdate ='$_GET[date]'";
    }
    $qsql = mysqli_query($con,$sql);
    echo mysqli_num_rows($qsql);
    ?></b>
                                        <p class="text-muted">
                                            Biling Record</p>
                                    </a>
                                </div>
                                <div class="btn-box-row row-fluid">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <div class="span12">
                                                <a href="treatment_view.php" class="btn-box small span3"><i class="icon-ambulance"></i><b>Treatement</b>
                                                </a><a href="patient_view.php" class="btn-box small span3"><i class="icon-group"></i><b>Paintents</b>
                                                </a><a href="appointment_approved_view.php" class="btn-box small span3"><i class="icon-exchange"></i><b>Appointment</b>
                                                </a>
                                                <a href="doctor_view.php" class="btn-box small span3"><i class="icon-user"></i><b>Doctors </b>
                                                </a>
                                            </div>
                                        </div>
                                        <!-- <div class="row-fluid">
                                            <div class="span12">
                                                <a href="#" class="btn-box small span4"><i class="icon-save"></i><b>Total Sales</b>
                                                </a><a href="#" class="btn-box small span4"><i class="icon-bullhorn"></i><b>Social Feed</b>
                                                </a><a href="#" class="btn-box small span4"><i class="icon-sort-down"></i><b>Bounce
                                                    Rate</b> </a>
                                            </div>
                                        </div> -->
                                    </div>
                                    
                                </div>
                            </div>
                            <!--/#btn-controls-->
                            
                            
                            
                        </div>
                        <!--/.content-->
                    </div>
                    <!--/.span9-->
                </div>
            </div>
            <!--/.container-->
        </div>
        <!--/.wrapper-->
        <?php include 'footer.php'; ?>
      
    </body>
