<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--Font Awesome CDN-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Admission CRUD</title>
    <link rel="stylesheet" href="prac.css">
</head>
<body>

    <div class="container">

        <header>

            <div class="filterEntries">
                <div class="entries">
                    Show <select name="" id="table_size">
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select> entries
                </div>

                <div class="filter">
                    <label for="search">Search:</label>
                    <input type="search" name="" id="search" placeholder="Enter name/ST#/course">
                </div>
            </div>

            <div class="addMemberBtn">
            <button>Add New Student</button>
            </div>

        </header>


        <table>

            <thead>
                <tr class="heading">
                    <th>ID No.</th>
                    <th>Picture</th>
                    <th>Full Name</th>
                    <th>Student No.</th>
                    <th>Address</th>
                    <th>Course</th>
                    <th>Year Level</th>
                    <th>Birth Date</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Action</th>
                </tr>
            </thead>


            <tbody class="userInfo">
                <!-- <tr><td class="empty" colspan="11" align="center">No data available in table</td></tr> -->
                <!-- <tr>
                    <td>1</td>
                    <td><img src="user.png" alt="" width="40" height="40"></td>
                    <td>John Doe</td>
                    <td>21012937</td>
                    <td>New York</td>
                    <td>BSIT</td>
                    <td>4th Year</td>
                    <td>03-08-2010</td>
                    <td>jhondoe.net111@gmail.com</td>
                    <td>924157812</td>
                    <td>
                        <button><i class="fa-regular fa-eye"></i></button>
                        <button><i class="fa-regular fa-pen-to-square"></i></button>
                        <button><i class="fa-regular fa-trash-can"></i></button>
                    </td>
                </tr>
                <tr>
                    <td>1</td>
                    <td><img src="user.png" alt="" width="40" height="40"></td>
                    <td>John Doe</td>
                    <td>21012937</td>
                    <td>New York</td>
                    <td>BSIT</td>
                    <td>4th Year</td>
                    <td>03-08-2010</td>
                    <td>jhondoe.net111@gmail.com</td>
                    <td>924157812</td>
                    <td>
                        <button><i class="fa-regular fa-eye"></i></button>
                        <button><i class="fa-regular fa-pen-to-square"></i></button>
                        <button><i class="fa-regular fa-trash-can"></i></button>
                    </td>
                </tr>
                <tr>
                    <td>1</td>
                    <td><img src="user.png" alt="" width="40" height="40"></td>
                    <td>John Doe</td>
                    <td>21012937</td>
                    <td>New York</td>
                    <td>BSIT</td>
                    <td>4th Year</td>
                    <td>03-08-2010</td>
                    <td>jhondoe.net111@gmail.com</td>
                    <td>924157812</td>
                    <td>
                        <button><i class="fa-regular fa-eye"></i></button>
                        <button><i class="fa-regular fa-pen-to-square"></i></button>
                        <button><i class="fa-regular fa-trash-can"></i></button>
                    </td>
                </tr>
                <tr>
                    <td>1</td>
                    <td><img src="user.png" alt="" width="40" height="40"></td>
                    <td>John Doe</td>
                    <td>21012937</td>
                    <td>New York</td>
                    <td>BSIT</td>
                    <td>4th Year</td>
                    <td>03-08-2010</td>
                    <td>jhondoe.net111@gmail.com</td>
                    <td>924157812</td>
                    <td>
                        <button><i class="fa-regular fa-eye"></i></button>
                        <button><i class="fa-regular fa-pen-to-square"></i></button>
                        <button><i class="fa-regular fa-trash-can"></i></button>
                    </td>
                </tr> -->
            </tbody>

        </table>


        <footer>
            <span class="showEntries">Showing 1 to 10 of 50 entries</span>
            <div class="pagination">
                <!-- <button>Prev</button>
                <button class="active">1</button>
                <button>2</button>
                <button>3</button>
                <button>4</button>
                <button>5</button>
                <button>Next</button> -->
            </div>
        </footer>
    </div>


    <!--Popup Form-->

    <div class="dark_bg">

        <div class="popup">
             <header>
                <h2 class="modalTitle">Fill the Form</h2>
                <button class="closeBtn">&times;</button>
             </header>

             <div class="body">
                <form action="#" id="myForm">
                    <div class="imgholder">
                        <label for="uploadimg" class="upload">
                            <input type="file" name="" id="uploadimg" class="picture">
                            <i class="fa-solid fa-plus"></i>
                        </label>
                        <img src="user.png" alt="" width="150" height="150" class="img">
                    </div> 

                    <div class="inputFieldContainer">

                        <div class="nameField">
                            <div class="form_control">
                                <label for="fName">First Name:</label>
                                <input type="text" name="" id="fName" required>
                            </div>

                            <div class="form_control">
                                <label for="lName">Last Name:</label>
                                <input type="text" name="" id="lName" required>
                            </div>
                        </div>

                        <div class="studentNumAddressField">
                            <div class="form_control">
                                <label for="studentNum">Student No.:</label>
                                <input type="number" name="" id="studentNum" required>
                            </div>

                            <div class="form_control">
                                <label for="address">Address:</label>
                                <input type="text" name="" id="address" required>
                            </div>
                        </div>

                        <div class="courseYearLevel">
                            <div class="form_control">
                                <label for="course">Course:</label>
                                <input type="text" name="" id="course" required>
                            </div>

                            <div class="form_control">
                                <label for="yearlevel">Year Level:</label>
                                <input type="text" name="" id="yearlevel" required>
                            </div>
                        </div>

                        <div class="form_control">
                            <label for="bDate">Birth Date:</label>
                            <input type="date" name="" id="bDate" required>
                        </div>

                        <div class="form_control">
                            <label for="email">Email:</label>
                            <input type="email" name="" id="email" required>
                        </div>

                        <div class="form_control">
                            <label for="phone">Phone:</label>
                            <input type="number" name="" id="phone" required>
                        </div>
                    </div>
                </form>
             </div>

             <footer class="popupFooter">
                <button form="myForm" class="submitBtn">Submit</button>
             </footer>
        </div>

    </div>


    <script src="prac.js"></script>
</body>
</html>