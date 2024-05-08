<?php require_once 'database.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survey</title>
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
    <form action="results.php" method="POST">
        <table>
            <tr>
                <td>Personal Details:</td><td>Full Names <br><input type="text" id="fname" name="fname" required></td>
            <tr>
                <td></td><td>Email:<br><input type="email" id="email" name="email" required></td>
            </tr>
            <tr>
                <td></td><td>Date Of Birth<br><input type="date" id="date" name="date" required></td>
            </tr>
            <tr>
                <td></td><td>Contact Number<br><input type="tel" id="phone" name="phone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required></td>
            </tr>
            <tr padding="50px">
                <td>What's Your Favorite Food</td>
                <td>
                    <input type="checkbox" name="foods[]" value="Pizza">Pizza
                    <input type="checkbox" name="foods[]" value="Pasta">Pasta
                    <input type="checkbox" name="foods[]" value="PapandWors">Pap and Wors
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <table border="1" class="rating">
                        <tr><td colspan="6">Please rate your level of agreement on a scale from 1 to 5, with 1 being Strongly Agree and 5 being Strongly Disagree</td></tr>
                        <tr>
                            <th></th>
                            <th>Strongly Agree</th>
                            <th>Agree</th>
                            <th>Neutral</th>
                            <th>Disagree</th>
                            <th>Strongly Disagree</th>
                        </tr>
                        <tr>
                            <td>I like to watch movies:</td>
                            <td><input type="radio" name="movies" value="5" required></td>
                            <td><input type="radio" name="movies" value="4"></td>
                            <td><input type="radio" name="movies" value="3"></td>
                            <td><input type="radio" name="movies" value="2"></td>
                            <td><input type="radio" name="movies" value="1"></td>
                        </tr>
                        <tr>
                            <td>I like to listen to radio</td>
                            <td><input type="radio" name="radio" value="5" required></td>
                            <td><input type="radio" name="radio" value="4"></td>
                            <td><input type="radio" name="radio" value="3"></td>
                            <td><input type="radio" name="radio" value="2"></td>
                            <td><input type="radio" name="radio" value="1"></td>
                        </tr>
                        <tr>
                            <td>I like to eat out</td>
                            <td><input type="radio" name="eatout" value="5" required></td>
                            <td><input type="radio" name="eatout" value="4"></td>
                            <td><input type="radio" name="eatout" value="3"></td>
                            <td><input type="radio" name="eatout" value="2"></td>
                            <td><input type="radio" name="eatout" value="1"></td>
                        </tr>
                        <tr>
                            <td>I like to watch TV</td>
                            <td><input type="radio" name="tv" value="5" required></td>
                            <td><input type="radio" name="tv" value="4"></td>
                            <td><input type="radio" name="tv" value="3"></td>
                            <td><input type="radio" name="tv" value="2"></td>
                            <td><input type="radio" name="tv" value="1"></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <input type="submit" value="Submit">
    </form>
</body>
</html>
