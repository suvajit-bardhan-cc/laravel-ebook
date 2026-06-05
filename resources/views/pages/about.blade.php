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

</head>

<body>

    <!-- ═══ HEADER ══════════════════════════════════════════════ -->
    <header class="site-header">
        <div class="hdr-top">
            <a href="index.html" class="logo">
                <img src="images/logo.png" alt="eBook Stack">
            </a>

            <div class="search-box">
                <input type="text" id="searchInput" placeholder="Search titles, authors…">
                <button type="button"><i class="fas fa-search"></i> Search</button>
            </div>

            <div class="hdr-actions">
                <div class="dropdown">
                    <button class="btn-acct dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="fas fa-user-circle"></i> My Account
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm" style="font-size:13px">
                        <li><a class="dropdown-item" href="bookmark.html"><i
                                    class="fas fa-bookmark fa-fw me-2 text-muted"></i>Bookmark</a>
                        </li>
                    </ul>
                </div>
                <a href="#" class="btn-logout"><i class="fas fa-sign-out-alt"></i> Log Out</a>
            </div>
        </div>
    </header>
    <!-- ═══ PAGE BODY ════════════════════════════════════════════ -->
    <div class="page-wrap">
        <div class="page_content">

            <h1>About eBook Stack</h1>

            <p>eBook Stack is an online library of free eBooks.</p>

            <p>eBook Stack was the first provider of free electronic books, or
                eBooks. Michael Hart, founder of eBook Stack, invented eBooks
                in 1971 and his memory continues to inspire the creation of eBooks and
                related content today.</p>

            <h2>eBook Stack Mission Statement</h2>

            <p><em>To encourage the creation and distribution of eBooks.</em></p>

            <p><a href="#">A 2004 essay</a> by Michael Hart provides more detail
                on the mission statement, and some of the beliefs that guide eBook Stack activities in
                fulfillment of that mission.</p>

            <h2>More about eBook Stack</h2>
            <p>To read more about eBook Stack, choose one of these topics:</p>

            <ul>
                <li><a href="#">Background, History and Philosophy</a>: Various essays and
                    articles.</li>
                <li><a href="#">Partners and Affiliates</a></li>
                <li><a href="#">Help and how-to</a></li>
                <li>The <a href="#">eBook Stack Literary Archive Foundation</a>, which operates
                    eBook Stack and accepts donations.</li>
            </ul>


        </div>
    </div>

    <!-- ═══ FOOTER ═══════════════════════════════════════════════ -->
    @include('layouts.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>