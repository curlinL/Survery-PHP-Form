<?php
// Include the database connection file
include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate fields
    if(empty($_POST['fname']) || empty($_POST['email']) || empty($_POST['date']) || empty($_POST['phone']) || empty($_POST['foods']) || empty($_POST['movies']) || empty($_POST['radio']) || empty($_POST['eatout']) || empty($_POST['tv'])) {
        die("All fields are required. Please fill them out.");
    }
    if ($_POST['date'] < '1910-01-01' || $_POST['date'] > date('Y-m-d')) {
        die("Invalid date of birth.");
    }

    // Ensure the user has selected ratings for all questions
    $ratings = ['movies', 'radio', 'eatout', 'tv'];
    foreach ($ratings as $rating) {
        if (empty($_POST[$rating])) {
            die("Please select a rating for $rating.");
        }
    }

    // Continue processing data
    $fname = $_POST['fname'];
    $email = $_POST['email'];
    $age = $_POST['date'];
    $phone = $_POST['phone'];
    $foods = implode(',', $_POST['foods']);
    $movies = $_POST['movies'];
    $radio = $_POST['radio'];
    $eatout = $_POST['eatout'];
    $tv = $_POST['tv'];

    // Escape user inputs to prevent SQL injection
    $fname = mysqli_real_escape_string($conn, $fname);
    $email = mysqli_real_escape_string($conn, $email);
    $phone = mysqli_real_escape_string($conn, $phone);

    // Calculate user's age
    $userAge = date_diff(date_create($age), date_create())->y;

    try {
        // Prepare SQL statement to insert survey data
        $sql = "INSERT INTO p_details (fname, email, age, phone, foods, movies, radio, eatout, tv) 
                VALUES ('$fname', '$email', '$userAge', '$phone','$foods', '$movies', '$radio', '$eatout', '$tv')";

        // Execute the statement to insert data
        $stmt = $conn->query($sql);

        if ($stmt) {
            // SQL query to retrieve aggregate data
            $sqlRowCount = "SELECT COUNT(id) AS rowcount FROM p_details";
            $sqlAvgAge = "SELECT AVG(age) AS avgage FROM p_details";
            $sqlMaxAge = "SELECT MAX(age) AS max_age FROM p_details";
            $sqlMinAge = "SELECT MIN(age) AS min_age FROM p_details";
            $sqlPizza = "SELECT (COUNT(CASE WHEN foods LIKE '%Pizza%' THEN 1 END) / COUNT(*)) * 100 AS pizza_percentage FROM p_details";
            $sqlPasta = "SELECT (COUNT(CASE WHEN foods LIKE '%Pasta%' THEN 1 END) / COUNT(*)) * 100 AS pasta_percentage FROM p_details";
            $sqlPapandWors = "SELECT (COUNT(CASE WHEN foods LIKE '%PapandWors%' THEN 1 END) / COUNT(*)) * 100 AS papandwors_percentage FROM p_details";
            $sqlMovieRating = "SELECT AVG(movies) AS movie_rating FROM p_details";
            $sqlRadioRating = "SELECT AVG(radio) AS radio_rating FROM p_details";
            $sqlEatoutRating = "SELECT AVG(eatout) AS eatout_rating FROM p_details";
            $sqlTvRating = "SELECT AVG(tv) AS tv_rating FROM p_details";
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }

    try {
        // Execute the queries to retrieve aggregate data
        $stmtRowCount = $conn->query($sqlRowCount);
        if (!$stmtRowCount) {
            throw new Exception("Error executing query: " . $conn->error);
        }

        $stmtAvgAge = $conn->query($sqlAvgAge);
        if (!$stmtAvgAge) {
            throw new Exception("Error executing query: " . $conn->error);
        }

        $stmtMaxAge = $conn->query($sqlMaxAge);
        if (!$stmtMaxAge) {
            throw new Exception("Error executing query: " . $conn->error);
        }

        $stmtMinAge = $conn->query($sqlMinAge);
        if (!$stmtMinAge) {
            throw new Exception("Error executing query: " . $conn->error);
        }

        $stmtPizza = $conn->query($sqlPizza);
        if (!$stmtPizza) {
            throw new Exception("Error executing query: " . $conn->error);
        }

        $stmtPasta = $conn->query($sqlPasta);
        if (!$stmtPasta) {
            throw new Exception("Error executing query: " . $conn->error);
        }

        $stmtPapandWors = $conn->query($sqlPapandWors);
        if (!$stmtPapandWors) {
            throw new Exception("Error executing query: " . $conn->error);
        }

        $stmtMovieRating = $conn->query($sqlMovieRating);
        if (!$stmtMovieRating) {
            throw new Exception("Error executing query: " . $conn->error);
        }

        $stmtRadioRating = $conn->query($sqlRadioRating);
        if (!$stmtRadioRating) {
            throw new Exception("Error executing query: " . $conn->error);
        }

        $stmtEatoutRating = $conn->query($sqlEatoutRating);
        if (!$stmtEatoutRating) {
            throw new Exception("Error executing query: " . $conn->error);
        }

        $stmtTvRating = $conn->query($sqlTvRating);
        if (!$stmtTvRating) {
            throw new Exception("Error executing query: " . $conn->error);
        }

        // Fetch results
        $rowCount = mysqli_fetch_assoc($stmtRowCount)['rowcount'];
        $avgAge = mysqli_fetch_assoc($stmtAvgAge)['avgage'];
        $maxAge = mysqli_fetch_assoc($stmtMaxAge)['max_age'];
        $minAge = mysqli_fetch_assoc($stmtMinAge)['min_age'];
        $pizzaPercent = mysqli_fetch_assoc($stmtPizza)['pizza_percentage'];
        $pastaPercent = mysqli_fetch_assoc($stmtPasta)['pasta_percentage'];
        $papandworsPercent = mysqli_fetch_assoc($stmtPapandWors)['papandwors_percentage'];
        $MovieAverage = mysqli_fetch_assoc($stmtMovieRating)['movie_rating'];
        $RadioAverage = mysqli_fetch_assoc($stmtRadioRating)['radio_rating'];
        $EatoutAverage = mysqli_fetch_assoc($stmtEatoutRating)['eatout_rating'];
        $TvAverage = mysqli_fetch_assoc($stmtTvRating)['tv_rating'];

        // Free the result sets
        $stmtRowCount->free_result();
        $stmtAvgAge->free_result();
        $stmtMaxAge->free_result();
        $stmtMinAge->free_result();
        $stmtPizza->free_result();
        $stmtPasta->free_result();
        $stmtPapandWors->free_result();
        $stmtMovieRating->free_result();
        $stmtRadioRating->free_result();
        $stmtEatoutRating->free_result();
        $stmtTvRating->free_result();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survey Results</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h3>Curlin's Food Survey</h3>
        <div class="side-links">
            <a href="index.php">FILL OUT SURVEY</a>
            <a href="results.php">VIEW SURVEY RESULTS</a>
        </div>
    </header>
    <h2>Survey Results</h2>
    <table border>
        <tr>
            <td>Total number of surveys</td>
            <td><?php echo $rowCount; ?></td>
        </tr>
        <tr>
            <td>Average Age</td>
            <td><?php echo number_format($avgAge, 2); ?></td>
        </tr>
        <tr>
            <td>Oldest person who participated in survey:</td>
            <td><?php echo number_format($maxAge, 0); ?></td>
        </tr>
        <tr>
            <td>Youngest person who participated in survey</td>
            <td><?php echo number_format($minAge, 0); ?></td>
        </tr>
        <tr>
            <td>Percentage of people who like Pizza:</td>
            <td><?php echo number_format($pizzaPercent, 1); ?></td>
        </tr>
        <tr>
            <td>Percentage of people who like Pasta</td>
            <td><?php echo number_format($pastaPercent, 1); ?></td>
        </tr>
        <tr>
            <td>Percentage of people who like Pap and Wors</td>
            <td><?php echo number_format($papandworsPercent, 1); ?></td>
        </tr>
        <tr>
            <td>People who like to watch movies</td>
            <td><?php echo number_format($MovieAverage, 2); ?></td>
        </tr>
        <tr>
            <td>People who like to listen to radio</td>
            <td><?php echo number_format($RadioAverage, 2); ?></td>
        </tr>
        <tr>
            <td>People who like to eat out</td>
            <td><?php echo number_format($EatoutAverage, 2); ?></td>
        </tr>
        <tr>
            <td>People who like to watch TV</td>
            <td><?php echo number_format($TvAverage, 2); ?></td>
        </tr>
    </table>
</body>
</html>
