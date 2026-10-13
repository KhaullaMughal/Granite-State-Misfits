<?php

include '../Rideweb/GSM-AdminPanel/connection.php';

$query = "
    SELECT *
    FROM raffles
    WHERE status = 'active'
    ORDER BY raffle_id DESC
    LIMIT 1
";

$result = mysqli_query($conn, $query);

$raffle = null;

if ($result && mysqli_num_rows($result) > 0) {
    $raffle = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>RAFFLE | GRANITE STATE MISFITS</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.0/css/all.min.css">

    <link
        href="https://fonts.googleapis.com/css2?family=Bangers&family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="./raffle.css">
 

    <link
        rel="icon"
        href="./images/logo.jpeg">

</head>


<body>

<section class="raffle-hero">

    <div class="raffle-overlay"></div>

    <div class="container">

        <div class="raffle-hero-content">

            <span class="hero-small">
                GRANITE STATE MISFITS PRESENTS
            </span>

            <h1>
                FREE <span>RAFFLE</span>
            </h1>

            <p>
                NO PURCHASE. NO COST.
                <br>
                JUST GOOD TIMES AND GOOD LUCK.
            </p>

            <a href="#enter-raffle"
               class="raffle-btn">

                ENTER NOW
                <i class="fa-solid fa-arrow-down"></i>

            </a>

        </div>

    </div>

</section>


<?php if ($raffle): ?>


<!-- =========================================
     RAFFLE INTRO
========================================= -->

<section class="raffle-section">

    <div class="container">

        <div class="raffle-heading">

            <span>YOUR CHANCE TO WIN</span>

            <h2>
                <?= htmlspecialchars($raffle['title']); ?>
            </h2>

            <p>
                <?= nl2br(
                    htmlspecialchars($raffle['description'])
                ); ?>
            </p>

        </div>


        <div class="row g-4 align-items-stretch">

            <!-- PRIZE -->

            <div class="col-lg-6">

                <div class="prize-card">

                    <div class="prize-image">

                        <?php if (!empty($raffle['image'])): ?>

                            <img
                                src="./GSM-AdminPanel/Uploads/<?= htmlspecialchars($raffle['image']); ?>"
                                alt="Raffle Prize">

                        <?php else: ?>

                            <div class="prize-placeholder">

                                <i class="fa-solid fa-gift"></i>

                            </div>

                        <?php endif; ?>

                    </div>


                    <div class="prize-content">

                        <span>
                            PRIZE
                        </span>

                        <h3>
                            <?= htmlspecialchars($raffle['prize']); ?>
                        </h3>

                        <div class="draw-date">

                            <i class="fa-regular fa-calendar"></i>

                            DRAW DATE:
                            <?= date(
                                "F d, Y",
                                strtotime($raffle['draw_date'])
                            ); ?>

                        </div>

                    </div>

                </div>

            </div>


            <!-- RULES -->

            <div class="col-lg-6">

                <div class="rules-card">

                    <span class="card-label">
                        HOW IT WORKS
                    </span>

                    <h3>
                        ENTER. RIDE.
                        <span>WIN.</span>
                    </h3>


                    <div class="rule">

                        <div class="rule-number">
                            01
                        </div>

                        <div>
                            <h4>Enter For Free</h4>

                            <p>
                                Fill out the entry form.
                                There is no purchase required.
                            </p>
                        </div>

                    </div>


                    <div class="rule">

                        <div class="rule-number">
                            02
                        </div>

                        <div>
                            <h4>Get Your Entry Number</h4>

                            <p>
                                You'll receive a unique
                                raffle entry code.
                            </p>
                        </div>

                    </div>


                    <div class="rule">

                        <div class="rule-number">
                            03
                        </div>

                        <div>
                            <h4>Wait For The Draw</h4>

                            <p>
                                We'll randomly select a
                                winner on the draw date.
                            </p>

                        </div>

                    </div>


                    <div class="rule">

                        <div class="rule-number">
                            04
                        </div>

                        <div>
                            <h4>Claim Your Prize</h4>

                            <p>
                                The winner will be contacted
                                using their entry information.
                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>


<!-- =========================================
     ENTER RAFFLE
========================================= -->

<section
    class="enter-section"
    id="enter-raffle">

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-lg-7">

                <div class="entry-card">

                    <div class="entry-heading">

                        <span>
                            FREE ENTRY
                        </span>

                        <h2>
                            ENTER THE
                            <strong>RAFFLE</strong>
                        </h2>

                        <p>
                            Complete the form below.
                            It's completely free.
                        </p>

                    </div>


                    <?php if (isset($_GET['status'])): ?>

                        <?php if ($_GET['status'] === 'success'): ?>

                            <div class="success-message">

                                <i class="fa-solid fa-circle-check"></i>

                                <div>

                                    <strong>
                                        Entry Submitted!
                                    </strong>

                                    <p>
                                        Your raffle entry has been
                                        successfully registered.
                                    </p>

                                </div>

                            </div>

                        <?php elseif ($_GET['status'] === 'exists'): ?>

                            <div class="error-message">

                                <i class="fa-solid fa-circle-exclamation"></i>

                                <div>

                                    <strong>
                                        Already Entered
                                    </strong>

                                    <p>
                                        This email has already been
                                        entered in this raffle.
                                    </p>

                                </div>

                            </div>

                        <?php elseif ($_GET['status'] === 'error'): ?>

                            <div class="error-message">

                                <i class="fa-solid fa-circle-exclamation"></i>

                                <div>

                                    <strong>
                                        Something went wrong.
                                    </strong>

                                    <p>
                                        Please try again.
                                    </p>

                                </div>

                            </div>

                        <?php endif; ?>

                    <?php endif; ?>


                    <form
                        action="raffle-submit.php"
                        method="POST">

                        <input
                            type="hidden"
                            name="raffle_id"
                            value="<?= $raffle['raffle_id']; ?>">


                        <div class="row g-3">

                            <div class="col-md-6">

                                <label>
                                    YOUR NAME
                                </label>

                                <input
                                    type="text"
                                    name="name"
                                    class="form-control"
                                    placeholder="John Smith"
                                    required>

                            </div>


                            <div class="col-md-6">

                                <label>
                                    EMAIL ADDRESS
                                </label>

                                <input
                                    type="email"
                                    name="email"
                                    class="form-control"
                                    placeholder="you@example.com"
                                    required>

                            </div>


                            <div class="col-md-6">

                                <label>
                                    PHONE
                                </label>

                                <input
                                    type="text"
                                    name="phone"
                                    class="form-control"
                                    placeholder="(603) 555-0199">

                            </div>


                            <div class="col-md-6">

                                <label>
                                    CITY
                                </label>

                                <input
                                    type="text"
                                    name="city"
                                    class="form-control"
                                    placeholder="Manchester, NH">

                            </div>


                            <div class="col-12">

                                <div class="terms">

                                    <input
                                        type="checkbox"
                                        required>

                                    <span>
                                        I agree to the raffle rules
                                        and understand that no purchase
                                        is necessary to enter.
                                    </span>

                                </div>

                            </div>


                            <div class="col-12">

                                <button
                                    type="submit"
                                    class="raffle-submit">

                                    ENTER RAFFLE

                                    <i class="fa-solid fa-ticket"></i>

                                </button>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</section>


<?php else: ?>


<section class="no-raffle">

    <div class="container">

        <i class="fa-solid fa-ticket"></i>

        <h2>
            NO ACTIVE RAFFLE
        </h2>

        <p>
            Check back soon for our next giveaway.
        </p>

    </div>

</section>

<?php endif; ?>


<!-- =========================================
     FOOTER
========================================= -->

</body>

</html>