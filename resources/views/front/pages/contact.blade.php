<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Book View - eBook Stack</title>

    <link rel="shortcut icon" href="images/1731092903.jpg" type="image/png">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <style>
        .btn-logout {
    appearance: none;
    -webkit-appearance: none;
    background: none;
    border: none;
    outline: none;
    padding: 0;
    margin: 0;
    font: inherit;
    color: inherit;
    cursor: pointer;
    text-decoration: none;
}
    </style>

</head>

<body>

    <!-- ═══ HEADER ══════════════════════════════════════════════ -->
    @include('layouts.header')
    <!-- ═══ PAGE BODY ════════════════════════════════════════════ -->
    <div class="page-wrap">
        <div class="page_content">

            <h1 id="contact-information">Contact Information</h1>

            <p> We are committed to providing each of our valued clients excellent customer service. If you have any
                questions or concerns, please do not hesitate to contact one of our professional customer service
                representatives , toll free at <a href="tel:(877) 569-9310">(877) 569-9310</a>.</p>

            <p>Contact :</p>
            <ul>
                <li><a href="tel:(877) 569-9310">(877) 569-9310</a></li>
                <li><a href="mailto:support@tryebookstack.com">support@tryebookstack.com</a></li>
            </ul>
        </div>
    </div>

    <!-- ═══ FOOTER ═══════════════════════════════════════════════ -->
    @include('layouts.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>