<?php

$result = false;

if (isset($_POST['borrow_book'])) {

    $student_name = $_POST['student_name'];
    $year_level = $_POST['year_level'];
    $has_card = $_POST['has_card'];
    $borrowed_books = $_POST['borrowed_books'];
    $book_category = $_POST['book_category'];

    $result = true;

    // 1. IF STATEMENT
    // Checks if the student has a library card.

    if ($has_card == "yes") {
        $card_message = "Library card verified.";
        $card_status = "success";
    }


    // 2. IF...ELSE STATEMENT
    // Checks if the student can borrow another book.

    if ($has_card == "yes" && $borrowed_books < 3) {
        $borrow_message = "You are allowed to borrow another book.";
        $borrow_status = "success";
    } else {
        $borrow_message = "You cannot borrow another book at this time.";
        $borrow_status = "danger";
    }


    // 3. IF...ELSEIF...ELSE STATEMENT
    // Determines the borrowing limit based on year level.

    if ($year_level == "1st Year") {
        $borrowing_limit = 2;
    } elseif ($year_level == "2nd Year") {
        $borrowing_limit = 3;
    } elseif ($year_level == "3rd Year") {
        $borrowing_limit = 4;
    } else {
        $borrowing_limit = 5;
    }


    // 4. SWITCH STATEMENT
    // Displays information based on book category.

    switch ($book_category) {

        case "programming":
            $category_title = "Programming";
            $category_message = "Books about programming, coding, and software development.";
            break;

        case "mathematics":
            $category_title = "Mathematics";
            $category_message = "Books about mathematics, formulas, and problem solving.";
            break;

        case "science":
            $category_title = "Science";
            $category_message = "Books about science, technology, and scientific concepts.";
            break;

        case "literature":
            $category_title = "Literature";
            $category_message = "Books about novels, poetry, stories, and literary works.";
            break;

        default:
            $category_title = "Unknown";
            $category_message = "No category information available.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>School Library Borrowing System</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

    <div class="container">

        <!-- HEADER -->

        <div class="header">

            <div class="logo">
                📚
            </div>

            <div>
                <h1>School Library</h1>
                <p>Book Borrowing System</p>
            </div>

        </div>


        <!-- FORM CARD -->

        <div class="card">

            <h2>Borrow a Book</h2>

            <p class="description">
                Enter your information to check if you are eligible
                to borrow a book from the library.
            </p>

            <form method="POST">

                <!-- STUDENT NAME -->

                <div class="form-group">

                    <label>Student Name</label>

                    <input
                        type="text"
                        name="student_name"
                        placeholder="Enter your full name"
                        required
                    >

                </div>


                <!-- YEAR LEVEL -->

                <div class="form-group">

                    <label>Year Level</label>

                    <select name="year_level" required>

                        <option value="">Select your year level</option>

                        <option value="1st Year">
                            1st Year
                        </option>

                        <option value="2nd Year">
                            2nd Year
                        </option>

                        <option value="3rd Year">
                            3rd Year
                        </option>

                        <option value="4th Year">
                            4th Year
                        </option>

                    </select>

                </div>


                <!-- LIBRARY CARD -->

                <div class="form-group">

                    <label>Do you have a library card?</label>

                    <select name="has_card" required>

                        <option value="yes">Yes</option>

                        <option value="no">No</option>

                    </select>

                </div>


                <!-- BORROWED BOOKS -->

                <div class="form-group">

                    <label>Books Currently Borrowed</label>

                    <input
                        type="number"
                        name="borrowed_books"
                        min="0"
                        placeholder="Example: 1"
                        required
                    >

                </div>


                <!-- BOOK CATEGORY -->

                <div class="form-group">

                    <label>Book Category</label>

                    <select name="book_category" required>

                        <option value="">
                            Select a category
                        </option>

                        <option value="programming">
                            Programming
                        </option>

                        <option value="mathematics">
                            Mathematics
                        </option>

                        <option value="science">
                            Science
                        </option>

                        <option value="literature">
                            Literature
                        </option>

                    </select>

                </div>


                <!-- BUTTON -->

                <button
                    type="submit"
                    name="borrow_book"
                >
                    Check Borrowing Eligibility
                </button>

            </form>

        </div>


        <!-- RESULTS -->

        <?php if ($result): ?>

        <div class="result-card">

            <div class="result-header">

                <h2>Borrowing Result</h2>

                <span>📖</span>

            </div>


            <div class="student-info">

                <p>
                    <strong>Student:</strong>
                    <?php echo htmlspecialchars($student_name); ?>
                </p>

                <p>
                    <strong>Year Level:</strong>
                    <?php echo htmlspecialchars($year_level); ?>
                </p>

            </div>


            <!-- IF RESULT -->

            <div class="message success">

                <span>✓</span>

                <?php echo $card_message; ?>

            </div>


            <!-- IF ELSE RESULT -->

            <div class="message <?php echo $borrow_status; ?>">

                <span>
                    <?php
                    echo ($borrow_status == "success") ? "✓" : "!";
                    ?>
                </span>

                <?php echo $borrow_message; ?>

            </div>


            <!-- IF ELSEIF ELSE RESULT -->

            <div class="information">

                <h3>Borrowing Limit</h3>

                <p>
                    As a
                    <strong><?php echo htmlspecialchars($year_level); ?></strong>
                    student, you may borrow up to
                    <strong><?php echo $borrowing_limit; ?> books.</strong>
                </p>

            </div>


            <!-- SWITCH RESULT -->

            <div class="information">

                <h3>Selected Book Category</h3>

                <p class="category">
                    <?php echo $category_title; ?>
                </p>

                <p>
                    <?php echo $category_message; ?>
                </p>

            </div>


            <?php if ($borrow_status == "success"): ?>

                <div class="final-message">

                    You may proceed with your book borrowing request!

                </div>

            <?php else: ?>

                <div class="final-message warning">

                    Please check your library card or return a borrowed
                    book before borrowing another one.

                </div>

            <?php endif; ?>


        </div>

        <?php endif; ?>


        <footer>

            <p>
                GROUP - 3
            </p>

            <span>
                School Library Borrowing System
            </span>

        </footer>

    </div>

</body>

</html>
